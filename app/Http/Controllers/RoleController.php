<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function role(){


        $role = Role::get();
         return view('Admin.User.role',['role'=>$role]);
    }



    public function role_store(){

        Role::create([
            'name'=>request('name'),
               'slug'=>Str::lower(request('name'))
        ]);
        return back();
    }


    // public function role_edit($id){


    // }



}

