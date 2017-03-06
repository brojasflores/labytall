<?php

namespace App\Http\Controllers\Director;

use Illuminate\Http\Request;

use App\Http\Requests;

use Mail;
use Session;
use Redirect;
use App\User;

class contactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('dir');
    }
    
    public function index()
    {
        return view('Director/contacto'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuario = User::all();
        return view ('Director/correo', compact('usuario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mail = $request->get('usuario');
        if($request->get('tipo')=='contactenos')
        {
            Mail::send('emails.contact', $request->all(), function($msj){
                $msj->subject('Correo de Contacto');
                $msj->to('gestion.salas.utem@gmail.com');
            });
            Session::flash('message','¡Mensaje enviado correctamente!');

            return Redirect::to('director/contacto');
        }
        else
        {
            Mail::send('emails.correo', $request->all(), function($msj) use ($mail){
                $msj->subject('Correo de Contacto');
                $msj->to($mail);
            });
            Session::flash('message','¡Mensaje enviado correctamente!');

            return redirect()->route('director.contacto.create');
        }
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
