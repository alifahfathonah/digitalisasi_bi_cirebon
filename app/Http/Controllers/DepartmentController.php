<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department ;
use App\Http\Requests\DepartmentRequest ;
use Auth ;

class DepartmentController extends Controller
{
  public function index(Request $request)
  {
      return Department::when($request->search, function($q) use ($request) {
              return $q->where(function($qq) use ($request) {
                return $qq->where('nama_department', 'LIKE', '%'.$request->search.'%')
                  ->orWhere('kode_department', 'LIKE', '%'.$request->search.'%')
                  ->orWhere('leader', 'LIKE', '%'.$request->search.'%')
                  ;
              });
          })
          ->orderBy($request->sort ? $request->sort : 'id', $request->order == 'ascending' ? 'asc' : 'desc')->paginate($request->pageSize);
  }

  public function store(DepartmentRequest $request)
  {
      $input = $request->all() ;
      $input['user_id'] = auth::user()->id ;
      if(empty($request->leader)){
        $input['status'] = 'Tidak Aktif' ;
      }else{
        $input['status'] = 'Aktif' ;
      }
      $proses = Department::create($input) ;

      if($proses){
        $res = ['status' => 200, 'message' => 'success'] ;
      }else{
        $res = ['status' => 200, 'message' => 'failed'] ;
      }

      return $res ;
  }

  public function show($id)
  {
      return Department::find($id) ;
  }

  public function create(Request $request){
      return Department::all();
  }

  public function update(DepartmentRequest $request, $id)
  {
      $input = $request->all() ;
      $input['user_id'] = auth::user()->id ;

      if(empty($request->leader)){
        $input['status'] = 'Tidak Aktif' ;
      }else{
        $input['status'] = 'Aktif' ;
      }

      $proses = Department::find($id) ;
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
      $proses =  Department::find($id)->delete() ;
      if($proses){
        $res = ['status' => 200, 'message' => 'success'] ;
      }else{
        $res = ['status' => 200, 'message' => 'failed'] ;
      }

      return $res ;

  }
}
