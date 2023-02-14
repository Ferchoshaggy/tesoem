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
Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('/ACuentas',[ACuentasController::class,'view_cuentas'])->name('cuentas_view');
});

Route::group(['middleware' => ['auth', 'docente']], function () {

    Route::get('/ADocumentos',[ADocumentsController::class,'view_documen'])->name('Documents_view');
    Route::get('/AMaterias',[AMateriasController::class,'view_materias'])->name('materias_view');
    Route::get('/AValidaciones',[AValidacionesController::class,'view_validacion'])->name('validacion_view');

});

Route::group(['middleware' => ['auth', 'alumno']], function () {
    Route::get('/dashboard', [DocumentsController::class,'view_documents'])->name('view_documents');
    Route::get('/Materias', [MateriasController::class,'view_materias'])->name('view_materias');
    Route::get('/Formatos', [FormatosController::class,'view_formatos'])->name('view_formatos');
    Route::get('/Horarios', [HorarioController::class,'view_horario'])->name('view_horario');
});



//redirect login
Route::get('/redirects',[UserConfigController::class,'index'])->name('index_vista');

//url libres para uso fuera del login
Route::get('/carreras_tesoem', [UrlLibresController::class,'carreras_tesoem'])->name('carreras_tesoem');

//save from new register school and materias
Route::post('/save_form', [SaveFromController::class,'salvar_registro'])->name('salvar_registro');

//usuario config
Route::get('/User_config', [UserConfigController::class,'vista_user_edit'])->name('edit_user');
Route::post('/Actualizar_user', [UserConfigController::class,'user_actualizar'])->name('user_actualizar');

//documents

Route::post('/save_documents', [DocumentsController::class,'save_documents'])->name('save_documents');
Route::post('/update_documents', [DocumentsController::class,'update_documents'])->name('update_documents');

//materias

Route::post('/save_form_institucion', [MateriasController::class,'guardar_institucion'])->name('guardar_institucion');
Route::post('/save_form_carrera', [MateriasController::class,'guardar_carrera'])->name('guardar_carrera');
Route::get('/consulta_instituciones', [MateriasController::class,'consulta_instituciones'])->name('consulta_instituciones');
Route::get('/consulta_carreras/{id}', [MateriasController::class,'consulta_carreras'])->name('consulta_carreras');
Route::get('/consulta_existencia_materias/{id_institucion}/{id_carrera}/{numero_semestre}', [MateriasController::class,'consulta_existencia_materias'])->name('consulta_existencia_materias');
Route::post('/save_materias', [MateriasController::class,'guardar_materias'])->name('guardar_materias');
Route::post('/save_calificaciones', [MateriasController::class,'guardar_calificaciones'])->name('guardar_calificaciones');

//formatos


//horario


//documentos Administrador

Route::get('/ADocumentosJax/{page?}',[ADocumentsController::class,'view_documenJax'])->name('Documents_viewJax');
Route::get('/search_doc/{id}',[ADocumentsController::class,'doc_modal'])->name('search_doc');
Route::post('/HArechazado',[ADocumentsController::class,'rechazadoHA'])->name('HArechazado');
Route::post('/CPrechazado',[ADocumentsController::class,'rechazadoCP'])->name('CPrechazado');
Route::post('/HAaceptado',[ADocumentsController::class,'aceptadoHA'])->name('HAaceptado');
Route::post('/CPaceptado',[ADocumentsController::class,'aceptadoCP'])->name('CPaceptado');
Route::post('/finalizarDoc',[ADocumentsController::class,'Docfinalizar'])->name('finalizarDoc');


//Catalogo de materias

Route::get('/AMateriasJax/{page?}',[AMateriasController::class,'view_materiasJax'])->name('materias_viewJax');
Route::post('/save_catmaterias',[AMateriasController::class,'catmaterias_save'])->name('save_catmaterias');
Route::get('/search_mate/{id}',[AMateriasController::class,'materia_search'])->name('search_mate');
Route::post('/delete_materia',[AMateriasController::class,'materia_eliminar'])->name('delete_materia');
Route::post('/update_materia',[AMateriasController::class,'update_materia'])->name('update_materia');
Route::post('/asignar_materia',[AMateriasController::class,'materia_asignar'])->name('asignar_materia');

//validaciones


//Cuentas
Route::get('/ACuentasJax/{page?}',[ACuentasController::class,'view_cuentasJax'])->name('cuentas_viewJax');
Route::get('/search_user/{id}',[ACuentasController::class,'user_modal'])->name('search_user');
Route::post('/cambios_user',[ACuentasController::class,'editar_user'])->name('cambios_user');
Route::post('/delete_user',[ACuentasController::class,'eliminar_user'])->name('delete_user');
Route::post('/nuevo_user',[ACuentasController::class,'save_user'])->name('nuevo_user');
