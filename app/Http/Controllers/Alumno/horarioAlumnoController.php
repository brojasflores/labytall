<?php

namespace App\Http\Controllers\Alumno;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Horario_Alumno;
use App\Horario;
use App\Sala;
use App\Periodo;
use App\Curso;
use App\Asignatura;
use App\Estacion_trabajo;
use App\RolUsuario;
use Carbon\Carbon;
use Auth;
use App\User;
use App\UsersDpto;
use Session;

class horarioAlumnoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('alum');
    }
    
    public function index()
    {
        $usr=Auth::User()->rut;
        $dpto= UsersDpto::where('rut','=',$usr)
                            ->select('departamento_id')
                            ->get();
        
        $horarios = Horario_Alumno::join('periodo','horario_alum.periodo_id','=','periodo.id')
                            ->join('sala','horario_alum.sala_id','=','sala.id')
                            ->join('departamento','departamento.id','=','sala.departamento_id')
                            ->join('users','horario_alum.rut','=','users.rut')
                            ->join('estacion_trabajo','horario_alum.estacion_trabajo_id','=','estacion_trabajo.id')
                            ->where('departamento.id',$dpto->first()->departamento_id)
                            ->select('horario_alum.id','horario_alum.fecha','horario_alum.rut','users.nombres as horario_name','users.apellidos as horario_apell','periodo.bloque','sala.nombre as sala_nombre','estacion_trabajo.nombre as est_trabajo','horario_alum.asistencia')
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
            return view ('Alumno/horariosAlum/index', compact('horarios','v2','cont'));
        }
        else
        {
            return view ('Alumno/horariosAlum/index', compact('horarios','cont'));
        }
        //return view ('Alumno/horariosAlum/index', compact('horarios')); 
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
            //dd($request);
            if($request->get('action') == 'edit')
            {
                $estacion = Estacion_trabajo::join('sala','estacion_trabajo.sala_id','=','sala.id')
                                        ->join('periodo','estacion_trabajo.periodo_id','=','periodo.id')
                                        ->where('estacion_trabajo.sala_id',$request->get('id'))
                                        ->where('estacion_trabajo.disponibilidad','si')
                                        ->where('estacion_trabajo.periodo_id',$request->get('periodo'))
                                        ->select('estacion_trabajo.*','sala.nombre as sala','periodo.bloque as blo')
                                        ->orderBy('estacion_trabajo.id','asc')
                                        ->get();

                return response()->json($estacion);             
            }


            $horario = Horario_Alumno::find($request->get('id'));

            return response()->json($horario);   

        }

        else{

            $usr=Auth::User()->rut;
            $dpto= UsersDpto::where('rut','=',$usr)
                            ->select('departamento_id')
                            ->get();

            $salas = Sala::join('estacion_trabajo','sala.id','=','estacion_trabajo.sala_id')
                          ->where('estacion_trabajo.disponibilidad','=','si')
                          ->where('sala.departamento_id','=',$dpto->first()->departamento_id)
                          ->select('sala.id','sala.nombre')
                          ->orderBy('sala.nombre','asc')
                          ->groupBy('sala.id','sala.nombre')
                          ->get();

            $horarios = Horario_Alumno::findOrFail($id);         

            $periodos = Periodo::select('id','bloque')->orderBy('bloque','asc')->get();

            $est = Sala::join('estacion_trabajo','sala.id','=','estacion_trabajo.sala_id')
                          ->join('horario_alum','horario_alum.sala_id','=','sala.id')
                          ->where('horario_alum.id',$id)
                          ->select('estacion_trabajo.sala_id as est_salaid','estacion_trabajo.id as est_id','estacion_trabajo.nombre as est_name','sala.nombre')
                          ->orderBy('sala.nombre','asc')->get();

            $est = Sala::join('estacion_trabajo','sala.id','=','estacion_trabajo.sala_id')
                      ->where('estacion_trabajo.disponibilidad','=','si')
                      ->join('periodo','estacion_trabajo.periodo_id','=','periodo.id')
                      ->select('estacion_trabajo.sala_id as est_salaid','estacion_trabajo.id as est_id','estacion_trabajo.nombre as est_name','sala.nombre','periodo.bloque as blo')
                      ->orderBy('sala.nombre','asc')->get();


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
                return view ('Alumno/horariosAlum/edit',compact('horarios','salas','periodos','est','v2','cont'));
            }
            else
            {
                return view ('Alumno/horariosAlum/edit',compact('horarios','salas','periodos','est','cont'));
            }
            //return view('Alumno/horariosAlum/edit',compact('horarios','salas','periodos','est'));
        }
    }


    public function update(Request $request, $id)
    {          
        dd($request);
        $dsem = array('domingo','lunes','martes','miercoles','jueves','viernes','sabado','domingo');
        $diasemana = $dsem[date('N', strtotime($request->get('fecha')))];
        if($diasemana=='domingo')
        {
            dd('mehagocaca');
            Session::flash('create','¡No se pueden realizar reservas los días Domingo!');
            return redirect()->route('alumno.horarioAlumno.index');
        }

        $numero=Auth::User()->rut;

        if($request->get('fecha')==null)
        {
            Session::flash('create','¡Debe ingresar fecha válida!');
            return redirect()->route('alumno.horarioAlumno.index');
        }
    
        $var = Horario_Alumno::where('id','=',$id)
             ->select('estacion_trabajo_id')
             ->get();

        if($request->get('permanencia') === 'dia')
        {
            $fecha_separada = explode('/',$request->get('fecha'));
            $fecha_con_guion = [$fecha_separada[2],$fecha_separada[0],$fecha_separada[1]];
            $fecha_formateada = implode('-',$fecha_con_guion);
        }

        $idEst= Estacion_trabajo::where('id','=',$request->get('estacion'))->select('sala_id')->get();

        foreach($idEst as $v)
        {
            $v1= $v->sala_id;
        }

            $alumno = RolUsuario::join('rol','rol.id','=','rol_users.rol_id')
                                ->where('rol_users.rut','=',$numero)
                                ->select('rol.nombre')->get();
        
                $al=0;
                foreach($alumno as $d)
                {
                    if($d->nombre == 'alumno')
                    {
                        $al=$al+1;
                    }
                    else
                    {
                        $al=$al;
                    }
                }

        
            if($al==1)
            {
                if($v1 == $request->get('salaHorario'))
                {                
                    $fecha_separada = explode('/',$request->get('fecha'));
                    $fecha_con_guion = [$fecha_separada[2],$fecha_separada[0],$fecha_separada[1]];
                    $fecha_formateada = implode('-',$fecha_con_guion);


                    $fechita = Horario_Alumno::select('id')
                                             ->where('fecha','=',$fecha_formateada)
                                             ->where('periodo_id','=',$request->get('periodoHorario'))
                                             ->where('sala_id','=',$request->get('sala'))
                                             ->get();

                    $fechita2 = Horario::select('id')
                                       ->where('fecha','=',$fecha_formateada)
                                       ->where('periodo_id','=',$request->get('periodoHorario'))
                                       ->where('sala_id','=',$request->get('sala'))
                                       ->get();

                    if($fechita->isEmpty() && $fechita2->isEmpty())
                    {
                        $h = Horario_Alumno::findOrFail($id);
                        $h->fill([
                        'fecha' => $fecha_formateada,
                        'rut' => $numero,
                        'periodo_id' => $request->get('periodoHorario'),
                        'sala_id' => $request->get('salaHorario'),
                        'estacion_trabajo_id' => $request->get('estacion'),
                        'permanencia' => 'dia',
                        'asistencia' => $request->get('asistenciaH'),
                        'dia' => $diasemana,
                        ]); 
                        $h->save();
                    }
                    else
                    {
                        Session::flash('create','¡Estación ya reservada!');
                        return redirect()->route('alumno.horarioAlumno.index');
                    }
                }
                else
                {
                    Session::flash('create','¡No corresponde el Laboratorio con la Estación de Trabajo!');
                    return redirect()->route('alumno.horarioAlumno.index');
                }
            }
            else
            {
                Session::flash('create','¡Rut ingresado no corresponde a un alumno!');
                return redirect()->route('alumno.horarioAlumno.index');
            }
            Session::flash('create','¡Reserva editada correctamente!');
            return redirect()->route('alumno.horarioAlumno.index');
        
    }


    public function destroy($id)
    {
        $var = Horario_Alumno::where('id','=',$id)
               ->select('estacion_trabajo_id') 
               ->get();

        $horarios = Horario_Alumno::findOrFail($id);
        $horarios->delete();

        return redirect()->route('alumno.horarioAlumno.index');
    }
}
