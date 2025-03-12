<?php

namespace App\Http\Controllers;

use App\Models\GoForAgileAdmin;
use Illuminate\Http\Request;
use App\Models\GoForAgileOkrs;
use Illuminate\Support\Facades\Session;

class ApiAdminController extends Controller
{
    /**
     * Funcion que muestra la información del usuario en el profile card
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 11/10/2024
     * @version 1.0
     * @param $request
     * @return $infoProfile
     */
    public function ProfileEmpleado(Request $request)
    {
        $profile = GoForAgileAdmin::CardProfile($request->id);
        $infoProfile = "";
        foreach ($profile as $value) {
            $nombre = $value["nombre"];
            $fotoProfile = $value["foto"];
            $cargo = strtoupper($value["cargo"]);
            $area = $value["area"];
            $vp = $value["vicepresidencia"];
        }
        if ($fotoProfile) {
            $foto = $fotoProfile;
        } else {
            $foto = "img_default.jpg";
        }

        if (Session::get('id_empresa') == 1) {
            $vicepresidencia = '<div class="row">
                                    <div class="col-md-12">
                                        <p style="font-size: 15px">
                                            <b>Vicepresidencia</b>: ' . $vp . '
                                        </p>                                        
                                    </div>
                                </div>';
        } else {
            $vicepresidencia = '';
        }

        $infoProfile = ' <div class="row">
                            <div class="col-md-6" style="text-align: center;align-content: center;">
                                <img src="https://www.goforagile.com/recursos/' . $foto . '" alt="image" style="width:70%;">                                    
                            </div>
                            <div class="col-md-6" style="align-content: center;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 style="font-family: Montserrat-Bold !important;">' . $nombre . '</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p style="font-size: 15px">
                                            <b>Cargo</b>: ' . $cargo . '
                                        </p>                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p style="font-size: 15px">
                                        <b>Área</b>: ' . $area . '
                                        </p>                                        
                                    </div>
                                </div>
                                ' . $vicepresidencia . '
                            </div>
                        </div>               
                    ';

        return $infoProfile;
    }



    /**
     * Funcion que guarda lista las areas de una empresa que estan estructuradas a una vicepresidencia
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 02/03/2025
     * @version 1.0
     * @param $request
     * @return $respuesta
     */
    public function ListarAreasEmpresa(Request $request)
    {
        $respuesta = GoForAgileAdmin::ListarAreasEE((int)$request->id);
        return response()->json($respuesta);
    }

    /**
     * Funcion que guarda lista las unidades organizativas de una empresa que estan estructuradas a una vicepresidencia
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 02/03/2025
     * @version 1.0
     * @param $request
     * @return $respuesta
     */
    public function ListarUnidadOrganizativaEmpresa(Request $request)
    {
        $respuesta = GoForAgileAdmin::ListarUOEE((int)$request->id, (int)$request->vp);
        return response()->json($respuesta);
    }

    /**
     * Funcion que guarda elimina el colaborador de la base de datos
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 09/03/2025
     * @version 1.0
     * @param $request
     * @return $respuesta
     */
    public function EliminarColaborador(Request $request)
    {
        $eliminacionColaborador = GoForAgileAdmin::EliminarColaborador((int)$request->id, (int)$request->id_user);
        $respuesta = "false";
        if ($eliminacionColaborador) {
            $respuesta = "true";
        }
        return $respuesta;
    }

    /**
     * Funcion que guarda elimina el lider de un colaborador en la base de datos
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 09/03/2025
     * @version 1.0
     * @param $request
     * @return $respuesta
     */
    public function EliminarLider(Request $request)
    {
        $eliminacionLider = GoForAgileAdmin::EliminarLider((int)$request->id, (int)$request->id_user, (int)$request->id_colaborador);
        $respuesta = "false";
        if ($eliminacionLider) {
            $respuesta = "true";
        }
        return $respuesta;
    }

    /**
     * Funcion muestra los colaboradores de la emmpresa
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 09/03/2025
     * @version 1.0
     * @param $request
     * @return $respuesta
     */
    public function ColaboradoresEmpresa(Request $request)
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
                $fotoTabla = "<picture><source srcset='$fotoWebpUrl' type='image/webp'/><source srcset='".asset('recursos/' . $fotoWebp)."' type='image/jpeg'/><img data-src='$fotoWebpUrl' class='lazyload profile-thumb' title='$value->nombre' id='fotoColaborador' src='$fotoWebpUrl' alt='".$value->nombre."'/></picture>";
            } elseif (strpos($value->foto, '.png') !== false) {
                $fotoTabla = "<picture><source srcset='$fotoWebpUrl' type='image/webp'/><source srcset='".asset('recursos/' . $foto)."' type='image/png'/><img data-src='$fotoWebpUrl' class='lazyload profile-thumb' title='$value->nombre' id='fotoColaborador' src='$fotoWebpUrl' alt='".$value->nombre."'/></picture>";
            } else {
                $fotoTabla = "<picture><source srcset='$fotoWebpUrl' type='image/webp'/><source srcset='".asset('recursos/' . $foto)."' type='image/jpeg'/><img data-src='$fotoWebpUrl' class='lazyload profile-thumb' title='$value->nombre' id='fotoColaborador' src='$fotoWebpUrl' alt='".$value->nombre."'/></picture>";
            }
            // $Colaboradores[$cont]['foto_tabla'] = '<img data-src="' . asset('recursos/' . $foto) . '" class="lazyload profile-thumb" title="' . $value->nombre . '" style="width:50px;height:50px;border-radius:50%;" >';
            $Colaboradores[$cont]['foto_tabla'] = $fotoTabla;
            $cont++;
        }
        // dd($Colaboradores);
        return response()->json([
            'data' => $Colaboradores
        ]);
    }
}
