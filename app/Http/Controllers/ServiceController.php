<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store_Category(){
        $service = request()->validate([
        'service'=>' required'
        ]);
        Service::create($service);


        return back();
    }

    public function Category(){
        return view('Admin.Category.add_Category');
       }

}
