<?php

namespace App\Http\Controllers\Funcionario;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Asignatura;
use App\Carrera;
use Auth;
use App\User;
use App\UsersDpto;
use Session;

class asignaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('funci');
    }

    public function index()
    {
        $usr=Auth::User()->rut;
        $dpto= UsersDpto::where('rut','=',$usr)
                        ->select('departamento_id')
                        ->get();
        $asignaturas = Asignatura::join('carrera','asignatura.carrera_id','=','carrera.id')
                        ->join('escuela','escuela.id','=','carrera.escuela_id')
                        ->join('departamento','departamento.id','=','escuela.departamento_id')
                        ->where('departamento.id',$dpto->first()->departamento_id)
                        ->select('asignatura.*','carrera.nombre as carr')
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
            return view ('Funcionario/asignaturas/index', compact('asignaturas','v2','cont'));
        }
        else
        {
            return view ('Funcionario/asignaturas/index', compact('asignaturas','cont'));
        }
        //se pasa la variable sin el peso con compact
        //return view ('Funcionario/asignaturas/index', compact('asignaturas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usr=Auth::User()->rut;
        $dpto= UsersDpto::where('rut','=',$usr)
                        ->select('departamento_id')
                        ->get();
        $carreras = Carrera::join('escuela','carrera.escuela_id','=','escuela.id')
                           ->join('departamento','departamento.id','=','escuela.departamento_id')
                           ->where('departamento.id',$dpto->first()->departamento_id)
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
            return view ('Funcionario/asignaturas/create', compact('carreras','v2','cont'));
        }
        else
        {
            return view ('Funcionario/asignaturas/create', compact('carreras','cont'));
        }
        //return view('Funcionario/asignaturas/create');
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
                'codigo' => 'required',
                'nombre' => 'required',
                'descripcion' => 'required',
                'carrera_id' => 'required'
                ]);

        $asignaturas = Asignatura::create([
            'codigo' => $request->get('codigo'),
            'nombre' => $request->get('nombre'),
            'descripcion' => $request->get('descripcion'),
            'carrera_id' => $request->get('carrera_id')
            ]);
            //$asignaturas = Asignatura::all();        
        
        Session::flash('create','¡Asignatura creada correctamente!');
        return redirect()->route('funcionario.asignatura.index');
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
        $usr=Auth::User()->rut;
        $dpto= UsersDpto::where('rut','=',$usr)
                        ->select('departamento_id')
                        ->get();
        $carreras = Carrera::join('escuela','carrera.escuela_id','=','escuela.id')
                           ->join('departamento','departamento.id','=','escuela.departamento_id')
                           ->where('departamento.id',$dpto->first()->departamento_id)
                           ->select('carrera.*')
                           ->get();
        $asignaturas = Asignatura::findOrFail($id);

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
            return view ('Funcionario/asignaturas/edit', compact('carreras','asignaturas','v2','cont'));
        }
        else
        {
            return view ('Funcionario/asignaturas/edit', compact('carreras','asignaturas','cont'));
        }
        //return view('Funcionario/asignaturas/edit', compact('asignaturas'));
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
                'codigo' => 'required',
                'nombre' => 'required',
                'descripcion' => 'required',
                'carrera_id' => 'required'
                ]);

        $asignaturas = Asignatura::findOrFail($id);     
        //fill (rellenar)
        $asignaturas->fill([
            'codigo' => $request->get('codigo'),
            'nombre' => $request->get('nombre'),
            'descripcion' => $request->get('descripcion'),
            'carrera_id' => $request->get('carrera_id')
        ]);
        $asignaturas->save();
        
        Session::flash('edit','¡Asignatura editada correctamente!');
        return redirect()->route('funcionario.asignatura.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asignaturas = Asignatura::findOrFail($id);
        $asignaturas->delete();

        Session::flash('destroy','¡Asignatura eliminada correctamente!');
        return redirect()->route('funcionario.asignatura.index');
    }

    public function uploadAsig(Request $request)
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

                    $var = new Asignatura();
                    $var->fill(['codigo' => $value->codigo, 'nombre'=> $value->nombre, 'descripcion'=> $value->descripcion, 'carrera_id'=> $carrera_id->first()->id]);
                    $var->save();
                }
            })->get();
            Session::flash('message', 'Los Docentes fueron agregados exitosamente!');
           return redirect()->route('funcionario.asignatura.index');
    }
}
