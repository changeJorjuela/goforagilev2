<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\GoForAgileAdmin;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    /**
     * Creación Areas
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 11/10/2024
     * @version 1.0
     * @param $request
     * @return alert message
     */
    public function CrearArea(Request $request)
    {
        $url = AdminController::FindUrl();
        date_default_timezone_set('America/Bogota');
        $validator = Validator::make($request->all(), [
            'nombre_area' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::to($url . 'areas')->withErrors($validator)->withInput();
        } else {
            $nombreArea = $request->nombre_area;
            $padre = $request->padre;
            $jerarquia = $request->jerarquia;
            $BuscarArea = GoForAgileAdmin::BuscarNombreArea($nombreArea, (int)Session::get('id_empresa'));
            if ($BuscarArea) {
                $verrors = array();
                array_push($verrors, 'Nombre de area ya existe');
                return Redirect::to($url . 'areas')->withErrors(['errors' => $verrors])->withInput();
            } else {
                $CrearArea = GoForAgileAdmin::CrearArea($nombreArea, $padre, $jerarquia, (int)Session::get('id_empresa'),(int)Session::get('id_user'));
                if ($CrearArea) {
                    $verrors = 'Se creo el área ' . $nombreArea . ' con éxito.';
                    return Redirect::to($url . 'areas')->with('mensaje', $verrors);
                } else {
                    $verrors = array();
                    array_push($verrors, 'Hubo un problema al crear el area');
                    return Redirect::to($url . 'areas')->withErrors(['errors' => $verrors])->withInput();
                }
            }
        }
    }

    /**
     * Actualización Areas
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 11/10/2024
     * @version 1.0
     * @param $request
     * @return alert message
     */

    public function ActualizarArea(Request $request)
    {
        $url = AdminController::FindUrl();

        $validator = Validator::make($request->all(), [
            'nombre_area_upd' => 'required',
            'estado_upd' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::to($url . 'areas')->withErrors($validator)->withInput();
        } else {
            $nombreArea = $request->nombre_area_upd;
            $padre = $request->padre_upd;
            $jerarquia = $request->jerarquia_upd;
            $estado = $request->estado_upd;
            $idArea = $request->id_area;
            $BuscarArea = GoForAgileAdmin::BuscarNombreAreaUpd($nombreArea, $idArea, Session::get('id_empresa'));
            if ($BuscarArea) {
                $verrors = array();
                array_push($verrors, 'Nombre de area ya existe');
                return Redirect::to($url . 'areas')->withErrors(['errors' => $verrors])->withInput();
            } else {
                $ActualizarArea = GoForAgileAdmin::ActualizarArea($nombreArea, $padre, $jerarquia, $estado, $idArea,(int)Session::get('id_empresa'),(int)Session::get('id_user'));
                if ($ActualizarArea) {
                    $verrors = 'Se actualizo el área ' . $nombreArea . ' con éxito.';
                    return Redirect::to($url . 'areas')->with('mensaje', $verrors);
                } else {
                    $verrors = array();
                    array_push($verrors, 'Hubo un problema al actualizar el area');
                    return Redirect::to($url . 'areas')->withErrors(['errors' => $verrors])->withInput();
                }
            }
        }
    }

    /**
     * Eliminar Area
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 11/10/2024
     * @version 1.0
     * @param $request
     * @return alert message
     */

    public function EliminarArea(Request $request)
    {
        $url = AdminController::FindUrl();
        $idArea = $request->id_Area_delete;

        $buscarArea = GoForAgileAdmin::BuscarNombreAreaId($idArea);
        foreach ($buscarArea as $value) {
            $nombreArea = $value->nombre;
        }

        $eliminar = GoForAgileAdmin::EliminarArea($idArea, Session::get('id_empresa'), Session::get('id_user'));
        if ($eliminar) {
            $verrors = 'Se elimino el Area ' . $nombreArea . ' con éxito.';
            return Redirect::to($url . 'areas')->with('mensaje', $verrors);
        } else {
            $verrors = array();
            array_push($verrors, 'Hubo un problema al eliminar el Area');
            return Redirect::to($url . 'areas')->withErrors(['errors' => $verrors])->withInput();
        }
    }

    /**
     * Creación Cargos
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 11/10/2024
     * @version 1.0
     * @param $request
     * @return alert message
     */
    public function CrearCargo(Request $request)
    {
        $url = AdminController::FindUrl();
        date_default_timezone_set('America/Bogota');
        $validator = Validator::make($request->all(), [
            'nombre_cargo' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::to($url . 'cargos')->withErrors($validator)->withInput();
        } else {
            $nombreCargo = $request->nombre_cargo;
            $area = $request->area;
            $nivelJerarquico = $request->nivel_jerarquico;
            $BuscarCargo = GoForAgileAdmin::BuscarNombreCargo($nombreCargo, (int)Session::get('id_empresa'));
            if ($BuscarCargo) {
                $verrors = array();
                array_push($verrors, 'Nombre de cargo ya existe');
                return Redirect::to($url . 'cargos')->withErrors(['errors' => $verrors])->withInput();
            } else {
                $CrearArea = GoForAgileAdmin::CrearCargo($nombreCargo, $area, $nivelJerarquico, (int)Session::get('id_empresa'),(int)Session::get('id_user'));
                if ($CrearArea) {
                    $verrors = 'Se creo el cargo ' . $nombreCargo . ' con éxito.';
                    return Redirect::to($url . 'cargos')->with('mensaje', $verrors);
                } else {
                    $verrors = array();
                    array_push($verrors, 'Hubo un problema al crear el cargo');
                    return Redirect::to($url . 'cargos')->withErrors(['errors' => $verrors])->withInput();
                }
            }
        }
    }

    /**
     * Actualización Cargos
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 11/10/2024
     * @version 1.0
     * @param $request
     * @return alert message
     */

    public function ActualizarCargo(Request $request)
    {
        $url = AdminController::FindUrl();

        $validator = Validator::make($request->all(), [
            'nombre_cargo_upd' => 'required',
            'estado_upd' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::to($url . 'cargos')->withErrors($validator)->withInput();
        } else {
            $nombreCargo = $request->nombre_cargo_upd;
            $area = $request->area_upd;
            $nivelJerarquico = $request->nivel_jerarquico_upd;
            $estado = $request->estado_upd;
            $idCargo = $request->id_cargo;
            $BuscarCargo = GoForAgileAdmin::BuscarNombreCargoUpd($nombreCargo, $idCargo, Session::get('id_empresa'));
            if ($BuscarCargo) {
                $verrors = array();
                array_push($verrors, 'Nombre de cargo ya existe');
                return Redirect::to($url . 'cargos')->withErrors(['errors' => $verrors])->withInput();
            } else {
                $ActualizarArea = GoForAgileAdmin::ActualizarCargo($nombreCargo, $area, $nivelJerarquico, $estado, $idCargo,(int)Session::get('id_empresa'),(int)Session::get('id_user'));
                if ($ActualizarArea) {
                    $verrors = 'Se actualizo el cargo ' . $nombreCargo . ' con éxito.';
                    return Redirect::to($url . 'cargos')->with('mensaje', $verrors);
                } else {
                    $verrors = array();
                    array_push($verrors, 'Hubo un problema al actualizar el cargo');
                    return Redirect::to($url . 'cargos')->withErrors(['errors' => $verrors])->withInput();
                }
            }
        }
    }

    /**
     * Eliminar Cargo
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 11/10/2024
     * @version 1.0
     * @param $request
     * @return alert message
     */

    public function EliminarCargo(Request $request)
    {
        $url = AdminController::FindUrl();
        $idCargo = $request->id_cargo_delete;

        $buscarCargo = GoForAgileAdmin::BuscarNombreCargoId($idCargo);
        foreach ($buscarCargo as $value) {
            $nombreCargo = $value->nombre;
        }

        $eliminar = GoForAgileAdmin::EliminarCargo($idCargo, Session::get('id_empresa'), Session::get('id_user'));
        if ($eliminar) {
            $verrors = 'Se elimino el cargo ' . $nombreCargo . ' con éxito.';
            return Redirect::to($url . 'cargos')->with('mensaje', $verrors);
        } else {
            $verrors = array();
            array_push($verrors, 'Hubo un problema al eliminar el cargo');
            return Redirect::to($url . 'cargos')->withErrors(['errors' => $verrors])->withInput();
        }
    }

    /**
     * Busca la url segun rol de usuario, a la cual debe devolver la respuesta
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 11/10/2024
     * @version 1.0
     * @return $url
     */

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
