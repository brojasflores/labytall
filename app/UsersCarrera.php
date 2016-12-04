<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersCarrera extends Model
{

    protected $table = 'users_carrera';

    protected $fillable = ['rut','carrera_id'];


}

