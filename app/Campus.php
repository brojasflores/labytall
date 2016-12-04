<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    //consltar a la bdd
    protected $table = 'campus';
    //definir campos a llenar
    protected $fillable = ['nombre','direccion','descripcion'];
}
