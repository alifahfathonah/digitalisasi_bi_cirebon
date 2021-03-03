<template>
  <div class="row justify-content-center">
    <el-card class="box-card col-md-8 height-card overflow-auto" style="margin-top: 10px; margin-left:10px; margin-right:10px;height: calc(100vh - 50px);">
        <headers />
        <hr>
        <router-view></router-view>
  </el-card>
  </div>
</template>

<script>
import headers from './components/header'
export default {
  components : {
    headers
  }
}
</script>

<style >
  .row{
    margin-left: 0px !important;
    margin-right: 0px !important;
  }
</style>
