import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        user: window.App.user,
        thread: {},
        replies: [],
        categories: [],
        replies_count: 0
    },
    mutations: {
        SET_CATEGORIES(state, categories) {
            state.categories = categories
        },
        SET_THREAD(state, thread) {
            state.thread = thread
        },
        SET_REPLIES_COUNT(state, number) {
            state.replies_count = number
        },
        SET_REPLIES(state, replies) {
            state.replies = replies
        },
        ADD_REPLY(state, { parentId, reply }) {
            if (parentId) {
                let parentIndex = state.replies.findIndex(reply => reply.id === parentId)
                state.replies[parentIndex].responses.push(reply)
            } else
                state.replies.push(reply)

            state.replies_count++
        },
        UPDATE_REPLY(state, {reply, value}) {
            reply['body'] = value
        },
        UPDATE_THREAD(state, {thread, object}) {
            thread['body'] = object['body']
            thread['title'] = object['title']
        },
        DELETE_REPLY(state, { parentIndex, targetIndex }) {
            parentIndex === null
                ? state.replies.splice(targetIndex, 1)
                : state.replies[parentIndex].responses.splice(targetIndex, 1)

            state.replies_count--
        },
        LOCK_THREAD(state, status = true) {
            state.thread['locked'] = status
        },
        UPDATE_USER_AVATAR(state, path) {
            state.user['avatar'] = path
        }
    }
})
