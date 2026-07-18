origDescriptor = Object.getOwnPropertyDescriptor(Document.prototype, "cookie")
Object.defineProperty(document, "cookie", {
  get() {
    return origDescriptor.get.call(this)
  },
  set(value) {
    const cookieName = value.split("=")[0]
    let perfCookiesAccepted = false
    const optanonCookieVal = getCookie("OptanonConsent")

    // ECOM-5092
    const badCookies = ["_4c_", "ADRUM", "_ga_NBG5BKM5BW"]

    if (window && window.OptanonActiveGroups) {
      perfCookiesAccepted = window.OptanonActiveGroups.includes(
        PERFORMANCE_COOKIES_ID,
      )
    }

    if (
      badCookies.includes(cookieName) &&
      (!optanonCookieVal || !perfCookiesAccepted)
    ) {
      return
    }

    return origDescriptor.set.call(this, value)
  },
  enumerable: true,
  configurable: true,
})
