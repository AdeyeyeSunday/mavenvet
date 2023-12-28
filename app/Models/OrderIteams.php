<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderIteams extends Model
{
    use HasFactory;



    protected $guarded = [];


    public function products(){

    return $this->belongsTo('App\Models\Product','id','id');
    }


    public function user(){

        return $this->belongsTo('App\Models\User');
    }


}
