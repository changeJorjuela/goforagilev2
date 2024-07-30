<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\GoForAgileOkrs;
use Illuminate\Support\Facades\Validator;

class OkrController extends Controller
{
    public function AdministrarIniciativa(Request $request)
    {
        $url = OkrController::FindUrl();

        $validator = Validator::make($request->all(), [
            'descripcion_ini' => 'required',
            'fecha_entrega_ini' => 'required',
            'meta_ini' => 'required',
            'tendencia_ini' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::to($request->pagina_ini)->withErrors($validator)->withInput();
        } else {
            $id = $request->id_iniciativa;
            // dd($id);
            if ($id == null || $id == 0) {
                $crearIniciativa = GoForAgileOkrs::CrearIniciativa(Session::get('id_empresa'), Session::get('id_user'), $request);
                if ($crearIniciativa) {
                    $verrors = 'Se creo la iniciativa ' . $request->descripcion_ini . ' con éxito.';
                    return Redirect::to($request->pagina_ini)->with('mensaje', $verrors);
                } else {
                    $verrors = array();
                    array_push($verrors, 'Hubo un problema al crear la iniciativa');
                    return Redirect::to($request->pagina_ini)->withErrors(['errors' => $verrors])->withInput();
                }
            } else {
                $actualizarIniciativa = GoForAgileOkrs::ActualizarIniciativa(Session::get('id_empresa'), Session::get('id_user'), $request);
                if($actualizarIniciativa){
                    $verrors = 'Se actualizo la iniciativa ' . $request->descripcion_ini . ' con éxito.';
                    return Redirect::to($request->pagina_ini)->with('mensaje', $verrors);
                }else{
                    $verrors = array();
                    array_push($verrors, 'Hubo un problema al actualizar la iniciativa');
                    return Redirect::to($request->pagina_ini)->withErrors(['errors' => $verrors])->withInput();
                }
            }
        }
    }

    public function AdministrarKR(Request $request){
        $validator = Validator::make($request->all(), [
            'descripcion_kr' => 'required',
            'fecha_entrega_kr' => 'required',
            'fecha_inicia_kr' => 'required',
            'meta_kr' => 'required',            
            'periodo_kr' => 'required',
            'medicion_kr' => 'required',
            'tendencia_kr' => 'required'
        ]);
        // dd($request);
        if ($validator->fails()) {
            return Redirect::to($request->pagina_kr)->withErrors($validator)->withInput();
        } else {
            $id = $request->id_resultado;
            if($request->fecha_entrega_kr < $request->fecha_inicia_kr){
                $verrors = array();
                    array_push($verrors, 'La fecha de entrega no puede ser menor a la fecha de inicio');
                    return Redirect::to($request->pagina_kr)->withErrors(['errors' => $verrors])->withInput();
            }else{
                if ($id == null || $id == 0) {
                    // $crearIniciativa = GoForAgileOkrs::CrearIniciativa(Session::get('id_empresa'), Session::get('id_user'), $request);
                    // if ($crearIniciativa) {
                    //     $verrors = 'Se creo la iniciativa ' . $request->descripcion_ini . ' con éxito.';
                    //     return Redirect::to($request->pagina_ini)->with('mensaje', $verrors);
                    // } else {
                    //     $verrors = array();
                    //     array_push($verrors, 'Hubo un problema al crear la iniciativa');
                    //     return Redirect::to($request->pagina_ini)->withErrors(['errors' => $verrors])->withInput();
                    // }
                }else{
                    $actualizarKr = GoForAgileOkrs::ActualizarKr(Session::get('id_empresa'), Session::get('id_user'), $request);
                    if($actualizarKr){
                        $verrors = 'Se actualizo el Kr ' . $request->descripcion_kr . ' con éxito.';
                        return Redirect::to($request->pagina_kr)->with('mensaje', $verrors);
                    }else{
                        $verrors = array();
                        array_push($verrors, 'Hubo un problema al actualizar el Kr');
                        return Redirect::to($request->pagina_kr)->withErrors(['errors' => $verrors])->withInput();
                    }
                }
            }
        }
    }

    public static function FindUrl()
    {
        $RolUser = (int)Session::get('role_plataforma');
        switch ($RolUser) {
            case 1:
                $url = 'administrador/';
                break;
            case 2:
                return Redirect::to('lider/home');
                break;
            case 3:
                return Redirect::to('colaborador/home');
                break;
            default:
                return Redirect::to('/');
                break;
        }
        return $url;
    }
}
