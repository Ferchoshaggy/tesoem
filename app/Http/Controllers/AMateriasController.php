<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AMateriasController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function view_materias(){
        return view('viewAdmin.materias');
            }
}
