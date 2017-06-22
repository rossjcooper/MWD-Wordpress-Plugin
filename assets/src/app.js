import Vue from 'vue'
import App from './components/App.vue'
//Include VueResource out the box for making HTTP requests.
var VueResource = require('vue-resource');

Vue.use(VueResource);

window.onload = function () {
    var app = new Vue({
        el: '#app',
        render: h => h(App)
    });
}