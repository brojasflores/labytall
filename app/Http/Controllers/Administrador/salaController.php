<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;

use App\Http\Requests;
//referencia al modelo (importarlo)
use App\Sala;
use App\Estacion_trabajo;
use Auth;
use App\User;

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
        //tomar todo lo que venga de la tabla lab y mostrar 
        //all devuelve todo
        $salas = Sala::all();
        //Cambio de rol
        $usr=Auth::User()->rut;
        //modelo:: otra tabla que consulto, lo que quiero de la tabla propia = lo de la otra tabla
        $usr2 = User::join('rol_users','users.rut','=','rol_users.rut')
                    ->where('users.rut','=',$usr)
                    ->join('rol','rol_users.rol_id','=','rol.id')
                    ->select('nombre')
                    ->paginate();
        // lo de arriba guarda una coleccion donde está el o los nombre(s) de los roles pertenecientes al usuario
        foreach($usr2 as $v)
        {
            $v2[]= $v->nombre;
        }
        //el foreach recorre la colección y guarda en un array solo los nombres de los roles del usuario 
        $cont = count($v2); //cuenta la cantidad de elementos del array
        
        if($cont>1)
        {
            return view ('Administrador/salas/index', compact('salas','v2','cont'));
        }
        else
        {
            return view ('Administrador/salas/index', compact('salas','cont'));
        }
        //return view ('Administrador/salas/index', compact('salas'));
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
                    ->paginate();
        // lo de arriba guarda una coleccion donde está el o los nombre(s) de los roles pertenecientes al usuario
        foreach($usr2 as $v)
        {
            $v2[]= $v->nombre;
        }
        //el foreach recorre la colección y guarda en un array solo los nombres de los roles del usuario 
        $cont = count($v2); //cuenta la cantidad de elementos del array
        
        if($cont>1)
        {
            return view ('Administrador/salas/create', compact('v2','cont'));
        }
        else
        {
            return view ('Administrador/salas/create', compact('cont'));
        }
        //return view('Administrador/salas/create');
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
        //variable = nombre del modelo ::(paso metodo)
        //hace insert
        $capacidad= $request->get('capacidadSala');
        $nombre = $request->get('nombreSala');

        $sala = Sala::create([
            'nombre' => $request->get('nombreSala'),
            'capacidad' => $request->get('capacidadSala'),
            ]);

        //modelo:: otra tabla que consulto, lo que quiero de la tabla propia = lo de la otra tabla
        $sa = Sala::where('nombre','=',$nombre)
                    ->select('id')
                    ->paginate();

        foreach($sa as $v)
        {
            $v2= $v->id;
        }
        
        for($i=0; $i<$capacidad; $i++)
        {
            Estacion_trabajo::create([
                'nombre' => ($i+1),
                'disponibilidad'=> "si",
                'sala_id' => $v2,
            ]);
        }
        return redirect()->route('administrador.sala.index');
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
        //variable = modelo:: metodo encunetra un registro en la bdd segun id!!
        $sala = Sala::findOrFail($id);
        //Cambio de rol
        $usr=Auth::User()->rut;
        //modelo:: otra tabla que consulto, lo que quiero de la tabla propia = lo de la otra tabla
        $usr2 = User::join('rol_users','users.rut','=','rol_users.rut')
                    ->where('users.rut','=',$usr)
                    ->join('rol','rol_users.rol_id','=','rol.id')
                    ->select('nombre')
                    ->paginate();
        // lo de arriba guarda una coleccion donde está el o los nombre(s) de los roles pertenecientes al usuario
        foreach($usr2 as $v)
        {
            $v2[]= $v->nombre;
        }
        //el foreach recorre la colección y guarda en un array solo los nombres de los roles del usuario 
        $cont = count($v2); //cuenta la cantidad de elementos del array
        
        if($cont>1)
        {
            return view ('Administrador/salas/edit', compact('sala','v2','cont'));
        }
        else
        {
            return view ('Administrador/salas/edit', compact('sala','cont'));
        }
        //return view('Administrador/salas/edit', compact('sala'));
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
        $capacidad= $request->get('capacidadSala');
        $sala = Sala::findOrFail($id);     
        //fill (rellenar)
        $sala->fill([
            'nombre' => $request->get('nombreSala'),
            'capacidad' => $request->get('capacidadSala'),
            'disponibilidad' => $request->get('disponibilidadSala')
        ]);
        $sala->save();

        $salas = Sala::all();

        $esT = Estacion_trabajo::where('sala_id','=',$id)
               ->select('id')
               ->paginate();

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

        for($i=0; $i<$capacidad; $i++)
        {
            Estacion_trabajo::create([
                'nombre' => ($i+1),
                'disponibilidad'=> "si",
                'sala_id' => $id,
            ]);
        }


        return redirect()->route('administrador.sala.index');
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
               ->paginate();

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

        return redirect()->route('administrador.sala.index');
    }
}
