<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class IsDocente
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
        if(Auth::user() && Auth::user()->tipo_user===2){
            return $next($request);
        }else{
            if(Auth::user()->tipo_user===1){
                return redirect('/ACuentas')->with('error','No eres Docente para acceder a esta pagina');
            }else if(Auth::user()->tipo_user===3){
                return redirect('/dashboard')->with('error','No eres Docente para acceder a esta pagina');
            }

    }

    }
}
