<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;

// use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add_cart(Request $request){
        $data=array();
        $data['user_id']=$request->user_id;
        $data['Name']=$request->Name;
        $data['Quantity']=$request->Quantity;
        $data['Price']=$request->Price;
        $data['product_id']=$request->product_id;
        $data['date']=$request->date;
        $data['month']=$request->month;
        $data['year']=$request->year;
        $data['Qty']=$request->Qty;
        $data['Cost']=$request->Cost;

        $check = Cart::where('Name', $data['Name'])->where('Quantity',$data['Quantity'])->where('Price',$data['Price'])->where('product_id',$data['product_id'])
        ->where('date',$data['date'])->where('month',$data['month'])->where('year',$data['year'])->where('Qty',$data['Qty'])->where('Cost',$data['Cost'])->get();

        if(count($check) > 0){
            session()->flash('message','Already in cart');
        }else{
            $add = Cart::create($data);
        }


        return back();
    }




    // public function update_cart(Request $request,$id){

    //     $data_update = request()->validate([
    //         'Quantity'=>'required',
    //         // 'Qty'=>'required'
    //     ]);
    //     $cart = Cart::where('id',$id)->first();

    //   $cart1 = $request->input('Quantity');

    //     if ($cart1 < $cart->Qty or $cart1 == $cart->Qty ) {
    //         Cart::whereId($id)->update($data_update);
    //         return back();
    //     }else {

    //         session()->flash('message','The new order has exceeded quantity in stock please reduce quantity !!!');
    //     // echo 'much';
    //     return back();
    // }
    // }



    public function update_cart_all()
    {
    $input = new Cart();
    $input->Qty = request('Qty');
    $input->Quantity = request('Quantity');
    $input->Name =  request('Name');
    $input->product_id =  request('product_id');

    $qtyArr = $input->Qty;
    $idArr = $input->product_id;
    $qtyQuantity = $input->Quantity;

    $pro_nameArr =$input->Name;
    $i =0;
    foreach ($qtyArr as $in) {
        Cart::where('product_id', $idArr[$i])->where('Name',$pro_nameArr[$i])->update(['Quantity'=>$qtyQuantity[$i]
    ]);
        $i++;
    }
    Session()->flash('message', 'Successfully Updated. Fill The Information Below.');
    return back();
    }




    public function destory_cart($id){
     $destory_cart = Cart::find($id);
      $destory_cart->delete();
      return back();
    }




}
