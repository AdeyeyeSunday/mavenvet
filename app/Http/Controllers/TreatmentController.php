<?php

namespace App\Http\Controllers;

use App\Models\Service_item;
use App\Models\Service_order;
use App\Models\Treatment;
use App\Models\Vaccinestore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TreatmentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function treatment_store(){

     $treatment = request()->validate([
         'user_id'=>'required',
         'Pet_id'=>'required',
         'Diagnosis_Test'=>'required',
         'Next_Vaccination_Appointment'=>'required',
         'Next_Appointments'=>'required',
         'Veterinarian'=>'required',
         'pro_id'=>'required',
         'date'=>'required',
         'month'=>'required',
         'year'=>'required'
         ]);


         Treatment::create($treatment);
         session()->flash('message','Make vaccination Payment !!!');
         $curQty = Vaccinestore::where("id",request()->pro_id)->first()->Quantity;
         Vaccinestore::where("id",request()->pro_id)->update(['Quantity'=>$curQty-request()->pro_id]);

         return redirect()->route('Admin.Payment.Payment');
    }







    public function treatment_list(){

        $treatment = Treatment::with(['clinic'])->get();

        // $service = Service_order::with('service_item')->get();
        // dd($service);
        return view('Admin.Treatment.treatment_list',['treatment'=>$treatment]);
    }


    public function Treatment_view($id){
        $Treatment_view = Treatment::with(['clinic'])->where('id', $id)->first();
        $treatment=Treatment::all();
        return view('Admin.Treatment.Treatment_view',['Treatment_view'=>$Treatment_view, 'treatment'=>$treatment]);
    }

    public function Treatment_edit($id){

        $Treatment_edit = Treatment::with(['clinic'])->where('id', $id)->first();
        return view('Admin.Treatment.Treatment_edit',['Treatment_edit'=>$Treatment_edit]);
    }

    public function Treatment_update(Request $request,$id){
     $Treatment_update = request()->validate([

        'Diagnosis_Test'=>'required',
        'Next_Vaccination_Appointment'=>'required',
        'Next_Appointments'=>'required',
        'Veterinarian'=>'required',
        'Status'=>'required',
        'Case_Note'=>'required',
        'syn_flag'=>'0'
     ]);
     Treatment::whereId($id)->update($Treatment_update);
     return back();
    }

    // public function Treatment_Payment($id){
    //     $Treatment_payment = Treatment::with(['clinic'])->where('id', $id)->first();
    //     return view('Admin.Treatment.Treatment_Payment',['Treatment_payment'=>$Treatment_payment]);
    // }

    public function Treatment_case_note($id){
        $Treatment_payment = Treatment::with(['clinic'])->where('id', $id)->first();
        return view('Admin.Treatment.Treatment_case_note',['Treatment_payment'=>$Treatment_payment]);
    }



    public function Treatment_destory($id){

        $Treatment_destory = Treatment::find($id);

             $Treatment_destory->delete();

             return back();

    }



}
