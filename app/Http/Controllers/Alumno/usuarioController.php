<?php

namespace App\Http\Controllers\Alumno;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\User;
use App\Rol;
use App\RolUsuario;
//Para el hash de la password
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Validator;
use Auth;

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
        $this->middleware('docente');
    }
    
    public function index()
    {
        //llamo al modelo de bdd a la tabla usuario en app y luego puedo llamar a la tabla...
        $usuarios = User::paginate();
        return view('Alumno/usuarios/index', compact('usuarios')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Rol::all();
        return view('Alumno/usuarios/create',compact('roles'));
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
            'password' => $pass
        ]);

        foreach($request->get('roles') as $rol)
        {
            RolUsuario::create([
                'rut' =>$request->get('rutUsuario'),
                'rol_id' => $rol
                ]);
        }
        return redirect()->route('alumno.usuario.index');
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
            //en el compact se pasa la variable como string
            return view('Alumno/usuarios/edit', compact('usuario'));
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

        return redirect()->route('alumno.usuario.index');
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
        return redirect()->route('alumno.usuario.index');
    }

    public function perfil()
    {
        return view('Alumno/usuarios/perfil');
    }

    public function updateProfile(Request $request)
    {


        $user = new User;
        $user->where('rut', '=', Auth::user()->rut)
             ->update(['email' => $request->get('emailUsuario'),
                       'nombres' => $request->get('nombres'),
                       'apellidos' => $request->get('apellidos'),
                     ]);  

        $file = Input::file('image');

        $rules = ['image' => 'image|max:1024*1024*1'];
        $messages = [
            'image.image' => 'Formato no permitido',
            'image.max' => 'El máximo permitido es 1 MB'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()){
            return redirect('usuario_perfil')->withErrors($validator);
        }
        else{
            if(!$file)
            {
                return redirect('home')->with('status', 'Sus datos de perfil han sido actualizados');
            }
            else
            {
                $name = str_random(30) . '-' . $request->file('image')->getClientOriginalName();
                $request->file('image')->move('perfiles', $name);
                $user = new User;
                $user->where('rut', '=', Auth::user()->rut)
                     ->update(['perfiles' => 'perfiles/'.$name]);
                return redirect('home')->with('status', 'Sus datos de perfil han sido actualizados');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update2(Request $request)
    {
        dd($request);
        $usuarios = User::findOrFail($request->get('id'));
        //fill (rellenar)
        $usuarios->fill([
            'email' => $request->get('emailUsuario'),
            'pass' => $request->get('pass')
        ]);
        $usuarios->save();
    
        return view('index');
    }

    
}
