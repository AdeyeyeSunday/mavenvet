<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;

    protected $fillable = ['pic','Pet_name','Breed','Gender','Name_Of_Pet_Owner','Owner_Phone_Number','Pet_Card_Number','Age','Veterinarian','Color','date','month','year','user_id'];


    public function user(){
       return $this->belongsTo('App\Models\User') ;
    }

    public function treatment(){
        return $this->belongsTo('App\Models\Treatment', 'id', 'pet_id') ;
     }


     public function payment(){
        return $this->belongsTo('App\Models\Payment', 'id', 'pet_id') ;
     }


     public function admission(){
        return $this->belongsTo('App\Models\Admission', 'id', 'pet_id') ;
     }




     public function Casenote()
    {
    return $this->hasOne('App\Models\Casenote','id', 'case_id');
}

    public function Pos(){

    return$this->belongsTo('App\Models\Pos');
}
}

