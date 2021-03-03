<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kendaraan ;
use App\Http\Requests\KendaraanRequest ;
use Auth ;

class KendaraanController extends Controller
{

    public function index(Request $request)
    {
        return Kendaraan::when($request->search, function($q) use ($request) {
                return $q->where(function($qq) use ($request) {
                  return $qq->where('merk', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('type', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('tahun', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('no_pol', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('jumlah_seat', 'LIKE', '%'.$request->search.'%')
                    ;
                });
            })
            ->orderBy($request->sort ? $request->sort : 'id', $request->order == 'ascending' ? 'asc' : 'desc')->paginate($request->pageSize);
    }

    public function store(KendaraanRequest $request)
    {
        $input = $request->all() ;
        $input['user_id'] = auth::user()->id ;
        $proses = Kendaraan::create($input) ;

        if($proses){
          $res = ['status' => 200, 'message' => 'success'] ;
        }else{
          $res = ['status' => 200, 'message' => 'failed'] ;
        }

        return $res ;
    }

    public function show($id)
    {
        return Kendaraan::find($id) ;
    }

    public function update(Request $request, $id)
    {
        $input = $request->all() ;
        $input['user_id'] = auth::user()->id ;
        $proses = Kendaraan::find($id) ;
        $proses->update($input);

        if($proses){
          $res = ['status' => 200, 'message' => 'success'] ;
        }else{
          $res = ['status' => 200, 'message' => 'failed'] ;
        }

        return $res ;
    }

    public function destroy($id)
    {
        $proses =  Kendaraan::find($id)->delete() ;
        if($proses){
          $res = ['status' => 200, 'message' => 'success'] ;
        }else{
          $res = ['status' => 200, 'message' => 'failed'] ;
        }

        return $res ;

    }
}
