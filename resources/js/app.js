import Vue from 'vue';

window._ = require('lodash');

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Vue.component('flash', require('./components/Flash').default)

window.events = new Vue();

window.flash = function(message) {
    window.events.$emit('flash', message)
}

new Vue({
    el: '#app'
});
