<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Horario;
use App\Sala;
use App\Periodo;
use App\Curso;
use App\Asignatura;
use Carbon\Carbon;

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
       
        Horario::where('curso_id',$request->get('cursoHorario'))->delete();

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

            return redirect()->route('horario.index');
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
                                   'sala_id' => $request->get('salaHorario'),
                                   'periodo_id' => $request->get('periodoHorario'),
                                   'curso_id' => $request->get('cursoHorario'),
                                   'rut' => $request->get('rutHorario'),
                                   'permanencia' => 'semestral'
                                   ]);
                        }
                    }
                    if($request->get('dia') === 'martes')
                    {
                        $martes = new Carbon('this tuesday');
                        if($martes <= $termino)
                        {
                            $mar = Horario::create([
                                   'fecha' => $mates,
                                   'sala_id' => $request->get('salaHorario'),
                                   'periodo_id' => $request->get('periodoHorario'),
                                   'curso_id' => $request->get('cursoHorario'),
                                   'rut' => $request->get('rutHorario'),
                                   'permanencia' => 'semestral'
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
                                   'sala_id' => $request->get('salaHorario'),
                                   'periodo_id' => $request->get('periodoHorario'),
                                   'curso_id' => $request->get('cursoHorario'),
                                   'rut' => $request->get('rutHorario'),
                                   'permanencia' => 'semestral'
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
                                   'sala_id' => $request->get('salaHorario'),
                                   'periodo_id' => $request->get('periodoHorario'),
                                   'curso_id' => $request->get('cursoHorario'),
                                   'rut' => $request->get('rutHorario'),
                                   'permanencia' => 'semestral'
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
                                   'sala_id' => $request->get('salaHorario'),
                                   'periodo_id' => $request->get('periodoHorario'),
                                   'curso_id' => $request->get('cursoHorario'),
                                   'rut' => $request->get('rutHorario'),
                                   'permanencia' => 'semestral'
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
                                   'sala_id' => $request->get('salaHorario'),
                                   'periodo_id' => $request->get('periodoHorario'),
                                   'curso_id' => $request->get('cursoHorario'),
                                   'rut' => $request->get('rutHorario'),
                                   'permanencia' => 'semestral'
                                   ]);
                        }
                    }
                    $inicio->addWeek(1);
                }
            }
            return redirect()->route('horario.index');
        }
        /*$horarios = Horario::findOrFail($id);     
        //fill (rellenar)
        $horarios->fill([
            'fecha' => $request->get('fechaHorario'),
            'sala_id' => $request->get('salaHorario'),
            'periodo_id' => $request->get('periodoHorario'),
            'curso_id' => $request->get('cursoHorario')
            ]);
        $horarios->save();
*/
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
