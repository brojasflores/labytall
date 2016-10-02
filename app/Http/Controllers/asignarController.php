<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Sala;
use App\Periodo;
use App\Curso;
use App\Asignatura;
use App\Horario;

class asignarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$asignaturas = Asignatura::all();
        //se pasa la variable sin el peso con compact
        return view ('asignar/index');
    }

    public function docente()
    {
        $salas = Sala::select('id','nombre')->orderBy('nombre','asc')->get();
        $periodos = Periodo::select('id','bloque')->orderBy('bloque','asc')->get();
        $cursos = Curso::join('asignatura','curso.asignatura_id','=','asignatura.id')
                        ->select('curso.id','curso.seccion','asignatura.nombre')
                        ->orderBy('asignatura.nombre','asc')
                        ->get();

        return view ('asignar/docente',compact('salas','periodos','cursos'));
    }

    public function ayudante()
    {
        return view ('asignar/ayudante');
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

        if($request->get('permanencia') === 'dia')
        {
            //Formatear la fecha de mm/dd/aaaa => aaaa-mm-dd
            $fecha_separada = explode('/',$request->get('fecha'));
            $fecha_con_guion = [$fecha_separada[2],$fecha_separada[0],$fecha_separada[1]];
            $fecha_formateada = implode('-',$fecha_con_guion);
       
            Horario::create([
                'fecha' => $fecha_formateada,
                'sala_id' => $request->get('sala'),
                'periodo_id' => $request->get('periodo'),
                'curso_id' => $request->get('curso'),
                'rut' => $request->get('usuario'),
                'permanencia' => 'dia'
                ]);

            return redirect()->route('horario.index');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
