<template>
    <div class="container">

        <div class="row justify-content-center">
            <el-card class="box-card col-md-8 height-card overflow-auto" style="margin-left:10px; margin-right:10px;">
                <headers />
                <span @click="drawer = true" > <i class="el-icon-menu"></i> Menu</span>
                <hr>
                <el-row v-if="atk == false">
                    <el-col :span="11" v-for="(o, index) in 2" :key="o" :offset="index > 0 ? 2 : 0">
                        <el-card :body-style="{ padding: '0px' }">
                        <img src="https://ecs7.tokopedia.net/img/cache/700/product-1/2019/11/21/1062800/1062800_6b86720d-ab4f-4088-8588-a538fc1417fb_700_700.jpg" class="image"
                        style="width:100%">
                        <div style="padding: 5px;">
                            <div class="bottom clearfix">
                                Sisa stok bolpen warna tinggal 2 Segera lakukan Re-stok
                            </div>  
                        </div>
                        </el-card>
                    </el-col>
                </el-row>

                <approve_atk v-if="atk == true"  @add="add_atk" />
            </el-card>
        </div>

        <el-drawer
            title="I am the title"
            :visible.sync="drawer"
            :with-header="false"
            size="200px">
             <el-menu default-active="2" class="el-menu-vertical-demo" background-color="#545c64" text-color="#fff" active-text-color="#ffd04b">
                <el-menu-item index="2">
                    <i class="el-icon-menu"></i>
                    <span>Add ATK</span>
                </el-menu-item>
                <el-menu-item index="3">
                    <i class="el-icon-document"></i>
                    <span>List Atk</span>
                </el-menu-item>
                <el-menu-item index="4" @click="approve_atk">
                    <i class="el-icon-setting"></i>
                    <span>Approve ATK</span>
                </el-menu-item>
                </el-menu>
        </el-drawer>
    </div>
</template>

<script>

import approve_atk from './aprove_atk.vue'
import headers from '../components/header'

export default {
    components:{
        approve_atk, headers
    },
    data() {
        return {
           fullscreenLoading :false,
           form :false, input:{},
           list : [],
           drawer: false,
           atk : false
        }
    },
    methods: {

        approve_atk(){
            this.atk = true
            this.drawer = false
        },
        add_atk(d){
            this.atk = false
            this.$message({
            message: 'Aprove ATK Success',
            type: 'success'
            });
        }
    },
}
</script>


<style lang="css" scoped>
    .height-card{
        height:calc(100vh - 50px);
    }
</style>