import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);


import Login from './components/auth/Login.vue';
import Register from './components/auth/Register.vue';
import Dashboard from './components/Dashboard.vue';
import NotFound from './components/NotFound.vue';

//Home
import Home from './components/pages/home.vue';
//Profile
import Profile from './components/pages/profile/index.vue';
import Profile_Edit from './components/pages/profile/edit.vue';
//User
import User from './components/pages/users/index.vue';
import User_Create from './components/pages/users/create.vue';
import User_Edit from './components/pages/users/edit.vue';


const router = new VueRouter({
    mode: 'history',
    // base: 'be',
    routes: [
        {
            path: '*',
            component: NotFound
        },
        {
            path: '/be/login',
            name: 'login',
            component: Login
        },
        {
            path: '/be/register',
            name: 'register',
            component: Register
        },
        //Admin
        {
            path: '/be',
            component: Dashboard,
            beforeEnter: (to, form, next) => {
                axios.get('/api/authenticated').then(() => {
                    next();
                }).catch(() => {
                    return next({ name: 'login' });
                });
            },
            children: [
                //Home
                {
                    path: 'home',
                    name: 'home',
                    component: Home,
                },
                //Profile
                {
                    path: 'profile',
                    name: 'profile',
                    component: Profile,
                },
                {
                    path: 'profile/edit/:id',
                    name: 'profile-edit',
                    component: Profile_Edit,
                },
                //User
                {
                    path: 'user',
                    name: 'user',
                    component: User,
                },
                {
                    path: 'user/create',
                    name: 'user-create',
                    component: User_Create,
                },
                {
                    path: 'user/edit/:id',
                    name: 'user-edit',
                    component: User_Edit,
                },

            ]
        },
    ]
})

export default router;