<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Campus;
use Auth;
use App\User;
use Session;
//use App\Http\Controllers\Controller;

class campusController extends Controller
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
        $campus = Campus::all();
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
            return view ('Administrador/campus/index', compact('campus','v2','cont'));
        }
        else
        {
            return view ('Administrador/campus/index', compact('campus','cont'));
        }
        //return view ('Administrador/periodos/index', compact('periodos'));
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
            return view ('Administrador/campus/create', compact('v2','cont'));
        }
        else
        {
            return view ('Administrador/campus/create', compact('cont'));
        }
        //return view('Administrador/periodos/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $nombres = Campus::select('nombre')
                         ->get();

        foreach($nombres as $v)
        {
            $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy
bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($v->nombre);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);

            $v2[] = strtolower(utf8_encode($cadena));
        }

        $original = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificada = 'aaaaaaaceeeeiiiidnoooooouuuuy
bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cad = utf8_decode($request->get('nombre'));
    $cad = strtr($cad, utf8_decode($original), $modificada);
    $cad = strtolower($cad);
    $nom = strtolower(utf8_encode($cad));

        $cont = count($v2);
        $co = 0;

        for($i=0; $i<$cont; $i++)
        {
            if($v2[$i]==$nom)
            {
                $co = $co+1;
            }
        }
        if($co > 0)
        {
            Session::flash('create','¡Campus ya creado anteriormente!');
            return redirect()->route('administrador.campus.create');
        }

        $this->validate($request, [

            'nombre' => 'required',
            'direccion' => 'required',
            'descripcion' => 'required'
            ]);

        $campus = Campus::create([
            'nombre' => $request->get('nombre'),
            'direccion' => $request->get('direccion'),
            'descripcion' => $request->get('descripcion')
            ]);
        
        Session::flash('create','¡Campus creado correctamente!');
        return redirect()->route('administrador.campus.index');
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
        $campus = Campus::findOrFail($id);
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
            return view ('Administrador/campus/edit', compact('campus','v2','cont'));
        }
        else
        {
            return view ('Administrador/campus/edit', compact('campus','cont'));
        }
        //return view('Administrador/periodos/edit', compact('periodos'));
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
        $nombres = Campus::where('id','!=',$id)
                         ->select('nombre')
                         ->get();

        foreach($nombres as $v)
        {
            $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy
bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($v->nombre);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);

            $v2[] = strtolower(utf8_encode($cadena));
        }

        $original = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificada = 'aaaaaaaceeeeiiiidnoooooouuuuy
bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cad = utf8_decode($request->get('nombre'));
    $cad = strtr($cad, utf8_decode($original), $modificada);
    $cad = strtolower($cad);
    $nom = strtolower(utf8_encode($cad));

        $cont = count($v2);
        $co = 0;

        for($i=0; $i<$cont; $i++)
        {
            if($v2[$i]==$nom)
            {
                $co = $co+1;
            }
        }
        if($co > 0)
        {
            Session::flash('create','¡Campus ya creado anteriormente!');
            return redirect()->route('administrador.campus.index');
        }

        $this->validate($request, [

            'nombre' => 'required',
            'direccion' => 'required',
            'descripcion' => 'required'
            ]);

        $campus = Campus::findOrFail($id);     
        //fill (rellenar)
        $campus->fill([
            'nombre' => $request->get('nombre'),
            'direccion' => $request->get('direccion'),
            'descripcion' => $request->get('descripcion')
        ]);
        $campus->save();

        Session::flash('edit','¡Campus editado correctamente!');
        return redirect()->route('administrador.campus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $campus = Campus::findOrFail($id);
        $campus->delete();

        Session::flash('delete','¡Campus eliminado correctamente!');
        return redirect()->route('administrador.campus.index');
    }
}
