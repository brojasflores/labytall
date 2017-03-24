<?php

namespace App\Http\Controllers\Funcionario;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\User;
use App\UsersDpto;
use App\Sala;
use App\Periodo;
use App\Curso;
use App\Asignatura;
use App\Horario;
use App\Horario_Alumno;
use App\Estacion_trabajo;
use App\RolUsuario;
use App\Rol;
use Carbon\Carbon;
use Session;


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
        $this->middleware('funci');
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
            return view ('Funcionario/asignar/index',compact('v2','cont'));
        }
        else
        {
            return view ('Funcionario/asignar/index',compact('cont'));
        }

        //return view ('Funcionario/asignar/index');
    }

    public function docente()
    {
        $usr=Auth::User()->rut;
        $dpto= UsersDpto::where('rut','=',$usr)
                        ->select('departamento_id')
                        ->get();

        $salas= Sala::where('departamento_id','=',$dpto->first()->departamento_id)
                        ->select('id','nombre')->orderBy('nombre','asc')->get();

        //$salas = Sala::select('id','nombre')->orderBy('nombre','asc')->get();
        $periodos = Periodo::select('id','bloque')
                            ->orderBy('id','asc')->get();

        /*$cursos = Curso::join('asignatura','curso.asignatura_id','=','asignatura.id')
                        ->select('curso.id','curso.seccion','asignatura.nombre')
                        ->orderBy('asignatura.nombre','asc')
                        ->get();*/

        $cursos = Curso::join('asignatura','curso.asignatura_id','=','asignatura.id')
                           ->join('carrera','asignatura.carrera_id','=','carrera.id')
                           ->join('escuela','carrera.escuela_id','=','escuela.id')
                           ->join('departamento','escuela.departamento_id','=','departamento.id')
                           ->where('departamento.id','=',$dpto->first()->departamento_id)
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
            return view ('Funcionario/asignar/docente',compact('salas','periodos','cursos','v2','cont'));
        }
        else
        {
            return view ('Funcionario/asignar/docente',compact('salas','periodos','cursos','cont'));
        }

        //return view ('Funcionario/asignar/docente',compact('salas','periodos','cursos'));
    }

    public function ayudante()
    {
        $usr=Auth::User()->rut;
        $dpto= UsersDpto::where('rut','=',$usr)
                        ->select('departamento_id')
                        ->get();

        $salas= Sala::where('departamento_id','=',$dpto->first()->departamento_id)
                        ->select('id','nombre')->orderBy('nombre','asc')->get();

        //$salas = Sala::select('id','nombre')->orderBy('nombre','asc')->get();
        $periodos = Periodo::select('id','bloque')
                            ->orderBy('id','asc')->get();

        /*$cursos = Curso::join('asignatura','curso.asignatura_id','=','asignatura.id')
                        ->select('curso.id','curso.seccion','asignatura.nombre')
                        ->orderBy('asignatura.nombre','asc')
                        ->get();*/

        $cursos = Curso::join('asignatura','curso.asignatura_id','=','asignatura.id')
                           ->join('carrera','asignatura.carrera_id','=','carrera.id')
                           ->join('escuela','carrera.escuela_id','=','escuela.id')
                           ->join('departamento','escuela.departamento_id','=','departamento.id')
                           ->where('departamento.id','=',$dpto->first()->departamento_id)
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
            return view ('Funcionario/asignar/ayudante',compact('salas','periodos','cursos','v2','cont'));
        }
        else
        {
            return view ('Funcionario/asignar/ayudante',compact('salas','periodos','cursos','cont'));
        }
        //return view ('Funcionario/asignar/ayudante',compact('salas','periodos','cursos'));
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
        if($request->get('permanencia') == 'dia')
        {
            $dsem = array('domingo','lunes','martes','miercoles','jueves','viernes','sabado');
            $diasemana = $dsem[date('N', strtotime($request->get('fecha')))];
        }

        if($request->get('rol')=='docente')
        {
            if($request->get('permanencia') == 'dia')
            {
                if($request->get('fecha')==null)
                {
                    //seleccione un dia en el calenario
                    Session::flash('create','¡Seleccione un día en el calendario!');
                    return redirect()->route('funcionario.asignar.docente');
                }
            }
            else
            {
                if($request->get('permanencia')=='semestral')
                {
                    if($request->get('fecha_inicio')==null || $request->get('fecha_fin')==null)
                    {
                        //seleccione fecha inicio y fecha fin en el calendario
                        Session::flash('create','¡Seleccione fecha inicio y fin en el calendario!');
                        return redirect()->route('funcionario.asignar.docente');
                    }
                }
                else
                {
                    Session::flash('create','¡Ingrese permanencia!');
                    return redirect()->route('funcionario.asignar.docente');
                }
            }
            
        }

        if($request->get('rol')=='ayudante')
        {
            if($request->get('permanencia') == 'dia')
            {
                if($request->get('fecha')==null)
                {
                    //seleccione un dia en el calenario
                    Session::flash('create','¡Seleccione un día en el calendario!');
                    return redirect()->route('funcionario.asignar.ayudante');
                }
            }
            else
            {
                if($request->get('permanencia')=='semestral')
                {
                    if($request->get('fecha_inicio')==null || $request->get('fecha_fin')==null)
                    {
                        //seleccione fecha inicio y fecha fin en el calendario
                        Session::flash('create','¡Seleccione fecha inicio y fin en el calendario!');
                        return redirect()->route('funcionario.asignar.ayudante');
                    }
                }
                else
                {
                    Session::flash('create','¡Ingrese permanencia!');
                    return redirect()->route('funcionario.asignar.ayudante');
                }
            }
            
        }
        //           

        if($request->get('permanencia') === 'dia')
        {
            $si=0;

            $fecha_separada = explode('/',$request->get('fecha'));
            $fecha_con_guion = [$fecha_separada[2],$fecha_separada[0],$fecha_separada[1]];
            $fecha_formateada = implode('-',$fecha_con_guion);

            $con = Horario::where('fecha','=',$fecha_formateada)
                      ->where('periodo_id','=',$request->get('periodo_id'))
                      ->where('sala_id','=',$request->get('sala_id'))
                      ->select('id')
                      ->get();

            $con2 = Horario_Alumno::where('fecha','=',$fecha_formateada)
                          ->where('periodo_id','=',$request->get('periodo_id'))
                          ->where('sala_id','=',$request->get('sala_id'))
                          ->select('id')
                          ->get();
            
            if($con->isEmpty() && $con2->isEmpty())
            {
                $si=$si;
            }
            else
            {
                $si=$si+1;
            }

        }

        if($request->get('permanencia') === 'semestral')
        {
            $fecha_separada1 = explode('/',$request->get('fecha_inicio'));
            $fecha_con_guion1 = [$fecha_separada1[2],$fecha_separada1[0],$fecha_separada1[1]];
            $fecha_formateada = implode('-',$fecha_con_guion1);

            $fecha_separada2 = explode('/',$request->get('fecha_fin'));
            $fecha_con_guion2 = [$fecha_separada2[2],$fecha_separada2[0],$fecha_separada2[1]];
            $fecha_formateada2 = implode('-',$fecha_con_guion2);

            $inicio = new Carbon($fecha_formateada);
            $termino = new Carbon($fecha_formateada2); 

            if($inicio>$termino)
            {
                Session::flash('create','¡La fecha final debe ser mayor a la fecha inicial, intente nuevamente!');
                return redirect()->route('funcionario.horario.index');
            }

            $i=0;
            $si=0;

            while($inicio <= $termino)
            {
                Carbon::setTestNow($inicio);
                if($request->get('dia') === 'lunes')
                {
                    $lunes = new Carbon('this monday');
                    if($lunes <= $termino)
                    {
                        $lunes = substr($lunes,0,-9);
                        $fech[$i] = $lunes;
                        //dd($fech[$i]);
                        $con = Horario::where('fecha','=',$fech[$i])
                              ->where('periodo_id','=',$request->get('periodo_id'))
                              ->where('sala_id','=',$request->get('sala_id'))
                              ->select('id')
                              ->get();

                        $con2 = Horario_Alumno::where('fecha','=',$fech[$i])
                                      ->where('periodo_id','=',$request->get('periodo_id'))
                                      ->where('sala_id','=',$request->get('sala_id'))
                                      ->select('id')
                                      ->get();

                        if($con->isEmpty())
                        {
                            $si=$si;
                        }
                        else
                        {
                            $si=$si+1;
                        }
                    }
                }
                if($request->get('dia') === 'martes')
                {
                    $martes = new Carbon('this tuesday');
                    if($martes <= $termino)
                    {
                        $martes = substr($martes,0,-9);
                        $fech[$i] = $martes;
                        //dd($fech[$i]);
                        $con = Horario::where('fecha','=',$fech[$i])
                              ->where('periodo_id','=',$request->get('periodo_id'))
                              ->where('sala_id','=',$request->get('sala_id'))
                              ->select('id')
                              ->get();

                        $con2 = Horario_Alumno::where('fecha','=',$fech[$i])
                                      ->where('periodo_id','=',$request->get('periodo_id'))
                                      ->where('sala_id','=',$request->get('sala_id'))
                                      ->select('id')
                                      ->get();

                        //dd($con);
                        if($con->isEmpty())
                        {
                            $si=$si;
                        }
                        else
                        {
                            $si=$si+1;
                        }
                    }
                }
                if($request->get('dia') === 'miercoles')
                {
                    $miercoles = new Carbon('this wednesday');
                    if($miercoles <= $termino)
                    {
                        $miercoles = substr($miercoles,0,-9);
                        $fech[$i] = $miercoles;
                        //dd($fech[$i]);
                        $con = Horario::where('fecha','=',$fech[$i])
                              ->where('periodo_id','=',$request->get('periodo_id'))
                              ->where('sala_id','=',$request->get('sala_id'))
                              ->select('id')
                              ->get();

                        $con2 = Horario_Alumno::where('fecha','=',$fech[$i])
                                      ->where('periodo_id','=',$request->get('periodo_id'))
                                      ->where('sala_id','=',$request->get('sala_id'))
                                      ->select('id')
                                      ->get();

                        //dd($con);
                        if($con->isEmpty())
                        {
                            $si=$si;
                        }
                        else
                        {
                            $si=$si+1;
                        }
                    }
                }
                if($request->get('dia') === 'jueves')
                {
                    $jueves = new Carbon('this thursday');
                    if($jueves <= $termino)
                    {
                        $jueves = substr($jueves,0,-9);
                        $fech[$i] = $jueves;
                        //dd($fech[$i]);
                        $con = Horario::where('fecha','=',$fech[$i])
                              ->where('periodo_id','=',$request->get('periodo_id'))
                              ->where('sala_id','=',$request->get('sala_id'))
                              ->select('id')
                              ->get();

                        $con2 = Horario_Alumno::where('fecha','=',$fech[$i])
                                      ->where('periodo_id','=',$request->get('periodo_id'))
                                      ->where('sala_id','=',$request->get('sala_id'))
                                      ->select('id')
                                      ->get();

                        //dd($con);
                        if($con->isEmpty())
                        {
                            $si=$si;
                        }
                        else
                        {
                            $si=$si+1;
                        }
                    }
                }
                if($request->get('dia') === 'viernes')
                {
                    $viernes = new Carbon('this friday');
                    if($viernes <= $termino)
                    {
                        $viernes = substr($viernes,0,-9);
                        $fech[$i] = $viernes;
                        //dd($fech[$i]);
                        $con = Horario::where('fecha','=',$fech[$i])
                              ->where('periodo_id','=',$request->get('periodo_id'))
                              ->where('sala_id','=',$request->get('sala_id'))
                              ->select('id')
                              ->get();

                        $con2 = Horario_Alumno::where('fecha','=',$fech[$i])
                                      ->where('periodo_id','=',$request->get('periodo_id'))
                                      ->where('sala_id','=',$request->get('sala_id'))
                                      ->select('id')
                                      ->get();

                        //dd($con);
                        if($con->isEmpty())
                        {
                            $si=$si;
                        }
                        else
                        {
                            $si=$si+1;
                        }
                    }
                }
                if($request->get('dia') === 'sabado')
                {
                    $sabado = new Carbon('this saturday');
                    if($sabado <= $termino)
                    {
                        $sabado = substr($sabado,0,-9);
                        $fech[$i] = $sabado;
                        //dd($fech[$i]);
                        $con = Horario::where('fecha','=',$fech[$i])
                              ->where('periodo_id','=',$request->get('periodo_id'))
                              ->where('sala_id','=',$request->get('sala_id'))
                              ->select('id')
                              ->get();

                        $con2 = Horario_Alumno::where('fecha','=',$fech[$i])
                                      ->where('periodo_id','=',$request->get('periodo_id'))
                                      ->where('sala_id','=',$request->get('sala_id'))
                                      ->select('id')
                                      ->get();

                        //dd($con);
                        if($con->isEmpty())
                        {
                            $si=$si;
                        }
                        else
                        {
                            $si=$si+1;
                        }
                    }
                }
                $inicio->addWeek(1);
                $i=$i+1;
            }
            //termina la validación de si estan las fechas;
        }

        if($si==0)
        {
            $curso = Horario::where('curso_id','=',$request->get('curso_id'))
                            ->where('fecha','=',$fecha_formateada)
                            ->where('dia','=',$request->get('dia'))
                            ->get(); 

            if($curso->count() == 0)
            {
                //insertar max 2 registros
                if($request->get('rol') == 'docente')
                {
                    $res = Curso::where('id','=',$request->get('curso_id'))
                                        ->select('docente')
                                        ->get();
                    $res = $res->first()->docente;

                    $docente = RolUsuario::join('rol','rol.id','=','rol_users.rol_id')
                                        ->where('rol_users.rut','=',$res)->select('rol.nombre')->get();              
                
                    foreach($docente as $d){

                        if($d->nombre == 'docente')
                        {
                            $res = Curso::where('id','=',$request->get('curso_id'))
                                        ->select('docente')
                                        ->get();
                            $res = $res->first()->docente;

                            if($request->get('permanencia') === 'dia')
                            {
                                //Formatear la fecha de mm/dd/aaaa => aaaa-mm-dd
                                $fecha_separada = explode('/',$request->get('fecha'));
                                $fecha_con_guion = [$fecha_separada[2],$fecha_separada[0],$fecha_separada[1]];
                                $fecha_formateada = implode('-',$fecha_con_guion);

                                Horario::create([
                                    'fecha' => $fecha_formateada,
                                    'sala_id' => $request->get('sala_id'),
                                    'periodo_id' => $request->get('periodo_id'),
                                    'curso_id' => $request->get('curso_id'),
                                    'rut' => $res,
                                    'permanencia' => 'dia',
                                    'asistencia' => 'Pendiente', 
                                    'tipo_reserva' => $request->get('rol'),
                                    'dia' => $diasemana,
                                    ]);
                                //pone disponibilidad en no para un lab completo
                                $id = $request->get('sala_id');
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
                                    'disponibilidad' => "si",
                                    ]); 
                                    $est->save();
                                }
                                $est->save();

                                //horario diario creado con exito docente
                                Session::flash('create','¡Horario diario Docente reservado correctamente!');
                                return redirect()->route('funcionario.horario.index');
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
                                                           'sala_id' => $request->get('sala_id'),
                                                           'periodo_id' => $request->get('periodo_id'),
                                                           'curso_id' => $request->get('curso_id'),
                                                           'rut' => $res,
                                                           'permanencia' => 'semestral',
                                                           'asistencia' => 'Pendiente', 
                                                           'tipo_reserva' => $request->get('rol'),
                                                           'dia' => $request->get('dia'),
                                                           ]);
                                                
                                                $id = $request->get('sala_id');
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
                                                    'disponibilidad' => "si",
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
                                                       'sala_id' => $request->get('sala_id'),
                                                       'periodo_id' => $request->get('periodo_id'),
                                                       'curso_id' => $request->get('curso_id'),
                                                       'rut' => $res,
                                                       'permanencia' => 'semestral',
                                                       'asistencia' => 'Pendiente', 
                                                       'tipo_reserva' => $request->get('rol'),
                                                       'dia' => $request->get('dia'),
                                                       ]);

                                                $id = $request->get('sala_id');
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
                                                    'disponibilidad' => "si",
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
                                                       'sala_id' => $request->get('sala_id'),
                                                       'periodo_id' => $request->get('periodo_id'),
                                                       'curso_id' => $request->get('curso_id'),
                                                       'rut' => $res,
                                                       'permanencia' => 'semestral',
                                                       'asistencia' => 'Pendiente', 
                                                       'tipo_reserva' => $request->get('rol'),
                                                       'dia' => $request->get('dia'),
                                                       ]);
                                                
                                                $id = $request->get('sala_id');
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
                                                    'disponibilidad' => "si",
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
                                                       'sala_id' => $request->get('sala_id'),
                                                       'periodo_id' => $request->get('periodo_id'),
                                                       'curso_id' => $request->get('curso_id'),
                                                       'rut' => $res,
                                                       'permanencia' => 'semestral',
                                                       'asistencia' => 'Pendiente', 
                                                       'tipo_reserva' => $request->get('rol'),
                                                       'dia' => $request->get('dia'),
                                                       ]);
                                                
                                                $id = $request->get('sala_id');
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
                                                    'disponibilidad' => "si",
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
                                                       'sala_id' => $request->get('sala_id'),
                                                       'periodo_id' => $request->get('periodo_id'),
                                                       'curso_id' => $request->get('curso_id'),
                                                       'rut' => $res,
                                                       'permanencia' => 'semestral',
                                                       'asistencia' => 'Pendiente', 
                                                       'tipo_reserva' => $request->get('rol'),
                                                       'dia' => $request->get('dia'),
                                                       ]);
                                                

                                                $id = $request->get('sala_id');
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
                                                    'disponibilidad' => "si",
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
                                                       'sala_id' => $request->get('sala_id'),
                                                       'periodo_id' => $request->get('periodo_id'),
                                                       'curso_id' => $request->get('curso_id'),
                                                       'rut' => $res,
                                                       'permanencia' => 'semestral',
                                                       'asistencia' => 'Pendiente', 
                                                       'tipo_reserva' => $request->get('rol'),
                                                       'dia' => $request->get('dia'),
                                                       ]);
                                                

                                                $id = $request->get('sala_id');
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
                                                    'disponibilidad' => "si",
                                                    ]); 
                                                    $est->save();
                                                }
                                                $est->save();
                                            }
                                        }
                                        $inicio->addWeek(1);
                                    }
                                }
                                //horario docente creado con exito! semestral
                                Session::flash('create','¡Horario semestral Docente reservado correctamente!');
                                return redirect()->route('funcionario.horario.index');
                            }
                        }
                    }
                }

                if($request->get('rol') == 'ayudante')
                {
                    $res = Curso::where('id','=',$request->get('curso_id'))
                                        ->select('ayudante')
                                        ->get();
                    
                    $res = $res->first()->ayudante;

                    if($res === 'no')
                    {
                        Session::flash('create','¡Este curso no presenta ayudantía!');
                        return redirect()->route('funcionario.horario.index');
                    }

                    $docente = RolUsuario::join('rol','rol.id','=','rol_users.rol_id')
                                        ->where('rol_users.rut','=',$res)->select('rol.nombre')->get();

                    foreach($docente as $d){

                        if($d->nombre == 'ayudante')
                        {
                            $res = Curso::where('id','=',$request->get('curso_id'))
                                        ->select('ayudante')
                                        ->get();
                    
                            $res = $res->first()->ayudante;
                            if($res == 'no')
                            {
                                Session::flash('create','¡Este curso no presenta ayudantía!');
                                return redirect()->route('administrador.horario.index');
                            }

                            if($request->get('permanencia') === 'dia')
                            {
                                //Formatear la fecha de mm/dd/aaaa => aaaa-mm-dd
                                $fecha_separada = explode('/',$request->get('fecha'));
                                $fecha_con_guion = [$fecha_separada[2],$fecha_separada[0],$fecha_separada[1]];
                                $fecha_formateada = implode('-',$fecha_con_guion);

                                Horario::create([
                                    'fecha' => $fecha_formateada,
                                    'sala_id' => $request->get('sala_id'),
                                    'periodo_id' => $request->get('periodo_id'),
                                    'curso_id' => $request->get('curso_id'),
                                    'rut' => $res,
                                    'permanencia' => 'dia',
                                    'asistencia' => 'Pendiente', 
                                    'tipo_reserva' => $request->get('rol'),
                                    'dia' => $diasemana,
                                    ]);
                                //pone disponibilidad en no para un lab completo
                                $id = $request->get('sala_id');
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
                                    'disponibilidad' => "si",
                                    ]); 
                                    $est->save();
                                }
                                $est->save();

                                Session::flash('create','¡Horario diario Ayudante reservado correctamente!');
                                return redirect()->route('funcionario.horario.index');
                            }
                            else
                            {
                                $res = Curso::where('id','=',$request->get('curso_id'))
                                        ->select('ayudante')
                                        ->get();
                    
                                $res = $res->first()->ayudante;
                                if($res == 'no')
                                {
                                    Session::flash('create','¡Este curso no presenta ayudantía!');
                                    return redirect()->route('administrador.horario.index');
                                }

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
                                                           'sala_id' => $request->get('sala_id'),
                                                           'periodo_id' => $request->get('periodo_id'),
                                                           'curso_id' => $request->get('curso_id'),
                                                           'rut' => $res,
                                                           'permanencia' => 'semestral',
                                                           'asistencia' => 'Pendiente', 
                                                           'tipo_reserva' => $request->get('rol'),
                                                           'dia' => $request->get('dia'),
                                                           ]);
                                                
                                                $id = $request->get('sala_id');
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
                                                    'disponibilidad' => "si",
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
                                                       'sala_id' => $request->get('sala_id'),
                                                       'periodo_id' => $request->get('periodo_id'),
                                                       'curso_id' => $request->get('curso_id'),
                                                       'rut' => $res,
                                                       'permanencia' => 'semestral',
                                                       'asistencia' => 'Pendiente', 
                                                       'tipo_reserva' => $request->get('rol'),
                                                       'dia' => $request->get('dia'),
                                                       ]);

                                                $id = $request->get('sala_id');
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
                                                    'disponibilidad' => "si",
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
                                                       'sala_id' => $request->get('sala_id'),
                                                       'periodo_id' => $request->get('periodo_id'),
                                                       'curso_id' => $request->get('curso_id'),
                                                       'rut' => $res,
                                                       'permanencia' => 'semestral',
                                                       'asistencia' => 'Pendiente', 
                                                       'tipo_reserva' => $request->get('rol'),
                                                       'dia' => $request->get('dia'),
                                                       ]);
                                                
                                                $id = $request->get('sala_id');
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
                                                    'disponibilidad' => "si",
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
                                                       'sala_id' => $request->get('sala_id'),
                                                       'periodo_id' => $request->get('periodo_id'),
                                                       'curso_id' => $request->get('curso_id'),
                                                       'rut' => $res,
                                                       'permanencia' => 'semestral',
                                                       'asistencia' => 'Pendiente', 
                                                       'tipo_reserva' => $request->get('rol'),
                                                       'dia' => $request->get('dia'),
                                                       ]);
                                                
                                                $id = $request->get('sala_id');
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
                                                    'disponibilidad' => "si",
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
                                                       'sala_id' => $request->get('sala_id'),
                                                       'periodo_id' => $request->get('periodo_id'),
                                                       'curso_id' => $request->get('curso_id'),
                                                       'rut' => $res,
                                                       'permanencia' => 'semestral',
                                                       'asistencia' => 'Pendiente', 
                                                       'tipo_reserva' => $request->get('rol'),
                                                       'dia' => $request->get('dia'),
                                                       ]);
                                                

                                                $id = $request->get('sala_id');
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
                                                    'disponibilidad' => "si",
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
                                                       'sala_id' => $request->get('sala_id'),
                                                       'periodo_id' => $request->get('periodo_id'),
                                                       'curso_id' => $request->get('curso_id'),
                                                       'rut' => $res,
                                                       'permanencia' => 'semestral',
                                                       'asistencia' => 'Pendiente', 
                                                       'tipo_reserva' => $request->get('rol'),
                                                       'dia' => $request->get('dia'),
                                                       ]);
                                                

                                                $id = $request->get('sala_id');
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
                                                    'disponibilidad' => "si",
                                                    ]); 
                                                    $est->save();
                                                }
                                                $est->save();
                                            }
                                        }
                                        $inicio->addWeek(1);
                                    }
                                }
                                //Horario creado con exito de ayudante semestral
                                Session::flash('create','¡Horario semestral ayudante reservado correctamente!');
                                return redirect()->route('funcionario.horario.index');
                            }
                        }
                    }
                }
            }

            if($curso->count() == 1)
            {
                foreach($curso as $c)
                {
                    if($c->periodo_id != $request->get('periodo_id'))
                    {
                        //insertar
                        if($request->get('rol') == 'docente')
                        {
                            $res = Curso::where('id','=',$request->get('curso_id'))
                                        ->select('docente')
                                        ->get();
                            $res = $res->first()->docente;

                            $docente = RolUsuario::join('rol','rol.id','=','rol_users.rol_id')
                                                ->where('rol_users.rut','=',$res)->select('rol.nombre')->get();

                            foreach($docente as $d){

                                if($d->nombre == 'docente')
                                {
                                    $res = Curso::where('id','=',$request->get('curso_id'))
                                        ->select('docente')
                                        ->get();
                                    $res = $res->first()->docente;

                                    if($request->get('permanencia') === 'dia')
                                    {
                                        //Formatear la fecha de mm/dd/aaaa => aaaa-mm-dd
                                        $fecha_separada = explode('/',$request->get('fecha'));
                                        $fecha_con_guion = [$fecha_separada[2],$fecha_separada[0],$fecha_separada[1]];
                                        $fecha_formateada = implode('-',$fecha_con_guion);
                                   
                                        Horario::create([
                                            'fecha' => $fecha_formateada,
                                            'sala_id' => $request->get('sala_id'),
                                            'periodo_id' => $request->get('periodo_id'),
                                            'curso_id' => $request->get('curso_id'),
                                            'rut' => $res,
                                            'permanencia' => 'dia',
                                            'asistencia' => 'Pendiente', 
                                            'tipo_reserva' => $request->get('rol'),
                                            'dia' => $diasemana,
                                            ]);
                                        //pone disponibilidad en no para un lab completo
                                        $id = $request->get('sala_id');
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
                                            'disponibilidad' => "si",
                                            ]); 
                                            $est->save();
                                        }
                                        $est->save();

                                        //docente diario creado con exito
                                        Session::flash('create','¡Horario diario Docente reservado correctamente!');
                                        return redirect()->route('funcionario.horario.index');
                                    }
                                    else
                                    {
                                        $res = Curso::where('id','=',$request->get('curso_id'))
                                            ->select('docente')
                                            ->get();
                                        $res = $res->first()->docente;
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
                                                               'sala_id' => $request->get('sala_id'),
                                                               'periodo_id' => $request->get('periodo_id'),
                                                               'curso_id' => $request->get('curso_id'),
                                                               'rut' => $res,
                                                               'permanencia' => 'semestral',
                                                               'asistencia' => 'Pendiente', 
                                                               'tipo_reserva' => $request->get('rol'),
                                                               'dia' => $request->get('dia'),
                                                               ]);
                                                        
                                                        $id = $request->get('sala_id');
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
                                                            'disponibilidad' => "si",
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
                                                               'sala_id' => $request->get('sala_id'),
                                                               'periodo_id' => $request->get('periodo_id'),
                                                               'curso_id' => $request->get('curso_id'),
                                                               'rut' => $res,
                                                               'permanencia' => 'semestral',
                                                               'asistencia' => 'Pendiente', 
                                                               'tipo_reserva' => $request->get('rol'),
                                                               'dia' => $request->get('dia'),
                                                               ]);
                                                        

                                                        $id = $request->get('sala_id');
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
                                                            'disponibilidad' => "si",
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
                                                               'sala_id' => $request->get('sala_id'),
                                                               'periodo_id' => $request->get('periodo_id'),
                                                               'curso_id' => $request->get('curso_id'),
                                                               'rut' => $res,
                                                               'permanencia' => 'semestral',
                                                               'asistencia' => 'Pendiente', 
                                                               'tipo_reserva' => $request->get('rol'),
                                                               'dia' => $request->get('dia'),
                                                               ]);
                                                        
                                                        $id = $request->get('sala_id');
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
                                                            'disponibilidad' => "si",
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
                                                               'sala_id' => $request->get('sala_id'),
                                                               'periodo_id' => $request->get('periodo_id'),
                                                               'curso_id' => $request->get('curso_id'),
                                                               'rut' => $res,
                                                               'permanencia' => 'semestral',
                                                               'asistencia' => 'Pendiente', 
                                                               'tipo_reserva' => $request->get('rol'),
                                                               'dia' => $request->get('dia'),
                                                               ]);
                                                        

                                                        $id = $request->get('sala_id');
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
                                                            'disponibilidad' => "si",
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
                                                               'sala_id' => $request->get('sala_id'),
                                                               'periodo_id' => $request->get('periodo_id'),
                                                               'curso_id' => $request->get('curso_id'),
                                                               'rut' => $res,
                                                               'permanencia' => 'semestral',
                                                               'asistencia' => 'Pendiente', 
                                                               'tipo_reserva' => $request->get('rol'),
                                                               'dia' => $request->get('dia'),
                                                               ]);         

                                                        $id = $request->get('sala_id');
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
                                                            'disponibilidad' => "si",
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
                                                                   'sala_id' => $request->get('sala_id'),
                                                                   'periodo_id' => $request->get('periodo_id'),
                                                                   'curso_id' => $request->get('curso_id'),
                                                                   'rut' => $res,
                                                                   'permanencia' => 'semestral',
                                                                   'asistencia' => 'Pendiente', 
                                                                   'tipo_reserva' => $request->get('rol'),
                                                                   'dia' => $request->get('dia'),
                                                                   ]);
                                                    

                                                        $id = $request->get('sala_id');
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
                                                            'disponibilidad' => "si",
                                                            ]); 
                                                            $est->save();
                                                        }
                                                        $est->save();
                                                    }
                                                }
                                                $inicio->addWeek(1);
                                            }
                                        }
                                        //docernte semestral exito
                                        Session::flash('create','¡Horario semestral Docente reservado correctamente!');
                                        return redirect()->route('funcionario.horario.index');
                                    }
                                }
                            }
                        }
                        if($request->get('rol') == 'ayudante')
                        {
                            //devolver mensaje de periodo por ayudante(max 1)
                            Session::flash('create','¡Los Ayudantes pueden reservar sólamente un período por curso-sección!');
                            return redirect()->route('funcionario.horario.index');
                        }

                    }
                    else
                    {
                        //devolver mensaje de periodo que son iguales
                        Session::flash('create','¡Período ya reservado!');
                        return redirect()->route('funcionario.horario.index');
                    }

                }
            }

            if($curso->count() > 1)
            {
                //devuelve mensaje de que no se pueden tomar mas de 2 periodos por docente
                Session::flash('create','¡Los Docentes pueden reservar máximo dos períodos por curso-sección!');
                return redirect()->route('funcionario.horario.index');
            }
        }
        else
        {
            Session::flash('create','¡Horario ya reservado con anteroridad!');
            return redirect()->route('funcionario.horario.index');
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
