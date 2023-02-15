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
        $materias_cursadas[3]=DB::table("historial_academico")->where("id_proceso_alumno",$proceso->id)->first();

        return json_encode($materias_cursadas);
    }

    public function consuta_materias_admin(){
        $materias_admin=DB::table("materias")->where("id_carrera",Auth::user()->carrera_tesoem)->select('id','matricula','temario')->get();
        return json_encode($materias_admin);
    }

    public function actualizar_datos_alumno(Request $request){
        if($request->ajax()){
            for ($i= 0; $i < count($request["id_registro_materia"]); $i++) {

                try{
                    if ($request["tipo_proceso"]==1) {
                        DB::table("calificaciones_materias")->where("id",$request["id_registro_materia"][$i])->update([
                            "calificacion" =>$request["calificacion_old"][$i]
                        ]);
                    }else{
                        DB::table("materias_convalidacion")->where("id",$request["id_registro_materia"][$i])->update([
                            "calificacion" =>$request["calificacion_old"][$i]
                        ]);
                    }

                }catch(\Exception $e){
                    $exito="no";
                    return json_encode($exito);
                }

                try{

                    DB::table("materias")->where("id",$request["id_materia_id"][$i])->update([
                        "nombre" =>$request["materia_old"][$i],
                        "matricula" => $request["clave_old"][$i]
                    ]);

                }catch(\Exception $e){
                    $exito="no";
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

    public function guardar_validacion(Request $request){
        if($request->ajax()){
            date_default_timezone_set('America/Mexico_City');
            DB::table("materias_convalidacion")->where("id_user",$request["id_alumno"])->delete();

            if($request["tipo_proceso"]==1){

                $materias_new=DB::table("materias")->where("id_carrera",Auth::user()->carrera_tesoem)->get();
                try{
                    foreach($materias_new as $materia_new) {
                        DB::table("materias_convalidacion")->insert([
                            "id_materia" => $materia_new->id,
                            "id_user" => $request["id_alumno"],
                            "fecha" => date("Y-m-d")
                        ]);
                    }

                }catch(\Exception $e){
                    $exito[0]="no";
                    $exito[1]="al copiar las materias";
                    $exito[2]=$request["materia_new"][1];
                    return json_encode($exito);
                }
                

                for($i= 0; $i < count($request["materia_new"]); $i++){

                    if($request["clave_old"][$i]==$request["matricula_c_new"][$i]){
                        $procentaje=100;
                        $validacion="si";
                        $calificacion=$request["calificacion_old"][$i];

                    }else if($request["valor"][$i]>=80 && $request["calificacion_old"][$i]>70) {
                        $procentaje=$request["valor"][$i];
                        $validacion="si";
                        $calificacion=$request["calificacion_old"][$i];
                        
                    }else if($request["valor"][$i]>=80 && $request["calificacion_old"][$i]<70) {
                        $procentaje=$request["valor"][$i];
                        $validacion="si";
                        $calificacion=0;
                        
                    }else if($request["valor"][$i]<80){
                        $procentaje=$request["valor"][$i];
                        $validacion="no";
                        $calificacion=0;
                    }
                    try{
                        if($request["materia_new"][$i]!=-1){

                            DB::table("materias_convalidacion")->where("id_materia",$request["materia_new"][$i])->where("id_user",$request["id_alumno"])->update([
                                "calificacion" => $calificacion,
                                "porcentaje" => $procentaje,
                                "validacion" => $validacion
                            ]);

                        }
                        

                    }catch(\Exception $e){
                        $exito[0]="no";
                        $exito[1]="al agregar la calificacion";
                        $exito[2]=count($request["materia_new"]);
                        return json_encode($exito);
                    }

                    if($request["materia_new"][$i]!=-1){
                        $materia_camvalidacion=DB::table("materias_convalidacion")->where("id_materia",$request["materia_new"][$i])->where("id_user",$request["id_alumno"])->first();
                    }

                    try{
                        if($request["materia_new"][$i]!=-1){
                            DB::table("calificaciones_materias")->where("id",$request["id_registro_materia"][$i])->update([
                                "porcentaje" => $procentaje,
                                "id_materia_convalida" => $materia_camvalidacion->id
                            ]);
                        }

                    }catch(\Exception $e){
                        $exito[0]="no";
                        $exito[1]="editar las calificaciones_materias";
                        $exito[2]=count($request["materia_new"]);
                        return json_encode($exito);
                    }
                    
                }
            }else{

                for ($i= 0; $i < count($request["materia_new"]); $i++){

                    if($request["clave_old"][$i]==$request["matricula_c_new"][$i]){
                        $procentaje=100;
                        $validacion="si";
                        $calificacion=$request["calificacion_old"][$i];

                    }else if($request["valor"][$i]>=80 && $request["calificacion_old"][$i]>70) {
                        $procentaje=$request["valor"][$i];
                        $validacion="si";
                        $calificacion=$request["calificacion_old"][$i];
                        
                    }else if($request["valor"][$i]>=80 && $request["calificacion_old"][$i]<70) {
                        $procentaje=$request["valor"][$i];
                        $validacion="si";
                        $calificacion=0;
                        
                    }else if($request["valor"][$i]<80){
                        $procentaje=$request["valor"][$i];
                        $validacion="no";
                        $calificacion=0;
                    }
                    try{

                        DB::table("materias_convalidacion")->where("id",$request["id_registro_materia"][$i])->update([
                            "calificacion" => $calificacion,
                            "porcentaje" => $procentaje,
                            "validacion" => $validacion,
                        ]);

                    }catch(\Exception $e){
                        $exito[0]="no";
                        $exito[1]="en tipo_proceso 2";
                        return json_encode($exito);
                    }
                    
                }

            }
            DB::table("procesos_alumno")->where("id_user",$request["id_alumno"])->update([
                "etapa" => 3,
                "estatus" => 1,
            ]);
            //esto es para recordar la validacion que hizo el admin
            if($request["clave_carrera_old"]!=$request["clave_carrera"]){
                $union_claves=$request["clave_carrera_old"].$request["clave_carrera"];
                $recordar_registros=0;
                $recordar_registros=DB::table("recordar_validaciones")->where("union_claves",$union_claves)->count();

                if($recordar_registros==0){
                    for($i= 0; $i < count($request["materia_new"]); $i++){
                        if($request["materia_new"][$i]!=-1){
                            DB::table("recordar_validaciones")->insert([
                                "union_claves" => $union_claves,
                                "id_materia_old" => $request["id_materia_id"][$i],
                                "id_materia_new" => $request["materia_new"][$i],
                                "porcentaje_r" => $request["valor"][$i],
                                "fecha" => date("Y-m-d")
                            ]);
                        }
                    }
                }else{
                    for($i= 0; $i < count($request["materia_new"]); $i++){
                        if($request["materia_new"][$i]!=-1){

                            $validacion_r=0;
                            $validacion_r=DB::table("recordar_validaciones")->where("union_claves",$union_claves)->where("id_materia_old",$request["id_materia_id"][$i])->where("id_materia_new",$request["materia_new"][$i])->count();
                            if($validacion_r==0){
                                DB::table("recordar_validaciones")->insert([
                                    "union_claves" => $union_claves,
                                    "id_materia_old" => $request["id_materia_id"][$i],
                                    "id_materia_new" => $request["materia_new"][$i],
                                    "porcentaje_r" => $request["valor"][$i],
                                    "fecha" => date("Y-m-d")
                                ]);
                            }else{
                                $validacion_r_2=DB::table("recordar_validaciones")->where("union_claves",$union_claves)->where("id_materia_old",$request["id_materia_id"][$i])->where("id_materia_new",$request["materia_new"][$i])->first();
                                DB::table("recordar_validaciones")->where("id",$validacion_r_2->id)->update([
                                    "union_claves" => $union_claves,
                                    "id_materia_old" => $request["id_materia_id"][$i],
                                    "id_materia_new" => $request["materia_new"][$i],
                                    "porcentaje_r" => $request["valor"][$i]
                                ]);
                            }

                        }
                        
                    }

                }
                
            }
            $exito[0]="si";
            return json_encode($exito);
        }else{
            $exito[0]="no";
            $exito[1]="no existe el from";
            return json_encode($exito);
        }
    }

    public function recordar_validacion($clave_1,$clave_2){
        $union=$clave_1.$clave_2;
        $materias_recuerdo=DB::table("recordar_validaciones")->where("union_claves",$union)->get();
        return json_encode($materias_recuerdo);
    }
}
