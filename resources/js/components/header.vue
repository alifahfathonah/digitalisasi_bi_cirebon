<template>
    <div>
        <div slot="header" class="clearfix text-center" > 
            <a  v-if="user_id != undefined" onclick="event.preventDefault();document.getElementById('logout-form').submit();" style="float: right; padding: 0px" >logout <i class="el-icon-switch-button"></i></a> <br>
            <img src="image/logo.png" alt="Logo" height="70px">
        </div>
        <hr>
    </div>
</template>
<script>
export default {
    data() {
        return {
            user_id : AUTH_LOGIN_ID
        }
    },
}
</script>