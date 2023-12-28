<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable=['user_id','Month','Amount','description','year'];



    public function user(){

        return $this->belongsTo('App\Models\User');
    }

    public function employee(){

        return $this->hasOne('App\Models\Employee','user_id','user_id');
    }
}
