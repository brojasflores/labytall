<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario_Alumno extends Model
{
    protected $table = 'horario_alum';

    protected $fillable = ['fecha','rut','periodo_id','sala_id','estacion_trabajo_id','permanencia','asistencia'];
}
