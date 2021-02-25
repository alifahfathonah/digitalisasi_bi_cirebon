<template >
  <div >
    ini adalah home masa gak bisa berubah
    <i class="el-icon-edit"></i>
    asdkjaskdjas
    <ul>
      <li><router-link :to="{ path: '/'}">Home</router-link></li>
      <li><router-link :to="{ path: '/test'}">test</router-link></li>
    </ul>
    <router-view></router-view>
  </div>
</template>

<script>
export default {
}
</script>

<style lang="css" scoped>
</style>
