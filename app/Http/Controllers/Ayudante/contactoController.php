<?php

namespace App\Http\Controllers\Ayudante;

use Illuminate\Http\Request;

use App\Http\Requests;

use Mail;
use Session;
use Redirect;

class contactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *docen
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('ayu');
    }

    public function index()
    {
        return view('Ayudante/contacto'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Mail::send('emails.contact', $request->all(), function($msj){
            $msj->subject('Correo de Contacto');
            $msj->to('gestion.salas.utem@gmail.com');
        });
        //esto no me lo muestra!!
        Session::flash('message','¡Mensaje enviado correctamente!');
        //no segura!
        return Redirect::to('ayudante/contacto');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
