<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable=['Name','Email','Phone_Number','Address','City','State','Country','Company_Name','date'];

    public function user(){
        return $this->belongsTo('App/Models/User');
}
}
