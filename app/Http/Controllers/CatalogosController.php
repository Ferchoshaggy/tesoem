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

        return response()->json([]);
    }
}

 //catalogo de carreras

public function view_cat_carreras(){
    return view('viewAdmin.cat_carreras');
}

public function view_cat_carrerasJax(){
    return view('viewAdmin.cat_carrerasJax');
}

}
