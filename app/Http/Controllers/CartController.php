<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;

// use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Ramsey\Uuid\v1;

class CartController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function barcode_scanner(Request $request){
        $data = $request->only(['user_id', 'Name', 'Quantity', 'Price', 'product_id', 'date', 'month', 'year', 'Qty', 'Cost']);
        $check = Cart::where('Name', $data['Name'])
                     ->where('Quantity', $data['Quantity'])
                     ->where('Price', $data['Price'])
                     ->where('product_id', $data['product_id'])
                     ->where('date', $data['date'])
                     ->where('month', $data['month'])
                     ->where('year', $data['year'])
                     ->where('Qty', $data['Qty'])
                     ->where('Cost', $data['Cost'])
                     ->get();

        if(count($check) > 0){
            return response()->json(['message' => 'Already in cart']);
        } else {
            $pro = Product::where('barcode', $request->barcode_scanner)->first();

            if($pro) {
                $data['Name'] = $pro->Name;
                $data['Quantity'] = 1;
                $data['Price'] = $pro->Price;
                $data['product_id'] = $pro->id;
                $data['Qty'] = $pro->Quantity;
                $data['Cost'] = $pro->Cost;
                $data['date'] = date('d/m/y');
                $data['month'] = date('F');
                $data['year'] = date('Y');
                Cart::create($data);
                return response()->json([
                    'message' => 'Product added to cart successfully',
                    'status'=>200
                ]);
            } else {
                return response()->json(['message' => 'Product not found for the scanned barcode'], 404);
            }
        }
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
            Cart::create($data);
        }
        return back();
    }


    // public function fetch_cart(){
    //     $get_cart = Cart::all();
    //     $total = 0;
    //     return view('Admin.Pos.Pos', compact('get_cart', 'total'));
    // }

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
$input->Name = request('Name');
$input->product_id = request('product_id');

$qtyArr = $input->Qty;
$idArr = $input->product_id;
$qtyQuantity = $input->Quantity;
$pro_nameArr = $input->Name;

foreach ($qtyArr as $i => $qty) {
    $cartItem = Cart::where('product_id', $idArr[$i])->where('Name', $pro_nameArr[$i])->first();

    if (!$cartItem) {
        // If the item is not found in the cart, handle the error
        Session()->flash('message', 'Item not found in the cart.');
        return back();
    }

    // Check if the requested quantity exceeds the available stock quantity
    if ($cartItem->Quantity >= $qty) {
        // If the requested quantity exceeds the available stock quantity, handle the error
        Session()->flash('message', 'Your request for ' . $cartItem->Name . ' exceeds the available stock quantity. Please try again.');
        return back();
    }
}

// If all checks pass, update the quantities in the cart
foreach ($qtyArr as $i => $qty) {
    $cartItem = Cart::where('product_id', $idArr[$i])->where('Name', $pro_nameArr[$i])->first();
    $cartItem->update(['Quantity' => $qtyQuantity[$i]]);
}

// Redirect back with success message
Session()->flash('message', 'Quantities updated successfully.');
return back();

    }




    public function destory_cart($id){
     $destory_cart = Cart::find($id);
      $destory_cart->delete();
      return back();
    }




}
