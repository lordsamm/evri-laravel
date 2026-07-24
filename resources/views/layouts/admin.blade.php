<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') — Evri Shipments</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            margin: 0;
            background: #f4f6f8;
            color: #1a1a1a;
            line-height: 1.5;
        }
        .admin-header {
            background: #007a53;
            color: #fff;
            padding: 1rem 1.5rem;
        }
        .admin-header h1 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
        }
        .admin-header a {
            color: #fff;
            text-decoration: none;
        }
        .admin-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 1.5rem;
        }
        .admin-nav {
            margin-top: 0.5rem;
        }
        .admin-nav a {
            color: #d7f5ea;
            margin-right: 1rem;
            text-decoration: none;
            font-size: 0.95rem;
        }
        .admin-nav a:hover { text-decoration: underline; }
        .card {
            background: #fff;
            border: 1px solid #dde3ea;
            border-radius: 8px;
            padding: 1.25rem;
        }
        .alert {
            padding: 0.75rem 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
        }
        .alert-success {
            background: #e8f7ef;
            border: 1px solid #b8e6cc;
            color: #145c38;
        }
        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            border: 1px solid transparent;
            text-decoration: none;
            font-size: 0.95rem;
            cursor: pointer;
        }
        .btn-primary {
            background: #007a53;
            color: #fff;
        }
        .btn-secondary {
            background: #fff;
            color: #333;
            border-color: #ccd4dc;
        }
        .btn + .btn { margin-left: 0.5rem; }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            text-align: left;
            padding: 0.75rem;
            border-bottom: 1px solid #e8edf2;
            vertical-align: top;
        }
        th {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            color: #5a6570;
        }
        .form-group { margin-bottom: 1rem; }
        label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.35rem;
        }
        input, select {
            width: 100%;
            max-width: 480px;
            padding: 0.55rem 0.65rem;
            border: 1px solid #ccd4dc;
            border-radius: 6px;
            font: inherit;
        }
        .help-text {
            font-size: 0.875rem;
            color: #5a6570;
            margin-top: 0.25rem;
        }
        .error-text {
            color: #b42318;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            gap: 1rem;
        }
        .page-header h2 {
            margin: 0;
            font-size: 1.5rem;
        }
        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem;
        }
        .detail-item strong {
            display: block;
            font-size: 0.85rem;
            color: #5a6570;
            margin-bottom: 0.25rem;
        }
    </style>
</head>
<body>
    <header class="admin-header">
        <h1><a href="{{ route('admin.shipments.index') }}">Evri Admin — Shipments</a></h1>
        <nav class="admin-nav">
            <a href="{{ route('admin.shipments.index') }}">All Shipments</a>
            <a href="{{ route('admin.shipments.create') }}">Create Shipment</a>
            <a href="{{ route('admin.countries.index') }}">Countries</a>
            <a href="{{ route('admin.payment-proofs.index') }}">Payment Proofs</a>
            <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; border: none; color: #fff; cursor: pointer; font-size: 0.95rem;">Logout</button>
            </form>
        </nav>
    </header>

    <main class="admin-container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>
</body>
</html>
