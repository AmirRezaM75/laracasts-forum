import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        replies: [],
        count: 0
    },
    mutations: {
        SET_REPLIES_COUNT(state, number) {
            state.count = number
        },
        SET_REPLIES(state, replies) {
            state.replies = replies
        },
        ADD_REPLY(state, reply) {
            state.replies.push(reply)
            state.count++
        },
        UPDATE_REPLY(state, {reply, value}) {
            reply['body'] = value
        },
        DELETE_REPLY(state, index) {
            state.replies.splice(index, 1)
            state.count--
        }
    }
})