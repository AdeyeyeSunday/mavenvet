<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Casenote;
use App\Models\Clinic;
use App\Models\Clinic_cart;
use App\Models\Product;
use App\Models\Service_order;
use App\Models\User;
use App\Models\Vaccine;
use App\Models\Vaccineiteam;
use App\Models\Vaccineorder;
use App\Models\Vaccinestore;
use App\Models\Clinic_expense;
use App\Models\MVC_midwifery_vaccinestores;
use App\Models\Newproduct;
use App\Models\NewVaccine;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClinicController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function Clinic(){
        $clinic = Clinic::all();
     return view('Admin.Clinic.Clinic',['clinic'=>$clinic]);
    }




    public function Vaccine_subtact(){

    $vaccine = Vaccinestore::get();



     return view('Admin.Clinic.Vaccine_subtact',['vaccine'=>$vaccine]);
    }



    public function Clinic_store(){

        $clinic = request()->validate([
            'pic'=>'required',
            'Pet_name'=>'required',
            'Breed'=>'required',
            'Gender'=>'required',
            'Name_Of_Pet_Owner'=>'required',
            'Owner_Phone_Number'=>'required',
            'Pet_Card_Number'=>'required',
            'Color'=>'required',
            'Age'=>'required',
            'Veterinarian'=>'required',
            'date'=>'required',
            'month'=>'required',
            'year'=>'required',
            'user_id'=>'required'
        ]);

        if(request('pic')){
       $clinic['pic'] = request('pic')->store('petfolder');
       Clinic::create($clinic);
       session()->flash('message','Pet Registered !!!');
       return redirect()->route('Admin.Casenote.Casenote');
        }
    }



public function encounter($id)
{
    $encounterId = Clinic::find($id);
    $service=Service::get();
    return view("Admin.Clinic.encounter",['encounterId'=>$encounterId,'service'=>$service]);
}


public function encounter_store(Request $request){
    $casenote = request()->validate([
        'physical_examination'=>'required',
        'temp'=>'required',
        'pulse'=>'required',
        'resp'=>'required',
        'diagnosis'=>'required',
        'result'=>'required',
         'visual_evaluation'=>'required',
         'other_examination'=>'required',
         'next_appointment'=>'required',
         'next_vaccination'=>'required',
    ]);
    $casenote['case_id'] = $request->case_id;
    $casenote['user_id'] = Auth::user()->id;
    $casenote['date'] = date("d-F-Y");
    $casenote['month'] = date("F");
    $casenote['year'] = date("Y");

    Casenote::create($casenote);
     session()->flash('message','Treatment submitted!!!');

    return back();

     }


    public function Clinic_list(){

        $clinic = Clinic::all();

        return view('Admin.Clinic.Clinic_list',['clinic'=>$clinic]);
    }

    public function Clinic_view($id){

     $Clinic_view = DB::table('clinics')->where('id', $id)->first();

    return view('Admin.Clinic.Clinic_view',['Clinic_view'=>$Clinic_view]);

    }

    public function Clinic_edit($id){

      $Clinic_edit=DB::table('clinics')->where('id',$id)->first();

      return view('Admin.Clinic.Clinic_edit',['Clinic_edit'=>$Clinic_edit]);
    }



    public function Clinic_update(Request $request,$id){

        $clinic = request()->validate([
            'Pet_name'=>'required',
            'Breed'=>'required',
            'Name_Of_Pet_Owner'=>'required',
            'Owner_Phone_Number'=>'required',
            'Color'=>'required',
            'Age'=>'required',
        ]);

        Clinic::whereId($id)->update($clinic);
        return redirect()->route('Admin.Clinic.Clinic_list');

}

    public function treatment(){

        $treatment= Clinic::all();

        $vaccine= Vaccinestore::get();



    return view('Admin.Clinic.treatment',['treatment'=>$treatment,'vaccine'=>$vaccine]);
    }


    public function destory($id){

       $destory = Clinic::find($id);

       $destory->delete();

       return back();
    }

    public function Clinic_supplier(){

     return view('Admin.Clinic.Clinic_supplier');


    }

    public function Clinic_supplier_store(){

        $input = request()->validate([
            'user_id'=>'required',
            'Company_Name'=>'required',
            'Name'=>'required',
            'Email'=>'required',
            'Phone_Number'=>'required',
            'date'=>'required',
            // 'item_name'=>'required',
            'Address'=>'required'
        ]);

        $vaccine = DB::table('vaccines')
        ->where('Name',$input['Name'])
        ->where('Email',$input['Email'])
        ->where('date',$input['date'])
        ->get();
        if(count($vaccine)>0){
            session()->flash('error','Duplicate entry !!!');
            return back();
        }
        else{

            Vaccine::create($input);
        }

        session()->flash('message','Supplier create!!!');
        return back();
    }




    public function Clinic_add_vaccine(){

        $brand = Brand::get();
        $supplier = Vaccine::get();
    return view('Admin.Clinic.Clinic_add_vaccine',['supplier'=>$supplier,'brand'=>$brand]);
    }

    public function Clinic_add_vaccine_store(){
    $vaccine = request()->validate([
        'user_id'=>'required',
        'Name'=>'required',
        'Cost'=>'required',
        'Price'=>'required',
        'Quantity'=>'required',
        'Image'=>'required',
        'minimum'=>'required',
        'supply_date'=>'required',
        'new_supply'=>'required',
        'expiry_date'=>'required',
        'supplier'=>'required',
        'brand'=>'required'
    ]);
 if(request('Image')){
    $vaccine['Image']=request('Image')->store('Vaccine');
    Vaccinestore::create($vaccine);
    session()->flash('message','vaccine create!!!');
    return redirect()->route('Admin.Clinic.Clinic_list_vaccine');
    }

    }


  public function Clinic_list_vaccine(){
  $vaccine = Vaccinestore::get();
  return view('Admin.Clinic.Clinic_list_vaccine',['vaccine'=>$vaccine]);
    }

    public function Clinic_edit_vaccine($id){
     $edit_vaccine = DB::table('vaccinestores')->where('id',$id)->first();
  return view('Admin.Clinic.Clinic_edit_vaccine',['edit_vaccine'=>$edit_vaccine]);

    }

    public function Clinic_update_vaccine(Request $request, $id){
        $vaccine = request()->validate([
            'user_id'=>'required',
            'Name'=>'required',
            'Cost'=>'required',
            'Price'=>'required',
            'Quantity'=>'required',
            'new_supply'=>'required',
            'expiry_date'=>'required',
            'minimum'=>'required'
        ]);
        Vaccinestore::whereId($id)->update(['Quantity'=>DB::raw('Quantity+'.$vaccine['new_supply']),
        'minimum'=>$vaccine['minimum'],
	    'Price'=>$vaccine['Price'],
        'Cost'=>$vaccine['Cost'],
        'new_supply'=>$vaccine['new_supply'],
	    ]);
         $vaccine['supply_date'] = now();
         NewVaccine::create($vaccine);
        return redirect()->route('Admin.Clinic.Clinic_list_vaccine');
    }

    public function newsupply(){
        $vaccine = NewVaccine::get();
        return view('Admin.Clinic.newsupply',['vaccine'=>$vaccine]);
    }



    public function Clinic_sale(){
       $Vaccinestore = Vaccinestore::get();
       $clinic_cart= Clinic_cart::get();
       $clinic_get= Clinic_cart::all();

      return view('Admin.Clinic.Clinic_sale',['Vaccinestore'=>$Vaccinestore,'clinic_cart'=>$clinic_cart,'clinic_get'=>$clinic_get]);
    }
    public function Clinic_cart(){
        $clinic_cart = request()->validate([
            'user_id'=>'required',
            'items_name'=>'required',
            'qty'=>'required',
            'selling_price'=>'required',
            'vaccine_id'=>'required',
            'Quantity'=>'required'
        ]);


        Clinic_cart::create($clinic_cart);


        return back();
    }





    public function Clinic_cart_update(Request $request,$id){
        $clinic_cart = request()->validate([
            'qty'=>'required'
        ]);

        $cart = Clinic_cart::where('id',$id)->first();
        $cart1 = $request->input('qty');


        if ($cart1 < $cart->Quantity) {

            Clinic_cart::whereId($id)->update($clinic_cart);
            return back();
        }else{

            session()->flash('message','The new order has exceeded quantity in stock please reduce quantity !!!');
            // echo 'much';
            return back();
        }

    }

   public function Clinic_destory($id){
    $clinic_destory = Clinic_cart::find($id);
    $clinic_destory->delete();
    return back();
   }




   public function Clinic_inventory(Request $request){
    $inventory = new Vaccineorder();
    $inventory->name = $request->input('name');
   $inventory->discount = $request->input('discount');
   $inventory->phone = $request->input('phone');
   $inventory->address = $request->input('address');
   $inventory->order_status = $request->input('order_status');
   $inventory->Mode_of_payment = $request->input('Mode_of_payment');
   $inventory->pay = $request->input('pay');
   $inventory->location = $request->input('location');
   $inventory->due = $request->input('due');
   $inventory->Payment_type = $request->input('Payment_type');
   $inventory->date = $request->input('date');
   $inventory->month = $request->input('month');
   $inventory->year = $request->input('year');
   $inventory->user_id = $request->input('user_id');

   $total = 0;
   $Vaccineitams_total = Clinic_cart::where('user_id', Auth::id())->get();
   foreach($Vaccineitams_total as $vaccine){
       $total += $vaccine->selling_price * $vaccine->qty;
   }
   $inventory->total = $total;
      $inventory->save();

       $Vaccineitams = Clinic_cart::where('user_id', Auth::id())->get();
        foreach($Vaccineitams as $items){
           Vaccineiteam::create([
               'order_id'=>$inventory->id,
               'items_name'=>$items->items_name,
               'qty'=>$items->qty,
               'price'=>$items->selling_price,
               'vaccine_id'=>$items->vaccine_id,
               'location'=>'MVC'
           ]);

           $curQty = Vaccinestore::where("id",$items->vaccine_id)->first()->Quantity;
           Vaccinestore::where("id",$items->vaccine_id)->update(['Quantity'=>$curQty-$items->qty,'syn_flag'=>0]);
       };

           $cart = Clinic_cart::where('user_id',Auth::id())->get();
           Clinic_cart::destroy($cart);
              return redirect()->route('Admin.Clinic.cart_pending');
      }





public function drect_clinic_payment(Request $request){
 $inventory = new Vaccineorder();
 $inventory->name = $request->input('name');
$inventory->discount = 0;
$inventory->phone = $request->input('phone');
$inventory->address = 0;
$inventory->order_status = "success";
$inventory->Mode_of_payment = $request->input('Mode_of_payment');
$inventory->location = $request->input('location');
$inventory->due = 0;
$inventory->Payment_type = "Full Payment";
$inventory->date =date('d/m/y');
$inventory->location = $request->input('location');
$inventory->month = date('F') ;
$inventory->year = date('Y') ;
$inventory->user_id = Auth::user()->id;
if($request->input('Mode_of_payment') == "Pos"){
    $inventory->cash_pos = $request->input('pay');
}

if($request->input('Mode_of_payment') == "Transfer"){
    $inventory->cash_transfer =$request->input('pay');
}

if($request->input('Mode_of_payment') == "Cash"){
    $inventory->pay =$request->input('pay');
}

$total = 0;
$Vaccineitams_total = Clinic_cart::where('user_id', Auth::id())->get();
foreach($Vaccineitams_total as $vaccine){
    $total += $vaccine->selling_price * $vaccine->qty;
}
$inventory->total = $total;
   $inventory->save();

    $Vaccineitams = Clinic_cart::where('user_id', Auth::id())->get();
     foreach($Vaccineitams as $items){
        Vaccineiteam::create([
            'order_id'=>$inventory->id,
            'items_name'=>$items->items_name,
            'qty'=>$items->qty,
            'price'=>$items->selling_price,
            'vaccine_id'=>$items->vaccine_id,
            'location'=>'MVC'
        ]);

        $curQty = Vaccinestore::where("id",$items->vaccine_id)->first()->Quantity;
        Vaccinestore::where("id",$items->vaccine_id)->update(['Quantity'=>$curQty-$items->qty,'syn_flag'=>0]);
    };

        $cart = Clinic_cart::where('user_id',Auth::id())->get();
        Clinic_cart::destroy($cart);
          return back();
   }





   public function cart_pending(){
   $cart_pending = DB::table('vaccineorders')->where('order_status','pending')->get();
   $amount = DB::table('vaccineorders')->sum('due');
   return view('Admin.Clinic.cart_pending',['cart_pending'=>$cart_pending,'amount'=>$amount]);
   }


   public function cart_history(){
    $cart_history = Vaccineorder::with('vaccineiteams')->get();
    return view('Admin.Clinic.cart_history',['cart_history'=>$cart_history]);
   }


   public function Clinic_inventory_invoice($id){
    $banklist =DB::table('bank_lists')->get();
    $Clinic_inventory_invoice=Vaccineorder::where('id',$id)->first();
    return view('Admin.Clinic.Clinic_inventory_invoice',['Clinic_inventory_invoice'=>$Clinic_inventory_invoice,'banklist'=>$banklist]);

   }


   public function vaccin_sale(){
    return view('Admin.Clinic.vaccin_sale');
   }

   public function brand(){

    $brand =Brand::get();
     return view('Admin.Clinic.brand',['brand'=>$brand]);
   }


   public function brand_store(){

$brand = request()->validate([

    'brand'=>'required'
]);


$bra = DB::table('brands')->where('brand',$brand['brand'])->get();

if(count($bra)>0){

    session()->flash('message','Dulicate Brand!!!');
    return back();
}
else{
    Brand::create($brand);
}
session()->flash('message',' Brand Create!!!');
return back();
   }

   public function brand_destory($id){

     $brand_destory = Brand::find($id);


     $brand_destory->delete();

     return back();
   }



   public function vaccin_discount(Request $request,$id){

      $input =  request()->validate([

        'discount'=>'required'
    ]);

    Vaccineorder::whereId($id)->update($input);

    session()->flash('Discount','Discount Subtracted');

    return back();
   }

   public function vaccine_update(Request $request,  $id){
    $input = request()->validate([
        'total'=>'required',
        // 'Mode_of_payment'=>'required',
        'pay'=>'required',
        'due'=>'required',
        'Payment_type'=>'required',
        'cash_transfer'=>'required',
        'cash_pos'=>'required',
    ]);


    if((request('Mode_of_payment')=='Cash') != request('pay')){
        session()->flash('success','Transaction Successful!!!');
             } elseif((request('Mode_of_payment')=='Transfer') != request('cash_transfer'))
             session()->flash('success','Transaction Successful!!!');

             elseif((request('Mode_of_payment')=='Pos') != request('cash_pos'))

             session()->flash('success','Transaction Successful!!!');

             elseif((request('Mode_of_payment')=='cash_transfer') != request('pay') && request('cash_transfer'))
             session()->flash('success','Transaction Successful!!!');

             else{
                session()->flash('success','Transaction Successful!!!');
             };


    if (request('pay') + request('cash_transfer') + request('cash_pos') <= request('total')) {
        Vaccineorder::whereId($id)->update([
      'due'=>$input['total']-$input['pay']-$input['cash_transfer']-$input['cash_pos']-$input['due'],
      'pay'=>$input['pay'],
      'Payment_type'=>$input['Payment_type'],
      'cash_transfer'=>$input['cash_transfer'],
      'cash_pos'=>$input['cash_pos'],
      'total'=>$input['total'],
      'bankName'=>$request->bankName,
      'syn_flag'=>'0'
   ]);
  } else{

      session()->flash('payment','Amount Enter is Greater Than Total Bill, Please Enter a Vaild Payment!!!');
  }
  if (request('pay') + request('cash_transfer') + request('cash_pos')  == request('total')) {
    Vaccineorder::whereId($id)->update(['Payment_type'=>'Full Payment',
      'due'=>$input['total']-$input['pay']-$input['cash_transfer']-$input['cash_pos']-$input['due'],
      'pay'=>$input['pay'],
      'cash_transfer'=>$input['cash_transfer'],
      'cash_pos'=>$input['cash_pos'],
      'total'=>$input['total'],
      'syn_flag'=>'0'
  ]);
}

  return back();

}


public function vaccin_edit($id){

$vaccin_edit = Vaccineorder::where('id',$id)->first();

return view('Admin.Clinic.vaccin_edit',['vaccin_edit'=>$vaccin_edit]);

}



public function vaccin_update2(Request $request,$id){
    $input = request()->validate([
        'total'=>'required',
        'Mode_of_payment'=>'required',
        'pay'=>'required',
        'due'=>'required',
        'Payment_type'=>'required',
        'cash_transfer'=>'required',
        'cash_pos'=>'required',
    ]);



    if((request('Mode_of_payment')=='Cash') != request('pay')){

        session()->flash('error','But wrong Mode of payemnt please make sure you update that before the end of today');
             }else{
                session()->flash('success','Transaction Successful!!!');
             };

             if((request('Mode_of_payment')=='Transfer') != request('cash_transfer')){

                session()->flash('error',' But wrong Mode of payemnt please make sure you update that before the end of today ');
            }else{
                session()->flash('success','Transaction Successful!!!');
            };

            if((request('Mode_of_payment')=='Pos') != request('cash_pos')){

                session()->flash('error','But wrong Mode of payemnt please make sure you update that before the end of today ');
            }else{
                session()->flash('success','Transaction Successful!!!');
            };


    if (request('pay') + request('cash_transfer') + request('cash_pos') <= request('total')) {
        Vaccineorder::whereId($id)->update([
      'due'=>$input['total']-$input['pay']-$input['cash_transfer']-$input['cash_pos']-$input['due'],
      'pay'=>$input['pay'],
      'Mode_of_payment'=>$input['Mode_of_payment'],
      'Payment_type'=>$input['Payment_type'],
      'cash_transfer'=>$input['cash_transfer'],
      'cash_pos'=>$input['cash_pos'],
      'total'=>$input['total'],
      'syn_flag'=>'0'
   ]);
  } else{

      session()->flash('payment','Amount Enter is Greater Than Total Bill, Please Enter a Vaild Payment!!!');
  }
  if (request('pay') + request('cash_transfer') + request('cash_pos')  == request('total')) {
    Vaccineorder::whereId($id)->update(['Payment_type'=>'Full Payment',
      'due'=>$input['total']-$input['pay']-$input['cash_transfer']-$input['cash_pos']-$input['due'],
      'pay'=>$input['pay'],
      'Mode_of_payment'=>$input['Mode_of_payment'],
      'cash_transfer'=>$input['cash_transfer'],
      'cash_pos'=>$input['cash_pos'],
      'total'=>$input['total'],
      'syn_flag'=>'0'
  ]);
}return redirect()->route('Admin.Payment.oustanding');

}














    public function order_status($id){

        $order_status = DB::table('vaccineorders')->where('id',$id)->update(['order_status'=>'success']);

        return redirect()->route('Admin.Clinic.Clinic_sale');
     }



     public function vaccine_print($id){

        $invoice =Vaccineorder::with('vaccineiteams')->where('id',$id)->where('user_id',Auth::id())->first();

        $print=Vaccineorder::with('vaccineiteams')->where('id',$id)->where('user_id',Auth::id())->first();

        return view('Admin.Clinic.vaccine_print',['invoice'=>$invoice,'print'=>$print]);
     }


     public function expenditure(){

    $clinic_expense=Clinic_expense::get();

         return view('Admin.Clinic.expenditure',['clinic_expense'=>$clinic_expense]);
     }



     public function expenditure_store(){

        $Expense = request()->validate([
            'name'=>'required',
            'amount'=>'required',
            'year'=>'required',
            'month'=>'required',
            'date'=>'required',
            'description'=>'required',
            'location'=>'required'
         ]);
         Clinic_expense::create($Expense);
         session()->flash('message','Expense created!!!!!');
         return back();
        //  return redirect()->route('Admin.Expense.Monthly');

     }


         public function Monthly_edit($id){
             $Expense = DB::table('clinic_expenses')->where('id', $id)->first();
             return view('Admin.Clinic.Monthly_edit',['Expense'=>$Expense]);
         }


         public function Monthly_update(Request $request,$id){
             $update = request()->validate([
                 'name'=>'required',
                 'amount'=>'required',
                 'description'=>'required'
              ]);
              Clinic_expense::whereId($id)->update($update);
              return redirect()->route('Admin.Clinic.expenditure');
         }
         public function clinic_monthly_expense(Request $request){

             $from= $request->input('from');
             $to = $request->input('to');
             $jan=  DB::table('clinic_expenses')
             ->whereBetween('created_at', [$from, $to])
             ->get();

             $amount= DB::table('clinic_expenses')
             ->whereBetween('created_at', [$from, $to])
             ->sum('amount');

             return view('Admin.Clinic.clinic_monthly_expense',['jan'=>$jan, 'amount'=>$amount]);
         }





         public function order_cash($id){

            $order_status = DB::table('vaccineorders')->where('id',$id)->update(['Mode_of_payment'=>'Cash']);

            return back();
         }



         public function order_pos($id){

            $order_status = DB::table('vaccineorders')->where('id',$id)->update(['Mode_of_payment'=>'Pos']);

            return back();
         }


         public function order_transfer($id){

            $order_status = DB::table('vaccineorders')->where('id',$id)->update(['Mode_of_payment'=>'Transfer']);

            return back();
         }

         public function cash_pos($id){

            $order_status = DB::table('vaccineorders')->where('id',$id)->update(['Mode_of_payment'=>'cash_pos']);

            return back();
         }

         public function cash_transfer($id){

            $order_status = DB::table('vaccineorders')->where('id',$id)->update(['Mode_of_payment'=>'cash_transfer']);

            return back();
         }

 public function destory_pending($id){

    $del = Vaccineorder::find($id);
    $return = Vaccineorder::with('vaccineiteams')->where('id',$id)->first();

    foreach($return->vaccineiteams as $item){
        $curQty = Vaccinestore::where("id",$item->vaccine_id)->first()->Quantity;
        Vaccinestore::where("id",$item->vaccine_id)->update(['Quantity'=>$curQty+$item->qty]);
    }

    $del ->delete();

    session()->flash('message','Item Deleted,and return back to store!!!');
     return back();
   }



   public function search(Request $request){
    $date= $request->input('from');
    $search=  DB::table('vaccineorders')
    ->whereDate('created_at', $date)
    ->get();
    $daily = DB::table('vaccineorders')->where('order_status','success')->whereDate('created_at', $date)->get();
    // $date = (date('d/m/y'));
    // $daily = DB::table('orders')->where('date', $date)->where('order_status','success')->get();
    $cash = DB::table('vaccineorders')->where('order_status','success')->where('Mode_of_payment','Cash')->whereDate('created_at', $date)->sum('pay');

    $tranfer = DB::table('vaccineorders')->where('order_status','success')->where('Mode_of_payment','Transfer')->whereDate('created_at', $date)->sum('cash_transfer');
    $pos = DB::table('vaccineorders')->where('order_status','success')->where('Mode_of_payment','Pos')->whereDate('created_at', $date)->sum('cash_pos');
    //transfer
    $cash_transfer  = DB::table('vaccineorders')->where('order_status','success')->where('Mode_of_payment','cash_transfer')->whereDate('created_at', $date)->sum('cash_transfer');
    $cash_cash  = DB::table('vaccineorders')->where('order_status','success')->where('Mode_of_payment','Transfer')->whereDate('created_at', $date)->sum('pay');

      //posfv
    $cash_pos =DB::table('vaccineorders')->where('order_status','success')->where('Mode_of_payment','cash_pos')->whereDate('created_at', $date)->sum('cash_pos');
    $cash_cash_pos  = DB::table('vaccineorders')->where('order_status','success')->where('Mode_of_payment','pos')->whereDate('created_at', $date)->sum('cash_pos');


    $amount = DB::table('vaccineorders')->where('order_status','success')->whereDate('created_at', $date)->sum('pay');
    $cash_transfer = DB::table('vaccineorders')->where('order_status','success')->where('Mode_of_payment','Cash/Transfer')->whereDate('created_at', $date)->sum('cash_transfer');
 return view('Admin.Clinic.search',['daily'=>$daily,'amount'=>$amount,'cash'=>$cash,'tranfer'=>$tranfer,'pos'=>$pos,'cash_transfer'=>$cash_transfer,'cash_cash'=>$cash_cash,'cash_pos'=>$cash_pos,'cash_cash_pos'=>$cash_cash_pos]);


 }



}



