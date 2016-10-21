<?php

namespace App\Http\Controllers\Administrador;

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
                return view('Administrador/usuarios/perfil', compact('var2'));
            }
            else
            {
                $var2 = true;
            }
        }
        return view('Administrador/usuarios/perfil', compact('var2'));
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
