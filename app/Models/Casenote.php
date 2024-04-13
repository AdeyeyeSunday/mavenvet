<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Casenote extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user(){
        return $this->belongsTo('App/Models/User');
}


public function clinic()
{
    return $this->hasOne('App\Models\Clinic','id', 'case_id');
}


public function treatment(){
    return $this->hasOne('App\Models\Treatment', 'Pet_id', 'case_id') ;
 }



//  public function service_order(){

//    return $this->hasOne('App\Models\Service_order');
//  }

}
