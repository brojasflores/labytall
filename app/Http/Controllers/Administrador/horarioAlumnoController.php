<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Horario_Alumno;
use App\Sala;
use App\Periodo;
use App\Curso;
use App\Asignatura;
use App\Estacion_trabajo;
use App\RolUsuario;
use Carbon\Carbon;
use Auth;
use App\User;

class horarioAlumnoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index()
    {

        $horarios = Horario_Alumno::join('periodo','horario_alum.periodo_id','=','periodo.id')
                            ->join('sala','horario_alum.sala_id','=','sala.id')
                            ->join('users','horario_alum.rut','=','users.rut')
                            ->join('estacion_trabajo','horario_alum.estacion_trabajo_id','=','estacion_trabajo.id')
                            ->select('horario_alum.id','horario_alum.fecha','horario_alum.rut','users.nombres as horario_name','users.apellidos as horario_apell','periodo.bloque','sala.nombre as sala_nombre','estacion_trabajo.id as est_trabajo')
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
            return view ('Administrador/horariosAlum/index', compact('horarios','v2','cont'));
        }
        else
        {
            return view ('Administrador/horariosAlum/index', compact('horarios','cont'));
        }
        //return view ('Administrador/horariosAlum/index', compact('horarios')); 
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
                                            ->where('estacion_trabajo.sala_id',$request->get('id'))
                                            ->where('estacion_trabajo.disponibilidad','si')
                                            ->select('estacion_trabajo.*','sala.nombre as sala')
                                            ->orderBy('estacion_trabajo.id','asc')
                                            ->get();

                return response()->json($estacion);                
            }


            $horario = Horario_Alumno::find($request->get('id'));

            return response()->json($horario);   

        }
        else{

            $horarios = Horario_Alumno::findOrFail($id);         

            $periodos = Periodo::select('id','bloque')->orderBy('bloque','asc')->get();

            $salas = Sala::join('estacion_trabajo','sala.id','=','estacion_trabajo.sala_id')
                          ->where('estacion_trabajo.disponibilidad','=','si')
                          ->select('sala.id','sala.nombre')
                          ->orderBy('sala.nombre','asc')
                          ->groupBy('sala.id','sala.nombre')
                          ->get();

            $est = Sala::join('estacion_trabajo','sala.id','=','estacion_trabajo.sala_id')
                          ->join('horario_alum','horario_alum.sala_id','=','sala.id')
                          ->where('horario_alum.id',$id)
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
                return view ('Administrador/horariosAlum/edit',compact('horarios','salas','periodos','est','v2','cont'));
            }
            else
            {
                return view ('Administrador/horariosAlum/edit',compact('horarios','salas','periodos','est','cont'));
            }
            //return view('Administrador/horariosAlum/edit',compact('horarios','salas','periodos','est'));
        }
    }


    public function update(Request $request, $id)
    {   
        $var = Horario_Alumno::where('id','=',$id)
             ->select('estacion_trabajo_id')
             ->get();

        foreach($var as $v)
        {
            $v2= $v->estacion_trabajo_id;
        }

        $est = Estacion_trabajo::findOrFail($v2);
            $est->fill([
            'disponibilidad' => "si",
            ]); 
            $est->save();

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
                                ->where('rol_users.rut','=',$request->get('rutHorario'))->select('rol.nombre')->get();
        }  
        foreach($alumno as $d)
        {
            if($d->nombre == 'alumno')
            {
                if($v1 == $request->get('salaHorario'))
                {                
                    $fecha_separada = explode('/',$request->get('fecha'));
                    $fecha_con_guion = [$fecha_separada[2],$fecha_separada[0],$fecha_separada[1]];
                    $fecha_formateada = implode('-',$fecha_con_guion);

                    $h = Horario_Alumno::findOrFail($id);
                    $h->fill([
                        'fecha' => $fecha_formateada,
                        'rut' => $request->get('rutHorario'),
                        'periodo_id' => $request->get('periodoHorario'),
                        'sala_id' => $request->get('salaHorario'),
                        'estacion_trabajo_id' => $request->get('estacion')
                    ]); 
                    $h->save();

                    $id2 = $request->get('estacion');
                    $est2 = Estacion_trabajo::findOrFail($id2);
                    $est2->fill([
                        'disponibilidad' => "no",
                        ]); 
                    $est2->save();
                }
                else
                {
                    //no corresponde el lab con la estacion
                    dd('nop');
                }
            }
            return redirect()->route('administrador.horarioAlumno.index');
        }
    }


    public function destroy($id)
    {
        $var = Horario_Alumno::where('id','=',$id)
               ->select('estacion_trabajo_id') 
               ->get();
        
        foreach($var as $v)
        {
            $v1= $v->estacion_trabajo_id;
        }

        $est = Estacion_trabajo::findOrFail($v1);
        $est->fill([
            'disponibilidad' => "si",
            ]); 
        $est->save();

        $horarios = Horario_Alumno::findOrFail($id);
        $horarios->delete();

        return redirect()->route('administrador.horarioAlumno.index');
    }
}
