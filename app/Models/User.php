<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function Category(){

    return $this->belongsTo('App/Models/Category');
    }

    public function Product(){

        return $this->belongsTo('App/Models/Product','user_id');
        }


        public function Product_midwifery(){

            return $this->belongsTo('App/Models/Product_midwifery');
            }



    public function Supplier(){

      return $this->belongsTo('App/Models/Supplier');
     }


     public function Expenses(){
        return $this->belongsTo('App\Models\Expense') ;
     }

     public function Clinics(){
        return $this->belongsTo('App\Models\Clinic') ;
     }

     public function Treatment(){
        return $this->hasOne('App\Models\Clinic') ;
     }


     public function Casenote(){
        return $this->belongsTo('App\Models\Casenote') ;
     }


     public function Customer(){
     return $this->belongsTo('App\Models\Customer') ;
     }

     public function Employee(){

        return $this->hasOne('App\Models\Employee','id','name_id');
    }

    public function leave(){

        return $this->belongsTo('App\Models\Leave');
    }


    public function salary(){

        return $this->belongsTo('App\Models\Salary');
    }

    public function service_orders(){

        return $this->belongsTo('App\Models\Service_order');
    }



    public function shop_order(){

        return $this->belongsTo('App\Models\Shop_order');
    }


  public function orderIteams(){

        return $this->belongsTo('App\Models\OrderIteams');
    }






    public function store_cart(){

        return $this->belongsTo('App\Models\Store_cart');
    }




    public function permissions(){
        return $this->belongsToMany('App\Models\Permission');
    }




    public function roles(){
        return $this->belongsToMany('App\Models\Role');
    }





    public function userHasRole($role_name){
        foreach($this->roles as $role){
            if(Str::lower($role_name) == Str::lower($role->name))
            return true;
        }
        return false;
    }


    public function cash(){
        return $this->belongsTo('App\Models\Cash');
    }


    public function shop_item(){
        return $this->belongsTo('App\Models\Shop_item');
    }

 public function vaccinestore(){

        return $this->belongsTo('App/Models/Vaccinestore');
}




}
