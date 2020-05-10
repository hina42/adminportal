<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use App\subcategory;
use App\product;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     $data = array();
        $cat = category::pluck('CategoryID');
        foreach($cat as $id){
           $catdata =  category::where('CategoryID',$id)
           ->first();  
           $catdata->subcategory;
           $data[] = $catdata;
        }
      
        return view('admin.category',['data'=>$data]);
       
       //dd($data);
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
        if($request->has('catname'))
        {$cat = new category();
            $cat->CatName = $request->catname;
            $cat->CategoryType = $request->cattype;
            $cat->image = 'http://waar.ae/waar/img/embroidery2.jpg';
          $cat->save();
        }
        if($request->has('subcattype'))
        {   $subcat = new subcategory();
            $subcat->SubCatType = $request->subcattype;
            $subcat->CategoryID = $request->catid;
        //  $subcat->save();
        }
        // if($request->has('prdname'))
        // {$prd = new product();
        //     $prd->ProductName = $request->prdname;
        //     $prd->SubCatID = $request->subcategory;
        //     $prd->ProductPrice = $request->price;
        //     $prd->Image = 'http://waar.ae/waar/img/embroidery2.jpg';
        //   $prd->save();
        // }
        return response()->json("success"); 
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
    {$id = request()->query('id');
        $cat = category::find($id); $data ="";
        if(!$cat==null){
             $cat->delete();
             $data = "success";
        }
        else{
            $data = "failure";
        }
      return response()->json($data);
    }
}
