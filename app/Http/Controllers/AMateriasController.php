<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
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
            $archivo = $time.''.rand(11111,99999).'temario'.".".$request['temario']->getClientOriginalExtension();
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

                                    $temario = rand(11111,99999)."temario_".$request['materiasD'][$j]->getClientOriginalExtension();
                                    $destinationPath = public_path().'/temarios';
                                    $file_save = $request['temarioD'][$j];
                                    $file_save->move($destinationPath,$temario);

                                }

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
    return json_encode([]);
                            }

    }}
    $semestre=$request["semestre"];
    return json_encode([$semestre]);
        }
    }

public function materia_search($id){
    $materia=DB::table('materias')->where('id',$id)->first();
    return json_encode($materia);
}

public function materia_eliminar(Request $request){
    if($request->ajax()){

DB::table('materias')->where('id',$request["id_matDELE"])->delete();
return response()->json([]);
    }
}


public function update_materia(Request $request){
    if($request->ajax()){

$temario_delete=DB::table('materias')->where('id',$request["id_updatemat"])->first();

$time = date("d-m-Y")."-".time();

if($request['temario']!=null){

    //eliminar el temario existente
    if($temario_delete->temario!=null){
        $rute_temario=public_path().'\temarios\\'.$temario_delete->temario;
        File::delete( $rute_temario);
    }
    //guardamos el nuevo temario
    $temario = $time.''.rand(11111,99999).'temario'.".".$request['temario']->getClientOriginalExtension();
    $destinationPath = public_path().'/temarios';
    $file_save = $request->file('temario');
    $file_save->move($destinationPath,$temario);

}else{
    $temario=$temario_delete->temario;
}


DB::table('materias')->where('id',$request["id_updatemat"])->update([
   'semestre'=>$request["semestre"],
   'nombre'=>$request["materias"],
   'matricula'=>$request["clave"],
   'temario'=>$temario,
   'creditos'=>$request["creditos"],
   'fecha'=>date("Y-m-d"),
]);


return response()->json([]);
    }
}

public function materia_asignar(Request $request){
    if($request->ajax()){

DB::table('horarios')->insert([

'id_materia'=>$request["id_asigmate"],
'grupo'=>$request["grupo"],
'hora_inicio'=>$request["hora_ini"],
'hora_fin'=>$request["hora_fin"],
'dia'=>$request["dia"],

]);

if (isset($request["grupoD"])) {
    for($i=0;$i<count($request['grupoD']);$i++){

        try {

            DB::table('horarios')->insert([

                'id_materia'=>$request["id_asigmate"],
                'grupo'=>$request["grupoD"][$i],
                'hora_inicio'=>$request["hora_iniD"][$i],
                'hora_fin'=>$request["hora_finD"][$i],
                'dia'=>$request["diaD"][$i],

                ]);


        } catch (\Exception $e) {
return json_encode([]);
        }

}}

return response()->json([]);
    }
}

public function materias_asignadas($id){
    $materias=DB::table('materias')->where('id',$id)->first();
    $horarios=DB::table('horarios')->where('id_materia',$materias->id)->get();
    return response()->json($horarios);
}

public function editar_asignacion(Request $request){
    if($request->ajax()){

        for($i=0;$i<count($request['grupo']);$i++){

            try {

                DB::table('horarios')->where('id',$request["id_row_asig"][$i])->update([

                    'grupo'=>$request["grupo"][$i],
                    'hora_inicio'=>$request["hora_ini"][$i],
                    'hora_fin'=>$request["hora_fin"][$i],
                    'dia'=>$request["dia"][$i],

                    ]);


            } catch (\Exception $e) {
    return json_encode([]);
            }

        }
        return json_encode([]);

    }
}

}
