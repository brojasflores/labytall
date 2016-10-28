<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use App\User;
use App\RolUsuario;

class adminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $usr=Auth::User()->rut;
        //modelo:: otra tabla que consulto, lo que quiero de la tabla propia = lo de la otra tabla
        $usr2 = User::join('rol_users','users.rut','=','rol_users.rut')
                    ->where('users.rut','=',$usr)
                    ->join('rol','rol_users.rol_id','=','rol.id')
                    ->select('nombre')
                    ->paginate();
        foreach($usr2 as $v)
        {
            $v2[]= $v->nombre;
        } 
        $cont = count($v2);
        for($i=0;$i<$cont;$i++)
        {
            $v1=$v2[$i];
            if($v1=='administrador')
            {
                //return abort(401); 
                return $next($request);
            }
        }
        return abort(401);        
    }   
}
