<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class IsAlumno
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user() && Auth::user()->tipo_user===3){
            return $next($request);
        }else{
            if(Auth::user()->tipo_user===1){
                return redirect('/ACuentas')->with('error','No eres alumno para acceder a esta pagina');
            }else if(Auth::user()->tipo_user===2){
                return redirect('/ADocumentos')->with('error','No eres alumno para acceder a esta pagina');
            }


    }
    }
}
