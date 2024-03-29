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

use App\Http\Controllers\CatalogosController;

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
    Route::get('/Documentos', [DocumentsController::class,'view_documents'])->name('view_documents');
    Route::get('/Materias', [MateriasController::class,'view_materias'])->name('view_materias');
    Route::get('/Formatos', [FormatosController::class,'view_formatos'])->name('view_formatos');
    Route::get('/Horarios', [HorarioController::class,'view_horario'])->name('view_horario');
});

Route::group(['middleware' => ['auth', 'super']], function () {

    Route::get('/view_cat_instituciones',[CatalogosController::class,'view_cat_instituciones'])->name('view_cat_instituciones');
    Route::get('/view_cat_carreras',[CatalogosController::class,'view_cat_carreras'])->name('view_cat_carreras');

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
Route::get('/vista_correo', [UserConfigController::class,'vista_correo'])->name('vista_correo');
//documents

Route::post('/save_documents', [DocumentsController::class,'save_documents'])->name('save_documents');
Route::post('/save_documents_b', [DocumentsController::class,'save_documents_b'])->name('save_documents_b');
Route::post('/update_documents', [DocumentsController::class,'update_documents'])->name('update_documents');


//materias

Route::post('/save_form_institucion', [MateriasController::class,'guardar_institucion'])->name('guardar_institucion');
Route::post('/save_form_carrera', [MateriasController::class,'guardar_carrera'])->name('guardar_carrera');
Route::get('/consulta_instituciones', [MateriasController::class,'consulta_instituciones'])->name('consulta_instituciones');
Route::get('/consulta_carreras/{id}', [MateriasController::class,'consulta_carreras'])->name('consulta_carreras');
Route::get('/consulta_existencia_materias/{id_institucion}/{id_carrera}/{numero_semestre}', [MateriasController::class,'consulta_existencia_materias'])->name('consulta_existencia_materias');
Route::post('/save_materias', [MateriasController::class,'guardar_materias'])->name('guardar_materias');
Route::post('/save_calificaciones', [MateriasController::class,'guardar_calificaciones'])->name('guardar_calificaciones');
Route::post('/save_calificaciones_b', [MateriasController::class,'guardar_calificaciones_b'])->name('guardar_calificaciones_b');

//formatos

Route::get('/ANEXO_VI', [FormatosController::class,'pdf_anexo_6'])->name('pdf_anexo_6');
Route::get('/ANEXO_VII', [FormatosController::class,'pdf_anexo_7'])->name('pdf_anexo_7');
Route::get('/CONVALIDACION', [FormatosController::class,'pdf_convalidacion'])->name('pdf_convalidacion');

//horario
Route::get('/materias_c_alumno', [HorarioController::class,'materias_convalidacion_alumno'])->name('materias_convalidacion_alumno');
Route::post('/save_form_horario', [HorarioController::class,'guardar_horario'])->name('guardar_horario');
Route::get('/EQV', [HorarioController::class,'pdf_eqv'])->name('pdf_eqv');
Route::get('/materias_horario', [HorarioController::class,'materias_horario'])->name('materias_horario');
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

//catalogo de materia horario
Route::post('/save_horario',[AMateriasController::class,'guardar_horario'])->name('save_horario');
Route::post('/update_horario',[AMateriasController::class,'editar_horario'])->name('update_horario');
Route::post('/agregar_datos_pdf',[AMateriasController::class,'guardar_datos_pdf'])->name('guardar_datos_pdf');

//validaciones

Route::get('/AValidaciones',[AValidacionesController::class,'view_validacion'])->name('validacion_view');
Route::get("/AMaterias_cursadas/{id}",[AValidacionesController::class,'materias_cursadas'])->name('materias_cursadas');
Route::get("/AMaterias_admin",[AValidacionesController::class,'consuta_materias_admin'])->name('consuta_materias_admin');
Route::post("/Asave_form_datos_alumno_up",[AValidacionesController::class,'actualizar_datos_alumno'])->name('actualizar_datos_alumno');
Route::post("/Asave_form_validacion",[AValidacionesController::class,'guardar_validacion'])->name('guardar_validacion');
Route::get("/Amaterias_recuerdo/{clave_1}/{clave_2}",[AValidacionesController::class,'recordar_validacion'])->name('recordar_validacion');
Route::get("/AValidacionesJax/{page?}",[AValidacionesController::class,'view_validacionJax'])->name('AValidacionesJax');

//Cuentas
Route::get('/ACuentasJax/{page?}',[ACuentasController::class,'view_cuentasJax'])->name('cuentas_viewJax');
Route::get('/search_user/{id}',[ACuentasController::class,'user_modal'])->name('search_user');
Route::post('/cambios_user',[ACuentasController::class,'editar_user'])->name('cambios_user');
Route::post('/delete_user',[ACuentasController::class,'eliminar_user'])->name('delete_user');
Route::post('/nuevo_user',[ACuentasController::class,'save_user'])->name('nuevo_user');
Route::post('/reinicio_alumno',[ACuentasController::class,'reinicio_alumno'])->name('reinicio_alumno');
Route::post('/asignar_folio_alumno',[ACuentasController::class,'asignar_folio'])->name('asignar_folio');

//catalogo de instituciones

Route::get('/view_cat_institucionesJax/{page?}',[CatalogosController::class,'view_cat_institucionesJax'])->name('view_cat_institucionesJax');
Route::post('/save_instituciones',[CatalogosController::class,'save_instituciones'])->name('save_instituciones');
Route::get('/search_institucion/{id}',[CatalogosController::class,'institucional_modal'])->name('search_institucion');
Route::post('/update_instituciones',[CatalogosController::class,'update_instituciones'])->name('update_instituciones');
Route::post('/delete_instituciones',[CatalogosController::class,'delete_instituciones'])->name('delete_instituciones');

//catalogo de materias

Route::get('/view_cat_carrerasJax/{page?}',[CatalogosController::class,'view_cat_carrerasJax'])->name('view_cat_carrerasJax');
Route::post('/save_carreras',[CatalogosController::class,'save_carreras'])->name('save_carreras');
Route::get('/search_carrera/{id}',[CatalogosController::class,'carrera_modal'])->name('search_carrera');
Route::post('/update_carrera',[CatalogosController::class,'update_carrera'])->name('update_carrera');
Route::post('/delete_carrera',[CatalogosController::class,'delete_carrera'])->name('delete_carrera');
