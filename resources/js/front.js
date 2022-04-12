window.Vue = require('vue');

//Importazione di axios
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

//Importazione di Vue Router
import router from './router';

import Vue from 'vue';
import App from './views/App';

const app = new Vue({

    el: '#root',
    render: h => h(App),

    router 

})
