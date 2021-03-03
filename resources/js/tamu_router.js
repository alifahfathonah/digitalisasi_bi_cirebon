import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

const router =  new VueRouter({
  mode: 'history',
  base : APP_BASE+'/api/' ,
  routes : [
    { path : '/', name : 'no_access', component : require('./no_access').default, },
    { path : '/tamu/:id', name : 'tamu', component :  require('./aplikasi/tamu/tamu').default, props: true},
    { path : '/dashboard_tamu/:nik', name : 'dashboard_tamu', component :  require('./aplikasi/tamu/dashboard_tamu').default, props: true},


    //
    // { path : '/tamu', name : 'tamu', component :  require('./aplikasi/tamu/tamu').default, },
    // {
    //     path: '/user',
    //     component: {
    //       template: '<router-view></router-view>'
    //     },
    //     children: [{
    //         path: '',
    //         component: require('./masterdata/User/index').default
    //       },
    //       {
    //         path: 'create',
    //         component: require('./masterdata/User/form').default
    //       },
    //       {
    //         path: ':id/edit',
    //         component: require('./masterdata/User/form').default,
    //         props: true
    //       },
    //     ]
    // },
  ]
})

export default router
