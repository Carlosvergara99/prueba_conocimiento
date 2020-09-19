
require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
import {routes} from './routes';
Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: routes
});


Vue.component('example-component', require('./components/restaurante/all.vue').default);



const app = new Vue({
    el: '#app',
    router: router
});

