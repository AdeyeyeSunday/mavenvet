<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','amount','date','month','year','location'];

     public function users(){
        return $this->belongsTo('App\Models\User') ;
     }
}
