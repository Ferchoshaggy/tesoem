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

if (isset($request["temarioD"])) {
for($j= 0; $j < count($request["temarioD"]); $j++){

                        if ($request['temarioD'][$j]!=null ) {

                            if($request['temarioD'][$j]->getClientOriginalExtension()=="pdf"){

                                $temario = rand(11111,99999)."temario_".$request['materiaD'][$j].".pdf";
                                $destinationPath = public_path().'/temarios';
                                $file_save = $request['temarioD'][$j];
                                $file_save->move($destinationPath,$temario);

                            }else{
                                //no es .pdf
                            return redirect()->back()->with(['message' => 'No son PDF, <bt>Verifica la integridad de los archivos', 'color' => 'primary','tipo' => 'pdf_null']);
                            }

                        }else{
                            //te falta archivos
                                return redirect()->back()->with(['message' => 'Faltan archivos', 'color' => 'dark','tipo' => 'falta']);


                        }

}
        }
*/
]);

        }
    }



}
