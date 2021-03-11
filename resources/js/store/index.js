import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        replies: []
    },
    getters: {
        repliesCount(state) {
            return state.replies.length
        }
    },
    mutations: {
        UPDATE_REPLY(state, {reply, value}) {
            reply['body'] = value
        }
    }
})
