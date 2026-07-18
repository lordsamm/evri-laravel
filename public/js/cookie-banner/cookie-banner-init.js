if (!isInCrossOriginIframe) {
  const cookieAutoblocker = document.createElement("script")
  cookieAutoblocker.id = "js-cookie-banner-autoblocker"
  cookieAutoblocker.src = window._evri.autoblockerSrc
  document.querySelector("#js-cookie-banner-init").after(cookieAutoblocker)

  const cookieBanner = document.createElement("script")
  cookieBanner.id = "js-cookie-banner"
  cookieBanner.src = window._evri.cookieBannerSrc
  cookieBanner.setAttribute(
    "data-domain-script",
    window._evri.cookieBannerDomainId,
  )

  document.querySelector("#js-cookie-banner-autoblocker").after(cookieBanner)

  const cookieBannerFunction = document.createElement("script")
  document.querySelector("#js-cookie-banner").after(cookieBannerFunction)
}
