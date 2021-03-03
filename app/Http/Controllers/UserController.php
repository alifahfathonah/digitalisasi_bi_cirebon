<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User ;
use App\Http\Requests\UserRequest ;
use Auth ;

class UserController extends Controller
{

    public function index(Request $request)
    {
      return User::when($request->search, function($q) use ($request) {
              return $q->where(function($qq) use ($request) {
                return $qq->where('name', 'LIKE', '%'.$request->search.'%')
                  ->orWhere('email', 'LIKE', '%'.$request->search.'%')
                  ->orWhere('no_telp', 'LIKE', '%'.$request->search.'%')
                  ->orWhere('nik', 'LIKE', '%'.$request->search.'%')
                  ;
              });
          })
          ->orderBy($request->sort ? $request->sort : 'id', $request->order == 'ascending' ? 'asc' : 'desc')->paginate($request->pageSize);
    }

    public function store(UserRequest $request)
    {
        $input =  $request->all() ;
        $input['user_id'] = auth::user()->id ;
        $input['password'] = bcrypt($request->pass) ;

        $proses = User::create($input) ;


        if($proses){
          $res = ['status' => 200, 'message' => 'success'] ;
        }else{
          $res = ['status' => 200, 'message' => 'failed'] ;
        }

        return $res ;
    }

    public function create()
    {
        return User::get();
    }


    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
          'name' => 'required',
          'nik' => 'required|numeric',
          'username' => 'required',
          'email' => 'required|email',
          'no_telp' => 'required|numeric',
          'alamat' => 'required',
          'templat_lahir' => 'required',
          'tanggal_lahir' => 'required|date',
          'department_id' => 'required'
        ]);

         $input = $request->all();
         $input['user_id'] =  auth::user()->id ;
         if (!empty($request->pass)) {
            $input['password'] = bcrypt($request->pass) ;
         }

         $proses = User::find($id);
         $proses->update($input) ;

         if($proses){
             $res = ['status' => 200, 'message' => 'success'] ;
         }else{
           $res = ['status' => 200, 'message' => 'failed'] ;
         }

         return $res ;
    }

    public function destroy($id)
    {
        $proses = User::find($id)->delete();
        if($proses){
            $res = ['status' => 200, 'message' => 'success'] ;
        }else{
          $res = ['status' => 200, 'message' => 'failed'] ;
        }
        return $res ;
    }
}
