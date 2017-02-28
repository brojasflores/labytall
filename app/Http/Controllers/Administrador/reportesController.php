<?php

namespace App\Http\Controllers\Administrador;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Asignatura;
use App\Curso;
use App\Horario;
use App\Periodo;
use App\Rol;
use App\RolUsuario;
use App\Sala;
use App\Usuario;
use Auth;
use App\User;
use DB;
use Session;
use Carbon\Carbon;

class reportesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function RepUsr(Request $request)
    {
        if($request->ajax())
        {
            $condicion = "0 = 0"; 
            $laboratorio = $request->lab;

            if($request->get('fecha_inicio') != '' && $request->get('fecha_termino') != '')
            {                
                $fecha_ini_separada = explode("/",$request->get('fecha_inicio'));
                $fecha_ini_formateada = $fecha_ini_separada[2]."-".$fecha_ini_separada[1]."-".$fecha_ini_separada[0]; 
                $fecha_term_separada = explode("/",$request->get('fecha_termino'));
                $fecha_term_formateada = $fecha_term_separada[2]."-".$fecha_term_separada[1]."-".$fecha_term_separada[0];
                $condicion .= " and a.fecha between to_date('".$fecha_ini_formateada."','YYYY-MM-DD') and to_date('".$fecha_term_formateada."','YYYY-MM-DD')";  

                $inicio = new Carbon($fecha_ini_formateada);
                $termino = new Carbon($fecha_term_formateada); 

                if($inicio>$termino)
                {
                    $arrayName = array('isError' => 'true',
                                        'message' => 'Fecha inicio debe ser menor a la de termino');
                    return response()->json($arrayName);
                }              
            }


            //Cantidad de doc y ayu en cierto lab por una fecha específica
            if($request->get('tipo') == 'normal')
            {
                $horario = DB::select("select c.nombre, count(a.id) as cantidad
                                        from horario a
                                        inner join sala c on a.sala_id = c.id
                                        where ".$condicion."
                                        group by c.nombre 
                                        order by cantidad desc");                
            }

            //Cantidad de alum en cierto lab por una fecha específica
            if($request->get('tipo') == 'alumno')
            {
                $horario = DB::select("select c.nombre, count(a.id) as cantidad
                                        from horario_alum a
                                        inner join sala c on a.sala_id = c.id
                                        where ".$condicion."
                                        group by c.nombre 
                                        order by cantidad desc");
            }

            //doc y ayu (top 5) que más asisten a los lab
            if($request->get('tipo') == 'masasistenormal')
            {
                $horario = DB::select("select c.nombres nombre, count(a.id) as cantidad
                                        from horario a
                                        inner join users c on a.rut = c.rut
                                        where a.sala_id = ".$laboratorio."
                                        and a.asistencia = 'si'
                                        and ".$condicion."
                                        group by c.nombres
                                        order by cantidad desc
                                        limit 5 offset 0");
            }

            //alum (top 5) que más asisten a los lab
            if($request->get('tipo') == 'masasistealum')
            {
                $horario = DB::select("select c.nombres nombre, count(a.id) as cantidad
                                        from horario_alum a
                                        inner join users c on a.rut = c.rut
                                        where a.sala_id = ".$laboratorio."
                                        and a.asistencia = 'si'
                                        and ".$condicion."
                                        group by c.nombres
                                        order by cantidad desc
                                        limit 5 offset 0");
            }

            //doc y ayu que más faltan
            if($request->get('tipo') == 'masfaltannormal')
            {
                $horario = DB::select("select c.nombres nombre, count(a.id) as cantidad
                                        from horario a
                                        inner join users c on a.rut = c.rut
                                        where a.sala_id = ".$laboratorio."
                                        and a.asistencia = 'no'
                                        and ".$condicion."
                                        group by c.nombres 
                                        order by cantidad desc
                                        limit 5 offset 0");
            }  

            //alum que más faltan
            if($request->get('tipo') == 'masfaltanalum')
            {
                $horario = DB::select("select c.nombres nombre, count(a.id) as cantidad
                                        from horario_alum a
                                        inner join users c on a.rut = c.rut
                                        where a.sala_id = ".$laboratorio."
                                        and a.asistencia = 'no'
                                        and ".$condicion."
                                        group by c.nombres 
                                        order by cantidad desc
                                        limit 5 offset 0");
            }     

            //Cantidad de doc y ayu asistentes en cierto periodo
            if($request->get('tipo') == 'asistpernor')
            {
                $horario = DB::select("select c.bloque nombre, count(a.id) as cantidad
                                        from horario a
                                        inner join periodo c on a.periodo_id = c.id
                                        where a.asistencia = 'si'
                                        and ".$condicion."
                                        group by c.bloque 
                                        order by cantidad desc
                                        limit 5 offset 0");
            }  

            //Cantidad de alum asistentes en cierto periodo
            if($request->get('tipo') == 'asistperayu')
            {
                $horario = DB::select("select c.bloque nombre, count(a.id) as cantidad
                                        from horario_alum a
                                        inner join periodo c on a.periodo_id = c.id
                                        where a.asistencia = 'si'
                                        and ".$condicion."
                                        group by c.bloque 
                                        order by cantidad desc
                                        limit 5 offset 0");
            } 

            //Cantidad de doc y ayu inasistentes en cierto periodo
            if($request->get('tipo') == 'inasistpernor')
            {
                $horario = DB::select("select c.bloque nombre, count(a.id) as cantidad
                                        from horario a
                                        inner join periodo c on a.periodo_id = c.id
                                        where a.asistencia = 'no'
                                        and ".$condicion."
                                        group by c.bloque 
                                        order by cantidad desc
                                        limit 5 offset 0");
            }  

            //Cantidad de alum inasistentes en cierto periodo
            if($request->get('tipo') == 'inasistperayu')
            {
                $horario = DB::select("select c.bloque nombre, count(a.id) as cantidad
                                        from horario_alum a
                                        inner join periodo c on a.periodo_id = c.id
                                        where a.asistencia = 'no'
                                        and ".$condicion."
                                        group by c.bloque 
                                        order by cantidad desc
                                        limit 5 offset 0");
            }  

            $arreglo = [];

            foreach ($horario as $key => $value) {
                $arreglo[] = [$value->nombre,$value->cantidad];
            }


            return response()->json($arreglo);
        }

        $sala = Sala::all();
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
            return view ('Administrador/graficas/RepUsr',compact('sala','v2','cont'));
        }
        else
        {
            return view ('Administrador/graficas/RepUsr',compact('sala','cont'));
        }

    }


    public function RepSa(Request $request)
    {
        if($request->ajax())
        {
            $condicion = "0 = 0"; 
            $laboratorio = $request->lab;

            if($request->get('fecha_inicio') != '' && $request->get('fecha_termino') != '')
            {
                $fecha_ini_separada = explode("/",$request->get('fecha_inicio'));
                $fecha_ini_formateada = $fecha_ini_separada[2]."-".$fecha_ini_separada[1]."-".$fecha_ini_separada[0]; 
                $fecha_term_separada = explode("/",$request->get('fecha_termino'));
                $fecha_term_formateada = $fecha_term_separada[2]."-".$fecha_term_separada[1]."-".$fecha_term_separada[0];
                $condicion .= " and a.fecha between to_date('".$fecha_ini_formateada."','YYYY-MM-DD') and to_date('".$fecha_term_formateada."','YYYY-MM-DD')"; 

                $inicio = new Carbon($fecha_ini_formateada);
                $termino = new Carbon($fecha_term_formateada); 

                if($inicio>$termino)
                {
                    $arrayName = array('isError' => 'true',
                                        'message' => 'Fecha inicio debe ser menor a la de termino');
                    return response()->json($arrayName);
                }                   
            }


            //Carrera que más usa los lab (hay que recibir una asignatura)
            if($request->get('tipo') == 'carrera')
            {
                $horario = DB::select("select b.nombre, count(a.id) as cantidad
                                        from horario a
                                        inner join curso c on a.curso_id = c.id
                                        inner join asignatura d on c.asignatura_id = d.id
                                        inner join carrera b on d.carrera_id = b.id
                                        where a.asistencia = 'si'
                                        and ".$condicion."
                                        group by b.nombre
                                        order by cantidad desc
                                        limit 5 offset 0 ");                                     
            }

            //Periodo en que más se usa un lab doc y ayud
            if($request->get('tipo') == 'maslabperinor')
            {
                $horario = DB::select("select c.bloque nombre, count(a.id) as cantidad
                                        from horario a
                                        inner join periodo c on a.periodo_id = c.id
                                        where a.asistencia = 'si'
                                        and ".$condicion."
                                        group by c.bloque 
                                        order by cantidad desc
                                        limit 5 offset 0 ");                                     
            }

            //Periodo en que más se usa un lab alum
            if($request->get('tipo') == 'maslabperialum')
            {
                $horario = DB::select("select c.bloque nombre, count(a.id) as cantidad
                                        from horario_alum a
                                        inner join periodo c on a.periodo_id = c.id
                                        where a.asistencia = 'si'
                                        and ".$condicion."
                                        group by c.bloque 
                                        order by cantidad
                                        limit 5 offset 0");                                     
            }

            //Periodo en que menos se usa un lab doc y ayud
            if($request->get('tipo') == 'menlabperinor')
            {
                $horario = DB::select("select c.bloque nombre, count(a.id) as cantidad
                                        from horario a
                                        inner join periodo c on a.periodo_id = c.id
                                        where a.asistencia = 'no'
                                        and ".$condicion."
                                        group by c.bloque 
                                        order by cantidad desc
                                        limit 5 offset 0 ");                                     
            }

            //Periodo en que menos se usa un lab alum
            if($request->get('tipo') == 'menlabperialum')
            {
                $horario = DB::select("select c.bloque nombre, count(a.id) as cantidad
                                        from horario_alum a
                                        inner join periodo c on a.periodo_id = c.id
                                        where a.asistencia = 'no'
                                        and ".$condicion."
                                        group by c.bloque 
                                        order by cantidad
                                        limit 5 offset 0");                                     
            }

            //Usabilidad de lab (sala más usada Doc y ayud)
            if($request->get('tipo') == 'masusnor')
            {
                $horario = DB::select("select c.nombre, count(a.id) as cantidad
                                        from horario a
                                        inner join sala c on a.sala_id = c.id
                                        where a.asistencia = 'si'
                                        and ".$condicion."
                                        group by c.nombre
                                        order by cantidad
                                        limit 5 offset 0");                                     
            }

            //Usabilidad de lab (sala menos usada Doc y ayud)
            if($request->get('tipo') == 'menusnor')
            {
                $horario = DB::select("select c.nombre, count(a.id) as cantidad
                                        from horario a
                                        inner join sala c on a.sala_id = c.id
                                        where a.asistencia = 'no'
                                        and ".$condicion."
                                        group by c.nombre
                                        order by cantidad
                                        limit 5 offset 0");                                     
            }

            //Usabilidad de lab (sala más usada alum)
            if($request->get('tipo') == 'masusalum')
            {
                $horario = DB::select("select c.nombre, count(a.id) as cantidad
                                        from horario_alum a
                                        inner join sala c on a.sala_id = c.id
                                        where a.asistencia = 'si'
                                        and ".$condicion."
                                        group by c.nombre
                                        order by cantidad
                                        limit 5 offset 0");                                     
            }

            //Usabilidad de lab (sala menos usada alum)
            if($request->get('tipo') == 'menusalum')
            {
                $horario = DB::select("select c.nombre, count(a.id) as cantidad
                                        from horario_alum a
                                        inner join sala c on a.sala_id = c.id
                                        where a.asistencia = 'no'
                                        and ".$condicion."
                                        group by c.nombre
                                        order by cantidad
                                        limit 5 offset 0");                                     
            }


            $arreglo = [];

            foreach ($horario as $key => $value) {
                $arreglo[] = [$value->nombre,$value->cantidad];
            }


            return response()->json($arreglo);
        }

        $sala = Sala::all();
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
            return view ('Administrador/graficas/RepSa',compact('sala','v2','cont'));
        }
        else
        {
            return view ('Administrador/graficas/RepSa',compact('sala','cont'));
        }

    }



    public function RepAsig(Request $request)
    {
        if($request->ajax())
        {
            $arreglo = array('data' => [],'error' => array('isError' => false, 'mensaje' => ''));

            //VAIDA RUT
            $largo = strlen($request->get('rut'));
            $alum = "alumno";

            if($largo>9 || $largo<8)
            {
                $arreglo['error'] = array('isError' => true ,'mensaje' => 'El largo del rut ingresado es inválido');                    

            }
            $rut = preg_replace('/[^k0-9]/i', '', $request->get('rut'));
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

            if($ok=='no')
            {
                $arreglo['error'] = array('isError' => true ,'mensaje' => 'El rut ingresado es inválido');
            }
            else
            {
                $esta = User::join('rol_users','rol_users.rut','=','users.rut')
                            ->join('rol','rol_users.rol_id','=','rol.id')
                            ->where('users.rut','=',$numero)
                            ->where('rol.nombre','=',$alum)
                            ->select('users.id')
                            ->get();
            }

            if($esta->isEmpty())
            {
                //decir que el rut no corresponde a un alumno
                $arreglo['error'] = array('isError' => true,'mensaje' => 'El rut no se encuentra en los registros'); 
            } 
            ////////////////////////////////////////////////////////////////////////////////

            $condicion = "0 = 0"; 
            $asignatura = $request->asig;
            $ru = $numero;

            if($request->get('fecha_inicio') != '' && $request->get('fecha_termino') != '')
            {
                $fecha_ini_separada = explode("/",$request->get('fecha_inicio'));
                $fecha_ini_formateada = $fecha_ini_separada[2]."-".$fecha_ini_separada[1]."-".$fecha_ini_separada[0]; 
                $fecha_term_separada = explode("/",$request->get('fecha_termino'));
                $fecha_term_formateada = $fecha_term_separada[2]."-".$fecha_term_separada[1]."-".$fecha_term_separada[0];
                $condicion .= " and a.fecha between to_date('".$fecha_ini_formateada."','YYYY-MM-DD') and to_date('".$fecha_term_formateada."','YYYY-MM-DD')";

                $inicio = new Carbon($fecha_ini_formateada);
                $termino = new Carbon($fecha_term_formateada); 

                if($inicio>$termino)
                {
                    $arreglo['error'] = array('isError' => true,'mensaje' => 'La fecha de inicio no puede ser mayor que la fecha fin'); 
                }                 
            }

            //Usabilidad de sala por asignatura
            if($request->get('tipo') == 'asignatura')
            {
                $horario = DB::select("select d.nombre, count(a.id) as cantidad
                                        from horario a
                                        inner join curso c on a.curso_id = c.id
                                        inner join asignatura d on c.asignatura_id = d.id
                                        where a.asistencia = 'si'
                                        group by d.nombre
                                        order by cantidad
                                        limit 5 offset 0");                                     
            }

            //Usabilidad de sala por curso (hay que ingresar la asignatura que se quieren saber sus cursos)
            if($request->get('tipo') == 'asigCur')
            {
                $asign = $asignatura = "" ? "" : $asignatura;
                $horario = DB::select("select c.seccion nombre, count(a.id) as cantidad
                                        from horario a
                                        inner join curso c on a.curso_id = c.id
                                        inner join asignatura d on c.asignatura_id = d.id
                                        where a.asistencia = 'si'
                                        and d.id = ".$asign."
                                        group by c.seccion
                                        order by cantidad
                                        limit 5 offset 0");                                     
            }
            
             //Usabilidad de salas por alumno
            if($request->get('tipo') == 'salAlum')
            {
                $horario = DB::select("select d.nombre, count(a.id) as cantidad
                                        from horario_alum a
                                        inner join users c on a.rut = c.rut
                                        inner join sala d on a.sala_id = d.id
                                        where a.asistencia = 'si'
                                        and a.rut = '".$numero."'
                                        group by d.nombre
                                        order by cantidad desc");                                     
            }
            //$arreglo = [];

            foreach ($horario as $key => $value) {
                $arreglo['data'][0] = [$value->nombre,$value->cantidad];
            }


            return response()->json($arreglo);
        }

        $asignatura = Asignatura::all();
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
            return view ('Administrador/graficas/RepAsig',compact('asignatura','v2','cont'));
        }
        else
        {
            return view ('Administrador/graficas/RepAsig',compact('asignatura','cont'));
        }

    }


    public function RepFall(Request $request)
    {
        if($request->ajax())
        {
            $condicion = "0 = 0"; 
            $laboratorio = $request->lab;

            if($request->get('fecha_inicio') != '' && $request->get('fecha_termino') != '')
            {
                $fecha_ini_separada = explode("/",$request->get('fecha_inicio'));
                $fecha_ini_formateada = $fecha_ini_separada[2]."-".$fecha_ini_separada[1]."-".$fecha_ini_separada[0]; 
                $fecha_term_separada = explode("/",$request->get('fecha_termino'));
                $fecha_term_formateada = $fecha_term_separada[2]."-".$fecha_term_separada[1]."-".$fecha_term_separada[0];
                $condicion .= " and a.fecha between to_date('".$fecha_ini_formateada."','YYYY-MM-DD') and to_date('".$fecha_term_formateada."','YYYY-MM-DD')";  

                $inicio = new Carbon($fecha_ini_formateada);
                $termino = new Carbon($fecha_term_formateada); 

                if($inicio>$termino)
                {
                    $arrayName = array('isError' => 'true',
                                        'message' => 'Fecha inicio debe ser menor a la de termino');
                    return response()->json($arrayName);
                }                  
            }

            //Cantidad de estaciones de trabajo dañadas por lab
            if($request->get('tipo') == 'estdaña')
            {
                $horario = DB::select("select c.nombre, count(a.id) as cantidad
                                        from estacion_trabajo a
                                        inner join sala c on a.sala_id = c.id
                                        where a.disponibilidad = 'no'
                                        and a.periodo_id = 1
                                        group by c.nombre
                                        order by cantidad desc");    

                $arreglo = [];

                foreach ($horario as $key => $value) {
                    $arreglo[] = [$value->nombre,$value->cantidad];
                }                                  
            }  

             

            //Cantidad de estaciones de trabajo dañadas por lab
            if($request->get('tipo') == 'dañadas')
            {
                //como mandar esto para la vista y hacer una ventanita que me muestre, segun el lab seleccionado, sus estaciones dañadas
                $dañados = DB::select("select a.nombre estacion
                                        from estacion_trabajo a
                                        inner join sala c on a.sala_id = c.id
                                        where a.disponibilidad = 'no'
                                        and a.periodo_id = 1
                                        and c.id = ".$laboratorio."
                                        order by estacion desc");

                $arreglo = [];

                foreach ($dañados as $key => $value) {
                    $arreglo[] = [$value->estacion];
                }                                
            }  
           


            return response()->json($arreglo);
        }

        $sala = Sala::all();

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
            return view ('Administrador/graficas/RepFall',compact('sala','v2','cont'));
        }
        else
        {
            return view ('Administrador/graficas/RepFall',compact('sala','cont'));
        }

    }
}
