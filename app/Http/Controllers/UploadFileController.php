<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadFileController extends Controller
{

    public function index(){
        return 'test';
    }

    public function store(Request $request){
      if ($request->hasFile('file')){
            $file = $request->file('file');
            $fileName = time().str_replace(' ','_',$request->file->getClientOriginalName());
            $extension = $request->file->getClientOriginalExtension();
            if (!in_array(strtolower($extension), ['jpg','jpeg','png']))
            {
                return [
                    'success' => false,
                    'message' => 'File extension not permitted'
                ];
            }

            try {
                $file->move('uploads/'.$request->id.'//', $fileName);
            } catch (\Exception $e) {
                return [
                    'success' => false,
                    'message' => 'Failed to move file'
                ];
            }

            return [
                'success' => true,
                'file' => $fileName,
                'message' => 'OK'
            ];
        }

        return "no data";
    }

    public function update(Request $request, $id){
        $file_path = public_path('/uploads/'.$id.'/'.$request->file);
        if(is_file($file_path)){
          unlink($file_path);
          return [ 'success' => true, 'message' => 'file deleted' ];
        };
        return [ 'success' => true, 'message' => 'no file dlete' ];
    }
}
