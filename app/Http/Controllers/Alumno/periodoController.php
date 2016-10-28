<?php

namespace App\Http\Controllers\Alumno;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Periodo;

class periodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('docente');
        $this->middleware('alum');
    }
    
    public function index()
    {
        $periodos = Periodo::all();
        //se pasa la variable sin el peso con compact
        return view ('Alumno/periodos/index', compact('periodos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Alumno/periodos/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $periodos = Periodo::create([
            'bloque' => $request->get('bloquePeriodo'),
            'inicio' => $request->get('inicioPeriodo'),
            'fin' => $request->get('finPeriodo')
            ]);
        
        return redirect()->route('alumno.periodo.index');
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
        $periodos = Periodo::findOrFail($id);
        //en el compact se pasa la variable como string
        return view('Alumno/periodos/edit', compact('periodos'));
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
        $periodos = Periodo::findOrFail($id);     
        //fill (rellenar)
        $periodos->fill([
            'bloque' => $request->get('bloquePeriodo'),
            'inicio' => $request->get('inicioPeriodo'),
            'fin' => $request->get('finPeriodo')
        ]);
        $periodos->save();

        return redirect()->route('alumno.periodo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $periodos = Periodo::findOrFail($id);
        $periodos->delete();
        return redirect()->route('alumno.periodo.index');
    }
}
