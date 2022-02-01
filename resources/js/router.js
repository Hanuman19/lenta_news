import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);


import Home from "./components/Home/home.vue";
import Admin from "./components/Home/admin.vue";
import login from "./components/User/login.vue"
import register from "./components/User/register.vue"

const routes = [
    {
        path: '/',
        component: Home
    },
    {
        path: '/admin',
        component: Admin
    },
    {
        path: '/login',
        component: login
    },
    {
        path: '/register',
        component: register
    }
];

export default new VueRouter({
    mode:'history',
    routes
});