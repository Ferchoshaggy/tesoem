<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class AMateriasController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function view_materias(){
        return view('viewAdmin.materias');
            }

    public function view_materiasJax(){
        $materias=DB::table('materias')->where("id_carrera",Auth::user()->carrera_tesoem)->paginate(10);

        return view('viewAdmin.materiasJax',compact("materias"));
    }

    public function catmaterias_save(Request $request){
        if($request->ajax()){

DB::table('materias')->insert([
/*'id_institucion'=>,
'id_carrera'=>,
'id_user'=>,
'semestre'=>$request[""],
'nombre'=>$request[""],
'matricula'=>$request[""],
'temario'=>$request[""],
'creditos'=>$request[""],
*/
]);

        }
    }



}
