<?php

namespace App\Http\Controllers;

use App\Models\GoForAgileAdmin;
use Illuminate\Http\Request;
use App\Models\GoForAgileOkrs;
use Illuminate\Support\Facades\Session;

class ApiOKRsController extends Controller
{
    /**
     * Funcion que guarda el avance de un KR
     * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
     * @since 11/10/2024
     * @version 1.0
     * @param $request
     * @return $respuesta
     */

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
 
     /**
      * Funcion que guarda el avance de una iniciativa
      * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
      * @since 11/10/2024
      * @version 1.0
      * @param $request
      * @return $respuesta
      */
 
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
 
     /**
      * Funcion que organiza la información de una iniciativa para mostrarla en un modal
      * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
      * @since 11/10/2024
      * @version 1.0
      * @param $request
      * @return array $cuerpo
      */
 
     public function VerIniciativa(Request $request)
     {
         $nombreIniciativa = $fechaEntrega = $meta = $idTendencia = $responsables = $responsables1 = "";
         $requerido = 0;
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
                 $requerido = 1;
             }
         }
 
         // dd($meta);
 
         $header = '<div class="row">
                         <div class="col-md-12">
                             <h5>Iniciativa para el KR: ' . $nombreKr . '</h5>
                         </div>
                     </div>';
 
         $tendencia = '<label>Tendencia *</label>
                     <select class="form-control " name="tendencia_ini" id="tendencia_ini" required>
                     <option value="">Seleccione...</option>
         ';
 
         $selectTendencia = GoForAgileAdmin::Tendencia();
 
         $listaResponsables = GoForAgileOkrs::ListaResponsables($idOkr);
 
         if ($requerido == 0) {
             $required = 'required';
         } else {
             $required = '';
         }
         $selectResponsable = '<label>Responsable(s) *</label>
                     <select class="form-control " name="id_responsable_ini" id="id_responsable_ini" ' . $required . '>
                     <option value="">Seleccione responsable...</option>
         ';
         foreach ($listaResponsables as $responsable) {
             $selectResponsable .= '<option value="' . $responsable->id_empleado . '">' . $responsable->nombre_empleado . '</option>
         ';
         }
 
         if ($responsables1) {
             $array_responsables = explode(",", $responsables1);
             foreach ($array_responsables as $responsable) {
                 if ($responsable) {
                     $queryResp = GoForAgileAdmin::EmpleadoId($responsable);
                     foreach ($queryResp as $resp) {
                         $idResponsable = $resp->id;
                         $nombreResponsable = $resp->nombre;
                     }
                     $responsables .= '<div id="resp_ini_' . $idResponsable . '"> <i class="icon-bin" onClick="Eliminar_Responsable(' . $idResponsable . ')"></i> <b>' . $nombreResponsable . '</b> <input type="hidden" name="responsables_ini[]" value="' . $idResponsable . '" ></div> ';
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
             "id_resultado_ini" => $request->idResultado,
             "id_registro_ini" => $request->idIniciativa,
             "id_okrs_ini" => $idOkr,
             "header_ini" => $header,
             'descripcion_ini' => $nombreIniciativa,
             "fecha_entrega_ini" => $fechaEntrega,
             "meta_ini" => $meta,
             "tendencia_ini" => $tendencia,
             "responsables_ini" => $selectResponsable,
             "divResponsables_ini" => $responsables,
             "pagina_ini" => $request->pagina_ini,
             "requerido_ini" => $requerido
         );
         return $cuerpo;
     }
 
     /**
      * Funcion que organiza la información de un KR para mostrarla en un modal
      * @author JULIAN ORJUELA <jorjuela@changeamericas.copm>
      * @since 11/10/2024
      * @version 1.0
      * @param $request
      * @return array $cuerpo
      */
 
     public function VerKr(Request $request)
     {
         $nombreResultado = $fechaEntrega = $fechaInicia = $idMedicion = $meta = $metaMinima = $metaMaxima = $idPeriodo = $idTendencia = $responsables = $responsables1 = "";
         $requerido = 0;
         $kr = GoForAgileOkrs::Okrs($request->idOkr);
         foreach ($kr as $value) {
             $nombreOkr = $value->objetivo_okr;
         }
         $resultado = GoForAgileOkrs::KrId($request->idResultado);
         if ($resultado) {
             foreach ($resultado as $value) {
                 $nombreResultado = $value->descripcion;
                 $fechaEntrega = $value->fecha_entrega;
                 $fechaInicia = $value->fecha_inicia;
                 $idMedicion = $value->medicion;
                 $meta = $value->meta;
                 $metaMinima = $value->meta_minimo;
                 $metaMaxima = $value->meta_maximo;
                 $idTendencia = $value->tendencia;
                 $idPeriodo = $value->periodo;
                 $responsables1 = $value->responsables;
                 $requerido = 1;
                 $idOkr = $value->id_okrs;
             }
         }
 
         $header = '<div class="row">
                         <div class="col-md-12">
                             <h5>KR para el OKR: ' . $nombreOkr . '</h5>
                         </div>
                     </div>';
 
         $tendencia = '<label>Tendencia *</label>
                     <select class="form-control " name="tendencia_kr" id="tendencia_kr" required>
                     <option value="">Seleccione...</option>
         ';
 
         $periodo = '<label>Periodo *</label>
                     <select class="form-control " name="periodo_kr" id="periodo_kr" required>
                     <option value="">Seleccione...</option>
         ';
 
         $medicion = '<label>Meidición *</label>
                     <select class="form-control " name="medicion_kr" id="medicion_kr" required>
                     <option value="">Seleccione...</option>
         ';
 
         $selectTendencia = GoForAgileAdmin::Tendencia();
 
         $selectPeriodo = GoForAgileAdmin::Periodo();
 
         $selectMedicion = GoForAgileAdmin::Medicion();
 
         $listaResponsables = GoForAgileOkrs::ListaResponsables($request->idOkr);
 
         if ($requerido == 0) {
             $required = 'required';
         } else {
             $required = '';
         }
         $selectResponsable = '<label>Responsable(s) *</label>
                     <select class="form-control " name="id_responsable" id="id_responsable" ' . $required . '>
                     <option value="">Seleccione responsable...</option>
         ';
         foreach ($listaResponsables as $responsable) {
             $selectResponsable .= '<option value="' . $responsable->id_empleado . '">' . $responsable->nombre_empleado . '</option>
         ';
         }
 
         if ($responsables1) {
             $array_responsables = explode(",", $responsables1);
             foreach ($array_responsables as $responsable) {
                 if ($responsable) {
                     $queryResp = GoForAgileAdmin::EmpleadoId($responsable);
                     foreach ($queryResp as $resp) {
                         $idResponsable = $resp->id;
                         $nombreResponsable = $resp->nombre;
                     }
                     $responsables .= '<div id="resp_' . $idResponsable . '"> <i class="icon-bin" onClick="Eliminar_Responsable(' . $idResponsable . ')"></i> <b>' . $nombreResponsable . '</b> <input type="hidden" name="responsables_kr[]" value="' . $idResponsable . '" ></div> ';
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
 
         foreach ($selectPeriodo as $select) {
             // dd($select); 
             if ($idPeriodo != "") {
                 $periodo .= '<option value="' . $select[0] . '" selected>' . $select[1] . '</option>';
             } else {
                 $periodo .= '<option value="' . $select[0] . '">' . $select[1] . '</option>';
             }
         }
 
         foreach ($selectMedicion as $select) {
             // dd($select); 
             if ($idMedicion != "") {
                 $medicion .= '<option value="' . $select[0] . '" selected>' . $select[1] . '</option>';
             } else {
                 $medicion .= '<option value="' . $select[0] . '">' . $select[1] . '</option>';
             }
         }
 
         $cuerpo = array(
             "id_resultado" => $request->idResultado,
             "id_okr_kr" => $idOkr,
             "header_kr" => $header,
             "descripcion_kr" => $nombreResultado,
             "fecha_inicia_kr" => $fechaInicia,
             "fecha_entrega_kr" => $fechaEntrega,
             "meta_kr" => $meta,
             "meta_minima_kr" => $metaMinima,
             "meta_maxima_kr" => $metaMaxima,
             "tendencia_kr" => $tendencia,
             "periodo_kr" => $periodo,
             "medicion_kr" => $medicion,
             "responsables_kr" => $selectResponsable,
             "divResponsables_kr" => $responsables,
             "pagina_kr" => $request->pagina_kr,
             "requerido_kr" => $requerido
         );
         return $cuerpo;
     }
}
