<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\mediafile;
use Intervension\Image\Facades\Image;
use Illuminate\Support\Facades\File;
class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $media = mediafile::all();
       return view('admin.media', ['media'=>$media]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $media = new mediafile();
        if($request->has('image'))
        {
           $img = $request->file('image'); 
           $name = $request->name.'.'.$img->getClientOriginalExtension();
           $path = base_path('/mediafiles/');
           $img->move($path,$name);
           $media->image = 'http://localhost/adminportal/mediafiles/'.$name;
           $media->name = $request->name;
         //   Image::make(base_path('/mediafiles/'.$name))->resize(300, 300);
         //  $media->thumbnail =   $thumbnail ;
          // $thumbnail->save();
          $media->save();
        }
        return response()->json($media); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function deletefile(Request $request)
    {
        $path = $request->name;

       unlink();
    }
}