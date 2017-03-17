<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Contracts\Auth\User as UserContract;
use Illuminate\Contracts\Auth\UserProvider as UserProviderInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use GuzzleHttp;
use Illuminate\Auth\GenericUser;
use App\Utils\RutUtils;
use App\User;
use App\Departamento;
use App\Escuela;
use App\UsersCarrera;
use App\UsersDpto;
use App\Rol;
use App\RolUsuario;
use App\Facultad;
use Auth;
use Session;
use App\Carrera;
use Illuminate\Support\Facades\Hash;


class actualizaController extends Controller
{
    protected $rest_base_uri;

    public function __construct()
    {
        $this->rest_base_uri = env('SEPA_REST_BASE_URI', 'https://sepa.utem.cl/rest/api/v1');
        $this->rest_credentials = array(
            env('SEPA_REST_USERNAME', '1111-1'),
            env('SEPA_REST_PASSWORD', '1111-1')
        );
    }


    public function index()
    {
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
            return view('Administrador/index', compact('v2','cont'));
        }
        else
        {
            return view('Administrador/index', compact('cont'));
        }
    }

    public function store()
    {
        $client = new GuzzleHttp\Client(['auth' => $this->rest_credentials]);

        //*****************************FACULTADES*******************************************//
        try {
            $req = $client->get(sprintf('%s/info/facultades', $this->rest_base_uri)); // Hacemos la peticion al WS
        } catch (GuzzleHttp\Exception\ClientException $e) { // Si los errores son del nivel 400, se lanza esta excepcion
            $msg = 'Error al consultar el servicio: %d(%s)';
            \Log::error(sprintf($msg, $e->getResponse()->getStatusCode(), $e->getResponse()->getReasonPhrase()));
        }

        $facultades = json_decode($req->getBody(), true);
        $con = count($facultades);
        //dd($facultades[0]["nombre"]);

        for($i=0; $i<$con; $i++)
        {
           if($facultades[$i]["nombre"] === 'Sin Facultad')
           {
                $v[$i]=0;
                $v2[$i]=0;
           }
           else
           {
                $si = Facultad::where('nombre','=',$facultades[$i]["nombre"])
                              ->select('id')
                              ->get();

                if($si->isEmpty())
                {
                    $v[$i]=$facultades[$i]["nombre"];
                    $v2[$i]=$facultades[$i]["sigla"];
                }
                else
                {
                    $v[$i]=0;
                    $v2[$i]=0;
                }
            }
            
        }
        
        $cont = count($v);

        for($i=0; $i<$cont; $i++)
        {
            if($v[$i]!==0)
            {
               Facultad::create([
                'nombre' => $v[$i],
                'campus_id' => 3,
                'descripcion' => $v2[$i],
                ]);
            }
        }
      
        //*****************************DEPARTAMENTOS*******************************************//
        try {
            $req2 = $client->get(sprintf('%s/info/departamentos', $this->rest_base_uri)); // Hacemos la peticion al WS
        } catch (GuzzleHttp\Exception\ClientException $e2) { // Si los errores son del nivel 400, se lanza esta excepcion
            $msg2 = 'Error al consultar el servicio: %d(%s)';
            \Log::error(sprintf($msg2, $e2->getResponse()->getStatusCode(), $e2->getResponse()->getReasonPhrase()));
        }

        $departamentos = json_decode($req2->getBody(), true);
        //dd($departamentos);
        
        $con = count($departamentos);
        //dd($departamentos[1]["nombre"]);
        //dd($con);
        for($i=0; $i<$con; $i++)
        {
           if($departamentos[$i]["nombre"] === 'Sin Departamento')
           {
                $v3[$i]=0;
                $v4[$i]=0;
           }
           else
           {
                $si = Departamento::where('nombre','=',$departamentos[$i]["nombre"])
                              ->select('id')
                              ->get();
                
                if($si->isEmpty())
                {
                    $v3[$i]=$departamentos[$i]["nombre"];
                    $si2 = Facultad::where('nombre','=',$departamentos[$i]["facultad"])
                                   ->select('id')
                                   ->get();

                    $v4[$i]=$si2->first()->id;
                }
                else
                {
                    $v3[$i]=0;
                    $v4[$i]=0;
                }
            } 
        }

        $cont = count($v3);

        for($i=1; $i<$cont; $i++)
        {
            if($v3[$i]!==0)
            {
               Departamento::create([
                'nombre' => $v3[$i],
                'facultad_id' => $v4[$i],
                'descripcion' => $v3[$i],
                ]);  
            }
        }
    //*****************************ESCUELAS*******************************************//
        try {
            $req3 = $client->get(sprintf('%s/info/escuelas', $this->rest_base_uri)); // Hacemos la peticion al WS
        } catch (GuzzleHttp\Exception\ClientException $e3) { // Si los errores son del nivel 400, se lanza esta excepcion
            $msg3 = 'Error al consultar el servicio: %d(%s)';
            \Log::error(sprintf($msg3, $e3->getResponse()->getStatusCode(), $e3->getResponse()->getReasonPhrase()));
        }

        $escuelas = json_decode($req3->getBody(), true);
        //dd($escuelas);
        
        $con = count($escuelas);
        //dd($escuelas[1]["nombre"]);
        //dd($con);
        for($i=0; $i<$con; $i++)
        {
           if($escuelas[$i]["nombre"] === 'Sin Escuela')
           {
                $v5[$i]=0;
                $v6[$i]=0;
           }
           else
           { 
                $si = Escuela::where('nombre','=',$escuelas[$i]["nombre"])
                              ->select('id')
                              ->get();
                
                if($si->isEmpty())
                {
                    $v5[$i]=$escuelas[$i]["nombre"];
                    $si2 = Departamento::where('nombre','=',$escuelas[$i]["departamento"])
                                   ->select('id')
                                   ->get();

                    $v6[$i]=$si2->first()->id;
                }
                else
                {
                    $v5[$i]=0;
                    $v6[$i]=0;
                }
            }            
        }

        $cont = count($v5);
        //dd($cont);
        for($i=0; $i<$cont; $i++)
        {
            if($v5[$i]!==0)
            {
               Escuela::create([
                'nombre' => $v5[$i],
                'departamento_id' => $v6[$i],
                'descripcion' => $v5[$i],
                ]);  
            }
        }

        //*****************************CARRERAS*******************************************//
        try {
            $req4 = $client->get(sprintf('%s/info/carreras', $this->rest_base_uri)); // Hacemos la peticion al WS
        } catch (GuzzleHttp\Exception\ClientException $e4) { // Si los errores son del nivel 400, se lanza esta excepcion
            $msg4 = 'Error al consultar el servicio: %d(%s)';
            \Log::error(sprintf($msg4, $e4->getResponse()->getStatusCode(), $e4->getResponse()->getReasonPhrase()));
        }

        $carreras = json_decode($req4->getBody(), true);
        //dd($carreras);
        
        $con = count($carreras);
        //dd($carreras[1]["nombre"]);
        //dd($con);
        for($i=0; $i<$con; $i++)
        {
           if($carreras[$i]["escuela"] === 'Sin Escuela')
           {
                    $v7[$i]=0;
                    $v8[$i]=0;
                    $v9[$i]=0;
           }
           else
           {
                $si = Carrera::where('codigo','=',$carreras[$i]["codigo"])
                              ->select('id')
                              ->get();
                
                if($si->isEmpty())
                {
                    $v7[$i]=$carreras[$i]["nombre"];//nombre
                    $si2 = Escuela::where('nombre','=',$carreras[$i]["escuela"])
                                   ->select('id')
                                   ->get();

                    $v8[$i]=$si2->first()->id;//codigo escuela
                    $v9[$i]=$carreras[$i]["codigo"];//codigo carrera
                }
                else
                {
                    $v7[$i]=0;
                    $v8[$i]=0;
                    $v9[$i]=0;
                }
            }
        }

        $cont = count($v7);
        //dd($cont);
        //dd($v7);
        for($i=0; $i<$cont; $i++)
        {
            if($v7[$i]!==0)
            {
               Carrera::create([
                'escuela_id' => $v8[$i],
                'codigo' => $v9[$i],
                'nombre' => $v7[$i],
                'descripcion' => $v7[$i],
                ]);  
            }
        }
        Session::flash('create','¡Base de datos actualizada!');
        return redirect()->route('administrador.actualiza.index');
    }
}
