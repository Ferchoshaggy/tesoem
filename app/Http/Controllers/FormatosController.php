<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
//esta es para poder acceder a los datos del usuario
use Illuminate\Support\Facades\Auth;

class FormatosController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function view_formatos(){
        $proceso=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        return view("Formatos.formatos",compact("proceso"));
    }
}
