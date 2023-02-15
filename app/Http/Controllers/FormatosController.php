<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
//esta es para poder acceder a los datos del usuario
use Illuminate\Support\Facades\Auth;
use PDF;

class FormatosController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function view_formatos(){
        $proceso=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        return view("Formatos.formatos",compact("proceso"));
    }

    public function pdf_anexo_6(){
        $datos_alumno=DB::table("users")->where("id",Auth::user()->id)->first();
        $proceso=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        $datos_institucion=DB::table("instituciones")->where("id",$proceso->id_institucion_old)->first();
        $datos_carrera=DB::table("carreras")->where("id",$proceso->id_carrera_old)->first();
        $datos_carrera_new=DB::table("carreras")->where("id",$datos_alumno->carrera_tesoem)->first();
        $datos_institucion_new=DB::table("instituciones")->where("id",$datos_carrera_new->id_institucion)->first();
        $materias=DB::table("materias_convalidacion")->join('materias', 'materias_convalidacion.id_materia', '=', 'materias.id')->select('materias_convalidacion.*','materias.semestre','materias.matricula','materias.nombre')->get();
        if($proceso->tipo_proceso==1){
            $materias_calificacion=DB::table("calificaciones_materias")->join('materias', 'calificaciones_materias.id_materia', '=', 'materias.id')->where("id_proceso_alumno",$proceso->id)->get();
        }else{
            $materias_calificacion=DB::table("materias_convalidacion")->join('materias', 'materias_convalidacion.id_materia', '=', 'materias.id')->where("id_user",Auth::user()->id)->get();
        }

        $numero_semestres=1;

        foreach($materias as $materia){

            if($materia->semestre>$numero_semestres){
                $numero_semestres=$materia->semestre;
            }
        }
        
        $pdf = PDF::loadView('Formatos.pdf_anexo_6',compact("datos_alumno","proceso","datos_institucion","datos_carrera","datos_carrera_new","datos_institucion_new","numero_semestres","materias","materias_calificacion"))->setPaper(array(0,0,612.00,792.00));
        return $pdf->stream("ANEXO_VI_".Auth::user()->name.".pdf");
    }
}
