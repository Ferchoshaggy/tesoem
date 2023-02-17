<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
//esta es para poder acceder a los datos del usuario
use Illuminate\Support\Facades\Auth;

class HorarioController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function view_horario(){
        $materias=DB::table("materias_convalidacion")->join('materias', 'materias_convalidacion.id_materia', '=', 'materias.id')->select("materias_convalidacion.*","materias.semestre","materias.nombre","materias.matricula","materias.creditos")->where("materias_convalidacion.id_user",Auth::user()->id)->get();
        $proceso=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        return view("Horario.horario",compact("proceso","materias"));
    }

    public function materias_convalidacion_alumno(){
        $materias=DB::table("materias_convalidacion")->join('materias', 'materias_convalidacion.id_materia', '=', 'materias.id')->select("materias_convalidacion.*","materias.semestre","materias.nombre","materias.matricula","materias.creditos","materias.temario")->where("materias_convalidacion.id_user",Auth::user()->id)->get();
        return json_encode($materias);
    }
}
