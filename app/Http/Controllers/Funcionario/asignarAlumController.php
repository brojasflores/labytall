<?php

namespace App\Http\Controllers\Funcionario;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\Sala;
use App\Periodo;
use App\Curso;
use App\Asignatura;
use App\Horario_Alumno;
use App\Horario;
use App\Estacion_trabajo;
use App\RolUsuario;
use App\Rol;
use App\User;
use App\UsersDpto;
use Carbon\Carbon;
use Session;


class asignarAlumController extends Controller
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

        $periodos = Periodo::select('id','bloque')->orderBy('bloque','asc')->get();

        $salas = Sala::join('estacion_trabajo','sala.id','=','estacion_trabajo.sala_id')
                      ->where('estacion_trabajo.disponibilidad','=','si')
                      ->where('sala.departamento_id','=',$dpto->first()->departamento_id)
                      ->select('sala.id','sala.nombre')
                      ->orderBy('sala.nombre','asc')
                      ->groupBy('sala.id','sala.nombre')
                      ->get();

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
            return view ('Funcionario/asignar/alumno',compact('salas','periodos','est','v2','cont'));
        }
        else
        {
            return view ('Funcionario/asignar/alumno',compact('salas','periodos','est','cont'));
        }
       //return view ('Funcionario/asignar/alumno',compact('salas','periodos','est'));
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
        $dsem = array('domingo','lunes','martes','miercoles','jueves','viernes','sabado','domingo');
        $diasemana = $dsem[date('N', strtotime($request->get('fecha')))];
        if($diasemana=='domingo')
        {
            Session::flash('create','¡No se pueden realizar reservas los días Domingo!');
            return redirect()->route('funcionario.asignar_alumno.index');
        }

        if($request->ajax()){
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

        //dd($request);
        //VAIDA RUT
        $rut = preg_replace('/[^k0-9]/i', '', $request->usuario);
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

        //dd($request->get('sala'));
        if($ok == 'si')
        {
            if($request->get('sala')!=0 || $request->get('fecha')!=null)
            {
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
                
                if($request->get('rol') == 'alumno')
                {
                    $alumno = RolUsuario::join('rol','rol.id','=','rol_users.rol_id')
                                        ->where('rol_users.rut','=',$numero)
                                        ->select('rol.nombre')
                                        ->get();
                }  

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
                        if($v1 == $request->get('sala'))
                        {                
                            //dd('alumnito');
                            $fecha_separada = explode('/',$request->get('fecha'));
                            $fecha_con_guion = [$fecha_separada[2],$fecha_separada[0],$fecha_separada[1]];
                            $fecha_formateada = implode('-',$fecha_con_guion);
                       
                            $fechita = Horario_Alumno::select('id')
                                                     ->where('fecha','=',$fecha_formateada)
                                                     ->where('periodo_id','=',$request->get('periodo'))
                                                     ->where('sala_id','=',$request->get('sala'))
                                                     ->where('estacion_trabajo_id','=',$request->get('estacion'))
                                                     ->get();

                            $fechita2 = Horario::select('id')
                                               ->where('fecha','=',$fecha_formateada)
                                               ->where('periodo_id','=',$request->get('periodo'))
                                               ->where('sala_id','=',$request->get('sala'))
                                               ->get();

                          //  dd($fechita2);
                        }
                        else
                        {
                            //no corresponde el lab con la estacion
                            Session::flash('create','¡No corresponde el Laboratorio con la Estación de Trabajo!');
                            return redirect()->route('funcionario.horarioAlumno.index');
                        }
                    }
                    else
                    {
                        Session::flash('create','¡Rut ingresado no corresponde a un alumno!');
                        return redirect()->route('funcionario.horarioAlumno.index');
                    }
                
                //dd($fechita);
                if($fechita->isEmpty() && $fechita2->isEmpty())
                {
                    //dd($fechita);
                    Horario_Alumno::create([
                        'fecha' => $fecha_formateada,
                        'rut' => $numero,
                        'periodo_id' => $request->get('periodo'),
                        'sala_id' => $request->get('sala'),
                        'estacion_trabajo_id' => $request->get('estacion'),
                        'permanencia' => 'dia',
                        'asistencia' => 'Pendiente',
                        'dia' => $diasemana,
                        ]);

                    $id = $request->get('estacion');
                    $est = Estacion_trabajo::findOrFail($id);
                    $est->fill([
                        'disponibilidad' => "si",
                        ]); 
                    $est->save();
                    Session::flash('create','¡Estación reservada correctamente!');
                    return redirect()->route('funcionario.horarioAlumno.index');
                }
                else
                {
                    Session::flash('create','¡Estación ya reservada!');
                    return redirect()->route('funcionario.horarioAlumno.index');
                }
            }
            else
            {
                Session::flash('create','¡Debe seleccionar una sala y/o una fecha en el calendario!');
                return redirect()->route('funcionario.horarioAlumno.index');
            }
        }
        else
        {
            Session::flash('create','¡El rut ingresado en inválido, ingrese rut con dígito verificador y sin guión!');
            return redirect()->route('funcionario.horarioAlumno.index');
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
