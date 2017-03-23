<?php

namespace App\Http\Controllers\Director;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\User;
use App\Rol;
use App\RolUsuario;
use App\Departamento;
use App\UsersDpto;
use App\UsersCarrera;
use App\Carrera;
//Para el hash de la password
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Validator;
use Auth;
use Session;


class usuarioController extends Controller
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
        $usr=Auth::User()->rut;
        $dpto= UsersDpto::where('rut','=',$usr)
                        ->select('departamento_id')
                        ->get();
        $usuarios1 = User::join('users_dpto','users.rut','=','users_dpto.rut')
                        ->where('users_dpto.departamento_id',$dpto->first()->departamento_id)
                        ->select('users.*');
                        
       
        $usuarios2 = User::join('users_carrera','users.rut','=','users_carrera.rut')
                        ->join('carrera','carrera.id','=','users_carrera.carrera_id')
                        ->join('escuela','escuela.id','=','carrera.escuela_id')
                        ->join('departamento','departamento.id','=','escuela.departamento_id')
                        ->where('departamento.id',$dpto->first()->departamento_id)
                        ->select('users.*');
                        
        $usuarios = $usuarios1->union($usuarios2)->get();
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
            return view ('Director/usuarios/index', compact('usuarios','v2','cont'));
        }
        else
        {
            return view ('Director/usuarios/index', compact('usuarios','cont'));
        }
        //return view('Director/usuarios/index', compact('usuarios')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Rol::all();
        $dpt= Departamento::all();
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
            return view ('Director/usuarios/create', compact('roles','dpt','v2','cont'));
        }
        else
        {
            return view ('Director/usuarios/create', compact('roles','dpt','cont'));
        }
        //return view('Director/usuarios/create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rut = preg_replace('/[^k0-9]/i', '', $request->rut);
        $dv  = substr($rut, -1);
        $numero = substr($rut, 0, strlen($rut)-1);
        //dd($numero);
        $i = 2;
        $suma = 0;
        foreach(array_reverse(str_split($numero)) as $v)
        {
            if($i==8)
                $i = 2;
            $suma += $v * $i;
            ++$i;
        }
        $dvr = 11 - ($suma % 11);
        
        if($dvr == 11)
            $dvr = 0;
        if($dvr == 10)
            $dvr = 'K';
        if($dvr == strtoupper($dv))
            $ok='si';
        else
            $ok='no';

        if($request->get('roles') == null)
        {
            Session::flash('create','¡Debe ingresar al menos un rol!');
            return redirect()->route('director.usuario.create');
        }
        
        $esta = User::where('rut','=',$numero)
                    ->select('id')
                    ->get();

    if($esta->isEmpty())
    {
        if($ok == 'no'){
       $this->validate($request, [
            'rut' => 'required|max:9|url|min:8',
            'email' => 'required|email',
            'nombres' => 'required',
            'apellidos' => 'required',
            ]); 
         }
         else{
            $this->validate($request, [
                'rut' => 'required|max:9|min:8',
                'email' => 'required|email',
                'nombres' => 'required',
                'apellidos' => 'required',
                ]); 
         }
           
           //para encriptar la clave y mandar una por defecto (en este caso el mismo rut)
           // $pass = Hash::make($request->get('rut'));
            $pass = Hash::make($numero);
          
            User::create([
                'rut' => $numero,
                'email' => $request->get('email'),
                'nombres' => $request->get('nombres'),
                'apellidos' => $request->get('apellidos'),
                'password' => $pass,
                'perfiles' => "perfiles/h1m7G86a6OR1tLguLSNjj20czNunkW-XjSiKjE0nySu06OWdp3dutyuujpnJc-user2-160x160.png"
            ]);

            foreach($request->get('roles') as $rol)
            {
                RolUsuario::create([
                    'rut' =>$numero,
                    'rol_id' => $rol
                    ]);
            }

            $usr=Auth::User()->rut;
            $dpto= UsersDpto::where('rut','=',$usr)
                            ->select('departamento_id')
                            ->get();
            foreach($request->get('roles') as $rol2)
            {
                UsersDpto::create([
                'rut' =>$numero,
                'departamento_id' => $dpto->first()->departamento_id
                ]);
            }

            Session::flash('create','¡Usuario creado correctamente!');
            return redirect()->route('director.usuario.index');
    }
    else{
        Session::flash('rut','¡Usuario ya ingresado anteriormente!');
        return redirect()->route('director.usuario.create');
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
    public function edit($id,Request $request)
    {
       
        if($request->ajax()){

            $usuario = User::findOrFail($request->get('id'));
            $roles = RolUsuario::where('rut',$usuario->rut)->select('rut','rol_id')->get();
            $rolesTotales = Rol::where('nombre','!=','docente')->where('nombre','!=','alumno')->select('id','nombre')->get();

            $respuesta = ['roles' => $rolesTotales, 'roles_usuario' => $roles];
     
            return response()->json($respuesta);
        }
        else{

            $numero = User::where('id','=',$id)
                          ->select('rut')
                          ->get();
            $numero = $numero->first()->rut;

            $i = 2;
            $suma = 0;
            foreach(array_reverse(str_split($numero)) as $v)
            {
                if($i==8)
                    $i = 2;
                $suma += $v * $i;
                ++$i;
            }
            $dvr = 11 - ($suma % 11);
            
            if($dvr == 11)
                $dvr = 0;
            if($dvr == 10)
                $dvr = 'K';

            $rut= $numero.$dvr;


            $usuario = User::findOrFail($id);

            $rutd = User::where('id','=',$id)
                       ->select('rut')
                       ->get();
            $rutd=$rutd->first()->rut;

            $depa = UsersDpto::where('rut','=',$rutd)
                             ->select('departamento_id')
                             ->get();
            $depa = $depa->first()->departamento_id;

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
            
            $dpt= Departamento::all();


            if($cont>1)
            {
                return view ('Director/usuarios/edit', compact('rut','depa','usuario','dpt','v2','cont'));
            }
            else
            {
                return view ('Director/usuarios/edit', compact('rut','depa','usuario','dpt','cont'));
            }
            //return view('Director/usuarios/edit', compact('usuario'));
        }
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
        $rut = preg_replace('/[^k0-9]/i', '', $request->rut);
        $dv  = substr($rut, -1);
        $numero = substr($rut, 0, strlen($rut)-1);
        //dd($numero);
        $i = 2;
        $suma = 0;
        foreach(array_reverse(str_split($numero)) as $v)
        {
            if($i==8)
                $i = 2;
            $suma += $v * $i;
            ++$i;
        }
        $dvr = 11 - ($suma % 11);
        
        if($dvr == 11)
            $dvr = 0;
        if($dvr == 10)
            $dvr = 'K';
        if($dvr == strtoupper($dv))
            $ok='si';
        else
            $ok='no';

     if($ok == 'no'){
       $this->validate($request, [
            'rut' => 'required|max:9|url|min:8',
            'email' => 'required|email',
            'nombres' => 'required',
            'apellidos' => 'required',
            ]); 
     }
     else{
        $this->validate($request, [
            'rut' => 'required|max:9|min:8',
            'email' => 'required|email',
            'nombres' => 'required',
            'apellidos' => 'required',
            ]); 
     }

        
        $usuarios = User::findOrFail($id);
        //fill (rellenar)
        $usuarios->fill([
            'rut' => $numero,
            'email' => $request->get('email'),
            'nombres' => $request->get('nombres'),
            'apellidos' => $request->get('apellidos')
        ]);
        $usuarios->save();

        //Busca en la tabla rol_usuario el rut que sea igual al rut que viene de la vista(request->get('rutUsuario')) y con el get lo toma
        $roles_usuario = RolUsuario::where('rut',$numero)->get();
        foreach($roles_usuario as $ru)
        {
            //dd($ru->rol_id);
            $var = Rol::join('rol_users','rol.id','=','rol_users.rol_id')
                      ->where('rol.id','=',$ru->rol_id)
                      ->select('rol.nombre')
                      ->get();
            //dd($var->first()->nombre);
            if($var->first()->nombre != 'docente' && $var->first()->nombre != 'alumno')
            {
                $ru->delete();
            }
            $ru->delete();
        }

        if($request->get('roles')==null)
        {
            $cont = RolUsuario::where('rut',$numero)->get();
            $cont = count($cont);
            if($cont == 0 )
            {
                Session::flash('create','¡Debe ingresar al menos un rol!');
                return redirect()->route('director.usuario.index');
            }
        }
        else
        {
            foreach($request->get('roles') as $rol)
            {
                RolUsuario::create([
                    'rut' =>$numero,
                    'rol_id' => $rol
                    ]);
            }
        }
        
        $dpto_usr = UsersDpto::where('rut',$numero)->get();
        
        foreach($dpto_usr as $de)
        {
            $id2=$de->id;
        }
        $dp = UsersDpto::findOrFail($id2);
        $dp->delete();

        $usr=Auth::User()->rut;
        $dpto= UsersDpto::where('rut','=',$usr)
                        ->select('departamento_id')
                        ->get();
        foreach($request->get('roles') as $rol2)
        {
            UsersDpto::create([
            'rut' =>$numero,
            'departamento_id' => $dpto->first()->departamento_id
            ]);
        }

        Session::flash('edit','¡Usuario editado correctamente!');
        return redirect()->route('director.usuario.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuarios = User::findOrFail($id);
        $usuarios->delete();
        Session::flash('destroy','¡Usuario eliminado correctamente!');
        return redirect()->route('director.usuario.index');
    }
    public function uploadAlum(Request $request)
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
                    $rut = preg_replace('/[^k0-9]/i', '', $value->rut);
                    $dv  = substr($rut, -1);
                    $numero = substr($rut, 0, strlen($rut)-1);
                    //dd($numero);
                    $i = 2;
                    $suma = 0;
                    foreach(array_reverse(str_split($numero)) as $v)
                    {
                        if($i==8)
                            $i = 2;
                        $suma += $v * $i;
                        ++$i;
                    }
                    $dvr = 11 - ($suma % 11);
                    
                    if($dvr == 11)
                        $dvr = 0;
                    if($dvr == 10)
                        $dvr = 'K';
                    if($dvr == strtoupper($dv))
                        $ok='si';
                    else
                        $ok='no';

                    if($ok == 'no')
                    {
                        Session::flash('create', 'Hay rut ingresados que son inválidos');
                        return redirect()->route('director.usuario.index');
                    }
                    else
                    {
                        $esta = User::where('rut','=',$numero)
                                    ->select('id')
                                    ->get();

                        if(!$esta->isEmpty())
                        {
                            Session::flash('create', 'En la lista hay usuarios ya ingresados');
                            return redirect()->route('director.usuario.index');
                        }
                    $var = new User();
                    $var->fill(['rut' => $numero]);
                    $var->save();

                    $carrera_id = Carrera::where('codigo','=',$value->carrera)
                                        ->select('id')
                                        ->get();

                    $var2 = new UsersCarrera();
                    $var2->fill(['rut' => $numero, 'carrera_id' => $carrera_id->first()->id]);
                    $var2->save();

                    

                    //obtener el dpto correspondiente a la carrera
                    $dpto = Departamento::join('escuela','departamento.id','=','escuela.departamento_id')
                                        ->join('carrera','escuela.id','=','carrera.escuela_id')
                                        ->where('carrera.id','=',$carrera_id->first()->id)
                                        ->select('departamento.id')
                                        ->get();

                    $var3 = new UsersDpto();
                    $var3->fill(['rut' => $numero, 'departamento_id' => $dpto->first()->id]);
                    $var3->save();
                }
            }
            Session::flash('message', 'Los Alumnos fueron agregados exitosamente!');
            })->get();
            
           return redirect()->route('director.usuario.index');
    }

    public function uploadDocente(Request $request)
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
                    $rut = preg_replace('/[^k0-9]/i', '', $value->rut);
                    $dv  = substr($rut, -1);
                    $numero = substr($rut, 0, strlen($rut)-1);
                    //dd($numero);
                    $i = 2;
                    $suma = 0;
                    foreach(array_reverse(str_split($numero)) as $v)
                    {
                        if($i==8)
                            $i = 2;
                        $suma += $v * $i;
                        ++$i;
                    }
                    $dvr = 11 - ($suma % 11);
                    
                    if($dvr == 11)
                        $dvr = 0;
                    if($dvr == 10)
                        $dvr = 'K';
                    if($dvr == strtoupper($dv))
                        $ok='si';
                    else
                        $ok='no';

                    if($ok == 'no')
                    {
                        Session::flash('create', 'Hay rut ingresados que son inválidos');
                        return redirect()->route('director.usuario.index');
                    }
                    else
                    {
                        $esta = User::where('rut','=',$numero)
                                    ->select('id')
                                    ->get();

                        if(!$esta->isEmpty())
                        {
                            Session::flash('create', 'En la lista hay usuarios ya ingresados');
                            return redirect()->route('director.usuario.index');
                        }
                    $var = new User();
                    $var->fill(['rut' => $numero]);
                    $var->save();

                    $var2 = new UsersDpto();
                    $var2->fill(['rut' => $numero, 'departamento_id' => $value->departamento]);
                    $var2->save();

                    
                    $doc = "docente";
                    $rol = Rol::where('nombre','=',$doc)
                              ->select('id')
                              ->get();

                    $rol = $rol->first()->id;

                    RolUsuario::create([
                    'rut' => $numero,
                    'rol_id' => $rol
                    ]);
                }
            }
            Session::flash('message', 'Los Docentes fueron agregados exitosamente!');
            })->get();
            
           return redirect()->route('director.usuario.index');
    }

}