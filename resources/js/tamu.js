require('./bootstrap');
import Vue from 'vue';

import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/en'
Vue.use(ElementUI, { locale });

import Apps from './tamu_app' ;
import router  from './tamu_router' ;
import store from './store'

const app = new Vue({
    router, store,
    el: '#app',
    render : app=>app(Apps),

});
