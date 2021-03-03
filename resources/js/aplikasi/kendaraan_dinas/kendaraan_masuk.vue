<template>
    <div>
                    <form >
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">Nama Pengemudi</div>
                            <div class="col-sm-9">
                                <el-input v-model="sizeForm.nama" placeholder="Nama Pengemudi" size="normal" clearable></el-input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">Nomor Kendaraan</div>
                            <div class="col-sm-9">
                                <el-input v-model="sizeForm.nopol" placeholder="Contoh penulisan E 1234 B" size="normal"></el-input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 col-from-label">Tujuan</div>
                            <div class="col-sm-9">
                               <el-input v-model="sizeForm.tujuan" placeholder="Tujuan" size="normal" clearable ></el-input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 col-from-label">Penugasan</div>
                            <div class="col-sm-9">
                               <el-select v-model="sizeForm.rubik" placeholder="Select">
                                    <el-option label="Dalam Kota" value="M01"></el-option>
                                    <el-option label="Luar Kota" value="m02"></el-option>
                                </el-select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 col-from-label">Menginap</div>
                            <div class="col-sm-9">
                               <el-select v-model="sizeForm.menginap" placeholder="Select">
                                    <el-option label="Menginap" value="1"></el-option>
                                    <el-option label="Tidak Menginap" value="2"></el-option>
                                </el-select>
                            </div>
                        </div>
                        <div class="form-group row" v-if="sizeForm.menginap == 1">
                            <div class="col-sm-3 col-from-label">Lama Menginap</div>
                            <div class="col-sm-9">
                                <el-input-number v-model="sizeForm.day" placeholder="Jumlah Hari Menginap" size="normal" clearable ></el-input-number>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 col-from-label">Pembayaran Uang Penugasan</div>
                            <div class="col-sm-9">
                                 <el-select v-model="sizeForm.pembayaran" placeholder="Select">
                                    <el-option label="Ya/Sudah" value="1"></el-option>
                                    <el-option label="Tidak/Belum" value="2"></el-option>
                                </el-select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 col-from-label">Kilometer Akhir</div>
                            <div class="col-sm-9">
                                <el-input v-model="sizeForm.kilometerakhir" placeholder="Kilometer Akhir" size="normal" clearable ></el-input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 col-from-label">Upload Kilometer Akhir</div>
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
                        <div class="form-group row">
                            <div class="col-sm-3 col-from-label">Pengisian BBM</div>
                            <div class="col-sm-9">
                                <el-select v-model="sizeForm.bbm" placeholder="Select">
                                    <el-option label="Ya" value="1"></el-option>
                                    <el-option label="Tidak" value="2"></el-option>
                                </el-select>
                            </div>
                        </div>
                            <el-button type="primary" @click="save" v-loading.fullscreen.lock="fullscreenLoading">Create</el-button>
                            <el-button @click="$router.go(-1)">Cancel</el-button>
                    </form>
    </div>
</template>


<script>
export default {
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
            value:'',
            dialogImageUrl: '',
            dialogVisible: false,
            disabled: false
        }
    },
    methods: {
        save(){
            this.fullscreenLoading = true;
            setTimeout(() => {
                this.fullscreenLoading = false;
                this.$emit('saveMasuk','Success Save Kendaraan Masuk')
            }, 1000);
        },
        cancel(){
            this.$emit('saveMasuk','cancel')
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
