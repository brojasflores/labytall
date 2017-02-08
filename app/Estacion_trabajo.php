<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estacion_trabajo extends Model
{
    protected $table = 'estacion_trabajo';

    protected $fillable = ['nombre','disponibilidad','sala_id','periodo_id'];
}
