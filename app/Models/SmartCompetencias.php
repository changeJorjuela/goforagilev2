<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SmartCompetencias extends Model
{
    protected $connection = 'mysql-smartV3_competencias';

    public static function BuscarCiclo($idEmpresa){
        DB::setDefaultConnection('mysql-smartV3_competencias');
        $ciclo= DB::Select("SELECT * FROM Ciclos WHERE id_empresa = $idEmpresa");        
        return $ciclo;
    }
}
