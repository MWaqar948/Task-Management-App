import './bootstrap';

import {createApp} from 'vue';
import App from './layouts/App.vue';
import { createRouter, createWebHistory } from 'vue-router'

import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from './routes';
import store from './store';
 
const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: routes
});

// handles protected pages
router.beforeEach((to, from) => {
    if(to.meta.requiresAuth && !localStorage.getItem('token')){
        return { name: 'Login' };
    }
    if(to.meta.requiresAuth  === false && localStorage.getItem('token')){
        return { name: 'Home' };
    }
});

// handles unauthorized access errors
axios.interceptors.response.use(
    (response) => response,
    (error) => {
      if (error.response) {
        if (error.response.status === 401) {
          // Redirect to logout page
          router.push('/logout');
        } else {
          // Show a generic error message
          console.log('An error occurred. Please try again later.')
        }
      }
      return Promise.reject(error)
    },
);


const app = createApp(App);

app.use(store);
app.use(router);
app.use(VueAxios, axios);

app.mount('#app')
