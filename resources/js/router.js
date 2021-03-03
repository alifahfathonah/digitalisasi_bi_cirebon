import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

const router =  new VueRouter({
  mode: 'history',
  base : APP_BASE ,
  routes : [
    { path : '/', name : 'home', component : require('./home').default, },

    // routing bagian master data
    { path : '/user', name : 'user', component :  require('./masterdata/user').default, },
    { path : '/kendaraan', name : 'kendaraan', component :  require('./masterdata/kendaraan').default, },
    { path : '/ruangan', name : 'ruangan', component :  require('./masterdata/ruangan').default, },

    // Routing proses aplikasi
    { path : '/department', name : 'department', component :  require('./masterdata/department').default, },
    { path : '/atk', name : 'atk', component : require('./aplikasi/module_atk/atk').default, },
    { path : '/cashier', name : 'cashier', component :  require('./aplikasi/cashier/cashier').default, },
    { path : '/kendaraan_dinas', name : 'kendaraan_dinas', component :  require('./aplikasi/kendaraan_dinas/kendaraan_dinas').default, },
    { path : '/kendaraan_keluar', name : 'kendaraan_keluar', component :  require('./aplikasi/kendaraan_dinas/kendaraan_keluar').default, },
    { path : '/kendaraan_masuk', name : 'kendaraan_masuk', component :  require('./aplikasi/kendaraan_dinas/kendaraan_masuk').default, },


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
