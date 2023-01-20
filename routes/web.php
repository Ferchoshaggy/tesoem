<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\MateriasController;
use App\Http\Controllers\SaveFromController;
use App\Http\Controllers\UserConfigController;
use App\Http\Controllers\ADocumentsController;
use App\Http\Controllers\AMateriasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ayuda', function () {
    return view('ayuda');
});

/*
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('vista');
    })->name('dashboard');

});
*/
//save from new register school and materias
Route::post('/save_form', [SaveFromController::class,'salvar_registro'])->name('salvar_registro');

//usuario config
Route::get('/User_config', [UserConfigController::class,'vista_user_edit'])->name('edit_user');
Route::post('/Actualizar_user', [UserConfigController::class,'user_actualizar'])->name('user_actualizar');

//documents
Route::get('/dashboard', [DocumentsController::class,'view_documents'])->name('view_documents');
Route::post('/save_documents', [DocumentsController::class,'save_documents'])->name('save_documents');
Route::post('/update_documents', [DocumentsController::class,'update_documents'])->name('update_documents');

//materias
Route::get('/Materias', [MateriasController::class,'view_materias'])->name('view_materias');

//documentos Administrador
Route::get('/ADocumentos',[ADocumentosController::class,'view_document'])->name('Documents_view');
