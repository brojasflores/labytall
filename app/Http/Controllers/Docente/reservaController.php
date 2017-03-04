<?php

namespace App\Http\Controllers\Docente;

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


class reservaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('doc');
    }
    
    public function index()
    {
        $usr=Auth::User()->rut;
        $dpto= UsersDpto::where('rut','=',$usr)
                            ->select('departamento_id')
                            ->get();

        $horarios = Horario::join('curso','horario.curso_id','=','curso.id')
                            ->join('asignatura','curso.asignatura_id','=','asignatura.id')
                            ->join('periodo','horario.periodo_id','=','periodo.id')
                            ->join('sala','horario.sala_id','=','sala.id')
                            ->join('departamento','departamento.id','=','sala.departamento_id')
                            ->join('users','horario.rut','=','users.rut')
                            ->where('departamento.id',$dpto->first()->departamento_id)
                            ->where('curso.docente','=',$usr)
                            ->select('horario.id','horario.fecha','horario.rut','users.nombres as horario_name','users.apellidos as horario_apell','horario.permanencia','asignatura.nombre as asig_nombre','periodo.bloque','sala.nombre as sala_nombre','horario.asistencia','horario.tipo_reserva')
                            ->orderBy('periodo.bloque','asc')
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
            return view ('Docente/horariosP/index', compact('horarios','v2','cont'));
        }
        else
        {
            return view ('Docente/horariosP/index', compact('horarios','cont'));
        }
        //return view ('Docente/horarios/index', compact('horarios')); 
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        
    }


    public function show($id)
    {
        //
    }


    public function edit($id,Request $request)
    {
        if($request->ajax()){
         
            $horario = Horario::where('id',$request->get('id'))
                               ->select('curso_id','periodo_id','sala_id','permanencia','fecha')
                               ->orderBy('periodo_id','asc')
                               ->get();
        
            $fecha_inicio = Horario::where('curso_id',$horario[0]->curso_id)->min('fecha');

            $fecha_fin = Horario::where('curso_id',$horario[0]->curso_id)->max('fecha');

            $dia = date('w',strtotime($fecha_inicio));

            if($dia == 1){$dia = 'lunes';}
            if($dia == 2){$dia = 'martes';}   
            if($dia == 3){$dia = 'miercoles';}
            if($dia == 4){$dia = 'jueves';}
            if($dia == 5){$dia = 'viernes';}  
            if($dia == 6){$dia = 'sabado';}

            $datos = ['horario' => $horario,'dia' => $dia,'fecha_inicio' => $fecha_inicio, 'fecha_fin' => $fecha_fin];

            if($request->get('permanencia') == 'semestral'){
                return response()->json($datos);
            }
            if($request->get('permanencia') == 'dia'){
                return response()->json($dia);
            }
          
        }
        else{

            $horarios = Horario::findOrFail($id);

            //$salas = Sala::all();
            $usr=Auth::User()->rut;
            $dpto= UsersDpto::where('rut','=',$usr)
                            ->select('departamento_id')
                            ->get();

            $salas= Sala::where('departamento_id','=',$dpto->first()->departamento_id)
                            ->select('id','nombre')->orderBy('nombre','asc')->get();

            $periodos = Periodo::all();

            Periodo::orderBy('id','asc')->get();

            $cursos = Curso::join('asignatura','curso.asignatura_id','=','asignatura.id')
                            ->select('curso.id','curso.seccion','asignatura.nombre')
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
                return view ('Docente/horariosP/edit',compact('horarios','salas','periodos','cursos','v2','cont'));
            }
            else
            {
                return view ('Docente/horariosP/edit',compact('horarios','salas','periodos','cursos','cont'));
            }

            //return view('Docente/horarios/edit',compact('horarios','salas','periodos','cursos'));
        }

    }


    public function update(Request $request, $id)
    {   
        //dd($request);
        if($request->get('rol')=='ayudante')
        {
            $numero = Curso::where('id','=',$request->get('curso_id'))
                           ->select('ayudante')
                           ->get();

            $numero = $numero->first()->ayudante;
        }

        /*if($request->get('rol')=='ayudante')
        {
            //VAIDA RUT
            $rut = preg_replace('/[^k0-9]/i', '', $request->rut);
            $dv  = substr($rut, -1);
            $numero = substr($rut, 0, strlen($rut)-1);
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
            //

            if($ok == 'si')
            {
                $idrol = Rol::where('nombre','=',$request->get('rol'))
                        ->select('id')
                        ->get();

                $idrol = $idrol->first()->id;

                $encontrado = RolUsuario::where('rut','=',$numero)
                                        ->where('rol_id','=',$idrol)
                                        ->select('id')
                                        ->get();

                if($encontrado->isEmpty())
                {
                    Session::flash('create','¡El rut ingresado no puede hacer este tipo de reservas!');
                    return redirect()->route('docente.MihorarioDocente.index');
                }
            }
            else
            {
                Session::flash('create','¡El rut ingresado en inválido, ingrese rut con dígito verificador y sin guión!');
                return redirect()->route('docente.MihorarioDocente.index');
            }
        }*/
//
        if($request->get('rol')=='docente')
        {
            if($request->get('permanencia') == 'dia')
            {
                if($request->get('fecha')==null)
                {
                    //seleccione un dia en el calenario
                    Session::flash('create','¡Seleccione un día en el calendario!');
                    return redirect()->route('docente.asignar.docente');
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
                        return redirect()->route('docente.asignar.docente');
                    }
                }
                else
                {
                    Session::flash('create','¡Ingrese permanencia!');
                    return redirect()->route('docente.asignar.docente');
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
                    return redirect()->route('docente.asignar.ayudante');
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
                        return redirect()->route('docente.asignar.ayudante');
                    }
                }
                else
                {
                    Session::flash('create','¡Ingrese permanencia!');
                    return redirect()->route('docente.asignar.ayudante');
                }
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
                return redirect()->route('docente.MihorarioDocente.index');
            }
        }

        // 

        $var = Horario::where('id','=',$id)
               ->select('sala_id','permanencia')
               ->get();
        
        foreach($var as $v)
        {
            $v2= $v->sala_id;
            $per=$v->permanencia;
        }

        $esT = Estacion_trabajo::where('sala_id','=',$v2)
               ->select('id')
               ->get();

        foreach($esT as $v)
        {
            $v3[]= $v->id;
        }

        $cont= count($v3); 
        for($i=0;$i<$cont;$i++)
        {
            $est = Estacion_trabajo::findOrFail($v3[$i]);
            $est->fill([
            'disponibilidad' => "si",
            ]); 
            $est->save();
        }
        $est->save();

        $horarios = Horario::findOrFail($id);
        $curso = $horarios->curso_id;
        $periodo = $horarios->periodo_id;
        
        Horario::where('curso_id',$curso)
                ->where('periodo_id',$periodo)
                ->where('permanencia',$per)
                ->delete();

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
                      ->where('id','!=',$id)
                      ->select('id')
                      ->get();

            $con2 = Horario_Alumno::where('fecha','=',$fecha_formateada)
                          ->where('periodo_id','=',$request->get('periodo_id'))
                          ->where('sala_id','=',$request->get('sala_id'))
                          ->where('id','!=',$id)
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
                return redirect()->route('docente.MihorarioDocente.index');
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
            $rutdoc =Auth::User()->rut;
            
            $curso = Horario::where('curso_id','=',$request->get('curso_id'))
                            ->where('fecha','=',$fecha_formateada)
                            ->get(); 

            if($curso->count() == 0)
            {
                //insertar max 2 registros
                if($request->get('rol') == 'docente')
                {
                    $docente = RolUsuario::join('rol','rol.id','=','rol_users.rol_id')
                                        ->where('rol_users.rut','=',$rutdoc)->select('rol.nombre')->get();              
                
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
                                    'sala_id' => $request->get('sala_id'),
                                    'periodo_id' => $request->get('periodo_id'),
                                    'curso_id' => $request->get('curso_id'),
                                    'rut' => $rutdoc,
                                    'permanencia' => 'dia',
                                    'asistencia' => 'Pendiente',
                                    'tipo_reserva' => $request->get('rol')
                                    ]);

                                //horario diario creado con exito docente
                                Session::flash('create','¡Horario diario Docente editado correctamente!');
                                return redirect()->route('docente.MihorarioDocente.index');
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
                                                           'rut' => $rutdoc,
                                                           'permanencia' => 'semestral',
                                                           'asistencia' => 'Pendiente',
                                                           'tipo_reserva' => $request->get('rol')
                                                           ]);
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
                                                       'rut' => $rutdoc,
                                                       'permanencia' => 'semestral',
                                                       'asistencia' => 'Pendiente',
                                                       'tipo_reserva' => $request->get('rol')
                                                       ]);
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
                                                       'rut' => $rutdoc,
                                                       'permanencia' => 'semestral',
                                                       'asistencia' => 'Pendiente',
                                                       'tipo_reserva' => $request->get('rol')
                                                       ]);
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
                                                       'rut' => $rutdoc,
                                                       'permanencia' => 'semestral',
                                                       'asistencia' => 'Pendiente',
                                                       'tipo_reserva' => $request->get('rol')
                                                       ]);
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
                                                       'rut' => $rutdoc,
                                                       'permanencia' => 'semestral',
                                                       'asistencia' => 'Pendiente',
                                                       'tipo_reserva' => $request->get('rol')
                                                       ]);
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
                                                       'rut' => $rutdoc,
                                                       'permanencia' => 'semestral',
                                                       'asistencia' => 'Pendiente',
                                                       'tipo_reserva' => $request->get('rol')
                                                       ]);
                                            }
                                        }
                                        $inicio->addWeek(1);
                                    }
                                }
                                //horario docente creado con exito! semestral
                                Session::flash('create','¡Horario semestral Docente editado correctamente!');
                                return redirect()->route('docente.MihorarioDocente.index');
                            }
                        }
                    }
                }

                if($request->get('rol') == 'ayudante')
                {
                    $docente = RolUsuario::join('rol','rol.id','=','rol_users.rol_id')
                                        ->where('rol_users.rut','=',$numero)->select('rol.nombre')->get();

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
                                    'sala_id' => $request->get('sala_id'),
                                    'periodo_id' => $request->get('periodo_id'),
                                    'curso_id' => $request->get('curso_id'),
                                    'rut' => $numero,
                                    'permanencia' => 'dia',
                                    'asistencia' => 'Pendiente',
                                    'tipo_reserva' => $request->get('rol')
                                    ]);

                                Session::flash('create','¡Horario diario Ayudante editado correctamente!');
                                return redirect()->route('docente.MihorarioDocente.index');
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
                                                           'sala_id' => $request->get('sala_id'),
                                                           'periodo_id' => $request->get('periodo_id'),
                                                           'curso_id' => $request->get('curso_id'),
                                                           'rut' => $numero,
                                                           'permanencia' => 'semestral',
                                                           'asistencia' => 'Pendiente',
                                                           'tipo_reserva' => $request->get('rol')
                                                           ]);
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
                                                       'rut' => $numero,
                                                       'permanencia' => 'semestral',
                                                       'asistencia' => 'Pendiente',
                                                       'tipo_reserva' => $request->get('rol')
                                                       ]);
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
                                                       'rut' => $numero,
                                                       'permanencia' => 'semestral',
                                                       'asistencia' => 'Pendiente',
                                                       'tipo_reserva' => $request->get('rol')
                                                       ]);
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
                                                       'rut' => $numero,
                                                       'permanencia' => 'semestral',
                                                       'asistencia' => 'Pendiente',
                                                       'tipo_reserva' => $request->get('rol')
                                                       ]);
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
                                                       'rut' => $numero,
                                                       'permanencia' => 'semestral',
                                                       'asistencia' => 'Pendiente',
                                                       'tipo_reserva' => $request->get('rol')
                                                       ]);
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
                                                       'rut' => $numero,
                                                       'permanencia' => 'semestral',
                                                       'asistencia' => 'Pendiente',
                                                       'tipo_reserva' => $request->get('rol')
                                                       ]);
                                            }
                                        }
                                        $inicio->addWeek(1);
                                    }
                                }
                                //Horario creado con exito de ayudante semestral
                                Session::flash('create','¡Horario semestral ayudante editado correctamente!');
                                return redirect()->route('docente.MihorarioDocente.index');
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
                            $docente = RolUsuario::join('rol','rol.id','=','rol_users.rol_id')
                                                ->where('rol_users.rut','=',$rutdoc)->select('rol.nombre')->get();

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
                                            'sala_id' => $request->get('sala_id'),
                                            'periodo_id' => $request->get('periodo_id'),
                                            'curso_id' => $request->get('curso_id'),
                                            'rut' => $rutdoc,
                                            'permanencia' => 'dia',
                                            'asistencia' => 'Pendiente',
                                            'tipo_reserva' => $request->get('rol')
                                            ]);

                                        //docente diario creado con exito
                                        Session::flash('create','¡Horario diario Docente editado correctamente!');
                                        return redirect()->route('docente.MihorarioDocente.index');
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
                                                               'sala_id' => $request->get('sala_id'),
                                                               'periodo_id' => $request->get('periodo_id'),
                                                               'curso_id' => $request->get('curso_id'),
                                                               'rut' => $rutdoc,
                                                               'permanencia' => 'semestral',
                                                               'asistencia' => 'Pendiente',
                                                               'tipo_reserva' => $request->get('rol')
                                                               ]);
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
                                                               'rut' => $rutdoc,
                                                               'permanencia' => 'semestral',
                                                               'asistencia' => 'Pendiente',
                                                               'tipo_reserva' => $request->get('rol')
                                                               ]);
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
                                                               'rut' => $rutdoc,
                                                               'permanencia' => 'semestral',
                                                               'asistencia' => 'Pendiente',
                                                               'tipo_reserva' => $request->get('rol')
                                                               ]);
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
                                                               'rut' => $rutdoc,
                                                               'permanencia' => 'semestral',
                                                               'asistencia' => 'Pendiente',
                                                               'tipo_reserva' => $request->get('rol')
                                                               ]);
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
                                                               'rut' => $rutdoc,
                                                               'permanencia' => 'semestral',
                                                               'asistencia' => 'Pendiente',
                                                               'tipo_reserva' => $request->get('rol')
                                                               ]);         
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
                                                                   'rut' => $rutdoc,
                                                                   'permanencia' => 'semestral',
                                                                   'asistencia' => 'Pendiente',
                                                                   'tipo_reserva' => $request->get('rol')
                                                                   ]);
                                                    }
                                                }
                                                $inicio->addWeek(1);
                                            }
                                        }
                                        //docernte semestral exito
                                        Session::flash('create','¡Horario semestral Docente reservado correctamente!');
                                        return redirect()->route('docente.MihorarioDocente.index');
                                    }
                                }
                            }
                        }
                        if($request->get('rol') == 'ayudante')
                        {
                            //devolver mensaje de periodo por ayudante(max 1)
                            Session::flash('create','¡Los Ayudantes pueden reservar sólamente un período por curso-sección!');
                            return redirect()->route('docente.MihorarioDocente.index');
                        }

                    }
                    else
                    {
                        //devolver mensaje de periodo que son iguales
                        Session::flash('create','¡Período ya reservado!');
                        return redirect()->route('docente.MihorarioDocente.index');
                    }

                }
            }

            if($curso->count() > 1)
            {
                //devuelve mensaje de que no se pueden tomar mas de 2 periodos por docente
                Session::flash('create','¡Los Docentes pueden reservar máximo dos períodos por curso-sección!');
                return redirect()->route('docente.MihorarioDocente.index');
            }
        }
        else
        {
            Session::flash('create','¡Horario ya reservado con anteroridad. El horario que deseaba modificar fue eliminado, reserve nuevamente!');
            return redirect()->route('docente.MihorarioDocente.index');
        }
    }

    public function destroy($id)
    {
        $var = Horario::where('id','=',$id)
               ->select('sala_id','permanencia')
               ->get();
        
        foreach($var as $v)
        {
            $v2= $v->sala_id;
            $per=$v->permanencia;
        }

        $esT = Estacion_trabajo::where('sala_id','=',$v2)
               ->select('id')
               ->get();

        foreach($esT as $v)
        {
            $v3[]= $v->id;
        }

        $cont= count($v3); 
        for($i=0;$i<$cont;$i++)
        {
            $est = Estacion_trabajo::findOrFail($v3[$i]);
            $est->fill([
            'disponibilidad' => "si",
            ]); 
            $est->save();
        }
        $est->save();

        $horarios = Horario::findOrFail($id);
        $curso = $horarios->curso_id;
        $periodo = $horarios->periodo_id;
        $sa = $horarios->sala_id;
        $tr = $horarios->tipo_reserva;
        $r = $horarios->rut;
        
        Horario::where('curso_id',$curso)
                ->where('periodo_id',$periodo)
                ->where('permanencia',$per)
                ->where('sala_id',$sa)
                ->where('tipo_reserva',$tr)
                ->where('rut',$r)
                ->delete();

        return redirect()->route('docente.MihorarioDocente.index');
    }
}
