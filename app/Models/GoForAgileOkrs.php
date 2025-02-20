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


        $OkrsOrganizacion = DB::connection('mysql-goforagile_okrs')->select("
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
        AND Okrs.anio = " . Session::get('anio_fill') . "
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

        $Okrs = DB::connection('mysql-goforagile_okrs')->select("SELECT * FROM Okrs WHERE id = $id");
        return $Okrs;
    }

    public static function SelectOkrs($id, $anio)
    {
        $SelectOkrs = array();
        $SelectOkrs[''] = 'Seleccione Okr:';

        $selectOkrs = DB::connection('mysql-goforagile_okrs')->select("SELECT * FROM Okrs WHERE id_empresa = $id AND anio = $anio AND estado = 1 ORDER BY objetivo_okr ASC");
        foreach ($selectOkrs as $okr) {
            $SelectOkrs[$okr->id] = $okr->objetivo_okr;
        }

        return $SelectOkrs;
    }


    //OBJETIVOS ESTRATEGICOS
    public static function SelectObjEstrategico($id, $anio)
    {
        $objEstrategicos = array();
        $objEstrategicos[''] = 'Seleccione Objetivo Estratégico:';

        $selectOES = DB::connection('mysql-goforagile_okrs')->select("SELECT * FROM Objetivos_estrategicos WHERE id_empresa = $id AND anio = $anio AND estado = 1  ORDER BY objetivo");
        foreach ($selectOES as $oe) {
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

        $ResultadosOKR = DB::connection('mysql-goforagile_okrs')->select("SELECT * FROM Okrs_Resultados WHERE id_okrs = $id_okr $filtro");
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

        $ResultadosOKR = DB::connection('mysql-goforagile_okrs')->select("SELECT * FROM Okrs_Resultados WHERE id_okrs = $id_okr AND orden IS NULL");
        $array_resultados = array();
        $contRes = 0;
        foreach ($ResultadosOKR as $row) {
            $array_resultados[$contRes]['id'] = $row->id;
            $array_resultados[$contRes]['orden'] = $row->orden;
            $contRes++;
            for ($i = 0; $i < count($array_resultados); $i++) {
                $j = $i + 1;
                DB::connection('mysql-goforagile_okrs')->update("UPDATE Okrs_Resultados SET orden = $j WHERE id = '" . $array_resultados[$i]['id'] . "' ");
            }
        }
    }

    public static function ResultadosOKRFiltro($id_okr, $filtro)
    {

        $ResultadosOKR = DB::connection('mysql-goforagile_okrs')->select("SELECT * FROM Okrs_Resultados WHERE id_okrs = $id_okr $filtro ORDER BY orden ASC");
        return $ResultadosOKR;
    }

    public static function ComentariosKR($idResultado)
    {

        $ComentariosKR = DB::connection('mysql-goforagile_okrs')->select("SELECT * FROM Okrs_Comentarios WHERE id_resultado = $idResultado");
        return $ComentariosKR;
    }

    public static function GuardarAvanceKr($idKr, $avance, $idOkr, $idEmpresa, $idUser)
    {
        $hoy = date("Y-m-d H:i:s");

        $resultado = DB::connection('mysql-goforagile_okrs')->select("SELECT * FROM Okrs_Resultados WHERE id = $idKr");
        foreach ($resultado as $kr) {
            $descripcionKr = $kr->descripcion;
            $avanceKr = $kr->avance;
        }

        $Okrs = DB::connection('mysql-goforagile_okrs')->select("SELECT * FROM Okrs WHERE id = $idOkr");
        foreach ($Okrs as $okr) {
            $tipoOkr = $okr->tipo;
        }

        $descripcion = "Actualización de avance de KR $descripcionKr del $avanceKr al $avance";
        DB::connection('mysql-goforagile_okrs')->insert("INSERT INTO Auditoria_Okrs (id_empresa,id_empleado,accion,descripcion,tipo_okr,id_okr,id_kr,id_iniciativa,created_at)
        VALUES ($idEmpresa, $idUser, 'ACTUALIZAR', '$descripcion', $tipoOkr, $idOkr, $idKr, 0, '$hoy')");

        $GuardarAvanceKr = DB::connection('mysql-goforagile_okrs')->update("UPDATE Okrs_Resultados SET avance = '$avance' WHERE id = $idKr");

        return $GuardarAvanceKr;
    }

    public static function KrId($id)
    {

        $KrId = DB::connection('mysql-goforagile_okrs')->select("SELECT * FROM Okrs_Resultados WHERE id = $id");
        return $KrId;
    }

    public static function ActualizarKr($id_empresa, $id_user, $array_kr)
    {
        $hoy = date("Y-m-d H:i:s");

        // dd($array_kr);
        $Okrs = DB::connection('mysql-goforagile_okrs')->select("SELECT * FROM Okrs WHERE id = " . $array_kr->id_okr_kr . "");
        foreach ($Okrs as $okr) {
            $tipoOkr = $okr->tipo;
        }
        $resultados = DB::connection('mysql-goforagile_okrs')->select("SELECT * FROM Okrs_Resultados WHERE id = " . $array_kr->id_resultado . "");
        foreach ($resultados as $kr) {
            $descResultado = $kr->descripcion;
        }
        $ActualizarKr = DB::connection('mysql-goforagile_okrs')->update('UPDATE Okrs_Resultados SET id_empleado = ?, responsables = ?, descripcion = ?, fecha_inicia = ?,fecha_entrega = ?, medicion = ?,meta = ?,meta_minimo = ?, meta_maximo = ?, periodo = ?, tendencia = ?, updated_at = ?
        WHERE id = ?', [
            $id_user,
            implode(",", $array_kr->responsables_kr),
            $array_kr->descripcion_kr,
            $array_kr->fecha_inicia_kr,
            $array_kr->fecha_entrega_kr,
            $array_kr->medicion_kr,
            $array_kr->meta_kr,
            $array_kr->meta_minima_kr,
            $array_kr->meta_maxima_kr,
            $array_kr->periodo_kr,
            $array_kr->tendencia_kr,
            $hoy,
            $array_kr->id_resultado
        ]);

        $descripcion = "Actualización de Kr $descResultado";
        DB::connection('mysql-goforagile_okrs')->insert("INSERT INTO Auditoria_Okrs (id_empresa,id_empleado,accion,descripcion,tipo_okr,id_okr,id_kr,id_iniciativa,created_at)
        VALUES ($id_empresa, $id_user, 'ACTUALIZAR', '$descripcion', $tipoOkr, " . $array_kr->id_okr_kr . ", " . $array_kr->id_resultado . ", 0, '$hoy')");

        return $ActualizarKr;
    }

    //INICIATIVAS
    public static function IniciativasKR($id)
    {

        $ResultadosOKR = DB::connection('mysql-goforagile_okrs')->select("SELECT * FROM Okrs_Iniciativas WHERE id_resultado = $id");
        return $ResultadosOKR;
    }

    public static function IniciativasID($id)
    {

        $IniciativasID = DB::connection('mysql-goforagile_okrs')->select("SELECT * FROM Okrs_Iniciativas WHERE id = $id");
        return $IniciativasID;
    }

    public static function PlanesIniciativa($id)
    {

        $PlanesIniciativa = DB::connection('mysql-goforagile_okrs')->select("SELECT * FROM Okrs_Actividades WHERE id_iniciativa = $id ");
        return $PlanesIniciativa;
    }

    public static function PlanesIniciativaRealizado($id)
    {

        $PlanesIniciativaRealizado = DB::connection('mysql-goforagile_okrs')->select("SELECT * FROM Okrs_Actividades WHERE id_iniciativa = $id AND checked = 'true'");
        return $PlanesIniciativaRealizado;
    }

    public static function DocumentosIniciativa($id)
    {

        $DocumentosIniciativa = DB::connection('mysql-goforagile_okrs')->select("SELECT * FROM Okrs_Documentos WHERE id_iniciativa = $id");
        return $DocumentosIniciativa;
    }

    public static function ComentariosIniciativa($id)
    {

        $ComentariosIniciativa = DB::connection('mysql-goforagile_okrs')->select("SELECT * FROM Okrs_Comentarios_Iniciativas WHERE id_iniciativa = $id");
        return $ComentariosIniciativa;
    }

    public static function ActualizaTendenciaIniciativa($tendencia, $id)
    {

        DB::connection('mysql-goforagile_okrs')->update("UPDATE Okrs_Iniciativas SET tendencia = $tendencia, updated_at = NOW() WHERE id = $id");
    }

    public static function GuardarAvanceIniciativa($id, $idKr, $avance, $idOkr, $idEmpresa, $idUser)
    {
        $hoy = date("Y-m-d H:i:s");

        $iniciativas = DB::connection('mysql-goforagile_okrs')->select("SELECT * FROM Okrs_Iniciativas WHERE id = $id");
        foreach ($iniciativas as $iniciativa) {
            $descripcionIni = $iniciativa->descripcion;
            $avanceIni = $iniciativa->avance;
        }

        $Okrs = DB::connection('mysql-goforagile_okrs')->select("SELECT * FROM Okrs WHERE id = $idOkr");
        foreach ($Okrs as $okr) {
            $tipoOkr = $okr->tipo;
        }

        $descripcion = "Actualización de avance de iniciativa $descripcionIni del $avanceIni al $avance";
        DB::connection('mysql-goforagile_okrs')->insert("INSERT INTO Auditoria_Okrs (id_empresa,id_empleado,accion,descripcion,tipo_okr,id_okr,id_kr,id_iniciativa,created_at)
        VALUES ($idEmpresa, $idUser, 'ACTUALIZAR', '$descripcion', $tipoOkr, $idOkr, $idKr, $id, '$hoy')");

        $GuardarAvanceIniciativa = DB::connection('mysql-goforagile_okrs')->update("UPDATE Okrs_Iniciativas SET avance = '$avance' WHERE id = $id");

        return $GuardarAvanceIniciativa;
    }

    public static function CrearIniciativa($id_empresa, $id_user, $array_iniciativa)
    {
        $hoy = date("Y-m-d H:i:s");

        // dd($array_iniciativa);
        $Okrs = DB::connection('mysql-goforagile_okrs')->select("SELECT * FROM Okrs WHERE id = " . $array_iniciativa->id_okr_ini . "");
        foreach ($Okrs as $okr) {
            $tipoOkr = $okr->tipo;
        }
        $resultados = DB::connection('mysql-goforagile_okrs')->select("SELECT * FROM Okrs_Resultados WHERE id = " . $array_iniciativa->id_resultado_ini . "");
        foreach ($resultados as $kr) {
            $descResultado = $kr->descripcion;
        }
        $CrearIniciativa = DB::connection('mysql-goforagile_okrs')->insert('INSERT INTO Okrs_Iniciativas (id_okrs, id_resultado, id_empleado, responsables, descripcion, fecha_entrega, meta, tendencia, created_at)
        VALUES(?,?,?,?,?,?,?,?,?)', [
            $array_iniciativa->id_okr_ini,
            $array_iniciativa->id_resultado_ini,
            $id_user,
            implode(",", $array_iniciativa->responsables_ini),
            $array_iniciativa->descripcion_ini,
            $array_iniciativa->fecha_entrega_ini,
            $array_iniciativa->meta_ini,
            $array_iniciativa->tendencia_ini,
            $hoy
        ]);

        $id = DB::getPdo()->lastInsertId();

        $descripcion = "Creación de iniciativa $array_iniciativa->descripcion para el resultado $descResultado";
        DB::connection('mysql-goforagile_okrs')->insert("INSERT INTO Auditoria_Okrs (id_empresa,id_empleado,accion,descripcion,tipo_okr,id_okr,id_kr,id_iniciativa,created_at)
        VALUES ($id_empresa, $id_user, 'CREAR', '$descripcion', $tipoOkr, " . $array_iniciativa->id_okr_ini . ", " . $array_iniciativa->id_resultado_ini . ", $id, '$hoy')");

        return $CrearIniciativa;
    }

    public static function ActualizarIniciativa($id_empresa, $id_user, $array_iniciativa)
    {
        $hoy = date("Y-m-d H:i:s");

        // dd($array_iniciativa);
        $Okrs = DB::connection('mysql-goforagile_okrs')->select("SELECT * FROM Okrs WHERE id = " . $array_iniciativa->id_okr_ini . "");
        foreach ($Okrs as $okr) {
            $tipoOkr = $okr->tipo;
        }
        $resultados = DB::connection('mysql-goforagile_okrs')->select("SELECT * FROM Okrs_Resultados WHERE id = " . $array_iniciativa->id_resultado_ini . "");
        foreach ($resultados as $kr) {
            $descResultado = $kr->descripcion;
        }
        $ActualizarIniciativa = DB::connection('mysql-goforagile_okrs')->update('UPDATE Okrs_Iniciativas SET id_empleado = ?, responsables = ?, descripcion = ?, fecha_entrega = ?, meta = ?, tendencia = ?, updated_at = ?
        WHERE id = ?', [$id_user, implode(",", $array_iniciativa->responsables_ini), $array_iniciativa->descripcion_ini, $array_iniciativa->fecha_entrega_ini, $array_iniciativa->meta_ini, $array_iniciativa->tendencia_ini, $hoy, $array_iniciativa->id_iniciativa]);

        $descripcion = "Actualización de iniciativa $array_iniciativa->descripcion_ini para el resultado $descResultado";
        DB::connection('mysql-goforagile_okrs')->insert("INSERT INTO Auditoria_Okrs (id_empresa,id_empleado,accion,descripcion,tipo_okr,id_okr,id_kr,id_iniciativa,created_at)
        VALUES ($id_empresa, $id_user, 'ACTUALIZAR', '$descripcion', $tipoOkr, " . $array_iniciativa->id_okr_ini . ", " . $array_iniciativa->id_resultado_ini . ", $array_iniciativa->id_iniciativa, '$hoy')");

        return $ActualizarIniciativa;
    }


    //EXTRAS
    public static function SelectResponsables($idUser, $idEmpresa)
    {
        $equiposViews = DB::connection('mysql-goforagile_okrs')
            ->table('Equipos_Views')
            ->where('id_empresa', $idEmpresa)
            ->where('id_empleado', $idUser)
            ->get();

        $idsOkrs = $equiposViews->pluck('id_okrs'); // Obtén los ids de OKRs
        $filtroResponsables = ['' => 'Seleccione Responsable:'];

        $queryColFiltro = DB::connection('mysql-goforagile_okrs')
            ->table('Okrs_Equipos AS OE')
            ->join('goforagile_admin.Empleados AS E', 'E.id', '=', 'OE.id_empleado')
            ->where('OE.id_empresa', $idEmpresa)
            ->whereIn('OE.id_okrs', $idsOkrs) // Usa IN
            ->groupBy('OE.id_empleado')
            ->orderBy('E.nombre')
            ->get();

        foreach ($queryColFiltro as $conFiltro) {
            $empleado = GoForAgileAdmin::EmpleadoId($conFiltro->id_empleado);
            foreach ($empleado as $em) {
                $filtroResponsables[$em->id] = $em->nombre;
            }
        }

        return $filtroResponsables;
    }

    public static function SelectTipoOkr()
    {
        $TipoOkr = array();
        $TipoOkr[''] = 'Seleccione Tipo Okr:';
        $TipoOkr[2]  = 'Equipo';
        $TipoOkr[1]  = 'Organizacional';
        return $TipoOkr;
    }

    public static function ListaResponsables($idOkr)
    {

        $ListaResponsables = DB::connection('mysql-goforagile_okrs')->select("SELECT * FROM Equipos_Views WHERE id_okrs = ? ORDER BY nombre_empleado ASC ", [$idOkr]);
        return $ListaResponsables;
    }
}
