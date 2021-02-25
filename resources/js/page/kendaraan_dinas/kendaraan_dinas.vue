<template>
    <div >
      <div class="text-center">
        <router-link :to="{ name: 'kendaraan_keluar' }">
          <el-button type="success" round @click="form = true, kend_keluar = true" icon="el-icon-plus" >Kendaraan Keluar</el-button>
        </router-link>
        <br>
        <br>
        <router-link :to="{ name: 'kendaraan_masuk' }">
          <el-button type="primary" round @click="form = true, kend_masuk = true" icon="el-icon-plus" >Kendaraan Masuk</el-button>
        </router-link>
      </div>

      <!-- <kendaraan_masuk @saveMasuk="kendMasuk"  v-if="kend_masuk == true" />
      <kendaraan_keluar @saveKeluar="kendKeluar"  v-if="kend_keluar == true" /> -->
    </div>
</template>

<script>

export default {
    data() {
        return {
            form:false, sizeForm : {},
            kend_masuk : false, kend_keluar : false
        }
    },
    methods: {
        save(){
            this.fullscreenLoading = true;
            setTimeout(() => {
                this.fullscreenLoading = false;
                this.form = false
            }, 1000);
        },
        kendMasuk(d){

            if(d == 'cancel'){
                this.form = false
                this.kend_masuk = false

                return
            }
            this.form = false
            this.kend_masuk = false
            this.$message({
            message: d,
            type: 'success'
            });
        },
        kendKeluar(d){
            if(d == 'cancel'){
                this.form = false
                this.kend_keluar = false

                return
            }

            this.form = false
            this.kend_keluar = false
            this.$message({
            message: d,
            type: 'success'
            });
        }

    },
}
</script>


<style lang="css" scoped>
    .height-card{
        min-height:calc(100vh - 50px);
    }
</style>
