// We need to manually check for the OptanonConsent cookie because if this is
// a return visit, OptanonActiveGroups will not be available early in the lifecycle
if (!isInCrossOriginIframe) {
  const optanonCookieVal = getCookie("OptanonConsent")
  const optanonObj = {}
  if (optanonCookieVal) {
    const vals = optanonCookieVal.split("&")
    vals.forEach((val) => {
      const parts = val.split("=")
      optanonObj[parts[0]] = parts[1]
    })

    let decodedObj = {}
    if (optanonObj.groups) {
      let decodedStr = decodeURIComponent(optanonObj.groups)
      decodedStr = decodedStr.replaceAll(",", ',"')
      decodedStr = decodedStr.replaceAll(":", '":')
      decodedObj = JSON.parse(`{"${decodedStr}}`)
    }

    const perfCookiesAcceptedNcb =
      decodedObj[PERFORMANCE_COOKIES_ID] === 1 || false

    if (perfCookiesAcceptedNcb) {
      insertScriptsAfterConsent()
    }
  }
}
