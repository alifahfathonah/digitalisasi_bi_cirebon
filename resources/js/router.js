import Vue from 'vue'
import VueRouter from 'vue-router'

import home from './home'
import cashier from './page/cashier/cashier'
import kendaraan_dinas from './page/kendaraan_dinas/kendaraan_dinas'
import kendaraan_keluar from './page/kendaraan_dinas/kendaraan_keluar'
import kendaraan_masuk from './page/kendaraan_dinas/kendaraan_masuk'
import atk from './page/atk'

Vue.use(VueRouter);

const router =  new VueRouter({
  mode: 'history',
  base : 'test' ,
  routes : [
    { path : '/', name : 'home', component : home, },
    { path : '/atk', name : 'atk', component : atk, },
    { path : '/cashier', name : 'cashier', component : cashier, },
    { path : '/kendaraan_dinas', name: 'kendaraan_dinas', component : kendaraan_dinas, },
    { path : '/kendaraan_keluar', name : 'kendaraan_keluar', component : kendaraan_keluar },
    { path : '/kendaraan_masuk', name : 'kendaraan_masuk', component : kendaraan_masuk },
  ]
})

export default router
