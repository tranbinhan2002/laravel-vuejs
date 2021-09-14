import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);


import Login from './components/auth/Login.vue';
import Register from './components/auth/Register.vue';
import Dashboard from './components/Dashboard.vue';
import NotFound from './components/NotFound.vue';

//Home
import Home from './components/pages/home.vue';



const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '*',
            component: NotFound
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        //Admin
        {
            path: '/',
            component: Dashboard,
            children: [
                //Home
                {
                    path: '/',
                    name: 'home',
                    component: Home,
                },
            ]
        },
    ]
})

export default router;