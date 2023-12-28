<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = ['staff_id','description','type','from','to','month','year','user_id','status'];


    public function user(){

        return $this->belongsTo('App\Models\User');
    }
}
