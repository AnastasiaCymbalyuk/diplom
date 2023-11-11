/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import {createWebHistory, createRouter} from 'vue-router'
/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
import Admin from './components/admin/Admin.vue';
import User from './components/user/User.vue';
import Seances from './components/user/components/Seances.vue';
import Payment from './components/user/components/Payment.vue';
import Ticket from './components/user/components/Ticket.vue';

const routes = [
  {
    name: 'seances',
    path: '/seances',
    component: Seances
  },
  {
    name: 'payment',
    path: '/payment',
    component: Payment
  },
  {
    name: 'ticket',
    path: '/ticket',
    component: Ticket
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

app.component('example-component', ExampleComponent);
app.component('admin', Admin);
app.component('user', User);
app.component('seances', Seances);
app.component('payment', Payment);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */
app.use(router);
app.mount('#app');
