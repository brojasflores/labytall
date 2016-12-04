<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarreraSala extends Model
{
    //consltar a la bdd
    protected $table = 'carrera_sala';
    //definir campos a llenar
    protected $fillable = ['carrera_id','sala_id'];
}
