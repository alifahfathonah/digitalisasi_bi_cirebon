<template>
  <el-menu default-active="1" class="el-menu-vertical-demo" background-color="#545c64" text-color="#fff" active-text-color="#ffd04b">
    <router-link :to="{ path: '/' }">
      <el-menu-item index="1"> <i class="el-icon-s-home"></i> <span>Home</span> </el-menu-item>
    </router-link>
    <router-link :to="{ path: '/atk'}">
      <el-menu-item index="2"> <i class="el-icon-menu"></i> <span>Atk</span> </el-menu-item>
    </router-link>
    <router-link :to="{ path: '/cashier'}">
      <el-menu-item index="3"> <i class="el-icon-document"></i> <span>Cashier</span> </el-menu-item>
    </router-link>
    <router-link :to="{ path: '/kendaraan_dinas' }">
      <el-menu-item index="4"> <i class="el-icon-setting"></i> <span>Kendaraan Dinas</span> </el-menu-item>
    </router-link>
  </el-menu>
</template>

<script>
export default {
}
</script>

<style lang="css" scoped>
</style>
