import images from './modules/images'

/* Polyfill for IE11 */
/* https://developer.mozilla.org/en-US/docs/Web/API/CustomEvent/CustomEvent */
(function () {
  if (typeof window.CustomEvent === 'function') return false

  function CustomEvent (event, params) {
    params = params || { bubbles: false, cancelable: false, detail: undefined }
    const evt = document.createEvent('CustomEvent')
    evt.initCustomEvent(event, params.bubbles, params.cancelable,
      params.detail)
    return evt
  }

  CustomEvent.prototype = window.Event.prototype
  window.CustomEvent = CustomEvent
})();