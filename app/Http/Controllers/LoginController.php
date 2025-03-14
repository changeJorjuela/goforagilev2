<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Models\GoForAgileAdmin;
use App\Models\GoForAgileCompetencias;

class LoginController extends Controller
{
    /**
     * Funcion que dirige al login del aplicativo
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 11/10/2024
     * @version 1.0
     */
    public function Login()
    {
        return view('/');
    }

    /**
     * Funcion que dirige a la funcionalidad de recuperar contraseña
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 11/10/2024
     * @version 1.0
     */
    public function RecuperarContrasena()
    {
        return view('recuperarContrasena');
    }

    /**
     * Funcion que configura el acceso al aplicativo desde el login
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 11/10/2024
     * @version 1.0
     * @param $request
     */
    public function Acceso(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return Redirect::to('/')->withErrors($validator)->withInput();
        } else {
            $user       = $request->user;
            $password   = $request->password;
            $consultaUsuario = GoForAgileAdmin::BuscarUserLogin($user);

            if ($consultaUsuario) {
                $contrasena = hash('sha512', $request->password);
                $consultarLogin = GoForAgileAdmin::BuscarPass($user, $contrasena);
                if ($consultarLogin) {
                    foreach ($consultarLogin as $value) {
                        $IdUsuario      = (int)$value->id;
                        $nombreUsuario  = $value->nombre;
                        $emailUsuario   = $value->correo;
                        $estado         = (int)$value->estado;
                        $idRol          = (int)$value->role;
                        $idArea         = (int)$value->area;
                        $fechaInicio    = $value->created_at;
                        $idEmpresa      = $value->id_empresa;
                        $profilePhoto   = $value->foto;
                    }
                    if ($estado === 1) {

                        $mod_okrs_equipo = $mod_okrs = $mod_valoracion = $mod_desempenio = $mod_endomarketing = $mod_admin = 2;

                        $Empresa = GoForAgileAdmin::ListarEmpresa($idEmpresa);
                        foreach ($Empresa as $valor) {
                            $foto_empresa = $valor->logo;
                            $anio_curso = $valor->anio_curso;
                            if ($valor->mod_okrs_equipo == 'on') {
                                $mod_okrs_equipo = 1;
                            }
                            if ($valor->mod_okrs == 'on') {
                                $mod_okrs = 1;
                            }
                            if ($valor->mod_valoracion == 'on') {
                                $mod_valoracion = 1;
                            }
                            if ($valor->mod_desempenio == 'on') {
                                $mod_desempenio = 1;
                            }
                            if ($valor->mod_endomarketing == 'on') {
                                $mod_endomarketing = 1;
                            }
                            if ($valor->mod_admin == 'on') {
                                $mod_admin = 1;
                            }
                        }

                        $Ciclos = GoForAgileCompetencias::BuscarCiclo($idEmpresa);
                        $id_ciclo = "";
                        foreach ($Ciclos as $valor) {
                            $id_ciclo = $valor->id;
                        }

                        if (!$profilePhoto) {
                            $photo = "img_default.jpg";
                        } else {
                            $photo = $profilePhoto;
                        }

                        // if (!$foto_empresa) {
                        //     $photo_empresa = asset('img/logo_agile_marker.png');
                        // } else {
                        //     $photo_empresa = asset('recursos/'. $foto_empresa);
                        // }

                        if ($idRol == 1) {
                            Session::put('role_plataforma', 1);
                        }

                        $photoPath = base_path('recursos/' . $photo);
                        $extension = pathinfo($photo, PATHINFO_EXTENSION);
                        $filename = pathinfo($photo, PATHINFO_FILENAME);

                        $avatarDir = base_path('avatars/');
                        $webAvatarDir = asset('avatars/') . '/';

                        $photoPath = base_path('recursos/' . $photo);
                        $extension = pathinfo($photo, PATHINFO_EXTENSION);
                        $filename = pathinfo($photo, PATHINFO_FILENAME);

                        $avatarPath = $avatarDir . $filename . '.' . $extension;
                        $avatarWebP = $avatarDir . $filename . '.webp';

                        $fotoOriginal = $webAvatarDir . $filename . '.' . $extension;
                        $fotoWebp = $webAvatarDir . $filename . '.webp';

                        if (!file_exists($avatarPath) || !file_exists($avatarWebP)) {
                            $avatar = Image::make($photoPath)->resize(240, 240);

                            if (!file_exists($avatarPath)) {
                                $avatar->save($avatarPath);
                            }

                            if (!file_exists($avatarWebP)) {
                                $avatar->encode('webp', 90)->save($avatarWebP);
                            }
                        }

                        if (file_exists($avatarWebP)) {
                            $avatar = '<picture>
                    <source srcset="' . $fotoWebp . '" type="image/webp"/>
                    <img data-src="' . $fotoWebp . '" class="avatar" 
                        title="' . $value->nombre . '"  
                        src="' . $fotoWebp . '" alt="' . $value->nombre . '"/>
               </picture>';
                        } else {
                            $mimeType = ($extension === 'png') ? 'image/png' : 'image/jpeg';
                            $avatar = '<picture>
                    <source srcset="' . $fotoOriginal . '" type="' . $mimeType . '"/>
                    <img data-src="' . $fotoOriginal . '" class="avatar" 
                        title="' . $value->nombre . '"  
                        src="' . $fotoOriginal . '" alt="' . $value->nombre . '"/>
               </picture>';
                        }

                        if (!$foto_empresa) {
                            $photo_empresa = 'img/logo_agile_marker.png';
                        } else {
                            $photo_empresa = 'recursos/' . $foto_empresa;
                        }

                        $userPhoto  = '<img src="' . asset('recursos/' . $photo) . '" class="foto_min" alt="GFA User">';
                        // $avatar     = '<img class="avatar" src="' . asset('avatars/' . $photo) . '" alt="GFA User" />';
                        // $avatar     = '<img class="avatar" src="https://www.goforagile.com/recursos/' . $photo . '" alt="GFA User" style="height:40px;"/>';
                        $fotoAside  = '<img src="' . asset('recursos/' . $photo) . '" class="profile-thumb" alt="GFA User">';
                        $fotoEmpresa = '<img src="' . asset($photo_empresa) . '" alt="Admin Empresa" />';

                        Session::put('id_user', $IdUsuario);
                        Session::put('NombreUsuario', $nombreUsuario);
                        Session::put('id_empresa', $idEmpresa);
                        Session::put('id_area', $idArea);
                        Session::put('id_rol', $idRol);
                        // Session::put('role_plataforma', $idRol);
                        if ($idRol == 1) {
                            Session::put('role_plataforma', 1);
                        }
                        if ($idRol == 3 || $idRol == 2) {
                            Session::put('role_plataforma', 3);
                        }
                        Session::put('estado', $estado);
                        $Rol = GoForAgileAdmin::ListarRolesId($idRol);
                        foreach ($Rol as $valor) {
                            $NombreRol = $valor->nombre;
                        }
                        Session::put('NombreRol', strtoupper($NombreRol));
                        Session::put('foto_usuario', $userPhoto);
                        Session::put('FotoAvatar', $avatar);
                        Session::put('FotoAside', $fotoAside);
                        Session::put('FotoEmpresa', $fotoEmpresa);
                        Session::put('ModOkrsEquipo', $mod_okrs_equipo);
                        Session::put('ModOkrs', $mod_okrs);
                        Session::put('ModValoracion', $mod_valoracion);
                        Session::put('ModDesempenio', $mod_desempenio);
                        Session::put('ModEndomarketing', $mod_endomarketing);
                        Session::put('ModAdmin', $mod_admin);
                        Session::put('ciclo', $id_ciclo);
                        Session::put('anio_curso', $anio_curso);
                        Session::put('anio_fill', $anio_curso);

                        $etiquetasAdmin = GoForAgileAdmin::EtiquetasAdministrador($idEmpresa);
                        Session::put('EtiquetaAdminDivisionEstrategica', $etiquetasAdmin[1]['etiqueta']);
                        Session::put('EtiquetaAdminVicepresidencia', $etiquetasAdmin[2]['etiqueta']);
                        Session::put('EtiquetaAdminArea', $etiquetasAdmin[3]['etiqueta']);
                        Session::put('EtiquetaAdminUnidadOrganizativa', $etiquetasAdmin[4]['etiqueta']);
                        Session::put('EtiquetaAdminNivelJerarquico', $etiquetasAdmin[5]['etiqueta']);
                        Session::put('EtiquetaAdminCargos', $etiquetasAdmin[6]['etiqueta']);

                        Session::save();

                        switch ($idRol) {
                            case 1:
                                return Redirect::to('administrador/home');
                                break;
                            case 2:
                                return Redirect::to('lider/home');
                                break;
                            case 3:
                                return Redirect::to('colaborador/home');
                                break;
                        }
                    } else {
                        $verrors = array();
                        array_push($verrors, 'Usuario inactivo');
                        return Redirect::to('/')->withErrors(['errors' => $verrors]);
                    }
                } else {
                    $verrors = array();
                    array_push($verrors, 'Usuario o contraseña incorrectos');
                    return Redirect::to('/')->withErrors(['errors' => $verrors]);
                }
            } else {
                $verrors = array();
                array_push($verrors, 'El usuario ' . $user . ' No se encuentra en la base de datos');
                return Redirect::to('/')->withErrors(['errors' => $verrors]);
            }
        }
    }

    /**
     * Funcion que realiza la recuperación de la contraseña
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 11/10/2024
     * @version 1.0
     */

    public function recuperarAcceso(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mail' => 'required'
        ]);
        if ($validator->fails()) {
            return Redirect::to('recuperarContrasena')->withErrors($validator)->withInput();
        } else {
        }
    }
}
