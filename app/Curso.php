<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'curso';

    protected $fillable = ['asignatura_id','semestre','anio','seccion','docente','ayudante'];
}
