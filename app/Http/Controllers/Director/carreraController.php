<?php

namespace App\Http\Controllers\Director;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Carrera;
use App\CarreraSala;
use App\Sala;
use App\UsersDpto;
use App\Escuela;
use Auth;
use App\User;
use Session;

class carreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('dir');
    }
    
    public function index()
    {
        //$carreras = Carrera::all();
        
        $usr=Auth::User()->rut;
        $dpto= UsersDpto::where('rut','=',$usr)
                        ->select('departamento_id')
                        ->get();

        $carreras= Carrera::join('escuela','carrera.escuela_id','=','escuela.id')
                        ->join('departamento','departamento.id','=','escuela.departamento_id')
                        ->where('departamento_id','=',$dpto->first()->departamento_id)
                        ->select('carrera.*','escuela.nombre as esc')
                        ->get();
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
            return view ('Director/carreras/index', compact('carreras','v2','cont'));
        }
        else
        {
            return view ('Director/carreras/index', compact('carreras','cont'));
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
        //$escuelas = Escuela::all();
        $usr=Auth::User()->rut;
        $dpto= UsersDpto::where('rut','=',$usr)
                        ->select('departamento_id')
                        ->get();

        $escuelas= Escuela::join('departamento','departamento.id','=','escuela.departamento_id')
                        ->where('departamento_id','=',$dpto->first()->departamento_id)
                        ->select('escuela.*')
                        ->get();
                        
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
            return view ('Director/carreras/create', compact('escuelas','v2','cont'));
        }
        else
        {
            return view ('Director/carreras/create', compact('escuelas','cont'));
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
        $codigo = Carrera::where('codigo','=',$request->get('codigo'))
                         ->select('id')
                         ->get();

        if(!$codigo->isEmpty())
        {
            Session::flash('create','¡Carrera ya creada anteriormente!');
            return redirect()->route('administrador.carrera.index');
        }

        $nombres = Carrera::select('nombre')
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
            Session::flash('create','¡Carrera ya creada anteriormente!');
            return redirect()->route('administrador.carrera.index');
        }

        $this->validate($request, [
            'escuela_id' => 'required',
            'codigo' => 'required|numeric',
            'nombre' => 'required',
            'descripcion' => 'required'
            ]);

        $carrera = Carrera::create([
            'escuela_id' => $request->get('escuela_id'),
            'codigo' => $request->get('codigo'),
            'nombre' => $request->get('nombre'),
            'descripcion' => $request->get('descripcion')
            ]);

        $usr=Auth::User()->rut;
        $dpto= UsersDpto::where('rut','=',$usr)
                        ->select('departamento_id')
                        ->get();

        $salas= Sala::where('departamento_id','=',$dpto->first()->departamento_id)
                        ->select('sala.id')
                        ->get();
        
        $carr = Carrera::where('codigo','=',$request->get('codigo'))
                        ->select('carrera.id')
                        ->get();
                        
        $carr2 = $carr->first()->id;
  
        foreach($salas as $v)
        {
           CarreraSala::create([
            'carrera_id' => $carr2,
            'sala_id' => $v->id,
            ]);
        }

        Session::flash('create','¡Carrera creada correctamente!');
        return redirect()->route('director.carrera.index');
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
        $carreras = Carrera::findOrFail($id);
        //$escuelas = Escuela::all();
        $usr=Auth::User()->rut;
        $dpto= UsersDpto::where('rut','=',$usr)
                        ->select('departamento_id')
                        ->get();

        $escuelas= Escuela::join('departamento','departamento.id','=','escuela.departamento_id')
                        ->where('departamento_id','=',$dpto->first()->departamento_id)
                        ->select('escuela.*')
                        ->get();
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
            return view ('Director/carreras/edit', compact('escuelas','carreras','v2','cont'));
        }
        else
        {
            return view ('Director/carreras/edit', compact('escuelas','carreras','cont'));
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
        $codigo = Carrera::where('codigo','=',$request->get('codigo'))
                         ->where('id','!=',$id)
                         ->select('id')
                         ->get();

        if(!$codigo->isEmpty())
        {
            Session::flash('create','¡Carrera ya creada anteriormente!');
            return redirect()->route('administrador.carrera.index');
        }

        $nombres = Carrera::where('id','!=',$id)
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

            $v1[] = strtolower(utf8_encode($cadena));
        }

        $original = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificada = 'aaaaaaaceeeeiiiidnoooooouuuuy
bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cad = utf8_decode($request->get('nombre'));
    $cad = strtr($cad, utf8_decode($original), $modificada);
    $cad = strtolower($cad);
    $nom = strtolower(utf8_encode($cad));

        $cont = count($v1);
        $co = 0;

        for($i=0; $i<$cont; $i++)
        {
            if($v1[$i]==$nom)
            {
                $co = $co+1;
            }
        }

        if($co > 0)
        {
            Session::flash('create','¡Carrera ya creada anteriormente!');
            return redirect()->route('administrador.carrera.index');
        }
        $this->validate($request, [
            'escuela_id' => 'required',
            'codigo' => 'required|numeric',
            'nombre' => 'required',
            'descripcion' => 'required'
            ]);

        $carrerasala = CarreraSala::where('carrera_id','=',$id)
                                  ->select('id')
                                  ->get();

        foreach($carrerasala as $v)
        {
            $v2[]= $v->id;
        }
        $cont= count($v2); 
        
        for($i=0;$i<$cont;$i++)
        {
            $carsa = CarreraSala::findOrFail($v2[$i]);
            $carsa->delete();
        }

        /**/
        $carreras = Carrera::findOrFail($id);     
        //fill (rellenar)
        $carreras->fill([
            'escuela_id' => $request->get('escuela_id'),
            'codigo' => $request->get('codigo'),
            'nombre' => $request->get('nombre'),
            'descripcion' => $request->get('descripcion')
        ]);
        $carreras->save();

        $usr=Auth::User()->rut;
        $dpto= UsersDpto::where('rut','=',$usr)
                        ->select('departamento_id')
                        ->get();

        $salas= Sala::where('departamento_id','=',$dpto->first()->departamento_id)
                        ->select('sala.id')
                        ->get();
        
        $carr = Carrera::where('codigo','=',$request->get('codigo'))
                        ->select('carrera.id')
                        ->get();
                        
        $carr2 = $carr->first()->id;
  
        foreach($salas as $v)
        {
           CarreraSala::create([
            'carrera_id' => $carr2,
            'sala_id' => $v->id,
            ]);
        }

        Session::flash('edit','¡Carrera editada correctamente!');
        return redirect()->route('director.carrera.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carrerasala = CarreraSala::where('carrera_id','=',$id)
                                  ->select('id')
                                  ->get();

        foreach($carrerasala as $v)
        {
            $v2[]= $v->id;
        }
        $cont= count($v2); 

        for($i=0;$i<$cont;$i++)
        {
            $carsa = CarreraSala::findOrFail($v2[$i]);
            $carsa->delete();
        }
        
        $carreras = Carrera::findOrFail($id);
        $carreras->delete();

        Session::flash('delete','¡Carrera eliminada correctamente!');
        return redirect()->route('director.carrera.index');
    }

    public function uploadCar(Request $request)
    {       
        if(is_null($request->file('file')))
        {
            Session::flash('message', 'Debes seleccionar un archivo.');
            return redirect()->back();
        }
           $file = $request->file('file');
     
           $nombre = $file->getClientOriginalName();
     
            \Storage::disk('local')->put($nombre,  \File::get($file));
            \Excel::load('/storage/app/'.$nombre,function($archivo) 
            {
                $result = $archivo->get();
                foreach($result as $key => $value)
                {
                    //agregar escuela con la id en el excel
                    $codigo = Carrera::where('codigo','=',$value->codigo)
                         ->select('id')
                         ->get();

        if(!$codigo->isEmpty())
        {
            Session::flash('create','¡Carrera ya creada anteriormente!');
            return redirect()->route('director.carrera.index');
        }

        $nombres = Carrera::select('nombre')
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
    $cad = utf8_decode($value->nombre);
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
            Session::flash('create','¡Carrera ya creada anteriormente!');
            return redirect()->route('director.carrera.index');
        }
                    $var = new Carrera();
                    $var->fill(['escuela_id' => $value->escuela, 'codigo' => $value->codigo, 'nombre' => $value->nombre, 'descripcion' => $value->descripcion]);
                    $var->save();

                    $dpto= Escuela::where('id','=',$value->escuela)
                                     ->select('escuela.departamento_id')
                                     ->get();

                    $salas= Sala::where('departamento_id','=',$dpto->first()->departamento_id)
                                    ->select('sala.id')
                                    ->get();

                    $carr = Carrera::where('codigo','=',$value->codigo)
                                    ->select('carrera.id')
                                    ->get();

                    $carr2 = $carr->first()->id;
              
                    foreach($salas as $v)
                    {
                       CarreraSala::create([
                        'carrera_id' => $carr2,
                        'sala_id' => $v->id,
                        ]);
                    }
                }
                Session::flash('message', '¡El archivo fue subido exitosamente!');
            })->get();
            
           return redirect()->route('director.carrera.index');
    }
}

