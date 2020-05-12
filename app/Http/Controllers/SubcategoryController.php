<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\category;
use App\subcategory;
use App\product;
class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcat = subcategory::pluck('SubCatID'); $data = array();
        foreach($subcat as $id){
            $sub = subcategory::where('SubCatID',$id)->first();
            $sub->category;
            $data[] = $sub;
        }
     return view('admin.subcategory',['data'=>$data]);
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
    public function destroy()
    {
       $id = request()->query('id'); 
       $data="a";
       $subcat = subcategory::find($id);
        $prd = product::where('SubcatID',$id)->pluck('ProductID');
       if($prd->isEmpty()){
      $subcat->delete();
      $data="success";
    }
      else{
          $data = 'You must delete all products of this subcategory';
      }
       return response()->json($data);
    }
}
