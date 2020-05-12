<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class yard extends Model
{
    protected $primaryKey ="YardID";
    protected $fillable=['Min',"Max",'productid'];

}
