<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\GoForAgileAdmin;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

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
                $CrearArea = GoForAgileAdmin::CrearArea($nombreArea, $padre, $jerarquia, (int)Session::get('id_empresa'), (int)Session::get('id_user'));
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
                $ActualizarArea = GoForAgileAdmin::ActualizarArea($nombreArea, $padre, $jerarquia, $estado, $idArea, (int)Session::get('id_empresa'), (int)Session::get('id_user'));
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
        $idArea = $request->id_area_delete;

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
                $CrearArea = GoForAgileAdmin::CrearCargo($nombreCargo, $area, $nivelJerarquico, (int)Session::get('id_empresa'), (int)Session::get('id_user'));
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
                $ActualizarArea = GoForAgileAdmin::ActualizarCargo($nombreCargo, $area, $nivelJerarquico, $estado, $idCargo, (int)Session::get('id_empresa'), (int)Session::get('id_user'));
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
     * Creación Colaboradores
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 06/03/2025
     * @version 1.0
     * @param $request
     * @return alert message
     */

    public function CrearColaborador(Request $request)
    {
        $etiquetas = GoForAgileAdmin::EtiquetasAdministrador((int)Session::get('id_empresa'));
        $url = AdminController::FindUrl();

        $validator = Validator::make($request->all(), [
            'documento' => 'required',
            'nombre' => 'required',
            'correo' => 'required|email',
            'documento' => 'required',
            'compania' => 'required',
            'unidad_corporativa' => 'required',
            'area' => 'required',
            'password' => 'required',
            'role' => 'required',
            'foto' => 'max:2048|mimes:jpeg,png'
        ]);

        $validator->setAttributeNames([
            'unidad_estrategica' => $etiquetas[1]["etiqueta"],
            'unidad_corporativa' => $etiquetas[2]["etiqueta"],
            'area' => $etiquetas[3]["etiqueta"],
            'unidad_organizativa' => $etiquetas[4]["etiqueta"],
            'nivel_jerarquico' => $etiquetas[5]["etiqueta"],
            'cargo' => $etiquetas[6]["etiqueta"]
        ]);

        if ($validator->fails()) {
            return Redirect::to($url . 'detalleColaborador')->withErrors($validator)->withInput();
        } else {
            $BuscarDocumento = GoForAgileAdmin::BuscarDocumentoEmpleado($request->documento, Session::get('id_empresa'));
            if ($BuscarDocumento) {
                $verrors = array();
                array_push($verrors, 'Documento de colaborador ya existe');
                return Redirect::to($url . 'detalleColaborador')->withErrors(['errors' => $verrors])->withInput();
            } else {
                $BuscarNombre = GoForAgileAdmin::BuscarNombreEmpleado($request->nombre, Session::get('id_empresa'));
                if ($BuscarNombre) {
                    $verrors = array();
                    array_push($verrors, 'Nombre de colaborador ya existe');
                    return Redirect::to($url . 'detalleColaborador')->withErrors(['errors' => $verrors])->withInput();
                } else {
                    $BuscarCorreo = GoForAgileAdmin::BuscarCorreoEmpleado($request->correo, Session::get('id_empresa'));
                    if ($BuscarNombre) {
                        $verrors = array();
                        array_push($verrors, 'Correo de colaborador ya existe');
                        return Redirect::to($url . 'detalleColaborador')->withErrors(['errors' => $verrors])->withInput();
                    } else {
                        $contrasena = hash('sha512', $request->password);
                        $nombre = $request->nombre;
                        $nombreFoto = str_replace(" ", "", $nombre);
                        $idColaborador = GoForAgileAdmin::CrearColaborador($request, $contrasena, (int)Session::get('id_empresa'));
                        if ($idColaborador > 0) {

                            if ($request->hasFile('foto')) {
                                $image = $request->file('foto');
                                $imageName = time() . '_' . $nombreFoto . '.' . $image->getClientOriginalExtension();
                                $originalPath = base_path('recursos/' . $imageName);

                                $originalImage = Image::make($image);
                                $imageExtension = $image->getClientOriginalExtension();
                                if ($imageExtension == 'png') {
                                    $originalImage->encode('png', 70);  // Calidad para PNG
                                    $path = base_path('recursos/' . pathinfo($imageName, PATHINFO_FILENAME) . '.png');
                                } elseif ($imageExtension == 'jpeg' || $imageExtension == 'jpg') {
                                    $originalImage->encode('jpg', 70);  // Calidad para JPG
                                    $path = base_path('recursos/' . pathinfo($imageName, PATHINFO_FILENAME) . '.jpg');
                                }

                                $originalImage->save($path);

                                $webpImage = Image::make($originalPath);

                                $webpPath = base_path('recursos/' . pathinfo($imageName, PATHINFO_FILENAME) . '.webp');
                                $webpImage->encode('webp', 65);  // Calidad 65 para reducir el peso
                                $webpImage->save($webpPath);
                                $imageWebp = time() . '_' . $nombreFoto . '.webp';
                                GoForAgileAdmin::ActualizarFotoColaborador($idColaborador, $imageName, $imageWebp, (int)Session::get('id_empresa'), Session::get('id_user'));
                            }
                            $verrors = 'Se creo el colaborador ' . $nombre . ' con éxito.';
                            return Redirect::to($url . 'detalleColaborador?colaborador=' . $idColaborador)->with('mensaje', $verrors);
                        } else {
                            $verrors = array();
                            array_push($verrors, 'Hubo un problema al crear el colaborador');
                            return Redirect::to($url . 'detalleColaborador?colaborador=' . $request->id_colaborador)->withErrors(['errors' => $verrors])->withInput();
                        }
                    }
                }
            }
        }
    }

    /**
     * Actualización Colaboradores
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 06/03/2025
     * @version 1.0
     * @param $request
     * @return alert message
     */

    public function ActualizarColaborador(Request $request)
    {
        $etiquetas = GoForAgileAdmin::EtiquetasAdministrador((int)Session::get('id_empresa'));
        $url = AdminController::FindUrl();

        $validator = Validator::make($request->all(), [
            'documento' => 'required',
            'nombre' => 'required',
            'correo' => 'required|email',
            'documento' => 'required',
            'compania' => 'required',
            'unidad_corporativa' => 'required',
            'area' => 'required',
            'password' => 'required',
            'estado' => 'required',
            'role' => 'required',
            'foto' => 'max:2048|mimes:jpeg,png'
        ]);

        $validator->setAttributeNames([
            'unidad_estrategica' => $etiquetas[1]["etiqueta"],
            'unidad_corporativa' => $etiquetas[2]["etiqueta"],
            'area' => $etiquetas[3]["etiqueta"],
            'unidad_organizativa' => $etiquetas[4]["etiqueta"],
            'nivel_jerarquico' => $etiquetas[5]["etiqueta"],
            'cargo' => $etiquetas[6]["etiqueta"]
        ]);

        if ($validator->fails()) {
            return Redirect::to($url . 'detalleColaborador?colaborador=' . $request->id_colaborador)->withErrors($validator)->withInput();
        } else {
            $BuscarDocumento = GoForAgileAdmin::BuscarDocumentoEmpleadoUpd($request->documento, $request->id_colaborador, Session::get('id_empresa'));
            if ($BuscarDocumento) {
                $verrors = array();
                array_push($verrors, 'Documento de colaborador ya existe');
                return Redirect::to($url . 'detalleColaborador?colaborador=' . $request->id_colaborador)->withErrors(['errors' => $verrors])->withInput();
            } else {
                $BuscarCorreo = GoForAgileAdmin::BuscarCorreoEmpleadoUpd($request->correo, $request->id_colaborador, Session::get('id_empresa'));
                if ($BuscarCorreo) {
                    $verrors = array();
                    array_push($verrors, 'Correo de colaborador ya existe');
                    return Redirect::to($url . 'detalleColaborador?colaborador=' . $request->id_colaborador)->withErrors(['errors' => $verrors])->withInput();
                } else {
                    $BuscarNombre = GoForAgileAdmin::BuscarNombreEmpleadoUpd($request->nombre, Session::get('id_empresa'), $request->id_colaborador);
                    if ($BuscarNombre) {
                        $verrors = array();
                        array_push($verrors, 'Nombre de colaborador ya existe');
                        return Redirect::to($url . 'detalleColaborador?colaborador=' . $request->id_colaborador)->withErrors(['errors' => $verrors])->withInput();
                    } else {
                        $contrasena = hash('sha512', $request->password);
                        $nombre = $request->nombre;
                        $nombreFoto = str_replace(" ", "", $nombre);
                        $ActualizarColaborador = GoForAgileAdmin::ActualizarColaborador($request, $contrasena, (int)Session::get('id_empresa'), Session::get('id_user'));
                        if ($ActualizarColaborador) {
                            if ($request->hasFile('foto')) {
                                $image = $request->file('foto');

                                $imageName = time() . '_' . $nombreFoto . '.' . $image->getClientOriginalExtension();

                                $originalPath = base_path('recursos/' . $imageName);

                                $originalImage = Image::make($image);
                                $imageExtension = $image->getClientOriginalExtension();
                                if ($imageExtension == 'png') {
                                    $originalImage->encode('png', 70);  // Calidad para PNG
                                    $path = base_path('recursos/' . pathinfo($imageName, PATHINFO_FILENAME) . '.png');
                                } elseif ($imageExtension == 'jpeg' || $imageExtension == 'jpg') {
                                    $originalImage->encode('jpg', 70);  // Calidad para JPG
                                    $path = base_path('recursos/' . pathinfo($imageName, PATHINFO_FILENAME) . '.jpg');
                                }

                                $originalImage->save($path);

                                $webpImage = Image::make($originalPath);

                                $webpPath = base_path('recursos/' . pathinfo($imageName, PATHINFO_FILENAME) . '.webp');
                                $webpImage->encode('webp', 65);  // Calidad 65 para reducir el peso
                                $webpImage->save($webpPath);
                                $imageWebp = time() . '_' . $nombreFoto . '.webp';
                                GoForAgileAdmin::ActualizarFotoColaborador($request->id_colaborador, $imageName, $imageWebp, (int)Session::get('id_empresa'), Session::get('id_user'));
                            }
                            $verrors = 'Se actualizo los datos para el colaborador ' . $nombre . ' con éxito.';
                            return Redirect::to($url . 'detalleColaborador?colaborador=' . $request->id_colaborador)->with('mensaje', $verrors);
                        } else {
                            $verrors = array();
                            array_push($verrors, 'Hubo un problema al actualizar el colaborador');
                            return Redirect::to($url . 'detalleColaborador?colaborador=' . $request->id_colaborador)->withErrors(['errors' => $verrors])->withInput();
                        }
                    }
                }
            }
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
