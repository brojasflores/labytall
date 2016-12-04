<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersDpto extends Model
{

    protected $table = 'users_dpto';

    protected $fillable = [
        'rut','departamento_id'
    ];


}

