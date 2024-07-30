<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class LiderMiddleware
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
            if ($rol === 2 || (int)Session::get('role_plataforma') == 1)
                return $next($request);
            if($rol === 1)
                // return redirect('admin/home');
                return $next($request);
            if($rol === 3)
                return redirect('colaborador/home');
            return redirect('/');
        }else{
            return redirect('/');
        }
    }
}
