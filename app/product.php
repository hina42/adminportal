<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\color;
use App\yard;
use App\size;
use App\subcategory;
use App\description;
class product extends Model
{
    protected $primaryKey ="ProductID";
    protected $fillable=["ProductName","SubCatID","YardID","SizeID","ColorID","DescriptionID","ProductPrice","Image"];

    public function yard()
    {
        return $this->hasOne(yard::class,"productid",'ProductID');
    }
    public function color()
    {
        return $this->hasMany(color::class,"productid",'ProductID');
    }
    public function size()
    {
        return $this->hasMany(size::class,"productid",'ProductID');
    }
    public function subcategory()
    {
        return $this->belongsTo(subcategory::class,'SubCatID',"SubCatID");
    }
    public function description()
    {
        return $this->hasOne(description::class,'DescriptionID',"DescriptionID");
    }

}
