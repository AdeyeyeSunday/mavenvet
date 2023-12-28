<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


 protected $guarded = [];

    public function user(){

        return $this->belongsTo('App\Models\User','user_id');
}


     public function Pos(){

    return$this->belongsTo('App\Models\Pos');
}
public function Category(){

    return$this->belongsTo('App\Models\Category','id');
}
}
