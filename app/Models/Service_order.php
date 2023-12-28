<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service_order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function service_item(){
        return $this->hasMany('App\Models\Service_item','order_id');
    }







    public function user(){

        return $this->belongsTo('App\Models\User');
    }



//  public function Casenote(){

//     return $this->belongsTo('App\Models\casenote');
//   }





}
