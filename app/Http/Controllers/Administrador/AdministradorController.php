<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Models\GoForAgileOkrs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\GoForAgileAdmin;
use Intervention\Image\Facades\Image;
use Spatie\ImageOptimizer\OptimizerChainFactory;

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
            if ($idArea) {
                $areas = GoForAgileAdmin::BuscarNombreAreaId($idArea);
                if ($areas) {
                    foreach ($areas as $area) {
                        $nombreArea = $area->nombre;
                    }
                } else {
                    $nombreArea = '';
                }
            } else {
                $nombreArea = '';
            }

            if ($idVp) {
                $vicepresidencias = GoForAgileAdmin::BuscarNombreVpId($idVp);
                if ($vicepresidencias) {
                    foreach ($vicepresidencias as $vp) {
                        $nombreVp = $vp->nombre;
                    }
                } else {
                    $nombreVp = '';
                }
            } else {
                $nombreVp = '';
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
    public function Colaboradores(Request $request)
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
            if ((int)$value->id_cargo > 0) {
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

            $Verificado  = (int)$value->verificar;
            switch ($Verificado) {
                case 1:
                    $Colaboradores[$cont]['verificar']   = 'VERIFICADO';
                    $Colaboradores[$cont]['label_verificar']    = 'text-success';
                    break;
                case 2:
                    $Colaboradores[$cont]['verificar']   = 'PENDIENTE';
                    $Colaboradores[$cont]['label_verificar']    = 'text-warning';
                    break;
                case 3:
                    $Colaboradores[$cont]['verificar']   = 'NO VERIFICADO';
                    $Colaboradores[$cont]['label_verificar']    = 'text-danger';
                    break;
                default:
                    $Colaboradores[$cont]['verificar']   = '';
                    $Colaboradores[$cont]['label_verificar']    = 'text-light';
                    break;
            }

            $Colaboradores[$cont]['unidad_estrategica'] = $value->unidad_estrategica;
            $Colaboradores[$cont]['id_posicion'] = $value->id_posicion;
            $Colaboradores[$cont]['password'] = $value->password;
            $Colaboradores[$cont]['foto'] = $value->foto;
            $fotoWebp = $value->foto_webp;
            $foto = $value->foto ? $value->foto : 'img_default.jpg';

            if ($fotoWebp) {
                $fotoWebpUrl = asset('recursos/' . $fotoWebp);
            } else {
                $fotoWebpUrl = asset('recursos/' . $foto);
            }
            if ($fotoWebp) {
                $fotoTabla = '<picture>
                <source srcset="' . $fotoWebpUrl . '" type="image/webp"/>
                <source srcset="' . asset('recursos/' . $fotoWebp) . '" type="image/jpeg"/>
                <img data-src="' . $fotoWebpUrl . '" class="lazyload profile-thumb" title="' . $value->nombre . '" id="fotoColaborador" src="' . $fotoWebpUrl . '" alt="' . $value->nombre . '"/>
            </picture>';
            } elseif (strpos($value->foto, '.png') !== false) {
                $fotoTabla = '<picture>
                                <source srcset="' . $fotoWebpUrl . '" type="image/webp"/>
                                <source srcset="' . asset('recursos/' . $foto) . '" type="image/png"/>
                                <img data-src="' . $fotoWebpUrl . '" class="lazyload profile-thumb" title="' . $value->nombre . '" id="fotoColaborador" src="' . $fotoWebpUrl . '" alt="' . $value->nombre . '"/>
                            </picture>';
            } else {
                $fotoTabla = '<picture>
                                <source srcset="' . $fotoWebpUrl . '" type="image/webp"/>
                                <source srcset="' . asset('recursos/' . $foto) . '" type="image/jpeg"/>
                                <img data-src="' . $fotoWebpUrl . '" class="lazyload profile-thumb" title="' . $value->nombre . '" id="fotoColaborador" src="' . $fotoWebpUrl . '" alt="' . $value->nombre . '"/>
                            </picture>';
            }
            // $Colaboradores[$cont]['foto_tabla'] = '<img data-src="' . asset('recursos/' . $foto) . '" class="lazyload profile-thumb" title="' . $value->nombre . '" style="width:50px;height:50px;border-radius:50%;" >';
            $Colaboradores[$cont]['foto_tabla'] = $fotoTabla;
            $cont++;
        }

        if ($request->ajax()) {
            return response()->json([
                'data' => $Colaboradores
            ]);
        }

        return view('administracion/colaboradores', ['Colaboradores' => $Colaboradores]);
    }

    /**
     * Funcion visualiza el formulario de creación o edición de un colaborador
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 02/03/2025
     * @version 1.0
     * @param $request
     * @return $respuesta
     */
    public static function DetalleColaborador(Request $request)
    {
        $Genero = array();
        $Genero[''] = 'Seleccione Genero..';
        $Genero['Femenino'] = 'Femenino';
        $Genero['Masculino'] = 'Masculino';

        $ListarCargos = GoForAgileAdmin::ListarCargosActivo((int)Session::get('id_empresa'));
        $Cargos = array();
        $Cargos[''] = 'Seleccione ' . Session::get('EtiquetaAdminCargos') . '..';
        foreach ($ListarCargos as $row) {
            $Cargos[$row->id] = $row->nombre;
        }

        $ListarPosiciones = GoForAgileAdmin::ListarPosicionesFormActivo((int)Session::get('id_empresa'));
        $Posiciones = array();
        $Posiciones[''] = 'Seleccione Posicion..';
        foreach ($ListarPosiciones as $row) {
            $Posiciones[$row->id] = $row->nombre;
        }

        $ListarVicepresidencias = GoForAgileAdmin::ListarVPActivo((int)Session::get('id_empresa'));
        $Vicepresidencias = array();
        $Vicepresidencias[''] = 'Seleccione ' . Session::get('EtiquetaAdminVicepresidencia') . '..';
        foreach ($ListarVicepresidencias as $row) {
            $Vicepresidencias[$row->id] = $row->nombre;
        }

        $ListarAreas = GoForAgileAdmin::ListarAreasActivo((int)Session::get('id_empresa'));
        $Areas = array();
        $Areas[''] = 'Seleccione ' . Session::get('EtiquetaAdminArea') . '..';
        foreach ($ListarAreas as $row) {
            $Areas[$row->id] = $row->nombre;
        }

        $ListarUO = GoForAgileAdmin::ListarUOActivo((int)Session::get('id_empresa'));
        $UnidadOrganizativa = array();
        $UnidadOrganizativa[''] = 'Seleccione ' . Session::get('EtiquetaAdminUnidadOrganizativa') . '..';
        foreach ($ListarUO as $row) {
            $UnidadOrganizativa[$row->id] = $row->unidad_organizativa;
        }

        $ListarNJ = GoForAgileAdmin::ListarNivelJ((int)Session::get('id_empresa'));
        $NivelJerarquico = array();
        $NivelJerarquico[''] = 'Seleccione ' . Session::get('EtiquetaAdminNivelJerarquico') . '..';
        foreach ($ListarNJ as $row) {
            $NivelJerarquico[$row->id] = $row->nombre;
        }

        $Estado = GoForAgileAdmin::Estado();
        $Verificar = GoForAgileAdmin::Verificar();

        $ListarRoles = GoForAgileAdmin::ListarRoles();
        $Roles = array();
        $Roles[''] = 'Seleccione Rol Plataforma..';
        foreach ($ListarRoles as $row) {
            $Roles[$row->id] = $row->nombre;
        }

        if ($request->query('colaborador')) {
            $listaLideres = GoForAgileAdmin::LideresColaborador($request->colaborador, (int)Session::get('id_empresa'));
            $Lideres = array();
            $cont = $num = 1;
            $nombreArea = $nombreCargo = $nombreVp = $nombreUO = $nombreRol = "";
            foreach ($listaLideres as $lider) {
                $Lideres[$cont]['cont'] = $num++;
                $Lideres[$cont]['id'] = (int)$lider->id_jefe;
                $Lideres[$cont]['id_empleado'] = (int)$lider->id_empleado;
                $liderData = GoForAgileAdmin::EmpleadoId($lider->id_jefe);
                foreach ($liderData as $data) {
                    $Lideres[$cont]['documento'] = $data->documento;
                    $Lideres[$cont]['nombre'] = $data->nombre;
                    $idvp = $data->unidad_corporativa;
                    $idArea = $data->area;
                    $idUO = $data->unidad_organizativa;
                    $idCargo = $data->id_cargo;
                    $foto = $data->foto;
                    $foto_webp = $data->foto_webp;
                }
                $Lideres[$cont]['id_cargo'] = (int)$idCargo;
                if ((int)$idCargo > 0) {
                    $cargos = GoForAgileAdmin::BuscarNombreCargoId($idCargo);
                    foreach ($cargos as $cargo) {
                        $nombreCargo = $cargo->nombre;
                    }
                } else {
                    $nombreCargo = "";
                }
                $Lideres[$cont]['nombre_cargo'] = $nombreCargo;
                $Lideres[$cont]['id_vp'] = (int)$idvp;
                if ($idvp > 0) {
                    $vps = GoForAgileAdmin::BuscarNombreVpId($idvp);
                    foreach ($vps as $vp) {
                        $nombreVp = $vp->nombre;
                    }
                } else {
                    $nombreVp = "";
                }
                $Lideres[$cont]['nombre_vp'] = $nombreVp;
                $Lideres[$cont]['id_area'] = (int)$idArea;
                if ($idArea > 0) {
                    $Lideres[$cont]['id_area'] = (int)$idArea;
                    $areas = GoForAgileAdmin::BuscarNombreAreaId($idArea);
                    foreach ($areas as $area) {
                        $nombreArea = $area->nombre;
                    }
                } else {
                    $nombreArea = "";
                }
                $Lideres[$cont]['nombre_area'] = $nombreArea;
                $Lideres[$cont]['unidad_organizativa'] = $idUO;
                if ($idUO > 0) {
                    $Lideres[$cont]['unidad_organizativa'] = $idUO;
                    $unidadO = GoForAgileAdmin::ListarEPId($idUO);
                    if ($unidadO) {
                        foreach ($unidadO as $uo) {
                            $nombreUO = $uo->unidad_organizativa;
                        }
                    }
                } else {
                    $nombreUO = "";
                }
                $Lideres[$cont]['nombre_unidad_organizativa'] = $nombreUO;
                $fotoWebp = $foto_webp;
                $foto = $foto ? $foto : 'img_default.jpg';

                if ($fotoWebp) {
                    $fotoWebpUrl = asset('recursos/' . $fotoWebp);
                } else {
                    $fotoWebpUrl = asset('recursos/' . $foto);
                }
                if ($fotoWebp) {
                    $fotoTabla = '<picture>
                <source srcset="' . $fotoWebpUrl . '" type="image/webp"/>
                <source srcset="' . asset('recursos/' . $fotoWebp) . '" type="image/jpeg"/>
                <img data-src="' . $fotoWebpUrl . '" class="lazyload profile-thumb" title="' . $Lideres[$cont]['nombre'] . '" id="fotoColaborador" src="' . $fotoWebpUrl . '" alt="' . $Lideres[$cont]['nombre'] . '"/>
            </picture>';
                } elseif (strpos($foto, '.png') !== false) {
                    $fotoTabla = '<picture>
                                <source srcset="' . $fotoWebpUrl . '" type="image/webp"/>
                                <source srcset="' . asset('recursos/' . $foto) . '" type="image/png"/>
                                <img data-src="' . $fotoWebpUrl . '" class="lazyload profile-thumb" title="' . $Lideres[$cont]['nombre'] . '" id="fotoColaborador" src="' . $fotoWebpUrl . '" alt="' . $Lideres[$cont]['nombre'] . '"/>
                            </picture>';
                } else {
                    $fotoTabla = '<picture>
                                <source srcset="' . $fotoWebpUrl . '" type="image/webp"/>
                                <source srcset="' . asset('recursos/' . $foto) . '" type="image/jpeg"/>
                                <img data-src="' . $fotoWebpUrl . '" class="lazyload profile-thumb" title="' . $Lideres[$cont]['nombre'] . '" id="fotoColaborador" src="' . $fotoWebpUrl . '" alt="' . $Lideres[$cont]['nombre'] . '"/>
                            </picture>';
                }

                $Lideres[$cont]['foto_tabla'] = $fotoTabla;
                $cont++;
            }
            $colaborador = GoForAgileAdmin::EmpleadoId($request->colaborador);
            if ($colaborador) {
                // dd($colaborador);
                foreach ($colaborador as $row) {
                    $documento = $row->documento;
                    $nombre = $row->nombre;
                    $genero = $row->genero;
                    $fechaIngreso = $row->fecha_ingreso;
                    $antiguedadA = $row->antiguedad_anios;
                    $antiguedadM = $row->antiguedad_meses;
                    $antiguedadA = $row->antiguedad_dias;
                    $correo = $row->correo;
                    $telefono_movil = $row->telefono_movil;
                    $telefono_fijo = $row->telefono_fijo;
                    $compania = $row->compania;
                    $id_cargo = $row->id_cargo;
                    $unidad_estrategica = $row->unidad_estrategica;
                    $posicion = $row->id_posicion;
                    $vicepresidencia = $row->unidad_corporativa;
                    $area = $row->area;
                    $unidad_organizativa = $row->unidad_organizativa;
                    $nivel_jerarquico = $row->nivel_jerarquico;
                    $nivel_general = $row->nivel_general;
                    $contrasena = $row->contrasena;
                    $password = $row->password;
                    $estado = $row->estado;
                    $role = $row->role;
                    $foto = $row->foto;
                    $idColaborador = $row->id;
                    $verificar = $row->verificar;
                }
            }

            if ($antiguedadA === '' || $antiguedadA === null) {
                $antiguedadAnios = '0';
            } else {
                $antiguedadAnios = $antiguedadA;;
            }
            if ($antiguedadM === '' || $antiguedadM === null) {
                $antiguedadMeses = '0';
            } else {
                $antiguedadMeses = $antiguedadM;
            }
            if ($antiguedadA === '' || $antiguedadA === null) {
                $antiguedadDias = '0';
            } else {
                $antiguedadDias = $antiguedadA;
            }

            $antiguedad = $antiguedadAnios . ' años / ' . $antiguedadMeses . ' meses / ' . $antiguedadDias . ' días ';

            $ListarLideresEmpresa = GoForAgileAdmin::ListarLideresEmpresa($request->colaborador, (int)Session::get('id_empresa'));
            $LideresEmpresa = array();
            $LideresEmpresa[''] = 'Seleccione Lider..';
            foreach ($ListarLideresEmpresa as $row) {
                $LideresEmpresa[$row->id] = $row->nombre;
            }

            return view('administracion/colaborador/detalle', [
                'Genero' => $Genero,
                'Cargos' => $Cargos,
                'Posiciones' => $Posiciones,
                'Vicepresidencias' => $Vicepresidencias,
                'Areas' => $Areas,
                'UnidadOrganizativa' => $UnidadOrganizativa,
                'NivelJerarquico' => $NivelJerarquico,
                'Estado' => $Estado,
                'Verificar' => $Verificar,
                'Roles' => $Roles,
                'fechaIngreso' => $fechaIngreso,
                'documento' => $documento,
                'nombre' => $nombre,
                'genero' => $genero,
                'antiguedad' => $antiguedad,
                'antiguedadAnios' => $antiguedadAnios,
                'antiguedadMeses' => $antiguedadMeses,
                'antiguedadDias' => $antiguedadDias,
                'correo' => $correo,
                'telefonoMovil' => $telefono_movil,
                'telefonoFijo' => $telefono_fijo,
                'compania' => $compania,
                'unidadEstrategica' => $unidad_estrategica,
                'cargo' => $id_cargo,
                'posicion' => $posicion,
                'vicepresidencia' => $vicepresidencia,
                'area' => $area,
                'unidad_organizativa' => $unidad_organizativa,
                'nivel_jerarquico' => $nivel_jerarquico,
                'nivel_general' => $nivel_general,
                'password' => $password,
                'estado' => $estado,
                'role' => $role,
                'foto' => $foto,
                'idColaborador' => $idColaborador,
                'verificar' => $verificar,
                'Lideres' => $Lideres,
                'LideresEmpresa' => $LideresEmpresa
            ]);
        } else {
            return view('administracion/colaborador/crear', [
                'Genero' => $Genero,
                'Cargos' => $Cargos,
                'Posiciones' => $Posiciones,
                'Vicepresidencias' => $Vicepresidencias,
                'Areas' => $Areas,
                'UnidadOrganizativa' => $UnidadOrganizativa,
                'NivelJerarquico' => $NivelJerarquico,
                'Estado' => $Estado,
                'Roles' => $Roles,
                'Verificar' => $Verificar
            ]);
        }
    }
}
