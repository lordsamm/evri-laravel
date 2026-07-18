/* eslint-disable */
let isInCrossOriginIframe

try {
  isInCrossOriginIframe = window.location.host !== window.parent.location.host
} catch {
  isInCrossOriginIframe = true
}
