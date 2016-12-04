<?php

namespace App\Http\Controllers\Director;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\Sala;
use App\Periodo;
use App\Curso;
use App\Asignatura;
use App\Horario_Alumno;
use App\Estacion_trabajo;
use App\RolUsuario;
use App\Rol;
use App\User;
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
        $this->middleware('admin');
    }
    
    public function index()
    {
        
        $periodos = Periodo::select('id','bloque')->orderBy('bloque','asc')->get();

        $salas = Sala::join('estacion_trabajo','sala.id','=','estacion_trabajo.sala_id')
                      ->where('estacion_trabajo.disponibilidad','=','si')
                      ->select('sala.id','sala.nombre')
                      ->orderBy('sala.nombre','asc')
                      ->groupBy('sala.id','sala.nombre')
                      ->get();

        $est = Sala::join('estacion_trabajo','sala.id','=','estacion_trabajo.sala_id')
                      ->where('estacion_trabajo.disponibilidad','=','si')
                      ->select('estacion_trabajo.sala_id as est_salaid','estacion_trabajo.id as est_id','estacion_trabajo.nombre as est_name','sala.nombre')
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
            return view ('Director/asignar/alumno',compact('salas','periodos','est','v2','cont'));
        }
        else
        {
            return view ('Director/asignar/alumno',compact('salas','periodos','est','cont'));
        }
       //return view ('Administrador/asignar/alumno',compact('salas','periodos','est'));
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
        if($request->ajax()){
            $estacion = Estacion_trabajo::join('sala','estacion_trabajo.sala_id','=','sala.id')
                                        ->where('estacion_trabajo.sala_id',$request->get('id'))
                                        ->where('estacion_trabajo.disponibilidad','si')
                                        ->select('estacion_trabajo.*','sala.nombre as sala')
                                        ->orderBy('estacion_trabajo.id','asc')
                                        ->get();

            return response()->json($estacion);
        }

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
                                ->where('rol_users.rut','=',$request->get('usuario'))->select('rol.nombre')->get();
        }  

        foreach($alumno as $d)
        {
            if($d->nombre == 'alumno')
            {
                if($v1 == $request->get('sala'))
                {                
                    //dd('alumnito');
                    $fecha_separada = explode('/',$request->get('fecha'));
                    $fecha_con_guion = [$fecha_separada[2],$fecha_separada[0],$fecha_separada[1]];
                    $fecha_formateada = implode('-',$fecha_con_guion);
               
                    Horario_Alumno::create([
                        'fecha' => $fecha_formateada,
                        'rut' => $request->get('usuario'),
                        'periodo_id' => $request->get('periodo'),
                        'sala_id' => $request->get('sala'),
                        'estacion_trabajo_id' => $request->get('estacion')
                        ]);

                    //pone disponibilidad en no para un lab completo
                    $id = $request->get('estacion');
                    $est = Estacion_trabajo::findOrFail($id);
                    $est->fill([
                        'disponibilidad' => "no",
                        ]); 
                    $est->save();
                }
                else
                {
                    //no corresponde el lab con la estacion
                    Session::flash('alerta4','¡No corresponde el Laboratorio con la Estación de Trabajo!');
                }
            }
        }
        Session::flash('create2','¡Reserva tomada correctamente!');
        return redirect()->route('director.horarioAlumno.index');
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
