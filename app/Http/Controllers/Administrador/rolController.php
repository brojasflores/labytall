<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Rol;


class rolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index()
    {

        $roles = Rol::all();
        //se pasa la variable sin el peso con compact
        return view ('Administrador/roles/index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Administrador/roles/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $roles = Rol::create([
            'nombre' => $request->get('nombreRol'),
            'descripcion' => $request->get('descripcionRol'),
            ]);
        return redirect()->route('administrador.rol.index');
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
        $roles = Rol::findOrFail($id);
        //en el compact se pasa la variable como string
        return view('Administrador/roles/edit', compact('roles'));
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
        $roles = Rol::findOrFail($id);     
        //fill (rellenar)
        $roles->fill([
            'nombre' => $request->get('nombreRol'),
            'descripcion' => $request->get('descripcionRol'),
        ]);
        $roles->save();

        return redirect()->route('administrador.rol.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roles = Rol::findOrFail($id);
        $roles->delete();
        return redirect()->route('administrador.rol.index');
    }
}
