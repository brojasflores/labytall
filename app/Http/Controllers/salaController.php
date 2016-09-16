<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
//referencia al modelo (importarlo)
use App\Sala;

class salaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //tomar todo lo que venga de la tabla lab y mostrar 
        //all devuelve todo
        $salas = Sala::all();
        //se pasa la variable sin el peso con compact
        return view ('salas/index', compact('salas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('salas/create');
    }
    //el create te lleva a la vista y la vista lleva los datos al store y ese a la bdd
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //variable = nombre del modelo ::(paso metodo)
        //hace insert
        if($request->get('disponibilidadSala') == 'disponible'){
            $sala = Sala::create([
            'nombre' => $request->get('nombreSala'),
            'capacidad' => $request->get('capacidadSala'),
            'disponibilidad' => 'disponible'
            ]);
        }
        else{
            $sala = Sala::create([
            'nombre' => $request->get('nombreSala'),
            'capacidad' => $request->get('capacidadSala'),
            'disponibilidad' => 'no disponible'
            ]);
            }
    
        return redirect()->route('sala.index');
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
        //variable = modelo:: metodo encunetra un registro en la bdd segun id!!
        $sala = Sala::findOrFail($id);
        //en el compact se pasa la variable como string
        return view('salas/edit', compact('sala'));
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
        $sala = Sala::findOrFail($id);     
        //fill (rellenar)
        $sala->fill([
            'nombre' => $request->get('nombreSala'),
            'capacidad' => $request->get('capacidadSala'),
            'disponibilidad' => $request->get('disponibilidadSala')
        ]);
        $sala->save();

        $salas = Sala::all();

        return redirect()->route('sala.index');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sala = Sala::findOrFail($id);
        $sala->delete();
        return redirect()->route('sala.index');
    }
}
