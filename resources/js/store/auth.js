import axios from 'axios';

export default {
    namespaced: true,
    state: {
        authenticated: false,
        user: null,
    },
    getters: {
        authenticated(state) {
            return state.authenticated;
        },
        user(state) {
            return state.user;
        },
    },
    mutations: {
        SET_AUTHENTICATED(state, value) {
            state.authenticated = value;
        },
        SET_USER(state, data) {
            state.user = data;
        },
    },
    actions: {
        login({dispatch}, credentials) {

            return axios.post('/api/auth/login', credentials).then(() => {
                return dispatch('me');
            }).catch((err) => {
                console.error(err);
            });
        },
        register({dispatch}, form) {
            return axios.post('/api/auth/register', form).then((response) => {
                return true;
            }).catch((error) => {
                console.log(error);
                return false;
            });
        },
        me({commit}) {
            return axios.get('/api/user').then((response) => {
                commit('SET_AUTHENTICATED', true);
                commit('SET_USER', response.data);
            }).catch(() => {
                commit('SET_AUTHENTICATED', false);
                commit('SET_USER', null);
            });
        },
        async logout({dispatch}) {
            await axios.post('/api/auth/logout');

            return dispatch('me');
        },
    },
};
