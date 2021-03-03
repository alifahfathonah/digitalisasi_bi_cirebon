<template>
  <div class="col-md-12">
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/' }">Home</el-breadcrumb-item>
      <el-breadcrumb-item>Master Data</el-breadcrumb-item>
      <el-breadcrumb-item>Ruangan</el-breadcrumb-item>
    </el-breadcrumb>
    <br>
    <!-- untuk index -->
    <div class="row ">
      <div class="col-md-6">
        <el-button  :style="windowWidth < 768 ? 'margin-bottom: 10px;' : ''" type="primary" size="small" round icon="el-icon-plus" @click="formDialog =  true"> Tambah Ruangan</el-button>
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
        <el-table-column prop="nama_ruangan" sortable label="Nama Ruangan" width="200"> </el-table-column>
        <el-table-column prop="kapasistas" sortable label="Kapasitas" width="150"> </el-table-column>
        <el-table-column prop="photo" sortable label="Photo" align="center">
          <template slot-scope="scope">
              <img :src="scope.row.photo == null ? 'image/no-image.png' : 'uploads/ruangan/'+ scope.row.photo" :alt="'photo'+ scope.row.nama_ruangan " style="height:100px;">
          </template>
        </el-table-column>
        <el-table-column prop="created_at" sortable label="Tanggal Input" width="150">
          <template slot-scope="scope">
            {{ formatTanggal(scope.row.created_at) }}
          </template>
        </el-table-column>
        <el-table-column label="#" fixed="right" width="40">
          <template slot-scope="scope">
            <el-dropdown>
              <span class="el-dropdown-link">
                <i class="el-icon-arrow-down el-icon--right"></i>
              </span>
              <el-dropdown-menu slot="dropdown">
                <el-dropdown-item><el-button alt="Hapus Data" @click="deleted(scope.row.id)" type="danger" icon="el-icon-delete" size="mini" circle> </el-button> Hapus</el-dropdown-item>
                <el-dropdown-item><el-button alt="Edit Data" @click="edit(scope.row)" type="success" icon="el-icon-edit" size="mini" circle> </el-button> Edit</el-dropdown-item>
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
    <el-dialog title="Ruangan" :visible.sync="formDialog" :before-close="closeForm" :width="windowWidth < 768 ? '90%' : '50%'" >
      <div>
        <form>
          <div class="form-group row">
            <div class="col-form-label col-sm-3">Ruangan</div>
            <div class="col-sm-9">
                <el-input placeholder="Nama Ruangan" v-model="input.nama_ruangan"></el-input>
                <span v-if="err.nama_ruangan" class="text-danger"> {{ err.nama_ruangan[0] }}</span>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-form-label col-sm-3">Kapasitas </div>
            <div class="col-sm-9">
              <el-input placeholder="Tipe" v-model="input.kapasistas"></el-input>
              <span v-if="err.kapasistas" class="text-danger"> {{ err.kapasistas[0] }}</span>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-form-label col-sm-3">Photo Ruangan</div>
            <div class="col-sm-9">
              <el-upload
                action="attach_file?id=ruangan"
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
  data(){
    return {
      data : [],
      formDialog: false,
      input : {},
      err : [],
      fileList : [],
      windowWidth : window.innerWidth,
      loading : false,
      url : BASE_URL,
      sort: 'id',
      order: 'descending',
      page: 1,
      pageSize: 5,
      search:'',
      moment:moment
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
        axios.get('AksiRuangan', { params: Object.assign(params) }).then(res => {
            this.data = res.data
        })
        .catch(err => {
          console.log(err);
        })
    },
    save(){
        this.loading = true;
        axios.post('AksiRuangan', this.input).then(res => {
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
        axios.put('AksiRuangan/'+this.input.id , this.input).then(res => {
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
          console.log(err);
        })
        .finally(() => {
          this.loading = false
        })
    },
    deleted(d){
        this.$confirm('Apa Anda yakin ingin menghapus data ini', 'Hapus data', {
          confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning', }).then(() => {
            this.loading =  true
            axios.delete('AksiRuangan/'+d).then(r => {
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
