<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Curso;
use App\Asignatura;
use App\Carrera;
use Auth;
use App\User;
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
        $this->middleware('admin');
    }
    
    public function index()
    {
        $cursos = Curso::join('asignatura','curso.asignatura_id','=','asignatura.id')
                            ->join('users','curso.docente','=','users.rut')
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
            return view ('Administrador/cursos/index', compact('cursos','v2','cont'));
        }
        else
        {
            return view ('Administrador/cursos/index', compact('cursos','cont'));
        }
        //return view ('Administrador/cursos/index', compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$asignaturas = Asignatura::all();
        $doc = 'docente';
        $ayu = 'ayudante';

        $asignaturas = Asignatura::join('carrera','asignatura.carrera_id','=','carrera.id')
                                 ->select('asignatura.*','carrera.nombre as carr')
                                 ->get();

        $docentes = User::join('rol_users','users.rut','=','rol_users.rut')
                        ->join('rol','rol_users.rol_id','=','rol.id')
                        ->where('rol.nombre','=',$doc)
                        ->select('users.*')
                        ->get();

        $ayudantes = User::join('rol_users','users.rut','=','rol_users.rut')
                        ->join('rol','rol_users.rol_id','=','rol.id')
                        ->where('rol.nombre','=',$ayu)
                        ->select('users.*')
                        ->get();
        //dd($ayudantes);
        
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
            return view ('Administrador/cursos/create',compact('ayudantes','docentes','asignaturas','v2','cont'));
        }
        else
        {
            return view ('Administrador/cursos/create',compact('ayudantes','docentes','asignaturas','cont'));
        }
        //return view('Administrador/cursos/create',compact('asignaturas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        if($request->ajax()){
            //dd($request);
            $doc = 'docente';
            $ayu = 'ayudante';

            $dpto = Asignatura::join('carrera','asignatura.carrera_id','=','carrera.id')
                            ->join('escuela','carrera.escuela_id','=','escuela.id')
                            ->join('departamento','escuela.departamento_id','=','departamento.id')
                            ->where('asignatura.id','=',$request->get('asignatura_id'))
                            ->select('departamento.id')
                            ->get();

            $dpto = $dpto->first()->id;

            $docentes = User::join('rol_users','users.rut','=','rol_users.rut')
                        ->join('rol','rol_users.rol_id','=','rol.id')
                        ->join('users_dpto','users.rut','=','users_dpto.rut')
                        ->where('rol.nombre','=',$doc)
                        ->where('users_dpto.departamento_id','=',$dpto)
                        ->select('users.*')
                        ->get();

            $ayudantes = User::join('rol_users','users.rut','=','rol_users.rut')
                            ->join('rol','rol_users.rol_id','=','rol.id')
                            ->join('users_dpto','users.rut','=','users_dpto.rut')
                            ->where('rol.nombre','=',$ayu)
                            ->where('users_dpto.departamento_id','=',$dpto)
                            ->select('users.*')
                            ->get();

            $result = array('docentes' => $docentes,'ayudantes' => $ayudantes );
  
            return response()->json($result);
        }

        $this->validate($request, [
                'asignatura_id' => 'required',
                'semestre' => 'required|numeric|max:2',
                'anio' => 'required|numeric|digits:4',
                'seccion' => 'required|numeric'
                ]);

        $esta = Curso::where('asignatura_id','=',$request->get('asignatura_id'))
                     ->where('semestre','=',$request->get('semestre'))
                     ->where('anio','=',$request->get('anio'))
                     ->where('seccion','=',$request->get('seccion'))
                     ->select('id')
                     ->get();

        if(!$esta->isEmpty())
        {
            Session::flash('create','¡Curso creado con anterioridad!');
            return redirect()->route('administrador.curso.index');
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
                if($request->get('optradio')=='no')
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
            }
            else
            {
                if($request->get('optradio')=='no')
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
            }

            Session::flash('create','¡Curso creado correctamente!');
            return redirect()->route('administrador.curso.index');
        }
        else
        {
            Session::flash('create','¡Curso no puede ser creado! Ingrese un semestre válido Ej: 1 ó 2');
            return redirect()->route('administrador.curso.create');
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
        $doc = 'docente';
        $ayu = 'ayudante';

        $docentes = User::join('rol_users','users.rut','=','rol_users.rut')
                                ->join('rol','rol_users.rol_id','=','rol.id')
                                ->where('rol.nombre','=',$doc)
                                ->select('users.*')
                                ->get();

        $ayudantes = User::join('rol_users','users.rut','=','rol_users.rut')
                        ->join('rol','rol_users.rol_id','=','rol.id')
                        ->where('rol.nombre','=',$ayu)
                        ->select('users.*')
                        ->get();

        $cursos = Curso::findOrFail($id);
        //en el compact se pasa la variable como string
        $asignaturas = Asignatura::join('carrera','asignatura.carrera_id','=','carrera.id')
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
            return view ('Administrador/cursos/edit', compact('docentes','ayudantes','cursos','asignaturas','v2','cont'));
        }
        else
        {
            return view ('Administrador/cursos/edit', compact('docentes','ayudantes','cursos','asignaturas','cont'));
        }
        //return view('Administrador/cursos/edit', compact('cursos','asignaturas'));
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
        if($request->ajax()){
            //dd($request);
            $doc = 'docente';
            $ayu = 'ayudante';

            $dpto = Asignatura::join('carrera','asignatura.carrera_id','=','carrera.id')
                            ->join('escuela','carrera.escuela_id','=','escuela.id')
                            ->join('departamento','escuela.departamento_id','=','departamento.id')
                            ->where('asignatura.id','=',$request->get('asignatura_id'))
                            ->select('departamento.id')
                            ->get();

            $dpto = $dpto->first()->id;

            $docentes = User::join('rol_users','users.rut','=','rol_users.rut')
                        ->join('rol','rol_users.rol_id','=','rol.id')
                        ->join('users_dpto','users.rut','=','users_dpto.rut')
                        ->where('rol.nombre','=',$doc)
                        ->where('users_dpto.departamento_id','=',$dpto)
                        ->select('users.*')
                        ->get();

            $ayudantes = User::join('rol_users','users.rut','=','rol_users.rut')
                            ->join('rol','rol_users.rol_id','=','rol.id')
                            ->join('users_dpto','users.rut','=','users_dpto.rut')
                            ->where('rol.nombre','=',$ayu)
                            ->where('users_dpto.departamento_id','=',$dpto)
                            ->select('users.*')
                            ->get();

            $result = array('docentes' => $docentes,'ayudantes' => $ayudantes );

            return response()->json($result);
        }

        $this->validate($request, [
                'asignatura_id' => 'required',
                'semestre' => 'required|numeric|max:2',
                'anio' => 'required|numeric|digits:4',
                'seccion' => 'required|numeric'
                ]);
        
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
            return redirect()->route('administrador.curso.index');
        }
        //dd($request);
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
            return redirect()->route('administrador.curso.index');
        }
        else
        {
            Session::flash('create','¡Curso no puede ser editado! Ingrese un semestre válido Ej: 1 ó 2 e intente nuevamente');
            return redirect()->route('administrador.curso.index');
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
        return redirect()->route('administrador.curso.index');
    }

    public function uploadCur(Request $request)
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
                    
                    $rutD = preg_replace('/[^k0-9]/i', '', $value->docente);
                    $dv  = substr($rutD, -1);
                    $numero = substr($rutD, 0, strlen($rutD)-1);
                    //dd($numero);
                    $i = 2;
                    $suma = 0;
                    foreach(array_reverse(str_split($numero)) as $v)
                    {
                        if($i==8)
                            $i = 2;
                        $suma += $v * $i;
                        ++$i;
                    }
                    $dvr = 11 - ($suma % 11);
                    
                    if($dvr == 11)
                        $dvr = 0;
                    if($dvr == 10)
                        $dvr = 'K';
                    if($dvr == strtoupper($dv))
                        $ok='si';
                    else
                        $ok='no';

                    if($ok == 'no')
                    {
                        Session::flash('message','¡Existen rut de docentes inválidos!');
                        return redirect()->route('administrador.curso.index');
                    }
                    else
                    {
                        if($value->ayudante != 'no')
                        {
                            $rutA = preg_replace('/[^k0-9]/i', '', $value->ayudante);
                            $dv  = substr($rutA, -1);
                            $numero2 = substr($rutA, 0, strlen($rutA)-1);
                            //dd($numero);
                            $i = 2;
                            $suma = 0;
                            foreach(array_reverse(str_split($numero2)) as $v)
                            {
                                if($i==8)
                                    $i = 2;
                                $suma += $v * $i;
                                ++$i;
                            }
                            $dvr = 11 - ($suma % 11);
                            
                            if($dvr == 11)
                                $dvr = 0;
                            if($dvr == 10)
                                $dvr = 'K';
                            if($dvr == strtoupper($dv))
                                $ok='si';
                            else
                                $ok='no';
                        }
                        else
                        {
                            $numero2 = $value->ayudante;
                        }
                    }
                    if($ok == 'no')
                    {
                        Session::flash('message','¡Existen rut de ayudantes inválidos!');
                        return redirect()->route('administrador.curso.index');
                    }

                    $carr = Carrera::where('codigo','=',$value->carrera)
                                                    ->select('id')
                                                    ->get();

                    $carr = $carr->first()->id;

                    $asig = Asignatura::where('codigo','=',$value->asignatura)
                                        ->where('carrera_id','=',$carr)
                                        ->select('id')
                                        ->get();

                    $asig = $asig->first()->id;

                    $curso = Curso::where('asignatura_id','=',$asig)
                         ->where('semestre','=',$value->semestre)
                         ->where('anio','=',$value->anio)
                         ->where('seccion','=',$value->seccion)
                         ->where('docente','=',$numero)
                         ->where('ayudante','=',$numero2)
                         ->select('id')
                         ->get();

                    if(!$curso->isEmpty())
                    {
                        Session::flash('message','¡Curso ya creado anteriormente!');
                        return redirect()->route('administrador.curso.index');
                    }

                    $var = new Curso();
                    $var->fill(['asignatura_id' => $asig, 'semestre'=> $value->semestre, 'anio'=> $value->anio, 'seccion'=> $value->seccion, 'docente'=> $numero, 'ayudante' => $numero2]);
                    $var->save();
                }
                Session::flash('create', 'Cursos creados exitosamente!');
           
            })->get();
            return redirect()->route('administrador.curso.index');
    }
}
