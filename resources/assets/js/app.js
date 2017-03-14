
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
//Vue.use(VueMaterial);
//import BootstrapVue from 'bootstrap-vue';
// VueGoogleMaps.load({key:'AIzaSyCuKR4wRx7h9q9HMiX83jthBFHqfVdFXzg',libraries:"places"});
// Vue.use(VueGoogleMaps);
// Vue.use(BootstrapVue);
// Vue.component('gmap-map', VueGoogleMaps.Map);
// Vue.component('gmap-marker', VueGoogleMaps.Marker);
Vue.component('home', require('./components/frontend/home.vue'));
// Vue.component('country', require('./components/frontend/country.vue'));
// Vue.component('state', require('./components/frontend/state.vue'));
const app = new Vue({
    el: '#app'
});
