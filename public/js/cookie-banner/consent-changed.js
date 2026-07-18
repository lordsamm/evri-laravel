/* eslint-disable */
if (!isInCrossOriginIframe) {
  function OptanonWrapper() {
    if (
      OneTrust &&
      window.location.pathname === "/slice-simulator" ||
      window.location.search.includes("rejectcookies")
    ) {
      OneTrust.RejectAll()
    }else if (
      OneTrust &&
      window.location.search.includes("acceptcookies")
    ) {
      OneTrust.AllowAll()
    }

    OneTrust.OnConsentChanged((e) => {
      if (e.detail.includes(PERFORMANCE_COOKIES_ID)) {
        insertScriptsAfterConsent()
      }
    })
  }
}
