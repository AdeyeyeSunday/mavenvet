<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;


    protected $fillable = ['Name','Phone','Address','date'];


    public function users(){
        return $this->belongsTo('App\Models\User') ;
     }


}
