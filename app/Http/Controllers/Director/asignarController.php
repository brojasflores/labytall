<?php

namespace App\Http\Controllers\Director;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\UsersDpto;
use App\User;
use App\Sala;
use App\Periodo;
use App\Curso;
use App\Asignatura;
use App\Horario;
use App\Estacion_trabajo;
use App\RolUsuario;
use App\Rol;
use Carbon\Carbon;


class asignarController extends Controller
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
            return view ('Director/asignar/index',compact('v2','cont'));
        }
        else
        {
            return view ('Director/asignar/index',compact('cont'));
        }

        //return view ('Administrador/asignar/index');
    }

    public function docente()
    {
        //$salas = Sala::select('id','nombre')->orderBy('nombre','asc')->get();
        $usr=Auth::User()->rut;
        $dpto= UsersDpto::where('rut','=',$usr)
                        ->select('departamento_id')
                        ->get();

        $salas= Sala::where('departamento_id','=',$dpto->first()->departamento_id)
                        ->select('id','nombre')->orderBy('nombre','asc')
                        ->get();

        $periodos = Periodo::select('id','bloque')
                            ->orderBy('id','asc')->get();

        $cursos = Curso::join('asignatura','curso.asignatura_id','=','asignatura.id')
                       ->join('carrera','carrera.id','=','asignatura.carrera_id')
                       ->join('escuela','escuela.id','=','carrera.escuela_id')
                       ->join('departamento','departamento.id','=','escuela.departamento_id')
                       ->where('departamento.id',$dpto->first()->departamento_id)
                       ->select('curso.id','curso.seccion','asignatura.nombre')
                       ->orderBy('asignatura.nombre','asc')
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
            return view ('Director/asignar/docente',compact('salas','periodos','cursos','v2','cont'));
        }
        else
        {
            return view ('Director/asignar/docente',compact('salas','periodos','cursos','cont'));
        }

        //return view ('Administrador/asignar/docente',compact('salas','periodos','cursos'));
    }

    public function ayudante()
    {
        $usr=Auth::User()->rut;
        $dpto= UsersDpto::where('rut','=',$usr)
                        ->select('departamento_id')
                        ->get();

        $salas= Sala::where('departamento_id','=',$dpto->first()->departamento_id)
                        ->select('id','nombre')->orderBy('nombre','asc')
                        ->get();

        $periodos = Periodo::select('id','bloque')
                            ->orderBy('id','asc')->get();

        $cursos = Curso::join('asignatura','curso.asignatura_id','=','asignatura.id')
                       ->join('carrera','carrera.id','=','asignatura.carrera_id')
                       ->join('escuela','escuela.id','=','carrera.escuela_id')
                       ->join('departamento','departamento.id','=','escuela.departamento_id')
                       ->where('departamento.id',$dpto->first()->departamento_id)
                       ->select('curso.id','curso.seccion','asignatura.nombre')
                       ->orderBy('asignatura.nombre','asc')
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
            return view ('Director/asignar/ayudante',compact('salas','periodos','cursos','v2','cont'));
        }
        else
        {
            return view ('Director/asignar/ayudante',compact('salas','periodos','cursos','cont'));
        }
        //return view ('Administrador/asignar/ayudante',compact('salas','periodos','cursos'));
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

        if($request->get('permanencia') === 'dia')
        {
            $fecha_separada = explode('/',$request->get('fecha'));
            $fecha_con_guion = [$fecha_separada[2],$fecha_separada[0],$fecha_separada[1]];
            $fecha_formateada = implode('-',$fecha_con_guion);
        }

        if($request->get('permanencia') === 'semestral')
        {
            $fecha_separada = explode('/',$request->get('fecha_inicio'));
            $fecha_con_guion = [$fecha_separada[2],$fecha_separada[0],$fecha_separada[1]];
            $fecha_formateada = implode('-',$fecha_con_guion);
        }

        $curso = Horario::where('curso_id','=',$request->get('curso'))
                        ->where('fecha','=',$fecha_formateada)
                        ->get(); 

        if($curso->count() == 0)
        {
            //insertar max 2 registros
            if($request->get('rol') == 'docente')
            {
                $docente = RolUsuario::join('rol','rol.id','=','rol_users.rol_id')
                                    ->where('rol_users.rut','=',$request->get('usuario'))->select('rol.nombre')->get();              
            
                foreach($docente as $d){

                    if($d->nombre == 'docente')
                    {

                        if($request->get('permanencia') === 'dia')
                        {
                            //Formatear la fecha de mm/dd/aaaa => aaaa-mm-dd
                            $fecha_separada = explode('/',$request->get('fecha'));
                            $fecha_con_guion = [$fecha_separada[2],$fecha_separada[0],$fecha_separada[1]];
                            $fecha_formateada = implode('-',$fecha_con_guion);
                       
                            Horario::create([
                                'fecha' => $fecha_formateada,
                                'sala_id' => $request->get('sala'),
                                'periodo_id' => $request->get('periodo'),
                                'curso_id' => $request->get('curso'),
                                'rut' => $request->get('usuario'),
                                'permanencia' => 'dia'
                                ]);
                            //pone disponibilidad en no para un lab completo
                            $id = $request->get('sala');
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
                                $est->fill([
                                'disponibilidad' => "no",
                                ]); 
                                $est->save();
                            }
                            $est->save();

                            return redirect()->route('director.horario.index');
                        }
                        else
                        {
                            if($request->get('permanencia') === 'semestral')
                            {
                                //dd('crea');
                                $fecha_separada1 = explode('/',$request->get('fecha_inicio'));
                                $fecha_con_guion1 = [$fecha_separada1[2],$fecha_separada1[0],$fecha_separada1[1]];
                                $fecha_formateada1 = implode('-',$fecha_con_guion1);

                                $fecha_separada2 = explode('/',$request->get('fecha_fin'));
                                $fecha_con_guion2 = [$fecha_separada2[2],$fecha_separada2[0],$fecha_separada2[1]];
                                $fecha_formateada2 = implode('-',$fecha_con_guion2);

                                $inicio = new Carbon($fecha_formateada1);
                                $termino = new Carbon($fecha_formateada2); 


                                while($inicio <= $termino)
                                {
                                    Carbon::setTestNow($inicio);
                                    if($request->get('dia') === 'lunes')
                                    {
                                        $lunes = new Carbon('this monday');
                                        if($lunes <= $termino)
                                        {
                                        
                                                $lun = Horario::create([
                                                       'fecha' => $lunes,
                                                       'sala_id' => $request->get('sala'),
                                                       'periodo_id' => $request->get('periodo'),
                                                       'curso_id' => $request->get('curso'),
                                                       'rut' => $request->get('usuario'),
                                                       'permanencia' => 'semestral'
                                                       ]);
                                            
                                            $id = $request->get('sala');
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
                                                $est->fill([
                                                'disponibilidad' => "no",
                                                ]); 
                                                $est->save();
                                            }
                                            $est->save();
                                        }
                                    }
                                    if($request->get('dia') === 'martes')
                                    {
                                        $martes = new Carbon('this tuesday');
                                        if($martes <= $termino)
                                        {
                                                                  
                                            $mar = Horario::create([
                                                   'fecha' => $martes,
                                                   'sala_id' => $request->get('sala'),
                                                   'periodo_id' => $request->get('periodo'),
                                                   'curso_id' => $request->get('curso'),
                                                   'rut' => $request->get('usuario'),
                                                   'permanencia' => 'semestral'
                                                   ]);

                                            $id = $request->get('sala');
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
                                                $est->fill([
                                                'disponibilidad' => "no",
                                                ]); 
                                                $est->save();
                                            }
                                            $est->save();
                                        }
                                    }
                                    if($request->get('dia') === 'miercoles')
                                    {
                                        $miercoles = new Carbon('this wednesday');
                                        if($miercoles <= $termino)
                                        {

                                            $mier = Horario::create([
                                                   'fecha' => $miercoles,
                                                   'sala_id' => $request->get('sala'),
                                                   'periodo_id' => $request->get('periodo'),
                                                   'curso_id' => $request->get('curso'),
                                                   'rut' => $request->get('usuario'),
                                                   'permanencia' => 'semestral'
                                                   ]);
                                            
                                            $id = $request->get('sala');
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
                                                $est->fill([
                                                'disponibilidad' => "no",
                                                ]); 
                                                $est->save();
                                            }
                                            $est->save();
                                        }
                                    }
                                    if($request->get('dia') === 'jueves')
                                    {
                                        $jueves = new Carbon('this thursday');
                                        if($jueves <= $termino)
                                        {
                                                                   
                                            $jue = Horario::create([
                                                   'fecha' => $jueves,
                                                   'sala_id' => $request->get('sala'),
                                                   'periodo_id' => $request->get('periodo'),
                                                   'curso_id' => $request->get('curso'),
                                                   'rut' => $request->get('usuario'),
                                                   'permanencia' => 'semestral'
                                                   ]);
                                            
                                            $id = $request->get('sala');
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
                                                $est->fill([
                                                'disponibilidad' => "no",
                                                ]); 
                                                $est->save();
                                            }
                                            $est->save();
                                        }
                                    }
                                    if($request->get('dia') === 'viernes')
                                    {
                                        $viernes = new Carbon('this friday');
                                        if($viernes <= $termino)
                                        {

                                            $vier = Horario::create([
                                                   'fecha' => $viernes,
                                                   'sala_id' => $request->get('sala'),
                                                   'periodo_id' => $request->get('periodo'),
                                                   'curso_id' => $request->get('curso'),
                                                   'rut' => $request->get('usuario'),
                                                   'permanencia' => 'semestral'
                                                   ]);
                                            

                                            $id = $request->get('sala');
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
                                                $est->fill([
                                                'disponibilidad' => "no",
                                                ]); 
                                                $est->save();
                                            }
                                            $est->save();
                                        }
                                    }
                                    if($request->get('dia') === 'sabado')
                                    {
                                        $sabado = new Carbon('this saturday');
                                        if($sabado <= $termino)
                                        {

                                            $sab = Horario::create([
                                                   'fecha' => $sabado,
                                                   'sala_id' => $request->get('sala'),
                                                   'periodo_id' => $request->get('periodo'),
                                                   'curso_id' => $request->get('curso'),
                                                   'rut' => $request->get('usuario'),
                                                   'permanencia' => 'semestral'
                                                   ]);
                                            

                                            $id = $request->get('sala');
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
                                                $est->fill([
                                                'disponibilidad' => "no",
                                                ]); 
                                                $est->save();
                                            }
                                            $est->save();
                                        }
                                    }
                                    $inicio->addWeek(1);
                                }
                            }
                            return redirect()->route('director.horario.index');
                        }
                    }
                }
            }

            if($request->get('rol') == 'ayudante')
            {
                $docente = RolUsuario::join('rol','rol.id','=','rol_users.rol_id')
                                    ->where('rol_users.rut','=',$request->get('usuario'))->select('rol.nombre')->get();

                foreach($docente as $d){

                    if($d->nombre == 'ayudante')
                    {
                        if($request->get('permanencia') === 'dia')
                        {
                            //Formatear la fecha de mm/dd/aaaa => aaaa-mm-dd
                            $fecha_separada = explode('/',$request->get('fecha'));
                            $fecha_con_guion = [$fecha_separada[2],$fecha_separada[0],$fecha_separada[1]];
                            $fecha_formateada = implode('-',$fecha_con_guion);
                       
                            Horario::create([
                                'fecha' => $fecha_formateada,
                                'sala_id' => $request->get('sala'),
                                'periodo_id' => $request->get('periodo'),
                                'curso_id' => $request->get('curso'),
                                'rut' => $request->get('usuario'),
                                'permanencia' => 'dia'
                                ]);
                            //pone disponibilidad en no para un lab completo
                            $id = $request->get('sala');
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
                                $est->fill([
                                'disponibilidad' => "no",
                                ]); 
                                $est->save();
                            }
                            $est->save();

                            return redirect()->route('director.horario.index');
                        }
                        else
                        {
                            if($request->get('permanencia') === 'semestral')
                            {

                                $fecha_separada1 = explode('/',$request->get('fecha_inicio'));
                                $fecha_con_guion1 = [$fecha_separada1[2],$fecha_separada1[0],$fecha_separada1[1]];
                                $fecha_formateada1 = implode('-',$fecha_con_guion1);

                                $fecha_separada2 = explode('/',$request->get('fecha_fin'));
                                $fecha_con_guion2 = [$fecha_separada2[2],$fecha_separada2[0],$fecha_separada2[1]];
                                $fecha_formateada2 = implode('-',$fecha_con_guion2);

                                $inicio = new Carbon($fecha_formateada1);
                                $termino = new Carbon($fecha_formateada2);

                                while($inicio <= $termino)
                                {
                                    Carbon::setTestNow($inicio);
                                    if($request->get('dia') === 'lunes')
                                    {
                                        $lunes = new Carbon('this monday');
                                        if($lunes <= $termino)
                                        {
                                        
                                                $lun = Horario::create([
                                                       'fecha' => $lunes,
                                                       'sala_id' => $request->get('sala'),
                                                       'periodo_id' => $request->get('periodo'),
                                                       'curso_id' => $request->get('curso'),
                                                       'rut' => $request->get('usuario'),
                                                       'permanencia' => 'semestral'
                                                       ]);
                                            
                                            $id = $request->get('sala');
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
                                                $est->fill([
                                                'disponibilidad' => "no",
                                                ]); 
                                                $est->save();
                                            }
                                            $est->save();
                                        }
                                    }
                                    if($request->get('dia') === 'martes')
                                    {
                                        $martes = new Carbon('this tuesday');
                                        if($martes <= $termino)
                                        {
                                                                  
                                            $mar = Horario::create([
                                                   'fecha' => $martes,
                                                   'sala_id' => $request->get('sala'),
                                                   'periodo_id' => $request->get('periodo'),
                                                   'curso_id' => $request->get('curso'),
                                                   'rut' => $request->get('usuario'),
                                                   'permanencia' => 'semestral'
                                                   ]);

                                            $id = $request->get('sala');
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
                                                $est->fill([
                                                'disponibilidad' => "no",
                                                ]); 
                                                $est->save();
                                            }
                                            $est->save();
                                        }
                                    }
                                    if($request->get('dia') === 'miercoles')
                                    {
                                        $miercoles = new Carbon('this wednesday');
                                        if($miercoles <= $termino)
                                        {

                                            $mier = Horario::create([
                                                   'fecha' => $miercoles,
                                                   'sala_id' => $request->get('sala'),
                                                   'periodo_id' => $request->get('periodo'),
                                                   'curso_id' => $request->get('curso'),
                                                   'rut' => $request->get('usuario'),
                                                   'permanencia' => 'semestral'
                                                   ]);
                                            
                                            $id = $request->get('sala');
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
                                                $est->fill([
                                                'disponibilidad' => "no",
                                                ]); 
                                                $est->save();
                                            }
                                            $est->save();
                                        }
                                    }
                                    if($request->get('dia') === 'jueves')
                                    {
                                        $jueves = new Carbon('this thursday');
                                        if($jueves <= $termino)
                                        {
                                                                   
                                            $jue = Horario::create([
                                                   'fecha' => $jueves,
                                                   'sala_id' => $request->get('sala'),
                                                   'periodo_id' => $request->get('periodo'),
                                                   'curso_id' => $request->get('curso'),
                                                   'rut' => $request->get('usuario'),
                                                   'permanencia' => 'semestral'
                                                   ]);
                                            
                                            $id = $request->get('sala');
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
                                                $est->fill([
                                                'disponibilidad' => "no",
                                                ]); 
                                                $est->save();
                                            }
                                            $est->save();
                                        }
                                    }
                                    if($request->get('dia') === 'viernes')
                                    {
                                        $viernes = new Carbon('this friday');
                                        if($viernes <= $termino)
                                        {

                                            $vier = Horario::create([
                                                   'fecha' => $viernes,
                                                   'sala_id' => $request->get('sala'),
                                                   'periodo_id' => $request->get('periodo'),
                                                   'curso_id' => $request->get('curso'),
                                                   'rut' => $request->get('usuario'),
                                                   'permanencia' => 'semestral'
                                                   ]);
                                            

                                            $id = $request->get('sala');
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
                                                $est->fill([
                                                'disponibilidad' => "no",
                                                ]); 
                                                $est->save();
                                            }
                                            $est->save();
                                        }
                                    }
                                    if($request->get('dia') === 'sabado')
                                    {
                                        $sabado = new Carbon('this saturday');
                                        if($sabado <= $termino)
                                        {

                                            $sab = Horario::create([
                                                   'fecha' => $sabado,
                                                   'sala_id' => $request->get('sala'),
                                                   'periodo_id' => $request->get('periodo'),
                                                   'curso_id' => $request->get('curso'),
                                                   'rut' => $request->get('usuario'),
                                                   'permanencia' => 'semestral'
                                                   ]);
                                            

                                            $id = $request->get('sala');
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
                                                $est->fill([
                                                'disponibilidad' => "no",
                                                ]); 
                                                $est->save();
                                            }
                                            $est->save();
                                        }
                                    }
                                    $inicio->addWeek(1);
                                }
                            }
                            return redirect()->route('director.horario.index');
                        }
                    }
                }
            }
        }

        if($curso->count() == 1)
        {
            foreach($curso as $c)
            {
                if($c->periodo_id != $request->get('periodo'))
                {
                    //insertar
                    if($request->get('rol') == 'docente')
                    {
                        $docente = RolUsuario::join('rol','rol.id','=','rol_users.rol_id')
                                            ->where('rol_users.rut','=',$request->get('usuario'))->select('rol.nombre')->get();

                        foreach($docente as $d){

                            if($d->nombre == 'docente')
                            {
                                if($request->get('permanencia') === 'dia')
                                {
                                    //Formatear la fecha de mm/dd/aaaa => aaaa-mm-dd
                                    $fecha_separada = explode('/',$request->get('fecha'));
                                    $fecha_con_guion = [$fecha_separada[2],$fecha_separada[0],$fecha_separada[1]];
                                    $fecha_formateada = implode('-',$fecha_con_guion);
                               
                                    Horario::create([
                                        'fecha' => $fecha_formateada,
                                        'sala_id' => $request->get('sala'),
                                        'periodo_id' => $request->get('periodo'),
                                        'curso_id' => $request->get('curso'),
                                        'rut' => $request->get('usuario'),
                                        'permanencia' => 'dia'
                                        ]);
                                    //pone disponibilidad en no para un lab completo
                                    $id = $request->get('sala');
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
                                        $est->fill([
                                        'disponibilidad' => "no",
                                        ]); 
                                        $est->save();
                                    }
                                    $est->save();

                                    return redirect()->route('director.horario.index');
                                }
                                else
                                {
                                    if($request->get('permanencia') === 'semestral')
                                    {

                                        $fecha_separada1 = explode('/',$request->get('fecha_inicio'));
                                        $fecha_con_guion1 = [$fecha_separada1[2],$fecha_separada1[0],$fecha_separada1[1]];
                                        $fecha_formateada1 = implode('-',$fecha_con_guion1);

                                        $fecha_separada2 = explode('/',$request->get('fecha_fin'));
                                        $fecha_con_guion2 = [$fecha_separada2[2],$fecha_separada2[0],$fecha_separada2[1]];
                                        $fecha_formateada2 = implode('-',$fecha_con_guion2);

                                        $inicio = new Carbon($fecha_formateada1);
                                        $termino = new Carbon($fecha_formateada2);

                                        while($inicio <= $termino)
                                        {
                                            Carbon::setTestNow($inicio);
                                            if($request->get('dia') === 'lunes')
                                            {
                                                $lunes = new Carbon('this monday');
                                                if($lunes <= $termino)
                                                {

                                                    $lun = Horario::create([
                                                           'fecha' => $lunes,
                                                           'sala_id' => $request->get('sala'),
                                                           'periodo_id' => $request->get('periodo'),
                                                           'curso_id' => $request->get('curso'),
                                                           'rut' => $request->get('usuario'),
                                                           'permanencia' => 'semestral'
                                                           ]);
                                                    
                                                    $id = $request->get('sala');
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
                                                        $est->fill([
                                                        'disponibilidad' => "no",
                                                        ]); 
                                                        $est->save();
                                                    }
                                                    $est->save();
                                                }
                                            }
                                            if($request->get('dia') === 'martes')
                                            {
                                                $martes = new Carbon('this tuesday');
                                                if($martes <= $termino)
                                                {
                                                                       
                                                    $mar = Horario::create([
                                                           'fecha' => $martes,
                                                           'sala_id' => $request->get('sala'),
                                                           'periodo_id' => $request->get('periodo'),
                                                           'curso_id' => $request->get('curso'),
                                                           'rut' => $request->get('usuario'),
                                                           'permanencia' => 'semestral'
                                                           ]);
                                                    

                                                    $id = $request->get('sala');
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
                                                        $est->fill([
                                                        'disponibilidad' => "no",
                                                        ]); 
                                                        $est->save();
                                                    }
                                                    $est->save();
                                                }
                                            }
                                            if($request->get('dia') === 'miercoles')
                                            {
                                                $miercoles = new Carbon('this wednesday');
                                                if($miercoles <= $termino)
                                                {
                                                    $mier = Horario::create([
                                                           'fecha' => $miercoles,
                                                           'sala_id' => $request->get('sala'),
                                                           'periodo_id' => $request->get('periodo'),
                                                           'curso_id' => $request->get('curso'),
                                                           'rut' => $request->get('usuario'),
                                                           'permanencia' => 'semestral'
                                                           ]);
                                                    
                                                    $id = $request->get('sala');
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
                                                        $est->fill([
                                                        'disponibilidad' => "no",
                                                        ]); 
                                                        $est->save();
                                                    }
                                                    $est->save();
                                                }
                                            }
                                            if($request->get('dia') === 'jueves')
                                            {
                                                $jueves = new Carbon('this thursday');
                                                if($jueves <= $termino)
                                                {                       
                                                    $jue = Horario::create([
                                                           'fecha' => $jueves,
                                                           'sala_id' => $request->get('sala'),
                                                           'periodo_id' => $request->get('periodo'),
                                                           'curso_id' => $request->get('curso'),
                                                           'rut' => $request->get('usuario'),
                                                           'permanencia' => 'semestral'
                                                           ]);
                                                    

                                                    $id = $request->get('sala');
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
                                                        $est->fill([
                                                        'disponibilidad' => "no",
                                                        ]); 
                                                        $est->save();
                                                    }
                                                    $est->save();
                                                }
                                            }
                                            if($request->get('dia') === 'viernes')
                                            {
                                                $viernes = new Carbon('this friday');
                                                if($viernes <= $termino)
                                                {
                                                    $vier = Horario::create([
                                                           'fecha' => $viernes,
                                                           'sala_id' => $request->get('sala'),
                                                           'periodo_id' => $request->get('periodo'),
                                                           'curso_id' => $request->get('curso'),
                                                           'rut' => $request->get('usuario'),
                                                           'permanencia' => 'semestral'
                                                           ]);         

                                                    $id = $request->get('sala');
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
                                                        $est->fill([
                                                        'disponibilidad' => "no",
                                                        ]); 
                                                        $est->save();
                                                    }
                                                    $est->save();
                                                }
                                            }
                                            if($request->get('dia') === 'sabado')
                                            {
                                                $sabado = new Carbon('this saturday');
                                                if($sabado <= $termino)
                                                {
                                                        $sab = Horario::create([
                                                               'fecha' => $sabado,
                                                               'sala_id' => $request->get('sala'),
                                                               'periodo_id' => $request->get('periodo'),
                                                               'curso_id' => $request->get('curso'),
                                                               'rut' => $request->get('usuario'),
                                                               'permanencia' => 'semestral'
                                                               ]);
                                                

                                                    $id = $request->get('sala');
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
                                                        $est->fill([
                                                        'disponibilidad' => "no",
                                                        ]); 
                                                        $est->save();
                                                    }
                                                    $est->save();
                                                }
                                            }
                                            $inicio->addWeek(1);
                                        }
                                    }
                                    return redirect()->route('director.horario.index');
                                }
                            }
                        }
                    }
                    if($request->get('rol') == 'ayudante')
                    {
                        //devolver mensaje de periodo por ayudante(max 1)
                        return redirect()->route('director.horario.index');
                    }

                }
                else
                {
                    //devolver mensaje de periodo que son iguales
                    return redirect()->route('director.horario.index');
                }

            }
        }

        if($curso->count() > 1)
        {
            //devuelve mensaje 
            return redirect()->route('director.horario.index');
        }


    //Validación de la asignación        
        
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