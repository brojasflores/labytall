<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use Session;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
        //return view('index');

        if(empty(Auth::user()->email))
        {
            return view('perfil');
        }
        else
        {
            Session::flash('message','¡El inicio de sesión se ha efectuado correctamente!');
            return view('Administrador/index');
        }

        
    }
}
