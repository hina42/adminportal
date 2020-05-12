<?php

namespace App;
use App\category;
use Illuminate\Database\Eloquent\Model;

class subcategory extends Model
{
   protected $primaryKey = "SubCatID";
   protected $fillable = ["SubCatType",'CategoryID'];

   public function category(){
      return $this->belongsTo(category::class,'CategoryID','CategoryID');
   }
}
