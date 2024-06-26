<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderIteams;
use App\Models\orders_payment;
use App\Models\Payment_due;
use App\Models\Pos;
use App\Models\Pos_deu;
use App\Models\Product;
use App\Models\Product_midwifery;
use App\Models\Service_order;
// use App\Models\OrderIteams;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;

class PosController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function Pos(){
        $product =  Product::with('category')->get();
        $customer = Customer::get();
        $get_cart = Cart::get();
        $get_post=Cart::get();
        $get_customer= Customer::get();
        $pending = DB::table('orders')->where('order_status','pending')->get();
        $count= DB::table('carts')->sum('Quantity');


        $date = (date('Y-d-m'));
        $new_date = date('d/m/y');

        $daily = Order::with('orderIteams')->where('date', $date)->where('order_status','success')->orWhere('new_date',$new_date)->get();



        $cash = DB::table('orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','Cash')->sum('pay');


        $new_pos = DB::table('orders')->where('new_date', $new_date)->where('order_status','success')->where('new_mode_of_payment','Pos')->sum('new_due');
        $new_transfer= DB::table('orders')->where('new_date', $new_date)->where('order_status','success')->where('new_mode_of_payment','Transfer')->sum('new_due');
        $new_cash = DB::table('orders')->where('new_date', $new_date)->where('order_status','success')->where('new_mode_of_payment','Cash')->sum('new_due');
        $tranfer = DB::table('orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','Transfer')->sum('cash_transfer');
        $pos = DB::table('orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','Pos')->sum('cash_pos');
        $cash_transfer  = DB::table('orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','cash_transfer')->sum('cash_transfer');
        $cash_cash  = DB::table('orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','cash_transfer')->sum('pay');

        $cash_pos =DB::table('orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','cash_pos')->sum('cash_pos');

        $cash_cash_pos  = DB::table('orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','cash_pos')->sum('pay');

        $amount = DB::table('orders')->where('date', $date)->where('order_status','success')->sum('pay');

        return view('Admin.Pos.Pos',['product'=>$product,'customer'=>$customer,'get_cart'=>$get_cart,
        'count'=>$count,'get_post'=>$get_post,'get_customer'=>$get_customer,'pending'=>$pending,
        'daily'=>$daily,'amount'=>$amount,'cash'=>$cash,'tranfer'=>$tranfer,'pos'=>$pos,
        'cash_transfer'=>$cash_transfer,'cash_cash'=>$cash_cash,'cash_pos'=>$cash_pos,'cash_cash_pos'=>$cash_cash_pos,
        'new_pos'=>$new_pos,'new_transfer'=>$new_transfer,'new_cash'=>$new_cash]);
    }


    public function direct_print(){
        $lastOrder = Order::latest()->first();
        $finalPrice = $lastOrder->pay + $lastOrder->cash_transfer+ $lastOrder->cash_pos;
        $Pos_invoice = OrderIteams::where('order_id', $lastOrder->id)->get();
        return view("Admin.Pos.direct_print",['Pos_invoice'=>$Pos_invoice,'finalPrice'=>$finalPrice]);
    }

     public function Pos_store(Request $request){
        $order = new Order();
        $order->fname =$request->input('fname');
        $order->phone =$request->input('phone');
        $order->address =$request->input('address');
        $order->discount =$request->input('discount');
        $order->date =$request->input('date');
        $order->month =$request->input('month');
        $order->location =$request->input('location');
        $order->year =$request->input('year');
        $order->user_id =$request->input('user_id');
        $order->order_status =$request->input('order_status');
        $order->Mode_of_payment =$request->input('Mode_of_payment');
        $order->pay =$request->input('pay');
        $order->due =$request->input('due');
        $order->Payment_type =$request->input('Payment_type');
        $order->trackking_id = rand(1111,9999);
        $total = 0;
        $cartitem_total = Cart::where('user_id',Auth::id())->get();
        foreach($cartitem_total as $prod){
            $total+= $prod->Price * $prod->Quantity;
             $cost= $prod->Cost;
        }
       $order->total_price = $total;
       $order->Cost = $cost;
        $order->save();
         $cart = Cart::where('user_id',Auth::id())->get();
         foreach($cart as $cat){
            OrderIteams::create([
                'order_id'=>$order->id,
                'user_id'=>$cat->user_id,
                'prod_id'=>$cat->Name,
                'qty'=>$cat->Quantity,
                'price'=>$cat->Price,
                'product_id'=>$cat->product_id,
                'date'=>$cat->date,
                'month'=>$cat->month,
                'year'=>$cat->year,
                'location'=>'MVC',
		'Cost'=>$cat->Cost
            ]);
            $curQty = Product::where("id",$cat->product_id)->first()->Quantity;
            Product::where("id",$cat->product_id)->update(['Quantity'=>$curQty-$cat->Quantity,'syn_flag'=>0]);
        }
            $cart = Cart::where('user_id',Auth::id())->get();
            Cart::destroy($cart);
            // Session()->flash('message', 'Item(s) are pending');
            //  return back();
               return redirect()->route('Admin.Pos.Pos_pending');
         }





         public function directPayment(Request $request){
            $order = new Order();
            $order->fname =$request->input('fname');
            $order->phone =$request->input('phone');
            $order->address =$request->input('address');
            $order->discount =$request->input('discount');
            $order->date =$request->input('date');
            $order->month =$request->input('month');
            $order->location =$request->input('location');
            $order->year =$request->input('year');
            $order->user_id =$request->input('user_id');
            $order->order_status =$request->input('order_status');
            $order->Mode_of_payment =$request->input('Mode_of_payment');
            $order->Payment_type =$request->input('Payment_type');
            $order->trackking_id = rand(1111,9999);

            if($request->input('Mode_of_payment') == "Pos"){
                $order->cash_pos = $request->input('pay');
            }

          if($request->input('Mode_of_payment') == "Transfer"){
                $order->cash_transfer =$request->input('pay');
            }

            if($request->input('Mode_of_payment') == "Cash"){
                $order->pay =$request->input('pay');
            }

            if($request->input('Mode_of_payment') == "cash_transfer"){
                $order->pay =$request->input('transfer_pay');
                $order->cash_transfer =$request->input('cash_transfer');
            }


            if($request->input('Mode_of_payment') == "cash_pos"){
                $order->pay =$request->input('pos_pay');
                $order->cash_pos =$request->input('cash_pos');
            }
            $total = 0;
            $cartitem_total = Cart::where('user_id',Auth::id())->get();
            foreach($cartitem_total as $prod){
                $total+= $prod->Price * $prod->Quantity;
                 $cost= $prod->Cost;
            }
           $order->total_price = $total;
           $order->Cost = $cost;
           if($request->input('Mode_of_payment') == "Pos" || $request->input('Mode_of_payment') == "Transfer" || $request->input('Mode_of_payment') == "Cash" ){
            $order->save();
            $cart = Cart::where('user_id',Auth::id())->get();
            foreach($cart as $cat){
               OrderIteams::create([
                   'order_id'=>$order->id,
                   'user_id'=>$cat->user_id,
                   'prod_id'=>$cat->Name,
                   'qty'=>$cat->Quantity,
                   'price'=>$cat->Price,
                   'product_id'=>$cat->product_id,
                   'date'=>$cat->date,
                   'month'=>$cat->month,
                   'year'=>$cat->year,
                   'location'=>'MVC',
                    'Cost'=>$cat->Cost
               ]);
               $curQty = Product::where("id",$cat->product_id)->first()->Quantity;
               Product::where("id",$cat->product_id)->update(['Quantity'=>$curQty-$cat->Quantity,'syn_flag'=>0]);
            }
               $cart = Cart::where('user_id',Auth::id())->get();
               Cart::destroy($cart);

               if ($request->checkbox_print == 1){
                   return redirect()->route("Admin.Pos.direct_print");
               }else{
                Session()->flash('success', 'Your payment has been successfully processed. Thank you for your purchase!');

                   return back();
               }
           }
           elseif($request->input('Mode_of_payment') == "cash_transfer" && $request->input('transfer_pay') + $request->input('cash_transfer') == $total ||
            $request->input('Mode_of_payment') == "cash_pos" && $request->input('cash_pos') + $request->input('pos_pay') == $total)
           {
            $order->save();
            $cart = Cart::where('user_id',Auth::id())->get();
            foreach($cart as $cat){
               OrderIteams::create([
                   'order_id'=>$order->id,
                   'user_id'=>$cat->user_id,
                   'prod_id'=>$cat->Name,
                   'qty'=>$cat->Quantity,
                   'price'=>$cat->Price,
                   'product_id'=>$cat->product_id,
                   'date'=>$cat->date,
                   'month'=>$cat->month,
                   'year'=>$cat->year,
                   'location'=>'MVC',
                    'Cost'=>$cat->Cost
               ]);
               $curQty = Product::where("id",$cat->product_id)->first()->Quantity;
               Product::where("id",$cat->product_id)->update(['Quantity'=>$curQty-$cat->Quantity,'syn_flag'=>0]);
            }
               $cart = Cart::where('user_id',Auth::id())->get();
               Cart::destroy($cart);

               if ($request->checkbox_print == 1){
                   return redirect()->route("Admin.Pos.direct_print");
               }else{

                Session()->flash('success', 'Your payment has been successfully processed. Thank you for your purchase!');

                 return back();
               }
           }
          else{
            Session()->flash('error1', 'Payment unsuccessful. Please try again or contact support for assistance.');
            return back();
           }
    }


     public function Pos_view(){
     $pos_view = Order::get();
     return view('Admin.Pos.Pos_view',['pos_view'=>$pos_view]);
     }

     public function Pos_invoice($id){
       $Pos_invoice =Order::with('orderIteams')->where('id',$id)->first();
       $banklist =DB::table('bank_lists')->get();
         return view('Admin.Pos.Pos_invoice',['Pos_invoice'=>$Pos_invoice,'banklist'=>$banklist]);
     }

     public function daily_sales_view($id){

        $Pos_invoice =Order::with('orderIteams')->where('id',$id)->first();

        return view('Admin.Pos.daily_sales_view',['Pos_invoice'=>$Pos_invoice]);
     }


     public function Pos_invoice_view($id){


        $Pos_invoice =Order::with('orderIteams')->where('id',$id)->first();

        // $discount

        return view('Admin.Pos.Pos_invoice_view',['Pos_invoice'=>$Pos_invoice]);
     }


     public function order_status($id){

        $order_status = DB::table('orders')->where('id',$id)->update(['order_status'=>'success']);

        return redirect()->route('Admin.Pos.Pos');
     }




     public function order_cash($id){

        $order_status = DB::table('orders')->where('id',$id)->update(['Mode_of_payment'=>'Cash']);

        return back();
     }



     public function order_pos($id){

        $order_status = DB::table('orders')->where('id',$id)->update(['Mode_of_payment'=>'Pos']);

        return back();
     }


     public function order_transfer($id){

        $order_status = DB::table('orders')->where('id',$id)->update(['Mode_of_payment'=>'Transfer']);

        return back();
     }

     public function cash_pos($id){

        $order_status = DB::table('orders')->where('id',$id)->update(['Mode_of_payment'=>'cash_pos']);

        return back();
     }


     public function cash_transfer($id){

        $order_status = DB::table('orders')->where('id',$id)->update(['Mode_of_payment'=>'cash_transfer']);

        return back();
     }


     public function Pos_pending(){
        $pending = DB::table('orders')->where('order_status','pending')->get();
        return view('Admin.Pos.Pos_pending',['pending'=>$pending]);
     }

     public function Pos_pending_delete($id){

      $Pos_pending_delete=Order::find($id);


      $return = Order::with('orderIteams')->where('id',$id)->first();

        foreach($return->orderIteams as $item){
            $curQty = Product::where("id",$item->product_id)->first()->Quantity;
            // dd($curQty);
            Product::where("id",$item->product_id)->update(['Quantity'=>$curQty+$item->qty]);

        }
       $Pos_pending_delete->delete();
       session()->flash('message', 'Item deleted, and returned back to store!');
       return back();

     }


     public function Pos_update(Request $request,  $id){
        $input = request()->validate([
            'total_price'=>'required',
            // 'Mode_of_payment'=>'required',
            'pay'=>'required',
            'due'=>'required',
            'Payment_type'=>'required',
            'cash_transfer'=>'required',
            'cash_pos'=>'required',
        ]);
        $input['bankName'] = request("bankName");
    if((request('Mode_of_payment')=='Cash') != request('pay')){

        session()->flash('success','Transaction Successful!!!');
             }else{
                session()->flash('success','Transaction Successful!!!');
             };

             if((request('Mode_of_payment')=='Transfer') != request('cash_transfer')){

                session()->flash('success','Transaction Successful!!!');
            }else{
                session()->flash('success','Transaction Successful!!!');
            };

            if((request('Mode_of_payment')=='Pos') != request('cash_pos')){

                session()->flash('success','Transaction Successful!!!');
            }else{
                session()->flash('success','Transaction Successful!!!');
            };


          if (request('pay') + request('cash_transfer') + request('cash_pos') <= request('total_price')) {
              Order::whereId($id)->update([
            'due'=>$input['total_price']-$input['pay']-$input['cash_transfer']-$input['cash_pos']-$input['due'],
            'pay'=>$input['pay'],
            // 'Mode_of_payment'=>$input['Mode_of_payment'],
            'Payment_type'=>$input['Payment_type'],
            'cash_transfer'=>$input['cash_transfer'],
            'cash_pos'=>$input['cash_pos'],
            'total_price'=>$input['total_price'],
            'bankName'=>$input['bankName'],
            'syn_flag'=>'0'
         ]);
        } else{

            session()->flash('payment','Amount entered is greater than total bill. please enter a valid payment');
        }

        if (request('pay') + request('cash_transfer') + request('cash_pos')  == request('total_price')) {
            Order::whereId($id)->update(['Payment_type'=>'Full Payment',
            'due'=>$input['total_price']-$input['pay']-$input['cash_transfer']-$input['cash_pos']-$input['due'],
            'pay'=>$input['pay'],
            // 'Mode_of_payment'=>$input['Mode_of_payment'],
            'cash_transfer'=>$input['cash_transfer'],
            'cash_pos'=>$input['cash_pos'],
            'total_price'=>$input['total_price'],
            'bankName'=>$input['bankName'],
            'syn_flag'=>'0'
        ]);
     }

        return back();

    }

public function daily_sales_update(Request $request, $id){
        $input = request()->validate([
            'total_price'=>'required',
            'Mode_of_payment'=>'required',
            'pay'=>'required',
            'due'=>'required',
            'Payment_type'=>'required',
            'cash_transfer'=>'required',
            'cash_pos'=>'required',
        ]);

        if((request('Mode_of_payment')=='Cash') != request('pay')){

            session()->flash('error','But wrong Mode of payemnt please make sure you update that before the end of today Or');
                 }else{
                    session()->flash('success','Transaction Successful!!!');
                 };

                 if((request('Mode_of_payment')=='Transfer') != request('cash_transfer')){

                    session()->flash('error',' But wrong Mode of payemnt please make sure you update that before the end of today Or');
                }else{
                    session()->flash('success','Transaction Successful!!!');
                };

                if((request('Mode_of_payment')=='Pos') != request('cash_pos')){

                    session()->flash('error','But wrong Mode of payemnt please make sure you update that before the end of today Or');
                }else{
                    session()->flash('success','Transaction Successful!!!');
                };

          if (request('pay') + request('cash_transfer') + request('cash_pos') <= request('total_price')) {
              Order::whereId($id)->update([
            'due'=>$input['total_price']-$input['pay']-$input['cash_transfer']-$input['cash_pos']-$input['due'],
            'pay'=>$input['pay'],
            'Mode_of_payment'=>$input['Mode_of_payment'],
            'Payment_type'=>$input['Payment_type'],
            'cash_transfer'=>$input['cash_transfer'],
            'cash_pos'=>$input['cash_pos'],
            'total_price'=>$input['total_price'],
            'syn_flag'=>'0'
         ]);
        } else{

            session()->flash('payment','Amount Enter is Greater Than Total Bill, Please Enter a Vaild Payment!!!');
        }

        if (request('pay') + request('cash_transfer') + request('cash_pos')  == request('total_price')) {
            Order::whereId($id)->update(['Payment_type'=>'Full Payment',
            'due'=>$input['total_price']-$input['pay']-$input['cash_transfer']-$input['cash_pos']-$input['due'],
            'pay'=>$input['pay'],
            'Mode_of_payment'=>$input['Mode_of_payment'],
            'cash_transfer'=>$input['cash_transfer'],
            'cash_pos'=>$input['cash_pos'],
            'total_price'=>$input['total_price'],
            'syn_flag'=>'0'
        ]);
     }

   return redirect()->route('Admin.Pos.daily_sales_report');
    }


    public function daily_sales_edit($id){

        $daily_sales_edit = Order::where('id',$id)->first();

return view('Admin.Pos.daily_sales_edit',['daily_sales_edit'=>$daily_sales_edit]);
    }


     public function Pos_invoice_discount(Request $request, $id){

        $input = request()->validate([
            'discount'=>'required'
        ]);
        Order::whereId($id)->update($input);

        session()->flash('Discount','Discount Subtracted');

        return back();

     }

     public function print_invoice($id){

        $Pos_invoice =Order::with('orderIteams')->where('id',$id)->where('user_id',Auth::id())->first();

        $print=Order::with('orderIteams')->where('id',$id)->where('user_id',Auth::id())->first();
       $cash_transfer=Order::with('orderIteams')->where('id',$id)->where('user_id',Auth::id())->sum('cash_transfer');
       $pay=Order::with('orderIteams')->where('id',$id)->where('user_id',Auth::id())->sum('pay');
        $cash_pos=Order::with('orderIteams')->where('id',$id)->where('user_id',Auth::id())->sum('cash_pos');

        return view('Admin.Pos.print_invoice',['Pos_invoice'=>$Pos_invoice, 'print'=>$print,'cash_pos'=>$cash_pos,'pay'=>$pay,'cash_transfer'=>$cash_transfer]);

     }


    public function daily_sales_report(){
        $date = (date('Y-d-m'));
        $new_date = date('d/m/y');

        $daily = Order::with('orderIteams')->where('date', $date)->where('order_status','success')->orWhere('new_date',$new_date)->get();

        $cash = DB::table('orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','Cash')->sum('pay');
        $new_pos = DB::table('orders')->where('new_date', $new_date)->where('order_status','success')->where('new_mode_of_payment','Pos')->sum('new_due');
        $new_transfer= DB::table('orders')->where('new_date', $new_date)->where('order_status','success')->where('new_mode_of_payment','Transfer')->sum('new_due');
        $new_cash = DB::table('orders')->where('new_date', $new_date)->where('order_status','success')->where('new_mode_of_payment','Cash')->sum('new_due');
        $tranfer = DB::table('orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','Transfer')->sum('cash_transfer');
        $pos = DB::table('orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','Pos')->sum('cash_pos');
        $cash_transfer  = DB::table('orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','cash_transfer')->sum('cash_transfer');
        $cash_cash  = DB::table('orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','cash_transfer')->sum('pay');

        $cash_pos =DB::table('orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','cash_pos')->sum('cash_pos');

        $cash_cash_pos  = DB::table('orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','cash_pos')->sum('pay');

        $amount = DB::table('orders')->where('date', $date)->where('order_status','success')->sum('pay');


        return view('Admin.Pos.daily_sales_report',['daily'=>$daily,'amount'=>$amount,'cash'=>$cash,'tranfer'=>$tranfer,'pos'=>$pos,'cash_transfer'=>$cash_transfer,'cash_cash'=>$cash_cash,'cash_pos'=>$cash_pos,'cash_cash_pos'=>$cash_cash_pos,'new_pos'=>$new_pos,'new_transfer'=>$new_transfer,'new_cash'=>$new_cash]);
    }




    public function due(){
        $daily =  Order::with('orderIteams')->where('order_status','success')->where('Payment_type','Half Payment')->get();

        $amount = DB::table('orders')->where('order_status','success')->where('Payment_type','Half Payment')->sum('due');

         return view('Admin.Pos.due',['daily'=>$daily,'amount'=>$amount]);

    }


    public function store_full_payment(){
        // $date = (date('d/m/y'));
        $daily = DB::table('orders')->where('order_status','success')->where('Payment_type','Full Payment')->get();
        $amount = DB::table('orders')->where('order_status','success')->sum('pay');
        $amount_due = DB::table('orders')->where('order_status','success')->where('Payment_type','Half Payment')->sum('due');
     return view('Admin.Pos.store_full_payment',['daily'=>$daily,'amount'=>$amount,'amount_due'=>$amount_due]);
    }






    public function store_due(){
        $daily = Order::with('orderIteams')->where('order_status','success')->where('Payment_type','Half Payment')->get();
        $amount = DB::table('orders')->where('order_status','success')->where('Payment_type','Half Payment')->sum('due');
         return view('Admin.Pos.store_due',['daily'=>$daily,'amount'=>$amount]);

    }


    public function store_transfer(){
        // $date = (date('d/m/y'));
        $daily = DB::table('orders')->where('order_status','success')->where('Mode_of_payment','Transfer')->get();
        $amount = DB::table('orders')->where('order_status','success')->where('Mode_of_payment','Transfer')->sum('cash_transfer');
        return view('Admin.Pos.store_transfer',['daily'=>$daily,'amount'=>$amount]);
    }



    public function store_pos(){
        // $date = (date('d/m/y'));
        $daily = DB::table('orders')->where('order_status','success')->where('Mode_of_payment','Pos')->get();
        $amount = DB::table('orders')->where('order_status','success')->where('Mode_of_payment','Pos')->sum('cash_pos');
      return view('Admin.Pos.store_pos',['daily'=>$daily,'amount'=>$amount]);
    }


    public function store_cash(){

        $daily = DB::table('orders')->where('order_status','success')->where('Mode_of_payment','Cash')->get();
        $amount = DB::table('orders')->where('order_status','success')->where('Mode_of_payment','Cash')->sum('pay');
       return view('Admin.Pos.store_cash',['daily'=>$daily,'amount'=>$amount]);
    }


    public function due_edit($id){
     $due_edit = DB::table('orders')->where('id',$id)->first();
      return view('Admin.Pos.due_edit',['due_edit'=>$due_edit]);
    }


    public function due_update(Request $request,$id){
        $input = request()->validate([
            'total_price'=>'required',
            'Payment_type'=>'required',
            'Mode_Of_Payment'=>'required',
            'pay'=>'required',
            'due'=>'required',
            'fname'=>'required',
            'location'=>'required',
            'syn_flag'=>'0',

        ]);

        Order::whereId($id)->update([
            // 'pay'=> DB::raw('pay+'.$input['due']),
            'due'=>$input['total_price']-$input['pay']-$input['due'],
            'syn_flag'=>'0',
            'new_due'=>$input['due'],
            'new_date'=>date('d/m/y'),
            'new_mode_of_payment'=>$input['Mode_Of_Payment'],
            'new_payment_user_id'=>Auth::id()
        ]);


        Pos_deu::create($input);
        return redirect()->route('Admin.Pos.due');
    }



    public function transfer_cash(){

        $month = date('F');
        $transfer_cash = Order::where('Mode_of_payment','cash_transfer')->where('month',$month)->get();
        $amount = Order::where('Mode_of_payment','cash_transfer')->where('month',$month)->sum('cash_transfer');
        $cash = Order::where('Mode_of_payment','cash_transfer')->where('month',$month)->sum('pay');
        $cash_transfer = Order::where('Mode_of_payment','cash_transfer')->where('month',$month)->sum('cash_transfer');
        return view('Admin.Pos.transfer_cash',['transfer_cash'=>$transfer_cash,'amount'=>$amount,'cash'=>$cash]);

    }


    public function pos_cash(){
        $month = date('F');
        $pos_cash = Order::where('Mode_of_payment','cash_pos')->where('month',$month)->get();
        $amount = Order::where('Mode_of_payment','cash_pos')->where('month',$month)->sum('cash_pos');
        $cash = Order::where('Mode_of_payment','cash_pos')->where('month',$month)->sum('pay');
        return view('Admin.Pos.pos_cash',['pos_cash'=>$pos_cash,'amount'=>$amount,'cash'=>$cash]);

    }


      public function sales_history(){
        ini_set('memory_limit', '256M');
        $month =date('F');
        $date = (date('Y-d-m'));
        $year = (date("Y"));
        $new_date = date('d/m/y');
        // dd($year);
        $daily = Order::with('orderIteams')->where('month',$month)->where('year',$year)->where('order_status','success')->orWhere('new_date',$new_date)->get();
        $cash = DB::table('orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','Cash')->sum('pay');
        $new_pos = DB::table('orders')->where('new_date', $new_date)->where('order_status','success')->where('new_mode_of_payment','Pos')->sum('new_due');
        $new_transfer= DB::table('orders')->where('new_date', $new_date)->where('order_status','success')->where('new_mode_of_payment','Transfer')->sum('new_due');
        $new_cash = DB::table('orders')->where('new_date', $new_date)->where('order_status','success')->where('new_mode_of_payment','Cash')->sum('new_due');
        $tranfer = DB::table('orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','Transfer')->sum('cash_transfer');
        $pos = DB::table('orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','Pos')->sum('cash_pos');
        $cash_transfer  = DB::table('orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','cash_transfer')->sum('cash_transfer');
        $cash_cash  = DB::table('orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','cash_transfer')->sum('pay');

        $cash_pos =DB::table('orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','cash_pos')->sum('cash_pos');

        $cash_cash_pos  = DB::table('orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','cash_pos')->sum('pay');

        $amount = DB::table('orders')->where('date', $date)->where('order_status','success')->sum('pay');

     return view('Admin.Pos.sales_history',['daily'=>$daily,'amount'=>$amount,'cash'=>$cash,'tranfer'=>$tranfer,'pos'=>$pos,'cash_transfer'=>$cash_transfer,'cash_cash'=>$cash_cash,'cash_pos'=>$cash_pos,'cash_cash_pos'=>$cash_cash_pos,'new_pos'=>$new_pos,'new_transfer'=>$new_transfer,'new_cash'=>$new_cash ]);


    }


 public function today_items(){
    $today_items = OrderIteams::with('user')->select(DB::raw('sum(qty) as total_quantity'), 'prod_id','price','user_id')->groupBy('prod_id','price','user_id')->get();
    return view('Admin.Pos.today_items',['today_items'=>$today_items]);
 }


 public function today_items_cashier(){
    $today_items = OrderIteams::with('user')->select(DB::raw('sum(qty) as total_quantity'), 'prod_id','price','user_id')->groupBy('prod_id','price','user_id')->where('date', date('d/m/y'))->get();
    return view('Admin.Pos.today_items_cashier',['today_items'=>$today_items]);
 }




 //  search
  public function search(Request $request){
$new_date = date('d/m/y');
    $date= $request->input('from');


  $search = Order::with('orderIteams')->whereDate('created_at', $date)
    ->orWhere('new_date',$new_date)->get();



    $cash = DB::table('orders')->where('order_status','success')->where('Mode_of_payment','Cash')->whereDate('created_at', $date)->sum('pay');
    $tranfer = DB::table('orders')->where('order_status','success')->where('Mode_of_payment','Transfer')  ->whereDate('created_at', $date)->sum('cash_transfer');
    $pos = DB::table('orders')->where('order_status','success')->where('Mode_of_payment','Pos')  ->whereDate('created_at', $date)->sum('cash_pos');
    $cash_transfer  = DB::table('orders')->where('order_status','success')->where('Mode_of_payment','cash_transfer')  ->whereDate('created_at', $date)->sum('cash_transfer');
    $cash_cash  = DB::table('orders')->where('order_status','success')->where('Mode_of_payment','cash_transfer')  ->whereDate('created_at', $date)->sum('pay');
    $cash_pos =DB::table('orders')->where('order_status','success')->where('Mode_of_payment','cash_pos')  ->whereDate('created_at', $date)->sum('cash_pos');
    $cash_cash_pos  = DB::table('orders')->where('order_status','success')->where('Mode_of_payment','cash_pos')  ->whereDate('created_at', $date)->sum('pay');
    $amount = DB::table('orders')->where('order_status','success')  ->whereDate('created_at', $date)->sum('pay');

    $new_pos = DB::table('orders')->where('new_date', $new_date)->where('order_status','success')->where('new_mode_of_payment','Pos')->sum('new_due');
    $new_transfer= DB::table('orders')->where('new_date', $new_date)->where('order_status','success')->where('new_mode_of_payment','Transfer')->sum('new_due');
    $new_cash = DB::table('orders')->where('new_date', $new_date)->where('order_status','success')->where('new_mode_of_payment','Cash')->sum('new_due');


    return view('Admin.Pos.search',['search'=>$search,'amount'=>$amount,'cash'=>$cash,'tranfer'=>$tranfer,'pos'=>$pos,'cash_transfer'=>$cash_transfer,'cash_cash'=>$cash_cash,'cash_pos'=>$cash_pos,'cash_cash_pos'=>$cash_cash_pos,'new_pos'=>$new_pos,'new_transfer'=>$new_transfer,'new_cash'=>$new_cash]);

  }




  public function today(Request $request){
    $date= $request->input('from');
    $search=OrderIteams::with('user')->select(DB::raw('sum(qty) as total_quantity'), 'prod_id','price','user_id')->groupBy('prod_id','price','user_id') ->whereDate('created_at', $date)->get();
    return view('Admin.Pos.today_search',['search'=>$search]);
  }



  public function payment_search(Request $request){

    $date= $request->input('from');

    $search=  DB::table('service_orders')
    ->whereDate('created_at', $date)
    ->get();
    $new_date = date('d/m/y');
    $pay=Service_order::with('user')->with('service_item')->whereDate('created_at', $date)->orWhere('new_date',$new_date)->where('order_status','success')->get();
    $cash = DB::table('service_orders')->whereDate('created_at', $date)->where('order_status','success')->where('Mode_of_payment','Cash')->sum('pay');
    $new_pos = DB::table('service_orders')->whereDate('created_at', $date)->where('new_date', $new_date)->where('order_status','success')->where('new_mode_of_payment','Pos')->sum('new_due');
    $new_transfer= DB::table('service_orders')->where('new_date', $new_date)->where('order_status','success')->where('new_mode_of_payment','Transfer')->sum('new_due');
    $new_cash = DB::table('service_orders')->where('new_date', $new_date)->where('order_status','success')->where('new_mode_of_payment','Cash')->sum('new_due');
    $tranfer = DB::table('service_orders')->whereDate('created_at', $date)->where('order_status','success')->where('Mode_of_payment','Transfer')->sum('cash_transfer');
    $pos = DB::table('service_orders')->whereDate('created_at', $date)->where('order_status','success')->where('Mode_of_payment','Pos')->sum('cash_pos');
    $cash_transfer  = DB::table('service_orders')->whereDate('created_at', $date)->where('order_status','success')->where('Mode_of_payment','cash_transfer')->sum('cash_transfer');
    $cash_cash  = DB::table('service_orders')->whereDate('created_at', $date)->where('order_status','success')->where('Mode_of_payment','cash_transfer')->sum('pay');
    $cash_pos =DB::table('service_orders')->whereDate('created_at', $date)->where('order_status','success')->where('Mode_of_payment','cash_pos')->sum('cash_pos');
    $cash_cash_pos  = DB::table('service_orders')->whereDate('created_at', $date)->where('order_status','success')->where('Mode_of_payment','cash_pos')->sum('pay');
    $amount = DB::table('service_orders')->whereDate('created_at', $date)->where('order_status','success')->sum('pay');
    return view('Admin.Pos.payment_search',['search'=>$search,'pay'=>$pay,'amount'=>$amount,'cash'=>$cash,'tranfer'=>$tranfer,'pos'=>$pos,'cash_transfer'=>$cash_transfer,'cash_cash'=>$cash_cash,'cash_pos'=>$cash_pos,'cash_cash_pos'=>$cash_cash_pos,'new_pos'=>$new_pos,'new_transfer'=>$new_transfer,'new_cash'=>$new_cash]);
  }




  public function balance(){

    $balance = Pos_deu::get();
    $amount =  Pos_deu::sum('due');
    $cash = DB::table('pos_deus')->where('Mode_of_payment','Cash')->sum('due');
    $tranfer = DB::table('pos_deus')->where('Mode_of_payment','Transfer')->sum('due');
    $pos = DB::table('pos_deus')->where('Mode_of_payment','Pos')->sum('due');
return view('Admin.Pos.balance',['balance'=>$balance,'amount'=>$amount,'cash'=>$cash,'tranfer'=>$tranfer,'pos'=>$pos]);
  }

  public function search_dubts(Request $request){
    $date= $request->input('from');
    $search=  DB::table('pos_deus')
    ->whereDate('created_at', $date)
    ->get();
    $cash = DB::table('pos_deus')->where('Mode_of_payment','Cash') ->whereDate('created_at', $date)->sum('due');
    $tranfer = DB::table('pos_deus')->where('Mode_of_payment','Transfer') ->whereDate('created_at', $date)->sum('due');
    $pos = DB::table('pos_deus')->where('Mode_of_payment','Pos') ->whereDate('created_at', $date)->sum('due');
    $amount = DB::table('pos_deus')->sum('due');
    $balance = Pos_deu::whereDate('created_at', $date)->get();
  return view('Admin.Pos.search_dubts',['cash'=>$cash,'tranfer'=>$tranfer,'pos'=>$pos,'amount'=>$amount,'balance'=>$balance]);
  }

  public function search_payment(Request $request){
    $date= $request->input('from');
    $search=  DB::table('payment_dues')
    ->whereDate('created_at', $date)
    ->get();
    $cash = DB::table('payment_dues')->where('Mode_of_payment','Cash') ->whereDate('created_at', $date)->sum('due');
    $tranfer = DB::table('payment_dues')->where('Mode_of_payment','Transfer') ->whereDate('created_at', $date)->sum('due');
    $pos = DB::table('payment_dues')->where('Mode_of_payment','Pos') ->whereDate('created_at', $date)->sum('due');
    $amount = DB::table('payment_dues')->sum('due');
    $due_payment = Payment_due::whereDate('created_at', $date)->get();
    return view('Admin.Pos.search_payment',['cash'=>$cash,'tranfer'=>$tranfer,'pos'=>$pos,'amount'=>$amount,'due_payment'=>$due_payment]);
  }

 public function newproduct_supply(Request $request){

    $date= $request->input('from');

    $new=  DB::table('newproducts')
    ->whereDate('created_at', $date)
    ->get();

    return view('Admin.Pos.newproduct_supply',['new'=>$new]);
 }


 public function cashbackseach(Request $request){

    $from= $request->input('from');
    $to = $request->input('to');
    // $new=  DB::table('cashes')
    // ->whereDate('created_at', $date)
    // ->get();
    $new=  DB::table('cashes')
    ->whereBetween('created_at', [$from, $to])
    ->get();
// $amount= DB::table('cashes')
// ->whereDate('created_at', $date)
// ->sum('amount');
$amount= DB::table('cashes')
->whereBetween('created_at', [$from, $to])
->sum('amount');

    return view('Admin.Pos.cashbackseach',['new'=>$new, 'amount'=>$amount]);
 }

public function storekseach(Request $request){
    $date= $request->input('from');
    $new=  DB::table('shop_items')
    ->whereDate('created_at', $date)
    ->get();
return view('Admin.Pos.storekseach',['new'=>$new]);
}

}
