<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    //consltar a la bdd
    protected $table = 'departamento';
    //definir campos a llenar
    protected $fillable = ['nombre','facultad_id','descripcion'];
}
