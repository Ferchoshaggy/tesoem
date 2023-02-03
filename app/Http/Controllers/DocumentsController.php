<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use DB;
//esta es para poder acceder a los datos del usuario
use Illuminate\Support\Facades\Auth;

class DocumentsController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function view_documents(){
        $otra_etapa=false;
        $h_academico=null;
        $comprobante=null;
        $proceso=null;
        //si no existe el proceso con etapa 1, quiere decir que el alumno va a iniciar un nuevo proceso.

        $procesos=DB::table("procesos_alumno")->where("id_user",Auth::user()->id)->get();
        if(count($procesos) == 0){

            DB::table("procesos_alumno")->insert([
                "id_user" =>  Auth::user()->id,
                "id_institucion_old" => null,
                "id_carrera_old" => null,
                "fecha" => date("Y-m-d"),
                "estatus" => 1,
                "etapa" => 1,
                "tipo_proceso" => 1,
            ]);
            //odtenemos el id de lo que se ababa de insertar
            $id = DB::getPdo()->lastInsertId();

            DB::table("users")->where("id",Auth::user()->id)->update([
                "id_proceso_activo" => $id,
            ]);

            $proceso=DB::table("procesos_alumno")->where("id",$id)->first();
            $h_academico=DB::table("historial_academico")->where("id_proceso_alumno",$id)->first();
            $comprobante=DB::table("comprobante_pago")->where("id_proceso_alumno",$id)->first();

        }else{

            $proceso=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();
            $h_academico=DB::table("historial_academico")->where("id_proceso_alumno",$proceso->id)->first();
            $comprobante=DB::table("comprobante_pago")->where("id_proceso_alumno",$proceso->id)->first();
                    
        }

        
        //$certificado=DB::table("certificado_medico")->where("id_user",Auth::user()->id)->first();
        return view("Documents.documents",compact("h_academico","comprobante","proceso","otra_etapa"));
    }

    public function save_documents(Request $request){

        date_default_timezone_set('America/Mexico_City');

        $time = date("d-m-Y")."-".time();

        //$exten=$request['h_academico']->getClientOriginalExtension();

        echo "<br>".$request['h_academico']->getClientOriginalExtension();

        if ($request['h_academico']->getClientOriginalExtension()=="pdf" && $request['c_pago']->getClientOriginalExtension()=="pdf") {

            if($request['h_academico']!=null && $request['c_pago']!=null ){

                /*eliminar la foto si es que existe
                if($foto_delete->foto!=null){
                    $rute_fotos=public_path().'\fotos_users\\'.$foto_delete->foto;
                    File::delete($rute_fotos);
                }*/
                //guardamos la nueva
                $h_academico = rand(11111,99999).'historial_academico'.Auth::user()->matricula.".pdf"; 
                $destinationPath = public_path().'/documents_h_academico';
                $file_save = $request->file('h_academico');
                $file_save->move($destinationPath,$h_academico);

                

                //3
                $c_pago = rand(11111,99999).'c_pago'.Auth::user()->matricula.".pdf"; 
                $destinationPath = public_path().'/documents_c_pago';
                $file_save = $request->file('c_pago');
                $file_save->move($destinationPath,$c_pago);

            }else{
                //te falta archivos
                return redirect()->back()->with(['message' => 'Faltan archivos', 'color' => 'dark','tipo' => 'falta']);
            }
            
        }else{
            //no es .pdf
            return redirect()->back()->with(['message' => 'No son PDF, <bt>Verifica la integridad de los archivos', 'color' => 'primary','tipo' => 'pdf_null']);
        }

        try {

            DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->update([
                "estatus" => 2,
            ]);

            $proceso=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();

            DB::table("historial_academico")->insert([
                "id_proceso_alumno" => $proceso->id,
                "ruta" => $h_academico,
                "estatus" => 2,
                "fecha" => date("Y-m-d"),
            ]);


            DB::table("comprobante_pago")->insert([
                "id_proceso_alumno" => $proceso->id,
                "ruta" => $c_pago,
                "estatus" => 2,
                "fecha" => date("Y-m-d"),
            ]);

            return redirect()->back()->with(['message' => "Archivos guardados con exito", 'color' => 'success','tipo' => 'agregado']);

            //echo "seguardo";
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => "Algo salio mal con la base de datos, intente de nuevo", 'color' => 'warning','tipo' => 'error']);
        }
    }

    public function update_documents(Request $request){

        date_default_timezone_set('America/Mexico_City');
        $ruta_h_academico=null;
        $ruta_dictamen=null;
        $ruta_pago=null;
        $ruta_medico=null;
        $h_academico=null;
        $dictamen=null;
        $c_pago=null;
        $c_medico=null;

        if ($request['h_academico']!=null){
            $ruta_h_academico=DB::table("historial_academico")->where("id_proceso_alumno",Auth::user()->id_proceso_activo)->first();
            //eliminar el pdf agregado anterioromente
            if($ruta_h_academico!=null){
                $rute_delete=public_path().'\documents_h_academico\\'.$ruta_h_academico->ruta;
                File::delete($rute_delete);
                DB::table("historial_academico")->where("id_proceso_alumno",Auth::user()->id_proceso_activo)->delete();
            }
            //guardamos el nuevo documento h_academico
            $h_academico = rand(11111,99999).'historial_academico'.Auth::user()->matricula.".pdf"; 
            $destinationPath = public_path().'/documents_h_academico';
            $file_save = $request->file('h_academico');
            $file_save->move($destinationPath,$h_academico);
        }

        if ($request['c_pago']!=null) {
            $ruta_pago=DB::table("comprobante_pago")->where("id_proceso_alumno",Auth::user()->id_proceso_activo)->first();
            //eliminar el pdf agregado anterioromente
            if($ruta_pago!=null){
                $rute_delete=public_path().'\documents_c_pago\\'.$ruta_pago->ruta;
                File::delete($rute_delete);
                DB::table("comprobante_pago")->where("id_proceso_alumno",Auth::user()->id_proceso_activo)->delete();
            }
            //guardamos el nuevo documento h_academico
            $c_pago = rand(11111,99999).'c_pago'.Auth::user()->matricula.".pdf"; 
            $destinationPath = public_path().'/documents_c_pago';
            $file_save = $request->file('c_pago');
            $file_save->move($destinationPath,$c_pago);
        }


        $proceso=DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->first();

        if($proceso->estatus==3){
            $estatus_2=4;
        }else{
            $estatus_2=2;
        }

        try {
            if ($h_academico!=null){
                DB::table("historial_academico")->insert([
                    "id_proceso_alumno" => Auth::user()->id_proceso_activo,
                    "ruta" => $h_academico,
                    "estatus" => $estatus_2,
                    "fecha" => date("Y-m-d"),
                ]);
                
            }
            
            
            if ($c_pago!=null) {
                DB::table("comprobante_pago")->insert([
                    "id_proceso_alumno" => Auth::user()->id_proceso_activo,
                    "ruta" => $c_pago,
                    "estatus" => $estatus_2,
                    "fecha" => date("Y-m-d"),
                ]);
            }
            
            DB::table("procesos_alumno")->where("id",Auth::user()->id_proceso_activo)->update([
                "estatus"=>4,
            ]);
            return redirect()->back()->with(['message' => "Archivo(s) actualizado(s) con exito", 'color' => 'warning','tipo' => 'actualizar']);
            //echo "seguardo";
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => "Algo salio mal con la base de datos, intente de nuevo", 'color' => 'warning','tipo' => 'error']);
        }

    }
}
