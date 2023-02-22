<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class CatalogosController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

public function view_cat_instituciones(){
    if(Auth::user()->tipo_user==1){
        return redirect("/redirects");
    }
return view('viewAdmin.cat_instituciones');
}

public function view_cat_institucionesJax(){
    $escuelas=DB::table('instituciones')->select("*")->paginate(10);

    return view('viewAdmin.cat_institucionesJax',compact('escuelas'));
    }

public function save_instituciones(Request $request){
    if($request->ajax()){

        date_default_timezone_set('America/Mexico_City');
        DB::table('instituciones')->insert([
            'nombre'=>$request["escuela"],
            'fecha'=>date("Y-m-d"),
        ]);

        if (isset($request["escuelaD"])) {
            for($j= 0; $j < count($request["escuelaD"]); $j++){

                try {
                    DB::table('instituciones')->insert([
                        'nombre'=>$request["escuelaD"][$j],
                        'fecha'=>date("Y-m-d"),
                    ]);
                } catch (\Exception $e) {
                    return json_encode([]);
                                            }

            }
        }

        return response()->json([]);
    }
}

public function institucional_modal($id){

$escuela=DB::table('instituciones')->where('id',$id)->first();

    return json_encode($escuela);
}

public function update_instituciones(Request $request){
    if($request->ajax()){
        DB::table('instituciones')->where('id',$request["id_insti"])->update([
            'nombre'=>$request["escuela"],
            'fecha'=>date("Y-m-d"),
        ]);


        return response()->json([]);
    }
}

public function delete_instituciones(Request $request){
    if($request->ajax()){
        DB::table('instituciones')->where('id',$request["id_insti"])->delete();

    return response()->json([]);
    }
}

 //catalogo de carreras

public function view_cat_carreras(){
    if(Auth::user()->tipo_user==1){
        return redirect("/redirects");
    }
    $escuelas=DB::table('instituciones')->select("*")->get();
    return view('viewAdmin.cat_carreras',compact("escuelas"));
}

public function view_cat_carrerasJax(){
    $escuelas=DB::table('instituciones')->select("*")->get();
    $carreras=DB::table('carreras')->select("*")->paginate(10);

    return view('viewAdmin.cat_carrerasJax',compact("escuelas","carreras"));
}

public function save_carreras(Request $request){
    if($request->ajax()){

        date_default_timezone_set('America/Mexico_City');
        DB::table('carreras')->insert([
            'id_institucion'=>$request["escuela"],
            'nombre'=>$request["carrera"],
            'fecha'=>date("Y-m-d"),
            'clave'=>$request["clave"],
        ]);

        if (isset($request["carreraD"])) {
            for($j= 0; $j < count($request["carreraD"]); $j++){

                try {
                    DB::table('carreras')->insert([
                        'id_institucion'=>$request["escuelaD"][$j],
                        'nombre'=>$request["carreraD"][$j],
                        'fecha'=>date("Y-m-d"),
                        'clave'=>$request["claveD"][$j],
                    ]);
                } catch (\Exception $e) {
                    return json_encode([]);
                 }
            }
        }

        return response()->json([]);
    }
}

public function carrera_modal($id){
$carreras=DB::table('carreras')->where('id',$id)->first();
$escuelas=DB::table('instituciones')->where('id',$carreras->id_institucion)->first();
$escuelas2=DB::table('instituciones')->select('*')->get();

    return json_encode([$carreras,$escuelas,$escuelas2]);
}

public function update_carrera(Request $request){
    if($request->ajax()){

date_default_timezone_set('America/Mexico_City');
DB::table('carreras')->where('id',$request["id_carre"])->update([
    'id_institucion'=>$request["escuela"],
    'nombre'=>$request["carrera"],
    'fecha'=>date("Y-m-d"),
    'clave'=>$request["clave"],
]);

        return response()->json([]);
    }
}

public function delete_carrera(Request $request){
    if($request->ajax()){
        DB::table('carreras')->where('id',$request["id_carre"])->delete();
        return response()->json([]);
    }
}

}
