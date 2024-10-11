<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Models\GoForAgileOkrs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\GoForAgileAdmin;

class AdministradorController extends Controller
{
    /**
     * Funcion que dirige al dashboard del administrador
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 11/10/2024
     * @version 1.0
     */
    public function Home()
    {
        Session::put('NombreRol', strtoupper('Administrador'));
        if (Session::get('id_rol') == 1) {
            Session::put('role_plataforma', 1);
        }
        return view('reportes.consolidadoGeneral');
    }

    /**
     * Funcion que dirige al módulo de áreas
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 11/10/2024
     * @version 1.0
     */
    public function Areas()
    {
        $ListarAreas = GoForAgileAdmin::ListarAreas((int)Session::get('id_empresa'));
        $Areas = array();
        $cont = $num = 1;
        foreach ($ListarAreas as $value) {
            $Areas[$cont]['cont']           = $num++;
            $Areas[$cont]['id']             = (int)$value->id;
            $Areas[$cont]['nombre_area']    = $value->nombre;
            $Areas[$cont]['padre']          = (int)$value->padre;
            $Areas[$cont]['jerarquia']      = $value->jerarquia;
            $Areas[$cont]['id_empresa']     = $value->id_empresa;
            $Areas[$cont]['estado_activo']  = (int)$value->estado;
            $State  = (int)$value->estado;
            if ($State === 1) {
                $Areas[$cont]['estado']   = 'ACTIVO';
                $Areas[$cont]['label']    = 'text-success';
            } else {
                $Areas[$cont]['estado']   = 'INACTIVO';
                $Areas[$cont]['label']    = 'text-danger';
            }
            $cont++;
        }
        $ListarAreasPadre = GoForAgileAdmin::ListarAreasActivo((int)Session::get('id_empresa'));
        $AreasPadre = array();
        $AreasPadre[''] = 'Seleccione Padre..';
        foreach ($ListarAreasPadre as $row) {
            $AreasPadre[$row->id] = $row->nombre;
        }
        $Estado = array();
        $Estado[''] = 'Seleccione:';
        $Estado[1]  = 'Activo';
        $Estado[2]  = 'Inactivo';
        return view('administracion/areas', ['Estado' => $Estado, 'Areas' => $Areas, 'AreasPadre' => $AreasPadre]);

    }

    /**
     * Funcion que dirige al módulo de cargue masivo de colaboradores
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 11/10/2024
     * @version 1.0
     */
    public function CargueMasivo()
    {
        return view('administracion/cargueMasivo');
    }

    /**
     * Funcion que dirige al módulo de cargos
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 11/10/2024
     * @version 1.0
     */
    public function Cargos()
    {
        $ListarCargos = GoForAgileAdmin::ListarCargos((int)Session::get('id_empresa'));
        $Cargos = array();
        $cont = $num = 1;
        foreach ($ListarCargos as $value) {
            $Cargos[$cont]['cont']              = $num++;
            $Cargos[$cont]['id']                = (int)$value->id;
            $Cargos[$cont]['nombre_cargo']      = $value->nombre;
            $Cargos[$cont]['nivel_jerarquico']  = $value->nivel_jerarquico;
            $Cargos[$cont]['id_area']           = $value->id_area;
            $Cargos[$cont]['id_empresa']        = $value->id_empresa;
            $Cargos[$cont]['estado_activo']     = (int)$value->estado;
            $State  = (int)$value->estado;
            if ($State === 1) {
                $Cargos[$cont]['estado']   = 'ACTIVO';
                $Cargos[$cont]['label']    = 'text-success';
            } else {
                $Cargos[$cont]['estado']   = 'INACTIVO';
                $Cargos[$cont]['label']    = 'text-danger';
            }
            $cont++;
        }
        $ListarAreas = GoForAgileAdmin::ListarAreasActivo((int)Session::get('id_empresa'));
        $Areas = array();
        $Areas[''] = 'Seleccione Área..';
        foreach ($ListarAreas as $row) {
            $Areas[$row->id] = $row->nombre;
        }
        $Estado = array();
        $Estado[''] = 'Seleccione:';
        $Estado[1]  = 'Activo';
        $Estado[2]  = 'Inactivo';
        return view('administracion/Cargos', ['Estado' => $Estado, 'Cargos' => $Cargos, 'Areas' => $Areas]);
    }
}
