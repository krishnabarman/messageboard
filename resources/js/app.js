/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Form from './form';
window.Form = Form;
import Vue2Editor from "vue2-editor";
Vue.use(Vue2Editor);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('show-categories', require('./components/ShowCategoriesComponent.vue').default);
Vue.component('register-domains', require('./components/RegisterDomainsComponent.vue').default);
Vue.component('show-domains', require('./components/ShowDomainsComponent.vue').default);
Vue.component('show-messages', require('./components/MessageboardComponent.vue').default);

// have set the meta name="user_id" in master blade template which is app.blade, now can access $userId from every vue component if needed
Vue.prototype.$userId = document.querySelector("meta[name='user_id']").getAttribute('content');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});