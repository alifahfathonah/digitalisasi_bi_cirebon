<template>
<div>
  <div v-if="form == false">
    <el-button type="success" @click="form = true" icon="el-icon-plus" size="small">Buat Voucer ATK</el-button>
    <hr>
    <a href="image/logo.png">Download Voucer</a>
  </div>
  <div v-if="form == true">
    <form >
      <div class="form-group row">
        <div class="col-sm-3 col-form-label">Jenis</div>
        <div class="col-sm-9">
          <el-select v-model="input.jenis" placeholder="Select" filterable>
            <el-option label="Pensil" value="Pensil"></el-option>
            <el-option label="1 RIM Kertas" value="1 Rim kertas"></el-option>
            <el-option label="Bolpoin" value="Bolpoin"></el-option>
            <el-option label="Map" value="Map"></el-option>
          </el-select>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-3 col-form-label">Qty</div>
        <div class="col-sm-9">
          <el-input-number v-model="input.qty" placeholder="Banyak" size="normal" clearable ></el-input-number>
        </div>
      </div>
      <el-button @click="add()" round type="primary" icon="el-icon-plus">Add</el-button>
    </form>
    <hr>
    <table class="col-md-12">
      <tr v-for="(l,i) in list" :key="l.jenis">
        <td> {{ l.jenis }} </td>
        <td class="text-right"> {{ l.qty }} |  <el-button size="mini" @click="del_list(i)">X</el-button>
        </td>
      </tr>
    </table>

    <hr>
    <el-button type="primary" @click="save" v-loading.fullscreen.lock="fullscreenLoading">Create</el-button>
    <el-button @click="form = false">Cancel</el-button>
  </div>

</div>

</template>
<script>
import headers from '../components/header'
export default {
    components:{ headers },
    data() {
        return {
           fullscreenLoading :false,
           form :false, input:{},
           list : []
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
        add(){
            this.list.push({
                jenis : this.input.jenis,
                qty : this.input.qty ,
            })

            this.input = {}
        },
        del_list(i){
            this.list.splice(i, 1)
        }

    },
}
</script>


<style lang="css" scoped>
    .height-card{
        height:calc(100vh - 50px);
    }
</style>
