<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    //consltar a la bdd
    protected $table = 'sala';
    //definir campos a llenar
    protected $fillable = ['nombre','capacidad'];
}
