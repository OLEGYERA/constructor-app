require('./bootstrap');
window.Vue = require('vue');
Vue.component('slider', require('./components/Slider.vue').default);
Vue.component('slider', require('./Vue/Loader.vue').default)
const app = new Vue({
    el: '#app'
});