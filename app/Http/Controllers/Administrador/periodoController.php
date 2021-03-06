<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Periodo;
use Auth;
use App\User;
use Session;


class periodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index()
    {
        $periodos = Periodo::all();
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
            return view ('Administrador/periodos/index', compact('periodos','v2','cont'));
        }
        else
        {
            return view ('Administrador/periodos/index', compact('periodos','cont'));
        }
        //return view ('Administrador/periodos/index', compact('periodos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
            return view ('Administrador/periodos/create', compact('v2','cont'));
        }
        else
        {
            return view ('Administrador/periodos/create', compact('cont'));
        }
        //return view('Administrador/periodos/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                'bloque' => 'required',
                'inicio' => 'required|date_format:H:m',
                'fin' => 'required|date_format:H:m|after:inicio'
                ]);

        $esta1 = Periodo::where('bloque','=',$request->get('bloque')) 
                        ->select('id')
                        ->get();

        $esta2 = Periodo::where('inicio','=',$request->get('inicio')) 
                        ->select('id')
                        ->get();

        $esta3 = Periodo::where('fin','=',$request->get('fin')) 
                        ->select('id')
                        ->get();

        if(!$esta1->isEmpty() || !$esta2->isEmpty() || !$esta2->isEmpty())
        {
            Session::flash('create','¡Período ya se encuentra creado!');
            return redirect()->route('administrador.periodo.index');
        }



        //dd($request);
        $inicio = $request->get('inicio');
        
        $fin = $request->get('fin');

        $porcionesini = explode(":", $inicio);

        $porcionesfin = explode(":", $fin);

        if($porcionesini[0] == '1' || $porcionesini[0] == '2' || $porcionesini[0] == '3'||$porcionesini[0] == '4'||$porcionesini[0] == '5'||$porcionesini[0] == '6'||$porcionesini[0] == '7'||$porcionesini[0] == '8'||$porcionesini[0] == '9')
        {
            $porcionesini[0] = '0' . $porcionesini[0];
        }
        if($porcionesfin[0] == '1' || $porcionesfin[0] == '2' || $porcionesfin[0] == '3'||$porcionesfin[0] == '4'||$porcionesfin[0] == '5'||$porcionesfin[0] == '6'||$porcionesfin[0] == '7'||$porcionesfin[0] == '8'||$porcionesfin[0] == '9')
        {
            $porcionesfin[0] = '0' . $porcionesfin[0];
        }

        if($porcionesini[0] == '01'||$porcionesini[0] == '02'||$porcionesini[0] == '03'||$porcionesini[0] == '04'||$porcionesini[0] == '05'||$porcionesini[0] == '06'||$porcionesini[0] == '07'||$porcionesini[0] == '08'||$porcionesini[0] == '09'||$porcionesini[0] == '10'||$porcionesini[0] == '11'||$porcionesini[0] == '12'||$porcionesini[0] == '13'||$porcionesini[0] == '14'||$porcionesini[0] == '15'||$porcionesini[0] == '16'||$porcionesini[0] == '17'||$porcionesini[0] == '18'||$porcionesini[0] == '19'||$porcionesini[0] == '20'||$porcionesini[0] == '21'||$porcionesini[0] == '22'||$porcionesini[0] == '23')
        {
            if($porcionesini[1]=='00'||$porcionesini[1]=='01'||$porcionesini[1]=='02'||$porcionesini[1]=='03'||$porcionesini[1]=='04'||$porcionesini[1]=='05'||$porcionesini[1]=='06'||$porcionesini[1]=='07'||$porcionesini[1]=='08'||$porcionesini[1]=='09'||$porcionesini[1]=='10'||$porcionesini[1]=='11'||$porcionesini[1]=='12'||$porcionesini[1]=='13'||$porcionesini[1]=='14'||$porcionesini[1]=='15'||$porcionesini[1]=='16'||$porcionesini[1]=='17'||$porcionesini[1]=='18'||$porcionesini[1]=='19'||$porcionesini[1]=='20'||$porcionesini[1]=='21'||$porcionesini[1]=='22'||$porcionesini[1]=='23'||$porcionesini[1]=='24'||$porcionesini[1]=='25'||$porcionesini[1]=='26'||$porcionesini[1]=='27'||$porcionesini[1]=='28'||$porcionesini[1]=='29'||$porcionesini[1]=='30'||$porcionesini[1]=='31'||$porcionesini[1]=='32'||$porcionesini[1]=='33'||$porcionesini[1]=='34'||$porcionesini[1]=='35'||$porcionesini[1]=='36'||$porcionesini[1]=='37'||$porcionesini[1]=='38'||$porcionesini[1]=='39'||$porcionesini[1]=='40'||$porcionesini[1]=='41'||$porcionesini[1]=='42'||$porcionesini[1]=='43'||$porcionesini[1]=='44'||$porcionesini[1]=='45'||$porcionesini[1]=='46'||$porcionesini[1]=='47'||$porcionesini[1]=='48'||$porcionesini[1]=='49'||$porcionesini[1]=='50'||$porcionesini[1]=='51'||$porcionesini[1]=='52'||$porcionesini[1]=='53'||$porcionesini[1]=='54'||$porcionesini[1]=='55'||$porcionesini[1]=='56'||$porcionesini[1]=='57'||$porcionesini[1]=='58'||$porcionesini[1]=='59')
            {
                $si='si';
            }
            else
            {
                $si='no';
            }
        }
        else
        {
            $si='no';
        }

        if($porcionesfin[0] == '01'||$porcionesfin[0] == '02'||$porcionesfin[0] == '03'||$porcionesfin[0] == '04'||$porcionesfin[0] == '05'||$porcionesfin[0] == '06'||$porcionesfin[0] == '07'||$porcionesfin[0] == '08'||$porcionesfin[0] == '09'||$porcionesfin[0] == '10'||$porcionesfin[0] == '11'||$porcionesfin[0] == '12'||$porcionesfin[0] == '13'||$porcionesfin[0] == '14'||$porcionesfin[0] == '15'||$porcionesfin[0] == '16'||$porcionesfin[0] == '17'||$porcionesfin[0] == '18'||$porcionesfin[0] == '19'||$porcionesfin[0] == '20'||$porcionesfin[0] == '21'||$porcionesfin[0] == '22'||$porcionesfin[0] == '23')
        {
            if($porcionesfin[1]=='00'||$porcionesfin[1]=='01'||$porcionesfin[1]=='02'||$porcionesfin[1]=='03'||$porcionesfin[1]=='04'||$porcionesfin[1]=='05'||$porcionesfin[1]=='06'||$porcionesfin[1]=='07'||$porcionesfin[1]=='08'||$porcionesfin[1]=='09'||$porcionesfin[1]=='10'||$porcionesfin[1]=='11'||$porcionesfin[1]=='12'||$porcionesfin[1]=='13'||$porcionesfin[1]=='14'||$porcionesfin[1]=='15'||$porcionesfin[1]=='16'||$porcionesfin[1]=='17'||$porcionesfin[1]=='18'||$porcionesfin[1]=='19'||$porcionesfin[1]=='20'||$porcionesfin[1]=='21'||$porcionesfin[1]=='22'||$porcionesfin[1]=='23'||$porcionesfin[1]=='24'||$porcionesfin[1]=='25'||$porcionesfin[1]=='26'||$porcionesfin[1]=='27'||$porcionesfin[1]=='28'||$porcionesfin[1]=='29'||$porcionesfin[1]=='30'||$porcionesfin[1]=='31'||$porcionesfin[1]=='32'||$porcionesfin[1]=='33'||$porcionesfin[1]=='34'||$porcionesfin[1]=='35'||$porcionesfin[1]=='36'||$porcionesfin[1]=='37'||$porcionesfin[1]=='38'||$porcionesfin[1]=='39'||$porcionesfin[1]=='40'||$porcionesfin[1]=='41'||$porcionesfin[1]=='42'||$porcionesfin[1]=='43'||$porcionesfin[1]=='44'||$porcionesfin[1]=='45'||$porcionesfin[1]=='46'||$porcionesfin[1]=='47'||$porcionesfin[1]=='48'||$porcionesfin[1]=='49'||$porcionesfin[1]=='50'||$porcionesfin[1]=='51'||$porcionesfin[1]=='52'||$porcionesfin[1]=='53'||$porcionesfin[1]=='54'||$porcionesfin[1]=='55'||$porcionesfin[1]=='56'||$porcionesfin[1]=='57'||$porcionesfin[1]=='58'||$porcionesfin[1]=='59')
            {
                $si2='si';
            }
            else
            {
                $si2='no';
            }
        }
        else
        {
            $si2='no';
        }

        if($si=='si' && $si2=='si')
        {
            if($porcionesfin[0]>=$porcionesini[0])
            {
                if($porcionesfin[0]>$porcionesini[0])
                {
                    $fecha = 'ok';
                }
                else
                {
                    if($porcionesfin[1]>$porcionesini[1])
                    {
                        $fecha = 'ok';
                    }
                    else
                    {
                        $fecha = 'nook';
                    }
                }
            }
            else
            {
                $fecha = 'nook';
            }
        }
        else
        {
            $fecha = 'nook';
        }

        if($fecha == 'nook')
        {
            Session::flash('horas','¡Las horas son incorrectas!');
            return redirect()->route('administrador.periodo.create');
        }
        else
        {
            $this->validate($request, [
                'bloque' => 'required',
                'inicio' => 'required|date_format:H:m',
                'fin' => 'required|date_format:H:m|after:inicio'
                ]);

            $periodos = Periodo::create([
                'bloque' => $request->get('bloque'),
                'inicio' => $request->get('inicio'),
                'fin' => $request->get('fin')
                ]);
            
            Session::flash('create','¡Período creado correctamente!');
            return redirect()->route('administrador.periodo.index');
        }
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
        $periodos = Periodo::findOrFail($id);
        $inifin = Periodo::where('id','=',$id)
                          ->select('inicio','fin')
                          ->get();

        $inicio = $inifin->first()->inicio;
        $inicio = substr($inicio,0,-3); 

        $fin = $inifin->first()->fin;
        $fin = substr($fin,0,-3); 
        

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
            return view ('Administrador/periodos/edit', compact('inicio','fin','periodos','v2','cont'));
        }
        else
        {
            return view ('Administrador/periodos/edit', compact('inicio','fin','periodos','cont'));
        }
        //return view('Administrador/periodos/edit', compact('periodos'));
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
        $this->validate($request, [
                'bloque' => 'required',
                'inicio' => 'required|date_format:H:m',
                'fin' => 'required|date_format:H:m|after:inicio'
                ]);
        
        $esta1 = Periodo::where('bloque','=',$request->get('bloque')) 
                        ->where('id','!=',$id)
                        ->select('id')
                        ->get();

        $esta2 = Periodo::where('inicio','=',$request->get('inicio')) 
                        ->where('id','!=',$id)
                        ->select('id')
                        ->get();

        $esta3 = Periodo::where('fin','=',$request->get('fin')) 
                        ->where('id','!=',$id)
                        ->select('id')
                        ->get();

        if(!$esta1->isEmpty() || !$esta2->isEmpty() || !$esta2->isEmpty())
        {
            Session::flash('create','¡Período ya se encuentra creado!');
            return redirect()->route('administrador.periodo.index');
        }


        $inicio = $request->get('inicio');
        
        $fin = $request->get('fin');

        $porcionesini = explode(":", $inicio);

        $porcionesfin = explode(":", $fin);

        if($porcionesini[0] == '1' || $porcionesini[0] == '2' || $porcionesini[0] == '3'||$porcionesini[0] == '4'||$porcionesini[0] == '5'||$porcionesini[0] == '6'||$porcionesini[0] == '7'||$porcionesini[0] == '8'||$porcionesini[0] == '9')
        {
            $porcionesini[0] = '0' . $porcionesini[0];
        }
        if($porcionesfin[0] == '1' || $porcionesfin[0] == '2' || $porcionesfin[0] == '3'||$porcionesfin[0] == '4'||$porcionesfin[0] == '5'||$porcionesfin[0] == '6'||$porcionesfin[0] == '7'||$porcionesfin[0] == '8'||$porcionesfin[0] == '9')
        {
            $porcionesfin[0] = '0' . $porcionesfin[0];
        }

        if($porcionesini[0] == '01'||$porcionesini[0] == '02'||$porcionesini[0] == '03'||$porcionesini[0] == '04'||$porcionesini[0] == '05'||$porcionesini[0] == '06'||$porcionesini[0] == '07'||$porcionesini[0] == '08'||$porcionesini[0] == '09'||$porcionesini[0] == '10'||$porcionesini[0] == '11'||$porcionesini[0] == '12'||$porcionesini[0] == '13'||$porcionesini[0] == '14'||$porcionesini[0] == '15'||$porcionesini[0] == '16'||$porcionesini[0] == '17'||$porcionesini[0] == '18'||$porcionesini[0] == '19'||$porcionesini[0] == '20'||$porcionesini[0] == '21'||$porcionesini[0] == '22'||$porcionesini[0] == '23')
        {
            if($porcionesini[1]=='00'||$porcionesini[1]=='01'||$porcionesini[1]=='02'||$porcionesini[1]=='03'||$porcionesini[1]=='04'||$porcionesini[1]=='05'||$porcionesini[1]=='06'||$porcionesini[1]=='07'||$porcionesini[1]=='08'||$porcionesini[1]=='09'||$porcionesini[1]=='10'||$porcionesini[1]=='11'||$porcionesini[1]=='12'||$porcionesini[1]=='13'||$porcionesini[1]=='14'||$porcionesini[1]=='15'||$porcionesini[1]=='16'||$porcionesini[1]=='17'||$porcionesini[1]=='18'||$porcionesini[1]=='19'||$porcionesini[1]=='20'||$porcionesini[1]=='21'||$porcionesini[1]=='22'||$porcionesini[1]=='23'||$porcionesini[1]=='24'||$porcionesini[1]=='25'||$porcionesini[1]=='26'||$porcionesini[1]=='27'||$porcionesini[1]=='28'||$porcionesini[1]=='29'||$porcionesini[1]=='30'||$porcionesini[1]=='31'||$porcionesini[1]=='32'||$porcionesini[1]=='33'||$porcionesini[1]=='34'||$porcionesini[1]=='35'||$porcionesini[1]=='36'||$porcionesini[1]=='37'||$porcionesini[1]=='38'||$porcionesini[1]=='39'||$porcionesini[1]=='40'||$porcionesini[1]=='41'||$porcionesini[1]=='42'||$porcionesini[1]=='43'||$porcionesini[1]=='44'||$porcionesini[1]=='45'||$porcionesini[1]=='46'||$porcionesini[1]=='47'||$porcionesini[1]=='48'||$porcionesini[1]=='49'||$porcionesini[1]=='50'||$porcionesini[1]=='51'||$porcionesini[1]=='52'||$porcionesini[1]=='53'||$porcionesini[1]=='54'||$porcionesini[1]=='55'||$porcionesini[1]=='56'||$porcionesini[1]=='57'||$porcionesini[1]=='58'||$porcionesini[1]=='59')
            {
                $si='si';
            }
            else
            {
                $si='no';
            }
        }
        else
        {
            $si='no';
        }

        if($porcionesfin[0] == '01'||$porcionesfin[0] == '02'||$porcionesfin[0] == '03'||$porcionesfin[0] == '04'||$porcionesfin[0] == '05'||$porcionesfin[0] == '06'||$porcionesfin[0] == '07'||$porcionesfin[0] == '08'||$porcionesfin[0] == '09'||$porcionesfin[0] == '10'||$porcionesfin[0] == '11'||$porcionesfin[0] == '12'||$porcionesfin[0] == '13'||$porcionesfin[0] == '14'||$porcionesfin[0] == '15'||$porcionesfin[0] == '16'||$porcionesfin[0] == '17'||$porcionesfin[0] == '18'||$porcionesfin[0] == '19'||$porcionesfin[0] == '20'||$porcionesfin[0] == '21'||$porcionesfin[0] == '22'||$porcionesfin[0] == '23')
        {
            if($porcionesfin[1]=='00'||$porcionesfin[1]=='01'||$porcionesfin[1]=='02'||$porcionesfin[1]=='03'||$porcionesfin[1]=='04'||$porcionesfin[1]=='05'||$porcionesfin[1]=='06'||$porcionesfin[1]=='07'||$porcionesfin[1]=='08'||$porcionesfin[1]=='09'||$porcionesfin[1]=='10'||$porcionesfin[1]=='11'||$porcionesfin[1]=='12'||$porcionesfin[1]=='13'||$porcionesfin[1]=='14'||$porcionesfin[1]=='15'||$porcionesfin[1]=='16'||$porcionesfin[1]=='17'||$porcionesfin[1]=='18'||$porcionesfin[1]=='19'||$porcionesfin[1]=='20'||$porcionesfin[1]=='21'||$porcionesfin[1]=='22'||$porcionesfin[1]=='23'||$porcionesfin[1]=='24'||$porcionesfin[1]=='25'||$porcionesfin[1]=='26'||$porcionesfin[1]=='27'||$porcionesfin[1]=='28'||$porcionesfin[1]=='29'||$porcionesfin[1]=='30'||$porcionesfin[1]=='31'||$porcionesfin[1]=='32'||$porcionesfin[1]=='33'||$porcionesfin[1]=='34'||$porcionesfin[1]=='35'||$porcionesfin[1]=='36'||$porcionesfin[1]=='37'||$porcionesfin[1]=='38'||$porcionesfin[1]=='39'||$porcionesfin[1]=='40'||$porcionesfin[1]=='41'||$porcionesfin[1]=='42'||$porcionesfin[1]=='43'||$porcionesfin[1]=='44'||$porcionesfin[1]=='45'||$porcionesfin[1]=='46'||$porcionesfin[1]=='47'||$porcionesfin[1]=='48'||$porcionesfin[1]=='49'||$porcionesfin[1]=='50'||$porcionesfin[1]=='51'||$porcionesfin[1]=='52'||$porcionesfin[1]=='53'||$porcionesfin[1]=='54'||$porcionesfin[1]=='55'||$porcionesfin[1]=='56'||$porcionesfin[1]=='57'||$porcionesfin[1]=='58'||$porcionesfin[1]=='59')
            {
                $si2='si';
            }
            else
            {
                $si2='no';
            }
        }
        else
        {
            $si2='no';
        }

        if($si=='si' && $si2=='si')
        {
            if($porcionesfin[0]>=$porcionesini[0])
            {
                if($porcionesfin[0]>$porcionesini[0])
                {
                    $fecha = 'ok';
                }
                else
                {
                    if($porcionesfin[1]>$porcionesini[1])
                    {
                        $fecha = 'ok';
                    }
                    else
                    {
                        $fecha = 'nook';
                    }
                }
            }
            else
            {
                $fecha = 'nook';
            }
        }
        else
        {
            $fecha = 'nook';
        }

        if($fecha == 'nook')
        {
            Session::flash('horas','¡Las horas son incorrectas, no se pudo editar su período, intente nuevamente!');
            return redirect()->route('administrador.periodo.index');
        }
        else
        {
            $this->validate($request, [
                'bloque' => 'required',
                'inicio' => 'required|date_format:H:m',
                'fin' => 'required|date_format:H:m|after:inicio'
                ]);

            $periodos = Periodo::findOrFail($id);     
            //fill (rellenar)
            $periodos->fill([
                'bloque' => $request->get('bloque'),
                'inicio' => $request->get('inicio'),
                'fin' => $request->get('fin')
            ]);
            $periodos->save();

            Session::flash('edit','¡Período editado correctamente!');
            return redirect()->route('administrador.periodo.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $periodos = Periodo::findOrFail($id);
        $periodos->delete();

        Session::flash('delete','¡Período eliminado correctamente!');
        return redirect()->route('administrador.periodo.index');
    }
}
