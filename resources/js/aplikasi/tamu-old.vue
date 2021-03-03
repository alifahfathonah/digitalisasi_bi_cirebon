<template>
    <div class="container">
        <div class="row justify-content-center ">
            <el-card shadow="always" class="box-card col-md-8 height-card overflow-auto" style="margin-left:10px; margin-right:10px;">   
                <div slot="header" class="clearfix text-center" > 
                <img src="image/logo.png" alt="Logo" height="70px">
                </div>

                <div class="text-center overflow-auto" v-if="home == true">
                    <el-button type="primary" size="default" @click="home = false, tukar_uang = true, opsi_antrian = true">Penukaran Uang</el-button>
                    <hr>
                    <el-button type="danger" size="default" @click="home = false, bertamu = true">Lainnya</el-button>
                </div>


                <div v-if="home == false && tukar_uang == true">
                        <div class="col-md-12 text-center" v-if="no_antrian == true">
                            No. Antrian
                            <br>
                            <h1>001</h1>
                        </div>
                <el-row class="text-center" v-if="opsi_antrian == true">
                    <el-button type="primary" size="default" @click="antrian_aksi('sudah')">Sudah Punya No Antrian</el-button>
                    <br>
                    <br>
                    <el-button type="danger" size="default" @click="antrian_aksi('belum')">Belum Punya No Antrian</el-button>
                </el-row>
                <div v-if="opsi_antrian == false">
                    <div v-if="antrian == 1">
                        <form >
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label"> No KTP / SIM</div>
                                <div class="col-sm-9">
                                    <el-input v-model="sizeForm.kepada" placeholder="NIP" size="normal" clearable></el-input>
                                </div>
                            </div>
                            <el-button type="primary" @click="save('cek')" v-loading.fullscreen.lock="fullscreenLoading">Cek No Antrian</el-button>
                            <el-button @click="home  = true, bertamu = false, antrian = 0">Cancel</el-button>
                        </form>
                    </div>
                    <div v-if="antrian == 2" >
                        <form>
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label"> Jenis Penukaran</div>
                                <div class="col-sm-9">
                                    <el-select v-model="sizeForm.rubik" placeholder="Select">
                                        <el-option label="Nominal Banyak " value="banyak"></el-option>
                                        <el-option label="Nominal Sedikit" value="sedikit"></el-option>
                                    </el-select>
                                    <el-popover
                                        placement="top-start"
                                        title="Ketentuan"
                                        width="200"
                                        trigger="hover">
                                        <li> Untuk Nominal banyak yaitu uang diatas 100 lembar atau di atas 1 juta, </li>
                                        <li> untuk nomonal sedikit yaitu uang dibawah 100 lembar atau di bawah 1 juta</li>
                                        <el-button slot="reference" circle>i</el-button>
                                    </el-popover>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label"> No KTP / SIM</div>
                                <div class="col-sm-9">
                                    <el-input v-model="sizeForm.ktp" placeholder="NIP" size="normal" clearable ></el-input>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label"> Nama</div>
                                <div class="col-sm-9">
                                    <el-input v-model="sizeForm.nama" placeholder="Nama" size="normal" clearable ></el-input>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label"> Alamat</div>
                                <div class="col-sm-9">
                                    <el-input v-model="sizeForm.alamat" placeholder="Alamat" size="normal" clearable ></el-input>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label"> No telp</div>
                                <div class="col-sm-9">
                                    <el-input v-model="sizeForm.notelp" placeholder="No telp" size="normal" clearable ></el-input>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label"> Upload KTP</div>
                                <div class="col-sm-9">
                                    <el-upload
                                        action="#"
                                        list-type="picture-card"
                                        :auto-upload="false">
                                            <i slot="default" class="el-icon-plus"></i>
                                            <div slot="file" slot-scope="{file}">
                                            <img
                                                class="el-upload-list__item-thumbnail"
                                                :src="file.url" alt=""
                                            >
                                            <span class="el-upload-list__item-actions">
                                                <span
                                                class="el-upload-list__item-preview"
                                                @click="handlePictureCardPreview(file)"
                                                >
                                                <i class="el-icon-zoom-in"></i>
                                                </span>
                                                <span
                                                v-if="!disabled"
                                                class="el-upload-list__item-delete"
                                                @click="handleDownload(file)"
                                                >
                                                <i class="el-icon-download"></i>
                                                </span>
                                                <span
                                                v-if="!disabled"
                                                class="el-upload-list__item-delete"
                                                @click="handleRemove(file)"
                                                >
                                                <i class="el-icon-delete"></i>
                                                </span>
                                            </span>
                                            </div>
                                        </el-upload>
                                </div>
                            </div>
                                <el-button type="primary" @click="save('bertamu')" v-loading.fullscreen.lock="fullscreenLoading">Create</el-button>
                                <el-button @click="home  = true, bertamu = false, antrian = 0">Cancel</el-button>
                        </form>
                    </div>
                </div>
                </div>

                <div v-if="home == false && bertamu == true">
                    <form>
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label"> No KTP / SIM</div>
                                <div class="col-sm-9">
                                    <el-input v-model="sizeForm.ktp" placeholder="NIP" size="normal" clearable ></el-input>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label"> Nama</div>
                                <div class="col-sm-9">
                                    <el-input v-model="sizeForm.nama" placeholder="Nama" size="normal" clearable ></el-input>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label"> Alamat</div>
                                <div class="col-sm-9">
                                    <el-input v-model="sizeForm.alamat" placeholder="Alamat" size="normal" clearable ></el-input>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label"> No telp</div>
                                <div class="col-sm-9">
                                    <el-input v-model="sizeForm.notelp" placeholder="No telp" size="normal" clearable ></el-input>
                                </div>
                            </div>
                            <!--<div class="form-group row">
                                <div class="col-sm-3 col-form-label"> Bertemu Dengan </div>
                                <div class="col-sm-9">
                                    <el-input v-model="sizeForm.notelp" placeholder="Bertemu Dengan" size="normal" clearable ></el-input>
                                </div>
                            </div>-->
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label"> Kepentingan</div>
                                <div class="col-sm-9">
                                    <el-input v-model="sizeForm.notelp" placeholder="Kepentingan" size="normal" clearable ></el-input>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label"> Upload KTP</div>
                                <div class="col-sm-9">
                                    <el-upload
                                        action="#"
                                        list-type="picture-card"
                                        :auto-upload="false">
                                            <i slot="default" class="el-icon-plus"></i>
                                            <div slot="file" slot-scope="{file}">
                                            <img
                                                class="el-upload-list__item-thumbnail"
                                                :src="file.url" alt=""
                                            >
                                            <span class="el-upload-list__item-actions">
                                                <span
                                                class="el-upload-list__item-preview"
                                                @click="handlePictureCardPreview(file)"
                                                >
                                                <i class="el-icon-zoom-in"></i>
                                                </span>
                                                <span
                                                v-if="!disabled"
                                                class="el-upload-list__item-delete"
                                                @click="handleDownload(file)"
                                                >
                                                <i class="el-icon-download"></i>
                                                </span>
                                                <span
                                                v-if="!disabled"
                                                class="el-upload-list__item-delete"
                                                @click="handleRemove(file)"
                                                >
                                                <i class="el-icon-delete"></i>
                                                </span>
                                            </span>
                                            </div>
                                        </el-upload>
                                </div>
                                </div>
                            <el-button type="primary" @click="save('bertamu')" v-loading.fullscreen.lock="fullscreenLoading">Create</el-button>
                            <el-button @click="home  = true, bertamu = false">Cancel</el-button>
                        </form>
                </div>
            </el-card>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            sizeForm : {},
            fullscreenLoading : false,
            home : true, 
            tukar_uang : false, 
            bertamu : false,
            opsi_antrian : true ,
            antrian : 0, 
            no_antrian : false,
            dialogImageUrl: '',
            dialogVisible: false,
            disabled: false
        }
    },
    methods: {
        save(d){
            this.fullscreenLoading = true;
            setTimeout(() => {
                this.fullscreenLoading = false;
                if(d == 'bertamu'){
                    this.home = true
                    this.bertamu = false
                }if(d == 'cek'){
                    this.no_antrian = true
                    this.antrian = 0
                }else{
                    this.home=false
                    this.penukaran_uang = false
                    this.no_antrian = true
                    this.antrian = 0
                }
            }, 1000);
            
        }, 
        antrian_aksi(d){
            if(d == 'sudah'){
                this.antrian = 1
                this.opsi_antrian = false
            }

            if(d == 'belum'){
                this.antrian = 2
                this.opsi_antrian = false
            }

        },
         handleRemove(file) {
            console.log(file);
        },
        handlePictureCardPreview(file) {
            this.dialogImageUrl = file.url;
            this.dialogVisible = true;
        },
        handleDownload(file) {
            console.log(file);
        }
        
    },
}
</script>


<style lang="css" scoped>
    .height-card{
        height:calc(100vh - 50px); 
    }

</style>