<?php

namespace App\Http\Controllers;

use App\Models\MVC_midwifery_vaccinestores;
use App\Models\Payment;
use App\Models\Payment_due;
use App\Models\Product;
use App\Models\Product_midwifery;
use App\Models\Service;
use App\Models\Service_cart;
use App\Models\Service_item;
use App\Models\Service_clinc;
use App\Models\Service_due;
use App\Models\Service_order;
use App\Models\Shop_item;
use App\Models\Shop_order;
use App\Models\Store;
use App\Models\Store_cart;
use App\Models\Transferstore;
use App\Models\User;
use App\Models\Vaccine_due;
use App\Models\Vaccineorder;
use App\Models\Vaccinestore;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(){


        $pro = Product::get();

        $get_cart = Store_cart::get();
        $get = Store_cart::get();


        return view('Admin.Store.store',['pro'=>$pro,'get_cart'=>$get_cart,'get'=>$get]);
    }






    public function store_cart(Request $request){
        $inputs =  request()->validate([
            'user_id'=>'required',
            'Name'=>'required',
            'Quantity'=>'required',
            'Price'=>'required',
            'prod_id'=>'required',
            'date'=>'required',
            'month'=>'required',
            'year'=>'required',
            'qty'=>'required'

        ]);
            Store_cart::create($inputs);
        return back();
    }









    public function store_cart_update(Request $request,$id){

        $inputs = request()->validate([
          'Quantity'=>'required'
        ]);
        $check= Store_cart::find($id);
        if($inputs['Quantity'] > $check->qty){

            session()->flash('message','Item can\'t be more granter');

        }else{
            Store_cart::whereId($id)->update($inputs);
        }

        return back();
    }


    public function destory($id){

        $destory = Store_cart::Find($id);

        $destory->delete();

        return back();

    }

    public function store_order(Request $request){
        $shop_cart = Store_cart::where('user_id',Auth::id())->get();
        // dd($shop_cart);
        foreach($shop_cart as $shop_cart){
            Shop_item::create([
            'user_id'=>$shop_cart->user_id,
             'prod_name'=>$shop_cart->Name,
             'qty'=>$shop_cart->Quantity,
             'price'=>$shop_cart->Price,
             'pro_id'=>$shop_cart->prod_id,
              'status'=>$shop_cart->status,
             'subtotal'=>$shop_cart->subtotal,
             'date'=>$shop_cart->date,
             'month'=>$shop_cart->month,
             'year'=>$shop_cart->year,
	          'location'=>'MVC',
              'location_transfer'=>'MVC ',
              'moved'=>'moved'
            ]);
            $curQty = Product::where("id",$shop_cart->prod_id)->first()->Quantity;
            Product::where("id",$shop_cart->prod_id)->update(['Quantity'=>$curQty-$shop_cart->Quantity,'syn_flag'=>0]);
        }

        session()->flash('message','Items Move');
        $cart = Store_cart::where('user_id',Auth::id())->get();
        Store_cart::destroy($cart);
        return back();
    }



    public function update_cart_all()
    {
    $input = new Store_cart();
    $input->Price = request('Price');
    $input->Quantity = request('Quantity');
    $input->Name =  request('Name');
    $input->prod_id =  request('prod_id');
    $input->status =  request('status');
    $input->subtotal =  request('subtotal');
    $qtyArr = $input->Quantity;
    $qtyArrStatus = $input->status;
    $qtyArrsubtotal = $input->subtotal;
    $idArr = $input->prod_id;
    $qtyQuantity = $input->Quantity;
    $pro_nameArr =$input->Name;
    $i = 0;
    foreach ($qtyArr as $in) {
        Store_cart::where('prod_id', $idArr[$i])->where('Name',$pro_nameArr[$i])->update(['Quantity'=>$qtyQuantity[$i], 'status'=>$qtyArrStatus[$i], 'subtotal'=>$qtyArrsubtotal[$i]
    ]);
        $i++;
    }
    Session()->flash('message', 'Successfully Updated. Fill The Information Below.');
    return back();
    }




  public function service_due(){
    $daily = Service_order::with('service_item')->where('order_status','success')->where('Payment_type','Half Payment')->where('location','MVC')->get();
    $amount = DB::table('service_orders')->where('order_status','success')->where('Payment_type','Half Payment')->where('location','MVC')->sum('due');
    return view('Admin.Store.service_due',['daily'=>$daily,'amount'=>$amount]);
  }


  public function service_balance(){
    $balance = Payment_due::where('location','MVC')->get();
    $amount =  Payment_due::where('location','MVC')->sum('due');
    $cash = DB::table('payment_dues')->where('Mode_of_payment','Cash')->where('location','MVC')->sum('due');
    $tranfer = DB::table('payment_dues')->where('Mode_of_payment','Transfer')->where('location','MVC')->sum('due');
    $pos = DB::table('payment_dues')->where('Mode_of_payment','Pos')->where('location','MVC')->sum('due');
    return view('Admin.Store.service_balance',['balance'=>$balance,'amount'=>$amount,'cash'=>$cash,'tranfer'=>$tranfer,'pos'=>$pos]);
  }


  public function service_search(Request $request){

    $date= $request->input('from');
    $search=  DB::table('service_dues')
    ->whereDate('created_at', $date)->where('location','MVC')
    ->get();

    $cash = DB::table('payment_dues')->where('Mode_of_payment','Cash') ->whereDate('created_at', $date)->where('location','MVC')->sum('due');
    $tranfer = DB::table('payment_dues')->where('Mode_of_payment','Transfer') ->whereDate('created_at', $date)->where('location','MVC')->sum('due');
    $pos = DB::table('payment_dues')->where('Mode_of_payment','Pos') ->whereDate('created_at', $date)->where('location','MVC')->sum('due');
    $amount = DB::table('servicpayment_duese_dues')->where('location','MVC')->sum('due');
    $balance = Service_due::whereDate('created_at', $date)->where('location','MVC')->get();

    return view('Admin.Store.service_search',['cash'=>$cash,'tranfer'=>$tranfer,'pos'=>$pos,'amount'=>$amount,'balance'=>$balance]);
  }









  public function vaccine_due(){
    $daily= Vaccineorder::with('vaccineiteams')->where('order_status','success')->where('Payment_type','Half Payment')->where('location','MVC')->get();
    $amount = DB::table('vaccineorders')->where('order_status','success')->where('Payment_type','Half Payment')->where('location','MVC')->sum('due');
  return view('Admin.Store.vaccine_due',['daily'=>$daily,'amount'=>$amount]);
  }



  public function vaccine_balance(){
    $balance = Vaccine_due::where('location','MVC')->get();

    $amount =  Vaccine_due::where('location','MVC')->sum('due');

    $cash = DB::table('vaccine_dues')->where('Mode_of_payment','Cash')->where('location','MVC')->sum('due');
    $tranfer = DB::table('vaccine_dues')->where('Mode_of_payment','Transfer')->where('location','MVC')->sum('due');
    $pos = DB::table('vaccine_dues')->where('Mode_of_payment','Pos')->where('location','MVC')->sum('due');

   return view('Admin.Store.vaccine_balance',['balance'=>$balance,'amount'=>$amount,'cash'=>$cash,'tranfer'=>$tranfer,'pos'=>$pos]);
  }



  public function vaccine_search(Request $request){

    $date= $request->input('from');
    $search=  DB::table('vaccine_dues')
    ->whereDate('created_at', $date)->where('location','MVC')
    ->get();

    $cash = DB::table('vaccine_dues')->where('Mode_of_payment','Cash') ->whereDate('created_at', $date)->where('location','MVC')->sum('due');
    $tranfer = DB::table('vaccine_dues')->where('Mode_of_payment','Transfer') ->whereDate('created_at', $date)->where('location','MVC')->sum('due');
    $pos = DB::table('vaccine_dues')->where('Mode_of_payment','Pos') ->whereDate('created_at', $date)->where('location','MVC')->sum('due');
    $amount = DB::table('vaccine_dues')->where('location','MVC')->sum('due');
    $balance =  Vaccine_due::whereDate('created_at', $date)->where('location','MVC')->get();
    return view('Admin.Store.vaccine_search',['cash'=>$cash,'tranfer'=>$tranfer,'pos'=>$pos,'amount'=>$amount,'balance'=>$balance]);
  }

















    public function store_view(){
        $user=User::get();
        $pos_view = Shop_item::get();
        return view('Admin.Store.store_view',['pos_view'=>$pos_view]);
    }




    public function store_items($id){
        $Pos_invoice =Shop_order::with('Shop_item')->where('id',$id)->first();
        // $Pos_invoice =Shop_order::with('Shop_item')->where('id',$id)->where('user_id',Auth::id())->first();
        return view('Admin.Store.store_items',['Pos_invoice'=>$Pos_invoice]);
    }




    public function store_damage(){

//    $shop_orders = DB::table('store_carts')->where('status','Damage')->get();

      $shop_orders = Shop_item::where('status','Damage')->get();
// dd($shop_orders);
   return view('Admin.Store.store_damage',['shop_orders'=>$shop_orders]);
    }




    public function store_move(){

        $shop_orders = Shop_item::where('status','Head_Office_Breach_Office')->get();

        return view('Admin.Store.store_move',['shop_orders'=>$shop_orders ]);
    }




    public function service_store(){
        $service = request()->validate([
        'service'=>' required'
        ]);
        Service::create($service);
        return back();
    }

    public function service(){
        $service=Service::get();
        return view('Admin.Store.service',['service'=>$service]);
       }



       public function des($id){

        $category = Store_cart::find($id);

        $category->delete();

        session()->flash('delete','Category Deleted');

        return back();
       }

       public function service_item_store(){
        $inp = request()->validate([
            'user_id'=>'required',
            'items_name'=>'required',
            'qty'=>'required',
            'selling_price'=>'required',
            'vaccine_id'=>'required',
            'subtotal'=>'required',
            'service'=>'required',
            'Amount'=>'required',
            'service_id'=>'required',
            'Quantity'=>'required'
        ]);
        $check  = Service_cart::where('items_name', $inp['items_name'])->where('qty', $inp['qty'])->where('selling_price', $inp['selling_price'])
        ->where('vaccine_id', $inp['vaccine_id'])->where('subtotal', $inp['subtotal'])->where('service', $inp['service'])->where('Amount', $inp['Amount'])
        ->where('service_id', $inp['service_id'])->where('Quantity', $inp['Quantity'])->get();


        if(count($check) > 0 ){
            session()->flash('delete','Already Exsit');
        }else{
            Service_cart::create($inp);
        }

        return back();
       }





       public function item_store(){
        $inpee = request()->validate([
            'user_id'=>'required',
            'items_name'=>'required',
            'qty'=>'required',
            'selling_price'=>'required',
            'vaccine_id'=>'required',
            'subtotal'=>'required',
            'service'=>'required',
            'Amount'=>'required',
            'service_id'=>'required'
        ]);

        Service_cart::create($inpee);
        return back();

       }

       public function service_item_destory($id){
        $service_item_destory= Service_cart::find($id);
        $service_item_destory->delete();
        return back();
       }



       public function service_item_update(Request $request, $id){
        $inp = request()->validate([
            'qty'=>'required',
        ]);

        $cart = Service_cart::where('id',$id)->first();
        $cart1 = $request->input('qty');

        if ($cart1 < $cart->Quantity) {
            Service_cart::whereId($id)->update($inp);
            return back();
        }else{

            session()->flash('message','The new order has exceeded quantity in stock please reduce quantity !!!');
            return back();
        }
       }



       public function service_item_update2(Request $request, $id){
        $input = request()->validate([
            'Amount'=>'required',
        ]);

        Service_cart::whereId($id)->update($input);
        return back();
       }




       public function item(){
        $in = request()->validate([
            'user_id'=>'required',
            'service'=>'required',
            'Amount'=>'required',
            'items_name'=>'required',
            'qty'=>'required',
            'selling_price'=>'required',
            'vaccine_id'=>'required',
            'subtotal'=>'required',


        ]);
        Service_cart::create($in);
        return back();
       }




       public function service_item(Request $request){
              $order = New Service_order();
              $order->user_id =$request->input('user_id');
              $order->Pet_name =$request->input('Pet_name');
              $order->Owner_name =$request->input('Owner_name');
              $order->Unregister =$request->input('Unregister');
              $order->Phone =$request->input('Phone');
              $order->Next_vaccination_appointment =$request->input('Next_vaccination_appointment');
              $order->Next_appointments =$request->input('Next_appointments');
              $order->location =$request->input('location');
              $order->date =$request->input('date');
              $order->month =$request->input('month');
              $order->year =$request->input('year');
              $order->order_status =$request->input('order_status');
              $order->Mode_of_payment =$request->input('Mode_of_payment');
              $order->pay =$request->input('pay');
              $order->due =$request->input('due');
              $order->Payment_type =$request->input('Payment_type');
            //   $order->trackking_id = rand(1111,9999);
              $total = 0;
              $cartitem_total = Service_cart::where('user_id',Auth::id())->get();
              foreach($cartitem_total as $prod){
             $total+= $prod->selling_price * $prod->qty+$prod->Amount;
              }
             $order->total_price = $total;
              $order->save();
               $cart = Service_cart::where('user_id',Auth::id())->get();
               foreach($cart as $cat){
                  Service_item::create([
                      'user_id'=>$order->user_id,
                      'order_id'=>$order->id,
                      'prod_name'=>$cat->items_name,
                      'qty'=>$cat->qty,
                      'price'=>$cat->selling_price,
                      'total_vaccine_amount'=>$cat->selling_price * $cat->qty,
                      'pro_id'=>$cat->vaccine_id,
                      'service'=>$cat->service,
                      'Amount'=>$cat->Amount,
                      'service_id'=>$cat->service_id,
                      'subtotal'=>0,
                      'date'=>date('d/m/y'),
                      'month'=>date('F'),
                      'year'=>date('Y'),
                      'location'=>'MVC'
                  ]);
                  if(isset(Vaccinestore::where("id",$cat->vaccine_id)->first()->Quantity)){
                  $cur = Vaccinestore::where("id",$cat->vaccine_id)->first()->Quantity;
                  Vaccinestore::where("id",$cat->vaccine_id)->update(['Quantity'=>$cur-$cat->qty]);
                  }}
                  $cart = Service_cart::where('user_id',Auth::id())->get();
                  Service_cart::destroy($cart);
                  return redirect()->route('Admin.Payment.paynent_pending');
       }



    //    pending
       public function store_view_details(){
        $store_view_details =Transferstore::where('moved','added')->get();
        return view('Admin.Store.store_view_details',['store_view_details'=>$store_view_details]);
       }


       public function store_damage_update($id){

        $order_status = DB::table('store_carts')->where('id',$id)->update(['status'=>'Damage','subtotal'=>request('subtotal')]);

        return back();
       }

       public function store_head_update($id){
        $order_status = DB::table('store_carts')->where('id',$id)->update(['status'=>'Head_Office_Breach_Office','subtotal'=>request('subtotal')]);
        return back();
       }


       public function clinic_use($id){
        $order_status = DB::table('store_carts')->where('id',$id)->update(['status'=>'Clinic_use','subtotal'=>request('subtotal')]);
        return back();
       }

       public function Retails($id){
        $order_status = DB::table('store_carts')->where('id',$id)->update(['status'=>'Retails','subtotal'=>request('subtotal')]);
        return back();
       }


       public function Retail(){
        $Retail = DB::table('shop_items')->where('status','Retails')->where('location', 'MVC')->get();
        return view('Admin.Store.Retail',['Retail'=>$Retail]);
       }


       public function clinicuse(){
        $clinicuse=Shop_item::where('status','Clinic_use')->where('location', 'MVC')->get();
         return view('Admin.Store.clinicuse',['clinicuse'=>$clinicuse]);
       }
       public function transfer_details(){
        $get = Transferstore::where('location_transfer','MVC')->where('moved', "moved")->whereDate('created_at', date('Y-m-d'))->where('status', 'Head_Office_Breach_Office')->get();
          return view('Admin.Store.transfer_details', ['get'=>$get]);
       }
        public function fatchonlineGood($id){
        $shop = Transferstore::find($id);
        $prod = Product::where('id', $shop->pro_id)->first();
        Product::where("id",$shop->pro_id)->update(['Quantity'=>$prod->Quantity + $shop->qty,'syn_flag'=>0]);
        Transferstore::where('moved',"moved")->where('pro_id',$shop->pro_id)->update(['moved'=>'added']);
        Shop_item::where('moved',"moved")->where('pro_id',$shop->pro_id)->update(['moved'=>'added','syn_flag'=>0]);
        return back();
       }
}
