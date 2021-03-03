<template>
  <div class="col-md-12">
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/' }">Home</el-breadcrumb-item>
      <el-breadcrumb-item>Master Data</el-breadcrumb-item>
      <el-breadcrumb-item>Department</el-breadcrumb-item>
    </el-breadcrumb>
    <br>
    <!-- untuk index -->
    <div class="row ">
      <div class="col-md-6">
        <el-button  :style="windowWidth < 768 ? 'margin-bottom: 10px;' : ''" type="primary" size="small"
          round icon="el-icon-plus" @click="formDialog =  true"> Tambah Department</el-button>
      </div>
      <div class="col-md-6">
        <el-input placeholder="Search" clearable round v-model="search" @change="listData()">
           <el-button slot="append" icon="el-icon-search" @click="listData()"></el-button>
        </el-input>
      </div>
    </div>
    <br>


    <div>
      <el-table :data="data.data" style="width: 100%"  @sort-change="sortChange" :default-sort="{prop: sort, order: order}"
      @filter-change="(f) => { let c = Object.keys(f)[0]; filters[c] = Object.values(f[c]); page = 1; listData(); }">
        <el-table-column prop="nama_department" sortable label="Department"> </el-table-column>
        <el-table-column prop="kode_department" sortable label="Kode"> </el-table-column>
        <el-table-column prop="leader" sortable label="Leader" align="center">
            <template slot-scope="scope">
                <div v-if="scope.row.leader == null || scope.row.leader ==  undefined">
                  belum ada leader
                </div>
                <div v-else>
                  {{ User.find(u => u.id == scope.row.leader).name  }}
                </div>
            </template>
        </el-table-column>
        <el-table-column prop="status" sortable label="Status" align="center"> </el-table-column>
        <el-table-column prop="created_at" sortable label="Tanggal Input">
          <template slot-scope="scope">
            {{ formatTanggal(scope.row.created_at) }}
          </template>
        </el-table-column>
        <el-table-column label="#" fixed="right" width="100">
          <template slot-scope="scope">
              <el-button @click="deleted(scope.row.id)" type="danger" icon="el-icon-delete" size="mini" circle></el-button>
              <el-button @click="edit(scope.row)" type="success" icon="el-icon-edit" size="mini" circle></el-button>
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
    <el-dialog title="Department" :visible.sync="formDialog" :before-close="closeForm" :width="windowWidth < 768 ? '90%' : '50%'" >
      <div>
        <form>
          <div class="form-group row">
            <div class="col-form-label col-sm-3">Nama Department</div>
            <div class="col-sm-9">
                <el-input placeholder="Nama Department" v-model="input.nama_department"></el-input>
                <span v-if="err.nama_department" class="text-danger"> {{ err.nama_department[0] }}</span>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-form-label col-sm-3">Kode Department </div>
            <div class="col-sm-9">
              <el-input placeholder="Kode Department" v-model="input.kode_department"></el-input>
              <span v-if="err.kode_department" class="text-danger"> {{ err.kode_department[0] }}</span>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-form-label col-sm-3">leader </div>
            <div class="col-sm-9">
              <el-select v-model="input.leader" filterable clearable placeholder="Pimpinan / Leader Department" style="width:100%" >
                <el-option v-for="(item,i) in User" :key="item.id" :label="item.name+' - '+ item.nik" :value="item.id" />
              </el-select>
              <span v-if="err.leader" class="text-danger"> {{ err.leader[0] }}</span>
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
      User() { return this.$store.state.User } ,
  },
  created() {
      this.$store.commit('getUser');
  },
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
      moment:moment,
      item : {}
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
        axios.get('AksiDepartment', { params: Object.assign(params) }).then(res => {
            this.data = res.data
        })
        .catch(err => {
          console.log(err);
        })
    },
    save(){
        this.loading = true;
        axios.post('AksiDepartment', this.input).then(res => {
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
        axios.put('AksiDepartment/'+this.input.id , this.input).then(res => {
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
            axios.delete('AksiDepartment/'+d).then(r => {
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
