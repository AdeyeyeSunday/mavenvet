<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Category(){
     return view('Admin.Category.add_Category');
    }

    public function store_Category(){
        $category = request()->validate([
        'Category'=>' required'
        ]);


        $cat = DB::table('categories')->where('Category',$category['Category'])->get();

        if(count($cat)>0){
            session()->flash('message','Duplicate entry!!!');
            return redirect()->route('Admin.Category.list_Category');
        }else{
            Category::create($category);
        }
        session()->flash('message','Category create!!!');
        return redirect()->route('Admin.Category.list_Category');
    }



    public function list(){

$Category= Category::all();
     return view('Admin.Category.list_Category',['Category'=>$Category]);
    }

    public function edit_Category($id){

    $Category=DB::table('categories')->where('id', $id)->first();

     return view('Admin.Category.edit_Category',['Category'=>$Category]);
    }


    public function update_Category(Request $request, $id){
        $update = request()->validate([
            'Category'=>'required',
            'syn_flag'=>'required',
            ]);
            Category::whereId($id)->update($update);
            return redirect()->route('Admin.Category.list_Category')->with('message', 'Category Updated!');
    }


    public function destory($id){

     $category = Category::find($id);

     $category->delete();
     session()->flash('delete','Category Deleted');

     return back();
    }

}
