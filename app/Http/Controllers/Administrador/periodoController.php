<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Periodo;
use Auth;
use App\User;
use Session;


class periodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index()
    {
        $periodos = Periodo::all();
        //Cambio de rol
        $usr=Auth::User()->rut;
        //modelo:: otra tabla que consulto, lo que quiero de la tabla propia = lo de la otra tabla
        $usr2 = User::join('rol_users','users.rut','=','rol_users.rut')
                    ->where('users.rut','=',$usr)
                    ->join('rol','rol_users.rol_id','=','rol.id')
                    ->select('nombre')
                    ->get();
        // lo de arriba guarda una coleccion donde está el o los nombre(s) de los roles pertenecientes al usuario
        foreach($usr2 as $v)
        {
            $v2[]= $v->nombre;
        }
        //el foreach recorre la colección y guarda en un array solo los nombres de los roles del usuario 
        $cont = count($v2); //cuenta la cantidad de elementos del array
        
        if($cont>1)
        {
            return view ('Administrador/periodos/index', compact('periodos','v2','cont'));
        }
        else
        {
            return view ('Administrador/periodos/index', compact('periodos','cont'));
        }
        //return view ('Administrador/periodos/index', compact('periodos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Cambio de rol
        $usr=Auth::User()->rut;
        //modelo:: otra tabla que consulto, lo que quiero de la tabla propia = lo de la otra tabla
        $usr2 = User::join('rol_users','users.rut','=','rol_users.rut')
                    ->where('users.rut','=',$usr)
                    ->join('rol','rol_users.rol_id','=','rol.id')
                    ->select('nombre')
                    ->get();
        // lo de arriba guarda una coleccion donde está el o los nombre(s) de los roles pertenecientes al usuario
        foreach($usr2 as $v)
        {
            $v2[]= $v->nombre;
        }
        //el foreach recorre la colección y guarda en un array solo los nombres de los roles del usuario 
        $cont = count($v2); //cuenta la cantidad de elementos del array
        
        if($cont>1)
        {
            return view ('Administrador/periodos/create', compact('v2','cont'));
        }
        else
        {
            return view ('Administrador/periodos/create', compact('cont'));
        }
        //return view('Administrador/periodos/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'bloque' => 'required',
            'inicio' => 'required|date_format:H:m',
            'fin' => 'required|date_format:H:m|after:inicio'
            ]);

        $periodos = Periodo::create([
            'bloque' => $request->get('bloque'),
            'inicio' => $request->get('inicio'),
            'fin' => $request->get('fin')
            ]);
        
        Session::flash('create','¡Período creado correctamente!');
        return redirect()->route('administrador.periodo.index');
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
        $periodos = Periodo::findOrFail($id);
        $inifin = Periodo::where('id','=',$id)
                          ->select('inicio','fin')
                          ->get();

        $inicio = $inifin->first()->inicio;
        $inicio = substr($inicio,0,-3); 

        $fin = $inifin->first()->fin;
        $fin = substr($fin,0,-3); 
        

        //Cambio de rol
        $usr=Auth::User()->rut;
        //modelo:: otra tabla que consulto, lo que quiero de la tabla propia = lo de la otra tabla
        $usr2 = User::join('rol_users','users.rut','=','rol_users.rut')
                    ->where('users.rut','=',$usr)
                    ->join('rol','rol_users.rol_id','=','rol.id')
                    ->select('nombre')
                    ->get();
        // lo de arriba guarda una coleccion donde está el o los nombre(s) de los roles pertenecientes al usuario
        foreach($usr2 as $v)
        {
            $v2[]= $v->nombre;
        }
        //el foreach recorre la colección y guarda en un array solo los nombres de los roles del usuario 
        $cont = count($v2); //cuenta la cantidad de elementos del array
        
        if($cont>1)
        {
            return view ('Administrador/periodos/edit', compact('inicio','fin','periodos','v2','cont'));
        }
        else
        {
            return view ('Administrador/periodos/edit', compact('inicio','fin','periodos','cont'));
        }
        //return view('Administrador/periodos/edit', compact('periodos'));
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
        $this->validate($request, [
            'bloque' => 'required',
            'inicio' => 'required|date_format:H:m',
            'fin' => 'required|date_format:H:m|after:inicio'
            ]);

        $periodos = Periodo::findOrFail($id);     
        //fill (rellenar)
        $periodos->fill([
            'bloque' => $request->get('bloque'),
            'inicio' => $request->get('inicio'),
            'fin' => $request->get('fin')
        ]);
        $periodos->save();

        Session::flash('edit','¡Período editado correctamente!');
        return redirect()->route('administrador.periodo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $periodos = Periodo::findOrFail($id);
        $periodos->delete();

        Session::flash('delete','¡Período eliminado correctamente!');
        return redirect()->route('administrador.periodo.index');
    }
}
