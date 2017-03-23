<?php

namespace App\Http\Controllers\Director;

use Illuminate\Contracts\Auth\User as UserContract;
use Illuminate\Contracts\Auth\UserProvider as UserProviderInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use GuzzleHttp;
use Illuminate\Auth\GenericUser;
use App\Utils\RutUtils;
use App\User;
use App\Campus;
use App\Carrera;
use App\Curso;
use App\Estacion_trabajo;
use App\Horario;
use App\Horario_Alumno;
use App\Periodo;
use App\Sala;
use App\Departamento;
use App\Escuela;
use App\UsersCarrera;
use App\Asignatura;
use App\UsersDpto;
use App\Rol;
use App\RolUsuario;
use App\Facultad;
use Auth;
use Session;
use Illuminate\Support\Facades\Hash;


class descargaController extends Controller
{
    protected $rest_base_uri;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
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
            return view('Director/index', compact('v2','cont'));
        }
        else
        {
            return view('Director/index', compact('cont'));
        }
    }

    public function excel_download()
    {
        $usr =Auth::User()->rut;
        $dpto = UsersDpto::where('rut','=',$usr)
                        ->select('departamento_id')
                        ->get();

        $var = Asignatura::join('carrera','asignatura.carrera_id','=','carrera.id')
                        ->join('escuela','escuela.id','=','carrera.escuela_id')
                        ->join('departamento','departamento.id','=','escuela.departamento_id')
                        ->where('departamento.id',$dpto->first()->departamento_id)
                        ->select('asignatura.*','carrera.nombre as nom')
                        ->get();

        $carreras = Carrera::join('escuela','carrera.escuela_id','=','escuela.id')
                        ->join('departamento','departamento.id','=','escuela.departamento_id')
                        ->where('departamento_id','=',$dpto->first()->departamento_id)
                        ->select('carrera.*','escuela.nombre as nom')
                        ->get();

        $curso = Curso::join('asignatura','curso.asignatura_id','=','asignatura.id')
                       ->join('carrera','carrera.id','=','asignatura.carrera_id')
                       ->join('escuela','escuela.id','=','carrera.escuela_id')
                       ->join('departamento','departamento.id','=','escuela.departamento_id')
                       ->where('departamento.id',$dpto->first()->departamento_id)
                       ->select('curso.*','asignatura.nombre as nom')
                       ->get();

        $estacion = Estacion_trabajo::join('sala','estacion_trabajo.sala_id','=','sala.id')
                                      ->join('periodo','estacion_trabajo.periodo_id','=','periodo.id')
                                      ->where('sala.departamento_id','=',$dpto->first()->departamento_id)
                                      ->select('estacion_trabajo.*','sala.nombre as sala','periodo.bloque as periodo')
                                      ->get();
        
        $doc = 'docente';
        $ayu = 'ayudante';
        $horarioD = Horario::join('curso','horario.curso_id','=','curso.id')
                            ->join('asignatura','curso.asignatura_id','=','asignatura.id')
                            ->join('periodo','horario.periodo_id','=','periodo.id')
                            ->join('sala','horario.sala_id','=','sala.id')
                            ->join('departamento','departamento.id','=','sala.departamento_id')
                            ->join('users','horario.rut','=','users.rut')
                            ->where('departamento.id',$dpto->first()->departamento_id)
                            ->where('tipo_reserva','=',$doc)
                            ->select('horario.*','sala.nombre as sala','periodo.bloque as periodo','curso.seccion as curso')
                            ->get();

        $horarioA = Horario::join('curso','horario.curso_id','=','curso.id')
                            ->join('asignatura','curso.asignatura_id','=','asignatura.id')
                            ->join('periodo','horario.periodo_id','=','periodo.id')
                            ->join('sala','horario.sala_id','=','sala.id')
                            ->join('departamento','departamento.id','=','sala.departamento_id')
                            ->join('users','horario.rut','=','users.rut')
                            ->where('departamento.id',$dpto->first()->departamento_id)
                            ->where('tipo_reserva','=',$ayu)
                            ->select('horario.*','sala.nombre as sala','periodo.bloque as periodo','curso.seccion as curso')
                            ->get();

        $horalum = Horario_Alumno::join('periodo','horario_alum.periodo_id','=','periodo.id')
                            ->join('sala','horario_alum.sala_id','=','sala.id')
                            ->join('departamento','departamento.id','=','sala.departamento_id')
                            ->join('users','horario_alum.rut','=','users.rut')
                            ->join('estacion_trabajo','horario_alum.estacion_trabajo_id','=','estacion_trabajo.id')
                            ->where('departamento.id',$dpto->first()->departamento_id)
                            ->select('horario_alum.*','sala.nombre as sala','periodo.bloque as periodo','estacion_trabajo.nombre as estacion')
                            ->get();

        $periodo = Periodo::all()->sortBy("id");

        
        $salas = Sala::join('departamento','sala.departamento_id','=','departamento.id')
                     ->where('sala.departamento_id','=',$dpto->first()->departamento_id)
                     ->select('sala.*','departamento.nombre as nom')
                     ->get();

        $usuarios1 = User::join('users_dpto','users.rut','=','users_dpto.rut')
                        ->where('users_dpto.departamento_id',$dpto->first()->departamento_id)
                        ->select('users.*');
                        
       
        $usuarios2 = User::join('users_carrera','users.rut','=','users_carrera.rut')
                        ->join('carrera','carrera.id','=','users_carrera.carrera_id')
                        ->join('escuela','escuela.id','=','carrera.escuela_id')
                        ->join('departamento','departamento.id','=','escuela.departamento_id')
                        ->where('departamento.id',$dpto->first()->departamento_id)
                        ->select('users.*');
                        
        $usuario = $usuarios1->union($usuarios2)->get();

        \Excel::create('Base de Datos',function($excel) use ($var, $carreras, $curso, $estacion, $horarioD, $horarioA, $horalum, $periodo, $salas, $usuario)
        {
            /*********************ASIGNATURAS************************/
            $excel->sheet('Asignaturas',function($sheet) use ($var)
            {
                $data=[];
                array_push($data, array('ID','CODIGO','NOMBRE','DESCRIPCION','CARRERA'));
                foreach($var as $key => $v)
                {
                    
                    array_push($data, array($v->id,$v->codigo,$v->nombre,$v->descripcion, $v->nom));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);
            
            });
            
            
            /*********************CARRERAS************************/
            $excel->sheet('Carreras',function($sheet) use ($carreras)
            {
                $data=[];
                array_push($data, array('ID','ESCUELA','CODIGO','NOMBRE','DESCRIPCION'));
                foreach($carreras as $key => $v)
                {
                    
                    array_push($data, array($v->id,$v->nom,$v->codigo,$v->nombre,$v->descripcion));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);
            
            });

            /*********************CURSOS************************/
            $excel->sheet('Cursos',function($sheet) use ($curso)
            {
                $data=[];
                array_push($data, array('ID','ASIGNATURA','SEMESTRE','AÑO','SECCION', 'DOCENTE','AYUDANTE'));
                foreach($curso as $key => $v)
                {
                    
                    array_push($data, array($v->id,$v->nom,$v->semestre,$v->anio,$v->seccion,$v->docente,$v->ayudante));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);
            
            });

            
            /*********************ESTACIONES DE TRABAJO************************/
            $excel->sheet('Estaciones',function($sheet) use ($estacion)
            {
                $data=[];
                array_push($data, array('ID','NOMBRE','DISPONIBILIDAD','SALA','PERIODO'));
                foreach($estacion as $key => $v)
                {
                    
                    array_push($data, array($v->id,$v->nombre,$v->disponibilidad,$v->sala,$v->periodo));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);
            
            });

            /*********************HORARIO DOCENTE************************/
            $excel->sheet('Reservas Docentes',function($sheet) use ($horarioD)
            {
                $data=[];
                array_push($data, array('ID','FECHA','SALA','PERIODO','CURSO','RUT','PERMANENCIA','ASISTENCIA','TIPO_RESERVA'));
                foreach($horarioD as $key => $v)
                {
                    
                    array_push($data, array($v->id,$v->fecha,$v->sala,$v->periodo,$v->curso,$v->rut,$v->permanencia,$v->asistencia,$v->tipo_reserva));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);
            
            });

            /*********************HORARIO AYUDANTE************************/
            $excel->sheet('Reservas Ayudantes',function($sheet) use ($horarioA)
            {
                $data=[];
                array_push($data, array('ID','FECHA','SALA','PERIODO','CURSO','RUT','PERMANENCIA','ASISTENCIA','TIPO_RESERVA'));
                foreach($horarioA as $key => $v)
                {
                    
                    array_push($data, array($v->id,$v->fecha,$v->sala,$v->periodo,$v->curso,$v->rut,$v->permanencia,$v->asistencia,$v->tipo_reserva));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);
            
            });

            /*********************HORARIO ALUMNO************************/
            $excel->sheet('Reservas Alumnos',function($sheet) use ($horalum)
            {
                $data=[];
                array_push($data, array('ID','FECHA','RUT','PERIODO','SALA','ESTACION_TRABAJO','PERMANENCIA','ASISTENCIA'));
                foreach($horalum as $key => $v)
                {
                    
                    array_push($data, array($v->id,$v->fecha,$v->rut,$v->periodo,$v->sala,$v->estacion,$v->permanencia,$v->asistencia));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);
            
            });

            /*********************PERÌODOS************************/
            $excel->sheet('Periodos',function($sheet) use ($periodo)
            {
                $data=[];
                array_push($data, array('ID','BLOQUE','INICIO','FIN'));
                foreach($periodo as $key => $v)
                {
                    
                    array_push($data, array($v->id,$v->bloque,$v->inicio,$v->fin));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);
            
            });

            /*********************SALAS************************/
            $excel->sheet('Salas',function($sheet) use ($salas)
            {
                $data=[];
                array_push($data, array('ID','NOMBRE','CAPACIDAD','DEPARTAMENTO'));
                foreach($salas as $key => $v)
                {
                    
                    array_push($data, array($v->id,$v->nombre,$v->capacidad,$v->nom));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);
            
            });

            /*********************USUARIOS************************/
            $excel->sheet('Usuarios',function($sheet) use ($usuario)
            {
                $data=[];
                array_push($data, array('ID','RUT','EMAIL','NOMBRES','APELLIDOS'));
                foreach($usuario as $key => $v)
                {
                    
                    array_push($data, array($v->id,$v->rut,$v->email,$v->nombres,$v->apellidos));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);
            
            });


        })->download('xlsx');

        return redirect()->route('director.descarga.index');
    }

}
