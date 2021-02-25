require('./bootstrap');
import Vue from 'vue';

import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/en'
Vue.use(ElementUI, { locale });

import Apps from './app.vue' ;
import router  from './router' ;

const app = new Vue({
    router,
    el: '#app',
    render : app=>app(Apps),

});
