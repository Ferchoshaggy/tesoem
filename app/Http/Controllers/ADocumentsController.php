<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ADocumentsController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function view_documen(){
return view('viewAdmin.documents');
    }

}
