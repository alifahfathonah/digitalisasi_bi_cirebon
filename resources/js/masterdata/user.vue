<template>
  <div class="col-md-12">
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/' }">Home</el-breadcrumb-item>
      <el-breadcrumb-item>Master Data</el-breadcrumb-item>
      <el-breadcrumb-item>User</el-breadcrumb-item>
    </el-breadcrumb>
    <br>
    <!-- untuk index -->
    <div class="row ">
      <div class="col-md-6">
        <el-button  :style="windowWidth < 768 ? 'margin-bottom: 10px;' : ''" type="primary" size="small" round icon="el-icon-plus" @click="formDialog =  true"> Tambah User</el-button>
      </div>
      <div class="col-md-6">
        <el-input placeholder="Search" clearable round v-model="search" @change="listData()">
           <el-button slot="append" icon="el-icon-search" @click="listData()"></el-button>
        </el-input>
      </div>
    </div>
    <br>
    <div :style="windowWidth < 768 ? 'margin-left: -40px; margin-right: -40px':''">
      <el-table :data="data.data" style="width: 100%"  @sort-change="sortChange" :default-sort="{prop: sort, order: order}"
      @filter-change="(f) => { let c = Object.keys(f)[0]; filters[c] = Object.values(f[c]); page = 1; listData(); }">
        <el-table-column prop="name" sortable label="Nama" width="250"> </el-table-column>
        <el-table-column prop="email" sortable label="Email" width="250"> </el-table-column>
        <el-table-column prop="no_telp" sortable label="No Telp" width="150"> </el-table-column>
        <el-table-column prop="photo" sortable label="Photo" align="center">
          <template slot-scope="scope">
              <img :src="scope.row.photo == null ? 'image/no-image.png' : 'uploads/user/'+ scope.row.photo" :alt="'photo'+ scope.row.nama_ruangan " style="height:100px;">
          </template>
        </el-table-column>
        <el-table-column label="#" fixed="right" width="40">
          <template slot-scope="scope">
            <el-dropdown>
              <span class="el-dropdown-link">
                <i class="el-icon-arrow-down el-icon--right"></i>
              </span>
              <el-dropdown-menu slot="dropdown">
                <el-dropdown-item @click.native="deleted(scope.row.id)"><i class="el-icon-delete text-danger"></i> Hapus</el-dropdown-item>
                <el-dropdown-item @click.native="edit(scope.row)"><i class="el-icon-edit text-success"></i> Edit</el-dropdown-item>
              </el-dropdown-menu>
            </el-dropdown>


          </template>
        </el-table-column>
      </el-table>
      <br>
      <br>

      <!-- untuk pagination  -->
      <el-pagination
        background
        @size-change="(s) => { pageSize = s; listData(); }"
        @current-change="(p) => { page = p; listData(); }"
        :page-size="pageSize"
        :page-sizes="[5, 10, 25, 50, 100]"
        layout="prev, pager, next, sizes, total"
        :total="data.total">
      </el-pagination>
    </div>

    <!-- untuk form  -->
    <el-dialog title="User Form" :visible.sync="formDialog" :before-close="closeForm" :width="windowWidth < 768 ? '90%' : '50%'" >
      <div>
        <form>
          <div class="form-group row">
            <div class="col-form-label col-sm-3">Nama</div>
            <div class="col-sm-9">
                <el-input placeholder="Nama" v-model="input.name"></el-input>
                <span v-if="err.name" class="text-danger"> {{ err.name[0] }}</span>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-form-label col-sm-3">Nik</div>
            <div class="col-sm-9">
                <el-input placeholder="Nik (Nomor Induk Karyawan)" v-model="input.nik"></el-input>
                <span v-if="err.nik" class="text-danger"> {{ err.nik[0] }}</span>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-form-label col-sm-3">Department</div>
            <div class="col-sm-9">
                <el-select v-model="input.department_id" placeholder="Department" >
                  <el-option v-for="(item, i) in Departments" :key="item.value" :label="item.nama_department" :value="item.id" />
                </el-select>
                <span v-if="err.nik" class="text-danger"> Department tidak boleh kosong</span>
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
            <div class="col-form-label col-sm-3">Username</div>
            <div class="col-sm-9">
                <el-input placeholder="User Name" v-model="input.username"></el-input>
                <span v-if="err.username" class="text-danger"> {{ err.username[0] }}</span>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-form-label col-sm-3">Password</div>
            <div class="col-sm-9">
                <el-input :placeholder="input.id == undefined ? 'Password' : 'Kosongkan password jika tidak di ganti'" password show-password v-model="input.pass"></el-input>
                <span v-if="err.pass" class="text-danger"> {{ err.pass[0] }}</span>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-form-label col-sm-3">No Telp</div>
            <div class="col-sm-9">
                <el-input placeholder="No Telp" v-model="input.no_telp"></el-input>
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
            <div class="col-form-label col-sm-3">Tempat Lahir</div>
            <div class="col-sm-9">
                <el-input placeholder="Tempat Lahir" v-model="input.templat_lahir"></el-input>
                <span v-if="err.templat_lahir" class="text-danger"> {{ err.templat_lahir[0] }}</span>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-form-label col-sm-3">Tanggal Lahir</div>
            <div class="col-sm-9">
              <el-date-picker v-model="input.tanggal_lahir" type="date" placeholder="Tanggal Lahir" value-format="yyyy-MM-dd" />
              <span v-if="err.tanggal_lahir" class="text-danger"> {{ err.tanggal_lahir[0] }}</span>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-form-label col-sm-3">Photo</div>
            <div class="col-sm-9">
              <el-upload
                action="attach_file?id=user"
                list-type="picture"
                :file-list="fileList"
                :on-preview="handlePictureCardPreview"
                :on-remove="handleRemove"
                :limit="1"
                :on-success="onSuccess"
                :on-exceed="handleExceed"
                >
                <el-button size="small" type="primary" icon="el-icon-upload">Upload Disini</el-button>
              </el-upload>
            </div>
          </div>
        </form>
      </div>
      <span slot="footer" class="dialog-footer">
        <el-button @click="closeForm"> Cancel </el-button>
        <el-button type="primary" @click="input.id == undefined ? save() : update()" v-loading.fullscreen.lock="loading" > {{  input.id == undefined ? 'Save' : 'Update' }} </el-button>
      </span>
    </el-dialog>
  </div>
</template>

<script>

import moment from 'moment'
export default {
  computed: {
      Departments() { return this.$store.state.Department } ,
  },
  created() {
      this.$store.commit('getDepartment');
  },
  data(){
    return {
      data : [], formDialog: false, input : {}, err : [], fileList : [], windowWidth : window.innerWidth, loading : false,
      url : BASE_URL, sort: 'id', order: 'descending', page: 1, pageSize: 5, search:'', moment:moment
    }
  },
  watch:{
      'input.no_pol' : function(){
            this.input.no_pol = this.input.no_pol.toUpperCase()
      }
  },
  mounted(){
    window.addEventListener('resize', () => {
      this.windowWidth = window.innerWidth
    }) ;
    this.listData()
  },
  methods :  {
    sortChange(c) {
      if (c.prop != this.sort || c.order != this.order) {
        this.sort = c.prop; this.order = c.order; this.listData()
      }
    },
    listData(){
        let params = {
          pageSize: this.pageSize,
          page: this.page,
          search : this.search,
          sort: this.sort,
          order: this.order,
        }
        axios.get('AksiUser', { params: Object.assign(params) }).then(res => {
            this.data = res.data
        })
        .catch(err => {
          console.log(err);
        })
    },
    save(){
        this.loading = true;
        axios.post('AksiUser', this.input).then(res => {
            this.err = []
            this.input = {}
            this.formDialog = false
            this.listData()
            this.$message({
              type: 'success',
              message: 'Simpan Kenaraan Succes',
              showClose: false,
            });
        })
        .catch(error => {
          this.err = error.response.data.errors;
        })
        .finally(() => {
           this.loading =  false
        })
    },
    edit(d){
      this.formDialog = true
      const edit = JSON.parse(JSON.stringify(d))
      this.input = edit
    },
    update(){
        this.loading = true;
        axios.put('AksiUser/'+this.input.id , this.input).then(res => {
          this.err = []
          this.input = {}
          this.formDialog = false
          this.listData()
          this.$message({
            type: 'success',
            message: 'Simpan Kenaraan Succes',
            showClose: false,
          });
        })
        .catch(err => {
          this.err = err.response.data.errors;
        })
        .finally(() => {
          this.loading = false
        })
    },
    deleted(d){
        this.$confirm('Apa Anda yakin ingin menghapus data ini', 'Hapus data', {
          confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning', }).then(() => {
            this.loading =  true
            axios.delete('AksiUser/'+d).then(r => {
                this.listData()
                this.$message({
                  type: 'success',
                  message: 'Delete data succes',
                  showClose: false,
                });
            })
            .catch(e => {
              console.log(e);
            })
            .finally(() => {
              this.loading = false
            })
        }).catch(() => {

        });
    },
    handleRemove(file) {

    },
    handleExceed(files, fileList) {
       this.$message.warning(`foto hanya boleh ${files.length}, harap Hapus terlebih dahulu foto terunggah lalu unggah lagi`);
     },
    handlePictureCardPreview(file) {
      this.dialogImageUrl = file.url;
      this.dialogVisible = true;
      alert('muncul')
    },
    onSuccess(response, file){
        this.input.photo = response.file
    },
    formatTanggal(date) {
      return moment(date).format('DD MMMM YYYY');
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
