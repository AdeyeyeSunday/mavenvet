<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\Payment;

class Order extends Model
{
    use HasFactory;

    protected $filliable=[
        'fname',
        'phone',
        'address',
        'Mode_of_payment',
        'pay',
        'due',
        'Payment_type',
        'cash_pos',
        'cash_transfer',
        'discount',
        'location'
    ];


    public function orderIteams(){

        return $this->hasMany('App\Models\OrderIteams');
    }



    public function products(){

        return $this->belongsTo('App\Models\Product');
}



    public function payment(){

    return $this->hasMany('App/Models/Payment');
}


}
