<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Usuario;
use App\Rol;
use App\RolUsuario;
//Para el hash de la password
use Illuminate\Support\Facades\Hash;

class usuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //llamo al modelo de bdd a la tabla usuario en app y luego puedo llamar a la tabla...
        $usuarios = Usuario::paginate();
        return view('usuarios/index', compact('usuarios')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Rol::all();
        return view('usuarios/create',compact('roles'));
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
        $pass = Hash::make($request->get('rut')); //Ocupa un bcrypt
      
        Usuario::create([
            'rut' => $request->get('rutUsuario'),
            'email' => $request->get('emailUsuario'),
            'nombres' => $request->get('nombresUsuario'),
            'apellidos' => $request->get('apellidosUsuario'),
            'pass' => $pass
        ]);

        foreach($request->get('roles') as $rol)
        {
            RolUsuario::create([
                'rut' =>$request->get('rutUsuario'),
                'rol_id' => $rol
                ]);
        }
        return redirect()->route('usuario.index');
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

            $usuario = Usuario::findOrFail($request->get('id'));
            $roles = RolUsuario::where('rut',$usuario->rut)->select('rut','rol_id')->get();
            $rolesTotales = Rol::select('id','nombre')->get();

            $respuesta = ['roles' => $rolesTotales, 'roles_usuario' => $roles];
     
            return response()->json($respuesta);
        }
        else{

            $usuario = Usuario::findOrFail($id);
            //en el compact se pasa la variable como string
            return view('usuarios/edit', compact('usuario'));
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
        
        $usuarios = Usuario::findOrFail($id);
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

        return redirect()->route('usuario.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuarios = Usuario::findOrFail($id);
        $usuarios->delete();
        return redirect()->route('usuario.index');
    }
}
