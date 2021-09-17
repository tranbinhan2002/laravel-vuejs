import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);


import Login from './components/auth/Login.vue';
import Register from './components/auth/Register.vue';
import Dashboard from './components/Dashboard.vue';
import NotFound from './components/NotFound.vue';

//Home
import Home from './components/pages/home.vue';
//Cart
import Cart from './components/pages/cart.vue';
//Oder
import Order from './components/pages/order.vue';

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
        //Frontend
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
                 //Cart
                 {
                    path: '/cart',
                    name: 'cart',
                    component: Cart,
                },
                 //Oder
                 {
                    path: '/order',
                    name: 'order',
                    component: Order,
                },
            ]
        },
    ]
})

export default router;