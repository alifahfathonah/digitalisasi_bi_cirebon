<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KendaraanDinas ;
use Illuminate\Support\Facades\DB;
use Auth ;

class KendaraanDinasController extends Controller
{

    public function index()
    {
        $day = date('D') ;
        if(md5($day) == md5('Thu')){
          echo "benar ini adalah hari $day";
        }else{
          echo "hari tidak terbaca";
        }
        return;

        return KendaraanDinas::paginate();
    }

    public function store(Request $request)
    {
      $input = $request->all();
      $input['user_id'] = auth::user()->id ;

      $data = DB::transaction(function () use ($input) {
                $save = KendaraanDinas::create($input);
                return $save ;
            });
      if($data){
        return [
          'status' => true, 'message' => 'success', 'data' => $data
        ];
      }else{
        return [
          'status' => false, 'message' => 'gagal'
        ];
      }
    }

    public function show($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
