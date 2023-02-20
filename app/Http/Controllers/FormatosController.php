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
        $etapa=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        if(Auth::user()->tipo_user!=3 || $etapa->etapa<3){
            return redirect("/redirects");
        }
        $proceso=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        return view("Formatos.formatos",compact("proceso"));
    }

    public function pdf_anexo_6(){
        $etapa=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        if(Auth::user()->tipo_user!=3 || $etapa->etapa<3){
            return redirect("/redirects");
        }
        $datos_alumno=DB::table("users")->where("id",Auth::user()->id)->first();
        $proceso=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        $datos_institucion=DB::table("instituciones")->where("id",$proceso->id_institucion_old)->first();
        $datos_carrera=DB::table("carreras")->where("id",$proceso->id_carrera_old)->first();
        $datos_carrera_new=DB::table("carreras")->where("id",$datos_alumno->carrera_tesoem)->first();
        $datos_institucion_new=DB::table("instituciones")->where("id",$datos_carrera_new->id_institucion)->first();

        if($proceso->tipo_proceso==1){

            $materias_calificacion=DB::table("calificaciones_materias")->join('materias', 'calificaciones_materias.id_materia', '=', 'materias.id')->where("id_proceso_alumno",$proceso->id)->get();

            $numero_semestres=1;
            $materias_2=DB::table("materias_convalidacion")->join('materias', 'materias_convalidacion.id_materia', '=', 'materias.id')->select("materias_convalidacion.*","materias.semestre","materias.nombre","materias.matricula")->get();
            foreach($materias_2 as $materia){
                
                if($materia->semestre>$numero_semestres && $materia->id_user==Auth::user()->id && $materia->validacion=="si"){
                    $numero_semestres=$materia->semestre;

                }
            }
            
            $materias=DB::table("materias_convalidacion")->join('materias', 'materias_convalidacion.id_materia', '=', 'materias.id')->select("materias_convalidacion.*","materias.semestre","materias.nombre","materias.matricula")->where("materias_convalidacion.id_user",Auth::user()->id)->where("materias.semestre","<=",$numero_semestres)->where("materias_convalidacion.validacion","si")->where("materias_convalidacion.calificacion",">=",70)->get();

            $pdf = PDF::loadView('Formatos.PDF_anexo_6',compact("datos_alumno","proceso","datos_institucion","datos_carrera","datos_carrera_new","datos_institucion_new","numero_semestres","materias","materias_calificacion"))->setPaper(array(0,0,612.00,792.00));
            return $pdf->stream("ANEXO_VI_".Auth::user()->name.".pdf");

        }else{

            $numero_semestres=1;
            $materias_2=DB::table("materias_convalidacion")->join('materias', 'materias_convalidacion.id_materia', '=', 'materias.id')->select("materias_convalidacion.*","materias.semestre","materias.nombre","materias.matricula")->where("materias_convalidacion.id_user",Auth::user()->id)->where("materias_convalidacion.validacion","si")->where("materias_convalidacion.calificacion",">=",70)->get();
            foreach($materias_2 as $materia){
                
                if($materia->semestre>$numero_semestres && $materia->id_user==Auth::user()->id && $materia->validacion=="si"){
                    $numero_semestres=$materia->semestre;

                }
            }
            
            $materias=DB::table("materias_convalidacion")->join('materias', 'materias_convalidacion.id_materia', '=', 'materias.id')->select("materias_convalidacion.*","materias.semestre","materias.nombre","materias.matricula")->where("materias_convalidacion.id_user",Auth::user()->id)->where("materias.semestre","<=",$numero_semestres)->where("materias_convalidacion.validacion","si")->where("materias_convalidacion.calificacion",">=",70)->get();

            $pdf = PDF::loadView('Formatos.PDF_anexo_6',compact("datos_alumno","proceso","datos_institucion","datos_carrera","datos_carrera_new","datos_institucion_new","numero_semestres","materias"))->setPaper(array(0,0,612.00,792.00));
            return $pdf->stream("ANEXO_VI_".Auth::user()->name.".pdf");
        }
        

        
        
    }

    public function pdf_anexo_7(){
        $etapa=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        if(Auth::user()->tipo_user!=3 || $etapa->etapa<3){
            return redirect("/redirects");
        }
        $datos_alumno=DB::table("users")->where("id",Auth::user()->id)->first();
        $proceso=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        $datos_institucion=DB::table("instituciones")->where("id",$proceso->id_institucion_old)->first();
        $datos_carrera=DB::table("carreras")->where("id",$proceso->id_carrera_old)->first();
        $datos_carrera_new=DB::table("carreras")->where("id",$datos_alumno->carrera_tesoem)->first();
        $datos_institucion_new=DB::table("instituciones")->where("id",$datos_carrera_new->id_institucion)->first();

        if($proceso->tipo_proceso==1){

            $materias_calificacion=DB::table("calificaciones_materias")->join('materias', 'calificaciones_materias.id_materia', '=', 'materias.id')->where("id_proceso_alumno",$proceso->id)->get();

            $numero_semestres=1;
            $materias_2=DB::table("materias_convalidacion")->join('materias', 'materias_convalidacion.id_materia', '=', 'materias.id')->select("materias_convalidacion.*","materias.semestre","materias.nombre","materias.matricula")->get();
            foreach($materias_2 as $materia){
                
                if($materia->semestre>$numero_semestres && $materia->id_user==Auth::user()->id && $materia->validacion=="si"){
                    $numero_semestres=$materia->semestre;

                }
            }
            
            $materias=DB::table("materias_convalidacion")->join('materias', 'materias_convalidacion.id_materia', '=', 'materias.id')->select("materias_convalidacion.*","materias.semestre","materias.nombre","materias.matricula","materias.creditos")->where("materias_convalidacion.id_user",Auth::user()->id)->where("materias.semestre","<=",$numero_semestres)->where("materias_convalidacion.validacion","si")->where("materias_convalidacion.calificacion",">=",70)->get();

            $pdf = PDF::loadView('Formatos.PDF_anexo_7',compact("datos_alumno","proceso","datos_institucion","datos_carrera","datos_carrera_new","datos_institucion_new","numero_semestres","materias","materias_calificacion"))->setPaper(array(0,0,612.00,792.00));
            return $pdf->stream("ANEXO_VII_".Auth::user()->name.".pdf");


        }else{

            $numero_semestres=1;
            $materias_2=DB::table("materias_convalidacion")->join('materias', 'materias_convalidacion.id_materia', '=', 'materias.id')->select("materias_convalidacion.*","materias.semestre","materias.nombre","materias.matricula","materias.creditos")->where("materias_convalidacion.id_user",Auth::user()->id)->where("materias_convalidacion.validacion","si")->where("materias_convalidacion.calificacion",">=",70)->get();
            foreach($materias_2 as $materia){
                
                if($materia->semestre>$numero_semestres && $materia->id_user==Auth::user()->id && $materia->validacion=="si"){
                    $numero_semestres=$materia->semestre;

                }
            }
            
            $materias=DB::table("materias_convalidacion")->join('materias', 'materias_convalidacion.id_materia', '=', 'materias.id')->select("materias_convalidacion.*","materias.semestre","materias.nombre","materias.matricula","materias.creditos")->where("materias_convalidacion.id_user",Auth::user()->id)->where("materias.semestre","<=",$numero_semestres)->where("materias_convalidacion.validacion","si")->where("materias_convalidacion.calificacion",">=",70)->get();

            $pdf = PDF::loadView('Formatos.PDF_anexo_7',compact("datos_alumno","proceso","datos_institucion","datos_carrera","datos_carrera_new","datos_institucion_new","numero_semestres","materias"))->setPaper(array(0,0,612.00,792.00));
            return $pdf->stream("ANEXO_VII_".Auth::user()->name.".pdf");


        }

        
        
    }

    public function pdf_convalidacion(){
        $etapa=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        if(Auth::user()->tipo_user!=3 || $etapa->etapa<3){
            return redirect("/redirects");
        }
        $datos_alumno=DB::table("users")->where("id",Auth::user()->id)->first();
        $proceso=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        $datos_institucion=DB::table("instituciones")->where("id",$proceso->id_institucion_old)->first();
        $datos_carrera=DB::table("carreras")->where("id",$proceso->id_carrera_old)->first();
        $datos_carrera_new=DB::table("carreras")->where("id",$datos_alumno->carrera_tesoem)->first();
        $datos_institucion_new=DB::table("instituciones")->where("id",$datos_carrera_new->id_institucion)->first();

        $materias=DB::table("materias_convalidacion")->join('materias', 'materias_convalidacion.id_materia', '=', 'materias.id')->select("materias_convalidacion.*","materias.semestre","materias.nombre","materias.matricula","materias.creditos")->where("materias_convalidacion.id_user",Auth::user()->id)->get();

        $numero_semestres=1;
        foreach($materias as $materia){
            if($materia->semestre>$numero_semestres){
                $numero_semestres=$materia->semestre;
            }
        }

        $pdf = PDF::loadView('Formatos.PDF_convalidacion',compact("datos_alumno","proceso","datos_institucion","datos_carrera","datos_carrera_new","datos_institucion_new","materias","numero_semestres"))->setPaper(array(0,0,612.00,792.00));
        return $pdf->stream("CONVALIDACION_".Auth::user()->name.".pdf");
        
    }

}
