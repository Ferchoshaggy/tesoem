<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\MateriasController;
use App\Http\Controllers\SaveFromController;
use App\Http\Controllers\UserConfigController;
use App\Http\Controllers\ADocumentsController;
use App\Http\Controllers\AMateriasController;

use App\Http\Controllers\AValidacionesController;
use App\Http\Controllers\ACuentasController;

use App\Http\Controllers\UrlLibresController;
use App\Http\Controllers\FormatosController;
use App\Http\Controllers\HorarioController;


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

//url libres para uso fuera del login
Route::get('/carreras_tesoem', [UrlLibresController::class,'carreras_tesoem'])->name('carreras_tesoem');

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
Route::post('/save_form_institucion', [MateriasController::class,'guardar_institucion'])->name('guardar_institucion');
Route::post('/save_form_carrera', [MateriasController::class,'guardar_carrera'])->name('guardar_carrera');
Route::get('/consulta_instituciones', [MateriasController::class,'consulta_instituciones'])->name('consulta_instituciones');
Route::get('/consulta_carreras/{id}', [MateriasController::class,'consulta_carreras'])->name('consulta_carreras');
Route::get('/consulta_existencia_materias/{id_institucion}/{id_carrera}/{numero_semestre}', [MateriasController::class,'consulta_existencia_materias'])->name('consulta_existencia_materias');
Route::post('/save_materias', [MateriasController::class,'guardar_materias'])->name('guardar_materias');
Route::post('/save_calificaciones', [MateriasController::class,'guardar_calificaciones'])->name('guardar_calificaciones');

//formatos
Route::get('/Formatos', [FormatosController::class,'view_formatos'])->name('view_formatos');

//horario
Route::get('/Horarios', [HorarioController::class,'view_horario'])->name('view_horario');

//documentos Administrador
Route::get('/ADocumentos',[ADocumentsController::class,'view_documen'])->name('Documents_view');

//Catalogo de materias
Route::get('/AMaterias',[AMateriasController::class,'view_materias'])->name('materias_view');

//validaciones
Route::get('/AValidaciones',[AValidacionesController::class,'view_validacion'])->name('validacion_view');

//Cuentas
Route::get('/ACuentas',[ACuentasController::class,'view_cuentas'])->name('cuentas_view');
