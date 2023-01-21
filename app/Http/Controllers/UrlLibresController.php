<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class UrlLibresController extends Controller
{
    public function carreras_tesoem(){
        $carreras=DB::table('carreras')->select("*")->get();
        return json_encode($carreras);
    }
}
