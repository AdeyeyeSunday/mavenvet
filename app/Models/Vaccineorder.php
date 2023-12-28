<?php

namespace App\Models;
use App\Models\Vaccineiteam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccineorder extends Model
{
    use HasFactory;


    // protected $guarded = [];

    protected $filliable=[
        'user_id',
        'name',
        'phone',
        'address',
        'Mode_of_payment',
        'pay',
        'due',
        'Payment_type'
    ];




    public function vaccineiteams(){

        return $this->hasMany(Vaccineiteam::class,'order_id');
    }

    // public function vaccinestore(){

    //     return $this->belongsTo('App/Models/Vaccinestore');
    // }


}
