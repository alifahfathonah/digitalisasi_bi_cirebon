<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class suratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page/surat_keluar');
    }

    public function create()
    {
        //
    }

 
    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        return view('sampel_word');
        $headers = array(

            "Content-type"=>"text/html",
    
            "Content-Disposition"=>"attachment;Filename=myGeneratefile.doc"
    
        );
    
        
    
        $content = '<html>
    
                <head><meta charset="utf-8"></head>
    
                <body>
                    Kepada &emsp &emsp &emsp : bla bla bla <br/>
                    perihal  &emsp &emsp &emsp : blabla ba
                    <p>My Blog Laravel 7 generate word document from html Example - Nicesnippets.com</p>
    
                    <ul><li>Php</li><li>Laravel</li><li>Html</li></ul>
    
                </body>
    
                </html>';
        return response()->make($content,200, $headers);
        return 'test';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
