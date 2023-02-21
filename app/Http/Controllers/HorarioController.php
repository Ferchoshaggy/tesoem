<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
//esta es para poder acceder a los datos del usuario
use Illuminate\Support\Facades\Auth;
use PDF;

class HorarioController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function view_horario(){
        $etapa=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        if(Auth::user()->tipo_user!=3 || $etapa->etapa<3){
            return redirect("/redirects");
        }
        $datos_pdf=DB::table("datos_pdf")->where("id_carrera",Auth::user()->carrera_tesoem)->first();
        if ($datos_pdf==null) {
            return view("vacio");
        }
        $materias=DB::table("materias_convalidacion")->join('materias', 'materias_convalidacion.id_materia', '=', 'materias.id')->select("materias_convalidacion.*","materias.semestre","materias.nombre","materias.matricula","materias.creditos")->where("materias_convalidacion.id_user",Auth::user()->id)->get();
        $proceso=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        $horarios_pdf=DB::table("archivo_horarios")->where("carrera_tesoem",Auth::user()->carrera_tesoem)->first();
        if ($horarios_pdf==null) {
            return view("vacio");
        }
        return view("Horario.horario",compact("proceso","materias","horarios_pdf"));
    }

    public function materias_convalidacion_alumno(){
        $materias=DB::table("materias_convalidacion")->join('materias', 'materias_convalidacion.id_materia', '=', 'materias.id')->select("materias_convalidacion.*","materias.semestre","materias.nombre","materias.matricula","materias.creditos","materias.temario")->where("materias_convalidacion.id_user",Auth::user()->id)->get();
        return json_encode($materias);
    }

    public function guardar_horario(Request $request){
        $etapa=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        if(Auth::user()->tipo_user!=3 || $etapa->etapa<3){
            return redirect("/redirects");
        }
        date_default_timezone_set('America/Mexico_City');
        if($request->ajax()){

            try{
                DB::table("horario_alumnos")->where("id_proceso_alumno",Auth::user()->id_proceso_activo)->delete();
            }catch(\Exception $e){
                $exito="no";
                return json_encode($exito);
            }
            
            for ($i= 0; $i < count($request["grupo"]); $i++) {

                try{
                    
                    DB::table("horario_alumnos")->insert([
                        "id_materia_convalidacion" => $request["materias"][$i],
                        "id_proceso_alumno" => Auth::user()->id_proceso_activo,
                        "grupo" => $request["grupo"][$i],
                        "fecha" => date("Y-m-d")
                    ]);
                }catch(\Exception $e){
                    $exito=$e;
                    return json_encode($exito);
                }

                
            }
            $exito="si";
            return json_encode($exito);
        }else{
            $exito="no";
            return json_encode($exito);
        }
    }

    public function pdf_eqv(){
        $etapa=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        if(Auth::user()->tipo_user!=3 || $etapa->etapa<3){
            return redirect("/redirects");
        }
        $datos_pdf=DB::table("datos_pdf")->where("id_carrera",Auth::user()->carrera_tesoem)->first();
        if ($datos_pdf==null) {
            return view("vacio");
        }
        // indicamos que ya creo su horario
        DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->update([
            "etapa" => 4,
            "estatus" => 2
        ]);
        $datos_alumno=DB::table("users")->where("id",Auth::user()->id)->first();
        $proceso=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        $datos_institucion=DB::table("instituciones")->where("id",$proceso->id_institucion_old)->first();
        $datos_carrera=DB::table("carreras")->where("id",$proceso->id_carrera_old)->first();
        $datos_carrera_new=DB::table("carreras")->where("id",$datos_alumno->carrera_tesoem)->first();
        $datos_institucion_new=DB::table("instituciones")->where("id",$datos_carrera_new->id_institucion)->first();

        $materias=DB::table("horario_alumnos")->join('materias_convalidacion', 'materias_convalidacion.id', '=', 'horario_alumnos.id_materia_convalidacion')->join('materias', 'materias_convalidacion.id_materia', '=', 'materias.id')->select("horario_alumnos.*","materias.semestre","materias.nombre","materias.matricula","materias.creditos","materias_convalidacion.id_materia")->where("horario_alumnos.id_proceso_alumno",Auth::user()->id_proceso_activo)->get();

        $pdf = PDF::loadView('Horario.PDF_eqv',compact("datos_alumno","proceso","datos_institucion","datos_carrera","datos_carrera_new","datos_institucion_new","materias","datos_pdf"))->setPaper(array(0,0,612.00,792.00));
        return $pdf->stream("EQV".Auth::user()->name.".pdf");
        
    }

    public function materias_horario(){
        $etapa=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        if(Auth::user()->tipo_user!=3 || $etapa->etapa<3){
            return redirect("/redirects");
        }
        $materias_horario=DB::table("horario_alumnos")->join('materias_convalidacion', 'materias_convalidacion.id', '=', 'horario_alumnos.id_materia_convalidacion')->join('materias', 'materias_convalidacion.id_materia', '=', 'materias.id')->select("horario_alumnos.*","materias.temario","materias.nombre","materias.matricula","materias.creditos","materias_convalidacion.id_materia")->where("horario_alumnos.id_proceso_alumno",Auth::user()->id_proceso_activo)->get();

        return json_encode($materias_horario);
        
    }
}
