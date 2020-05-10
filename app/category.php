<?php

namespace App;
use App\subcategory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
   protected $primaryKey = "CategoryID";
   protected $fillable = ['CatName','CategoryType'];
   public function subcategory()
   {
       return $this->hasMany(subcategory::class,'CategoryID',"CategoryID");
   }

}
