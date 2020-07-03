/**
 * Imports
 */
const turbolinks = require("turbolinks");
import 'alpinejs'
import ClipboardJS from "clipboard"
import './alpine-functions'

/**
 * Setup Turbolinks
 */
turbolinks.start();

/**
 * Init ClipboardJS because Cmd+V is not friendly enough
 */
document.addEventListener("turbolinks:load", function () {
    new ClipboardJS('.copy-btn')
})

/**
 * Remove alerts by clicking on it
 */
window.removeAlert = () => {
    document.querySelector('#alert').remove()
}

/**
 * Check if we can close the edit pannel or not
 *
 * @param id
 */
window.closeEdit = ($el, $event) => {
    if (!$el || !$event) return;

    if (!$el.querySelector('textarea').value || $el.querySelector('textarea').value === '') {
        $event.preventDefault();
    } else {
        $el.setAttribute('x-data', JSON.stringify({edit: false}))
    }
}
