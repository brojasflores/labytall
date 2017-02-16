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
//condicion
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
}
