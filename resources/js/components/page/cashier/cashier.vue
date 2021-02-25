<template>
  <div class="text-center">
    <h2>Antrian Penukaran Uang</h2>
    <div class="col-md-5 text-center" style="margin:auto;">
      <h1>Loket {{ input.loket}}</h1>
      <div class="col-md-7 text-center" style="margin: auto; padding: 10px; border: 5px solid #005496">
        <h1 style="font-size:70px; font-weight: bold">
            {{ input.antrian }}
        </h1>
      </div>
      <br>

      <br>
    </div>
    <el-button type="danger" @click="change(-1)" round icon="el-icon-caret-left">Prev</el-button>
    <el-button type="primary" @click="cekSound(input)" round icon="el-icon-phone-outline">Panggil Antrian</el-button>
    <el-button type="success" @click="change(1)" round icon="el-icon-caret-right">Next</el-button>

    <!-- <form class="form" >
      <div class="form-group row">
        <div class="col-md-3 col-form-label">
          Angka Antrian
        </div>
        <div class="col-md-9">
          <input type="text" v-model="input.antrian">
        </div>
      </div>
      <div class="form-group row">
        <div class="col-md-3 col-form-label">
          Loket
        </div>
        <div class="col-md-9">
          <input type="text" v-model="input.loket">
        </div>
      </div>
    </form> -->
  </div>
</template>
<script>

export default {
  data(){
    return{
        input : { antrian : 9, loket : 2}
    }
  },
  mounted(){
    console.log((22-(22%10))/10);
  },
  methods: {
    change(n){
        this.input.antrian = this.input.antrian + n
    },
    cekSound(a){
      var noAntrian = a.antrian ;
      var noLoket = new Audio("/sound/"+a.loket+".wav") ;
      var keluar = new Audio("/sound//in.wav");
      var masuk = new Audio("/sound/out.wav");
      var sepuluh = new Audio("/sound/sepuluh.wav");
      var sebelas = new Audio("/sound/sebelas.wav");
      var puluh = new Audio("/sound/puluh.wav");
      var ratus = new Audio("/sound/ratus.wav");
      var seratus = new Audio("/sound/seratus.wav");
      var suaraBelas = new Audio("/sound/belas.wav");
      var NomorAntrian = new Audio("/sound/nomor-urut.wav");
      var loket = new Audio("/sound/loket.wav");

      if (noAntrian < 10) {
            var suara = new Audio("/sound/"+noAntrian+".wav");
            masuk.play()
            setTimeout(function() {
              NomorAntrian.play();
              setTimeout(function () {
                suara.play() + setTimeout(function() { loket.play() }, 900) +setTimeout(function() { noLoket.play() }, 1900);
              }, 1600);
            }, 1700 )
            return ;
        } else if (noAntrian == 10) { // khusus untuk sepuluh
          masuk.play()
          setTimeout(function() {
            NomorAntrian.play();
            setTimeout(function () {
              sepuluh.play() + setTimeout(function() { loket.play() }, 900) +setTimeout(function() { noLoket.play() }, 1900);
            }, 1600);
          }, 1700 )
          return ;
        } else if (noAntrian == 11) { // khusus untuk sebelas
          masuk.play()
          setTimeout(function() {
            NomorAntrian.play();
            setTimeout(function () {
               sebelas.play() + setTimeout(function() { loket.play() }, 900) +setTimeout(function() { noLoket.play() }, 1900);
            }, 1600);
          }, 1700 )
          return ;
        } else if (noAntrian < 20) { // 12 -19
            var suara = new Audio("/sound/"+(noAntrian-10)+".wav");
            masuk.play()
            setTimeout(function() {
              NomorAntrian.play();
              setTimeout(function () {
                 suara.play() + setTimeout(function () { suaraBelas.play(); }, 900) + setTimeout(function() { loket.play() }, 1450) +setTimeout(function() { noLoket.play() }, 1450);
              }, 1600);
            }, 1700 )
            return ;

        } else if (noAntrian < 100) { // 20 -99
            var angkapuluh = new Audio("/sound/"+((noAntrian - (noAntrian % 10)) / 10)+".wav");
            var belakangpuluh = new Audio("/sound/"+(noAntrian % 10)+".wav");
            if( (noAntrian % 10) == 0 ){
              var suara = new Audio("/sound/"+(noAntrian-10)+".wav");
              masuk.play()
              setTimeout(function() {
                NomorAntrian.play();
                setTimeout(function () {
                   angkapuluh.play() +  setTimeout(function () { puluh.play(); }, 900) + setTimeout(function() { loket.play() }, 1450) +setTimeout(function() { noLoket.play() }, 2450);
                }, 1600);
              }, 1700 )
              return ;
            }else{
              var suara = new Audio("/sound/"+(noAntrian-10)+".wav");
              masuk.play()
              setTimeout(function() {
                NomorAntrian.play();
                setTimeout(function () {
                  angkapuluh.play() +  setTimeout(function () { puluh.play(); }, 900) + setTimeout(function () { belakangpuluh.play(); }, 1500) + setTimeout(function() { loket.play() }, 2000) +setTimeout(function() { noLoket.play() }, 3000);
                }, 1600);
              }, 1700 )
              return ;
            }
        }


    },
  }
}
</script>
<style lang="scss" scoped>
</style>
