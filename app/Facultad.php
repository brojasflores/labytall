<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    //consltar a la bdd
    protected $table = 'facultad';
    //definir campos a llenar
    protected $fillable = ['nombre','campus_id','descripcion'];
}
