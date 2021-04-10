import Vue from 'vue'
import VueJSModal from 'vue-js-modal'
import Auth from "./mixins/Auth"
import store from './store'

window.axios = require('axios')

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

window.events = new Vue()

window.flash = (message, level = 'primary') => { window.events.$emit('flash', { message, level }) }

Vue.component('notification', require('./components/Notification').default)
Vue.component('paginator', require('./components/Paginator').default)
Vue.component('flash', require('./components/Flash').default)
Vue.component('avatar-form', require('./components/AvatarForm').default)
Vue.component('thread', require('./views/Thread').default)
Vue.component('threads', require('./views/Threads').default)

Vue.use(VueJSModal, {
    dynamic: true,
    dynamicDefaults: {
        shiftY: 1,
        'pivot-y': 1,
        width: "800",
        height: "auto",
        adaptive: true,
        'click-to-close': false,
        transition: "modal-slide-up"
    }
});

Vue.mixin(Auth);

new Vue({
    el: '#app',
    store
});
