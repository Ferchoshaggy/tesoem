<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionesCorreo;

//esta es para poder acceder a los datos del usuario
use Illuminate\Support\Facades\Auth;

class MateriasController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function view_materias(){

        $etapa=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        if ($etapa==null) {
            return redirect("/Documentos");
        }
        if(Auth::user()->tipo_user!=3 || $etapa->etapa<2){
            return redirect("/redirects");
        }

        $proceso=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        $instituciones=DB::table("instituciones")->select("*")->get();
        if($proceso->semestre!=null && $proceso->id_institucion_old!=null && $proceso->id_carrera_old!=null){
            $materias=DB::table("materias")->where("id_institucion",$proceso->id_institucion_old)->where("id_carrera",$proceso->id_carrera_old)->where("semestre","<=",$proceso->semestre)->get();
            $materias_cursadas=DB::table("calificaciones_materias")->where("id_proceso_alumno",Auth::user()->id_proceso_activo)->get();
        }else{
            $materias=null;
            $materias_cursadas=null;
        }
        if ($proceso->tipo_proceso==1) {
            return view("Materias.materias",compact("instituciones","proceso","materias","materias_cursadas"));
        }else{
            $materias=DB::table("calificaciones_materias")->join('materias', 'calificaciones_materias.id_materia', '=', 'materias.id')->select("calificaciones_materias.id","calificaciones_materias.calificacion","materias.semestre","materias.nombre","materias.matricula")->where("calificaciones_materias.id_proceso_alumno",Auth::user()->id_proceso_activo)->get();
            $numero_semestres=0;
            foreach($materias as $materia){
                if($materia->semestre>$numero_semestres){
                    $numero_semestres=$materia->semestre;
                }
            }
            return view("Materias.materias_b",compact("instituciones","proceso","materias","materias_cursadas","numero_semestres"));
        }
        
    }

    //metodo de ajax para guardar sin recargar
    public function guardar_institucion(Request $request){
        $etapa=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        if(Auth::user()->tipo_user!=3 || $etapa->etapa<2){
            return redirect("/redirects");
        }
        date_default_timezone_set('America/Mexico_City');

        if($request->ajax()){

            //echo $request;

            DB::table("instituciones")->insert([
                "nombre" => $request["institucion"],
                "id_user" => Auth::user()->id,
                "fecha" => date("Y-m-d")
            ]);

            //odtenemos el id de lo que se ababa de insertar
            $id = DB::getPdo()->lastInsertId();

            DB::table("carreras")->insert([
                "nombre" => $request["carrera"],
                "id_institucion" => $id,
                "id_user" => Auth::user()->id,
                "clave" => $request["clave_carrera"],
                "fecha" => date("Y-m-d")
            ]);

            $exito="si";
            
            return json_encode($exito);
        }else{
            $exito="no";
            return json_encode($exito);
        }
    }

    public function guardar_carrera(Request $request){

        $etapa=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        if(Auth::user()->tipo_user!=3 || $etapa->etapa<2){
            return redirect("/redirects");
        }

        date_default_timezone_set('America/Mexico_City');

        if($request->ajax()){

            //echo $request;
            DB::table("carreras")->insert([
                "nombre" => $request["carrera"],
                "id_institucion" => $request["institucion"],
                "id_user" => Auth::user()->id,
                "clave" => $request["clave_carrera"],
                "fecha" => date("Y-m-d")
            ]);

            $exito="si";
            
            return json_encode($exito);
        }else{
            $exito="no";
            return json_encode($exito);
        }
    }

    public function consulta_instituciones(){
        $etapa=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        if(Auth::user()->tipo_user!=3 || $etapa->etapa<2){
            return redirect("/redirects");
        }
        $instituciones=DB::table("instituciones")->select("*")->get();
        return json_encode($instituciones);
    }

    public function consulta_carreras($id){
        $etapa=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        if(Auth::user()->tipo_user!=3 || $etapa->etapa<2){
            return redirect()->back();
        }
        $carreras=DB::table("carreras")->where("id_institucion",$id)->get();
        return json_encode($carreras);
    }

    public function consulta_existencia_materias($id_institucion,$id_carrera,$numero_semestre){
        $etapa=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        if(Auth::user()->tipo_user!=3 || $etapa->etapa<2){
            return redirect()->back();
        }

        $resultados=DB::table("materias")->where("id_carrera",$id_carrera)->where("id_institucion",$id_institucion)->where('semestre', '<=', $numero_semestre)->get();

        return json_encode($resultados);
    }

    public function guardar_materias(Request $request){

        $etapa=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        if(Auth::user()->tipo_user!=3 || $etapa->etapa<2){
            return redirect("/redirects");
        }
        date_default_timezone_set('America/Mexico_City');

        if($request["cantidad_semestres_registrados"]=="materias_completas"){

            //si existen todas las materias que el alumno desea, entonces solo inicimos los estatus.
            DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->update([
                "id_institucion_old" => $request["institucion"],
                "id_carrera_old" => $request["carrera"],
                "estatus" => 2,
                "etapa" => 2,
                "semestre" => $request["semestre"],
            ]);
            return redirect()->back()->with(['message' => "Registro hecho corectamente", 'color' => 'success','tipo' => 'agregado']);

        }else{

            //para recorrer los semestrea, iniciamos desde el ultimo semestre registrodo, si no hay entonces empieza desde el 1
            for ($i= $request["cantidad_semestres_registrados"]; $i <= $request["semestre"]; $i++) { 

                //este es para recorrer las filas por semestre.
                if (isset($request["materia_semestre_".$i])) {

                    for ($j= 0; $j < count($request["materia_semestre_".$i]); $j++) { 


                        //verificamos si los temarios son pdf y si contengas datos.
                        if ($request['temario_semestre_'.$i][$j]!=null ) {

                            if($request['temario_semestre_'.$i][$j]->getClientOriginalExtension()=="pdf"){

                                $temario = rand(11111,99999)."temario_".$request['materia_semestre_'.$i][$j].".pdf"; 
                                $destinationPath = public_path().'/temarios';
                                $file_save = $request['temario_semestre_'.$i][$j];
                                $file_save->move($destinationPath,$temario);
                                
                            }else{
                                //te falta archivos
                                return redirect()->back()->with(['message' => 'Faltan archivos', 'color' => 'dark','tipo' => 'falta']);
                            }
                            
                        }else{
                            //no es .pdf
                            return redirect()->back()->with(['message' => 'No son PDF, <bt>Verifica la integridad de los archivos', 'color' => 'primary','tipo' => 'pdf_null']);
                        }

                        try {

                            DB::table("materias")->insert([
                                "id_institucion" => $request["institucion"],
                                "id_carrera" => $request["carrera"],
                                "id_user" => Auth::user()->id,
                                "semestre" => $i,
                                "nombre" => $request['materia_semestre_'.$i][$j],
                                "matricula" => $request["clave_semestre_".$i][$j],
                                "temario" => $temario,
                                "fecha" => date("Y-m-d"),
                            ]);

                        } catch (\Exception $e) {
                            return redirect()->back()->with(['message' => "Algo salio mal con la base de datos, intente de nuevo", 'color' => 'warning','tipo' => 'error']);
                        }

                        
                    }
                }
                
            }

            //al terminar entonces editamos el status.
            DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->update([
                "id_institucion_old" => $request["institucion"],
                "id_carrera_old" => $request["carrera"],
                "estatus" => 2,
                "etapa" => 2,
                "semestre" => $request["semestre"],
            ]);

            return redirect()->back()->with(['message' => "Materias registradas corectamente, gracias por aportar a la DB del sistema.", 'color' => 'success','tipo' => 'agregado']);
        }
    }

    public function guardar_calificaciones(Request $request){
        $etapa=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        if(Auth::user()->tipo_user!=3 || $etapa->etapa<2){
            return redirect("/redirects");
        }
        date_default_timezone_set('America/Mexico_City');
        //recorremos el arreglo para empezar a guardar los datos
        //echo Auth::user()->id_proceso_activo;
        
        for ($i= 0; $i < count($request["id_materia_guardada"]); $i++) {
            
            try {

                DB::table("calificaciones_materias")->insert([
                    "id_materia" => $request["id_materia_guardada"][$i],
                    "id_proceso_alumno" => Auth::user()->id_proceso_activo,
                    "calificacion" => $request["calificaciones"][$i],
                    "fecha" => date("Y-m-d")
                ]);

            } catch (\Exception $e) {
                return redirect()->back()->with(['message' => "Algo salio mal con la base de datos, intente de nuevo", 'color' => 'warning','tipo' => 'error']);
            } 
        }
        //al terminar entonces editamos el status.
        DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->update([
            "estatus" => 4,
        ]);

        $administradores=DB::table("users")->where("carrera_tesoem",Auth::user()->carrera_tesoem)->where("tipo_user",2)->get();

        foreach($administradores as $administrador){
            if($administrador->email!=null){
                $mensaje="El Alumno: ".Auth::user()->name." ya Subio sus calificaciones, Verificalas para que avance a paso 3 Formatos/Horarios";
                try{
                    Mail::to($administrador->email)->send(new NotificacionesCorreo("Calificaciones Subidas",$mensaje,"Validacion","AValidaciones"));
                }catch(\Exception $e){

                }
            }
        }

        return redirect()->back()->with(['message' => "Calificaciones registradas corectamente, Ya solo espera que sean aprobadas", 'color' => 'success','tipo' => 'agregado']);
    }

    public function guardar_calificaciones_b(Request $request){
        $etapa=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
        if(Auth::user()->tipo_user!=3 || $etapa->etapa<2){
            return redirect("/redirects");
        }
        date_default_timezone_set('America/Mexico_City');
        //recorremos el arreglo para empezar a guardar los datos
        //echo Auth::user()->id_proceso_activo;
        
        for ($i= 0; $i < count($request["id_materia_guardada"]); $i++) {
            
            try {

                DB::table("calificaciones_materias")->where("id",$request["id_materia_guardada"][$i])->update([
                    "calificacion" => $request["calificaciones"][$i],
                ]);

            } catch (\Exception $e) {
                return redirect()->back()->with(['message' => "Algo salio mal con la base de datos, intente de nuevo", 'color' => 'warning','tipo' => 'error']);
            } 
        }
        //al terminar entonces editamos el status.
        DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->update([
            "estatus" => 4,
        ]);

        $administradores=DB::table("users")->where("carrera_tesoem",Auth::user()->carrera_tesoem)->where("tipo_user",2)->get();

        foreach($administradores as $administrador){
            if($administrador->email!=null){
                $mensaje="El Alumno: ".Auth::user()->name." ya Subio sus calificaciones, Verificalas para que avance a paso 3 Formatos/Horarios";
                try{
                    Mail::to($administrador->email)->send(new NotificacionesCorreo("Calificaciones Subidas",$mensaje,"Validacion","AValidaciones"));
                }catch(\Exception $e){

                }
            }
        }

        return redirect()->back()->with(['message' => "Calificaciones registradas corectamente, Ya solo espera que sean aprobadas", 'color' => 'success','tipo' => 'agregado']);
    }
}
