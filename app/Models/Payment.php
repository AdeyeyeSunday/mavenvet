<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Payment extends Model
{
    use HasFactory;

    protected $fillable=['Pet_id','Services','Payment_Status','Amount_Paid','Outstanding_Payment','Mode_Of_Payment','Veterinarian','date','month','year','user_id','Total_bill','Card_Payment'];


    public function user(){

        return $this->belongsTo('App/Models/User');
}

    public function clinic()
{
    return $this->hasOne('App\Models\Clinic','id', 'Pet_id');
}


public function order(){

return $this->hasMany('App/Models/Order');
}


public function service_item(){

    return $this->hasMany('App\Models\Service_item','order_id');
}

}
