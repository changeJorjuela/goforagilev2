<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GoForAgileCompetencias extends Model
{
    protected $connection = 'mysql-goforagile_competencias';

    public static function BuscarCiclo($idEmpresa){
        
        $ciclo= DB::connection('mysql-goforagile_competencias')->select("SELECT * FROM Ciclos WHERE id_empresa = $idEmpresa");        
        return $ciclo;
    }
}
