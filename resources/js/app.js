require('./bootstrap');
   
window.Vue = require('vue');
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import store from './store';
import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueAxios, axios);

import { i18n } from './locales.js';

import VueApexCharts from 'vue-apexcharts';
Vue.use(VueApexCharts);
Vue.component('apexchart', VueApexCharts);

import VueNoty from 'vuejs-noty';
import 'vuejs-noty/dist/vuejs-noty.css';
Vue.use(VueNoty, {
    timeout: 4000,
    progressBar: true,
    layout: 'bottomRight'
});

Vue.config.productionTip = false;

const routes = [
    // Auth
    { path: '/', name: 'login', component: require('./components/auth/Login.vue').default, beforeEnter: requireUnAuth },
    { path: '/register', name: 'register', component: require('./components/auth/Register.vue').default, beforeEnter: requireUnAuth },

    // Dashboard
    { path: '/dashboard', name: 'dashboard', component: require('./components/layouts/Dashboard.vue').default, beforeEnter: requireAuth },

    // Mettings
    { path: '/dashboard/meetings', name: 'meetings', component: require('./components/meetings/List.vue').default, beforeEnter: requireAuth },
    { path: '/dashboard/meeting/create', name: 'meeting-create', component: require('./components/meetings/Create.vue').default, beforeEnter: requireAuth },
    { path: '/dashboard/meeting/:id', name: 'meeting-edit', component: require('./components/meetings/Edit.vue').default, beforeEnter: requireAuth },

    // Calls
    { path: '/dashboard/calls', name: 'calls', component: require('./components/calls/List.vue').default, beforeEnter: requireAuth },
    { path: '/dashboard/call/create', name: 'call-create', component: require('./components/calls/Create.vue').default, beforeEnter: requireAuth },
    { path: '/dashboard/call/:id', name: 'call-edit', component: require('./components/calls/Edit.vue').default, beforeEnter: requireAuth },

    // Members
    { path: '/dashboard/members', name: 'members', component: require('./components/members/List.vue').default, beforeEnter: requireAuth },
    { path: '/dashboard/member/meetings/:id', name: 'member-meetings', component: require('./components/members/Meetings.vue').default, beforeEnter: requireAuth },
    { path: '/dashboard/member/calls/:id', name: 'member-calls', component: require('./components/members/Calls.vue').default, beforeEnter: requireAuth },

    // Settings
    { path: '/dashboard/settings', name: 'settings', component: require('./components/settings/appSetting.vue').default, beforeEnter: requireAuth },
    
    // Utility
    { path: '/access-denied', name: 'access-denied', component: require('./components/utility/AccessDenied.vue').default },
    { path: '*', name: 'not-found', component: require('./components/utility/404.vue').default },
]
  

function requireAuth(to, from, next) {
  store.dispatch('fetchAccessToken');
  if (!store.state.accessToken) { next('/'); } 
  else { next(); }
}

function requireUnAuth(to, from, next) {
  store.dispatch('fetchAccessToken');
  if (store.state.accessToken) { next('/dashboard'); } 
  else { next(); }
}

const router = new VueRouter({
  mode: 'history',
  base: '/',
  fallback: true,
  routes 
})

const app = new Vue({
  i18n,
  router
}).$mount('#app')
