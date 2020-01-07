import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import Login from '../components/login/Login/Login'
import SignUp from "../components/login/SignUp/SignUp";
import Forum from "../components/Forum/Forum";
import Logout from "../components/login/Logout";
import Read from "../components/Read";
import Create from "../components/Forum/Create";
import Category from "../components/Category/Category";

const routes = [
    { path: '/login', component: Login },
    { path: '/logout', component: Logout},
    { path: '/signup',component: SignUp},
    { path: '/forum' ,name:'forum',component:Forum},
    { path: '/question/:slug' ,name:'read' , component:Read },
    { path: '/ask', component:Create},
    { path: '/category' , component:Category}
]

const router = new VueRouter({
    routes, // short for `routes: routes`
    hashbang:false,
    mode:'history'
})

export default router