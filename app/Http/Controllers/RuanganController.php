<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ruangan ;
use App\Http\Requests\RuanganRequest ;
use Auth ;


class RuanganController extends Controller
{

  public function index(Request $request)
  {
      return Ruangan::when($request->search, function($q) use ($request) {
              return $q->where(function($qq) use ($request) {
                return $qq->where('nama_ruangan', 'LIKE', '%'.$request->search.'%')
                  ->orWhere('kapasistas', 'LIKE', '%'.$request->search.'%')
                  ;
              });
          })
          ->orderBy($request->sort ? $request->sort : 'id', $request->order == 'ascending' ? 'asc' : 'desc')->paginate($request->pageSize);
  }

  public function store(RuanganRequest $request)
  {
      $input = $request->all() ;
      $input['user_id'] = auth::user()->id ;
      $proses = Ruangan::create($input) ;

      if($proses){
        $res = ['status' => 200, 'message' => 'success'] ;
      }else{
        $res = ['status' => 200, 'message' => 'failed'] ;
      }

      return $res ;
  }

  public function show($id)
  {
      return Ruangan::find($id) ;
  }

  public function update(RuanganRequest $request, $id)
  {
      $input = $request->all() ;
      $input['user_id'] = auth::user()->id ;
      $proses = Ruangan::find($id) ;
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
      $proses =  Ruangan::find($id)->delete() ;
      if($proses){
        $res = ['status' => 200, 'message' => 'success'] ;
      }else{
        $res = ['status' => 200, 'message' => 'failed'] ;
      }

      return $res ;

  }
}
