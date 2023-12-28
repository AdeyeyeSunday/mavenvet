<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdmissionController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function admission(){

        $clinic = DB::table('clinics')->get();


        $admission =Admission::with('clinic')->where('staus','On admission')->get();;
// dd($admission);

        // $admission = DB::table('admissions')->where('staus','On admission')->get();

        return view('Admin.admission.admission',['clinic'=>$clinic,'admission'=>$admission]);

    }

    public function admission_store(){

        $inputs = request()->validate([
            'pet_id'=>'required',
            'user_id'=>'required',
            'diagnosis'=>'required',
            'amount'=>'required',
            'date'=>'required',
            'month'=>'required',
            'year'=>'required',
            'staus'=>'required',
            'location'=>'required'
        ]);
          $admission = DB::table('admissions')->where('staus','On admission')->count();
          if($admission < 4){
            Admission::create($inputs);
          }else{

            session()->flash('room','No Available Room for your dog, Please Discharge one!!!!!!');

          }


         return redirect()->route('Admin.admission.admission');
    }

    public function admission_update(Request $request,$id){
        $status = DB::table('admissions')->where('id',$id)->update(['staus'=>'Discharge']);
        return back();
    }




    public function admission_payment_edit($id){

        $admission_payment_edit =Admission::with('clinic')->where('id',$id)->first();

        // $admission_payment_edit = DB::table('admissions')->where('id',$id)->first();

       return view('Admin.admission.admission_payment_edit',['admission_payment_edit'=>$admission_payment_edit]);
    }

    public function admission_payment(Request $request,$id){
        $input = request()->validate([
            'payment'=>'required',
            'mode'=>'required',
            'user_id'=>'required',
            'syn_flag'=>'required'
        ]);
      Admission::whereId($id)->update($input);
      session()->flash('message','Paid... Please Discharge!!!!!');
      return redirect()->route('Admin.admission.admission');
    }
}
