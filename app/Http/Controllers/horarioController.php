<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Horario;
use App\Sala;
use App\Periodo;
use App\Curso;
use App\Asignatura;

class horarioController extends Controller
{

    public function index()
    {
        $horarios = Horario::join('curso','horario.curso_id','=','curso.id')
                            ->join('asignatura','curso.asignatura_id','=','asignatura.id')
                            ->join('periodo','horario.periodo_id','=','periodo.id')
                            ->join('sala','horario.sala_id','=','sala.id')
                            ->join('users','horario.rut','=','users.rut')
                            ->select('horario.id','horario.fecha','horario.rut','users.nombres as horario_name','users.apellidos as horario_apell','horario.permanencia','asignatura.nombre as asig_nombre','periodo.bloque','sala.nombre as sala_nombre')
                            ->paginate();

        return view ('horarios/index', compact('horarios')); 
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
            
            return view('horarios/edit',compact('horarios','salas','periodos','cursos'));
        }

    }


    public function update(Request $request, $id)
    {
        $horarios = Horario::findOrFail($id);     
        //fill (rellenar)
        $horarios->fill([
            'fecha' => $request->get('fechaHorario'),
            'sala_id' => $request->get('salaHorario'),
            'periodo_id' => $request->get('periodoHorario'),
            'curso_id' => $request->get('cursoHorario')
            ]);
        $horarios->save();

        return redirect()->route('horario.index');
    }


    public function destroy($id)
    {
        $horarios = Horario::findOrFail($id);
        $curso = $horarios->curso_id;
        Horario::where('curso_id',$curso)->delete();
        return redirect()->route('horario.index');
    }
}
