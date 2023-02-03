<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ACuentasController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function view_cuentas(){
        return view('viewAdmin.cuentas');
            }
}
