/* eslint-disable */
// C0001 = stricly necessary cookies
// C0002 = performance cookies
// C0003 = functional cookies
// C0004 = targeting cookies
const PERFORMANCE_COOKIES_ID = "C0002"

function getCookie(name) {
  const value = "; " + document.cookie
  const parts = value.split("; " + name + "=")
  if (parts.length === 2) return parts.pop().split(";").shift()
}

function insertScript(src) {
  let s
  s = document.createElement("script")
  s.src = src
  document.head.appendChild(s)
}

function insertGtmTag(window, document, script, layer, gtmId) {
  window[layer] = window[layer] || []
  window[layer].push({
    "gtm.start": new Date().getTime(),
    event: "gtm.js",
  })
  var firstScript = document.getElementsByTagName(script)[0]
  var gtmScript = document.createElement(script)
  var datalayer = layer !== "dataLayer" ? "&l=" + layer : ""
  gtmScript.async = true
  gtmScript.src =
    "https://www.googletagmanager.com/gtm.js?id=" + gtmId + datalayer
  if (firstScript && firstScript.parentNode) {
    firstScript.parentNode.insertBefore(gtmScript, firstScript)
  }
}

function insertGtmNoscriptTag() {
  var noscriptTag = document.createElement("noscript")
  var iframeTag = document.createElement("iframe")

  iframeTag.src = "https://www.googletagmanager.com/ns.html?id=GTM-P8NK6Q4"
  iframeTag.height = "0"
  iframeTag.width = "0"
  iframeTag.style.display = "none"
  iframeTag.style.visibility = "hidden"

  noscriptTag.appendChild(iframeTag)

  var bodyTag = document.getElementsByTagName("body")[0]
  if (bodyTag) {
    bodyTag.insertBefore(noscriptTag, bodyTag.firstChild)
  }
}

function insertScriptsAfterConsent() {
  const appmode = getAppModeValue()

  if (appmode === "clean") return

  if (appmode !== "nogtm") {
    insertGtmTag(window, document, "script", "dataLayer", "GTM-P8NK6Q4")
    insertGtmNoscriptTag()
  }

  if (appmode !== "noabtasty") {
    insertScript(window._evri.abTasty)
  }

  insertScript(window._evri.verint)
}

function getAppModeValue() {
  const params = new URLSearchParams(window.location.search)

  return params.get("appmode") ?? localStorage.getItem("appmode")
}
