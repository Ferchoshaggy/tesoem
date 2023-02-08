<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
//esta es para poder acceder a los datos del usuario
use Illuminate\Support\Facades\Auth;
class AValidacionesController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function view_validacion(){

        $alumnos=DB::table("users")->join('procesos_alumno', 'users.id_proceso_activo', '=', 'procesos_alumno.id')->where("etapa",2)->join('instituciones', 'procesos_alumno.id_institucion_old', '=', 'instituciones.id')->select('users.*','procesos_alumno.etapa','procesos_alumno.estatus', 'instituciones.nombre')->get();
        $carrera=DB::table("carreras")->where("id",Auth::user()->carrera_tesoem)->first();
        $materias_new=DB::table("materias")->where("id_carrera", Auth::user()->carrera_tesoem)->get();
        $instituciones=DB::table("instituciones")->select("*")->get();

        return view('viewAdmin.validaciones',compact("alumnos","carrera","materias_new"));
    }

    public function materias_cursadas($id){

        $proceso=DB::table("procesos_alumno")->where("id_user",$id)->first();

        if ($proceso->tipo_proceso==1) {
            $materias_cursadas[0]=DB::table("calificaciones_materias")->join('materias', 'calificaciones_materias.id_materia', '=', 'materias.id')->where("id_proceso_alumno",$proceso->id)->select('calificaciones_materias.*','materias.nombre','materias.matricula', 'materias.temario','materias.semestre',)->get();
        }else{
            $materias_cursadas[0]=DB::table("materias_convalidacion")->join('materias', 'materias_convalidacion.id_materia', '=', 'materias.id')->where("id_user",$id)->select('materias_convalidacion.*','materias.nombre','materias.matricula', 'materias.temario','materias.semestre',)->get();
        }
        $materias_cursadas[1]=DB::table("procesos_alumno")->where("id_user",$id)->first();
        $materias_cursadas[2]=DB::table("carreras")->where("id",$proceso->id_carrera_old)->first();

        return json_encode($materias_cursadas);
    }

    public function consuta_materias_admin(){
        
    }
}
