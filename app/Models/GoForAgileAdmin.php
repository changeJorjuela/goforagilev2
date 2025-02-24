<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GoForAgileAdmin extends Model
{
    protected $connection = 'mysql-goforagile_admin';

    // AREAS
    public static function ListarAreas($idEmpresa)
    {
        
        $areas = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Areas WHERE id_empresa = $idEmpresa ORDER BY nombre ASC");
        return $areas;
    }

    public static function ListarAreasActivo($idEmpresa)
    {
        
        $areas = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Areas WHERE id_empresa = $idEmpresa AND estado = 1 ORDER BY nombre ASC");
        return $areas;
    }

    public static function BuscarNombreArea($nombreArea, $idEmpresa)
    {
        
        $areas = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Areas WHERE nombre = '$nombreArea' AND id_empresa = $idEmpresa");
        return $areas;
    }

    public static function BuscarNombreAreaUpd($nombreArea, $id, $idEmpresa)
    {
        
        $areas = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Areas WHERE nombre = '$nombreArea' AND id NOT IN ($id) AND id_empresa = $idEmpresa");
        return $areas;
    }

    public static function CrearArea($nombreArea, $padre, $jerarquia, $idEmpresa,$idUser)
    {
        
        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i:s');
        $crearArea = DB::connection('mysql-goforagile_admin')->insert(
            'INSERT INTO Areas (nombre, padre, jerarquia, id_empresa, estado, created_at)
                                        VALUES (?,?,?,?,?,?)',
            [$nombreArea, $padre, $jerarquia, $idEmpresa, 1, $fecha_sistema]
        );
        $descripcion = "Creación de area $nombreArea";
        GoForAgileAdmin::Auditoria('CREAR',$descripcion,'Áreas',$idUser,$idEmpresa);
        return $crearArea;
    }

    public static function ActualizarArea($nombreArea, $padre, $jerarquia, $estado, $id,$idEmpresa,$idUser)
    {
        
        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i:s');
        $crearArea = DB::connection('mysql-goforagile_admin')->update(
            'UPDATE Areas SET nombre = ?, padre = ?, jerarquia = ?, estado = ?, updated_at = ? WHERE id = ?',
            [$nombreArea, $padre, $jerarquia, $estado, $fecha_sistema, $id]
        );
        $descripcion = "Actualización de area $nombreArea";
        GoForAgileAdmin::Auditoria('ACTUALIZAR',$descripcion,'Áreas',$idUser,$idEmpresa);
        return $crearArea;
    }

    public static function SelectArea($id)
    {
        $listArea = array();
        $listArea[''] = 'Seleccione Área:';
        
        $selectArea = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Areas WHERE id_empresa = $id AND estado = 1 ORDER BY nombre");
        foreach ($selectArea as $area) {
            $listArea[$area->id] = $area->nombre;
        }

        return $listArea;
    }

    public static function BuscarNombreAreaId($id)
    {
        
        $Areas = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Areas WHERE id = $id");
        return $Areas;
    }

    public static function EliminarArea($idArea, $idEmpresa, $idUser){
        
        date_default_timezone_set('America/Bogota');
        $area = GoForAgileAdmin::BuscarNombreAreaId($idArea);
        foreach($area as $value){
            $nombreArea = $value->nombre;
        }
        $eliminarArea = DB::connection('mysql-goforagile_admin')->insert(
            'DELETE FROM Areas WHERE id = ?',
            [$idArea]
        );
        $descripcion = "Eliminación de area $nombreArea";
        GoForAgileAdmin::Auditoria('ELIMINAR',$descripcion,'Áreas',$idUser,$idEmpresa);
        return $eliminarArea;
    }

    // CARGOS

    public static function ListarCargosActivo($idEmpresa)
    {
        
        $Cargos = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Cargos WHERE id_empresa = $idEmpresa AND estado = 1 ORDER BY nombre ASC");
        return $Cargos;
    }

    public static function ListarCargos($idEmpresa)
    {
        
        $Cargos = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Cargos WHERE id_empresa = $idEmpresa ORDER BY nombre ASC");
        return $Cargos;
    }

    public static function BuscarNombreCargo($nombreCargo, $idEmpresa)
    {
        
        $Cargos = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Cargos WHERE nombre = '$nombreCargo' AND id_empresa = $idEmpresa");
        return $Cargos;
    }

    public static function BuscarNombreCargoUpd($nombreCargo, $id, $idEmpresa)
    {
        
        $Cargos = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Cargos WHERE nombre = '$nombreCargo' AND id NOT IN ($id) AND id_empresa = $idEmpresa");
        return $Cargos;
    }

    public static function CrearCargo($nombreCargo, $area, $nivel_jerarquico, $idEmpresa,$idUser)
    {
        
        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i:s');
        $crearCargo = DB::connection('mysql-goforagile_admin')->insert(
            'INSERT INTO Cargos (nombre, id_area, nivel_jerarquico, id_empresa, estado, created_at)
                                        VALUES (?,?,?,?,?,?)',
            [$nombreCargo, $area, $nivel_jerarquico, $idEmpresa, 1, $fecha_sistema]
        );
        $descripcion = "Creación de cargo $nombreCargo";
        GoForAgileAdmin::Auditoria('CREAR',$descripcion,'CArgos',$idUser,$idEmpresa);
        return $crearCargo;
    }

    public static function ActualizarCargo($nombreCargo, $area, $nivel_jerarquico, $estado, $id,$idEmpresa,$idUser)
    {
        
        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i:s');
        $crearCargo = DB::connection('mysql-goforagile_admin')->update(
            'UPDATE Cargos SET nombre = ?, id_area = ?, nivel_jerarquico = ?, estado = ?, updated_at = ? WHERE id = ?',
            [$nombreCargo, $area, $nivel_jerarquico, $estado, $fecha_sistema, $id]
        );
        $descripcion = "Actualización de cargo $nombreCargo";
        GoForAgileAdmin::Auditoria('ACTUALIZAR',$descripcion,'CArgos',$idUser,$idEmpresa);
        return $crearCargo;
    }

    public static function BuscarNombreCargoId($id)
    {
        
        $Cargos = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Cargos WHERE id = $id");
        return $Cargos;
    }

    public static function EliminarCargo($idCargo, $idEmpresa, $idUser){
        
        date_default_timezone_set('America/Bogota');
        $cargo = GoForAgileAdmin::BuscarNombreCargoId($idCargo);
        foreach($cargo as $value){
            $nombreCargo = $value->nombre;
        }
        $eliminarCargo = DB::connection('mysql-goforagile_admin')->insert(
            'DELETE FROM Cargos WHERE id = ?',
            [$idCargo]
        );
        $descripcion = "Eliminación de cargo $nombreCargo";
        GoForAgileAdmin::Auditoria('ELIMINAR',$descripcion,'cARGOS',$idUser,$idEmpresa);
        return $eliminarCargo;
    }    

    // EMPLEADOS
    public static function BuscarUserLogin($user)
    {
        
        $usuario = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Empleados WHERE correo = '$user'");
        return $usuario;
    }

    public static function BuscarPass($user, $password)
    {
        
        $pass = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Empleados WHERE correo = '$user' AND password = '$password'");
        return $pass;
    }

    public static function EmpleadoId($IdEmpleado)
    {
        
        $usuario = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Empleados WHERE id = $IdEmpleado");
        return $usuario;
    }

    public static function CardProfile($id)
    {
        
        $profile = array();
        $cont = 0;
        $empleado = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Empleados WHERE id = $id");
        foreach ($empleado as $row1) {
            $profile[$cont]["nombre"] = $row1->nombre;
            $profile[$cont]["foto"] = $row1->foto;
            if ($row1->area > 0) {
                $areas = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Areas WHERE id = $row1->area");
                foreach ($areas as $row2) {
                    $profile[$cont]["area"] = $row2->nombre;
                }
            } else {
                $profile[$cont]["area"] = $row1->area;
            }
            if ($row1->id_cargo > 0) {
                $cargos = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Cargos WHERE id = $row1->id_cargo");

                foreach ($cargos as $row3) {
                    $profile[$cont]["cargo"] = $row3->nombre;
                }
            } else {
                $profile[$cont]["cargo"] = $row1->cargo;
            }
            if ($row1->unidad_corporativa) {
                if ($row1->unidad_corporativa > 0) {
                    $vp = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Vicepresidencia WHERE id = $row1->unidad_corporativa");

                    foreach ($vp as $row4) {
                        $profile[$cont]["vicepresidencia"] = $row4->nombre;
                    }
                } else {
                    $profile[$cont]["vicepresidencia"] = $row1->unidad_corporativa;
                }
            } else {
                $profile[$cont]["vicepresidencia"] = "";
            }
        }
        return $profile;
    }

    public static function ListarEmpleados($idEmpresa){
        
        $empleados = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Empleados WHERE id_empresa = $idEmpresa");
        return $empleados;
    }

    // EMPRESAS
    public static function ListarEmpresa($idEmpresa)
    {
        
        $empresa = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Empresas WHERE id = $idEmpresa");
        return $empresa;
    }

    // ESTRUCTURA EMPRESA
    public static function ListarEP($idEmpresa)
    {
        
        $ep = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Estructura_Empresa WHERE id_empresa = $idEmpresa");
        return $ep;
    }

    public static function ListarEEActivo($idEmpresa)
    {
        
        $ep = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Estructura_Empresa WHERE id_empresa = $idEmpresa AND estado = 1");
        return $ep;
    }

    public static function ListarUOActivo($idEmpresa)
    {
        
        $ep = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Estructura_Empresa WHERE id_empresa = $idEmpresa AND estado = 1 ORDER BY unidad_organizativa");
        return $ep;
    }

    public static function ListarEPId($id)
    {
        
        $ep = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Estructura_Empresa WHERE id = $id");
        return $ep;
    }

    // NIVEL JERARQUICO
    public static function ListarNivelJ($id_empresa)
    {
        
        $nivelJ = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Nivel_Jerarquico WHERE estado = 1 AND id_empresa = $id_empresa");
        return $nivelJ;
    }

    public static function ListarNivelJId($id)
    {
        
        $nivelJ = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Nivel_Jerarquico WHERE id = $id");
        return $nivelJ;
    }

    // POSICIONES
    public static function ListarPosicionesActivo($idEmpresa)
    {
        
        $Posiciones = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Posiciones WHERE id_empresa = $idEmpresa AND estado = 1");
        return $Posiciones;
    }

    public static function ListarPosicionesId($id)
    {
        
        $Posiciones = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Posiciones WHERE id = $id");
        return $Posiciones;
    }

    // ROLES
    public static function ListarRoles()
    {
        
        $rol = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Roles WHERE estado = 1");
        return $rol;
    }

    public static function ListarRolesId($idRol)
    {
        
        $rol = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Roles WHERE id = $idRol");
        return $rol;
    }

    // VICEPRESIDENCIAS
    public static function SelectVicepresidencia($id)
    {
        $vicepresidencias = array();
        $vicepresidencias[''] = 'Seleccione Vicepresidencia:';
        
        $selectVP = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Vicepresidencia WHERE id_empresa = $id AND estado = 1 ORDER BY nombre");
        foreach ($selectVP as $vp) {
            $vicepresidencias[$vp->id] = $vp->nombre;
        }

        return $vicepresidencias;
    }

    public static function BuscarNombreVpId($id)
    {        
        $Vicepresidencia = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Vicepresidencia WHERE id = $id");
        return $Vicepresidencia;
    }

    public static function ListarVpActivo($idEmpresa){
        
        $vp = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Vicepresidencia WHERE id_empresa = $idEmpresa AND estado = 1 ORDER BY nombre ASC");
        return $vp;
    }

    // EXTRAS
    public static function FechaAmigable($fecha)
    {
        $Array_Meses = array(
            array("01", "Ene"),
            array("02", "Feb"),
            array("03", "Mar"),
            array("04", "Abr"),
            array("05", "May"),
            array("06", "Jun"),
            array("07", "Jul"),
            array("08", "Ago"),
            array("09", "Sep"),
            array("10", "Oct"),
            array("11", "Nov"),
            array("12", "Dic"),
        );
        $partes = explode("-", $fecha);

        $txt_mes = "";
        foreach ($Array_Meses as $mes) {
            if ($mes[0] == $partes[1]) {
                $txt_mes = $mes[1];
            }
        }

        return $txt_mes . " " . $partes[2] . " de " . $partes[0];
    }

    public static function AnioOkr()
    {
        $Array_Anio = array();
        $Array_Anio[''] = 'Seleccione Año:';
        $Array_Anio[2023]  = '2023';
        $Array_Anio[2024]  = '2024';
        $Array_Anio[2025]  = '2025';
        return $Array_Anio;
    }

    public static function Estado()
    {
        $Estado = array();
        $Estado[''] = 'Seleccione Estado:';
        $Estado[1]  = 'Activo';
        $Estado[2]  = 'Inactivo';
        return $Estado;
    }

    public static function Tendencia()
    {
        $Tendencia = array(
            array("1", "Ascendente"),
            array("2", "Descendente")
        );
        return $Tendencia;
    }

    public static function Periodo()
    {
        $Periodo = array(
            array("Q1", "Q1"),
            array("Q2", "Q2"),
            array("Q3", "Q3"),
            array("Q4", "Q4"),
            array("Anual", "Anual")
        );
        return $Periodo;
    }

    public static function Medicion()
    {
        $Medicion = array(
            array("1", "Cantidad"),
            array("2", "Horas"),
            array("3", "Moneda"),
            array("4", "Porcentaje"),
            array("5", "Documento"),
            array("6", "Hito")
        );
        return $Medicion;
    }

    public static function EscalaColor($porcentaje, $id_empresa)
    {
        

        $Escala = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Escala_Medicion WHERE id_empresa = $id_empresa");
        foreach ($Escala as $value) {
            $Porcentaje1 = $value->porcentaje_uno;
            $Porcentaje2 = $value->porcentaje_dos;
            $Porcentaje3 = $value->porcentaje_tres;
            $Porcentaje4 = $value->porcentaje_cuatro;
            $Porcentaje5 = $value->porcentaje_cinco;
            $Porcentaje6 = $value->porcentaje_seis;
            $Porcentaje7 = $value->porcentaje_siete;
            $Subtitulo1 = $value->subtitulo_uno;
            $Subtitulo2 = $value->subtitulo_dos;
            $Subtitulo3 = $value->subtitulo_tres;
            $Subtitulo4 = $value->subtitulo_cuatro;
            $Subtitulo5 = $value->subtitulo_cinco;
        }

        $color_bg = "#FF0000";
        $color_text = "#000000";
        $escala = array();

        if ($porcentaje >= $Porcentaje1 && $porcentaje < $Porcentaje3) {
            $color_bg = "#FF0000";
            $txt_subtitulo = $Subtitulo1;
            $color_text = "#F7F7F7";
        }
        if ($porcentaje >= $Porcentaje3 && $porcentaje < $Porcentaje5) {
            $color_bg = "#FFF200";
            $txt_subtitulo = $Subtitulo2;
        }
        if ($porcentaje >= $Porcentaje5 && $porcentaje < $Porcentaje7) {
            $color_bg = "#95FA03";
            $txt_subtitulo = $Subtitulo3;
        }
        if ($porcentaje >= $Porcentaje7 && $porcentaje <= 100) {
            $color_bg = "#14F209";
            $txt_subtitulo = $Subtitulo4;
        }
        // if( $porcentaje == 100 ){
        // 	$color_bg = "#0DF205";
        // 	$txt_subtitulo = $dataEscala['subtitulo_cinco'];
        // }
        if ($porcentaje > 100) {
            $color_bg = "#00D30A";
            $txt_subtitulo = $Subtitulo5;
        }

        $escala['color_bg'] = $color_bg;
        $escala['color_text'] = $color_text;
        $escala['txt_subtitulo'] = $txt_subtitulo;

        return $escala;
    }

    public static function ListarAuditoria($idEmpresa){
        
        $auditoria = DB::connection('mysql-goforagile_admin')->select("SELECT * FROM Auditoria_Admin WHERE id_empresa = $idEmpresa");
        return $auditoria;
    }

    public static function Auditoria($accion,$descripcion,$modulo,$id_user, $id_empresa){
        
        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i:s');
        $auditoria = DB::connection('mysql-goforagile_admin')->insert(
            'INSERT INTO Auditoria_Admin (id_empresa, id_empleado, accion, descripcion, modulo, created_at)
                                        VALUES (?,?,?,?,?,?)',
            [$id_empresa, $id_user, $accion,$descripcion,$modulo, $fecha_sistema]
        );
        return $auditoria;
    }
}
