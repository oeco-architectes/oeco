import Vue from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';

Vue.component('example-component', ExampleComponent);
new Vue({ el: '.oe-container' }); // eslint-disable-line no-new
