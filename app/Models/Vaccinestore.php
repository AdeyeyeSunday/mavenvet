<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccinestore extends Model
{
    use HasFactory;

    protected $fillable=['new_supply','user_id','Name','Cost','Price','Quantity','Image','expiry_date','supply_date','brand','minimum','supplier'];


       public function user(){

        return $this->belongsTo('App\Models\User','user_id');
}


 


// public function vaccineiteams(){

//     return $this->hasMany('App/Models/Vaccineiteams');
// }



// public function vaccineorder(){

//     return $this->hasMany(Vaccineorder::class);
// }




}
