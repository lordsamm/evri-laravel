#!/usr/bin/env python3
"""
Migrate static Evri website from evri-clone into Laravel Blade views.
"""
from __future__ import annotations

import hashlib
import json
import os
import re
import shutil
from pathlib import Path

SOURCE_ROOT = Path(r"C:\My Web Sites\evri\evri-clone\www.evri.com")
LARAVEL_ROOT = Path(r"C:\My Web Sites\evri\evri-laravel")
PUBLIC_ROOT = LARAVEL_ROOT / "public"
VIEWS_ROOT = LARAVEL_ROOT / "resources" / "views"
LAYOUTS_ROOT = VIEWS_ROOT / "layouts"
PAGES_ROOT = VIEWS_ROOT / "pages"
ROUTES_FILE = LARAVEL_ROOT / "routes" / "web.php"

# Asset directories to copy from source into public/
ASSET_DIRS = [
    "_assets",
    "_nuxt",
    "js",
    "svgs",
    "business",
    "clients",
    "faqs",
    "find-a-parcelshop",
    "guides",
    "help-and-support",
    "news",
    "our-services",
    "parcelshops",
    "press",
    "return",
    "return-a-parcel",
    "send",
    "careers",
    "customer",
    "cookie-policy",
    "environment-social-and-governance",
    "amazonmfn",
]

# Only copy non-HTML assets from these dirs (HTML becomes Blade views)
ASSET_EXTENSIONS = {
    ".css", ".js", ".map", ".png", ".jpg", ".jpeg", ".gif", ".webp", ".svg",
    ".ico", ".woff", ".woff2", ".ttf", ".eot", ".json", ".xml", ".txt", ".pdf",
    ".mp4", ".webm", ".avif",
}

HTTRACK_COMMENT_RE = re.compile(
    r"<!--\s*Mirrored from.*?-->\s*", re.IGNORECASE | re.DOTALL
)
FOOTER_RE = re.compile(r'<footer class="footer">.*?</footer>', re.DOTALL)
HEADER_RE = re.compile(
    r'<div class="header-wrapper"[^>]*>.*?</div>\s*(?=<main|<div class="page|<div id="app")',
    re.DOTALL,
)
# Fallback header: from body start through first main content marker
MAIN_START_MARKERS = [
    '<main',
    '<div class="page-content',
    '<div class="the-hero-banner',
    '<div id="__nuxt"',
]


def slugify_route(relpath: str) -> tuple[str, str]:
    """Return (view_name, url_path) from relative html path."""
    rel = relpath.replace("\\", "/")
    if rel.endswith("/index.html"):
        rel = rel[: -len("/index.html")]
    elif rel.endswith(".html"):
        rel = rel[: -len(".html")]

    if not rel or rel == "index":
        return "pages.home", "/"

    view_name = "pages." + rel.replace("/", ".")
    url_path = "/" + rel
    return view_name, url_path


def dedupe_pages(pages: list[dict]) -> list[dict]:
    """Prefer index.html over sibling .html when both map to the same URL."""
    by_url: dict[str, dict] = {}
    for page in pages:
        url = page["url"]
        existing = by_url.get(url)
        if existing is None:
            by_url[url] = page
            continue
        if existing["source"].endswith("/index.html"):
            continue
        if page["source"].endswith("/index.html"):
            by_url[url] = page
    return list(by_url.values())


def normalize_asset_path(path: str) -> str:
    """Normalize asset path to site-root relative without leading slash."""
    path = path.strip()
    if path.startswith(("http://", "https://", "//", "data:", "mailto:", "tel:", "#")):
        return path
    path = path.split("?")[0].split("#")[0]
    while path.startswith("../"):
        path = path[3:]
    if path.startswith("./"):
        path = path[2:]
    return path.lstrip("/")


def html_href_to_route(href: str) -> str:
    if href.startswith(("{{", "http", "//", "mailto:", "tel:", "#", "javascript:")):
        return href
    original = href
    query = ""
    fragment = ""
    if "?" in href:
        path_part, query_part = href.split("?", 1)
        query = "?" + query_part.split("#")[0]
        href = path_part
    if "#" in href:
        fragment = href[href.index("#") :]
        href = href.split("#")[0]
    clean = href
    if clean.endswith("/index.html"):
        clean = clean[: -len("/index.html")]
    elif clean.endswith(".html"):
        clean = clean[: -len(".html")]
    clean = normalize_asset_path(clean)
    if not clean or clean == "index":
        return "/" + query + fragment if query or fragment else "/"
    return "/" + clean + query + fragment


def convert_internal_links(content: str) -> str:
    """Convert .html internal links to Laravel route paths."""

    def repl_href(match: re.Match) -> str:
        quote, href = match.group(1), match.group(2)
        route = html_href_to_route(href)
        return f"href={quote}{route}{quote}"

    return re.sub(r'href=(["\'])([^"\']+)\1', repl_href, content, flags=re.IGNORECASE)


def convert_asset_urls(content: str) -> str:
    """Replace relative asset URLs with Laravel asset() helper."""

    def is_asset_path(path: str) -> bool:
        normalized = normalize_asset_path(path)
        if normalized.startswith(("http://", "https://", "//", "data:", "mailto:", "tel:", "#")):
            return False
        if normalized.endswith(".html") or normalized.endswith(".htm"):
            return False
        return True

    def to_asset(path: str) -> str:
        normalized = normalize_asset_path(path)
        return "{{ asset('" + normalized.replace("'", "\\'") + "') }}"

    def repl_src(match: re.Match) -> str:
        attr, quote, path = match.group(1), match.group(2), match.group(3)
        if path.startswith(("{{", "<?")) or not is_asset_path(path):
            return match.group(0)
        return f'{attr}={quote}{to_asset(path)}{quote}'

    content = re.sub(
        r'\b(src|content|data-src|poster)=(["\'])([^"\']+)\2',
        repl_src,
        content,
        flags=re.IGNORECASE,
    )

    def repl_srcset(match: re.Match) -> str:
        quote, value = match.group(1), match.group(2)
        parts = []
        for chunk in value.split(","):
            chunk = chunk.strip()
            if not chunk:
                continue
            bits = chunk.split()
            if bits and is_asset_path(bits[0]):
                bits[0] = to_asset(bits[0])
            parts.append(" ".join(bits))
        return f'srcset={quote}{", ".join(parts)}{quote}'

    content = re.sub(
        r'\bsrcset=(["\'])([^"\']+)\1',
        repl_srcset,
        content,
        flags=re.IGNORECASE,
    )

    def repl_url(match: re.Match) -> str:
        path = match.group(1).strip("'\"")
        if path.startswith(("{{", "http", "//", "data:", "#")):
            return match.group(0)
        if path.endswith(".html") or path.endswith(".htm"):
            route = html_href_to_route(path)
            return f"url('{route}')"
        if not is_asset_path(path):
            return match.group(0)
        return f"url({to_asset(path)})"

    content = re.sub(
        r"url\(([^)]+)\)",
        repl_url,
        content,
        flags=re.IGNORECASE,
    )
    return content


def extract_title(html: str) -> str:
    m = re.search(r"<title>(.*?)</title>", html, re.IGNORECASE | re.DOTALL)
    return m.group(1).strip() if m else "Evri"


def extract_head_scripts_and_links(html: str) -> str:
    m = re.search(r"<head[^>]*>(.*?)</head>", html, re.IGNORECASE | re.DOTALL)
    if not m:
        return ""
    head = m.group(1)
    head = re.sub(r"<title>.*?</title>", "", head, flags=re.IGNORECASE | re.DOTALL)
    head = re.sub(r'<meta\s+charset[^>]*>', "", head, flags=re.IGNORECASE)
    head = re.sub(
        r'<meta\s+name="viewport"[^>]*>',
        "",
        head,
        flags=re.IGNORECASE,
    )
    return head.strip()


def extract_header(html: str) -> str | None:
    start_markers = [
        'class="skip-to-content"',
        'class="header__nav-container"',
        'class="header__nav"',
    ]
    start = -1
    for marker in start_markers:
        idx = html.find(marker)
        if idx >= 0:
            candidate = html.rfind("<a", 0, idx) if "skip-to-content" in marker else html.rfind("<div", 0, idx)
            if candidate >= 0:
                start = candidate
                break

    if start < 0:
        body_m = re.search(r"<body[^>]*>", html, re.IGNORECASE)
        if not body_m:
            return None
        start = body_m.end()

    end = len(html)
    for marker in MAIN_START_MARKERS:
        pos = html.find(marker, start)
        if pos > start:
            end = min(end, pos)

    chunk = html[start:end].strip()
    return chunk if len(chunk) > 100 else None


def extract_footer(html: str) -> str | None:
    m = FOOTER_RE.search(html)
    return m.group(0) if m else None


def extract_main_content(html: str, header: str | None, footer: str | None) -> str:
    content = html
    body_m = re.search(r"<body[^>]*>", content, re.IGNORECASE)
    if body_m:
        content = content[body_m.end() :]
    close_body = content.rfind("</body>")
    if close_body >= 0:
        content = content[:close_body]

    if header and header in content:
        content = content.replace(header, "", 1)
    if footer and footer in content:
        content = content.replace(footer, "", 1)

    # Remove trailing Nuxt hydration scripts at bottom if present
    return content.strip()


def copy_assets() -> None:
    print("Copying static assets...")

    def ignore_html(directory: str, filenames: list[str]) -> set[str]:
        ignored: set[str] = set()
        for name in filenames:
            if name.endswith(".html"):
                ignored.add(name)
        return ignored

    for item in SOURCE_ROOT.iterdir():
        if item.name.startswith("."):
            continue
        dst = PUBLIC_ROOT / item.name
        if item.is_dir():
            if dst.exists():
                shutil.rmtree(dst)
            shutil.copytree(item, dst, ignore=ignore_html)
        elif item.is_file() and item.suffix.lower() in ASSET_EXTENSIONS:
            shutil.copy2(item, dst)

    # Copy external CDN mirrors referenced by relative paths in HTML
    clone_root = SOURCE_ROOT.parent
    for external_name in ["static.cdn.prismic.io", "images.prismic.io", "d52c969eb9aa.edge.sdk.awswaf.com"]:
        external = clone_root / external_name
        if external.exists():
            dst = PUBLIC_ROOT / external_name
            if dst.exists():
                shutil.rmtree(dst)
            shutil.copytree(external, dst)


def analyze_and_migrate() -> list[dict]:
    print("Analyzing HTML pages...")
    html_files = sorted(SOURCE_ROOT.rglob("*.html"))
    pages: list[dict] = []

    reference_header: str | None = None
    reference_footer: str | None = None

    for html_path in html_files:
        rel = html_path.relative_to(SOURCE_ROOT).as_posix()
        with open(html_path, "r", encoding="utf-8", errors="replace") as f:
            raw = f.read()

        raw = HTTRACK_COMMENT_RE.sub("", raw)
        header = extract_header(raw)
        footer = extract_footer(raw)

        if reference_header is None and header:
            reference_header = header
        if reference_footer is None and footer:
            reference_footer = footer

        depth = len(html_path.relative_to(SOURCE_ROOT).parts) - 1
        title = extract_title(raw)
        head_extra = extract_head_scripts_and_links(raw)
        main = extract_main_content(raw, header, footer)

        head_extra = convert_internal_links(head_extra)
        head_extra = convert_asset_urls(head_extra)
        main = convert_internal_links(main)
        main = convert_asset_urls(main)

        view_name, url_path = slugify_route(rel)
        pages.append(
            {
                "source": rel,
                "view": view_name,
                "url": url_path,
                "title": title,
                "head_extra": head_extra,
                "content": main,
            }
        )

    if reference_header is None or reference_footer is None:
        raise RuntimeError("Could not extract reference header/footer from source HTML.")

    reference_header = convert_internal_links(reference_header)
    reference_header = convert_asset_urls(reference_header)
    reference_footer = convert_internal_links(reference_footer)
    reference_footer = convert_asset_urls(reference_footer)

    write_layouts(reference_header, reference_footer)
    pages = dedupe_pages(pages)
    write_views(pages)
    write_routes(pages)
    write_manifest(pages)
    return pages


def write_layouts(header: str, footer: str) -> None:
    LAYOUTS_ROOT.mkdir(parents=True, exist_ok=True)

    (LAYOUTS_ROOT / "app.blade.php").write_text(
        """<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Evri')</title>
    @yield('head')
</head>
<body>
    @include('layouts.partials.header')
    @yield('content')
    @include('layouts.partials.footer')
    @stack('scripts')
</body>
</html>
""",
        encoding="utf-8",
    )

    partials = LAYOUTS_ROOT / "partials"
    partials.mkdir(parents=True, exist_ok=True)
    (partials / "header.blade.php").write_text(header, encoding="utf-8")
    (partials / "footer.blade.php").write_text(footer, encoding="utf-8")


def write_views(pages: list[dict]) -> None:
    print(f"Writing {len(pages)} Blade views...")
    for page in pages:
        view_parts = page["view"].split(".")
        view_dir = PAGES_ROOT.joinpath(*view_parts[1:-1]) if len(view_parts) > 2 else PAGES_ROOT
        view_dir.mkdir(parents=True, exist_ok=True)
        view_file = (view_dir / view_parts[-1]).with_suffix(".blade.php")

        head_section = page["head_extra"]
        blade = f"""@extends('layouts.app')

@section('title', {json.dumps(page['title'])})

@section('head')
{head_section}
@endsection

@section('content')
{page['content']}
@endsection
"""
        view_file.write_text(blade, encoding="utf-8")


def write_routes(pages: list[dict]) -> None:
    print("Writing routes/web.php...")
    lines = [
        "<?php",
        "",
        "use Illuminate\\Support\\Facades\\Route;",
        "",
        "/*",
        "|--------------------------------------------------------------------------",
        "| Evri static site routes (migrated from evri-clone)",
        "|--------------------------------------------------------------------------",
        "*/",
        "",
    ]
    for page in sorted(pages, key=lambda p: (p["url"] != "/", p["url"])):
        view = page["view"].replace("pages.", "")
        view_path = view.replace(".", "/")
        uri = page["url"].lstrip("/")
        if page["url"] == "/":
            lines.append("Route::view('/', 'pages.home');")
        else:
            lines.append(f"Route::view('{uri}', 'pages.{view_path}');")
    lines.append("")
    ROUTES_FILE.write_text("\n".join(lines), encoding="utf-8")


def write_manifest(pages: list[dict]) -> None:
    manifest = LARAVEL_ROOT / "migration-manifest.json"
    manifest.write_text(
        json.dumps(
            [{"source": p["source"], "url": p["url"], "view": p["view"], "title": p["title"]} for p in pages],
            indent=2,
        ),
        encoding="utf-8",
    )


def main() -> None:
    if not SOURCE_ROOT.exists():
        raise SystemExit(f"Source not found: {SOURCE_ROOT}")
    PAGES_ROOT.mkdir(parents=True, exist_ok=True)
    import sys
    skip_assets = "--views-only" in sys.argv
    if not skip_assets:
        copy_assets()
    pages = analyze_and_migrate()
    print(f"Migration complete: {len(pages)} pages.")


if __name__ == "__main__":
    main()
