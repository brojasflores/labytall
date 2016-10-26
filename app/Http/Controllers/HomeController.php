<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {      
        //return view('index');

        if(empty(Auth::user()->email))
        {
            return view('perfil');
        }
        else
        {
            return view('Administrador/index');      
        }
    }
}
