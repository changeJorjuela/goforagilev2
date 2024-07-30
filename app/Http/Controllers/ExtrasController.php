<?php

namespace App\Http\Controllers;

use App\Models\GoForAgileAdmin;
use Illuminate\Http\Request;
use App\Models\GoForAgileOkrs;
use Illuminate\Support\Facades\Session;

class ExtrasController extends Controller
{
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
                                <img src="../../recursos/' . $foto . '" alt="image" style="width:70%;">                                    
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

    public function GuardarAvanceResultado(Request $request)
    {

        $idKr = $request->id;
        $idOkr = $request->id_okr;
        $idEmpresa = $request->id_empresa;
        $idUser = $request->id_user;
        $avance = $request->avance;

        $avance = GoForAgileOkrs::GuardarAvanceKr($idKr, $avance, $idOkr, $idEmpresa, $idUser);
        $respuesta = "false";
        if ($avance) {
            $respuesta = "true";
        }

        return $respuesta;
    }

    public function GuardarAvanceIniciativa(Request $request)
    {

        $id = $request->id;
        $idKr = $request->id_resultado;
        $idOkr = $request->id_okr;
        $idEmpresa = $request->id_empresa;
        $idUser = $request->id_user;
        $avance = $request->avance;

        $avance = GoForAgileOkrs::GuardarAvanceIniciativa($id, $idKr, $avance, $idOkr, $idEmpresa, $idUser);
        $respuesta = "false";
        if ($avance) {
            $respuesta = "true";
        }

        return $respuesta;
    }

    public function VerIniciativa(Request $request)
    {
        $nombreIniciativa = $fechaEntrega = $meta = $idTendencia = $responsables = "";

        $kr = GoForAgileOkrs::KrId($request->idResultado);
        foreach ($kr as $value) {
            $nombreKr = $value->descripcion;
            $idOkr = $value->id_okrs;
        }
        $iniciativa = GoForAgileOkrs::IniciativasID($request->idIniciativa);
        if ($iniciativa) {
            foreach ($iniciativa as $value) {
                $nombreIniciativa = $value->descripcion;
                $fechaEntrega = $value->fecha_entrega;
                $meta = $value->meta;
                $idTendencia = $value->tendencia;
                $responsables1 = $value->responsables;
            }
        }

        

        $header = '<div class="row">
                        <div class="col-md-12">
                            <h5>Iniciativa para el KR: ' . $nombreKr . '</h5>
                        </div>
                    </div>';

        $tendencia = '<label>Tendencia *</label>
                    <select class="form-control " name="tendencia" id="tendencia" required>
                    <option value="">Seleccione...</option>
        ';

        $selectTendencia = GoForAgileAdmin::Tendencia();

        $listaResponsables = GoForAgileOkrs::ListaResponsables($idOkr);
        $selectResponsable = '<label>Responsable(s) *</label>
                    <select class="form-control " name="id_responsable" id="id_responsable" required>
                    <option value="">Seleccione responsable...</option>
        ';
        foreach($listaResponsables as $responsable){
            $selectResponsable .= '<option value="'.$responsable->id_empleado.'">'.$responsable->nombre_empleado.'</option>
        ';
        }

        if ($responsables1) {
            $array_responsables = explode(",", $responsables1);
            foreach ($array_responsables as $responsable) {
                if ($responsable) {
                    $queryResp = GoForAgileAdmin::EmpleadoId($responsable);
                    foreach($queryResp as $resp){
                        $idResponsable = $resp->id;
                        $nombreResponsable = $resp->nombre;
                    }
                    $responsables .='<div id="resp_' . $idResponsable . '"> <i class="icon-bin" onClick="Eliminar_Responsable(' . $idResponsable . ')"></i> <b>' . $nombreResponsable . '</b> <input type="hidden" name="responsables[]" value="' . $idResponsable . '" ></div> ';
                }
            }
        }

        foreach ($selectTendencia as $select) {
            // dd($select); 
            if ($idTendencia != "") {
                $tendencia .= '<option value="' . $select[0] . '" selected>' . $select[1] . '</option>';
            } else {
                $tendencia .= '<option value="' . $select[0] . '">' . $select[1] . '</option>';
            }
        }
        $cuerpo = array(
            "id_iniciativa" => $request->idIniciativa,
            "id_resultado" => $request->idResultado,
            "id_registro" => $request->idIniciativa,
            "id_okrs" => $idOkr,
            "header" => $header,
            'descripcion' => $nombreIniciativa,
            "fecha_entrega" => $fechaEntrega,
            "meta" => $meta,
            "tendencia" => $tendencia,
            "responsables" => $selectResponsable,
            "divResponsables" => $responsables,
            "pagina" => $request->pagina
        );
        return $cuerpo;
    }

    public function CrearIniciativa(Request $request)
    {
    }
}
