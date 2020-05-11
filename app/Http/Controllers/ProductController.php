<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use App\subcategory;
use App\product;
use App\color;
use App\yard;
use App\size;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      $finaldata = array();
        $prd = product::pluck('ProductID');
          foreach ($prd as $id) {
            $data=product::where('ProductID',$id)->first();
            //  $checkyard=yard::where('productid',$data['ProductID'])->select('Min','Max')->get();
            //      if($checkyard->isEmpty())
            //       $data->yard=null;
            //       else
            //      $data['yard']=$checkyard[0];
            $data->color;
            $data->size;
            $data->yard;
            $data->subcategory;
            $finaldata[]=$data;}
      return view('admin.product',['data'=>$finaldata]);
    // return dd($finaldata[0]->yard['Min']);
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
        //
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
    public function destroy($id)
    {
        //
    }
}
