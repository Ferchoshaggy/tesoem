<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\pagination\paginator;
use Illuminate\Support\Facades\Gate;
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

    }
}
