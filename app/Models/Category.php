<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable=['Category'];


    public function user(){

        return $this->belongsTo('App/Models/User');
}


    public function Pos(){

    return$this->belongsTo('App\Models\Pos');
}


     public function Product(){

    return$this->belongsTo('App\Models\Product','id');
}


public function Product_midwifery(){

    return$this->belongsTo('App\Models\Product_midwifery','id');
}




}
