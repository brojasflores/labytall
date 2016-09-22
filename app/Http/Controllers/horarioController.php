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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horarios = Horario::join('curso','horario.curso_id','=','curso.id')
                            ->join('asignatura','curso.asignatura_id','=','asignatura.id')
                            ->join('periodo','horario.periodo_id','=','periodo.id')
                            ->join('sala','horario.sala_id','=','sala.id')
                            ->select('horario.id','horario.fecha','asignatura.nombre as asig_nombre','periodo.bloque','sala.nombre as sala_nombre')
                            ->paginate();

       // $horarios = Horario::paginate();
        return view ('horarios/index', compact('horarios')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $salas = Sala::all();
        $periodos = Periodo::all();
        $cursos = Curso::join('asignatura','curso.asignatura_id','=','asignatura.id')
                        ->select('curso.id','curso.seccion','asignatura.nombre')
                        ->get();
        
        return view('horarios/create',compact('salas','periodos','cursos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $horarios = Horario::create([
            'fecha' => $request->get('fechaHorario'),
            'sala_id' => $request->get('salaHorario'),
            'periodo_id' => $request->get('periodoHorario'),
            'curso_id' => $request->get('cursoHorario')
            ]);

        return redirect()->route('horario.index');
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
    public function edit($id,Request $request)
    {
        if($request->ajax()){

            $horarios = Horario::findOrFail($request->get('id'));
            $salas = Sala::select('nombre')->get();
            $periodos = Periodo::select('bloque')->get();
            $cursos = Curso::join('asignatura','curso.asignatura_id','=','asignatura.id')
                            ->select('curso.id','curso.seccion','asignatura.nombre')
                            ->get();

            $respuesta = ['salas' => $salas, 'periodos' => $periodos, 'cursos' => $cursos];
         //   $respuesta[1] = $rolesTotales;
            return response()->json($respuesta);
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
            /*$horarios = Horario::findOrFail($id);
            $salas = Sala::all();
            $periodos = Periodo::all();
            $cursos = Curso::join('asignatura','curso.asignatura_id','=','asignatura.id')
                            ->select('curso.id','curso.seccion','asignatura.nombre')
                            ->get();
            
            return view('horarios/edit',compact('horarios','salas','periodos','cursos'));*/
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $horarios = Horario::findOrFail($id);
        $horarios->delete();
        return redirect()->route('horario.index');
    }
}
