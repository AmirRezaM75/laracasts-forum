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
        SET_REPLIES(state, replies) {
            state.replies = replies
        },
        ADD_REPLY(state, reply) {
            state.replies.push(reply)
        },
        UPDATE_REPLY(state, {reply, value}) {
            reply['body'] = value
        },
        DELETE_REPLY(state, index) {
            state.replies.splice(index, 1)
        }
    }
})
