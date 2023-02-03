<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AValidacionesController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function view_validacion(){
        return view('viewAdmin.validaciones');
            }
}
