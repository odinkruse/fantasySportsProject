require('./bootstrap');
import Vue from 'vue';
import axios from 'axios'
Vue.prototype.$http = axios;
import App from '../vue/app.vue';


new Vue({
    el: '#app',
    components: {
        app: App
    }
});