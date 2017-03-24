<?php

namespace App\Http\Controllers\Administrador;

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
            return view('Administrador/index', compact('v2','cont'));
        }
        else
        {
            return view('Administrador/index', compact('cont'));
        }
    }

    public function excel_download()
    {
        $var = Asignatura::join('carrera','asignatura.carrera_id','=','carrera.id')
                         ->select('asignatura.*','carrera.nombre as nom')
                         ->get();

        $campus = Campus::all();

        $carreras = Carrera::join('escuela','carrera.escuela_id','=','escuela.id')
                           ->select('carrera.*','escuela.nombre as nom')
                           ->get();

        $curso = Curso::join('asignatura','curso.asignatura_id','=','asignatura.id')
                      ->select('curso.*','asignatura.nombre as nom')
                      ->get();

        $dpto = Departamento::join('facultad','departamento.facultad_id','=','facultad.id')
                            ->select('departamento.*','facultad.nombre as nom')
                            ->get();

        $escuela = Escuela::join('departamento','escuela.departamento_id','=','departamento.id')
                          ->select('escuela.*','departamento.nombre as nom')
                          ->get();

        $estacion = Estacion_trabajo::join('sala','estacion_trabajo.sala_id','=','sala.id')
                                    ->join('periodo','estacion_trabajo.periodo_id','=','periodo.id')
                                    ->select('estacion_trabajo.*','sala.nombre as sala','periodo.bloque as periodo')
                                    ->get();

        $facultad = Facultad::join('campus','facultad.campus_id','=','campus.id')
                            ->select('facultad.*','campus.nombre as nom')
                            ->get();

        $doc = 'docente';
        $ayu = 'ayudante';
        $horarioD = Horario::join('sala','horario.sala_id','=','sala.id')
                           ->join('periodo','horario.periodo_id','=','periodo.id')
                           ->join('curso','horario.curso_id','=','curso.id')
                           ->where('tipo_reserva','=',$doc)
                           ->select('horario.*','sala.nombre as sala','periodo.bloque as periodo','curso.seccion as curso')
                           ->get();

        $horarioA = Horario::join('sala','horario.sala_id','=','sala.id')
                           ->join('periodo','horario.periodo_id','=','periodo.id')
                           ->join('curso','horario.curso_id','=','curso.id')
                           ->where('tipo_reserva','=',$ayu)
                           ->select('horario.*','sala.nombre as sala','periodo.bloque as periodo','curso.seccion as curso')
                           ->get();

        $horalum = Horario_Alumno::join('sala','horario_alum.sala_id','=','sala.id')
                                 ->join('periodo','horario_alum.periodo_id','=','periodo.id')
                                 ->join('estacion_trabajo','horario_alum.estacion_trabajo_id','=','estacion_trabajo.id')
                                 ->select('horario_alum.*','sala.nombre as sala','periodo.bloque as periodo','estacion_trabajo.nombre as estacion')
                                 ->get();

        $periodo = Periodo::all()->sortBy("id");

        $rol = Rol::all();
        
        $salas = Sala::join('departamento','sala.departamento_id','=','departamento.id')
                     ->select('sala.*','departamento.nombre as nom')
                     ->get();
                     
        $usuario = User::all();

        \Excel::create('Base de Datos (Administrador)',function($excel) use ($var, $campus, $carreras, $curso, $dpto, $escuela, $estacion, $facultad, $horarioD, $horarioA, $horalum, $periodo, $rol, $salas, $usuario)
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

                $sheet->cells('A1:E1', function($cells)
                {
                 $cells->setBackground('#000000');
                 $cells->setFontColor('#FFFFFF');
                 $cells->setAlignment('center');
                 $cells->setValignment('center');
                });           
            });
            
            /*********************CAMPUS************************/
            $excel->sheet('Campus',function($sheet) use ($campus)
            {
                $data=[];
                array_push($data, array('ID','NOMBRE','DIRECCION','DESCRIPCION'));
                foreach($campus as $key => $v)
                {
                    
                    array_push($data, array($v->id,$v->nombre,$v->direccion,$v->descripcion));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);

                $sheet->cells('A1:D1', function($cells)
                {
                 $cells->setBackground('#000000');
                 $cells->setFontColor('#FFFFFF');
                 $cells->setAlignment('center');
                 $cells->setValignment('center');
                }); 
            
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

                $sheet->cells('A1:E1', function($cells)
                {
                 $cells->setBackground('#000000');
                 $cells->setFontColor('#FFFFFF');
                 $cells->setAlignment('center');
                 $cells->setValignment('center');
                }); 
            
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

                $sheet->cells('A1:G1', function($cells)
                {
                 $cells->setBackground('#000000');
                 $cells->setFontColor('#FFFFFF');
                 $cells->setAlignment('center');
                 $cells->setValignment('center');
                }); 
            
            });

            /*********************DEPARTAMENTOS************************/
            $excel->sheet('Departamentos',function($sheet) use ($dpto)
            {
                $data=[];
                array_push($data, array('ID','NOMBRE','FACULTAD','DESCRIPCION'));
                foreach($dpto as $key => $v)
                {
                    
                    array_push($data, array($v->id,$v->nombre,$v->nom,$v->descripcion));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);

                $sheet->cells('A1:D1', function($cells)
                {
                 $cells->setBackground('#000000');
                 $cells->setFontColor('#FFFFFF');
                 $cells->setAlignment('center');
                 $cells->setValignment('center');
                }); 
            
            });

            /*********************ESCUELAS************************/
            $excel->sheet('Escuelas',function($sheet) use ($escuela)
            {
                $data=[];
                array_push($data, array('ID','NOMBRE','DEPARTAMENTO','DESCRIPCION'));
                foreach($escuela as $key => $v)
                {
                    
                    array_push($data, array($v->id,$v->nombre,$v->nom,$v->descripcion));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);

                $sheet->cells('A1:D1', function($cells)
                {
                 $cells->setBackground('#000000');
                 $cells->setFontColor('#FFFFFF');
                 $cells->setAlignment('center');
                 $cells->setValignment('center');
                });
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

                $sheet->cells('A1:E1', function($cells)
                {
                 $cells->setBackground('#000000');
                 $cells->setFontColor('#FFFFFF');
                 $cells->setAlignment('center');
                 $cells->setValignment('center');
                }); 
            
            });

            /*********************FACULTADES************************/
            $excel->sheet('Facultades',function($sheet) use ($facultad)
            {
                $data=[];
                array_push($data, array('ID','NOMBRE','CAMPUS','DESCRIPCION'));
                foreach($facultad as $key => $v)
                {
                    
                    array_push($data, array($v->id,$v->nombre,$v->nom,$v->descripcion));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);

                $sheet->cells('A1:D1', function($cells)
                {
                 $cells->setBackground('#000000');
                 $cells->setFontColor('#FFFFFF');
                 $cells->setAlignment('center');
                 $cells->setValignment('center');
                }); 
            
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

                $sheet->cells('A1:I1', function($cells)
                {
                 $cells->setBackground('#000000');
                 $cells->setFontColor('#FFFFFF');
                 $cells->setAlignment('center');
                 $cells->setValignment('center');
                }); 
            
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

                $sheet->cells('A1:I1', function($cells)
                {
                 $cells->setBackground('#000000');
                 $cells->setFontColor('#FFFFFF');
                 $cells->setAlignment('center');
                 $cells->setValignment('center');
                }); 
            
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

                $sheet->cells('A1:H1', function($cells)
                {
                 $cells->setBackground('#000000');
                 $cells->setFontColor('#FFFFFF');
                 $cells->setAlignment('center');
                 $cells->setValignment('center');
                }); 
            
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

                $sheet->cells('A1:D1', function($cells)
                {
                 $cells->setBackground('#000000');
                 $cells->setFontColor('#FFFFFF');
                 $cells->setAlignment('center');
                 $cells->setValignment('center');
                }); 
            
            });

            /*********************ROLES************************/
            $excel->sheet('Roles',function($sheet) use ($rol)
            {
                $data=[];
                array_push($data, array('ID','NOMBRE','DESCRIPCION'));
                foreach($rol as $key => $v)
                {
                    
                    array_push($data, array($v->id,$v->nombre,$v->descripcion));
                }       
                $sheet->fromArray($data,null, 'A1', false,false);

                $sheet->cells('A1:C1', function($cells)
                {
                 $cells->setBackground('#000000');
                 $cells->setFontColor('#FFFFFF');
                 $cells->setAlignment('center');
                 $cells->setValignment('center');
                }); 
            
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

                $sheet->cells('A1:D1', function($cells)
                {
                 $cells->setBackground('#000000');
                 $cells->setFontColor('#FFFFFF');
                 $cells->setAlignment('center');
                 $cells->setValignment('center');
                }); 
            
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

                $sheet->cells('A1:E1', function($cells)
                {
                 $cells->setBackground('#000000');
                 $cells->setFontColor('#FFFFFF');
                 $cells->setAlignment('center');
                 $cells->setValignment('center');
                });             
            });


        })->download('xlsx');

        return redirect()->route('administrador.descarga.index');
    }

}
