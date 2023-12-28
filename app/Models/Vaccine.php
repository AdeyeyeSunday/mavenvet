<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    use HasFactory;


    protected $fillable=['user_id','Name','Email','Phone_Number','Address','Company_Name','date'];




    public function user(){
     return $this->belongsTo('App/Models/User');




}



}
