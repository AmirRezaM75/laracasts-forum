import Vue from 'vue'
import VueJSModal from 'vue-js-modal'
import Auth from "./mixins/Auth"
import store from './store'

window.axios = require('axios')

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

window.swal = require('sweetalert')

window.events = new Vue()

window.flash = (message, level = 'primary') => { window.events.$emit('flash', { message, level }) }

Vue.component('notification', require('./components/Notification').default)
Vue.component('paginator', require('./components/Paginator').default)
Vue.component('flash', require('./components/Flash').default)
Vue.component('avatar-form', require('./components/AvatarForm').default)
Vue.component('user-account-form', require('./components/UserAccountForm').default)
Vue.component('user-profile-form', require('./components/UserProfileForm').default)
Vue.component('auth-modal', require('./components/AuthModal').default)
Vue.component('thread-view', require('./views/Thread').default)
Vue.component('threads-view', require('./views/Threads').default)

Vue.use(VueJSModal, { dynamic: true });

Vue.mixin(Auth);

new Vue({
    el: '#app',
    store
});
