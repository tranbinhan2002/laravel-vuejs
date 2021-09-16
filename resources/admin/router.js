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
//Category
import Category from './components/pages/categories/index.vue';
import Category_Create from './components/pages/categories/create.vue';
import Category_Edit from './components/pages/categories/edit.vue';
//Product
import Product from './components/pages/products/index.vue';
import Product_Create from './components/pages/products/create.vue';
import Product_Edit from './components/pages/products/edit.vue';

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
                 //Category
                 {
                    path: 'category',
                    name: 'category',
                    component: Category,
                }, 
                {
                    path: 'category/create',
                    name: 'category-create',
                    component: Category_Create,
                },
                {
                    path: 'category/edit/:id',
                    name: 'category-edit',
                    component: Category_Edit
                },
                //Product
                {
                    path: 'product',
                    name: 'product',
                    component: Product,
                },
                {
                    path: 'product/create',
                    name: 'product-create',
                    component: Product_Create,
                },
                {
                    path: 'product/edit/:id',
                    name: 'product-edit',
                    component: Product_Edit
                },  
            ]
        },
    ]
})

export default router;