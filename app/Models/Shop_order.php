<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop_order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Shop_item(){

    return $this->hasMany(Shop_item::class,'order_id');
    }





    public function user(){

        return $this->belongsTo('App\Models\User');
    }

}
