import Vue from 'vue';
import VueJSModal from 'vue-js-modal';

window._ = require('lodash');

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Vue.component('flash', require('./components/Flash').default)
Vue.component('reply', require('./components/Reply').default)

window.events = new Vue();

window.flash = function(message) {
    window.events.$emit('flash', message)
}

Vue.use(VueJSModal);

new Vue({
    el: '#app'
});
