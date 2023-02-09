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
            date_default_timezone_set('America/Mexico_City');
            $time = date("d-m-Y")."-".time();

        if($request['temario']!=null){

            //guardamos la nueva
            $archivo = $time.''.rand(11111,99999).'temario'.".".$request['temario'].".pdf";
            $destinationPath = public_path().'/temarios';
            $file_save = $request['temario'];
            $file_save->move($destinationPath,$archivo);
        }else{
            $archivo=null;
        }

        $carrera=DB::table('carreras')->where("id",Auth::user()->carrera_tesoem)->first();

DB::table('materias')->insert([
'id_institucion'=>$carrera->id_institucion,
'id_carrera'=>Auth::user()->carrera_tesoem,
'id_user'=>Auth::user()->id,
'semestre'=>$request["semestre"],
'nombre'=>$request["materias"],
'matricula'=>$request["clave"],
'temario'=>$archivo,
'creditos'=>$request["creditos"],
'fecha'=>date("Y-m-d"),
]);

if (isset($request["temarioD"])) {
    for($j= 0; $j < count($request["temarioD"]); $j++){

                            if ($request['temarioD'][$j]!=null ) {

                                if($request['temarioD'][$j]->getClientOriginalExtension()=="pdf"){

                                    $temario = rand(11111,99999)."temario_".$request['materiasD'][$j].".pdf";
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

                            try {

                                DB::table('materias')->insert([
                                    'id_institucion'=>$carrera->id_institucion,
                                    'id_carrera'=>Auth::user()->carrera_tesoem,
                                    'id_user'=>Auth::user()->id,
                                    'semestre'=>$request["semestre"],
                                    'nombre'=>$request["materiasD"][$j],
                                    'matricula'=>$request["claveD"][$j],
                                    'temario'=>$temario,
                                    'creditos'=>$request["creditosD"][$j],
                                    'fecha'=>date("Y-m-d"),
                                    ]);


                            } catch (\Exception $e) {
        return redirect()->back()->with(['message' => "Algo salio mal con la base de datos, intente de nuevo", 'color' => 'warning','tipo' => 'error']);
                            }

    }}
    return response()->json([]);
        }
    }





}
