<?php

namespace App\Http\Controllers\Lider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LiderController extends Controller
{
    public function Home()
    {
        Session::put('NombreRol',strtoupper('Lider'));
        if(Session::get('id_rol') == 1){
            Session::put('role_plataforma',2);
        }
        // dd(Session::all());
        return view('reportes.consolidadoEquipo');
    }
}
