<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_midwifery extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function user(){

        return $this->belongsTo('App/Models/User');
}

     public function Pos(){

    return$this->belongsTo('App\Models\Pos');
}
public function Category(){

    return$this->belongsTo('App\Models\Category','id');
}
}
