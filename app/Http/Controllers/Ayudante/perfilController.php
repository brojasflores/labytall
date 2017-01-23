<?php

namespace App\Http\Controllers\Ayudante;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\User;
use App\Rol;
use App\RolUsuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Validator;
use Auth;


class perfilController extends Controller
{
    public function perfil()
    {
        $var=User::where('rut','=', Auth::user()->rut)->select('password')->get();
        $var2 = false;
        foreach($var as $v)
        {
            $v2= $v->password;
            if($v2==null)
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
                    return view('Ayudante/usuarios/perfil', compact('var2','v2','cont'));
                }
                else
                {
                    return view('Ayudante/usuarios/perfil', compact('var2','cont'));
                }
                //return view('Ayudante/usuarios/perfil', compact('var2'));
            }
            else
            {
                $var2 = true;
            }
        }
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
            return view('Ayudante/usuarios/perfil', compact('var2','v2','cont'));
        }
        else
        {
            return view('Ayudante/usuarios/perfil', compact('var2','cont'));
        }
        //return view('Ayudante/usuarios/perfil', compact('var2'));
    }

    public function updateProfile(Request $request)
    {
        $var = $request->get('passwordUsuario');
        if(empty ($var))
        {
            $user = new User;
            $user->where('rut', '=', Auth::user()->rut)
                 ->update(['email' => $request->get('emailUsuario'),
                           'nombres' => $request->get('nombres'),
                           'apellidos' => $request->get('apellidos'),
                         ]);  
        }
        else
        {
            $pass = Hash::make($request->get('passwordUsuario'));
            $user = new User;
            $user->where('rut', '=', Auth::user()->rut)
                 ->update(['email' => $request->get('emailUsuario'),
                           'nombres' => $request->get('nombres'),
                           'apellidos' => $request->get('apellidos'),
                           'password' => $pass,
                         ]);   
        }

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
}
