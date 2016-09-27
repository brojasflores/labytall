<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AutenticacionController extends Controller
{
    use AuthenticatesUsers;

    protected $loginView = 'auth.login';
    
    protected $guard = 'authe';


    function __construct()
    {
    	$this->middleware('auth:authe', ['only' => ['secret']]);
    }

    public function authenticated()
	{
		return redirect('auth/area');
	}
	public function secret()
	{
		return 'hola';
	}
}

