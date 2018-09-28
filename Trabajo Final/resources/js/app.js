
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

Vue.component('viandas', require('./components/Viandas.vue'));
Vue.component('vianda-form', require('./components/ViandaForm.vue'));

Vue.component('personas', require('./components/Personas.vue'));
Vue.component('persona-form', require('./components/PersonaForm.vue'));

Vue.component('pedidos', require('./components/Pedidos.vue'));
Vue.component('pedido-form', require('./components/PedidoForm.vue'));

import VueBootstrapTypeahead from 'vue-bootstrap-typeahead';

Vue.component('vue-bootstrap-typeahead', VueBootstrapTypeahead);


import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';

Vue.use(BootstrapVue);

Vue.component('paginate', require('vuejs-paginate'));

const app = new Vue({
    el: '#app'
});
