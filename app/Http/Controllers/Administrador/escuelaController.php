<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Departamento;
use App\Escuela;
use App\Campus;
use Auth;
use App\User;
use Session;


class escuelaController extends Controller
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
        $escuelas = Escuela::join('departamento','escuela.departamento_id','=','departamento.id')
                              ->select('escuela.*','departamento.nombre as dpto')
                              ->get();
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
            return view ('Administrador/escuelas/index', compact('escuelas','v2','cont'));
        }
        else
        {
            return view ('Administrador/escuelas/index', compact('escuelas','cont'));
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
        $escuelas = Escuela::all();
        $departamentos = Departamento::all();
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
            return view ('Administrador/escuelas/create', compact('departamentos','escuelas','v2','cont'));
        }
        else
        {
            return view ('Administrador/escuelas/create', compact('departamentos','escuelas','cont'));
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

            'nombre' => 'required',
            'departamento_id' => 'required',
            'descripcion' => 'required'
            ]);

        $escuelas = Escuela::create([
            'nombre' => $request->get('nombre'),
            'departamento_id' => $request->get('departamento_id'),
            'descripcion' => $request->get('descripcion')
            ]);
        
        Session::flash('create','¡Escuela creada correctamente!');
        return redirect()->route('administrador.escuela.index');
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
        $escuelas = Escuela::findOrFail($id);
        $departamentos = Departamento::all();
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
            return view ('Administrador/escuelas/edit', compact('departamentos','escuelas','v2','cont'));
        }
        else
        {
            return view ('Administrador/escuelas/edit', compact('departamentos','escuelas','cont'));
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

            'nombre' => 'required',
            'departamento_id' => 'required',
            'descripcion' => 'required'
            ]);

        $escuelas = Escuela::findOrFail($id);     
        //fill (rellenar)
        $escuelas->fill([
            'nombre' => $request->get('nombre'),
            'departamento_id' => $request->get('departamento_id'),
            'descripcion' => $request->get('descripcion')
        ]);
        $escuelas->save();

        Session::flash('edit','¡Escuela editada correctamente!');
        return redirect()->route('administrador.escuela.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $escuelas = Escuela::findOrFail($id);
        $escuelas->delete();
        
        Session::flash('delete','¡Escuela eliminada correctamente!');
        return redirect()->route('administrador.escuela.index');
    }
}
