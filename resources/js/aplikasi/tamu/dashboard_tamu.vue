<template>
  <div >
      ini adalah halaman tamu dashboard
      {{ nik }}
  </div>
</template>

<script>
export default {
  props: ['nik'],
  data(){
    return{

    }
  },
  mounted(){
    this.getData() ;
  },
  methods: {
    getData(){
      
    }
  }
}
</script>

<style lang="css" scoped>
</style>
