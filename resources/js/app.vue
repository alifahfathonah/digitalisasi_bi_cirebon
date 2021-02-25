<template>
  <div class="row justify-content-center">
      <el-card class="box-card col-md-8 height-card overflow-auto" style="margin-left:10px; margin-right:10px;">
          <headers />
          <span @click="drawer = true" > <i class="el-icon-menu"></i> Menu</span>
          <hr>
          <router-view></router-view>
    </el-card>

    <el-drawer title="Menu" :visible.sync="drawer"  :direction="'ltr'" :with-header="false" size="300px">
      <menus />
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
      drawer: false,
    }
  }
}
</script>
<style>
.el-drawer .el-drawer__body{
  background-color : #cfc5a5 !important;
}
</style>
