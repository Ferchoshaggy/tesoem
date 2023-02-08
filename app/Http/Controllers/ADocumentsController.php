<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ADocumentsController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function view_documen(){
return view('viewAdmin.documents');
    }

    public function view_documenJax(){

        $carreras=DB::table('carreras')->where('id',Auth::user()->carrera_tesoem)->first();
        $usuarios=DB::table('users')->where('carrera_tesoem',$carreras->id)->where('tipo_user',3)->Paginate(10);
        $carrerass=DB::table('carreras')->where('id',Auth::user()->carrera_tesoem)->get();
        $procesos=DB::table('procesos_alumno')->select("*")->get();

        return view('viewAdmin.documentsJax',compact("carrerass","usuarios","procesos"));
            }


public function doc_modal($id){

    $datosUser=DB::table("users")->where("id",$id)->first();
    $procesos=DB::table('procesos_alumno')->where("id_user",$datosUser->id)->first();
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

        return json_encode([$comprobante,$historial]);
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

            return response()->json([]);
    }
}

}
