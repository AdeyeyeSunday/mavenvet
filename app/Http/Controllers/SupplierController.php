<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function add_Supplier(){

    return view('Admin.Supplier.add_Supplier');
    }

    public function store_Supplier(){

        $supplier  = request()->validate([
            'Name'=>'required',
            'Email'=>'required',
            'Phone_Number'=>'required',
            'date'=>'required',
            'Address'=>'required',
            // 'Item_name'=>'required',
            'City'=>'required',
            'State'=>'required',
            'Country'=>'required',
            'Company_Name'=>'required'
        ]);
        Supplier::create($supplier);

      session()->flash('message','Suplier create!!!!!');
        return redirect()->route('Admin.Supplier.list_Supplier');
    }

    public function list_Supplier(){

    $supplier = Supplier::all();

     return view('Admin.Supplier.list_Supplier',['supplier'=>$supplier]);
    }

    public function edit_Supplier($id){
     $supplier=DB::table('suppliers')->where('id',$id)->first();
      return view('Admin.Supplier.edit_Supplier',['supplier'=>$supplier]);
    }


    public function update_Supplier(Request $request,$id){

    $update = request()->validate([
        'Name'=>'required',
        'Email'=>'required',
        'Phone_Number'=>'required',
        // 'GST_Number'=>'required',
        'Address'=>'required',
        'City'=>'required',
        'State'=>'required',
        'Country'=>'required',
        'Company_Name'=>'required',
        'syn_flag'=>'0'
    ]);
    Supplier::whereId($id)->update($update);

    return redirect()->route('Admin.Supplier.list_Supplier');

    }

    public function destory($id){

        $destory = Supplier::find($id);
        $destory->delete();
        return back();
    }
}
