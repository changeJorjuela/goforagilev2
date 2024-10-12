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
     * Funcion que dirige al módulo de auditoria de la gestión de GFA a nivel de administración de la empresa
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 11/10/2024
     * @version 1.0
     */
    public function AuditoriaGestion()
    {
        $ListarAuditoria = GoForAgileAdmin::ListarAuditoria((int)Session::get('id_empresa'));
        $Auditoria = array();
        $cont = $num = 1;
        $nombreArea = $nombreVp = "";
        foreach ($ListarAuditoria as $value) {
            $usuario = GoForAgileAdmin::EmpleadoId($value->id_empleado);
            foreach ($usuario as $user) {
                $nombreUsuario = $user->nombre;
                $idVp = $user->unidad_corporativa;
                $idArea = $user->area;
            }
            $areas = GoForAgileAdmin::BuscarNombreAreaId($idArea);
            foreach ($areas as $area) {
                $nombreArea = $area->nombre;
            }
            $vicepresidencias = GoForAgileAdmin::BuscarNombreVpId($idVp);
            foreach ($vicepresidencias as $vp) {
                $nombreVp = $vp->nombre;
            }
            $Auditoria[$cont]['cont']           = $num++;
            $Auditoria[$cont]['id']             = (int)$value->id;
            $Auditoria[$cont]['usuario']        = $nombreUsuario;
            $Auditoria[$cont]['vp']             = $nombreVp;
            $Auditoria[$cont]['area']           = $nombreArea;
            $Auditoria[$cont]['accion']         = $value->accion;
            $Auditoria[$cont]['descripcion']    = $value->descripcion;
            $Auditoria[$cont]['modulo']         = $value->modulo;
            $Auditoria[$cont]['fecha']          = $value->created_at;

            switch ($value->accion) {
                case 'CREAR':
                    $Auditoria[$cont]['label']  = 'success';
                    break;
                case 'ACTUALIZAR':
                    $Auditoria[$cont]['label']  = 'warning';
                    break;
                case 'ELIMINAR':
                    $Auditoria[$cont]['label']  = 'danger';
                    break;
                default:
                    $Auditoria[$cont]['label']  = 'dark';
                    break;
            }
            $cont++;
        }

        return view('administracion/auditoriaGestion', ['Auditoria' => $Auditoria]);
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
        return view('administracion/cargos', ['Estado' => $Estado, 'Cargos' => $Cargos, 'Areas' => $Areas]);
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
     * Funcion que dirige al módulo de colaboradores
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 11/10/2024
     * @version 1.0
     */
    public function Colaboradores()
    {
        $ListarColaboradores = GoForAgileAdmin::ListarEmpleados((int)Session::get('id_empresa'));
        $Colaboradores = array();
        $cont = $num = 1;
        $nombreArea = $nombreCargo = $nombreVp = $nombreUO = $nombreRol = "";
        foreach ($ListarColaboradores as $value) {
            $Colaboradores[$cont]['cont'] = $num++;
            $Colaboradores[$cont]['id'] = (int)$value->id;
            $Colaboradores[$cont]['documento'] = $value->documento;
            $Colaboradores[$cont]['nombre'] = $value->nombre;
            $Colaboradores[$cont]['genero'] = $value->genero;
            $Colaboradores[$cont]['antiguedad_anios'] = (int)$value->antiguedad_anios;
            $Colaboradores[$cont]['antiguedad_meses'] = (int)$value->antiguedad_meses;
            $Colaboradores[$cont]['antiguedad_dias'] = (int)$value->antiguedad_dias;
            $Colaboradores[$cont]['id_cargo'] = (int)$value->id_cargo;
            if ($value->cargo > 0) {
                $Colaboradores[$cont]['id_cargo'] = (int)$value->id_cargo;
                $cargos = GoForAgileAdmin::BuscarNombreCargoId($value->id_cargo);
                foreach ($cargos as $cargo) {
                    $nombreCargo = $cargo->nombre;
                }
            } else {
                $nombreCargo = $value->cargo;
            }
            $Colaboradores[$cont]['nombre_cargo'] = $nombreCargo;

            $Colaboradores[$cont]['correo'] = $value->correo;
            $Colaboradores[$cont]['correo_personal'] = $value->correo_personal;
            $Colaboradores[$cont]['telefono_movil'] = $value->telefono_movil;
            $Colaboradores[$cont]['telefono_fijo'] = $value->telefono_fijo;
            $Colaboradores[$cont]['nivel_jerarquico'] = $value->nivel_jerarquico;
            $Colaboradores[$cont]['compania'] = $value->compania;
            $Colaboradores[$cont]['sucursal'] = $value->sucursal;

            $Colaboradores[$cont]['id_vp'] = (int)$value->unidad_corporativa;
            if ($value->unidad_corporativa > 0) {
                $vps = GoForAgileAdmin::BuscarNombreVpId($value->unidad_corporativa);
                foreach ($vps as $vp) {
                    $nombreVp = $vp->nombre;
                }
            } else {
                $nombreVp = $value->unidad_corporativa;
            }
            $Colaboradores[$cont]['nombre_vp'] = $nombreVp;
            $Colaboradores[$cont]['id_area'] = (int)$value->area;
            if ($value->area > 0) {
                $Colaboradores[$cont]['id_area'] = (int)$value->area;
                $areas = GoForAgileAdmin::BuscarNombreAreaId($value->area);
                foreach ($areas as $area) {
                    $nombreArea = $area->nombre;
                }
            } else {
                $nombreArea = $value->area;
            }
            $Colaboradores[$cont]['nombre_area'] = $nombreArea;
            $Colaboradores[$cont]['unidad_organizativa'] = $value->unidad_organizativa;
            if ($value->unidad_organizativa > 0) {
                $Colaboradores[$cont]['unidad_organizativa'] = $value->unidad_organizativa;
                $unidadO = GoForAgileAdmin::ListarEPId($value->unidad_organizativa);
                if ($unidadO) {
                    foreach ($unidadO as $uo) {
                        $nombreUO = $uo->unidad_organizativa;
                    }
                }
            } else {
                $nombreUO = $value->unidad_organizativa;
            }
            $Colaboradores[$cont]['nombre_unidad_organizativa'] = $nombreUO;

            $Colaboradores[$cont]['id_rol'] = $value->role;
            $roles = GoForAgileAdmin::ListarRolesId($value->role);
            foreach ($roles as $rol) {
                $nombreRol = $rol->nombre;
            }
            $Colaboradores[$cont]['nombre_rol'] = $nombreRol;

            $Colaboradores[$cont]['estado_activo'] = (int)$value->estado;

            $State  = (int)$value->estado;
            if ($State === 1) {
                $Colaboradores[$cont]['estado']   = 'ACTIVO';
                $Colaboradores[$cont]['label']    = 'text-success';
            } else {
                $Colaboradores[$cont]['estado']   = 'INACTIVO';
                $Colaboradores[$cont]['label']    = 'text-danger';
            }

            $Colaboradores[$cont]['unidad_estrategica'] = $value->unidad_estrategica;
            $Colaboradores[$cont]['id_posicion'] = $value->id_posicion;
            $Colaboradores[$cont]['password'] = $value->password;
            $Colaboradores[$cont]['foto'] = $value->foto;
            $Colaboradores[$cont]['foto_tabla'] = '<img loading="lazy" src="../recursos/' . $value->foto . '" class="profile-thumb" title="' . $value->nombre . '" style="width:50px;height:50px;border-radius: 50%;" >';

            $cont++;
        }
        $ListarCargos = GoForAgileAdmin::ListarCargosActivo((int)Session::get('id_empresa'));
        $Cargos = array();
        $Cargos[''] = 'Seleccione CArgo..';
        foreach ($ListarCargos as $row) {
            $Cargos[$row->id] = $row->nombre;
        }
        $ListarPosiciones = GoForAgileAdmin::ListarPosicionesActivo((int)Session::get('id_empresa'));
        $Posiciones = array();
        $Posiciones[''] = 'Seleccione Posición..';
        foreach ($ListarPosiciones as $row) {
            $cargos = GoForAgileAdmin::BuscarNombreCargoId($row->id_cargo);
            foreach ($cargos as $cargo) {
                $nombreCargo = $cargo->nombre;
            }
            $Posiciones[$row->id] = $nombreCargo;
        }
        $ListarAreas = GoForAgileAdmin::ListarAreasActivo((int)Session::get('id_empresa'));
        $Areas = array();
        $Areas[''] = 'Seleccione Área..';
        foreach ($ListarAreas as $row) {
            $Areas[$row->id] = $row->nombre;
        }
        $ListarVp = GoForAgileAdmin::ListarVpActivo((int)Session::get('id_empresa'));
        $Vp = array();
        $Vp[''] = 'Seleccione Vicepresidencia..';
        foreach ($ListarVp as $row) {
            $Vp[$row->id] = $row->nombre;
        }
        $ListarRol = GoForAgileAdmin::ListarRoles();
        $Roles = array();
        $Roles[''] = 'Seleccione Rol..';
        foreach ($ListarRol as $row) {
            $Roles[$row->id] = $row->nombre;
        }
        $ListarNJ = GoForAgileAdmin::ListarNivelJ((int)Session::get('id_empresa'));
        $NivelJ = array();
        $NivelJ[''] = 'Seleccione Nivel Jerárquico..';
        foreach ($ListarNJ as $row) {
            $NivelJ[$row->id] = $row->nombre;
        }
        $Estado = array();
        $Estado[''] = 'Seleccione:';
        $Estado[1]  = 'Activo';
        $Estado[2]  = 'Inactivo';
        $Genero = array();
        $Genero[''] = 'Seleccione:';
        $Genero['Femenino']  = 'Femenino';
        $Genero['Masculino']  = 'Masculino';
        return view('administracion/colaboradores', [
            'Estado' => $Estado,
            'Colaboradores' => $Colaboradores,
            'Areas' => $Areas,
            'Vp' => $Vp,
            'Roles' => $Roles,
            'NivelJ' => $NivelJ,
            'Cargos' => $Cargos,
            'Posiciones' => $Posiciones,
            'Genero' => $Genero
        ]);
    }
}
