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
    public function index(Request $request)
    {
        if($request->ajax())
        {

            $condicion = "0 = 0"; 

            if($request->get('fecha_inicio') != '' && $request->get('fecha_termino') != '')
            {
                $fecha_ini_separada = explode("/",$request->get('fecha_inicio'));
                $fecha_ini_formateada = $fecha_ini_separada[2]."-".$fecha_ini_separada[1]."-".$fecha_ini_separada[0]; 
                $fecha_term_separada = explode("/",$request->get('fecha_termino'));
                $fecha_term_formateada = $fecha_term_separada[2]."-".$fecha_term_separada[1]."-".$fecha_term_separada[0];
                $condicion .= " and a.fecha between to_date('".$fecha_ini_formateada."','YYYY-MM-DD') and to_date('".$fecha_term_formateada."','YYYY-MM-DD')";                   
            }


            if($request->get('tipo') == 'normal')
            {
                $horario = DB::select("select c.nombre, count(a.id) as cantidad
                                        from horario a
                                        inner join sala c on a.sala_id = c.id
                                        where ".$condicion."
                                        group by c.nombre 
                                        order by cantidad desc");                
            }

            if($request->get('tipo') == 'alumno')
            {
                $horario = DB::select("select c.nombre, count(a.id) as cantidad
                                        from horario_alum a
                                        inner join sala c on a.sala_id = c.id
                                        where ".$condicion."
                                        group by c.nombre 
                                        order by cantidad desc");
            }

            $arreglo = [];

            foreach ($horario as $key => $value) {
                $arreglo[] = [$value->nombre,$value->cantidad];
            }

            return response()->json($arreglo);
        }

        
        //dd('pablo');

        $periodos = Periodo::select('id','bloque')->orderBy('bloque','asc')->get();


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
            return view ('Administrador/graficas/index',compact('periodos','v2','cont'));
        }
        else
        {
            return view ('Administrador/graficas/index',compact('periodos','cont'));
        }

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

    /*public function invoice() 
    {

        $periodos = Periodo::select('id','bloque')->orderBy('bloque','asc')->get();

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
            $view =  \View::make('Administrador/graficas/index',compact('periodos','v2','cont'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            //return $pdf->stream('invoice');
            //$pdf = PDF::loadView($view);
            return $pdf->download('reporte1.pdf');
            //return view ('Administrador/graficas/index',compact('periodos','v2','cont'));
        }
        else
        {
            $view =  \View::make('Administrador/graficas/index',compact('periodos','cont'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            //return $pdf->stream('invoice');
            //$pdf = PDF::loadView($view);
            return $pdf->download('reporte1.pdf');
        }
    }*/
}
