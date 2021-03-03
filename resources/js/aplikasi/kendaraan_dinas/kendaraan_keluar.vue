<template>
    <div>
      <form >
        <div class="form-group row">
          <div class="col-sm-3 col-form-label">Nama Pengemudi</div>
          <div class="col-sm-9">
            <el-input v-model="input.nama" placeholder="Nama Pengemudi" size="normal" clearable></el-input>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-3 col-form-label">Nomor Kendaraan</div>
          <div class="col-sm-9">
            <el-input v-model="input.nopol" placeholder="Contoh penulisan E 1234 B" size="normal"></el-input>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-3 col-from-label">Penumpang</div>
          <div class="col-sm-9">
            <el-input v-model="input.tujuan" placeholder="isi namabila ada, isi 'None' bila tidak ada" size="normal" clearable ></el-input>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-3 col-from-label">Kilometer Awal</div>
          <div class="col-sm-9">
            <el-input v-model="input.kilometerakhir" placeholder="Kilometer Akhir" size="normal" clearable ></el-input>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-3 col-from-label">Upload Kilometer Awal</div>
          <div class="col-sm-9">
            <br>
            <el-upload
              action="attach_file?id=kendaraan_dinas"
              list-type="picture-card"
              :file-list="fileList"
              :on-success="onProses"
              :on-preview="handlePictureCardPreview"
              :on-change="handleChange"
              :on-remove="handleRemove"
              >
              <i class="el-icon-plus"></i>
            </el-upload>
            <el-dialog :visible.sync="dialogVisible">
              <div>
                <img width="100%" :src="dialogImageUrl" alt="">
              </div>
            </el-dialog>
          </div>
        </div>
        <el-button
          type="text"
          @click="test()"
        >
          cek upload
        </el-button>

        <el-button type="primary" @click="save()" v-loading.fullscreen.lock="fullscreenLoading">Create</el-button>
        <el-button @click="$router.go(-1)">Cancel</el-button>
      </form>
    </div>
</template>


<script>
export default {
    data() {
        return {
            form:false, input : {},
            fullscreenLoading:false,
            dialogImageUrl: '',
            dialogVisible: false,
            disabled: false,
            fileList: [],


        }
    },
    methods: {
      test(){
          if(this.input.gambar_kilometer == null){
            alert('tunggu sampe proses selesai')
          }else{
            alert('upload selesai')
          }
      },
        save(){
            this.fullscreenLoading = true;
            this.input.type = 'Keluar'
            axios.post('AksiKendaraanDinas', this.input).then(res => {
              if(res.data.status == true){
                this.$router.push({ path: '/kendaraan_dinas' })
                this.$message({
                  showClose: true,
                  message: 'Lapor Kendaraan Keluar Success',
                  type: 'success'
                });
              }else{
                this.$message({
                  showClose: true,
                  message: 'Lapor Kendaraan Keluar Gagal',
                  type: 'danger'
                });
              }
              this.fullscreenLoading = false;
            })
            .catch(err => {
                console.log(err);
            })
        },
        cancel(){
            this.$emit('saveKeluar','cancel')
        },
        handleRemove(file) {

        },
        handlePictureCardPreview(file) {
            this.dialogImageUrl = file.url;
            this.dialogVisible = true;
        },
        handleDownload(file) {
            // console.log(file);
        },
        handleChange(file, fileList) {
            this.fileList = fileList.slice(-1);
        },
        onProses(response, file, fileList){
          if(this.input.gambar_kilometer != undefined){
            axios.put('attach_file/kendaraan_dinas', { 'file' : this.input.gambar_kilometer } ).then(res =>  {
              this.input.gambar_kilometer = response.file
            })
            .catch(err => {
              console.log(err);
            })
          }else{
            this.input.gambar_kilometer = response.file
          }
        },
     },
}
</script>
