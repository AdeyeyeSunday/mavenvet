<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaleController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Sale(){

        return view('Admin.Sale.Sale');
    }
}
