<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AdministradorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $idUsuario = Session::get('id_user');
        if($idUsuario){
            $rol = (int)Session::get('id_rol');
            if($rol === 1 || (int)Session::get('role_plataforma') == 2)
                return $next($request);
            if($rol === 2)
                return redirect('lider/home');
            if($rol === 3)
                return redirect('colaborador/home');
            return redirect('/');
        }else{
            return redirect('/');
        }
    }
}
