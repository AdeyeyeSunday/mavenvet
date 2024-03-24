<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use App\Models\Clinic;
use App\Models\Employee;
use App\Models\MVC_midwifery_vaccinestores;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Payment_due;
use App\Models\Service;
use App\Models\Service_cart;
use App\Models\Service_order;
use App\Models\Service_item;
use App\Models\User;
use App\Models\Vaccineorder;
use App\Models\Vaccinestore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function Payment(){
        $treatment = Clinic::all();
        $vaccine = Vaccinestore::get();
        $service=Service::get();
        $treat = Service_cart::get();
        $treat_service = Service_cart::get();
        $get_cart = Service_cart::get();
        $clinics = DB::table('clinics')->get();
        $amount1 = Service_cart::sum('selling_price');
        $amount2= Service_cart::sum('Amount');
        return view('Admin.Payment.Payment',['treatment'=>$treatment,'vaccine'=>$vaccine,'service'=>$service,'treat'=>$treat,'treat_service'=>$treat_service,'get_cart'=>$get_cart,'clinics'=>$clinics,'amount2'=>$amount2,'amount1'=>$amount1]);
    }

    public function Payment_store(){
    $payment = request()->validate([
        'Pet_id'=>'required',
        'Services'=>'required',
        'Payment_Status'=>'required',
        'Amount_Paid'=>'required',
        'Outstanding_Payment'=>'required',
        'Mode_Of_Payment'=>'required',
        'Veterinarian'=>'required',
        'Vaccine'=>'required',
        'date'=>'required',
        'month'=>'required',
        'year'=>'required',
        'user_id'=>'required',
        'Total_bill'=>'required',
        'Card_Payment'=>'required'
     ]);

     Payment::create($payment);
     session()->flash('payment','Payment Successful!!!');
     return redirect()->route('Admin.Payment.Payment_list');
    }








    public function Payment_list(){
        $date = (date('d/m/y'));
        $new_date = date('d/m/y');
        $pay=Service_order::with('user')->with('service_item')->where('date',$date)->where('order_status','success')->orWhere('new_date',$new_date)->get();
        $cash = DB::table('service_orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','Cash')->sum('pay');
        $new_pos = DB::table('service_orders')->where('new_date', $new_date)->where('order_status','success')->where('new_mode_of_payment','Pos')->sum('new_due');
        $new_transfer= DB::table('service_orders')->where('new_date', $new_date)->where('order_status','success')->where('new_mode_of_payment','Transfer')->sum('new_due');
        $new_cash = DB::table('service_orders')->where('new_date', $new_date)->where('order_status','success')->where('new_mode_of_payment','Cash')->sum('new_due');
        $tranfer = DB::table('service_orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','Transfer')->sum('cash_transfer');
        $pos = DB::table('service_orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','Pos')->sum('cash_pos');
        $cash_transfer  = DB::table('service_orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','cash_transfer')->sum('cash_transfer');
        $cash_cash  = DB::table('service_orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','cash_transfer')->sum('pay');
        $cash_pos =DB::table('service_orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','cash_pos')->sum('cash_pos');
        $cash_cash_pos  = DB::table('service_orders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','cash_pos')->sum('pay');
        $amount = DB::table('service_orders')->where('date', $date)->where('order_status','success')->sum('pay');

         return view('Admin.Payment.Payment_list',['pay'=>$pay,'amount'=>$amount,'cash'=>$cash,'tranfer'=>$tranfer,'pos'=>$pos,'cash_transfer'=>$cash_transfer,'cash_cash'=>$cash_cash,'cash_pos'=>$cash_pos,'cash_cash_pos'=>$cash_cash_pos,'new_pos'=>$new_pos,'new_transfer'=>$new_transfer,'new_cash'=>$new_cash]);


    }



    public function Payment_edit($id){
    $payment_edit = DB::table('service_orders')->where('id',$id)->first();
    return view('Admin.Payment.Payment_edit',['payment_edit'=>$payment_edit]);
    }

    public function Payment_update(Request $request,$id){
        $payment_update = request()->validate([
            'Mode_Of_Payment'=>'required',
            'pay'=>'required',
            'due'=>'required',
            'total_price'=>'required',
            'Payment_type'=>'required',
            'date'=>'required',
            'month'=>'required',
            'year'=>'required',
            'location'=>'required',
	        'syn_flag'=>'0',

        ]);
        // dd($payment_update);
        if(request('due') > 50){
            Service_order::whereId($id)->update([
            // 'pay'=> DB::raw('pay+'.$payment_update['due']),
            'due'=>$payment_update['total_price']-$payment_update['pay']-$payment_update['due'],
            'Payment_type'=>$payment_update['Payment_type'],
	         'date'=>$payment_update['date'],
	        'month'=>$payment_update['month'],
	        'year'=>$payment_update['year'],
	        'location'=>$payment_update['location'],
            'new_date'=>date('d/m/y'),
            'new_due'=>$payment_update['due'],
            'new_mode_of_payment'=>$payment_update['Mode_Of_Payment'],
            'new_payment_user_id'=>Auth::id(),
            'syn_flag'=>'0'
           ]);
        }else{
            session()->flash('valid','Enter Valid Payment..Outsanding Payment Start from ₦:500 Up!!!');
            return back();
        }
        session()->flash('due','Payment Successful!!!');

        Payment_due::create($payment_update);

      return redirect()->route('Admin.Payment.Payment_list');
    }


    public function fullpayment(){
        $date = date('d/m/y');
        $amount = DB::table('service_orders')->where('date',$date)->where('Payment_type','Full Payment')->sum('pay');
        $payment=Service_order::with('user')->where('date',$date)->where('Payment_type','Full Payment')->get();
     return view('Admin.Payment.fullpayments',['payment'=>$payment,'amount'=>$amount]);
    }



    public function outstandingpayment(){
        $amount = DB::table('service_orders')->where('Payment_type','Half Payment')->sum('due');
        $pay=Service_order::with('user')->with('service_item')->where('Payment_type','Half Payment')->get();
        return view('Admin.Payment.outstandingpayment',['pay'=>$pay,'amount'=>$amount]);

    }



    public function outstandingpayment_admin(){
        $amount = DB::table('service_orders')->where('Payment_type','Half Payment')->sum('due');
        $pay=Service_order::with('user')->where('Payment_type','Half Payment')->get();
        return view('Admin.Payment.outstandingpayment_admin',['pay'=>$pay,'amount'=>$amount]);

    }













    public function Account_pos(){
      $date = date('d/m/y');
      $amount = DB::table('payments')->where('Mode_Of_Payment','Pos')->sum('pay');
      $payment_pos=Service_order::with('clinic')->where('date', $date)->where('Mode_Of_Payment','Pos')->get();

    $pos = DB::table('service_orders')->where('order_status','success')->where('Mode_of_payment','Pos')->sum('pay');

     return view('Admin.Payment.Account_pos',['payment_pos'=>$payment_pos]);
    }




    public function Account_transfer(){
        $date = date('d/m/y');
        $amount = DB::table('payments')->where('Mode_Of_Payment','Transfer')->sum('Amount_Paid');
        $payment_transfer=Payment::with('clinic')->where('date', $date)->where('Mode_Of_Payment','Transfer')->get();
       return view('Admin.Payment.Account_transfer',['payment_transfer'=>$payment_transfer,'amount'=>$amount]);
       }

       public function bank_deposit(){

        $bank_deposit = DB::table('cashes')->where('mode','Bank_deposit')->get();

          return view('Admin.Payment.bank_deposit',['bank_deposit'=>$bank_deposit]);
        }


    public function Account_cash(){

        $cash = DB::table('service_orders')->where('order_status','success')->where('Mode_of_payment','Cash')->sum('pay');
        $tranfer = DB::table('service_orders')->where('order_status','success')->where('Mode_of_payment','Transfer')->sum('cash_transfer');
        $pos = DB::table('service_orders')->where('order_status','success')->where('Mode_of_payment','Pos')->sum('cash_pos');
        // dd($pos);
        $cash_transfer  = DB::table('service_orders')->where('order_status','success')->where('Mode_of_payment','cash_transfer')->sum('cash_transfer');
        $cash_cash  = DB::table('service_orders')->where('order_status','success')->where('Mode_of_payment','cash_transfer')->sum('pay');
        $cash_pos =DB::table('service_orders')->where('order_status','success')->where('Mode_of_payment','cash_pos')->sum('cash_pos');
        $cash_cash_pos  = DB::table('service_orders')->where('order_status','success')->where('Mode_of_payment','cash_pos')->sum('pay');
        $amount = DB::table('service_orders')->where('order_status','success')->sum('pay');
        $cash_transfer = DB::table('service_orders')->where('order_status','success')->where('Mode_of_payment','Cash/Transfer')->sum('cash_transfer');
        $pay=Service_order::with('user')->where('order_status','success')->get();

    return view('Admin.Payment.Account_cash',['pay'=>$pay,'amount'=>$amount,'cash'=>$cash,'tranfer'=>$tranfer,'pos'=>$pos,'cash_transfer'=>$cash_transfer,'cash_cash'=>$cash_cash,'cash_pos'=>$cash_pos,'cash_cash_pos'=>$cash_cash_pos]);
     }




    public function vaccine_report(){
        $date = (date('d/m/y'));

    $daily= Vaccineorder::with('vaccineiteams')->where('order_status','success')->get();




    $cash = DB::table('vaccineorders')->where('order_status','success')->where('Mode_of_payment','Cash')->sum('pay');
    $tranfer = DB::table('vaccineorders')->where('order_status','success')->where('Mode_of_payment','Transfer')->sum('cash_transfer');
    $pos = DB::table('vaccineorders')->where('order_status','success')->where('Mode_of_payment','Pos')->sum('cash_pos');


    //transfer
    $cash_transfer  = DB::table('vaccineorders')->where('order_status','success')->where('Mode_of_payment','cash_transfer')->sum('cash_transfer');

    $cash_cash  = DB::table('vaccineorders')->where('order_status','success')->where('Mode_of_payment','cash_transfer')->sum('pay');

      //pos
    $cash_pos =DB::table('vaccineorders')->where('order_status','success')->where('Mode_of_payment','cash_pos')->sum('cash_pos');
    $cash_cash_pos  = DB::table('vaccineorders')->where('order_status','success')->where('Mode_of_payment','cash_pos')->sum('pay');


    $amount = DB::table('vaccineorders')->where('order_status','success')->sum('pay');
 return view('Admin.Payment.vaccine_report',['daily'=>$daily,'amount'=>$amount,'cash'=>$cash,'tranfer'=>$tranfer,'pos'=>$pos,'cash_transfer'=>$cash_transfer,'cash_cash'=>$cash_cash,'cash_pos'=>$cash_pos,'cash_cash_pos'=>$cash_cash_pos]);

     }



     public function vaccine_outstanding_report(){

        $daily = DB::table('vaccineorders')->where('Payment_type', 'Half Payment')->where('order_status','success')->get();

        $amount = DB::table('vaccineorders')->where('Payment_type', 'Half Payment')->where('order_status','success')->sum('due');


    return view('Admin.Payment.vaccine_outstanding_report',['daily'=>$daily,'amount'=>$amount]);
     }




     public function doctor_report(){
          $emp = Employee::with('user')->get();
          $year = date("Y");
          $user = Employee::with('user')->get();
          $all = User::get();
         return view('Admin.Payment.doctor_report',['all'=>$all,'emp'=>$emp,'user'=>$user]);
     }


     public function doctor($id){
        $date =date('d/m/y');
        $year = date("Y");
        $amount =  Service_item::where('prod_name','!=','0')->where('user_id',$id)->where('date',$date)->where('year',$year)->select(DB::raw('sum(qty) as total_quantity'), 'prod_name','price')->groupBy('prod_name','price')->sum('qty');
        $amount2 =  Service_item::where('prod_name','!=','0')->where('user_id',$id)->where('date',$date)->where('year',$year)->select(DB::raw('sum(qty) as total_quantity'), 'prod_name','price')->groupBy('prod_name','price')->sum('price');
        $amt = DB::table('service_items')->where('date',$date)->where('year',$year)->where('user_id',$id)->sum('Amount');
        $service_items = Service_item::where('prod_name','!=','0')->where('user_id',$id)->where('year',$year)->where('date',$date)->select(DB::raw('sum(qty) as total_quantity'), 'prod_name','price')->groupBy('prod_name','price')->get();
        $service_item = Service_item::where('service','!=','0')->where('user_id',$id)->where('year',$year)->where('date',$date)->select(DB::raw('sum(Amount) as Amount'), 'service')->groupBy('service')->get();
      return view('Admin.Payment.doctor',['amount'=>$amount,'service_items'=>$service_items,'amt'=>$amt,'service_item'=>$service_item,'amount2'=>$amount2]);
     }




     public function cash_report(){
         $date = date('d/m/y');
      $cash= Cash::get();
      return view('Admin.Payment.cash_report',['cash'=>$cash]);
     }




     public function cash_report_store(){
      $input = request()->validate([
      'customer_name'=>'required',
       'mode'=>'required',
       'amount'=>'required',
       'name'=>'required',
       'date'=>'required',
       'month'=>'required',
       'year'=>'required',
       'location'=>'required'
      ]);
     Cash::create($input);
    return back();
     }



     public function paynent_pending(){
        $pending = DB::table('service_orders')->where('order_status','pending')->get();
        return view('Admin.Payment.paynent_pending',['pending'=>$pending]);
     }


     public function payment_invoice_delete($id) {
        $delete = Service_order::find($id);
        $return = Service_order::with('service_item')->where('id', $id)->first();

        if ($return) {
            foreach ($return->service_item as $item) {
                if ($item->pro_id != null) {
                    $vaccineStore = Vaccinestore::where("id", $item->pro_id)->first();
                    if ($vaccineStore) {
                        $curQty = $vaccineStore->Quantity;
                        Vaccinestore::where("id", $item->pro_id)->update(['Quantity' => $curQty + $item->qty]);
                    }
                }
            }
        }

        if ($delete) {
            $delete->delete();
        }

        return back();
    }



     public function payment_invoice($id){
        $Pos_invoice =Service_order::with('service_item')->where('id',$id)->where('user_id',Auth::id())->first();
         $banklist =DB::table('bank_lists')->get();
  return view('Admin.Payment.payment_invoice',['Pos_invoice'=>$Pos_invoice,'banklist'=>$banklist]);
      }


      public function order_status($id){
        $order_status = DB::table('Service_orders')->where('id',$id)->update(['order_status'=>'success']);
        return redirect()->route('Admin.Payment.Payment');
     }



     public function order_update(Request $request,  $id){
        $order_update = request()->validate([
            'total_price'=>'required',
            'pay'=>'required',
            'due'=>'required',
            'Payment_type'=>'required',
            'cash_transfer'=>'required',
            'cash_pos'=>'required',
        ]);


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
            Service_order::whereId($id)->update([
          'due'=>$order_update['total_price']-$order_update['pay']-$order_update['cash_transfer']-$order_update['cash_pos']-$order_update['due'],
          'pay'=>$order_update['pay'],
        //   'Mode_of_payment'=>$order_update['Mode_of_payment'],
          'Payment_type'=>$order_update['Payment_type'],
          'cash_transfer'=>$order_update['cash_transfer'],
          'cash_pos'=>$order_update['cash_pos'],
          'total_price'=>$order_update['total_price'],
          'syn_flag'=>'0',
          'bankName'=>$request->bankName
       ]);
      } else{

          session()->flash('payment','Amount Enter is Greater Than Total Bill, Please Enter a Vaild Payment!!!');
      }
      if (request('pay') + request('cash_transfer') + request('cash_pos')  == request('total_price')) {
        Service_order::whereId($id)->update(['Payment_type'=>'Full Payment',
          'due'=>$order_update['total_price']-$order_update['pay']-$order_update['cash_transfer']-$order_update['cash_pos']-$order_update['due'],
          'pay'=>$order_update['pay'],
        //   'Mode_of_payment'=>$order_update['Mode_of_payment'],
          'cash_transfer'=>$order_update['cash_transfer'],
          'cash_pos'=>$order_update['cash_pos'],
          'total_price'=>$order_update['total_price'],
          'syn_flag'=>'0',
          'bankName'=>$request->bankName


      ]);
    //   session()->flash('else','Payment Made!!!');
    }

      return back();

    }

  public function Payment_list_edit($id){
    $Payment_list_edit =Service_order::where('id',$id)->first();
    return view('Admin.Payment.Payment_list_edit',['Payment_list_edit'=>$Payment_list_edit]);
  }

  public function Payment_list_update(Request $request,$id){
    $order_update = request()->validate([
        'total_price'=>'required',
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



    if (request('pay') + request('cash_transfer') + request('cash_pos') <= request('total_price')) {
        Service_order::whereId($id)->update([
      'due'=>$order_update['total_price']-$order_update['pay']-$order_update['cash_transfer']-$order_update['cash_pos']-$order_update['due'],
      'pay'=>$order_update['pay'],
      'Mode_of_payment'=>$order_update['Mode_of_payment'],
      'Payment_type'=>$order_update['Payment_type'],
      'cash_transfer'=>$order_update['cash_transfer'],
      'cash_pos'=>$order_update['cash_pos'],
      'total_price'=>$order_update['total_price'],
      'syn_flag'=>'0'
   ]);
  } else{

      session()->flash('payment','Amount Enter is Greater Than Total Bill, Please Enter a Vaild Payment!!!');
  }
  if (request('pay') + request('cash_transfer') + request('cash_pos')  == request('total_price')) {
    Service_order::whereId($id)->update(['Payment_type'=>'Full Payment',
      'due'=>$order_update['total_price']-$order_update['pay']-$order_update['cash_transfer']-$order_update['cash_pos']-$order_update['due'],
      'pay'=>$order_update['pay'],
      'Mode_of_payment'=>$order_update['Mode_of_payment'],
      'cash_transfer'=>$order_update['cash_transfer'],
      'cash_pos'=>$order_update['cash_pos'],
      'total_price'=>$order_update['total_price'],
      'syn_flag'=>'0'
  ]);
}
return redirect()->route('Admin.Payment.Payment_list');

  }


public function print_invoice($id){

            $Pos_invoice =Service_order::with('service_item')->where('id',$id)->where('user_id',Auth::id())->first();
            $service =Service_order::with('service_item')->where('id',$id)->where('user_id',Auth::id())->first();
            $print=Service_order::with('service_item')->where('id',$id)->where('user_id',Auth::id())->first();
            return view('Admin.Payment.print_invoice',['Pos_invoice'=>$Pos_invoice, 'print'=>$print,'service'=>$service]);

 }


 public function direct_service(){
    $Pos_invoice =Service_order::latest()->first();
    $gettemss = Service_item::where('order_id', $Pos_invoice->id)->get();
    return view('Admin.Payment.direct_service',['Pos_invoice'=>$Pos_invoice,'gettemss'=>$gettemss]);
}

         public function fullpayment_view($id){

            $invoice =Service_order::with('service_item')->where('id',$id)->where('user_id',Auth::id())->first();
            $total=Service_order::where('id',$id)->where('user_id',Auth::id())->first();

            // dd($invoice);
            return view('Admin.Payment.fullpayment_view',['invoice'=>$invoice,'total'=>$total]);

}


public function oustanding(){

              $date = (date('d/m/y'));
            $new_date = date('d/m/y');
            $daily= Vaccineorder::with('vaccineiteams')->where('date', $date)->where('order_status','success')->orWhere('new_date',$new_date)->get();
        // $date = (date('d/m/y'));
        $cash = DB::table('vaccineorders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','Cash')->sum('pay');
        $tranfer = DB::table('vaccineorders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','Transfer')->sum('cash_transfer');
        $pos = DB::table('vaccineorders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','Pos')->sum('cash_pos');



        $new_pos = DB::table('vaccineorders')->where('new_date', $new_date)->where('order_status','success')->where('new_mode_of_payment','Pos')->sum('new_due');
        $new_transfer= DB::table('vaccineorders')->where('new_date', $new_date)->where('order_status','success')->where('new_mode_of_payment','Transfer')->sum('new_due');
        $new_cash = DB::table('vaccineorders')->where('new_date', $new_date)->where('order_status','success')->where('new_mode_of_payment','Cash')->sum('new_due');




        $cash_transfer  = DB::table('vaccineorders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','cash_transfer')->sum('cash_transfer');
        $cash_cash  = DB::table('vaccineorders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','cash_transfer')->sum('pay');
        $cash_pos =DB::table('vaccineorders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','cash_pos')->sum('cash_pos');
        $cash_cash_pos  = DB::table('vaccineorders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','cash_pos')->sum('pay');
        $amount = DB::table('vaccineorders')->where('date', $date)->where('order_status','success')->sum('pay');
        $cash_transfer = DB::table('vaccineorders')->where('date', $date)->where('order_status','success')->where('Mode_of_payment','cash_transfer')->sum('cash_transfer');
           return view('Admin.Payment.oustanding',['daily'=>$daily,'amount'=>$amount,'cash'=>$cash,'tranfer'=>$tranfer,'pos'=>$pos,'cash_transfer'=>$cash_transfer,'cash_cash'=>$cash_cash,'cash_pos'=>$cash_pos,'cash_cash_pos'=>$cash_cash_pos,'new_pos'=>$new_pos,'new_transfer'=>$new_transfer,'new_cash'=>$new_cash]);
         }

         public function vaccineoustanding(){
            $daily = Vaccineorder::with('vaccineiteams')->where('Payment_type', 'Half Payment')->where('order_status','success')->get();
            $amount = DB::table('vaccineorders')->where('Payment_type', 'Half Payment')->where('order_status','success')->sum('due');
            return view('Admin.Payment.vaccineoustanding',['daily'=>$daily,'amount'=>$amount,]);
         }

         public function oustanding_edit($id){
            $oustanding_edit = DB::table('vaccineorders')->where('id',$id)->first();
            return view('Admin.Payment.oustanding_edit',['oustanding_edit'=>$oustanding_edit]);
         }


         public function oustanding_update(Request $request,$id){
            $oustanding_update = request()->validate([
                'Mode_Of_payment'=>'required',
                'pay'=>'required',
                'due'=>'required',
                'total'=>'required',
                 'Payment_type'=>'required',
                'syn_flag'=>'0'
            ]);
            if(request('due') > 200){
                Vaccineorder::whereId($id)->update([
                    // 'pay'=> DB::raw('pay+'.$oustanding_update['due']),
                'due'=>$oustanding_update['total']-$oustanding_update['pay']-$oustanding_update['due'],
               'Payment_type'=>$oustanding_update['Payment_type'],
               'new_mode_of_payment'=>$oustanding_update['Mode_Of_payment'],
               'new_due'=>$oustanding_update['due'],
               'new_date'=>date('d/m/y'),
               'syn_flag'=>'0'
               ]);
            }else{
                session()->flash('valid','Enter Valid Payment..Outsanding Payment Start from ₦:200 Up!!!');
                return back();
            }
            session()->flash('due','Payment Successful!!!');
          return redirect()->route('Admin.Payment.oustanding');
        }

        public function Payment_admin_outstanding(){
            $amount = DB::table('service_orders')->where('Payment_type','Half Payment')->sum('due');

            $pay=Service_order::with('user')->where('Payment_type','Half Payment')->get();
         return view('Admin.Payment.Payment_admin_outstanding',['pay'=>$pay,'amount'=>$amount]);
        }





        public function due_payment(){

            $date = date('d/m/y');
            $due_payment = Payment_due::get();
            $amount = Payment_due::sum('due');
            $cash = DB::table('payment_dues')->where('Mode_of_payment','Cash') ->whereDate('date', $date)->sum('due');
            $tranfer = DB::table('payment_dues')->where('Mode_of_payment','Transfer') ->whereDate('date', $date)->sum('due');
            $pos = DB::table('payment_dues')->where('Mode_of_payment','Pos') ->whereDate('created_at', $date)->sum('due');
            $amount = DB::table('payment_dues')->sum('due');
            return view('Admin.Payment.due_payment',['due_payment'=>$due_payment,'amount'=>$amount]);


        }


        public function bank_deposit_search(Request $request){
            $date= $request->input('from');
            $new=  DB::table('cashes')
            ->whereDate('created_at', $date)
            ->where('mode','Bank_deposit')
            ->get();

            $amount=  DB::table('cashes')
            ->whereDate('created_at', $date)
            ->where('mode','Bank_deposit')
            ->sum('amount');
        return view('Admin.Payment.bank_deposit_search',['new'=>$new,'amount'=>$amount]);
}





public function order_cash($id){

    $order_status = DB::table('service_orders')->where('id',$id)->update(['Mode_of_payment'=>'Cash']);

    return back();
 }



 public function order_pos($id){

    $order_status = DB::table('service_orders')->where('id',$id)->update(['Mode_of_payment'=>'Pos']);

    return back();
 }


 public function order_transfer($id){

    $order_status = DB::table('service_orders')->where('id',$id)->update(['Mode_of_payment'=>'Transfer']);

    return back();
 }

 public function cash_pos($id){

    $order_status = DB::table('service_orders')->where('id',$id)->update(['Mode_of_payment'=>'cash_pos']);

    return back();
 }


 public function cash_transfer($id){

    $order_status = DB::table('service_orders')->where('id',$id)->update(['Mode_of_payment'=>'cash_transfer']);

    return back();
 }


 public function search(Request $request){
$month = $request->input('month');
$user = $request->input('user');
$year = $request->input('year');
// dd($user);
 $new=  DB::table('service_items')->where('month', $month)->where('year',$year)->where('user_id',$user)->get();
$amount =  Service_item::where('prod_name','!=','0')->where('month', $month)->where('year',$year)->where('user_id',$user)->select(DB::raw('sum(qty) as total_quantity'), 'prod_name','price')->groupBy('prod_name','price')->sum('qty');

//service_order
// $grandTotalPay =   Service_order::where('month', $month)->where('year',$year)->where('user_id',$user)->where('order_status','success')->sum('pay');
// $grandTotalCash =  Service_order::where('month', $month)->where('year',$year)->where('user_id',$user)->where('order_status','success')->sum('cash_transfer');
// $grandTotalPOS =   Service_order::where('month', $month)->where('year',$year)->where('user_id',$user)->where('order_status','success')->sum('cash_pos');

// $grandTotalVaccineorderPay =   Vaccineorder::where('month', $month)->where('year',$year)->where('user_id',$user)->where('order_status','success')->sum('pay');
// $grandTotalVaccineorderCash =  Vaccineorder::where('month', $month)->where('year',$year)->where('user_id',$user)->where('order_status','success')->sum('cash_transfer');
// $grandTotalVaccineorderPOS =   Vaccineorder::where('month', $month)->where('year',$year)->where('user_id',$user)->where('order_status','success')->sum('cash_pos');

$service_items = Service_item::where('prod_name','!=','0')->where('month', $month)->where('year',$year)->where('user_id',$user)->select(DB::raw('sum(qty) as total_quantity'), 'prod_name','price')->groupBy('prod_name','price')->get();

$service_item = Service_item::where('service','!=','0')->where('month', $month)->where('year',$year)->where('user_id',$user)->select(DB::raw('sum(Amount) as Amount'), 'service')->groupBy('service')->get();

$service_items_grand_total = Service_item::where('prod_name', '!=', '0')
    ->where('month', $month)
    ->where('year', $year)
    ->where('user_id', $user)
    ->select(DB::raw('SUM(qty * price) as totalAmount'), 'prod_name', 'price')
    ->groupBy('prod_name', 'price')
    ->get();
$grandTotal1 = $service_item->sum('Amount');
$grandTotal = $service_items_grand_total->sum('totalAmount');

$amt = Service_item::where('service','!=','0')->where('month', $month)->where('year',$year)->where('user_id',$user)->sum('Amount');
$amount2 =  Service_item::where('prod_name','!=','0')->where('month', $month)->where('year',$year)->where('user_id',$user)->sum('total_vaccine_amount');
$grandTotal = $grandTotal + $grandTotal1;

return view('Admin.Payment.search',['new'=>$new,'amount'=>$amount,'amount2'=>$amount2,'amt'=>$amt,'service_items'=>$service_items,'service_item'=>$service_item,'grandTotal'=>$grandTotal]);
 }


}





