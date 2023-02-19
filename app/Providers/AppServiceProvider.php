<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\pagination\paginator;
use Illuminate\Support\Facades\Gate;
use DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Gate::define('alumnos', function ($user) {
            if ($user->tipo_user === 3) {
                return true;
            }
            return false;
        });
        Gate::define('alumnos_m', function ($user) {
            if ($user->tipo_user === 3) {
                $ver_etapa=DB::table("procesos_alumno")->where("id",$user->id_proceso_activo)->first();
                if ($ver_etapa==null) {
                    return false;
                }
                if($ver_etapa->etapa>=2){
                    return true;
                }else{
                    return false;
                }
                
            }
            return false;
        });
        Gate::define('alumnos_f_h', function ($user) {
            if ($user->tipo_user === 3) {
                $ver_etapa=DB::table("procesos_alumno")->where("id",$user->id_proceso_activo)->first();
                if ($ver_etapa==null) {
                    return false;
                }
                if($ver_etapa->etapa>=3){
                    return true;
                }else{
                    return false;
                }
            }
            return false;
        });

        Gate::define('docentes', function ($user) {
            if ($user->tipo_user === 2) {
                return true;
            }
            return false;
        });

        Gate::define('administrador-docente', function ($user) {
            if ($user->tipo_user === 2 or $user->tipo_user === 1) {
                return true;
            }
            return false;
        });

        Gate::define('docente-alumno', function ($user) {
            if ($user->tipo_user === 3 or $user->tipo_user === 2) {
                return true;
            }
            return false;
        });

    }
}
