<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    //consltar a la bdd
    protected $table = 'carrera';
    //definir campos a llenar
    protected $fillable = ['escuela_id','codigo','nombre','descripcion'];
}
