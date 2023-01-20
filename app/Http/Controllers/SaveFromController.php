<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use DB;
//esta es para poder acceder a los datos del usuario
use Illuminate\Support\Facades\Auth;
class SaveFromController extends Controller
{
    public function salvar_registro(Request $request){
        if($request->ajax()){

            //echo $request;

            $salvado[0]="si";
            $salvado[1]=$request;

            //guardamos la nueva
            $temario = rand(11111,99999)."temario.pdf"; 
            $destinationPath = public_path().'/temarios';
            $file_save = $request['temario_semestre_1'][0];
            $file_save->move($destinationPath,$temario);

            $temario = rand(11111,99999)."temario.pdf"; 
            $destinationPath = public_path().'/temarios';
            $file_save = $request['temario_semestre_1'][1784];
            $file_save->move($destinationPath,$temario);

            
            return json_encode($salvado);
        }else{
            $salvado[0]="no";
            $salvado[1]=$request;
            return json_encode($salvado);
        }
    }
}
