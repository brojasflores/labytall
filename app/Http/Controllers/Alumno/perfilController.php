<?php

namespace App\Http\Controllers\Alumno;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Rol;
use App\RolUsuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Validator;
use Auth;
use Session;


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
                            ->paginate();
                // lo de arriba guarda una coleccion donde está el o los nombre(s) de los roles pertenecientes al usuario
                foreach($usr2 as $v)
                {
                    $v2[]= $v->nombre;
                }
                //el foreach recorre la colección y guarda en un array solo los nombres de los roles del usuario 
                $cont = count($v2); //cuenta la cantidad de elementos del array
                
                if($cont>1)
                {
                    return view ('Alumno/usuarios/perfil', compact('var2','v2','cont'));
                }
                else
                {
                    return view ('Alumno/usuarios/perfil', compact('var2','cont'));
                }
            }
            else
            {
                $var2 = true;
                //Cambio de rol
                $usr=Auth::User()->rut;
                //modelo:: otra tabla que consulto, lo que quiero de la tabla propia = lo de la otra tabla
                $usr2 = User::join('rol_users','users.rut','=','rol_users.rut')
                            ->where('users.rut','=',$usr)
                            ->join('rol','rol_users.rol_id','=','rol.id')
                            ->select('nombre')
                            ->paginate();
                // lo de arriba guarda una coleccion donde está el o los nombre(s) de los roles pertenecientes al usuario       

                foreach($usr2 as $p)
                {
                    $v3[] = $p->nombre;
                }
                $v2=$v3;
                //el foreach recorre la colección y guarda en un array solo los nombres de los roles del usuario 
                $cont = count($v2); //cuenta la cantidad de elementos del array

                if($cont>1)
                {
                    return view ('Alumno/usuarios/perfil', compact('var2','v2','cont'));
                }
                else
                {
                    return view ('Alumno/usuarios/perfil', compact('var2','cont'));
                }
            }
        }
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [

            'email' => 'required|email',
            'nombres' => 'required|string',
            'apellidos' => 'required|string'
            ]);

        $var = $request->get('passwordUsuario');
        if(empty ($var))
        {
            $user = new User;
            $user->where('rut', '=', Auth::user()->rut)
                 ->update(['email' => $request->get('email'),
                           'nombres' => $request->get('nombres'),
                           'apellidos' => $request->get('apellidos'),
                         ]);  
        }
        else
        {
            $pass = Hash::make($request->get('passwordUsuario'));
            $user = new User;
            $user->where('rut', '=', Auth::user()->rut)
                 ->update(['email' => $request->get('email'),
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
                Session::flash('create','¡Sus datos de perfil han sido actualizados!');
                return redirect('alumno')->with('status', 'Sus datos de perfil han sido actualizados');
            }
            else
            {
                $name = str_random(30) . '-' . $request->file('image')->getClientOriginalName();
                $request->file('image')->move('perfiles', $name);
                $user = new User;
                $user->where('rut', '=', Auth::user()->rut)
                     ->update(['perfiles' => 'perfiles/'.$name]);
                Session::flash('create','¡Sus datos de perfil han sido actualizados!');
                return redirect('alumno')->with('status', 'Sus datos de perfil han sido actualizados');
            }
        }
    }
}
