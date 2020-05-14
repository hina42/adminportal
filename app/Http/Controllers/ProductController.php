<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use App\subcategory;
use App\product;
use App\description;
use App\color;
use App\size;
use App\yard;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
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
            $descdata=product::where('ProductID',$id)->first();
            $desc = $descdata->description->Description;
            $data->color;
            $data->desc = $desc;
            $data->size;
            $data->yard;
            $data->subcategory;
            $finaldata[]=$data;}
            $data = $this->paginate($finaldata);
      return view('admin.product',compact('data'));
    //return dd($finaldata[0]->desc);
    }
    public function paginate($items, $perPage = 3, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
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
    public function update(Request $request)
    {
      $id = $request->ProductID;
       $prd = product::find($id);
   $subcat = subcategory::where('SubCatType',$request->subcat)->pluck("SubCatID");
   description::where("DescriptionID",$prd['DescriptionID'])->update(['Description'=>$request->Description]);
   if(!$request->Min==null)
   yard::where("productid",$id)->update(['Min'=>$request->Min]);
   if(!$request->Max==null)
   yard::where("productid",$id)->update(['Max'=>$request->Max]);
   $colorarr = explode(',',$request->colorarray);
   $sizerarr = explode(',',$request->sizearray);
   $size = size::where('productid',$id)->pluck('SizeID');
        $color = color::where('productid',$id)->pluck('ColorID');
if($request->colorarray){
    if(!$color==null){
        foreach($color as $colorid){
            $delcolor = color::find($colorid);
            $delcolor->delete();
           }
        }

       foreach($colorarr as $color){
        $newcolor = new color();
       $newcolor->Color = $color;
       $newcolor->productid = $id;
       $newcolor->save();      
}
}
if($request->sizearray){
    if(!$size==null){
        foreach($size as $sizeid){
         $delsize = size::find($sizeid);
         $delsize->delete();
        }}
        foreach($sizearr as $size){
            $newsize = new size();
           $newsize->Size = $size;
           $newsize->productid = $id;
           $newsize->save();      
   }   
}
 
      if(!$request->file('prdimg')){
      $prd->update([
           'ProductName'=>$request->ProductName,
            'ProductPrice'=>$request->ProductPrice,
            'SubCatID'=>$subcat[0],
     ]);
        
      }
       $data = [
           'ProductID'=>$id,
           'name'=>$request->ProductName,
           'price'=>$request->ProductPrice,
           'desc'=>$request->Description,
           'colorarr'=>$colorarr,
           'sizearr'=>$sizerarr,
           'min'=>$request->Min,
           'max'=>$request->Max,
           'subcat'=>$request->subcat,
       ];
       return response()->json($data); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    { $id = request()->query('id');
        $prd = product::find($id);
        $size = size::where('productid',$id)->pluck('SizeID');
        $color = color::where('productid',$id)->pluck('ColorID');
        if(!$color==null){
        foreach($color as $colorid){
            $delcolor = color::find($colorid);
            $delcolor->delete();
           }
           $yard = yard::where('productid',$id)->first(); 
           $yard->delete();
        }
           if(!$size==null){
           foreach($size as $sizeid){
            $delsize = size::find($sizeid);
            $delsize->delete();
           }}
        $prd->delete();
        return response()->json($id);
        
    }


    public function fetchprd(){
        $id = request()->query('id');
        $prd = product::where("ProductID",$id)->first();
        $prd->yard;
        $prd->subcategory;
        $prd->color;
        $prd->size;
        $prd->description;
      
    return response()->json($prd);
    }

    public function filterprd(){
      $search = request()->query('searchprd');
      if(!$search==null){
        $finaldata = array();
        $subid = subcategory::where("SubCatType",$search)->pluck('SubCatID');
        $prd = product::where('SubCatID',$subid[0])->pluck('ProductID');
          foreach ($prd as $id) {
            $data=product::where('ProductID',$id)->first();
            $descdata=product::where('ProductID',$id)->first();
            $desc = $descdata->description->Description;
            $data->color;
            $data->desc = $desc;
            $data->size;
            $data->yard;
            $data->subcategory;
            $finaldata[]=$data;}
            $data = $this->paginate($finaldata);
      return view('admin.product',compact('data'));}
      else{
          return redirect()->back();
      }
    }

}
