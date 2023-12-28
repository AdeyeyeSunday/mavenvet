<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{

    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function add_customer(){

    return view('Admin.Customer.add_customer');
    }


    public function add_customer_store(Request $request){
     $add_customer = request()->validate([
    'Name'=>'required',
    'Phone'=>'required',
    'Address'=>'required',
    'date'=>'required'
    ]);

    Customer::create($add_customer);
    return back();
    }

    public function add_customer_list(){

       $Customer = Customer::all();
    return view('Admin.Customer.add_customer_list',['Customer'=>$Customer]);
    }

    public function add_customer_edit($id){

   $add_customer_edit = DB::table('customers')->where('id',$id)->first();

   return view('Admin.Customer.add_customer_edit',['add_customer_edit'=>$add_customer_edit]);
    }


    public function add_customer_update(Request $request,$id){

    $add_customer_update = request()->validate([
        'Name'=>'required',
        'Phone'=>'required',
        'Address'=>'required',
        'syn_flag'=>'0'
    ]);
    Customer::whereId($id)->update($add_customer_update);

    return redirect()->route('Admin.Customer.add_customer_list');

    }


    public function add_customer_destory($id){

        $add_customer_destory = Customer::find($id);

        $add_customer_destory->delete();

        return back();
    }

}
