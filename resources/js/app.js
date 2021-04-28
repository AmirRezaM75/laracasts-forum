import Vue from 'vue'
import VueJSModal from 'vue-js-modal'
import Auth from "./mixins/Auth"
import store from './store'
import dayjs from "dayjs";

let relativeTime = require('dayjs/plugin/relativeTime')
dayjs.extend(relativeTime)

window.axios = require('axios')

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

window.swal = require('sweetalert')

window.events = new Vue()

window.flash = (message, level = 'primary') => { window.events.$emit('flash', { message, level }) }

Vue.component('paginator', require('./components/Paginator').default)
Vue.component('flash', require('./components/Flash').default)
Vue.component('avatar-form', require('./components/AvatarForm').default)
Vue.component('loader', require('./components/Loader').default)
Vue.component('auth-modal', require('./components/AuthModal').default)
Vue.component('conversation-modal', require('./components/ConversationModal').default)
Vue.component('account-slideout-menu', require('./components/AccountSlideoutMenu').default)
Vue.component('thread-view', require('./views/Thread').default)
Vue.component('threads-view', require('./views/Threads').default)
Vue.component('settings-view', require('./views/Settings').default)

Vue.use(VueJSModal)

Vue.mixin(Auth)

Vue.filter('diffForHumans', function(date) {
    return dayjs(date).fromNow()
})

new Vue({
    el: '#app',
    store
});
