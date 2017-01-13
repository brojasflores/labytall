<?php

namespace App\Http\Controllers\Docente;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Periodo;
use Auth;

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
        $this->middleware('doc');
    }
    
    public function index()
    {
        $periodos = Periodo::all();
        //se pasa la variable sin el peso con compact
        //Cambio de rol
            $usr=Auth::User()->rut;
            //modelo:: otra tabla que consulto, lo que quiero de la tabla propia = lo de la otra tabla
            $usr2 = User::join('rol_users','users.rut','=','rol_users.rut')
                        ->where('users.rut','=',$usr)
                        ->join('rol','rol_users.rol_id','=','rol.id')
                        ->select('nombre')
                        ->get();
            // lo de arriba guarda una coleccion donde está el o los nombre(s) de los roles pertenecientes al usuario
            foreach($usr2 as $v)
            {
                $v2[]= $v->nombre;
            }
            //el foreach recorre la colección y guarda en un array solo los nombres de los roles del usuario 
            $cont = count($v2); //cuenta la cantidad de elementos del array
            
            if($cont>1)
            {
                return view ('Docente/periodos/index', compact('periodos','v2','cont'));
            }
            else
            {
                return view ('Docente/periodos/index', compact('periodos','cont'));
            }
        //return view ('Docente/periodos/index', compact('periodos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Cambio de rol
        $usr=Auth::User()->rut;
        //modelo:: otra tabla que consulto, lo que quiero de la tabla propia = lo de la otra tabla
        $usr2 = User::join('rol_users','users.rut','=','rol_users.rut')
                    ->where('users.rut','=',$usr)
                    ->join('rol','rol_users.rol_id','=','rol.id')
                    ->select('nombre')
                    ->get();
        // lo de arriba guarda una coleccion donde está el o los nombre(s) de los roles pertenecientes al usuario
        foreach($usr2 as $v)
        {
            $v2[]= $v->nombre;
        }
        //el foreach recorre la colección y guarda en un array solo los nombres de los roles del usuario 
        $cont = count($v2); //cuenta la cantidad de elementos del array
        
        if($cont>1)
        {
            return view ('Docente/periodos/create', compact('v2','cont'));
        }
        else
        {
            return view ('Docente/periodos/create', compact('cont'));
        }
        //return view('Docente/periodos/create');
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
        
        return redirect()->route('docente.periodo.index');
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
        //Cambio de rol
        $usr=Auth::User()->rut;
        //modelo:: otra tabla que consulto, lo que quiero de la tabla propia = lo de la otra tabla
        $usr2 = User::join('rol_users','users.rut','=','rol_users.rut')
                    ->where('users.rut','=',$usr)
                    ->join('rol','rol_users.rol_id','=','rol.id')
                    ->select('nombre')
                    ->get();
        // lo de arriba guarda una coleccion donde está el o los nombre(s) de los roles pertenecientes al usuario
        foreach($usr2 as $v)
        {
            $v2[]= $v->nombre;
        }
        //el foreach recorre la colección y guarda en un array solo los nombres de los roles del usuario 
        $cont = count($v2); //cuenta la cantidad de elementos del array
        
        if($cont>1)
        {
            return view('Docente/periodos/edit', compact('periodos','v2','cont'));
        }
        else
        {
            return view('Docente/periodos/edit', compact('periodos','cont'));
        }
        //return view('Docente/periodos/edit', compact('periodos'));
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

        return redirect()->route('docente.periodo.index');
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
        return redirect()->route('docente.periodo.index');
    }
}
