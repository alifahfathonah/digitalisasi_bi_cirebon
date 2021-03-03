<template>
  <div class="justify-content-center" style="padding:10px; display: flex; flex-wrap: wrap">
      <el-card class="box-card col-md-8 height-card overflow-auto" style="margin-left:10px; margin-right:10px;height: calc(100vh - 20px);">
          <headers />
          <el-menu  v-if="user_id != undefined" default-active="1" background-color="#545c64" text-color="#fff" active-text-color="#ffd04b"
            class="el-menu-demo" mode="horizontal">
            <el-menu-item @click="drawer = true" index="1"><i class="el-icon-menu"></i>  Menu</el-menu-item>
          </el-menu>
          <hr>
          <router-view></router-view>
    </el-card>

    <el-drawer title="Menu" :visible.sync="drawer"  :direction="'ltr'" :with-header="false" size="300px">
      <menus @closeMenu="closeMenu" />
    </el-drawer>
</div>
</template>
<script>
import headers from './components/header'
import menus from './components/menu'

export default {
  components : { headers, menus },
  data(){
    return {
      drawer: false, user_id : AUTH_LOGIN_ID,
    }
  },
  methods : {
    closeMenu(n){
      this.drawer = false
    }
  }
}
</script>
<style>
.el-drawer .el-drawer__body{
  background-color : #cfc5a5 !important;
}


</style>
