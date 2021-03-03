<template>
    <div>
        <div class="form-group row">
            <div class="col-sm-3 col-form-label">Masukan No Voucer</div>
            <div class="col-sm-9">
                <el-input v-model="input.no_voucer" placeholder="Masukan No Voucer" size="normal" clearable></el-input>
            </div>
        </div>
        <div class="col-sm-12 text-center">
            <el-button type="primary" size="default" @click="list = true">Cek </el-button>
        </div>
            <hr>
            <div v-if="list == true">
                <table class="col-sm-12">
                    <tr>
                        <td>Bolpen </td>
                        <td class="text-right">3</td>
                    </tr>
                    <tr>
                        <td>HVS </td>
                        <td class="text-right">1</td>
                    </tr>
                </table>
                <br>
    
                <el-button type="primary" size="default" @click="save" v-loading.fullscreen.lock="fullscreenLoading">Submit</el-button>
                <el-button type="default" size="default" @click="save" >Cancel</el-button>
                
            </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            input : {}, 
            list : false,
            fullscreenLoading : false
        }
    },
    methods: {
        save(){
            this.fullscreenLoading = true;
            setTimeout(() => {
                this.fullscreenLoading = false;
                this.$emit('add', 'Approve Success')
            }, 1000);
        }
    },
}
</script>