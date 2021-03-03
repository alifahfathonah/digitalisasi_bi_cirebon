<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if($request->session()->exists('user')){
            $data = 1 ;
        }else{
            $data = 0  ;
        }

        return view('home', ['data'=> $data]);
    }
}
