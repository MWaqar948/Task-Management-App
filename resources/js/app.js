import './bootstrap';

import {createApp} from 'vue';
import App from './components/App.vue';
import { createRouter, createWebHistory } from 'vue-router'

import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from './routes';
 
const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: routes
});


const app = createApp(App);

// app.use(createPinia())
app.use(router);
app.use(VueAxios, axios);

app.mount('#app')
