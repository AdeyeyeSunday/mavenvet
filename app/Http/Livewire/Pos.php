<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Pos extends Component
{


    public $fname,$phone,$address,$discount,$order_status,$Mode_of_payment,$pay,$due,$Payment_type,$date,$location,$month,$year;
    public function render()
    {
        $product =  Product::with('category')->get();
        $customer = Customer::get();
        $get_cart = Cart::get();
        $get_post=Cart::get();
        $get_customer= Customer::get();
        $count= DB::table('carts')->sum('Quantity');
        return view('livewire.pos',['product'=>$product,'customer'=>$customer,'get_cart'=>$get_cart,'count'=>$count,'get_post'=>$get_post,'get_customer'=>$get_customer]);
    }



    public function add_cart(){


        'am here';


    }


}
