<?php

namespace App\Http\Controllers\Funcionario;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Curso;

use App\Asignatura;

class cursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //$cursos = Curso::paginate();
        $cursos = Curso::join('asignatura','curso.asignatura_id','=','asignatura.id')
                            ->select('curso.*','asignatura.nombre')
                            ->paginate();
        //se pasa la variable sin el peso con compact
        return view ('Funcionario/cursos/index', compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $asignaturas = Asignatura::all();
        return view('Funcionario/cursos/create',compact('asignaturas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $cursos = Curso::create([
            'asignatura_id' => $request->get('asigCurso'),
            'semestre' => $request->get('semestreCurso'),
            'anio' => $request->get('anioCurso'),
            'seccion' => $request->get('seccionCurso')
            ]);


        return redirect()->route('funcionario.curso.index');
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
        $cursos = Curso::findOrFail($id);
        //en el compact se pasa la variable como string
        $asignaturas = Asignatura::all();
        return view('Funcionario/cursos/edit', compact('cursos','asignaturas'));
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
        $cursos = Curso::findOrFail($id);     
        //fill (rellenar)
        $cursos->fill([
            'asignatura_id' => $request->get('asigCurso'),
            'semestre' => $request->get('semestreCurso'),
            'anio' => $request->get('anioCurso'),
            'seccion' => $request->get('seccionCurso')
        ]);
        $cursos->save();

        return redirect()->route('funcionario.curso.index');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cursos = Curso::findOrFail($id);
        $cursos->delete();

        return redirect()->route('funcionario.curso.index');
    }
}
