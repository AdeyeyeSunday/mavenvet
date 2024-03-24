<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Newproduct;
use App\Models\Product;
use App\Models\Product_midwifery;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function Product(){
     return view('Admin.Product.Product');
    }


    public function Product_subtact(){
        // $sub_product = Newproduct::latest()->get();



        $sub_product = Product::with('user')->where('new_supply','<',0)->latest()->get();

        return view('Admin.Product.Product_subtact',['sub_product'=>$sub_product]);
       }




    public function add_product(){
        $suplier = Supplier::get();
     $Category = Category::all();
      return view('Admin.Product.add_product',['Category'=>$Category,'suplier'=>$suplier]);
    }



    public function store_product(){
        $Product = request()->validate([
            'Quantity_level'=>'required',
            'Name'=>'required',
            'Category'=>'required',
            'Cost'=>'required',
            'supplier'=>'required',
            'Price'=>'required',
            'Quantity'=>'required',
            'new_date'=>'required',
            'Description'=>'required',
            'expiry_date'=>'required',
            'month'=>'required',
            'year'=>'required',
            'location'=>'MVC'
        ]);

        $Pro  = DB::table('products')->where('Name',$Product['Name'])
        ->where('Price',$Product['Price'])
        ->where('Quantity',$Product['Quantity'])->get();

    if (count($Pro)>0) {
        session()->flash('message','Duplicate Details');
        return redirect()->route('Admin.Product.Product_list');
    }
    else{

        Product::create($Product);
            Newproduct::create($Product);
    }
        session()->flash('message','Product Add');
        return redirect()->route('Admin.Product.Product_list');
     }




    public function Product_list(){

     $Product = Product::all();
    return view('Admin.Product.Product_list',['Product'=>$Product]);

    }

    public function edit_product($id){
    $Product=DB::table('products')->where('id',$id)->first();
    return view('Admin.Product.edit_product',['Product'=>$Product]);
    }


    public function update_product(Request $request,$id){
        $Product = request()->validate([
            'Name'=>'required',
            'Cost'=>'required',
            'Price'=>'required',
            'Quantity'=>'required',
            'new_supply'=>'required',
            'new_date'=>'required',
            'expiry_date'=>'required',
            'location'=>'required',
            'Quantity_level'=>'required',
            'Description'=>'required',
            'month'=>'required',
            'year'=>'required',
            'syn_flag'=>'required',
        ]);
        $Product['user_id']=Auth::id();

        Product::whereId($id)->update([
            'Quantity'=>DB::raw('Quantity+'.$Product['new_supply']),
            'Name'=>$Product['Name'],
            'Cost'=>$Product['Cost'],
            'Price'=>$Product['Price'],
            'new_supply'=>$Product['new_supply'],
            'Quantity_level'=>$Product['Quantity_level'],
            'new_date'=>$Product['new_date'],
            'Description'=>$Product['Description'],
            'expiry_date'=>$Product['expiry_date'],
            'location'=>$Product['location'],
            'month'=>$Product['month'],
             'year'=>$Product['year'],
             'syn_flag'=>$Product['syn_flag'],
             'user_id'=>$Product['user_id']=Auth::id()
        ]);

        if(request('new_supply') > 0){
         Newproduct::create($Product);
        //  return redirect()->route('Admin.Product.Product_list');
        }else{
            Newproduct::whereId($id)->update([
                'Quantity'=>DB::raw('Quantity+'.$Product['new_supply']),
                'Name'=>$Product['Name'],
                'Cost'=>$Product['Cost'],
                'Price'=>$Product['Price'],
                'new_supply'=>$Product['new_supply'],
                'Quantity_level'=>$Product['Quantity_level'],
                'new_date'=>$Product['new_date'],
                'location'=>$Product['location'],
                'Description'=>$Product['Description'],
                'expiry_date'=>$Product['expiry_date'],
                'month'=>$Product['month'],
                 'year'=>$Product['year'],
                 'syn_flag'=>'0',
                 'user_id'=>$Product['user_id']=Auth::id()
            ]);

        session()->flash('update','Product Update!!!');
        return redirect()->route('Admin.Product.Product_list');

        }

        return redirect()->route('Admin.Product.Product_list');

    }

    public function new_supply(){
        $new = Newproduct::latest()->get();
      return view('Admin.Product.new_supply',['new'=>$new]);
    }

    public function store_product_destory($id){

        $store_product_destory =Product::find($id);
        $store_product_destory->delete();

        session()->flash('delete','Product deleted');
          return back();
    }
}
