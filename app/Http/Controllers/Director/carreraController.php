<?php

namespace App\Http\Controllers\Director;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Carrera;
use App\CarreraSala;
use App\Sala;
use App\UsersDpto;
use App\Escuela;
use Auth;
use App\User;
use Session;

class carreraController extends Controller
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
        //$carreras = Carrera::all();
        
        $usr=Auth::User()->rut;
        $dpto= UsersDpto::where('rut','=',$usr)
                        ->select('departamento_id')
                        ->get();

        $carreras= Carrera::join('escuela','carrera.escuela_id','=','escuela.id')
                        ->join('departamento','departamento.id','=','escuela.departamento_id')
                        ->where('departamento_id','=',$dpto->first()->departamento_id)
                        ->select('carrera.*')
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
            return view ('Director/carreras/index', compact('carreras','v2','cont'));
        }
        else
        {
            return view ('Director/carreras/index', compact('carreras','cont'));
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
        //$escuelas = Escuela::all();
        $usr=Auth::User()->rut;
        $dpto= UsersDpto::where('rut','=',$usr)
                        ->select('departamento_id')
                        ->get();

        $escuelas= Escuela::join('departamento','departamento.id','=','escuela.departamento_id')
                        ->where('departamento_id','=',$dpto->first()->departamento_id)
                        ->select('escuela.*')
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
            return view ('Director/carreras/create', compact('escuelas','v2','cont'));
        }
        else
        {
            return view ('Director/carreras/create', compact('escuelas','cont'));
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
        $carrera = Carrera::create([
            'escuela_id' => $request->get('escuelaCarrera'),
            'codigo' => $request->get('codigoCarrera'),
            'nombre' => $request->get('nombreCarrera'),
            'descripcion' => $request->get('desCarrera')
            ]);

        $usr=Auth::User()->rut;
        $dpto= UsersDpto::where('rut','=',$usr)
                        ->select('departamento_id')
                        ->get();

        $salas= Sala::where('departamento_id','=',$dpto->first()->departamento_id)
                        ->select('sala.id')
                        ->get();
        
        $carr = Carrera::where('codigo','=',$request->get('codigoCarrera'))
                        ->select('carrera.id')
                        ->get();
        $carr2 = $carr->first()->id;
  
        foreach($salas as $v)
        {
           CarreraSala::create([
            'carrera_id' => $carr2,
            'sala_id' => $v->id,
            ]);
        }


        return redirect()->route('director.carrera.index');
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
        $carreras = Carrera::findOrFail($id);
        //$escuelas = Escuela::all();
        $usr=Auth::User()->rut;
        $dpto= UsersDpto::where('rut','=',$usr)
                        ->select('departamento_id')
                        ->get();

        $escuelas= Escuela::join('departamento','departamento.id','=','escuela.departamento_id')
                        ->where('departamento_id','=',$dpto->first()->departamento_id)
                        ->select('escuela.*')
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
            return view ('Director/carreras/edit', compact('escuelas','carreras','v2','cont'));
        }
        else
        {
            return view ('Director/carreras/edit', compact('escuelas','carreras','cont'));
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
        $carreras = Carrera::findOrFail($id);     
        //fill (rellenar)
        $carreras->fill([
            'escuela_id' => $request->get('escuelaCarrera'),
            'codigo' => $request->get('codigoCarrera'),
            'nombre' => $request->get('nombreCarrera'),
            'descripcion' => $request->get('desCarrera')
        ]);
        $carreras->save();

        return redirect()->route('director.carrera.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carreras = Carrera::findOrFail($id);
        $carreras->delete();
        return redirect()->route('director.carrera.index');
    }

    public function uploadCar(Request $request)
    {
        if(is_null($request->file('file')))
        {
            Session::flash('message', 'Debes seleccionar un archivo.');
            return redirect()->back();
        }
           $file = $request->file('file');
     
           $nombre = $file->getClientOriginalName();
           \Storage::disk('local')->put($nombre,  \File::get($file));
            \Excel::load('/storage/app/'.$nombre,function($archivo) 
            {
                $result = $archivo->get();
                foreach($result as $key => $value)
                {
                    $carrera_id = Carrera::where('codigo','=',$value->carrera)
                                        ->select('id')
                                        ->get();

                    $sala_id = Sala::where('nombre','=',$value->sala)
                                        ->select('id')
                                        ->get();

                    $var = new CarreraSala();
                    $var->fill(['carrera_id' => $carrera_id->first()->id, 'sala_id' => $sala_id->first()->id]);
                    $var->save();
                }
            })->get();
            Session::flash('message', '¡El archivo fue subido exitosamente!');
           return redirect()->route('director.usuario.index');
    }
}
