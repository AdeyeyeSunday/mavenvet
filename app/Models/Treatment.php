<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable=['Pet_id','Diagnosis_Test','Next_Vaccination_Appointment','Next_Appointments','Payment_Status','Amount_Paid','Outstanding_Payment','Mode_Of_Payment','Veterinarian','Status','user_id','date','month','year','pro_id','amount_charge'];

    public function user(){
        return $this->belongsTo('App/Models/User');
}

public function clinic()
{
    return $this->hasOne('App\Models\Clinic','id', 'Pet_id');
}


public function Casenote()
{
    return $this->hasOne('App\Models\Casenote','id', 'case_id');
}



}
