<template>
    <div class="container">
        <div class="row justify-content-center">
            <el-card class="box-card col-md-8 height-card" style="margin-left:10px; margin-right:10px;">
                
                <headers />

                <div v-if="form == false">
                    <el-button type="success" @click="form = true" icon="el-icon-plus" size="small">Buat Nomor Surat</el-button>
                    <hr>
                    <p>Surat Terakhir di buat</p>

                    2021/0001/cn/M.01/B <a href="./surat_keluar/1" target="_blank">Download</a>
                </div>
                
                <div v-if="form == true">
                    <form >
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">Tipe Surat</div>
                            <div class="col-sm-9">
                                <el-select v-model="value" placeholder="Select">
                                    <el-option
                                    v-for="item in options"
                                    :key="item.value"
                                    :label="item.label"
                                    :value="item.value">
                                    </el-option>
                                </el-select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">Bentuk Surat</div>
                            <div class="col-sm-9">
                                <el-select v-model="sizeForm.rubik" placeholder="Select">
                                    <el-option label="M.01" value="M01"></el-option>
                                    <el-option label="M.02" value="m02"></el-option>
                                    <el-option label="Surat" value="surat"></el-option>
                                    <el-option label="SK" value="sk"></el-option>
                                </el-select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 col-from-label">Tanggal</div>
                            <div class="col-sm-9">
                                <el-date-picker type="date" placeholder="Tanggal Surat" v-model="sizeForm.date1" style="width: 100%;"></el-date-picker>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 col-from-label">Kepada</div>
                            <div class="col-sm-9">
                                <el-input v-model="sizeForm.kepada" placeholder="Kepada" size="normal" clearable ></el-input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 col-from-label">Perihal</div>
                            <div class="col-sm-9">
                                <el-input v-model="sizeForm.perihal" placeholder="Perihal" size="normal" clearable ></el-input>
                            </div>
                        </div>
                            <el-button type="primary" @click="save" v-loading.fullscreen.lock="fullscreenLoading">Create</el-button>
                            <el-button @click="form = false">Cancel</el-button>
                    </form>
                </div>
            </el-card>
        </div>
    </div>
</template>

<script>
import headers from '../components/header' 
export default {
    components: { headers },
    data() {
        return {
            form:false, sizeForm : {},
            options: [{
                        value: 'Rahasia',
                        label: 'Rahasia'
                        }, {
                        value: 'Biasa',
                        label: 'Biasa'
                        }], 
            fullscreenLoading:false,
            value:''
        }
    },
    methods: {
        save(){
            this.fullscreenLoading = true;
            setTimeout(() => {
                this.fullscreenLoading = false;
                this.form = false
            }, 1000);
        }
        
    },
}
</script>


<style lang="css" scoped>
    .height-card{
        min-height:calc(100vh - 50px); 
    }
</style>