<template>
  <div>
    <div class="text-center text-danger" v-if="cek == 0">
        <h3>Maaf Link sudah tidak berlaku untuk hari ini, mohon Scan ulang QR Code yang ada di loby Bank Indonesia</h3>
        Terima kasih
    </div>
    <div v-else>
      <el-steps :active="step"  finish-status="success"  align-center>
        <el-step title="Data Diri" icon="el-icon-edit"></el-step>
        <el-step title="Keperluan" icon="el-icon-upload"></el-step>
        <el-step title="Foto" icon="el-icon-picture"></el-step>
      </el-steps>
      <hr>

      <!-- untuk data diri -->
      <div v-if="step == 1 || form_status == true">
        <form>
          <div class="form-group row">
            <div class="col-form-label col-sm-3">No KTP/SIM</div>
            <div class="col-sm-9">
              <el-input placeholder="No KTP / SIM" v-model="input.nik"></el-input>
              <span v-if="err.nik" class="text-danger"> {{ err.nik[0] }}</span>
            </div>
          </div>

          <div v-if="cek_nik == false">
            <div class="form-group row">
              <div class="col-form-label col-sm-3">Nama</div>
              <div class="col-sm-9">
                <el-input placeholder="Nama" v-model="input.nama_tamu"></el-input>
                <span v-if="err.nama_tamu" class="text-danger"> {{ err.nama_tamu[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-form-label col-sm-3">Email</div>
              <div class="col-sm-9">
                <el-input placeholder="Email" v-model="input.email"></el-input>
                <span v-if="err.email" class="text-danger"> {{ err.email[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-form-label col-sm-3">Telp</div>
              <div class="col-sm-9">
                <el-input placeholder="Nomor Telp" v-model="input.no_telp"></el-input>
                <span v-if="err.no_telp" class="text-danger"> {{ err.no_telp[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-form-label col-sm-3">Alamat</div>
              <div class="col-sm-9">
                <el-input placeholder="Alamat" v-model="input.alamat"></el-input>
                <span v-if="err.alamat" class="text-danger"> {{ err.alamat[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-form-label col-sm-3">Photo KTP</div>
              <div class="col-sm-9">
                <el-upload
                :action="url+'/attach_file?id=identitas_tamu'"
                list-type="picture"
                :file-list="fileList"
                :on-preview="handlePictureCardPreview"
                :on-remove="handleRemove"
                :on-success="onSuccess"
                :on-change="handleChange"
                accept="images/*"
                >
                <el-button size="small" type="primary" icon="el-icon-upload">Upload disini</el-button>
              </el-upload>
              <span v-if="err.alamat" class="text-danger"> photo KTP tidak boleh kosong</span>
            </div>
          </div>
          </div>
        </form>
      </div>

      <!-- untuk Keperluan -->
      <div v-if="step == 2">
        <div class="col-md-12 text-center">
          <el-radio-group v-model="input.keperluan">
            <el-radio label="Kas Penukaran Uang">Kas Penukaran Uang</el-radio>
            <el-radio label="Bertemu Pimpinan">Bertemu Pimpinan</el-radio>
            <el-radio label="Lainnya">Lainnya</el-radio>
          </el-radio-group>
        </div>
        <hr>
        <div v-if="input.keperluan == 'Kas Penukaran Uang'">
          <form>
            <div class="form-group row">
              <div class="col-form-label col-sm-3">Keterangan</div>
              <div class="col-sm-9">
                <el-input type="textarea" :rows="4" placeholder="" v-model="input.keterangan" />
                <span v-if="err.nama_tamu" class="text-danger"> {{ err.nama_tamu[0] }}</span>
              </div>
            </div>
          </form>
        </div>
        <div v-if="input.keperluan == 'Bertemu Pimpinan'">
          <form>
            <div class="form-group row">
              <div class="col-form-label col-sm-3">Bertemu dengan</div>
              <div class="col-sm-9">
                <el-input placeholder="Nama" v-model="input.tujuan"></el-input>
                <span v-if="err.tujuan" class="text-danger"> {{ err.tujuan[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-form-label col-sm-3">Keterangan</div>
              <div class="col-sm-9">
                <el-input type="textarea" :rows="4" placeholder="" v-model="input.keterangan" />
                <span v-if="err.keterangan" class="text-danger"> {{ err.keterangan[0] }}</span>
              </div>
            </div>
          </form>
        </div>
        <div v-if="input.keperluan == 'Lainnya'">
          <form>
            <div class="form-group row">
              <div class="col-form-label col-sm-3">Tujuan</div>
              <div class="col-sm-9">
                <el-input placeholder="Nama" v-model="input.tujuan"></el-input>
                <span v-if="err.tujuan" class="text-danger"> {{ err.tujuan[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-form-label col-sm-3">Keterangan</div>
              <div class="col-sm-9">
                <el-input type="textarea" :rows="4" placeholder="" v-model="input.keterangan" />
                <span v-if="err.keterangan" class="text-danger"> {{ err.keterangan[0] }}</span>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div v-if="step == 3">
        <div class="col-sm-9">
          <el-upload
            :action="url+'/attach_file?id=identitas_tamu'"
            list-type="picture"
            :file-list="fileListSelfi"
            :on-remove="handleRemoveSelfi"
            :on-success="onSuccessSelfi"
            :on-change="handleChangeSelfi"
             accept="images/*"
            >
            <el-button size="small" type="primary" icon="el-icon-upload">Upload disini</el-button>
          </el-upload>
        </div>
      </div>
      
      <div class="col-md-12 text-center">
        <br>
        <el-button v-if="(step > 1)" icon="el-icon-d-arrow-left" size="small" @click="prev()" round type="succes"> Kembali </el-button>
        <el-button v-loading.fullscreen.lock="loading" icon="el-icon-d-arrow-right" size="small" @click="step == 3 ? submit() : next(step)" round type="primary"> {{ step == 3 ? 'Submit' : 'Selanjutnya' }} </el-button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['id'] ,
  data(){
    return {
       input:{}, err: [],
       cek:1, url : BASE_URL, step : 1,
       fileList : [],
       fileListSelfi : [],
       cek_nik : true,
       loading : false, form_status : false
    }
  },
  created(){
    this.cek_link()
  },
  methods: {
    next(){
      if(this.step == 1 || this.form_status == true){
          this.cekData()
          return ;
      }
      this.step = this.step + 1
    },
    prev(){
      this.step = this.step - 1
    },
    cekData(){
      axios.post(this.url+'/api/AksiTamu/cekDataTamu', this.input ).then(r => {
          if(r.data.status == false){
            this.cek_nik = false
            this.input.form_status = true
          }else{
            this.step = 2
          }
      })
      .catch(err => {
          this.err = err.response.data.errors;
      })
    },
    submit(){
      this.loading = true
      axios.post(this.url + '/api/AksiTamu', this.input).then(r => {
          this.$router.push({ path: '/dashboard_tamu/'+this.input.nik })
      })
      .catch(err => {
          console.log(err);
      })
      .finally(() => {
        this.loading = false
      })
    },
    cek_link(){
      axios.get(this.url+'/api/AksiTamu/'+this.id).then(r => {
          if (r.data.status == true) {
            this.cek = 1
          }else{
            this.cek = 0
          }
      })
      .catch(e => {
        console.log(err);
      })
    },
    handleRemove(file) {

    },
    handleChange(files, fileList) {
      this.fileList = fileList.slice(-1);
     },
    handlePictureCardPreview(file) {
      this.dialogImageUrl = file.url;
      this.dialogVisible = true;
      alert('muncul')
    },
    onSuccess(response, file){
        this.input.photo = response.file
    },
    handleRemoveSelfi(file) {

    },
    handleChangeSelfi(files, fileListSelfi) {
      this.fileListSelfi = fileListSelfi.slice(-1);
     },
     onSuccessSelfi(response, file){
        this.input.photo_selfi = response.file
    },
    formatTanggal(date) {
      return moment(date).format('DD MMMM YYYY HH:mm');
    },
    closeForm(){
      this.input = {}
      this.err = {}
      this.formDialog = false
    }
  }
}
</script>

<style lang="css" scoped>
</style>
