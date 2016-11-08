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
                            ->paginate();

        return view ('Administrador/horariosAlum/index', compact('horarios')); 
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
         
            $horario = Horario_Alumno::where('id',$request->get('id'))->select('fecha','rut','periodo_id','sala_id','estacion_trabajo_id')->get();
        
            $fecha_inicio = Horario_Alumno::where('curso_id',$horario[0]->curso_id)->min('fecha');

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

            $horarios = Horario_Alumno::findOrFail($id);         

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


            return view('Administrador/horariosAlum/edit',compact('horarios','salas','periodos','est'));
        }
    }


    public function update(Request $request, $id)
    {   
        $var = Horario_Alumno::where('id','=',$id)
             ->select('estacion_trabajo_id')
             ->paginate();

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
               ->paginate();
        
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
