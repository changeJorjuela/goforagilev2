<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\GoForAgileOkrs;
use Illuminate\Support\Facades\Validator;

class OkrController extends Controller
{
    public function AdministrarIniciativa(Request $request){
        $url = OkrController::FindUrl();
        
        $validator = Validator::make($request->all(), [
            'descripcion' => 'required',
            'fecha_entrega' => 'required',
            'meta' => 'required',
            'tendencia' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::to($request->pagina)->withErrors($validator)->withInput();
        }else{
            $id = $request->id_registro;
            // dd($id);
            if($id == null){
                $crearIniciativa = GoForAgileOkrs::CrearIniciativa(Session::get('id_empresa'),Session::get('id_user'),$request);
                $verrors = 'Se creo el área '.$request->descripcion.' con éxito.';
                    return Redirect::to($request->pagina)->with('mensaje', $verrors);
            }else{
                $verrors = array();
                array_push($verrors, 'Hubo un problema al crear el area');
                return Redirect::to($request->pagina)->withErrors(['errors' => $verrors])->withInput();
            }
        }
    }

    public static function FindUrl(){
        $RolUser = (int)Session::get('role_plataforma');
        switch($RolUser){
            case 1: $url = 'administrador/';
                    break;
            case 2: return Redirect::to('lider/home');
                    break;
            case 3: return Redirect::to('colaborador/home');
                    break;
            default: return Redirect::to('/');
                    break;
        }
        return $url;
    }
}
