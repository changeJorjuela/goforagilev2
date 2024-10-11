<?php

namespace App\Http\Controllers\Lider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LiderController extends Controller
{
    /**
     * Funcion que dirige al dashboard del lider
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 11/10/2024
     * @version 1.0
     */
    public function Home()
    {
        Session::put('NombreRol',strtoupper('Lider'));
        if(Session::get('id_rol') == 1){
            Session::put('role_plataforma',2);
        }
        return view('reportes.consolidadoEquipo');
    }
}
