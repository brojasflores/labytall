<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Asignatura;


class asignaturaController extends Controller
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
        $asignaturas = Asignatura::all();
        //se pasa la variable sin el peso con compact
        return view ('Administrador/asignaturas/index', compact('asignaturas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Administrador/asignaturas/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $asignaturas = Asignatura::create([
            'codigo' => $request->get('codigoAsignatura'),
            'nombre' => $request->get('nombreAsignatura'),
            'descripcion' => $request->get('descripcionAsignatura')
            ]);
            //$asignaturas = Asignatura::all();        
        return redirect()->route('administrador.asignatura.index');
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
        $asignaturas = Asignatura::findOrFail($id);
        //en el compact se pasa la variable como string
        return view('Administrador/asignaturas/edit', compact('asignaturas'));
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
        $asignaturas = Asignatura::findOrFail($id);     
        //fill (rellenar)
        $asignaturas->fill([
            'codigo' => $request->get('codigoAsignatura'),
            'nombre' => $request->get('nombreAsignatura'),
            'descripcion' => $request->get('descripcionAsignatura')
        ]);
        $asignaturas->save();
        return redirect()->route('administrador.asignatura.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asignaturas = Asignatura::findOrFail($id);
        $asignaturas->delete();
        return redirect()->route('administrador.asignatura.index');
    }
}
