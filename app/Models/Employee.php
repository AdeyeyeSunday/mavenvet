<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    use HasFactory;

    protected $fillable= [
        'user_id',
        'Title',
        'name_id',
        'email',
        'number',
        'gst_number',
        'address',
        'city',
        'image',
        'state',
        'country',
        'gender',
        'position',
        'staff_no'
    ];


    public function user(){



        return $this->belongsTo('App\Models\User','name_id', 'id');
    }


    public function salary(){

        return $this->hasOne('App\Models\Salary','user_id','user_id');
    }
}
