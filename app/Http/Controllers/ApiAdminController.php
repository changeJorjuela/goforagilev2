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
        $eliminacionColaborador = GoForAgileAdmin::EliminarColaborador((int)$request->id,(int)$request->id_user);
        $respuesta = "false";
        if ($eliminacionColaborador) {
            $respuesta = "true";
        }
        return $respuesta;
    }
}
