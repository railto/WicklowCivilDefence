require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';

import routes from './routes';
import auth from './store/auth';

Vue.use(VueRouter);
Vue.use(Vuex);
Vue.prototype.$appName = window.AppName;

Vue.component('app', require('./app.vue').default);

const store = new Vuex.Store({
    modules: {
        auth,
    },
});

const isAuthenticated = store.getters["auth/authenticated"];

const router = new VueRouter({
    mode: 'history',
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        if (!isAuthenticated) {
            next({
                path: '/login',
                query: {
                    redirect: to.fullPath,
                },
            });
        } else {
            next();
        }
    } else {
        next();
    }
});

store.dispatch('auth/me').then(() => {
    new Vue({
        el: '#app',
        router,
        store,
    });
});
