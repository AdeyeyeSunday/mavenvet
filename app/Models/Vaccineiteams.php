<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Vaccineiteams extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function products(){

        return $this->belongsTo('App\Models\Product','id','id');
        }


        // public function vaccinestore(){

        //     return $this->belongsTo('App/Models/Vaccinestore');
        // }


}




