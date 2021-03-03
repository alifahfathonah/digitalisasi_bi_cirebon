<template>
  <el-menu class="el-menu-vertical-demo" background-color="#545c64" text-color="#fff" active-text-color="#ffd04b">
    <router-link :to="{ path: '/' }" @click.native="closeMenu">
      <el-menu-item index="1"> <i class="el-icon-s-home"></i> <span>Home</span> </el-menu-item>
    </router-link>
    <router-link :to="{ path: '/atk'}" @click.native="closeMenu">
      <el-menu-item index="2"> <i class="el-icon-menu"></i> <span>Atk</span> </el-menu-item>
    </router-link>
    <router-link :to="{ path: '/cashier'}" @click.native="closeMenu">
      <el-menu-item index="3"> <i class="el-icon-document"></i> <span>Cashier</span> </el-menu-item>
    </router-link>
    <router-link :to="{ path: '/kendaraan_dinas' }" @click.native="closeMenu">
      <el-menu-item index="4"> <i class="el-icon-setting"></i> <span>Kendaraan Dinas</span> </el-menu-item>
    </router-link>
    <el-submenu index="5">
        <template slot="title">
          <i class="el-icon-location"></i>
          <span>Master Data</span>
        </template>
        <router-link :to="{ path: '/user'}" @click.native="closeMenu">
          <el-menu-item index="5-1" > <i class="el-icon-user"></i>  User</el-menu-item>
        </router-link>
        <router-link :to="{ path: '/kendaraan'}" @click.native="closeMenu">
          <el-menu-item index="5-2" > <i class="el-icon-truck"></i> Kendaraan </el-menu-item>
        </router-link>
        <router-link :to="{ path: '/ruangan'}" @click.native="closeMenu">
          <el-menu-item index="5-3" > <i class="el-icon-office-building"></i> Ruangan</el-menu-item>
        </router-link>
        <router-link :to="{ path: '/department'}" @click.native="closeMenu">
          <el-menu-item index="5-4" > <i class="el-icon-folder"></i> Department</el-menu-item>
        </router-link>
      </el-submenu>
  </el-menu>
</template>

<script>
export default {
  methods : {
      closeMenu(){
        this.$emit('closeMenu') ;
      }
  }
}
</script>

<style lang="css" scoped>
</style>
