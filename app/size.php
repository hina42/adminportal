<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class size extends Model
{
    protected $primaryKey = "SizeID";
    protected $fillable = ["Size","productid"];
}
