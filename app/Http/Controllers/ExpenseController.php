<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Expense(){



        return view('Admin.Expense.Expense');
    }

    public function Expense_store(){
     $Expense = request()->validate([
        'name'=>'required',
        'amount'=>'required',
        'year'=>'required',
        'month'=>'required',
        'date'=>'required',
        'description'=>'required',
        'location'=>'required'
     ]);
     Expense::create($Expense);
     session()->flash('message','Expense create!!!!!');
     return redirect()->route('Admin.Expense.Monthly');
    }

    public function Monthly(){
   $date = (date('F'));
        $Expense= DB::table('expenses')->where('date', $date)->where('location','MVC midwifery')->get();
        $amount=DB::table('expenses')->where('date', $date)->sum('amount');
    return view('Admin.Expense.Monthly',['Expense'=>$Expense, 'amount'=>$amount]);
    }

    public function Monthly_edit($id){
        $Expense = DB::table('expenses')->where('id', $id)->where('location','MVC midwifery')->first();
        return view('Admin.Expense.Monthly_edit',['Expense'=>$Expense]);
    }

    public function Monthly_update(Request $request,$id){
        $update = request()->validate([
            'name'=>'required',
            'amount'=>'required',
            'description'=>'required'
         ]);
         Expense::whereId($id)->update($update);
         return redirect()->route('Admin.Expense.Monthly');
    }

    public function search(Request $request){
        $from= $request->input('from');
        $to = $request->input('to');
        $new=  DB::table('expenses')
        ->whereBetween('created_at', [$from, $to])->where('location','MVC midwifery')
        ->get();

        $amount= DB::table('expenses')
        ->whereBetween('created_at', [$from, $to])->where('location','MVC midwifery')
        ->sum('amount');

        return view('Admin.Expense.Expense_search',['new'=>$new,'amount'=>$amount]);
    }
}
