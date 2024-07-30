<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class ColaboradorMiddleware
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
            if ($rol === 3)
                return $next($request);
            if($rol === 2)
                return redirect('lider/home');
            if($rol === 1)
                return redirect('admin/home');
            return redirect('/');
        }else{
            return redirect('/');
        }
    }
}
