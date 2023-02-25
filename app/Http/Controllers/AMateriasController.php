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
        $datos_pdf=DB::table("datos_pdf")->where("id_carrera",Auth::user()->carrera_tesoem)->first();
        $horarios=DB::table('archivo_horarios')->where("carrera_tesoem",Auth::user()->carrera_tesoem)->first();
        return view('viewAdmin.materias',compact("horarios","datos_pdf"));
            }

    public function view_materiasJax(){
        $materias=DB::table('materias')->where("id_carrera",Auth::user()->carrera_tesoem)->orderBy('semestre', 'asc')->paginate(10);

        return view('viewAdmin.materiasJax',compact("materias"));
    }

    public function catmaterias_save(Request $request){
        if($request->ajax()){
            date_default_timezone_set('America/Mexico_City');
            $time = date("d-m-Y")."-".time();

        if($request['temario']!=null){

            //guardamos la nueva
            $archivo = $time.''.rand(11111,99999).'temario_'.$request["materias"].".".$request["temario"]->getClientOriginalExtension();
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

                                    $temario = $time.''.rand(11111,99999)."temario_".$request['materiasD'][$j].".pdf";
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



    }
}

public function guardar_horario(Request $request){


$carreras=DB::table('carreras')->where("id",Auth::user()->carrera_tesoem)->first();

        date_default_timezone_set('America/Mexico_City');
        $time = date("d-m-Y")."-".time();

    if($request['horario']!=null){

        //guardamos la nueva
        $archivo = $time.''.rand(11111,99999).'horario_'.$carreras->nombre.".".$request["horario"]->getClientOriginalExtension();
        $destinationPath = public_path().'/horarios_c_docente';
        $file_save = $request['horario'];
        $file_save->move($destinationPath,$archivo);
    }else{
        $archivo=null;
    }

DB::table('archivo_horarios')->insert([

'usuario_h'=>Auth::user()->name,
'carrera_tesoem'=>Auth::user()->carrera_tesoem,
'horario'=>$archivo,
'fecha'=>date("Y-m-d"),

]);

return redirect()->back()->with(['message' => 'Horario Guardado con exito', 'color' => 'success','tipo' => 'agregado']);

}

public function editar_horario(Request $request){

    $horario_delete=DB::table('archivo_horarios')->where('id',$request["id_horarioE"])->first();
    $carreras=DB::table('carreras')->where("id",Auth::user()->carrera_tesoem)->first();

    date_default_timezone_set('America/Mexico_City');
    $time = date("d-m-Y")."-".time();

    if($request['horario']!=null){

        //eliminar el horario existente
        if($horario_delete->horario!=null){
            $rute_horario=public_path().'\horarios_c_docente\\'.$horario_delete->horario;
            File::delete( $rute_horario);
        }
        //guardamos el nuevo horario
        $horario = $time.''.rand(11111,99999).'horario_'.$carreras->nombre.".".$request['horario']->getClientOriginalExtension();
        $destinationPath = public_path().'/horarios_c_docente';
        $file_save = $request->file('horario');
        $file_save->move($destinationPath,$horario);

    }else{
        $horario=$horario_delete->horario;
    }

    DB::table('archivo_horarios')->where('id',$request["id_horarioE"])->update([

'usuario_h'=>Auth::user()->name,
'horario'=>$horario,
'fecha'=>date("Y-m-d"),

    ]);
    return redirect()->back()->with(['message' => 'Horario Editado con exito', 'color' => 'success','tipo' => 'agregado']);
}

public function guardar_datos_pdf(Request $request){
    date_default_timezone_set('America/Mexico_City');
    $verificando=DB::table("datos_pdf")->where("id_carrera",Auth::user()->carrera_tesoem)->first();

    if($verificando==null){
        DB::table("datos_pdf")->insert([
            "id_user" => Auth::user()->id,
            "id_carrera" => Auth::user()->carrera_tesoem,
            "j_division" => $request["j_division"],
            "sexo_j_division" => $request["sexo_j_division"],
            "p_academia" => $request["p_academia"],
            "sexo_p_academia" => $request["sexo_p_academia"],
            "s_academia" => $request["s_academia"],
            "sexo_s_academia" => $request["sexo_s_academia"],
            "j_control_escolar" => $request["j_control_escolar"],
            "sexo_j_control_escolar" => $request["sexo_j_control_escolar"],
            "texto_superior" => $request["texto_superior"],
            "fecha" => date("Y-m-d")
        ]);
        return redirect()->back()->with(['message' => 'Datos de los formatos se agregaron con exito', 'color' => 'success','tipo' => 'agregado']);
    }else{
        DB::table("datos_pdf")->where("id_carrera",Auth::user()->carrera_tesoem)->update([
            "id_user" => Auth::user()->id,
            "id_carrera" => Auth::user()->carrera_tesoem,
            "j_division" => $request["j_division"],
            "sexo_j_division" => $request["sexo_j_division"],
            "p_academia" => $request["p_academia"],
            "sexo_p_academia" => $request["sexo_p_academia"],
            "s_academia" => $request["s_academia"],
            "sexo_s_academia" => $request["sexo_s_academia"],
            "j_control_escolar" => $request["j_control_escolar"],
            "sexo_j_control_escolar" => $request["sexo_j_control_escolar"],
            "texto_superior" => $request["texto_superior"],
            "fecha" => date("Y-m-d")
        ]);
        return redirect()->back()->with(['message' => 'Datos de los formatos se actualizaron con exito', 'color' => 'warning','tipo' => 'actualizar']);
    }
}

}
