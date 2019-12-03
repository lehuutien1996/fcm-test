window._ = require('lodash');

window.$ = window.jQuery = require('jquery');

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const token = $('meta[name="csrf-token"]');

if (token.length) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token[0].content;
}
