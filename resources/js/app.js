require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';

Vue.use(VueRouter);
Vue.use(Vuex);

Vue.component('app', require('./app.vue').default);

new Vue({
    el: '#app',
});
