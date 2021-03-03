<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTamu ;
use App\Tamu ;
use Illuminate\Support\Facades\DB;


class TamuNonAuthController extends Controller
{
    public function index(){
        return  view('tamu');
    }

    public function store(Request $request){
      $input = $request->all();
      $input['waktu_masuk'] = date('Y-m-d H:i:s') ;
      $input['status'] = 'didalam';


      $data = DB::transaction(function () use ($input) {
        $cek = DataTamu::where('nik', $input['nik'] )->get();

        if(count($cek) >= 1){
          $input['data_tamu_id'] = $cek[0]['id'] ;
          Tamu::create($input) ;
        }else{
          $datatamu = DataTamu::create($input) ;
          $datatamu->Tamu()->create($input) ;
        }

        return $input ;
      });

      if($data){
        $res =  [ 'status' => true, 'message' => 'success', 'data' => $data ];
      }else{
        $res = [ 'status' => false, 'message' => 'gagal' ];
      }

      return $res ;
    }

    public function show($id){
      $key_url = base64_decode(base64_decode(base64_decode($id))) ;
      $hari_ini = date('l');

      if($key_url == $hari_ini){
          $res = ['status' => true, 'message' => 'succes'] ;
      }else{
          $res = ['status' => false, 'message' => 'failed'] ;
      }

      $res = ['status' => true, 'message' => 'succes'] ;
      return $res ;
    }

    public function cekDataTamu(Request $request){

        if(empty($request->form_status)){
          $cek = DataTamu::where('nik', $request->nik)->get();
          if(count($cek) >= 1){
            $cek = ['status' => true, 'message' => 'sudah ada'] ;
          }else{
            $cek = ['status' => false, 'message' => 'belum ada'] ;
          }
        }else{
          $this->validate($request, [
            'nik' => 'required|numeric',
            'nama_tamu' => 'required',
            'email' => 'required|email',
            'no_telp' => 'required|numeric',
            'alamat' => 'required',
            'photo' => 'required',
          ]);
          $cek = ['status' => true, 'message' => 'OK'] ;
        }

        return $cek  ;
    }

    public function datatamu($id){

        $data = Tamu::with('DataTamu')->where('nik',$id)->orderBy('created_at', 'desc')->first() ;
        return $data ;
    }

}
