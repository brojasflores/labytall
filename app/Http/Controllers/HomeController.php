<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;

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
            /*if((Auth::user->password)!=null)
            {
                return view('perfil2');
            }
            else
            {
                return view('index');
            }*/
            return view('index');
        }

        
    }
}
