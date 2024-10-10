<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class GoForAgileOkrs extends Model
{
    protected $connection = 'mysql-goforagile_okrs';

    //OKRS
    public static function OkrsOrganizacion($id_empresa, $porPagina, $offset)
    {
        $adicional = "";
        if ($porPagina) {
            $adicional .= " LIMIT $porPagina";
        }
        if ($offset) {
            $adicional .= " OFFSET $offset";
        }
        $filtro = $filtro_usuario = "";
        if (Session::get('okr_fill') > 0) {
            $filtro .= " AND Okrs_Equipos.id_okrs = '" . Session::get('okr_fill') . "' ";
        }
        if (Session::get('responsable_fill') > 0) {
            $filtro_usuario = " AND Okrs_Equipos.id_empleado = '" . Session::get('responsable_fill') . "'  ";
            $filtro_usuario .= " AND Okrs_Resultados.responsables LIKE '%" . Session::get('responsable_fill') . "%'  ";
        }
        if (Session::get('areas_fill') > 0) {
            $filtro .= " AND Okrs_Areas.id_area = '" . Session::get('areas_fill') . "'  ";            
        }
    
        if (Session::get('tipo_okr_fill') > 0) {
            $filtro .= " AND Okrs.tipo = '" . Session::get('tipo_okr_fill') . "'  ";
        }
    
        if (Session::get('vicepresidencia_fill') > 0) {
            $filtro .= " AND Okrs_Areas.id_vicepresidencia = " . Session::get('vicepresidencia_fill') . "  ";
        }

        if (Session::get('periodo_fill') != '') {
            $filtro .= " AND Okrs_Resultados.periodo IN (" . Session::get('periodo_fill') . ") ";
        }

        DB::setDefaultConnection("mysql-goforagile_okrs");
        
        $OkrsOrganizacion = DB::Select("
		SELECT Okrs_Equipos.id AS id, Okrs_Equipos.id_empresa AS id_empresa , 
		Okrs_Equipos.id_empleado AS id_empleado , Okrs_Equipos.id_okrs AS id_okrs , 
		Okrs.objetivo_okr AS objetivo_okr , Okrs.fecha_inicia AS fecha_inicia, 
		Okrs.fecha_termina AS fecha_termina , Okrs.tipo AS tipo, Okrs.periodo AS periodo, 
		Okrs.objetivos_estrategicos AS objetivos_estrategicos, Okrs.anio AS anio, Okrs_Equipos.tipo AS tipo_role,  
		Empleados.nombre AS nombre_empleado, Okrs.id_empleado AS id_owner, EO.nombre AS nombre_owner
		FROM Okrs_Equipos
		LEFT JOIN Okrs ON Okrs.id = Okrs_Equipos.id_okrs 
		LEFT JOIN Okrs_Areas ON Okrs_Areas.id_okrs = Okrs_Equipos.id_okrs
		LEFT JOIN Okrs_Resultados ON Okrs_Resultados.id_okrs = Okrs_Equipos.id_okrs
		LEFT JOIN goforagile_admin.Empleados AS Empleados ON Empleados.id = Okrs_Equipos.id_empleado
		LEFT JOIN goforagile_admin.Empleados AS EO ON EO.id = Okrs.id_empleado		
		WHERE Okrs_Equipos.id_empresa = $id_empresa
        AND Okrs.anio = ".Session::get('anio_fill')."
        $filtro
        $filtro_usuario
        GROUP BY Okrs.id
		ORDER BY Okrs.objetivo_okr ASC
        $adicional       
		");
        return $OkrsOrganizacion;
    }
    public static function Okrs($id)
    {
        DB::setDefaultConnection("mysql-goforagile_okrs");
        $Okrs = DB::Select("SELECT * FROM Okrs WHERE id = $id");
        return $Okrs;
    }

    public static function SelectOkrs($id, $anio){
        $SelectOkrs = array();
        $SelectOkrs[''] = 'Seleccione Okr:';
        DB::setDefaultConnection("mysql-goforagile_okrs");
        $selectOkrs = DB::Select("SELECT * FROM Okrs WHERE id_empresa = $id AND anio = $anio AND estado = 1 ORDER BY objetivo_okr ASC");
        foreach($selectOkrs as $okr){
            $SelectOkrs[$okr->id] = $okr->objetivo_okr;
        }

        return $SelectOkrs;
    }


    //OBJETIVOS ESTRATEGICOS
    public static function SelectObjEstrategico($id, $anio){
        $objEstrategicos = array();
        $objEstrategicos[''] = 'Seleccione Objetivo Estratégico:';
        DB::setDefaultConnection("mysql-goforagile_okrs");
        $selectOES = DB::Select("SELECT * FROM Objetivos_Estrategicos WHERE id_empresa = $id AND anio = $anio AND estado = 1  ORDER BY objetivo");
        foreach($selectOES as $oe){
            $objEstrategicos[$oe->id] = $oe->objetivo;
        }

        return $objEstrategicos;
    }


    //RESULTADOS
    public static function ResultadosOKR($id_okr)
    {
        $suma_resultado = 0;
        $conteo_resultado = 0;
        $resultado_prom_okr = 0;
        $filtro = "";
        if (Session::get('periodo_fill') != '') {
            $filtro .= " AND periodo IN (" . Session::get('periodo_fill') . ") ";
        }
        DB::setDefaultConnection("mysql-goforagile_okrs");
        $ResultadosOKR = DB::Select("SELECT * FROM Okrs_Resultados WHERE id_okrs = $id_okr $filtro");
        // dd($ResultadosOKR);
        foreach ($ResultadosOKR as $resultado) {
            $avance = (int)$resultado->avance;
            $meta = (int)$resultado->meta;
            if ($meta > 0) {
                $porcentaje = ($avance * 100) / $meta;
            } else {
                $porcentaje = 0;
            }
            $suma_resultado += $porcentaje;
            $conteo_resultado++;
        }
        if ($suma_resultado > 0) {
            $resultado_prom_okr = ($suma_resultado / $conteo_resultado);
        } else {
            $resultado_prom_okr += 0;
        }

        $nodo = array(
            "promedio" => $resultado_prom_okr,
            "no_resultados" => count($ResultadosOKR)
        );

        return $nodo;
    }

    public static function OrderResultados($id_okr)
    {
        DB::setDefaultConnection("mysql-goforagile_okrs");
        $ResultadosOKR = DB::Select("SELECT * FROM Okrs_Resultados WHERE id_okrs = $id_okr AND orden IS NULL");
        $array_resultados = array();
        $contRes = 0;
        foreach ($ResultadosOKR as $row) {
            $array_resultados[$contRes]['id'] = $row->id;
            $array_resultados[$contRes]['orden'] = $row->orden;
            $contRes++;
            for ($i = 0; $i < count($array_resultados); $i++) {
                $j = $i + 1;
                DB::Update("UPDATE Okrs_Resultados SET orden = $j WHERE id = '" . $array_resultados[$i]['id'] . "' ");
            }
        }
    }

    public static function ResultadosOKRFiltro($id_okr, $filtro)
    {
        DB::setDefaultConnection("mysql-goforagile_okrs");
        $ResultadosOKR = DB::Select("SELECT * FROM Okrs_Resultados WHERE id_okrs = $id_okr $filtro ORDER BY orden ASC");
        return $ResultadosOKR;
    }

    public static function ComentariosKR($idResultado)
    {
        DB::setDefaultConnection("mysql-goforagile_okrs");
        $ComentariosKR = DB::Select("SELECT * FROM Okrs_Comentarios WHERE id_resultado = $idResultado");
        return $ComentariosKR;
    }

    public static function GuardarAvanceKr($idKr, $avance, $idOkr, $idEmpresa, $idUser){
        $hoy = date("Y-m-d H:i:s");
        DB::setDefaultConnection("mysql-goforagile_okrs");
        $resultado = DB::Select("SELECT * FROM Okrs_Resultados WHERE id = $idKr");
        foreach($resultado as $kr){
            $descripcionKr = $kr->descripcion;
            $avanceKr = $kr->avance;
        }

        $Okrs = DB::Select("SELECT * FROM Okrs WHERE id = $idOkr");
        foreach($Okrs as $okr){
            $tipoOkr = $okr->tipo;
        }

        $descripcion = "Actualización de avance de KR $descripcionKr del $avanceKr al $avance";
        DB::Insert("INSERT INTO Auditoria_Okrs (id_empresa,id_empleado,accion,descripcion,tipo_okr,id_okr,id_kr,id_iniciativa,created_at)
        VALUES ($idEmpresa, $idUser, 'ACTUALIZAR', '$descripcion', $tipoOkr, $idOkr, $idKr, 0, '$hoy')");

        $GuardarAvanceKr = DB::Update("UPDATE Okrs_Resultados SET avance = '$avance' WHERE id = $idKr");

        return $GuardarAvanceKr;
        
    }

    public static function KrId($id){
        DB::setDefaultConnection("mysql-goforagile_okrs");
        $KrId = DB::Select("SELECT * FROM Okrs_Resultados WHERE id = $id");
        return $KrId;
    }

    public static function ActualizarKr($id_empresa,$id_user,$array_kr){
        $hoy = date("Y-m-d H:i:s");
        DB::setDefaultConnection("mysql-goforagile_okrs");
        // dd($array_kr);
        $Okrs = DB::Select("SELECT * FROM Okrs WHERE id = ".$array_kr->id_okr_kr."");
        foreach($Okrs as $okr){
            $tipoOkr = $okr->tipo;
        }
        $resultados = DB::Select("SELECT * FROM Okrs_Resultados WHERE id = ".$array_kr->id_resultado."");
        foreach($resultados as $kr){
            $descResultado = $kr->descripcion;
        }
        $ActualizarKr = DB::Update('UPDATE Okrs_Resultados SET id_empleado = ?, responsables = ?, descripcion = ?, fecha_inicia = ?,fecha_entrega = ?, medicion = ?,meta = ?,meta_minimo = ?, meta_maximo = ?, periodo = ?, tendencia = ?, updated_at = ?
        WHERE id = ?',[$id_user, implode(",", $array_kr->responsables_kr),$array_kr->descripcion_kr, $array_kr->fecha_inicia_kr,$array_kr->fecha_entrega_kr,
        $array_kr->medicion_kr,$array_kr->meta_kr,$array_kr->meta_minima_kr,$array_kr->meta_maxima_kr,$array_kr->periodo_kr,$array_kr->tendencia_kr,$hoy,$array_kr->id_resultado]);
        
        $descripcion = "Actualización de Kr $descResultado" ;
        DB::Insert("INSERT INTO Auditoria_Okrs (id_empresa,id_empleado,accion,descripcion,tipo_okr,id_okr,id_kr,id_iniciativa,created_at)
        VALUES ($id_empresa, $id_user, 'ACTUALIZAR', '$descripcion', $tipoOkr, ".$array_kr->id_okr_kr.", ".$array_kr->id_resultado.", 0, '$hoy')");

        return $ActualizarKr;
    }

    //INICIATIVAS
    public static function IniciativasKR($id)
    {
        DB::setDefaultConnection("mysql-goforagile_okrs");
        $ResultadosOKR = DB::Select("SELECT * FROM Okrs_Iniciativas WHERE id_resultado = $id");
        return $ResultadosOKR;
    }

    public static function IniciativasID($id)
    {
        DB::setDefaultConnection("mysql-goforagile_okrs");
        $IniciativasID = DB::Select("SELECT * FROM Okrs_Iniciativas WHERE id = $id");
        return $IniciativasID;
    }

    public static function PlanesIniciativa($id)
    {
        DB::setDefaultConnection("mysql-goforagile_okrs");
        $PlanesIniciativa = DB::Select("SELECT * FROM Okrs_Actividades WHERE id_iniciativa = $id ");
        return $PlanesIniciativa;
    }

    public static function PlanesIniciativaRealizado($id)
    {
        DB::setDefaultConnection("mysql-goforagile_okrs");
        $PlanesIniciativaRealizado = DB::Select("SELECT * FROM Okrs_Actividades WHERE id_iniciativa = $id AND checked = 'true'");
        return $PlanesIniciativaRealizado;
    }

    public static function DocumentosIniciativa($id)
    {
        DB::setDefaultConnection("mysql-goforagile_okrs");
        $DocumentosIniciativa = DB::Select("SELECT * FROM Okrs_Documentos WHERE id_iniciativa = $id");
        return $DocumentosIniciativa;
    }

    public static function ComentariosIniciativa($id)
    {
        DB::setDefaultConnection("mysql-goforagile_okrs");
        $ComentariosIniciativa = DB::Select("SELECT * FROM Okrs_Comentarios_Iniciativas WHERE id_iniciativa = $id");
        return $ComentariosIniciativa;
    }

    public static function ActualizaTendenciaIniciativa($tendencia,$id){
        DB::setDefaultConnection("mysql-goforagile_okrs");
        DB::Update("UPDATE Okrs_Iniciativas SET tendencia = $tendencia, updated_at = NOW() WHERE id = $id");
    }

    public static function GuardarAvanceIniciativa($id, $idKr, $avance, $idOkr, $idEmpresa, $idUser){
        $hoy = date("Y-m-d H:i:s");
        DB::setDefaultConnection("mysql-goforagile_okrs");
        $iniciativas = DB::Select("SELECT * FROM Okrs_Iniciativas WHERE id = $id");
        foreach($iniciativas as $iniciativa){
            $descripcionIni = $iniciativa->descripcion;
            $avanceIni = $iniciativa->avance;
        }

        $Okrs = DB::Select("SELECT * FROM Okrs WHERE id = $idOkr");
        foreach($Okrs as $okr){
            $tipoOkr = $okr->tipo;
        }

        $descripcion = "Actualización de avance de iniciativa $descripcionIni del $avanceIni al $avance";
        DB::Insert("INSERT INTO Auditoria_Okrs (id_empresa,id_empleado,accion,descripcion,tipo_okr,id_okr,id_kr,id_iniciativa,created_at)
        VALUES ($idEmpresa, $idUser, 'ACTUALIZAR', '$descripcion', $tipoOkr, $idOkr, $idKr, $id, '$hoy')");

        $GuardarAvanceIniciativa = DB::Update("UPDATE Okrs_Iniciativas SET avance = '$avance' WHERE id = $id");

        return $GuardarAvanceIniciativa;
    }

    public static function CrearIniciativa($id_empresa,$id_user,$array_iniciativa){
        $hoy = date("Y-m-d H:i:s");
        DB::setDefaultConnection("mysql-goforagile_okrs");
        // dd($array_iniciativa);
        $Okrs = DB::Select("SELECT * FROM Okrs WHERE id = ".$array_iniciativa->id_okr_ini."");
        foreach($Okrs as $okr){
            $tipoOkr = $okr->tipo;
        }
        $resultados = DB::Select("SELECT * FROM Okrs_Resultados WHERE id = ".$array_iniciativa->id_resultado_ini."");
        foreach($resultados as $kr){
            $descResultado = $kr->descripcion;
        }
        $CrearIniciativa = DB::Insert('INSERT INTO Okrs_Iniciativas (id_okrs, id_resultado, id_empleado, responsables, descripcion, fecha_entrega, meta, tendencia, created_at)
        VALUES(?,?,?,?,?,?,?,?,?)',[$array_iniciativa->id_okr_ini,$array_iniciativa->id_resultado_ini,$id_user, implode(",", $array_iniciativa->responsables_ini),$array_iniciativa->descripcion_ini,
        $array_iniciativa->fecha_entrega_ini,$array_iniciativa->meta_ini,$array_iniciativa->tendencia_ini,$hoy]);

        $id = DB::getPdo()->lastInsertId();
        
        $descripcion = "Creación de iniciativa $array_iniciativa->descripcion para el resultado $descResultado" ;
        DB::Insert("INSERT INTO Auditoria_Okrs (id_empresa,id_empleado,accion,descripcion,tipo_okr,id_okr,id_kr,id_iniciativa,created_at)
        VALUES ($id_empresa, $id_user, 'CREAR', '$descripcion', $tipoOkr, ".$array_iniciativa->id_okr_ini.", ".$array_iniciativa->id_resultado_ini.", $id, '$hoy')");

        return $CrearIniciativa;
    }

    public static function ActualizarIniciativa($id_empresa,$id_user,$array_iniciativa){
        $hoy = date("Y-m-d H:i:s");
        DB::setDefaultConnection("mysql-goforagile_okrs");
        // dd($array_iniciativa);
        $Okrs = DB::Select("SELECT * FROM Okrs WHERE id = ".$array_iniciativa->id_okr_ini."");
        foreach($Okrs as $okr){
            $tipoOkr = $okr->tipo;
        }
        $resultados = DB::Select("SELECT * FROM Okrs_Resultados WHERE id = ".$array_iniciativa->id_resultado_ini."");
        foreach($resultados as $kr){
            $descResultado = $kr->descripcion;
        }
        $ActualizarIniciativa = DB::Update('UPDATE Okrs_Iniciativas SET id_empleado = ?, responsables = ?, descripcion = ?, fecha_entrega = ?, meta = ?, tendencia = ?, updated_at = ?
        WHERE id = ?',[$id_user, implode(",", $array_iniciativa->responsables_ini),$array_iniciativa->descripcion_ini, $array_iniciativa->fecha_entrega_ini,$array_iniciativa->meta_ini,$array_iniciativa->tendencia_ini,$hoy,$array_iniciativa->id_iniciativa]);
        
        $descripcion = "Actualización de iniciativa $array_iniciativa->descripcion_ini para el resultado $descResultado" ;
        DB::Insert("INSERT INTO Auditoria_Okrs (id_empresa,id_empleado,accion,descripcion,tipo_okr,id_okr,id_kr,id_iniciativa,created_at)
        VALUES ($id_empresa, $id_user, 'ACTUALIZAR', '$descripcion', $tipoOkr, ".$array_iniciativa->id_okr_ini.", ".$array_iniciativa->id_resultado_ini.", $array_iniciativa->id_iniciativa, '$hoy')");

        return $ActualizarIniciativa;
    }


    //EXTRAS
    public static function SelectResponsables($idUser, $idEmpresa){
        DB::setDefaultConnection("mysql-goforagile_okrs");
        $equiposViews = DB::Select("SELECT * FROM Equipos_Views WHERE id_empresa = $idEmpresa AND id_empleado = $idUser");
        $OR_FILL = "";
        if($equiposViews){
            foreach($equiposViews as $EV){
                if ($OR_FILL == "") {
                    $OR_FILL = " OE.id_okrs = $EV->id_okrs";
                } else {
                    $OR_FILL .= " OR OE.id_okrs = $EV->id_okrs";
                }
            }
        }
        $filtroResponsables = array();
        $filtroResponsables[''] = 'Seleccione Responsable:';
        $queryColFiltro = DB::Select("SELECT OE.id_empleado, E.nombre
        FROM Okrs_Equipos OE
	    INNER JOIN goforagile_admin.Empleados E ON E.id = OE.id_empleado
        WHERE OE.id_empresa = $idEmpresa AND (" . $OR_FILL . ") GROUP BY OE.id_empleado ORDER BY E.nombre");

        foreach($queryColFiltro as $conFiltro){
            $empleado = GoForAgileAdmin::EmpleadoId($conFiltro->id_empleado);
            foreach($empleado as $em){
                $filtroResponsables[$em->id] = $em->nombre;
            }
        }

        return $filtroResponsables;

    }

    public static function SelectTipoOkr(){
        $TipoOkr = array();
        $TipoOkr[''] = 'Seleccione Tipo Okr:';
        $TipoOkr[2]  = 'Equipo';
        $TipoOkr[1]  = 'Organizacional';
        return $TipoOkr;
    }

    public static function ListaResponsables($idOkr){
        DB::setDefaultConnection("mysql-goforagile_okrs");
        $ListaResponsables = DB::Select("SELECT * FROM Equipos_Views WHERE id_okrs = $idOkr ORDER BY nombre_empleado ASC ");
        return $ListaResponsables;  
    }
}
