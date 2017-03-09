<?php

namespace App\Http\Controllers\Director;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Curso;
use App\Asignatura;
use Auth;
use App\User;
use App\UsersDpto;
use Session;


class cursoController extends Controller
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
        $usr=Auth::User()->rut;
        $dpto= UsersDpto::where('rut','=',$usr)
                        ->select('departamento_id')
                        ->get();
        $cursos = Curso::join('asignatura','curso.asignatura_id','=','asignatura.id')
                       ->join('carrera','carrera.id','=','asignatura.carrera_id')
                       ->join('escuela','escuela.id','=','carrera.escuela_id')
                       ->join('departamento','departamento.id','=','escuela.departamento_id')
                       ->where('departamento.id',$dpto->first()->departamento_id)
                       ->select('curso.*','asignatura.nombre')
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
            return view ('Director/cursos/index', compact('cursos','v2','cont'));
        }
        else
        {
            return view ('Director/cursos/index', compact('cursos','cont'));
        }
        //return view ('Director/cursos/index', compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doc = 'docente';
        $ayu = 'ayudante';

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

        $docentes = User::join('rol_users','users.rut','=','rol_users.rut')
                        ->join('rol','rol_users.rol_id','=','rol.id')
                        ->join('users_dpto','users.rut','=','users_dpto.rut')
                        ->where('rol.nombre','=',$doc)
                        ->where('users_dpto.departamento_id','=',$dpto->first()->departamento_id)
                        ->select('users.*')
                        ->get();

        $ayudantes = User::join('rol_users','users.rut','=','rol_users.rut')
                        ->join('rol','rol_users.rol_id','=','rol.id')
                        ->join('users_dpto','users.rut','=','users_dpto.rut')
                        ->where('rol.nombre','=',$ayu)
                        ->where('users_dpto.departamento_id','=',$dpto->first()->departamento_id)
                        ->select('users.*')
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
            return view ('Director/cursos/create',compact('docentes','ayudantes','asignaturas','v2','cont'));
        }
        else
        {
            return view ('Director/cursos/create',compact('docentes','ayudantes','asignaturas','cont'));
        }
        //return view('Director/cursos/create',compact('asignaturas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $esta = Curso::where('asignatura_id','=',$request->get('asignatura_id'))
                     ->where('semestre','=',$request->get('semestre'))
                     ->where('anio','=',$request->get('anio'))
                     ->where('seccion','=',$request->get('seccion'))
                     ->select('id')
                     ->get();

        if(!$esta->isEmpty())
        {
            Session::flash('create','¡Curso creado con anterioridad!');
            return redirect()->route('director.curso.index');
        }

        $sem = $request->get('semestre');
        if($sem == '01'||$sem=='02'||$sem=='1'||$sem=='2')
        {
            $sem='ok';
        }
        else
        {
            $sem='nook';
        }

        if($sem=='ok')
        {
            $this->validate($request, [
                'asignatura_id' => 'required',
                'semestre' => 'required|numeric|max:2',
                'anio' => 'required|numeric|digits:4',
                'seccion' => 'required|numeric'
                ]);
            
            if(empty($request->get('ayudantes')))
            {
                $cursos = Curso::create([
                    'asignatura_id' => $request->get('asignatura_id'),
                    'semestre' => $request->get('semestre'),
                    'anio' => $request->get('anio'),
                    'seccion' => $request->get('seccion'),
                    'docente' => $request->get('docentes'),
                    'ayudante' => 'no',
                    ]);
            }
            else
            {
                $cursos = Curso::create([
                    'asignatura_id' => $request->get('asignatura_id'),
                    'semestre' => $request->get('semestre'),
                    'anio' => $request->get('anio'),
                    'seccion' => $request->get('seccion'),
                    'docente' => $request->get('docentes'),
                    'ayudante' => $request->get('ayudantes'),
                    ]);
            }

            Session::flash('create','¡Curso creado correctamente!');
            return redirect()->route('director.curso.index');
        }
        else
        {
            Session::flash('create','¡Curso no puede ser creado! Ingrese un semestre válido Ej: 1 ó 2');
            return redirect()->route('director.curso.create');
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
        $usr=Auth::User()->rut;
        $dpto= UsersDpto::where('rut','=',$usr)
                        ->select('departamento_id')
                        ->get();
        $doc = 'docente';
        $ayu = 'ayudante';

        $docentes = User::join('rol_users','users.rut','=','rol_users.rut')
                                ->join('rol','rol_users.rol_id','=','rol.id')
                                ->join('users_dpto','users.rut','=','users_dpto.rut')
                                ->where('rol.nombre','=',$doc)
                                ->where('users_dpto.departamento_id','=',$dpto->first()->departamento_id)
                                ->select('users.*')
                                ->get();

        $ayudantes = User::join('rol_users','users.rut','=','rol_users.rut')
                        ->join('rol','rol_users.rol_id','=','rol.id')
                        ->join('users_dpto','users.rut','=','users_dpto.rut')
                        ->where('rol.nombre','=',$ayu)
                        ->where('users_dpto.departamento_id','=',$dpto->first()->departamento_id)
                        ->select('users.*')
                        ->get();

        $cursos = Curso::findOrFail($id);
        //en el compact se pasa la variable como string
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
            return view ('Director/cursos/edit', compact('docentes','ayudantes','cursos','asignaturas','v2','cont'));
        }
        else
        {
            return view ('Director/cursos/edit', compact('docentes','ayudantes','cursos','asignaturas','cont'));
        }
        //return view('Director/cursos/edit', compact('cursos','asignaturas'));
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
        $esta = Curso::where('asignatura_id','=',$request->get('asignatura_id'))
                     ->where('semestre','=',$request->get('semestre'))
                     ->where('anio','=',$request->get('anio'))
                     ->where('seccion','=',$request->get('seccion'))
                     ->where('id','!=',$id)
                     ->select('id')
                     ->get();

        if(!$esta->isEmpty())
        {
            Session::flash('create','¡Curso creado con anterioridad!');
            return redirect()->route('director.curso.index');
        }
        
        $sem = $request->get('semestre');
        if($sem == '01'||$sem=='02'||$sem=='1'||$sem=='2')
        {
            $sem='ok';
        }
        else
        {
            $sem='nook';
        }

        if($sem=='ok')
        {
            $this->validate($request, [
                'asignatura_id' => 'required',
                'semestre' => 'required|numeric|max:2',
                'anio' => 'required|numeric|digits:4',
                'seccion' => 'required|numeric'
                ]);

            $cursos = Curso::findOrFail($id);     

            if($request->get('optradio')=='no')
            {
                $cursos->fill([
                    'asignatura_id' => $request->get('asignatura_id'),
                    'semestre' => $request->get('semestre'),
                    'anio' => $request->get('anio'),
                    'seccion' => $request->get('seccion'),
                    'docente' => $request->get('docentes'),
                    'ayudante' => 'no',
                ]);
                $cursos->save();
            }
            else
            {
                $cursos->fill([
                    'asignatura_id' => $request->get('asignatura_id'),
                    'semestre' => $request->get('semestre'),
                    'anio' => $request->get('anio'),
                    'seccion' => $request->get('seccion'),
                    'docente' => $request->get('docentes'),
                    'ayudante' => $request->get('ayudantes'),
                ]);
                $cursos->save();
            }

            Session::flash('edit','¡Curso editado correctamente!');
            return redirect()->route('director.curso.index');
        }
        else
        {
            Session::flash('create','¡Curso no puede ser editado! Ingrese un semestre válido Ej: 1 ó 2 e intente nuevamente');
            return redirect()->route('director.curso.index');
        }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cursos = Curso::findOrFail($id);
        $cursos->delete();

        Session::flash('delete','¡Curso eliminado correctamente!');
        return redirect()->route('director.curso.index');
    }
}
