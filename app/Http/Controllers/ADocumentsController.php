<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionesCorreo;

class ADocumentsController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function view_documen(){
return view('viewAdmin.documents');
    }

    public function view_documenJax(){
        if(Auth::user()->tipo_user!=2){
            return redirect("/redirects");
        }
        $carreras=DB::table('carreras')->where('id',Auth::user()->carrera_tesoem)->first();
        $usuarios=DB::table('users')->where('carrera_tesoem',$carreras->id)->where('tipo_user',3)->Paginate(10);
        $carrerass=DB::table('carreras')->where('id',Auth::user()->carrera_tesoem)->get();
        $procesos=DB::table('procesos_alumno')->where('etapa',1)->get();

        return view('viewAdmin.documentsJax',compact("carrerass","usuarios","procesos"));
            }


public function doc_modal($id){

    $datosUser=DB::table("users")->where("id",$id)->first();
    $procesos=DB::table('procesos_alumno')->where("id",$datosUser->id_proceso_activo)->first();
    $comprobante=DB::table('comprobante_pago')->where("id_proceso_alumno",$procesos->id)->first();
    $historial=DB::table('historial_academico')->where("id_proceso_alumno",$procesos->id)->first();

    return json_encode([$datosUser,$procesos,$comprobante,$historial]);
}

public function rechazadoHA(Request $request){
    if($request->ajax()){

DB::table('historial_academico')->where("id",$request["id_ha"])->update([
"descripcion"=>$request["rechazoH"],
"estatus"=>3,
]);

DB::table('procesos_alumno')->where("id",$request["id_ha_pa"])->update([
    "estatus"=>3,
    ]);

    $alum_pro=DB::table('procesos_alumno')->where("id",$request["id_ha_pa"])->first();

    $alumno_mensaje=DB::table("users")->where("id",$alum_pro->id_user)->first();
    $mensaje="Tu docente de carrera Rechazo tu Hisorial Academico";
    try{
        Mail::to($alumno_mensaje->email)->send(new NotificacionesCorreo("Historial Academico Rechazado",$mensaje,"Documentos","Documentos"));
    }catch(\Exception $e){

    }

    return response()->json([]);

    }
}

public function rechazadoCP(Request $request){
    if($request->ajax()){

        DB::table('comprobante_pago')->where("id",$request["id_cp"])->update([
        "descripcion"=>$request["rechazoP"],
        "estatus"=>3,
        ]);

        DB::table('procesos_alumno')->where("id",$request["id_cp_pa"])->update([
            "estatus"=>3,
            ]);
           $alum_pro=DB::table('procesos_alumno')->where("id",$request["id_cp_pa"])->first();

            $alumno_mensaje=DB::table("users")->where("id",$alum_pro->id_user)->first();
            $mensaje="Tu docente de carrera Rechazo tu Comprobante de pago";
            try{
                Mail::to($alumno_mensaje->email)->send(new NotificacionesCorreo("Comprobante de pago Rechazado",$mensaje,"Documentos","Documentos"));
            }catch(\Exception $e){

            }

            return response()->json([]);

            }
}

public function aceptadoHA(Request $request){
    if($request->ajax()){
        DB::table('historial_academico')->where("id",$request["id_ha2"])->update([
            "estatus"=>5,
            ]);

            $datosUser=DB::table("users")->where("id",$request["id_user2"])->first();
            $procesos=DB::table('procesos_alumno')->where("id_user",$datosUser->id)->first();
            $comprobante=DB::table('comprobante_pago')->where("id_proceso_alumno",$procesos->id)->first();
            $historial=DB::table('historial_academico')->where("id_proceso_alumno",$procesos->id)->first();

        return json_encode([$comprobante,$historial,$procesos]);
    }

}

public function aceptadoCP(Request $request){
    if($request->ajax()){
        DB::table('comprobante_pago')->where("id",$request["id_cp2"])->update([
            "estatus"=>5,
            ]);

            $datosUser=DB::table("users")->where("id",$request["id_user3"])->first();
            $procesos=DB::table('procesos_alumno')->where("id_user",$datosUser->id)->first();
            $comprobante=DB::table('comprobante_pago')->where("id_proceso_alumno",$procesos->id)->first();
            $historial=DB::table('historial_academico')->where("id_proceso_alumno",$procesos->id)->first();

        return json_encode([$comprobante,$historial]);
    }
}

public function Docfinalizar (Request $request){
    if($request->ajax()){
        DB::table('procesos_alumno')->where("id",$request["id_pa_f"])->update([
            "estatus"=>1,
            "etapa"=>2,
            ]);

            $alum_pro=DB::table('procesos_alumno')->where("id",$request["id_pa_f"])->first();

            $alumno_mensaje=DB::table("users")->where("id",$alum_pro->id_user)->first();
            $mensaje="Tu docente de carrera Aprobo todos tus archivos, y puedes pasar a la etapa 2 que es seleccionar tus Materias";
            try{
                Mail::to($alumno_mensaje->email)->send(new NotificacionesCorreo("Documentos Aprovados",$mensaje,"Materias","Materias"));
            }catch(\Exception $e){

            }

            return response()->json([]);
    }
}

}
