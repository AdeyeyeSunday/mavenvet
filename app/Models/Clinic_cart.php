<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic_cart extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = ['user_id','items_name','qty','selling_price','vaccine_id','Quantity'];


    public function user(){
       return $this->belongsTo('App\Models\User') ;
    }

}
