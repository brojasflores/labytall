<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\User;
use App\Rol;
use App\RolUsuario;
use App\Departamento;
use App\UsersDpto;
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
        $this->middleware('admin');

    }

    public function index()
    {
        //llamo al modelo de bdd a la tabla usuario en app y luego puedo llamar a la tabla...
        $usuarios = User::all();
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
            return view ('Administrador/usuarios/index', compact('usuarios','v2','cont'));
        }
        else
        {
            return view ('Administrador/usuarios/index', compact('usuarios','cont'));
        }
        //return view('Administrador/usuarios/index', compact('usuarios')); 
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
            return view ('Administrador/usuarios/create', compact('roles','dpt','v2','cont'));
        }
        else
        {
            return view ('Administrador/usuarios/create', compact('roles','dpt','cont'));
        }
        //return view('Administrador/usuarios/create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //para encriptar la clave y mandar una por defecto (en este caso el mismo rut)
       // $pass = Hash::make($request->get('rut'));
        $pass = Hash::make($request->get('rutUsuario'));
      
        User::create([
            'rut' => $request->get('rutUsuario'),
            'email' => $request->get('emailUsuario'),
            'nombres' => $request->get('nombresUsuario'),
            'apellidos' => $request->get('apellidosUsuario'),
            'password' => $pass,
            'perfiles' => "perfiles/h1m7G86a6OR1tLguLSNjj20czNunkW-XjSiKjE0nySu06OWdp3dutyuujpnJc-user2-160x160.png"
        ]);

        foreach($request->get('roles') as $rol)
        {
            RolUsuario::create([
                'rut' =>$request->get('rutUsuario'),
                'rol_id' => $rol
                ]);
        }

        UsersDpto::create([
            'rut' => $request->get('rutUsuario'),
            'departamento_id' => $request->get('dpt'),
        ]);

        Session::flash('create','¡Usuario creado correctamente!');
        return redirect()->route('administrador.usuario.index');
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
            $rolesTotales = Rol::select('id','nombre')->get();

            $respuesta = ['roles' => $rolesTotales, 'roles_usuario' => $roles];
     
            return response()->json($respuesta);
        }
        else{

            $usuario = User::findOrFail($id);
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
                return view ('Administrador/usuarios/edit', compact('usuario','dpt','v2','cont'));
            }
            else
            {
                return view ('Administrador/usuarios/edit', compact('usuario','dpt','cont'));
            }
            //return view('Administrador/usuarios/edit', compact('usuario'));
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
  
        $usuarios = User::findOrFail($id);
        //fill (rellenar)
        $usuarios->fill([
            'rut' => $request->get('rutUsuario'),
            'email' => $request->get('emailUsuario'),
            'nombres' => $request->get('nombresUsuario'),
            'apellidos' => $request->get('apellidosUsuario')
        ]);
        $usuarios->save();

        //Busca en la tabla rol_usuario el rut que sea igual al rut que viene de la vista(request->get('rutUsuario')) y con el get lo toma
        $roles_usuario = RolUsuario::where('rut',$request->get('rutUsuario'))->get();
        foreach($roles_usuario as $ru)
        {
            $ru->delete();
        }

        foreach($request->get('roles') as $rol)
        {
            RolUsuario::create([
                'rut' =>$request->get('rutUsuario'),
                'rol_id' => $rol
                ]);
        }
        
        $dpto_usr = UsersDpto::where('rut',$request->get('rutUsuario'))->get();
        
        foreach($dpto_usr as $de)
        {
            $id2=$de->id;
        }
        $dp = UsersDpto::findOrFail($id2);
        $dp->delete();

        UsersDpto::create([
            'rut' => $request->get('rutUsuario'),
            'departamento_id' => $request->get('dpt'),
        ]);

        Session::flash('edit','¡Usuario editado correctamente!');
        return redirect()->route('administrador.usuario.index');
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
        return redirect()->route('administrador.usuario.index');
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
                    $var = new User();
                    $var->fill(['rut' => $value->rut]);
                    $var->save();

                    $carrera_id = Carrera::where('codigo','=',$value->carrera)
                                        ->select('id')
                                        ->get();

                    $var2 = new UsersCarrera();
                    $var2->fill(['rut' => $value->rut, 'carrera_id' => $carrera_id->first()->id]);
                    $var2->save();

                    $dpto = Departamento::join('escuela','departamento.id','=','escuela.departamento_id')
                                        ->join('carrera','escuela.id','=','carrera.escuela_id')
                                        ->where('carrera.id','=',$carrera_id)
                                        ->select('departamento.id')
                                        ->get();

                    $var3 = new UsersDpto();
                    $var3->fill(['rut' => $value->rut, 'departamento_id' => $dpto->first()->id]);
                    $var3->save();


                   
                }
            })->get();
            Session::flash('message', 'Los Alumnos fueron agregados exitosamente!');
           return redirect()->route('administrador.usuario.index');
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
                    $var = new User();
                    $var->fill(['rut' => $value->rut]);
                    $var->save();

                    $var2 = new UsersDpto();
                    $var2->fill(['rut' => $value->rut, 'departamento_id' => $value->departamento]);
                    $var2->save();
                }
            })->get();
            Session::flash('message', 'Los Docentes fueron agregados exitosamente!');
           return redirect()->route('administrador.usuario.index');
    }

}
