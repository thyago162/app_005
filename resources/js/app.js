require('./bootstrap');

window.Vue = require('vue').default;

//-----------------------------------------------------------------------------/
// Vuex
//-----------------------------------------------------------------------------/
import store from './store/store.js';

//-----------------------------------------------------------------------------/
// VUE ROUTER
//-----------------------------------------------------------------------------/
import VueRouter from 'vue-router';
import routes from './routes/routes';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes,
});

//--------------------------------------------------------------------------------/
// BOOTSTRAP
//---------------------------------------------------------------------------------/
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

//----------------------------------------------------------------------------------/
// Sweet Alert
//----------------------------------------------------------------------------------/
import VueSweetalert2 from 'vue-sweetalert2';

import 'sweetalert2/dist/sweetalert2.min.css';

Vue.use(VueSweetalert2);

//-------------------------------------------------------------------------------------/
// AXIOX
//-------------------------------------------------------------------------------------/
import axios from 'axios';
axios.defaults.baseURL = 'http://localhost/'
Vue.prototype.$axios = axios;



/**
 * Import da pagina raiz
 */

 import App from './App.vue';

const app = new Vue({
    el: '#app',
    template: '<app/>',
    router,
    store,
    components: {App}
});
