<?php

namespace App\Http\Controllers;

use App\Models\Casenote;
use App\Models\Clinic;
use App\Models\Treatment;
use App\Models\Service_order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CasenoteController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function Casenote(){
        $treatment = Clinic::all();
    return view('Admin.Casenote.Casenote',['treatment'=>$treatment]);
    }

    public function Casenote_store(){

   $Casenote = request()->validate([
       'case_id'=>'required',
       'visual_evaluation'=>'required',
       'physical_examination'=>'required',
       'other_examination'=>'required',
       'result'=>'required',
       'diagnosis'=>'required',
       'treatment'=>'required',
       'temp'=>'required',
       'pulse'=>'required',
       'resp'=>'required',
       'Veterinarian'=>'required',
       'Status'=>'required',
       'date'=>'required',
       'month'=>'required',
       'year'=>'required',
       'user_id'=>'required'

   ]);
   Casenote::create($Casenote);
    session()->flash('message','Treatment submitted!!!');

   return back();

    }

    public function Casenote_list(){

    $Casenote_list = Casenote::with(['treatment','clinic'])->selectRaw('distinct case_id')->get();

    // dd($Casenote_list);


    return view('Admin.Casenote.Casenote_list',['Casenote_list'=>$Casenote_list]);
    }

   public function Casenote_view($id){
     $Casenote_view = Casenote::where("case_id",$id)->get();
     $treatment = Treatment::where("Pet_id",$id)->get();
    $Service_order= Service_order::with('service_item')->where('Pet_name', $id)->get();

    // $Service= Service_order::with('service_item')->where('Pet_name', $id)->where('prod_name','!=','0')->get();

    // dd($Service_order);

     $clinic = Clinic::where("id",$id)->first();
    // dd($clinic);
     return view('Admin.Casenote.Casenote_view',['Casenote_view'=>$Casenote_view,'treatment'=>$treatment,'clinic'=>$clinic,'Service_order'=>$Service_order]);
   }

   public function Casenote_edit($id){
    $Casenote = DB::table('casenotes')->where('id',$id)->first();
    return view('Admin.Casenote.Casenote_edit',['Casenote'=>$Casenote]);
   }

   public function Casenote_update(Request $request,$id){

    $Casenote_update = request()->validate([

        // 'visual_evaluation'=>'required',
        // 'physical_examination'=>'required',
        // 'other_examination'=>'required',
        // 'result'=>'required',
        // 'diagnosis'=>'required',
        'treatment'=>'required',
        'temp'=>'required',
        'pulse'=>'required',
        'resp'=>'required',
        'Veterinarian'=>'required',
        'Status'=>'required',
        'date'=>'required',
        'month'=>'required',
        'year'=>'required',
        'syn_flag'=>'required'
    ]);

    Casenote::whereId($id)->update($Casenote_update);
    return redirect()->route('Admin.Casenote.Casenote_list');
   }



   public function Casenote_destory($id){

     $Casenote_destory =Casenote::find($id);

     $Casenote_destory->delete();

     return back();
}
}
