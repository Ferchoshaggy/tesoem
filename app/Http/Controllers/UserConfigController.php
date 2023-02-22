<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use DB;
//esta es para poder acceder a los datos del usuario
use Illuminate\Support\Facades\Auth;
class UserConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $role = Auth::user()->tipo_user;
        $checkrole = explode(',', $role);
        if (in_array(1, $checkrole)) {
            return redirect('/ACuentas');
        }else if(in_array(2, $checkrole)) {
            return redirect('/ADocumentos');
        }else if(in_array(3, $checkrole)){
            return redirect('/Documentos');
        }
    }

    public function vista_user_edit(){

        //echo Auth::user()->id;

        $datos_user=DB::table("users")->where("id",Auth::user()->id)->get();
        return view('UserConfig.Edit',compact('datos_user'));
    }

    public function vista_correo(){
        $mensaje = "ya te dieron viada compa";
        $subject = "documentos aceptados";
        $modulo = "documentos";
        $ruta = "Documentos";
        return view('Correos.notificacion_plantilla',compact("mensaje","subject","modulo","ruta"));
    }

    public function user_actualizar(Request $request){

        $foto_delete=DB::table("users")->where("id",Auth::user()->id)->first();

        $time = date("d-m-Y")."-".time();

        if($request['foto']!=null){

            //eliminar la foto si es que existe
            if($foto_delete->foto!=null){
                $rute_fotos=public_path().'\fotos_users\\'.$foto_delete->foto;
                File::delete($rute_fotos);
            }
            //guardamos la nueva
            $foto = $time.''.rand(11111,99999).'foto'.$foto_delete->id.".".$request['foto']->getClientOriginalExtension();
            $destinationPath = public_path().'/fotos_users';
            $file_image = $request->file('foto');
            $file_image->move($destinationPath,$foto);
            //$foto="/up_file_participantes_eventos/".$time;
        }else{
            $foto=$foto_delete->foto;
        }


        if( $request['contrasena']!=null){

            if(strlen($request['contrasena'])<8){
                return redirect()->back()->with(['message' => 'Tu Constraseña Debe de Tener Minimo 8 Caracteres', 'color' => 'danger']);
            }

            $password=bcrypt($request['contrasena']);

            DB::table("users")->where("id",Auth::user()->id)->update([
                "name"=>$request['nombre'],
                "edad"=>$request["edad"],
                "direccion"=>$request['direccion'],
                "email"=>$request['correo'],
                "password"=>$password,
                "foto"=>$foto
            ]);

        }else{

            DB::table("users")->where("id",Auth::user()->id)->update([
                "name"=>$request['nombre'],
                "edad"=>$request["edad"],
                "direccion"=>$request['direccion'],
                "email"=>$request['correo'],
                "foto"=>$foto
            ]);

        }

        return redirect()->back()->with(['message' => 'Datos Actualizados con Éxito', 'color' => 'warning']);
    }
}
