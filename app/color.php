<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class color extends Model
{
    protected $primaryKey = "ColorID";
    protected $fillable = ["Color",'ColorName',"productid"];

}
