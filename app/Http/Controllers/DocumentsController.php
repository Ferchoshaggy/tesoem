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

        $h_academico=DB::table("historial_academico")->where("id_user",Auth::user()->id)->first();
        $dictamen=DB::table("dictamen")->where("id_user",Auth::user()->id)->first();
        $comprobante=DB::table("comprobante_pago")->where("id_user",Auth::user()->id)->first();
        $certificado=DB::table("certificado_medico")->where("id_user",Auth::user()->id)->first();
        return view("Documents.documents",compact("h_academico","dictamen","comprobante","certificado"));
    }

    public function save_documents(Request $request){

        date_default_timezone_set('America/Mexico_City');

        $time = date("d-m-Y")."-".time();

         

        //$exten=$request['h_academico']->getClientOriginalExtension();

        echo "<br>".$request['h_academico']->getClientOriginalExtension();

        if ($request['h_academico']->getClientOriginalExtension()=="pdf" && $request['dictamen']->getClientOriginalExtension()=="pdf" && $request['c_pago']->getClientOriginalExtension()=="pdf" && $request['c_medico']->getClientOriginalExtension()=="pdf") {

            if($request['h_academico']!=null && $request['dictamen']!=null && $request['c_pago']!=null && $request['c_medico']!=null ){

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

                //2
                $dictamen = rand(11111,99999).'dictamen'.Auth::user()->matricula.".pdf"; 
                $destinationPath = public_path().'/documents_dictamen';
                $file_save = $request->file('dictamen');
                $file_save->move($destinationPath,$dictamen);

                //3
                $c_pago = rand(11111,99999).'c_pago'.Auth::user()->matricula.".pdf"; 
                $destinationPath = public_path().'/documents_c_pago';
                $file_save = $request->file('c_pago');
                $file_save->move($destinationPath,$c_pago);

                //4
                $c_medico = rand(11111,99999).'c_medico'.Auth::user()->matricula.".pdf"; 
                $destinationPath = public_path().'/documents_c_medico';
                $file_save = $request->file('c_medico');
                $file_save->move($destinationPath,$c_medico);

            }else{
                //te falta archivos
                return redirect()->back()->with(['message' => 'Faltan archivos', 'color' => 'dark','tipo' => 'falta']);
            }
            
        }else{
            //no es .pdf
            return redirect()->back()->with(['message' => 'No son PDF, <bt>Verifica la integridad de los archivos', 'color' => 'primary','tipo' => 'pdf_null']);
        }

        try {

            DB::table("historial_academico")->insert([
                "id_user" => Auth::user()->id,
                "ruta" => $h_academico,
                "fecha" => date("Y-m-d"),
            ]);

            DB::table("dictamen")->insert([
                "id_user" => Auth::user()->id,
                "ruta" => $dictamen,
                "fecha" => date("Y-m-d"),
            ]);

            DB::table("comprobante_pago")->insert([
                "id_user" => Auth::user()->id,
                "ruta" => $c_pago,
                "fecha" => date("Y-m-d"),
            ]);

            DB::table("certificado_medico")->insert([
                "id_user" => Auth::user()->id,
                "ruta" => $c_medico,
                "fecha" => date("Y-m-d"),
            ]);

            return redirect()->back()->with(['message' => "Archivos guardados con exito", 'color' => 'success','tipo' => 'agregado']);
            //echo "seguardo";
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => "Algo salio mal con la base de datos, intente de nuevo", 'color' => 'warning']);
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
        if ($request['h_academico']!=null) {
            $ruta_h_academico=DB::table("historial_academico")->where("id_user",Auth::user()->id)->first();
            //eliminar el pdf agregado anterioromente
            if($ruta_h_academico!=null){
                $rute_delete=public_path().'\documents_h_academico\\'.$ruta_h_academico->ruta;
                File::delete($rute_delete);
                DB::table("historial_academico")->where("id_user",Auth::user()->id)->delete();
            }
            //guardamos el nuevo documento h_academico
            $h_academico = rand(11111,99999).'historial_academico'.Auth::user()->matricula.".pdf"; 
            $destinationPath = public_path().'/documents_h_academico';
            $file_save = $request->file('h_academico');
            $file_save->move($destinationPath,$h_academico);
        }

        if ($request['dictamen']!=null) {
            $ruta_dictamen=DB::table("dictamen")->where("id_user",Auth::user()->id)->first();
            //eliminar el pdf agregado anterioromente
            if($ruta_dictamen!=null){
                $rute_delete=public_path().'\documents_dictamen\\'.$ruta_dictamen->ruta;
                File::delete($rute_delete);
                DB::table("dictamen")->where("id_user",Auth::user()->id)->delete();
            }
            //guardamos el nuevo documento h_academico
            $dictamen = rand(11111,99999).'dictamen'.Auth::user()->matricula.".pdf"; 
            $destinationPath = public_path().'/documents_dictamen';
            $file_save = $request->file('dictamen');
            $file_save->move($destinationPath,$dictamen);
        }

        if ($request['c_pago']!=null) {
            $ruta_pago=DB::table("comprobante_pago")->where("id_user",Auth::user()->id)->first();
            //eliminar el pdf agregado anterioromente
            if($ruta_pago!=null){
                $rute_delete=public_path().'\documents_c_pago\\'.$ruta_pago->ruta;
                File::delete($rute_delete);
                DB::table("comprobante_pago")->where("id_user",Auth::user()->id)->delete();
            }
            //guardamos el nuevo documento h_academico
            $c_pago = rand(11111,99999).'c_pago'.Auth::user()->matricula.".pdf"; 
            $destinationPath = public_path().'/documents_c_pago';
            $file_save = $request->file('c_pago');
            $file_save->move($destinationPath,$c_pago);
        }

        if ($request['c_medico']!=null) {
            $ruta_medico=DB::table("certificado_medico")->where("id_user",Auth::user()->id)->first();
            //eliminar el pdf agregado anterioromente
            if($ruta_medico!=null){
                $rute_delete=public_path().'\documents_c_medico\\'.$ruta_medico->ruta;
                File::delete($rute_delete);
                DB::table("certificado_medico")->where("id_user",Auth::user()->id)->delete();
            }
            //guardamos el nuevo documento medico
            $c_medico = rand(11111,99999).'c_medico'.Auth::user()->matricula.".pdf"; 
            $destinationPath = public_path().'/documents_c_medico';
            $file_save = $request->file('c_medico');
            $file_save->move($destinationPath,$c_medico);
        }

        try {
            if ($h_academico!=null) {
                DB::table("historial_academico")->insert([
                    "id_user" => Auth::user()->id,
                    "ruta" => $h_academico,
                    "fecha" => date("Y-m-d"),
                ]);
                
            }
            
            if($dictamen!=null){
                DB::table("dictamen")->insert([
                    "id_user" => Auth::user()->id,
                    "ruta" => $dictamen,
                    "fecha" => date("Y-m-d"),
                ]);
            }
            
            if ($c_pago!=null) {
                DB::table("comprobante_pago")->insert([
                    "id_user" => Auth::user()->id,
                    "ruta" => $c_pago,
                    "fecha" => date("Y-m-d"),
                ]);
            }
            
            if ($c_medico!=null) {
                DB::table("certificado_medico")->insert([
                    "id_user" => Auth::user()->id,
                    "ruta" => $c_medico,
                    "fecha" => date("Y-m-d"),
                ]);
            }
            

            return redirect()->back()->with(['message' => "Archivo(s) actualizado(s) con exito", 'color' => 'warning','tipo' => 'actualizar']);
            //echo "seguardo";
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => "Algo salio mal con la base de datos, intente de nuevo", 'color' => 'warning','tipo' => 'error']);
        }

    }
}
