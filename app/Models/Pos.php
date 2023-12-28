<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    use HasFactory;



    protected $fillable = ['Customer_name','Quantity','Price','subtotal','order_date'];

    public function product(){
        return $this->belongsTo('App\Models\Product', 'id') ;
     }



     public function Product_midwifery(){
        return $this->belongsTo('App\Models\Product_midwifery', 'id') ;
     }



     public function category()
{
    return $this->hasOne('App\Models\Category','id');
}

}
