<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class ACuentasController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function view_cuentas(){

    return view('viewAdmin.cuentas');
  }


  public function view_cuentasJax(){
    if(Auth::user()->tipo_user==1){
        $usuarios=DB::table('users')->where('tipo_user',2)->orWhere('tipo_user',3)->Paginate(10);
        $carreras=DB::table('carreras')->select('*')->Paginate(10);
    }else{
        $carreras=DB::table('carreras')->where('id',Auth::user()->carrera_tesoem)->first();
        $usuarios=DB::table('users')->where('carrera_tesoem',$carreras->id)->where('tipo_user',3)->Paginate(10);
    }
    return view('viewAdmin.cuentasJax',compact("carreras","usuarios"));
  }

public function editar_user(Request $request){

    if($request->ajax()){

   if($request["contraseña"] && $request["contraseña2"]){
    DB::table('users')->where("id",$request["id_user"])->update([
        'matricula'=>$request["matricula"],
        'name'=>$request["nombre"],
        'email'=>$request["correo"],
        'password'=>bcrypt($request["contraseña"]),
        ]);
   }else{
    DB::table('users')->where("id",$request["id_user"])->update([
    'matricula'=>$request["matricula"],
    'name'=>$request["nombre"],
    'email'=>$request["correo"],
    ]);
   }

   return response()->json([]);

    }

}

public function eliminar_user(Request $request){
    if($request->ajax()){
        DB::table('users')->where("id",$request["id_user"])->delete();
        return response()->json([]);
    }
}

public function save_user(Request $request){
    if($request->ajax()){

        $time = date("d-m-Y")."-".time();

        if($request['foto']!=null){

            //guardamos la nueva
            $foto = $time.''.rand(11111,99999).'foto'.".".$request['foto']->getClientOriginalExtension();
            $destinationPath = public_path().'/fotos_users';
            $file_image = $request->file('foto');
            $file_image->move($destinationPath,$foto);
            //$foto="/up_file_participantes_eventos/".$time;
        }else{
            $foto=$foto_delete->foto;
        }

DB::table('users')->insert([
'name'=>$request["nombre"],
'email'=>$request["correo"],
'matricula'=>$request["matricula"],
'carrera_tesoem'=>$request["carrera_tesoem"],
'tipo_user'=>2,
'password'=>bcrypt($request["contraseña"]),
'foto'=>$foto,
]);

return response()->json([]);
}
}

//buscar por json el usuario

public function user_modal($id){
    $datosUser=DB::table("users")->where("id",$id)->first();
    return json_encode($datosUser);
}



}

