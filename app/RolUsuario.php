<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolUsuario extends Model
{
    protected $table = 'rol_users';

    protected $fillable = ['rut','rol_id'];
}
