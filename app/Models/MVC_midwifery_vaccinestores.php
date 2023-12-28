<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MVC_midwifery_vaccinestores extends Model
{
    use HasFactory;
    protected $guarded = [];

 public function vaccineiteams(){

        return $this->hasMany(Vaccineiteam::class,'order_id');
    }
}
