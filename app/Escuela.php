<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escuela extends Model
{
    //consltar a la bdd
    protected $table = 'escuela';
    //definir campos a llenar
    protected $fillable = ['nombre','departamento_id','descripcion'];
}
