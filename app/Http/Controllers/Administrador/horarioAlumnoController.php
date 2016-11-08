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
        /*if($request->ajax()){
         
            $horario = Horario::where('id',$request->get('id'))->select('curso_id','periodo_id','sala_id','permanencia','fecha')->get();
        
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

            $salas = Sala::all();
            $periodos = Periodo::all();
            $cursos = Curso::join('asignatura','curso.asignatura_id','=','asignatura.id')
                            ->select('curso.id','curso.seccion','asignatura.nombre')
                            ->get();
            
            return view('Administrador/horarios/edit',compact('horarios','salas','periodos','cursos'));
        }*/
    }


    public function update(Request $request, $id)
    {   
        /*$var = Horario::where('id','=',$id)
               ->select('sala_id')
               ->paginate();

        foreach($var as $v)
        {
            $v2= $v->sala_id;
        }

        $esT = Estacion_trabajo::where('sala_id','=',$v2)
               ->select('id')
               ->paginate();

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
        
        //yo
        $horarios = Horario::findOrFail($id);
        $curso = $horarios->curso_id;
        $periodo = $horarios->periodo_id;
        Horario::where('curso_id',$curso)
                ->where('periodo_id',$periodo)
                ->delete();

        if($request->get('permanencia') === 'dia')
        {
            //Formatear la fecha de mm/dd/aaaa => aaaa-mm-dd
            $fecha_separada = explode('/',$request->get('fecha'));
            $fecha_con_guion = [$fecha_separada[2],$fecha_separada[0],$fecha_separada[1]];
            $fecha_formateada = implode('-',$fecha_con_guion);
       
            Horario::create([
                'fecha' => $fecha_formateada,
                'sala_id' => $request->get('salaHorario'),
                'periodo_id' => $request->get('periodoHorario'),
                'curso_id' => $request->get('cursoHorario'),
                'rut' => $request->get('rutHorario'),
                'permanencia' => 'dia'
                ]);

            $id2 = $request->get('salaHorario');
            $est = Estacion_trabajo::where('sala_id','=',$id2)
               ->select('id')
               ->paginate();
            foreach($est as $v)
            {
                $v4[]= $v->id;
            }
            $cont2= count($v4); 
            for($j=0;$j<$cont2;$j++)
            {
                $est = Estacion_trabajo::findOrFail($v4[$j]);
                $est->fill([
                'disponibilidad' => "no",
                ]); 
                $est->save();
            }
            $est->save();

            return redirect()->route('administrador.horario.index');
        }

        return redirect()->route('horario.index');*/
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
