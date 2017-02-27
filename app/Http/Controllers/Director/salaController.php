<?php

namespace App\Http\Controllers\Director;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Sala;
use App\Departamento;
use App\Estacion_trabajo;
use App\Periodo;
use Auth;
use App\User;
use App\UsersDpto;
use Session;


class salaController extends Controller
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
        $usr=Auth::User()->rut;
        $dpto= UsersDpto::where('rut','=',$usr)
                        ->select('departamento_id')
                        ->get();
        $salas= Sala::where('departamento_id','=',$dpto->first()->departamento_id)
                        ->select('sala.*')
                        ->get();

        //$salas = Sala::all();
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
            return view ('Director/salas/index', compact('salas','v2','cont'));
        }
        else
        {
            return view ('Director/salas/index', compact('salas','cont'));
        }
        //return view ('Director/salas/index', compact('salas'));
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
            return view ('Director/salas/create', compact('v2','cont'));
        }
        else
        {
            return view ('Director/salas/create', compact('cont'));
        }
        //return view('Director/salas/create');
    }
    //el create te lleva a la vista y la vista lleva los datos al store y ese a la bdd
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
            'capacidad' => 'required|numeric',
            ]);

        $usr=Auth::User()->rut;
        $dpto= UsersDpto::where('rut','=',$usr)
                        ->select('departamento_id')
                        ->get();

        $periodos = Periodo::All();

        $per = count($periodos);
        
        $capacidad= $request->get('capacidad');
        $nombre = $request->get('nombre');

        $sala = Sala::create([
            'nombre' => $request->get('nombre'),
            'capacidad' => $request->get('capacidad'),
            'departamento_id' => $dpto->first()->departamento_id,
            ]);

        //modelo:: otra tabla que consulto, lo que quiero de la tabla propia = lo de la otra tabla
        $sa = Sala::where('nombre','=',$nombre)
                    ->select('id')
                    ->get();

        foreach($sa as $v)
        {
            $v2= $v->id;
        }
        
        foreach($periodos as $v)
        {
            $v3[]= $v->id;
        }

        for($j=0; $j<$per; $j++)
        {
            for($i=0; $i<$capacidad; $i++)
            {
                Estacion_trabajo::create([
                    'nombre' => ($i+1),
                    'disponibilidad'=> "si",
                    'sala_id' => $v2,
                    'periodo_id' => $v3[$j],
                ]);
            }
        }
        
        Session::flash('create','¡Sala creada correctamente!');
        return redirect()->route('director.sala.index');
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
        $sala = Sala::findOrFail($id);
        //variable = modelo:: metodo encunetra un registro en la bdd segun id!!
        //$dptos=Departamento::all();
        

        //$sala = Sala::findOrFail($id);
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
            return view ('Director/salas/edit', compact('sala','v2','cont'));
        }
        else
        {
            return view ('Director/salas/edit', compact('sala','cont'));
        }
        //return view('Director/salas/edit', compact('sala'));
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
            'capacidad' => 'required|numeric',
            ]);

        $periodos = Periodo::All();
        $per = count($periodos);

        $capacidad= $request->get('capacidad');
        $sala = Sala::findOrFail($id);     

        $sala->fill([
            'nombre' => $request->get('nombre'),
            'capacidad' => $request->get('capacidad'),
        ]);
        $sala->save();

        $salas = Sala::all();

        $esT = Estacion_trabajo::where('sala_id','=',$id)
               ->select('id')
               ->get();

        foreach($esT as $v)
        {
            $v2[]= $v->id;
        }
        $cont= count($v2); 
        for($i=0;$i<$cont;$i++)
        {
            $est = Estacion_trabajo::findOrFail($v2[$i]);
            $est->delete();
        }

        foreach($periodos as $v)
        {
            $v3[]= $v->id;
        }

        for($j=0; $j<$per; $j++)
        {
            for($i=0; $i<$capacidad; $i++)
            {
                Estacion_trabajo::create([
                    'nombre' => ($i+1),
                    'disponibilidad'=> "si",
                    'sala_id' => $id,
                    'periodo_id' => $v3[$j],
                ]);
            }
        }

        Session::flash('edit','¡Sala editada correctamente!');
        return redirect()->route('director.sala.index');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $esT = Estacion_trabajo::where('sala_id','=',$id)
               ->select('id')
               ->get();

        foreach($esT as $v)
        {
            $v2[]= $v->id;
        }
        $cont= count($v2); 
        for($i=0;$i<$cont;$i++)
        {
            $est = Estacion_trabajo::findOrFail($v2[$i]);
            $est->delete();
        }
        
        $sala = Sala::findOrFail($id);
        $sala->delete();

        Session::flash('delete','¡Sala eliminada correctamente!');
        return redirect()->route('director.sala.index');
    }
}
