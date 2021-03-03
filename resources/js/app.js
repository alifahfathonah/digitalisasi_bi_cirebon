require('./bootstrap');
import Vue from 'vue';

import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/en'
Vue.use(ElementUI, { locale });

import Apps from './app.vue' ;
import router  from './router' ;
import store from './store'

const app = new Vue({
    router, store,
    el: '#app',
    render : app=>app(Apps),

});
