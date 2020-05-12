<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use App\subcategory;
use App\product;
use App\description;
use App\color;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     $data = array();
        $cat = category::pluck('CategoryID');$max = 0;$maxsubcatid =0;
        foreach($cat as $id){
           $catdata =  category::where('CategoryID',$id)
           ->first();  
           $catdata->subcategory = subcategory::where('CategoryID',$id)->paginate(3);
           $count=  subcategory::where('CategoryID',$id)->count('SubCatType');
   
        if($count > $max)
      {  $max = $count; $maxsubcatid = $id;}
           $data[] = $catdata;
        }
      
        return view('admin.category',['data'=>$data, 'max'=>$maxsubcatid]);
       
    //   dd($maxsubcatid);
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
        if(!$request->catname == null)
        {$cat = new category();
            $cat->CatName = $request->catname;
            $cat->CategoryType = $request->cattype;
            $cat->image = 'http://waar.ae/waar/img/embroidery2.jpg';
          $cat->save();
        }
        if(!$request->subcattype == null)
        {   $subcat = new subcategory();
            $subcat->SubCatType = $request->subcattype;
            $subcat->CategoryID = $request->catid;
            $subcat->save();
        }
        if($request->has('prdname'))
        {$prd = new product();
            // $prd->ProductName = $request->prdname;
            // $subcatid = subcategory::where('SubCatType',$request->searchsubcat)->pluck('SubCatID');
            // $prd->SubCatID = $subcat[0];
            // $prd->ProductPrice = $request->price;
            // $desc = new description();
            // $desc->Description = $request->desc;
        //     $desc->save();
        //     $descid = description::orderBy('DescriptionID','DESC')->pluck('DescriptionID');
        //     $prd->DescriptionID = $descid[0];
        //     $prd->Image = 'http://waar.ae/waar/img/embroidery2.jpg';
        if($request->min){
            
        }
        //   $prd->save();
           $prdid = product::orderBy('ProductID','DESC')->pluck('ProductID');
           //color
           if($request->colorarray){
          $colorarr = explode(',',$request->colorarray);
            foreach($colorarr as $color){
                $newcolor = new color();
               $newcolor->Color = $color;
               $newcolor->productid = $prdid[0];
               $newcolor->save();      
       }
           }
           //size
    if($request->sizearray){
    $sizearr = explode(',',$request->sizearray);
            foreach($sizearr as $size){
                $newsize = new size();
               $newsize->Size = $size;
               $newsize->productid = $prdid[0];
               $newsize->save();      
       }}

        }
     //   dd($colorarr);
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
        $cat = category::find($id); 
        if(!$cat==null){
             $cat->delete();
             $subcat = subcategory::where('CategoryID',$id)->pluck('SubCatID');
            foreach($subcat as $id){
             $subcatdata = subcategory::find($id)->delete();
            }
        }
        
      return response()->json($id);
    }

    public function searchsubcat(Request $request){
        $data = subcategory::pluck('SubCatType');
        $find = $request->name;
        if(!$find == null){
            foreach($data as $type){
          if(strpos($type, $find) !== false)
          {
            echo "<option value='".$type."' >".$type."</option><br>";
           
         }
        }
         }
         else{
            foreach($data as $type){ 
                echo "<option value='".$type."' >".$type."</option><br>";
            }
          }
    }
}
