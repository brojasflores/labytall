<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\User;
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


class autenticaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index()
    {
        $horarios = Horario::join('curso','horario.curso_id','=','curso.id')
                            ->join('asignatura','curso.asignatura_id','=','asignatura.id')
                            ->join('periodo','horario.periodo_id','=','periodo.id')
                            ->join('sala','horario.sala_id','=','sala.id')
                            ->join('users','horario.rut','=','users.rut')
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
            return view ('Administrador/autentica/index', compact('horarios','v2','cont'));
        }
        else
        {
            return view ('Administrador/autentica/index', compact('horarios','cont'));
        }
        //return view ('Administrador/horarios/index', compact('horarios')); 
    }

    public function create()
    {
        //
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
                               ->select('curso_id','periodo_id','sala_id','permanencia','fecha','dia')
                               ->orderBy('periodo_id','asc')
                               ->get();

            $fecha_inicio = Horario::where('curso_id',$horario[0]->curso_id)->where('dia',$horario[0]->dia)->min('fecha');

            $fecha_fin = Horario::where('curso_id',$horario[0]->curso_id)->where('dia',$horario[0]->dia)->max('fecha');

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
                $numero = Horario::where('id','=',$id)
                              ->select('rut')
                              ->get();

                $numero = $numero->first()->rut;

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

                $rut= $numero.$dvr;

            $horarios = Horario::findOrFail($id);

            $salas = Sala::all();
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
                return view ('Administrador/autentica/edit',compact('rut','horarios','salas','periodos','cursos','v2','cont'));
            }
            else
            {
                return view ('Administrador/autentica/edit',compact('rut','horarios','salas','periodos','cursos','cont'));
            }

            //return view('Administrador/horarios/edit',compact('horarios','salas','periodos','cursos'));
        }

    }


    public function update(Request $request, $id)
    {   
        //dd($request);
        if($request->ajax()){
            //dd($request);
            $dpto = Sala::where('id','=',$request->get('sala_id'))
                            ->select('departamento_id')
                            ->get();

            $dpto = $dpto->first()->departamento_id;

            $curso = Curso::join('asignatura','curso.asignatura_id','=','asignatura.id')
                           ->join('carrera','asignatura.carrera_id','=','carrera.id')
                           ->join('escuela','carrera.escuela_id','=','escuela.id')
                           ->join('departamento','escuela.departamento_id','=','departamento.id')
                           ->where('departamento.id','=',$dpto)
                           ->select('curso.*','asignatura.nombre as nombre')
                           ->get();


            return response()->json($curso);
        }
        
        $aut = Horario::findOrFail($id);
        $aut->fill([
        'asistencia' => $request->get('asistenciaH'),
        ]); 
        $aut->save();

        return redirect()->route('administrador.autentica.index');
        
    }

    public function destroy($id)
    {
        //
    }
}
