--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: asignatura; Type: TABLE; Schema: public; Owner: brojas; Tablespace: 
--

CREATE TABLE asignatura (
    id bigint NOT NULL,
    codigo character varying(255) NOT NULL,
    nombre character varying(255) NOT NULL,
    descripcion text,
    carrera_id integer NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.asignatura OWNER TO brojas;

--
-- Name: asignatura_id_seq; Type: SEQUENCE; Schema: public; Owner: brojas
--

CREATE SEQUENCE asignatura_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.asignatura_id_seq OWNER TO brojas;

--
-- Name: asignatura_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brojas
--

ALTER SEQUENCE asignatura_id_seq OWNED BY asignatura.id;


--
-- Name: campus; Type: TABLE; Schema: public; Owner: brojas; Tablespace: 
--

CREATE TABLE campus (
    id bigint NOT NULL,
    nombre character varying(255) NOT NULL,
    direccion character varying(255) NOT NULL,
    descripcion text,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.campus OWNER TO brojas;

--
-- Name: campus_id_seq; Type: SEQUENCE; Schema: public; Owner: brojas
--

CREATE SEQUENCE campus_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.campus_id_seq OWNER TO brojas;

--
-- Name: campus_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brojas
--

ALTER SEQUENCE campus_id_seq OWNED BY campus.id;


--
-- Name: carrera; Type: TABLE; Schema: public; Owner: brojas; Tablespace: 
--

CREATE TABLE carrera (
    id bigint NOT NULL,
    escuela_id integer NOT NULL,
    codigo integer NOT NULL,
    nombre character varying(255) NOT NULL,
    descripcion text,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.carrera OWNER TO brojas;

--
-- Name: carrera_id_seq; Type: SEQUENCE; Schema: public; Owner: brojas
--

CREATE SEQUENCE carrera_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.carrera_id_seq OWNER TO brojas;

--
-- Name: carrera_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brojas
--

ALTER SEQUENCE carrera_id_seq OWNED BY carrera.id;


--
-- Name: carrera_sala; Type: TABLE; Schema: public; Owner: brojas; Tablespace: 
--

CREATE TABLE carrera_sala (
    id bigint NOT NULL,
    carrera_id integer NOT NULL,
    sala_id integer NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.carrera_sala OWNER TO brojas;

--
-- Name: carrera_sala_id_seq; Type: SEQUENCE; Schema: public; Owner: brojas
--

CREATE SEQUENCE carrera_sala_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.carrera_sala_id_seq OWNER TO brojas;

--
-- Name: carrera_sala_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brojas
--

ALTER SEQUENCE carrera_sala_id_seq OWNED BY carrera_sala.id;


--
-- Name: curso; Type: TABLE; Schema: public; Owner: brojas; Tablespace: 
--

CREATE TABLE curso (
    id bigint NOT NULL,
    asignatura_id bigint NOT NULL,
    semestre integer NOT NULL,
    anio integer NOT NULL,
    seccion integer NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL,
    docente character varying(255),
    ayudante character varying(255)
);


ALTER TABLE public.curso OWNER TO brojas;

--
-- Name: curso_id_seq; Type: SEQUENCE; Schema: public; Owner: brojas
--

CREATE SEQUENCE curso_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.curso_id_seq OWNER TO brojas;

--
-- Name: curso_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brojas
--

ALTER SEQUENCE curso_id_seq OWNED BY curso.id;


--
-- Name: departamento; Type: TABLE; Schema: public; Owner: brojas; Tablespace: 
--

CREATE TABLE departamento (
    id bigint NOT NULL,
    nombre character varying(255) NOT NULL,
    facultad_id integer NOT NULL,
    descripcion text,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.departamento OWNER TO brojas;

--
-- Name: departamento_id_seq; Type: SEQUENCE; Schema: public; Owner: brojas
--

CREATE SEQUENCE departamento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.departamento_id_seq OWNER TO brojas;

--
-- Name: departamento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brojas
--

ALTER SEQUENCE departamento_id_seq OWNED BY departamento.id;


--
-- Name: escuela; Type: TABLE; Schema: public; Owner: brojas; Tablespace: 
--

CREATE TABLE escuela (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    departamento_id integer NOT NULL,
    descripcion text,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.escuela OWNER TO brojas;

--
-- Name: escuela_id_seq; Type: SEQUENCE; Schema: public; Owner: brojas
--

CREATE SEQUENCE escuela_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.escuela_id_seq OWNER TO brojas;

--
-- Name: escuela_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brojas
--

ALTER SEQUENCE escuela_id_seq OWNED BY escuela.id;


--
-- Name: estacion_trabajo; Type: TABLE; Schema: public; Owner: brojas; Tablespace: 
--

CREATE TABLE estacion_trabajo (
    id bigint NOT NULL,
    nombre character varying(255),
    disponibilidad character varying(255),
    sala_id bigint NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL,
    periodo_id bigint
);


ALTER TABLE public.estacion_trabajo OWNER TO brojas;

--
-- Name: estacion_trabajo_id_seq; Type: SEQUENCE; Schema: public; Owner: brojas
--

CREATE SEQUENCE estacion_trabajo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.estacion_trabajo_id_seq OWNER TO brojas;

--
-- Name: estacion_trabajo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brojas
--

ALTER SEQUENCE estacion_trabajo_id_seq OWNED BY estacion_trabajo.id;


--
-- Name: facultad; Type: TABLE; Schema: public; Owner: brojas; Tablespace: 
--

CREATE TABLE facultad (
    id bigint NOT NULL,
    nombre character varying(255) NOT NULL,
    campus_id integer NOT NULL,
    descripcion text,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.facultad OWNER TO brojas;

--
-- Name: facultad_id_seq; Type: SEQUENCE; Schema: public; Owner: brojas
--

CREATE SEQUENCE facultad_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.facultad_id_seq OWNER TO brojas;

--
-- Name: facultad_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brojas
--

ALTER SEQUENCE facultad_id_seq OWNED BY facultad.id;


--
-- Name: horario; Type: TABLE; Schema: public; Owner: brojas; Tablespace: 
--

CREATE TABLE horario (
    id bigint NOT NULL,
    fecha date DEFAULT now() NOT NULL,
    sala_id bigint NOT NULL,
    periodo_id integer NOT NULL,
    curso_id bigint NOT NULL,
    rut character varying(255) NOT NULL,
    permanencia character varying(255),
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL,
    asistencia text,
    tipo_reserva character varying(255),
    dia character varying(255)
);


ALTER TABLE public.horario OWNER TO brojas;

--
-- Name: horario_alum; Type: TABLE; Schema: public; Owner: brojas; Tablespace: 
--

CREATE TABLE horario_alum (
    id bigint NOT NULL,
    fecha date DEFAULT now() NOT NULL,
    rut character varying(255) NOT NULL,
    periodo_id integer NOT NULL,
    sala_id bigint NOT NULL,
    estacion_trabajo_id bigint NOT NULL,
    permanencia character varying(255),
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL,
    asistencia text,
    dia character varying(255)
);


ALTER TABLE public.horario_alum OWNER TO brojas;

--
-- Name: horario_alum_id_seq; Type: SEQUENCE; Schema: public; Owner: brojas
--

CREATE SEQUENCE horario_alum_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.horario_alum_id_seq OWNER TO brojas;

--
-- Name: horario_alum_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brojas
--

ALTER SEQUENCE horario_alum_id_seq OWNED BY horario_alum.id;


--
-- Name: horario_id_seq; Type: SEQUENCE; Schema: public; Owner: brojas
--

CREATE SEQUENCE horario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.horario_id_seq OWNER TO brojas;

--
-- Name: horario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brojas
--

ALTER SEQUENCE horario_id_seq OWNED BY horario.id;


--
-- Name: periodo; Type: TABLE; Schema: public; Owner: brojas; Tablespace: 
--

CREATE TABLE periodo (
    id bigint NOT NULL,
    bloque character varying(255) NOT NULL,
    inicio time without time zone NOT NULL,
    fin time without time zone NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.periodo OWNER TO brojas;

--
-- Name: periodo_id_seq; Type: SEQUENCE; Schema: public; Owner: brojas
--

CREATE SEQUENCE periodo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.periodo_id_seq OWNER TO brojas;

--
-- Name: periodo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brojas
--

ALTER SEQUENCE periodo_id_seq OWNED BY periodo.id;


--
-- Name: rol; Type: TABLE; Schema: public; Owner: brojas; Tablespace: 
--

CREATE TABLE rol (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    descripcion text,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.rol OWNER TO brojas;

--
-- Name: rol_id_seq; Type: SEQUENCE; Schema: public; Owner: brojas
--

CREATE SEQUENCE rol_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.rol_id_seq OWNER TO brojas;

--
-- Name: rol_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brojas
--

ALTER SEQUENCE rol_id_seq OWNED BY rol.id;


--
-- Name: rol_users; Type: TABLE; Schema: public; Owner: brojas; Tablespace: 
--

CREATE TABLE rol_users (
    id integer NOT NULL,
    rut character varying(255) NOT NULL,
    rol_id integer NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.rol_users OWNER TO brojas;

--
-- Name: rol_users_id_seq; Type: SEQUENCE; Schema: public; Owner: brojas
--

CREATE SEQUENCE rol_users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.rol_users_id_seq OWNER TO brojas;

--
-- Name: rol_users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brojas
--

ALTER SEQUENCE rol_users_id_seq OWNED BY rol_users.id;


--
-- Name: sala; Type: TABLE; Schema: public; Owner: brojas; Tablespace: 
--

CREATE TABLE sala (
    id bigint NOT NULL,
    nombre character varying(255) NOT NULL,
    capacidad integer NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL,
    departamento_id integer
);


ALTER TABLE public.sala OWNER TO brojas;

--
-- Name: sala_id_seq; Type: SEQUENCE; Schema: public; Owner: brojas
--

CREATE SEQUENCE sala_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sala_id_seq OWNER TO brojas;

--
-- Name: sala_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brojas
--

ALTER SEQUENCE sala_id_seq OWNED BY sala.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: brojas; Tablespace: 
--

CREATE TABLE users (
    id bigint NOT NULL,
    rut character varying(255) NOT NULL,
    email character varying(255),
    nombres character varying(255),
    apellidos character varying(255),
    password character varying(255),
    perfiles character varying(255),
    remember_token character varying(100),
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.users OWNER TO brojas;

--
-- Name: users_carrera; Type: TABLE; Schema: public; Owner: brojas; Tablespace: 
--

CREATE TABLE users_carrera (
    id integer NOT NULL,
    rut character varying(255) NOT NULL,
    carrera_id integer NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.users_carrera OWNER TO brojas;

--
-- Name: users_dpto; Type: TABLE; Schema: public; Owner: brojas; Tablespace: 
--

CREATE TABLE users_dpto (
    id integer NOT NULL,
    rut character varying(255) NOT NULL,
    departamento_id integer NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.users_dpto OWNER TO brojas;

--
-- Name: users_dpto_id_seq; Type: SEQUENCE; Schema: public; Owner: brojas
--

CREATE SEQUENCE users_dpto_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_dpto_id_seq OWNER TO brojas;

--
-- Name: users_dpto_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brojas
--

ALTER SEQUENCE users_dpto_id_seq OWNED BY users_dpto.id;


--
-- Name: users_escuela_id_seq; Type: SEQUENCE; Schema: public; Owner: brojas
--

CREATE SEQUENCE users_escuela_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_escuela_id_seq OWNER TO brojas;

--
-- Name: users_escuela_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brojas
--

ALTER SEQUENCE users_escuela_id_seq OWNED BY users_carrera.id;


--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: brojas
--

CREATE SEQUENCE users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO brojas;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brojas
--

ALTER SEQUENCE users_id_seq OWNED BY users.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY asignatura ALTER COLUMN id SET DEFAULT nextval('asignatura_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY campus ALTER COLUMN id SET DEFAULT nextval('campus_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY carrera ALTER COLUMN id SET DEFAULT nextval('carrera_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY carrera_sala ALTER COLUMN id SET DEFAULT nextval('carrera_sala_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY curso ALTER COLUMN id SET DEFAULT nextval('curso_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY departamento ALTER COLUMN id SET DEFAULT nextval('departamento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY escuela ALTER COLUMN id SET DEFAULT nextval('escuela_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY estacion_trabajo ALTER COLUMN id SET DEFAULT nextval('estacion_trabajo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY facultad ALTER COLUMN id SET DEFAULT nextval('facultad_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY horario ALTER COLUMN id SET DEFAULT nextval('horario_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY horario_alum ALTER COLUMN id SET DEFAULT nextval('horario_alum_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY periodo ALTER COLUMN id SET DEFAULT nextval('periodo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY rol ALTER COLUMN id SET DEFAULT nextval('rol_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY rol_users ALTER COLUMN id SET DEFAULT nextval('rol_users_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY sala ALTER COLUMN id SET DEFAULT nextval('sala_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY users ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY users_carrera ALTER COLUMN id SET DEFAULT nextval('users_escuela_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY users_dpto ALTER COLUMN id SET DEFAULT nextval('users_dpto_id_seq'::regclass);


--
-- Data for Name: asignatura; Type: TABLE DATA; Schema: public; Owner: brojas
--

INSERT INTO asignatura VALUES (5382, 'MATC8020', 'ALGEBRA CLASICA', 'ALGEBRA CLASICA', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5383, 'MATC8030', 'ALGEBRA SUPERIOR', 'ALGEBRA SUPERIOR', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5384, 'INFB8021', 'ALGORITMOS Y PROGRAMACIÓN', 'ALGORITMOS Y PROGRAMACIÓN', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5385, 'INFB8071', 'ANÁLISIS DE ALGORITMOS', 'ANÁLISIS DE ALGORITMOS', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5386, 'INF64800', 'ANÁLISIS DE ALGORITMOS', 'ANÁLISIS DE ALGORITMOS', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5387, 'INFB8070', 'ARQUITECTURA DE COMPUTADORES', 'ARQUITECTURA DE COMPUTADORES', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5388, 'INF60500', 'ARQUITECTURA DE COMPUTADORES', 'ARQUITECTURA DE COMPUTADORES', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5389, 'INF65800', 'AUDITORÍA DE SISTEMAS', 'AUDITORÍA DE SISTEMAS', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5390, 'INFB8050', 'BASES DE DATOS', 'BASES DE DATOS', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5391, 'INF63100', 'BASES DE DATOS', 'BASES DE DATOS', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5392, 'MATC8041', 'CALCULO AVANZADO', 'CALCULO AVANZADO', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5393, 'MATC8021', 'CALCULO DIFERENCIAL', 'CALCULO DIFERENCIAL', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5394, 'MATC8031', 'CÁLCULO INTEGRAL', 'CÁLCULO INTEGRAL', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5395, 'MAT72200', 'CÁLCULO VECTORIAL', 'CÁLCULO VECTORIAL', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5396, 'ELEC8040', 'CIRCUITOS ELÉCTRICOS', 'CIRCUITOS ELÉCTRICOS', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5397, 'INF76200', 'COMPUTACIÓN PARALELA', 'COMPUTACIÓN PARALELA', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5398, 'INFB8090', 'COMPUTACIÓN PARALELA Y DISTRIBUIDA', 'COMPUTACIÓN PARALELA Y DISTRIBUIDA', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5399, 'INF61400', 'COMUNICACIÓN DE DATOS', 'COMUNICACIÓN DE DATOS', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5400, 'INFB8091', 'DESEMPEÑO DE SISTEMAS', 'DESEMPEÑO DE SISTEMAS', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5401, 'INF67000', 'DESEMPEÑO DE SISTEMAS COMPUTACIONALES', 'DESEMPEÑO DE SISTEMAS COMPUTACIONALES', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5402, 'INDC8020', 'DIBUJO DE INGENIERÍA', 'DIBUJO DE INGENIERÍA', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5403, 'MATB8041', 'ECUACIONES DIFERENCIALES', 'ECUACIONES DIFERENCIALES', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5404, 'EFD70800', 'EFD: ACONDICIONAMIENTO FÍSICO', 'EFD: ACONDICIONAMIENTO FÍSICO', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5405, 'EFD63600', 'EFD: ACONDICIONAMIENTO FÍSICO', 'EFD: ACONDICIONAMIENTO FÍSICO', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5406, 'EFD63400', 'EFD: FUNDAMENTOS BÁSICOS DEL VOLEIBOL', 'EFD: FUNDAMENTOS BÁSICOS DEL VOLEIBOL', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5407, 'EFE68100', 'EFE: GESTIÓN DE INFRAESTRUCTURA DE TI (ITIL)', 'EFE: GESTIÓN DE INFRAESTRUCTURA DE TI (ITIL)', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5408, 'EFE60300', 'EFE: INTELIGENCIA ARTIFICIAL', 'EFE: INTELIGENCIA ARTIFICIAL', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5409, 'EFE67100', 'EFE: KDD (KNOWLWDGE DISCOVERY IN DATABESES)', 'EFE: KDD (KNOWLWDGE DISCOVERY IN DATABESES)', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5410, 'EFE65300', 'EFE: LOGICA DIFUSA', 'EFE: LOGICA DIFUSA', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5411, 'EFG06500', 'EFG: CONSTRUCCIÓN DE LA CIENCIA EN CHILE', 'EFG: CONSTRUCCIÓN DE LA CIENCIA EN CHILE', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5412, 'EFG65800', 'EFG: INTRODUCCIÓN A LA FÍSICA NUCLEAR', 'EFG: INTRODUCCIÓN A LA FÍSICA NUCLEAR', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5413, 'HUM24200', 'EFG:CHILE ENTRE DOS DICTADURAS', 'EFG:CHILE ENTRE DOS DICTADURAS', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5414, 'ELE63100', 'ELECTRICIDAD Y ELECTRÓNICA', 'ELECTRICIDAD Y ELECTRÓNICA', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5415, 'FISC8040', 'ELECTROMAGNETISMO', 'ELECTROMAGNETISMO', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5416, 'EST64100', 'ESTADÍSTICA Y PROBABILIDAD', 'ESTADÍSTICA Y PROBABILIDAD', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5417, 'ESTC8050', 'ESTADISTICA Y PROBABILIDADES', 'ESTADISTICA Y PROBABILIDADES', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5418, 'INFB8030', 'ESTRUCTURAS DE DATOS', 'ESTRUCTURAS DE DATOS', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5419, 'INF64000', 'ESTRUCTURAS DISCRETAS', 'ESTRUCTURAS DISCRETAS', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5420, 'HFE62400', 'ÉTICA PROFESIONAL', 'ÉTICA PROFESIONAL', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5421, 'INFB8083', 'EVALUACIÓN DE PROYECTOS INFORMÁTICOS', 'EVALUACIÓN DE PROYECTOS INFORMÁTICOS', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5422, 'FIS64000', 'FÍSICA MODERNA', 'FÍSICA MODERNA', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5423, 'INF67100', 'GESTIÓN DE PERSONAL INFORMÁTICO', 'GESTIÓN DE PERSONAL INFORMÁTICO', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5424, 'INFB8094', 'GESTIÓN DE PROCESOS DE NEGOCIOS', 'GESTIÓN DE PROCESOS DE NEGOCIOS', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5425, 'INF75500', 'GESTIÓN DE PROYECTOS INFORMÁTICOS', 'GESTIÓN DE PROYECTOS INFORMÁTICOS', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5426, 'INF75200', 'GESTIÓN FINANCIERA DE TI', 'GESTIÓN FINANCIERA DE TI', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5427, 'INF67200', 'GESTIÓN INFORMÁTICA', 'GESTIÓN INFORMÁTICA', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5428, 'IND61800', 'GESTIÓN MEDIO AMBIENTAL', 'GESTIÓN MEDIO AMBIENTAL', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5429, 'INFB8061', 'GRAFOS Y LENGUAJES FORMALES', 'GRAFOS Y LENGUAJES FORMALES', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5430, 'EST64200', 'INFERENCIA ESTADÍSTICA', 'INFERENCIA ESTADÍSTICA', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5431, 'ESTB8060', 'INFERENCIA Y PROCESOS ESTOCÁSTICOS', 'INFERENCIA Y PROCESOS ESTOCÁSTICOS', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5432, 'INF75700', 'INFORMÁTICA INDUSTRIAL', 'INFORMÁTICA INDUSTRIAL', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5433, 'INDB8081', 'INGENIERÍA AMBIENTAL', 'INGENIERÍA AMBIENTAL', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5434, 'IND60500', 'INGENIERÍA DE SISTEMAS', 'INGENIERÍA DE SISTEMAS', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5435, 'INFB8072', 'INGENIERÍA DE SOFTWARE', 'INGENIERÍA DE SOFTWARE', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5436, 'INF63500', 'INGENIERÍA DE SOFTWARE', 'INGENIERÍA DE SOFTWARE', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5437, 'HUMC8020', 'INGLÉS I', 'INGLÉS I', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5438, 'HUMC8030', 'INGLÉS II', 'INGLÉS II', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5439, 'HIE60700', 'INGLÉS TÉCNICO I', 'INGLÉS TÉCNICO I', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5440, 'HIE60800', 'INGLÉS TÉCNICO II', 'INGLÉS TÉCNICO II', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5441, 'INFB8010', 'INTRODUCCIÓN A LA INGENIERÍA EN COMPUTACIÓN', 'INTRODUCCIÓN A LA INGENIERÍA EN COMPUTACIÓN', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5442, 'INDB8070', 'INVESTIGACIÓN DE OPERACIONES', 'INVESTIGACIÓN DE OPERACIONES', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5443, 'IND60900', 'INVESTIGACIÓN DE OPERACIONES', 'INVESTIGACIÓN DE OPERACIONES', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5444, 'INF62600', 'LENGUAJES DE EXPRESIONES', 'LENGUAJES DE EXPRESIONES', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5445, 'INFB8040', 'LENGUAJES DE PROGRAMACIÓN', 'LENGUAJES DE PROGRAMACIÓN', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5446, 'FISC8030', 'MECANICA CLÁSICA', 'MECANICA CLÁSICA', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5447, 'MAT64000', 'MÉTODOS NUMÉRICOS', 'MÉTODOS NUMÉRICOS', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5448, 'FISC8050', 'ÓPTICA Y ONDAS', 'ÓPTICA Y ONDAS', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5449, 'INFB8092', 'OPTIMIZACIÓN DE SISTEMAS', 'OPTIMIZACIÓN DE SISTEMAS', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5450, 'INF75000', 'OPTIMIZACIÓN DE SISTEMAS', 'OPTIMIZACIÓN DE SISTEMAS', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5451, 'INF60400', 'ORGANIZACIÓN DE COMPUTADORES', 'ORGANIZACIÓN DE COMPUTADORES', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5452, 'INF62700', 'PROGRAMACIÓN', 'PROGRAMACIÓN', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5453, 'QUIC8010', 'QUÍMICA GENERAL', 'QUÍMICA GENERAL', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5454, 'INFB8080', 'REDES Y COMUNICACIÓN DE DATOS', 'REDES Y COMUNICACIÓN DE DATOS', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5455, 'INFB8093', 'SIMULACIÓN DE SISTEMAS', 'SIMULACIÓN DE SISTEMAS', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5456, 'INF65300', 'SIMULACIÓN DE SISTEMAS', 'SIMULACIÓN DE SISTEMAS', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5457, 'INDB8040', 'SISTEMAS DE ADMINISTRACIÓN', 'SISTEMAS DE ADMINISTRACIÓN', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5458, 'IND60400', 'SISTEMAS DE ADMINISTRACIÓN', 'SISTEMAS DE ADMINISTRACIÓN', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5459, 'INFB8062', 'SISTEMAS DE INFORMACIÓN', 'SISTEMAS DE INFORMACIÓN', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5460, 'INF63200', 'SISTEMAS DE INFORMACIÓN', 'SISTEMAS DE INFORMACIÓN', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5461, 'INF76300', 'SISTEMAS DISTRIBUIDOS', 'SISTEMAS DISTRIBUIDOS', 53, '2017-03-20 15:40:07', '2017-03-20 15:40:07');
INSERT INTO asignatura VALUES (5462, 'INDC8060', 'SISTEMAS ECONÓMICOS', 'SISTEMAS ECONÓMICOS', 53, '2017-03-20 15:40:08', '2017-03-20 15:40:08');
INSERT INTO asignatura VALUES (5463, 'IND60801', 'SISTEMAS ECONÓMICOS', 'SISTEMAS ECONÓMICOS', 53, '2017-03-20 15:40:08', '2017-03-20 15:40:08');
INSERT INTO asignatura VALUES (5464, 'INF73600', 'SISTEMAS INTEGRADOS DE INFORMACIÓN', 'SISTEMAS INTEGRADOS DE INFORMACIÓN', 53, '2017-03-20 15:40:08', '2017-03-20 15:40:08');
INSERT INTO asignatura VALUES (5465, 'INFB8081', 'SISTEMAS OPERATIVOS', 'SISTEMAS OPERATIVOS', 53, '2017-03-20 15:40:08', '2017-03-20 15:40:08');
INSERT INTO asignatura VALUES (5466, 'INF64500', 'SISTEMAS OPERATIVOS', 'SISTEMAS OPERATIVOS', 53, '2017-03-20 15:40:08', '2017-03-20 15:40:08');
INSERT INTO asignatura VALUES (5467, 'PPSB0001', 'TALLER DE COMUNICACIÓN EFECTIVA', 'TALLER DE COMUNICACIÓN EFECTIVA', 53, '2017-03-20 15:40:08', '2017-03-20 15:40:08');
INSERT INTO asignatura VALUES (5468, 'MATC8010', 'TALLER DE MATEMATICA', 'TALLER DE MATEMATICA', 53, '2017-03-20 15:40:08', '2017-03-20 15:40:08');
INSERT INTO asignatura VALUES (5469, 'INFB8082', 'TALLER DE SISTEMAS DE INFORMACIÓN', 'TALLER DE SISTEMAS DE INFORMACIÓN', 53, '2017-03-20 15:40:08', '2017-03-20 15:40:08');
INSERT INTO asignatura VALUES (5470, 'INF63900', 'TALLER DE SISTEMAS DE INFORMACIÓN', 'TALLER DE SISTEMAS DE INFORMACIÓN', 53, '2017-03-20 15:40:08', '2017-03-20 15:40:08');
INSERT INTO asignatura VALUES (5471, 'PPSB0002', 'TALLER PARA EL DESARROLLO DEL PENSAMIENTO LOGICO DEDUCTIVO', 'TALLER PARA EL DESARROLLO DEL PENSAMIENTO LOGICO DEDUCTIVO', 53, '2017-03-20 15:40:08', '2017-03-20 15:40:08');
INSERT INTO asignatura VALUES (5472, 'INFB8060', 'TECNOLOGÍA DE COMPUTADORES', 'TECNOLOGÍA DE COMPUTADORES', 53, '2017-03-20 15:40:08', '2017-03-20 15:40:08');
INSERT INTO asignatura VALUES (5473, 'INF60300', 'TECNOLOGÍA DE EQUIPOS', 'TECNOLOGÍA DE EQUIPOS', 53, '2017-03-20 15:40:08', '2017-03-20 15:40:08');
INSERT INTO asignatura VALUES (5474, 'INF64400', 'TEORÍA DE AUTÓMATAS', 'TEORÍA DE AUTÓMATAS', 53, '2017-03-20 15:40:08', '2017-03-20 15:40:08');
INSERT INTO asignatura VALUES (5475, 'INDB8072', 'TEORÍA DE SISTEMAS', 'TEORÍA DE SISTEMAS', 53, '2017-03-20 15:40:08', '2017-03-20 15:40:08');
INSERT INTO asignatura VALUES (5476, 'INF79800', 'TRABAJO DE TITULACIÓN I', 'TRABAJO DE TITULACIÓN I', 53, '2017-03-20 15:40:08', '2017-03-20 15:40:08');
INSERT INTO asignatura VALUES (5477, 'INF79900', 'TRABAJO DE TITULACIÓN II', 'TRABAJO DE TITULACIÓN II', 53, '2017-03-20 15:40:08', '2017-03-20 15:40:08');
INSERT INTO asignatura VALUES (5481, 'MATPC601', 'ÁLGEBRA', 'ÁLGEBRA', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5482, 'MATPC605', 'ÁLGEBRA LINEAL', 'ÁLGEBRA LINEAL', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5483, 'INF64800', 'ANÁLISIS DE ALGORITMOS', 'ANÁLISIS DE ALGORITMOS', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5484, 'INF60500', 'ARQUITECTURA DE COMPUTADORES', 'ARQUITECTURA DE COMPUTADORES', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5485, 'INF65800', 'AUDITORÍA DE SISTEMAS', 'AUDITORÍA DE SISTEMAS', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5486, 'INF63100', 'BASES DE DATOS', 'BASES DE DATOS', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5487, 'MAT62000', 'CÁLCULO EN VARIAS VARIABLES', 'CÁLCULO EN VARIAS VARIABLES', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5488, 'MATPC611', 'CÁLCULO I', 'CÁLCULO I', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5489, 'MATPC612', 'CÁLCULO II', 'CÁLCULO II', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5490, 'INF62400', 'CIENCIAS DE LA COMPUTACIÓN', 'CIENCIAS DE LA COMPUTACIÓN', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5491, 'INF61400', 'COMUNICACIÓN DE DATOS', 'COMUNICACIÓN DE DATOS', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5492, 'INF67000', 'DESEMPEÑO DE SISTEMAS COMPUTACIONALES', 'DESEMPEÑO DE SISTEMAS COMPUTACIONALES', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5493, 'DIB61100', 'DIBUJO DE INGENIERÍA', 'DIBUJO DE INGENIERÍA', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5494, 'MAT63000', 'ECUACIONES DIFERENCIALES', 'ECUACIONES DIFERENCIALES', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5495, 'EFD63600', 'EFD: ACONDICIONAMIENTO FÍSICO', 'EFD: ACONDICIONAMIENTO FÍSICO', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5496, 'EFD63400', 'EFD: FUNDAMENTOS BÁSICOS DEL VOLEIBOL', 'EFD: FUNDAMENTOS BÁSICOS DEL VOLEIBOL', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5497, 'EFE68100', 'EFE: GESTIÓN DE INFRAESTRUCTURA DE TI (ITIL)', 'EFE: GESTIÓN DE INFRAESTRUCTURA DE TI (ITIL)', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5498, 'EFE60300', 'EFE: INTELIGENCIA ARTIFICIAL', 'EFE: INTELIGENCIA ARTIFICIAL', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5499, 'EFE67100', 'EFE: KDD (KNOWLWDGE DISCOVERY IN DATABESES)', 'EFE: KDD (KNOWLWDGE DISCOVERY IN DATABESES)', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5500, 'EFE65300', 'EFE: LOGICA DIFUSA', 'EFE: LOGICA DIFUSA', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5501, 'EFG06500', 'EFG: CONSTRUCCIÓN DE LA CIENCIA EN CHILE', 'EFG: CONSTRUCCIÓN DE LA CIENCIA EN CHILE', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5502, 'EFG65800', 'EFG: INTRODUCCIÓN A LA FÍSICA NUCLEAR', 'EFG: INTRODUCCIÓN A LA FÍSICA NUCLEAR', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5503, 'HUM24200', 'EFG:CHILE ENTRE DOS DICTADURAS', 'EFG:CHILE ENTRE DOS DICTADURAS', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5504, 'ELE63100', 'ELECTRICIDAD Y ELECTRÓNICA', 'ELECTRICIDAD Y ELECTRÓNICA', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5505, 'FIS62001', 'ELECTROMAGNETISMO', 'ELECTROMAGNETISMO', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5506, 'EST64100', 'ESTADÍSTICA Y PROBABILIDAD', 'ESTADÍSTICA Y PROBABILIDAD', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5507, 'INF62800', 'ESTRUCTURAS DE DATOS', 'ESTRUCTURAS DE DATOS', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5508, 'INF64000', 'ESTRUCTURAS DISCRETAS', 'ESTRUCTURAS DISCRETAS', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5509, 'HFE62400', 'ÉTICA PROFESIONAL', 'ÉTICA PROFESIONAL', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5510, 'IND61300', 'EVALUACIÓN DE PROYECTOS', 'EVALUACIÓN DE PROYECTOS', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5511, 'FIS61001', 'FÍSICA MECÁNICA', 'FÍSICA MECÁNICA', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5512, 'FIS64000', 'FÍSICA MODERNA', 'FÍSICA MODERNA', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5513, 'INF67100', 'GESTIÓN DE PERSONAL INFORMÁTICO', 'GESTIÓN DE PERSONAL INFORMÁTICO', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5514, 'INF67200', 'GESTIÓN INFORMÁTICA', 'GESTIÓN INFORMÁTICA', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5515, 'IND61800', 'GESTIÓN MEDIO AMBIENTAL', 'GESTIÓN MEDIO AMBIENTAL', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5516, 'EST64200', 'INFERENCIA ESTADÍSTICA', 'INFERENCIA ESTADÍSTICA', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5517, 'IND60500', 'INGENIERÍA DE SISTEMAS', 'INGENIERÍA DE SISTEMAS', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5518, 'INF63500', 'INGENIERÍA DE SOFTWARE', 'INGENIERÍA DE SOFTWARE', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5519, 'HIE60700', 'INGLÉS TÉCNICO I', 'INGLÉS TÉCNICO I', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5520, 'HIE60800', 'INGLÉS TÉCNICO II', 'INGLÉS TÉCNICO II', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5521, 'IND60000', 'INTRODUCCIÓN A LA INGENIERÍA', 'INTRODUCCIÓN A LA INGENIERÍA', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5522, 'IND60900', 'INVESTIGACIÓN DE OPERACIONES', 'INVESTIGACIÓN DE OPERACIONES', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5523, 'INF62600', 'LENGUAJES DE EXPRESIONES', 'LENGUAJES DE EXPRESIONES', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5524, 'INF64200', 'LENGUAJES DE PROGRAMACIÓN', 'LENGUAJES DE PROGRAMACIÓN', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5525, 'MAT64000', 'MÉTODOS NUMÉRICOS', 'MÉTODOS NUMÉRICOS', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5526, 'FIS63001', 'ÓPTICA Y ONDAS', 'ÓPTICA Y ONDAS', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5527, 'INF60400', 'ORGANIZACIÓN DE COMPUTADORES', 'ORGANIZACIÓN DE COMPUTADORES', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5528, 'INF62700', 'PROGRAMACIÓN', 'PROGRAMACIÓN', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5529, 'QUI61500', 'QUÍMICA GENERAL', 'QUÍMICA GENERAL', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5530, 'INF65300', 'SIMULACIÓN DE SISTEMAS', 'SIMULACIÓN DE SISTEMAS', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5531, 'IND60400', 'SISTEMAS DE ADMINISTRACIÓN', 'SISTEMAS DE ADMINISTRACIÓN', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5532, 'INF63200', 'SISTEMAS DE INFORMACIÓN', 'SISTEMAS DE INFORMACIÓN', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5533, 'IND60801', 'SISTEMAS ECONÓMICOS', 'SISTEMAS ECONÓMICOS', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5534, 'INF64500', 'SISTEMAS OPERATIVOS', 'SISTEMAS OPERATIVOS', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5535, 'INF63900', 'TALLER DE SISTEMAS DE INFORMACIÓN', 'TALLER DE SISTEMAS DE INFORMACIÓN', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5536, 'HCE61100', 'TÉCNICAS DE LA COMUNICACIÓN ORAL Y ESCRITA', 'TÉCNICAS DE LA COMUNICACIÓN ORAL Y ESCRITA', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5537, 'INF60300', 'TECNOLOGÍA DE EQUIPOS', 'TECNOLOGÍA DE EQUIPOS', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5538, 'INF64400', 'TEORÍA DE AUTÓMATAS', 'TEORÍA DE AUTÓMATAS', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5539, 'INF69800', 'TRABAJO DE TITULACIÓN I', 'TRABAJO DE TITULACIÓN I', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5540, 'INF69900', 'TRABAJO DE TITULACIÓN II', 'TRABAJO DE TITULACIÓN II', 63, '2017-03-20 19:07:11', '2017-03-20 19:07:11');
INSERT INTO asignatura VALUES (5543, '1234', 'probando bachi', 'bachi', 54, '2017-03-26 18:03:10', '2017-03-26 18:03:10');


--
-- Name: asignatura_id_seq; Type: SEQUENCE SET; Schema: public; Owner: brojas
--

SELECT pg_catalog.setval('asignatura_id_seq', 5543, true);


--
-- Data for Name: campus; Type: TABLE DATA; Schema: public; Owner: brojas
--

INSERT INTO campus VALUES (1, 'Macul', 'José Pedro Alessandri 1242, Ñuñoa', 'Ubicado en la comuna de Ñuñoa, alberga a las facultades de Ciencias Naturales, Matemáticas y del Medio Ambiente, y de Ingeniería.', '2016-12-04 15:32:27.988004', '2016-12-04 15:32:27.988004');
INSERT INTO campus VALUES (2, 'Providencia', 'Dr. Hernán Alessandri 644, Providencia (Metro Salvador)', 'Emplazado en la comuna homónima, en el campus se encuentra la Facultad de Administración y Economía.', '2016-12-04 15:32:41.681705', '2016-12-04 15:32:41.681705');
INSERT INTO campus VALUES (3, 'Área Central', 'Dieciocho 161, Santiago (Metro Los Héroes)', 'El campus incluye a la Casa Central, donde se encuentran las unidades administrativas de la universidad, y los edificios que acogen a las facultades de Ciencias de la Construcción y Ordenamiento Territorial, y de Humanidades y Tecnologías de la Comunicación Social.', '2016-12-12 16:39:02.228913', '2017-02-22 14:04:02');


--
-- Name: campus_id_seq; Type: SEQUENCE SET; Schema: public; Owner: brojas
--

SELECT pg_catalog.setval('campus_id_seq', 15, true);


--
-- Data for Name: carrera; Type: TABLE DATA; Schema: public; Owner: brojas
--

INSERT INTO carrera VALUES (53, 1, 21041, 'Ingeniería Civil en Computación mención Informática', 'Duración 6 años', '2017-02-22 18:48:22', '2017-02-22 18:48:22');
INSERT INTO carrera VALUES (54, 2, 21046, 'Bachilerato en Ciencias de la Ingeniería', 'Bachillerato', '2017-02-22 18:49:09', '2017-02-22 18:49:09');
INSERT INTO carrera VALUES (55, 2, 21071, 'Dibujante Proyectista', 'Dibujo', '2017-02-22 18:49:31', '2017-02-22 18:49:31');
INSERT INTO carrera VALUES (56, 3, 21036, 'Ingeniería en Electrónica', 'Electrónica', '2017-02-22 18:50:07', '2017-02-22 18:50:07');
INSERT INTO carrera VALUES (57, 4, 21037, 'Ingeniería en Mecánica', 'Mecánica', '2017-02-22 18:50:34', '2017-02-22 18:50:34');
INSERT INTO carrera VALUES (58, 2, 21045, 'Ingeniería Industrial', 'Industrial', '2017-02-22 18:51:06', '2017-02-22 18:51:06');
INSERT INTO carrera VALUES (59, 2, 21044, 'Ingeniería Civil Industrial M.S.G', 'Mención Sistemas de Gestión', '2017-02-22 18:51:50', '2017-02-22 18:51:50');
INSERT INTO carrera VALUES (60, 2, 21040, 'Ingeniería Civil Industrial M.A', 'Mención Agroindustria', '2017-02-22 18:52:19', '2017-02-22 18:52:19');
INSERT INTO carrera VALUES (61, 5, 21031, 'Ingeniería en Geomensura', 'Geomensura', '2017-02-22 18:52:45', '2017-02-22 18:52:58');
INSERT INTO carrera VALUES (62, 6, 21025, 'Ingeniería en Transporte y Tránsito', 'Transporte y Tránsito', '2017-02-22 18:53:33', '2017-02-22 18:53:33');
INSERT INTO carrera VALUES (63, 1, 21030, 'Ingeniería en Computación', 'Duración 5 años', '2017-02-22 18:53:57', '2017-02-22 18:53:57');
INSERT INTO carrera VALUES (85, 15, 2101, 'Servicio Social', 'Servicio Social', '2017-03-17 19:02:14', '2017-03-17 19:02:14');
INSERT INTO carrera VALUES (86, 17, 2103, 'Diseño', 'Diseño', '2017-03-17 19:02:14', '2017-03-17 19:02:14');
INSERT INTO carrera VALUES (87, 3, 2106, 'Técnico Universitario en Electrónica', 'Técnico Universitario en Electrónica', '2017-03-17 19:02:14', '2017-03-17 19:02:14');
INSERT INTO carrera VALUES (88, 4, 2109, 'Técnico Universitario en Mecánica', 'Técnico Universitario en Mecánica', '2017-03-17 19:02:14', '2017-03-17 19:02:14');
INSERT INTO carrera VALUES (89, 20, 2110, 'Tecnico Universitario Nivel Superior En Prevencion De Riesgos', 'Tecnico Universitario Nivel Superior En Prevencion De Riesgos', '2017-03-17 19:02:14', '2017-03-17 19:02:14');
INSERT INTO carrera VALUES (90, 5, 2111, 'Tecnico Univ En Topografia', 'Tecnico Univ En Topografia', '2017-03-17 19:02:14', '2017-03-17 19:02:14');
INSERT INTO carrera VALUES (91, 19, 2113, 'Construcción Civil', 'Construcción Civil', '2017-03-17 19:02:14', '2017-03-17 19:02:14');
INSERT INTO carrera VALUES (92, 1, 2114, 'Ingeniería De Ejec En Informática', 'Ingeniería De Ejec En Informática', '2017-03-17 19:02:14', '2017-03-17 19:02:14');
INSERT INTO carrera VALUES (93, 3, 2116, 'Ingen De Ejecución En Electronica', 'Ingen De Ejecución En Electronica', '2017-03-17 19:02:14', '2017-03-17 19:02:14');
INSERT INTO carrera VALUES (94, 4, 2117, 'Ingenieria De Ejecución En Mecanica', 'Ingenieria De Ejecución En Mecanica', '2017-03-17 19:02:14', '2017-03-17 19:02:14');
INSERT INTO carrera VALUES (96, 4, 2119, 'Ingejecplan Comun (electy Mecan)', 'Ingejecplan Comun (electy Mecan)', '2017-03-17 19:02:14', '2017-03-17 19:02:14');
INSERT INTO carrera VALUES (97, 19, 2120, 'Tecnico Superior En Construccion', 'Tecnico Superior En Construccion', '2017-03-17 19:02:14', '2017-03-17 19:02:14');
INSERT INTO carrera VALUES (98, 3, 2121, 'Tecn Sup En Electronica (diurno)', 'Tecn Sup En Electronica (diurno)', '2017-03-17 19:02:14', '2017-03-17 19:02:14');
INSERT INTO carrera VALUES (99, 2, 2122, 'Tecn Sup En Dibujo Tecnico', 'Tecn Sup En Dibujo Tecnico', '2017-03-17 19:02:14', '2017-03-17 19:02:14');
INSERT INTO carrera VALUES (100, 22, 2126, 'Ing De Ejec Industria Alimentaria', 'Ing De Ejec Industria Alimentaria', '2017-03-17 19:02:14', '2017-03-17 19:02:14');
INSERT INTO carrera VALUES (101, 6, 2127, 'Ingenieria De Ejecucion En Transporte Y Transito', 'Ingenieria De Ejecucion En Transporte Y Transito', '2017-03-17 19:02:14', '2017-03-17 19:02:14');
INSERT INTO carrera VALUES (102, 28, 2128, 'Ing De Ejec En Industria Maderera', 'Ing De Ejec En Industria Maderera', '2017-03-17 19:02:14', '2017-03-17 19:02:14');
INSERT INTO carrera VALUES (103, 19, 2129, 'Construccion Civil (pln Especial)', 'Construccion Civil (pln Especial)', '2017-03-17 19:02:14', '2017-03-17 19:02:14');
INSERT INTO carrera VALUES (104, 5, 2135, 'Ingeniería De Ejecución En Geomensura', 'Ingeniería De Ejecución En Geomensura', '2017-03-17 19:02:14', '2017-03-17 19:02:14');
INSERT INTO carrera VALUES (105, 15, 2143, 'Trabajo Social', 'Trabajo Social', '2017-03-17 19:02:14', '2017-03-17 19:02:14');
INSERT INTO carrera VALUES (106, 3, 2150, 'Ingeniería En Electronica (sn Fern)', 'Ingeniería En Electronica (sn Fern)', '2017-03-17 19:02:14', '2017-03-17 19:02:14');
INSERT INTO carrera VALUES (107, 4, 2151, 'Ingeniería En Mecanica (sn Fernan)', 'Ingeniería En Mecanica (sn Fernan)', '2017-03-17 19:02:14', '2017-03-17 19:02:14');
INSERT INTO carrera VALUES (108, 21, 2152, 'Ingeniería En Quimica (sn Fernando)', 'Ingeniería En Quimica (sn Fernando)', '2017-03-17 19:02:14', '2017-03-17 19:02:14');
INSERT INTO carrera VALUES (109, 21, 2154, 'Tecnico Quimico Laboratorista', 'Tecnico Quimico Laboratorista', '2017-03-17 19:02:14', '2017-03-17 19:02:14');
INSERT INTO carrera VALUES (110, 16, 2157, 'Tecnico En Topografia', 'Tecnico En Topografia', '2017-03-17 19:02:14', '2017-03-17 19:02:14');
INSERT INTO carrera VALUES (114, 3, 2162, 'Tecnico Superior En Electronica (v)', 'Tecnico Superior En Electronica (v)', '2017-03-17 19:08:06', '2017-03-17 19:08:06');
INSERT INTO carrera VALUES (115, 1, 2163, 'Tecnico Superior En Computacion (v)', 'Tecnico Superior En Computacion (v)', '2017-03-17 19:08:06', '2017-03-17 19:08:06');
INSERT INTO carrera VALUES (116, 4, 2164, 'Tecnico Superior En Mecanica', 'Tecnico Superior En Mecanica', '2017-03-17 19:08:06', '2017-03-17 19:08:06');
INSERT INTO carrera VALUES (117, 2, 2165, 'Tec Sup En Dib Tecnico M/arquitectura', 'Tec Sup En Dib Tecnico M/arquitectura', '2017-03-17 19:08:06', '2017-03-17 19:08:06');
INSERT INTO carrera VALUES (118, 21, 2166, 'Ingeniería De Ejecución En Química', 'Ingeniería De Ejecución En Química', '2017-03-17 19:08:06', '2017-03-17 19:08:06');
INSERT INTO carrera VALUES (119, 5, 2167, 'Técnico Universitario En Geomensura', 'Técnico Universitario En Geomensura', '2017-03-17 19:08:06', '2017-03-17 19:08:06');
INSERT INTO carrera VALUES (120, 2, 2168, 'Tec Sup En Dibujo Tec M/maquinas', 'Tec Sup En Dibujo Tec M/maquinas', '2017-03-17 19:08:06', '2017-03-17 19:08:06');
INSERT INTO carrera VALUES (122, 1, 2192, 'Analista De Sistemas', 'Analista De Sistemas', '2017-03-17 19:08:06', '2017-03-17 19:08:06');
INSERT INTO carrera VALUES (123, 1, 2196, 'Tecn Sup Analista De Sistemas', 'Tecn Sup Analista De Sistemas', '2017-03-17 19:08:06', '2017-03-17 19:08:06');
INSERT INTO carrera VALUES (125, 1, 3644, 'Ingenieria De Ejecucion En Informatica', 'Ingenieria De Ejecucion En Informatica', '2017-03-17 19:08:06', '2017-03-17 19:08:06');
INSERT INTO carrera VALUES (126, 2, 4052, 'Ingeniería Civil Industrial', 'Ingeniería Civil Industrial', '2017-03-17 19:08:06', '2017-03-17 19:08:06');
INSERT INTO carrera VALUES (127, 3, 4055, 'Ingenieria Civil Electronico', 'Ingenieria Civil Electronico', '2017-03-17 19:08:06', '2017-03-17 19:08:06');
INSERT INTO carrera VALUES (128, 2, 4633, 'Ingenieria Industrial', 'Ingenieria Industrial', '2017-03-17 19:08:06', '2017-03-17 19:08:06');
INSERT INTO carrera VALUES (129, 1, 4642, 'Ingenieria Informatica', 'Ingenieria Informatica', '2017-03-17 19:08:06', '2017-03-17 19:08:06');
INSERT INTO carrera VALUES (130, 4, 21096, '21096 Ingeniería Civil En Mecánica', '21096 Ingeniería Civil En Mecánica', '2017-03-17 19:08:06', '2017-03-17 19:08:06');
INSERT INTO carrera VALUES (131, 35, 2118, 'Ing Ejec En Comercio Internacional', 'Ing Ejec En Comercio Internacional', '2017-03-17 19:20:20', '2017-03-17 19:20:20');
INSERT INTO carrera VALUES (132, 36, 2158, 'Contador Auditor (san Fdo)', 'Contador Auditor (san Fdo)', '2017-03-17 19:20:20', '2017-03-17 19:20:20');
INSERT INTO carrera VALUES (133, 38, 2159, 'Ingeniería En Comercio Internacional(san Fdo)', 'Ingeniería En Comercio Internacional(san Fdo)', '2017-03-17 19:20:20', '2017-03-17 19:20:20');
INSERT INTO carrera VALUES (134, 34, 2160, 'Ingeniería En Administración Agroindustrial (san Fdo)', 'Ingeniería En Administración Agroindustrial (san Fdo)', '2017-03-17 19:20:20', '2017-03-17 19:20:20');
INSERT INTO carrera VALUES (135, 34, 2182, 'Ingeniería En Turismo', 'Ingeniería En Turismo', '2017-03-17 19:20:20', '2017-03-17 19:20:20');
INSERT INTO carrera VALUES (136, 34, 3011, 'Tecn Universitario En Administracion Publica M/ Serv Fisc', 'Tecn Universitario En Administracion Publica M/ Serv Fisc', '2017-03-17 19:20:20', '2017-03-17 19:20:20');
INSERT INTO carrera VALUES (137, 35, 21081, 'Ingeniería En Comercio Internacional', 'Ingeniería En Comercio Internacional', '2017-03-17 19:35:48', '2017-03-17 19:35:48');


--
-- Name: carrera_id_seq; Type: SEQUENCE SET; Schema: public; Owner: brojas
--

SELECT pg_catalog.setval('carrera_id_seq', 139, true);


--
-- Data for Name: carrera_sala; Type: TABLE DATA; Schema: public; Owner: brojas
--

INSERT INTO carrera_sala VALUES (200, 53, 3, '2017-02-22 18:48:22', '2017-02-22 18:48:22');
INSERT INTO carrera_sala VALUES (201, 53, 4, '2017-02-22 18:48:22', '2017-02-22 18:48:22');
INSERT INTO carrera_sala VALUES (202, 53, 9, '2017-02-22 18:48:22', '2017-02-22 18:48:22');
INSERT INTO carrera_sala VALUES (203, 53, 10, '2017-02-22 18:48:22', '2017-02-22 18:48:22');
INSERT INTO carrera_sala VALUES (204, 53, 24, '2017-02-22 18:48:22', '2017-02-22 18:48:22');
INSERT INTO carrera_sala VALUES (205, 53, 25, '2017-02-22 18:48:22', '2017-02-22 18:48:22');
INSERT INTO carrera_sala VALUES (206, 53, 26, '2017-02-22 18:48:22', '2017-02-22 18:48:22');
INSERT INTO carrera_sala VALUES (207, 54, 12, '2017-02-22 18:49:09', '2017-02-22 18:49:09');
INSERT INTO carrera_sala VALUES (208, 55, 12, '2017-02-22 18:49:31', '2017-02-22 18:49:31');
INSERT INTO carrera_sala VALUES (209, 56, 27, '2017-02-22 18:50:07', '2017-02-22 18:50:07');
INSERT INTO carrera_sala VALUES (210, 57, 22, '2017-02-22 18:50:34', '2017-02-22 18:50:34');
INSERT INTO carrera_sala VALUES (211, 58, 12, '2017-02-22 18:51:06', '2017-02-22 18:51:06');
INSERT INTO carrera_sala VALUES (212, 59, 12, '2017-02-22 18:51:50', '2017-02-22 18:51:50');
INSERT INTO carrera_sala VALUES (213, 60, 12, '2017-02-22 18:52:19', '2017-02-22 18:52:19');
INSERT INTO carrera_sala VALUES (221, 61, 22, '2017-02-22 18:52:58', '2017-02-22 18:52:58');
INSERT INTO carrera_sala VALUES (223, 63, 3, '2017-02-22 18:53:57', '2017-02-22 18:53:57');
INSERT INTO carrera_sala VALUES (224, 63, 4, '2017-02-22 18:53:57', '2017-02-22 18:53:57');
INSERT INTO carrera_sala VALUES (225, 63, 9, '2017-02-22 18:53:57', '2017-02-22 18:53:57');
INSERT INTO carrera_sala VALUES (226, 63, 10, '2017-02-22 18:53:57', '2017-02-22 18:53:57');
INSERT INTO carrera_sala VALUES (227, 63, 24, '2017-02-22 18:53:57', '2017-02-22 18:53:57');
INSERT INTO carrera_sala VALUES (228, 63, 25, '2017-02-22 18:53:57', '2017-02-22 18:53:57');
INSERT INTO carrera_sala VALUES (229, 63, 26, '2017-02-22 18:53:57', '2017-02-22 18:53:57');
INSERT INTO carrera_sala VALUES (324, 62, 12, '2017-03-09 18:02:54', '2017-03-09 18:02:54');


--
-- Name: carrera_sala_id_seq; Type: SEQUENCE SET; Schema: public; Owner: brojas
--

SELECT pg_catalog.setval('carrera_sala_id_seq', 391, true);


--
-- Data for Name: curso; Type: TABLE DATA; Schema: public; Owner: brojas
--

INSERT INTO curso VALUES (640, 5426, 1, 2017, 411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '5794377', 'no');
INSERT INTO curso VALUES (616, 5384, 1, 2017, 411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '10471648', 'no');
INSERT INTO curso VALUES (617, 5384, 1, 2017, 412, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '5585040', 'no');
INSERT INTO curso VALUES (618, 5384, 1, 2017, 413, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '9666682', 'no');
INSERT INTO curso VALUES (619, 5385, 1, 2017, 411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '14143131', 'no');
INSERT INTO curso VALUES (620, 5386, 1, 2017, 30411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '7257803', 'no');
INSERT INTO curso VALUES (621, 5387, 1, 2017, 411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '6443706', 'no');
INSERT INTO curso VALUES (622, 5388, 1, 2017, 30411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '14143131', 'no');
INSERT INTO curso VALUES (623, 5389, 1, 2017, 30411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '9968958', 'no');
INSERT INTO curso VALUES (626, 5398, 1, 2017, 411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '15997886', 'no');
INSERT INTO curso VALUES (627, 5399, 1, 2017, 30411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '6577123', 'no');
INSERT INTO curso VALUES (628, 5400, 1, 2017, 411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '13551137', 'no');
INSERT INTO curso VALUES (629, 5401, 1, 2017, 30411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '9531367', 'no');
INSERT INTO curso VALUES (630, 5407, 1, 2017, 30411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '13551137', 'no');
INSERT INTO curso VALUES (631, 5408, 1, 2017, 30411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '7606339', 'no');
INSERT INTO curso VALUES (632, 5409, 1, 2017, 30411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '13196151', 'no');
INSERT INTO curso VALUES (633, 5410, 1, 2017, 30411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '7606339', 'no');
INSERT INTO curso VALUES (634, 5418, 1, 2017, 411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '9666682', 'no');
INSERT INTO curso VALUES (635, 5418, 1, 2017, 412, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '10471648', 'no');
INSERT INTO curso VALUES (636, 5418, 1, 2017, 413, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '13905620', 'no');
INSERT INTO curso VALUES (637, 5419, 1, 2017, 30411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '8000412', 'no');
INSERT INTO curso VALUES (638, 5423, 1, 2017, 30411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '7606339', 'no');
INSERT INTO curso VALUES (639, 5425, 1, 2017, 411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '8693477', 'no');
INSERT INTO curso VALUES (641, 5427, 1, 2017, 30411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '8300624', 'no');
INSERT INTO curso VALUES (645, 5441, 1, 2017, 411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '4889256', 'no');
INSERT INTO curso VALUES (646, 5441, 1, 2017, 412, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '9531367', 'no');
INSERT INTO curso VALUES (647, 5441, 1, 2017, 413, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '16641078', 'no');
INSERT INTO curso VALUES (648, 5441, 1, 2017, 414, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '10724980', 'no');
INSERT INTO curso VALUES (649, 5443, 1, 2017, 1231, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '12291295', 'no');
INSERT INTO curso VALUES (650, 5445, 1, 2017, 411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '5585040', 'no');
INSERT INTO curso VALUES (651, 5449, 1, 2017, 411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '6870038', 'no');
INSERT INTO curso VALUES (652, 5450, 1, 2017, 411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '7900209', 'no');
INSERT INTO curso VALUES (653, 5451, 1, 2017, 30411, '2017-03-20 20:57:06', '2017-03-20 20:57:06', '8927189', 'no');
INSERT INTO curso VALUES (654, 5454, 1, 2017, 411, '2017-03-20 20:57:06', '2017-03-20 20:57:06', '15780553', 'no');
INSERT INTO curso VALUES (655, 5455, 1, 2017, 411, '2017-03-20 20:57:06', '2017-03-20 20:57:06', '8927189', 'no');
INSERT INTO curso VALUES (656, 5456, 1, 2017, 30411, '2017-03-20 20:57:06', '2017-03-20 20:57:06', '6870038', 'no');
INSERT INTO curso VALUES (657, 5459, 1, 2017, 411, '2017-03-20 20:57:06', '2017-03-20 20:57:06', '8697837', 'no');
INSERT INTO curso VALUES (658, 5460, 1, 2017, 30411, '2017-03-20 20:57:06', '2017-03-20 20:57:06', '8727547', 'no');
INSERT INTO curso VALUES (659, 5461, 1, 2017, 411, '2017-03-20 20:57:06', '2017-03-20 20:57:06', '13551137', 'no');
INSERT INTO curso VALUES (660, 5464, 1, 2017, 411, '2017-03-20 20:57:06', '2017-03-20 20:57:06', '8693477', 'no');
INSERT INTO curso VALUES (661, 5465, 1, 2017, 411, '2017-03-20 20:57:06', '2017-03-20 20:57:06', '8814653', 'no');
INSERT INTO curso VALUES (662, 5466, 1, 2017, 30411, '2017-03-20 20:57:06', '2017-03-20 20:57:06', '8814653', 'no');
INSERT INTO curso VALUES (663, 5469, 1, 2017, 411, '2017-03-20 20:57:06', '2017-03-20 20:57:06', '9377008', 'no');
INSERT INTO curso VALUES (664, 5470, 1, 2017, 30411, '2017-03-20 20:57:06', '2017-03-20 20:57:06', '8727547', 'no');
INSERT INTO curso VALUES (665, 5472, 1, 2017, 411, '2017-03-20 20:57:06', '2017-03-20 20:57:06', '14569153', 'no');
INSERT INTO curso VALUES (666, 5473, 1, 2017, 30411, '2017-03-20 20:57:06', '2017-03-20 20:57:06', '6577123', 'no');
INSERT INTO curso VALUES (667, 5474, 1, 2017, 30411, '2017-03-20 20:57:06', '2017-03-20 20:57:06', '8000412', 'no');
INSERT INTO curso VALUES (668, 5476, 1, 2017, 411, '2017-03-20 20:57:06', '2017-03-20 20:57:06', '5585040', 'no');
INSERT INTO curso VALUES (642, 5429, 1, 2017, 411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '15780553', '');
INSERT INTO curso VALUES (680, 5543, 1, 1234, 1234, '2017-03-26 18:03:33', '2017-03-26 18:03:33', '6467542', 'no');
INSERT INTO curso VALUES (643, 5435, 1, 2017, 411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '13196151', '18171154');
INSERT INTO curso VALUES (644, 5436, 1, 2017, 30411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '7257803', '17708487');
INSERT INTO curso VALUES (624, 5390, 1, 2017, 411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '17248964', '18171154');
INSERT INTO curso VALUES (625, 5391, 1, 2017, 30411, '2017-03-20 20:57:05', '2017-03-20 20:57:05', '9377008', '18171154');


--
-- Name: curso_id_seq; Type: SEQUENCE SET; Schema: public; Owner: brojas
--

SELECT pg_catalog.setval('curso_id_seq', 680, true);


--
-- Data for Name: departamento; Type: TABLE DATA; Schema: public; Owner: brojas
--

INSERT INTO departamento VALUES (1, 'Informática y Computación', 1, 'Departamento de Informática y Computación
Dirección: José Pedro Alessandri 1242, Ñuñoa
Teléfono: (+56-2) 2787 7211', '2016-12-04 15:34:24.285174', '2016-12-04 15:34:24.285174');
INSERT INTO departamento VALUES (2, 'Industria', 1, 'Departamento de Industria
Dirección: José Pedro Alessandri 1242, Ñuñoa
Teléfono: (+56-2) 2787 7035', '2016-12-04 15:34:34.183888', '2016-12-04 15:34:34.183888');
INSERT INTO departamento VALUES (3, 'Electricidad', 1, 'Departamento de Electricidad
Dirección: José Pedro Alessandri 1242, Ñuñoa
Teléfono: (+56-2) 2787 7119', '2016-12-12 16:47:32.820738', '2016-12-12 16:47:32.820738');
INSERT INTO departamento VALUES (4, 'Mecánica', 1, 'Departamento de MecánicaDirección: José Pedro Alessandri 1242, ÑuñoaTeléfono: (+56-2) 2787 7135', '2016-12-12 16:47:49.999834', '2017-01-22 16:25:15');
INSERT INTO departamento VALUES (29, 'Humanidades', 7, 'Humanidades', '2017-03-16 21:20:38', '2017-03-16 21:20:38');
INSERT INTO departamento VALUES (30, 'Trabajo Social', 7, 'Trabajo Social', '2017-03-16 21:21:21', '2017-03-16 21:21:21');
INSERT INTO departamento VALUES (31, 'Cartografía', 7, 'Cartografía', '2017-03-16 21:21:35', '2017-03-16 21:21:35');
INSERT INTO departamento VALUES (32, 'Diseño', 7, 'Diseño', '2017-03-16 21:21:49', '2017-03-16 21:21:49');
INSERT INTO departamento VALUES (33, 'Planificación y Ordenamiento Territorial', 6, 'Planificación y Ordenamiento Territorial', '2017-03-16 21:22:12', '2017-03-16 21:22:12');
INSERT INTO departamento VALUES (34, 'Ciencias de la Construcción', 6, 'Ciencias de la Construcción', '2017-03-16 21:22:27', '2017-03-16 21:22:27');
INSERT INTO departamento VALUES (35, 'Prevención de Riesgos y Medioambiente', 6, 'Prevención de Riesgos y Medioambiente', '2017-03-16 21:22:46', '2017-03-16 21:22:46');
INSERT INTO departamento VALUES (36, 'Biotecnología', 3, 'Biotecnología', '2017-03-16 21:23:10', '2017-03-16 21:23:10');
INSERT INTO departamento VALUES (37, 'Física', 3, 'Física', '2017-03-16 21:23:30', '2017-03-16 21:23:30');
INSERT INTO departamento VALUES (38, 'Matemática', 3, 'Matemática', '2017-03-16 21:23:43', '2017-03-16 21:23:43');
INSERT INTO departamento VALUES (39, 'Química', 3, 'Química', '2017-03-16 21:23:55', '2017-03-16 21:23:55');
INSERT INTO departamento VALUES (50, 'Estadística y Econometría', 45, 'Estadística y Econometría', '2017-03-17 19:16:20', '2017-03-17 19:16:20');
INSERT INTO departamento VALUES (51, 'Gestión de la Información', 45, 'Gestión de la Información', '2017-03-17 19:16:20', '2017-03-17 19:16:20');
INSERT INTO departamento VALUES (52, 'Contabilidad y Gestión Financiera', 45, 'Contabilidad y Gestión Financiera', '2017-03-17 19:16:20', '2017-03-17 19:16:20');
INSERT INTO departamento VALUES (53, 'Economía, Recursos Naturales y Comercio Internacional', 45, 'Economía, Recursos Naturales y Comercio Internacional', '2017-03-17 19:16:20', '2017-03-17 19:16:20');
INSERT INTO departamento VALUES (54, 'Gestión Organizacional', 45, 'Gestión Organizacional', '2017-03-17 19:16:20', '2017-03-17 19:16:20');


--
-- Name: departamento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: brojas
--

SELECT pg_catalog.setval('departamento_id_seq', 56, true);


--
-- Data for Name: escuela; Type: TABLE DATA; Schema: public; Owner: brojas
--

INSERT INTO escuela VALUES (1, 'Informática', 1, 'Escuela de Informática
Dirección: José Pedro Alessandri 1242, Ñuñoa
Teléfono: (+56-2) 2787 7100', '2016-12-04 15:35:00.159247', '2016-12-04 15:35:00.159247');
INSERT INTO escuela VALUES (2, 'Industria', 2, 'Escuela de Industria
Dirección: José Pedro Alessandri 1242, Ñuñoa
Teléfono: (+56-2) 2787 7073 – 2787 7196', '2016-12-04 16:15:28.06132', '2016-12-04 16:15:28.06132');
INSERT INTO escuela VALUES (3, 'Electrónica', 3, 'Escuela de Electrónica
Dirección: José Pedro Alessandri 1242, Ñuñoa
Teléfono: (+56-2) 2787 7034', '2016-12-12 16:49:07.29276', '2016-12-12 16:49:07.29276');
INSERT INTO escuela VALUES (4, 'Mecánica', 4, 'Escuela de Mecánica
Dirección: José Pedro Alessandri 1242, Ñuñoa
Teléfono: (+56-2) 2787 7169 – 2787 7039 – 2787 7045', '2016-12-12 16:49:31.756333', '2016-12-12 16:49:31.756333');
INSERT INTO escuela VALUES (5, 'Geomensura', 4, 'Escuela de Geomensura
Dirección: José Pedro Alessandri 1242, Ñuñoa
Teléfono: (+56-2) 2787 7111', '2016-12-12 16:52:47.21455', '2016-12-12 16:52:47.21455');
INSERT INTO escuela VALUES (6, 'Transporte y Tránsito', 2, 'Escuela de Transporte y Tránsito
Dirección: José Pedro Alessandri 1242, Ñuñoa
Teléfono: (+56-2) 2787 7157 – 2787 7030', '2016-12-12 16:53:17.000884', '2016-12-12 16:53:17.000884');
INSERT INTO escuela VALUES (14, 'Criminalística Forense', 29, 'Criminalística Forense', '2017-03-16 21:26:31', '2017-03-16 21:26:31');
INSERT INTO escuela VALUES (15, 'Trabajo Social', 30, 'Trabajo Social', '2017-03-16 21:26:56', '2017-03-16 21:26:56');
INSERT INTO escuela VALUES (16, 'Cartografía', 31, 'Cartografía', '2017-03-16 21:27:15', '2017-03-16 21:27:15');
INSERT INTO escuela VALUES (17, 'Diseño', 32, 'Diseño', '2017-03-16 21:27:33', '2017-03-16 21:27:33');
INSERT INTO escuela VALUES (18, 'Arquitectura', 33, 'Arquitectura', '2017-03-16 21:27:58', '2017-03-16 21:27:58');
INSERT INTO escuela VALUES (19, 'Construcción Civil', 34, 'Construcción Civil', '2017-03-16 21:28:22', '2017-03-16 21:28:22');
INSERT INTO escuela VALUES (20, 'Prevención de Riesgos y Medio Ambiente', 35, 'Prevención de Riesgos y Medio Ambiente', '2017-03-16 21:28:41', '2017-03-16 21:28:41');
INSERT INTO escuela VALUES (21, 'Química', 39, 'Química', '2017-03-16 21:29:05', '2017-03-16 21:29:05');
INSERT INTO escuela VALUES (22, 'Ingeniería en Industria Alimentaria', 39, 'Ingeniería en Industria Alimentaria', '2017-03-16 21:29:19', '2017-03-16 21:29:19');
INSERT INTO escuela VALUES (28, 'Ingeniería en Industria de la Madera', 2, 'Ingeniería en Industria de la Madera', '2017-03-16 21:31:47', '2017-03-16 21:31:47');
INSERT INTO escuela VALUES (34, 'Administración', 54, 'Administración', '2017-03-17 19:19:37', '2017-03-17 19:19:37');
INSERT INTO escuela VALUES (35, 'Comercio Internacional', 53, 'Comercio Internacional', '2017-03-17 19:19:37', '2017-03-17 19:19:37');
INSERT INTO escuela VALUES (36, 'Contadores Auditores', 52, 'Contadores Auditores', '2017-03-17 19:19:37', '2017-03-17 19:19:37');
INSERT INTO escuela VALUES (37, 'Bibliotecología', 51, 'Bibliotecología', '2017-03-17 19:19:37', '2017-03-17 19:19:37');
INSERT INTO escuela VALUES (38, 'Ingeniería Comercial', 50, 'Ingeniería Comercial', '2017-03-17 19:19:37', '2017-03-17 19:19:37');


--
-- Name: escuela_id_seq; Type: SEQUENCE SET; Schema: public; Owner: brojas
--

SELECT pg_catalog.setval('escuela_id_seq', 39, true);


--
-- Data for Name: estacion_trabajo; Type: TABLE DATA; Schema: public; Owner: brojas
--

INSERT INTO estacion_trabajo VALUES (692, '1', 'si', 12, '2017-02-15 18:29:04', '2017-02-15 18:29:04', 1);
INSERT INTO estacion_trabajo VALUES (693, '2', 'si', 12, '2017-02-15 18:29:04', '2017-02-15 18:29:04', 1);
INSERT INTO estacion_trabajo VALUES (694, '3', 'si', 12, '2017-02-15 18:29:04', '2017-02-15 18:29:04', 1);
INSERT INTO estacion_trabajo VALUES (695, '4', 'si', 12, '2017-02-15 18:29:04', '2017-02-15 18:29:04', 1);
INSERT INTO estacion_trabajo VALUES (696, '5', 'si', 12, '2017-02-15 18:29:04', '2017-02-15 18:29:04', 1);
INSERT INTO estacion_trabajo VALUES (697, '6', 'si', 12, '2017-02-15 18:29:04', '2017-02-15 18:29:04', 1);
INSERT INTO estacion_trabajo VALUES (698, '1', 'si', 12, '2017-02-15 18:29:04', '2017-02-15 18:29:04', 2);
INSERT INTO estacion_trabajo VALUES (699, '2', 'si', 12, '2017-02-15 18:29:04', '2017-02-15 18:29:04', 2);
INSERT INTO estacion_trabajo VALUES (700, '3', 'si', 12, '2017-02-15 18:29:04', '2017-02-15 18:29:04', 2);
INSERT INTO estacion_trabajo VALUES (701, '4', 'si', 12, '2017-02-15 18:29:04', '2017-02-15 18:29:04', 2);
INSERT INTO estacion_trabajo VALUES (702, '5', 'si', 12, '2017-02-15 18:29:04', '2017-02-15 18:29:04', 2);
INSERT INTO estacion_trabajo VALUES (703, '6', 'si', 12, '2017-02-15 18:29:04', '2017-02-15 18:29:04', 2);
INSERT INTO estacion_trabajo VALUES (704, '1', 'si', 12, '2017-02-15 18:29:04', '2017-02-15 18:29:04', 3);
INSERT INTO estacion_trabajo VALUES (705, '2', 'si', 12, '2017-02-15 18:29:04', '2017-02-15 18:29:04', 3);
INSERT INTO estacion_trabajo VALUES (706, '3', 'si', 12, '2017-02-15 18:29:04', '2017-02-15 18:29:04', 3);
INSERT INTO estacion_trabajo VALUES (707, '4', 'si', 12, '2017-02-15 18:29:04', '2017-02-15 18:29:04', 3);
INSERT INTO estacion_trabajo VALUES (708, '5', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 3);
INSERT INTO estacion_trabajo VALUES (709, '6', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 3);
INSERT INTO estacion_trabajo VALUES (710, '1', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 4);
INSERT INTO estacion_trabajo VALUES (711, '2', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 4);
INSERT INTO estacion_trabajo VALUES (712, '3', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 4);
INSERT INTO estacion_trabajo VALUES (713, '4', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 4);
INSERT INTO estacion_trabajo VALUES (714, '5', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 4);
INSERT INTO estacion_trabajo VALUES (715, '6', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 4);
INSERT INTO estacion_trabajo VALUES (716, '1', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 5);
INSERT INTO estacion_trabajo VALUES (717, '2', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 5);
INSERT INTO estacion_trabajo VALUES (718, '3', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 5);
INSERT INTO estacion_trabajo VALUES (719, '4', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 5);
INSERT INTO estacion_trabajo VALUES (720, '5', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 5);
INSERT INTO estacion_trabajo VALUES (721, '6', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 5);
INSERT INTO estacion_trabajo VALUES (722, '1', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 6);
INSERT INTO estacion_trabajo VALUES (723, '2', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 6);
INSERT INTO estacion_trabajo VALUES (724, '3', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 6);
INSERT INTO estacion_trabajo VALUES (725, '4', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 6);
INSERT INTO estacion_trabajo VALUES (726, '5', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 6);
INSERT INTO estacion_trabajo VALUES (727, '6', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 6);
INSERT INTO estacion_trabajo VALUES (728, '1', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 7);
INSERT INTO estacion_trabajo VALUES (729, '2', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 7);
INSERT INTO estacion_trabajo VALUES (730, '3', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 7);
INSERT INTO estacion_trabajo VALUES (731, '4', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 7);
INSERT INTO estacion_trabajo VALUES (732, '5', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 7);
INSERT INTO estacion_trabajo VALUES (733, '6', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 7);
INSERT INTO estacion_trabajo VALUES (734, '1', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 8);
INSERT INTO estacion_trabajo VALUES (735, '2', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 8);
INSERT INTO estacion_trabajo VALUES (736, '3', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 8);
INSERT INTO estacion_trabajo VALUES (737, '4', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 8);
INSERT INTO estacion_trabajo VALUES (738, '5', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 8);
INSERT INTO estacion_trabajo VALUES (739, '6', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 8);
INSERT INTO estacion_trabajo VALUES (740, '1', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 9);
INSERT INTO estacion_trabajo VALUES (741, '2', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 9);
INSERT INTO estacion_trabajo VALUES (742, '3', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 9);
INSERT INTO estacion_trabajo VALUES (743, '4', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 9);
INSERT INTO estacion_trabajo VALUES (744, '5', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 9);
INSERT INTO estacion_trabajo VALUES (745, '6', 'si', 12, '2017-02-15 18:29:05', '2017-02-15 18:29:05', 9);
INSERT INTO estacion_trabajo VALUES (830, '4', 'si', 26, '2017-02-15 18:31:06', '2017-02-15 18:31:06', 1);
INSERT INTO estacion_trabajo VALUES (831, '5', 'si', 26, '2017-02-15 18:31:06', '2017-02-15 18:31:06', 1);
INSERT INTO estacion_trabajo VALUES (835, '4', 'si', 26, '2017-02-15 18:31:06', '2017-02-15 18:31:06', 2);
INSERT INTO estacion_trabajo VALUES (836, '5', 'si', 26, '2017-02-15 18:31:06', '2017-02-15 18:31:06', 2);
INSERT INTO estacion_trabajo VALUES (840, '4', 'si', 26, '2017-02-15 18:31:06', '2017-02-15 18:31:06', 3);
INSERT INTO estacion_trabajo VALUES (841, '5', 'si', 26, '2017-02-15 18:31:06', '2017-02-15 18:31:06', 3);
INSERT INTO estacion_trabajo VALUES (845, '4', 'si', 26, '2017-02-15 18:31:06', '2017-02-15 18:31:06', 4);
INSERT INTO estacion_trabajo VALUES (846, '5', 'si', 26, '2017-02-15 18:31:06', '2017-02-15 18:31:06', 4);
INSERT INTO estacion_trabajo VALUES (850, '4', 'si', 26, '2017-02-15 18:31:06', '2017-02-15 18:31:06', 5);
INSERT INTO estacion_trabajo VALUES (851, '5', 'si', 26, '2017-02-15 18:31:06', '2017-02-15 18:31:06', 5);
INSERT INTO estacion_trabajo VALUES (855, '4', 'si', 26, '2017-02-15 18:31:06', '2017-02-15 18:31:06', 6);
INSERT INTO estacion_trabajo VALUES (856, '5', 'si', 26, '2017-02-15 18:31:06', '2017-02-15 18:31:06', 6);
INSERT INTO estacion_trabajo VALUES (860, '4', 'si', 26, '2017-02-15 18:31:06', '2017-02-15 18:31:06', 7);
INSERT INTO estacion_trabajo VALUES (861, '5', 'si', 26, '2017-02-15 18:31:06', '2017-02-15 18:31:06', 7);
INSERT INTO estacion_trabajo VALUES (865, '4', 'si', 26, '2017-02-15 18:31:06', '2017-02-15 18:31:06', 8);
INSERT INTO estacion_trabajo VALUES (866, '5', 'si', 26, '2017-02-15 18:31:06', '2017-02-15 18:31:06', 8);
INSERT INTO estacion_trabajo VALUES (870, '4', 'si', 26, '2017-02-15 18:31:06', '2017-02-15 18:31:06', 9);
INSERT INTO estacion_trabajo VALUES (871, '5', 'si', 26, '2017-02-15 18:31:06', '2017-02-15 18:31:06', 9);
INSERT INTO estacion_trabajo VALUES (782, '1', 'si', 24, '2017-02-15 18:30:43', '2017-02-15 18:30:43', 1);
INSERT INTO estacion_trabajo VALUES (784, '3', 'si', 24, '2017-02-15 18:30:44', '2017-02-15 18:30:44', 1);
INSERT INTO estacion_trabajo VALUES (785, '1', 'si', 24, '2017-02-15 18:30:44', '2017-02-15 18:30:44', 2);
INSERT INTO estacion_trabajo VALUES (787, '3', 'si', 24, '2017-02-15 18:30:44', '2017-02-15 18:30:44', 2);
INSERT INTO estacion_trabajo VALUES (788, '1', 'si', 24, '2017-02-15 18:30:44', '2017-02-15 18:30:44', 3);
INSERT INTO estacion_trabajo VALUES (789, '2', 'si', 24, '2017-02-15 18:30:44', '2017-03-03 15:41:58', 3);
INSERT INTO estacion_trabajo VALUES (786, '2', 'si', 24, '2017-02-15 18:30:44', '2017-03-03 15:41:58', 2);
INSERT INTO estacion_trabajo VALUES (790, '3', 'si', 24, '2017-02-15 18:30:44', '2017-02-15 18:30:44', 3);
INSERT INTO estacion_trabajo VALUES (837, '1', 'si', 26, '2017-02-15 18:31:06', '2017-03-27 19:59:59', 3);
INSERT INTO estacion_trabajo VALUES (842, '1', 'si', 26, '2017-02-15 18:31:06', '2017-03-27 19:59:59', 4);
INSERT INTO estacion_trabajo VALUES (847, '1', 'si', 26, '2017-02-15 18:31:06', '2017-03-27 19:59:59', 5);
INSERT INTO estacion_trabajo VALUES (852, '1', 'si', 26, '2017-02-15 18:31:06', '2017-03-27 19:59:59', 6);
INSERT INTO estacion_trabajo VALUES (857, '1', 'si', 26, '2017-02-15 18:31:06', '2017-03-27 19:59:59', 7);
INSERT INTO estacion_trabajo VALUES (862, '1', 'si', 26, '2017-02-15 18:31:06', '2017-03-27 19:59:59', 8);
INSERT INTO estacion_trabajo VALUES (867, '1', 'si', 26, '2017-02-15 18:31:06', '2017-03-27 19:59:59', 9);
INSERT INTO estacion_trabajo VALUES (829, '3', 'si', 26, '2017-02-15 18:31:06', '2017-03-27 19:59:59', 1);
INSERT INTO estacion_trabajo VALUES (839, '3', 'si', 26, '2017-02-15 18:31:06', '2017-03-27 19:59:59', 3);
INSERT INTO estacion_trabajo VALUES (844, '3', 'si', 26, '2017-02-15 18:31:06', '2017-03-27 19:59:59', 4);
INSERT INTO estacion_trabajo VALUES (849, '3', 'si', 26, '2017-02-15 18:31:06', '2017-03-27 19:59:59', 5);
INSERT INTO estacion_trabajo VALUES (854, '3', 'si', 26, '2017-02-15 18:31:06', '2017-03-27 19:59:59', 6);
INSERT INTO estacion_trabajo VALUES (859, '3', 'si', 26, '2017-02-15 18:31:06', '2017-03-27 19:59:59', 7);
INSERT INTO estacion_trabajo VALUES (864, '3', 'si', 26, '2017-02-15 18:31:06', '2017-03-27 19:59:59', 8);
INSERT INTO estacion_trabajo VALUES (869, '3', 'si', 26, '2017-02-15 18:31:06', '2017-03-27 19:59:59', 9);
INSERT INTO estacion_trabajo VALUES (828, '2', 'si', 26, '2017-02-15 18:31:06', '2017-03-27 19:59:59', 1);
INSERT INTO estacion_trabajo VALUES (833, '2', 'si', 26, '2017-02-15 18:31:06', '2017-03-27 19:59:59', 2);
INSERT INTO estacion_trabajo VALUES (838, '2', 'si', 26, '2017-02-15 18:31:06', '2017-03-27 19:59:59', 3);
INSERT INTO estacion_trabajo VALUES (843, '2', 'si', 26, '2017-02-15 18:31:06', '2017-03-27 19:59:59', 4);
INSERT INTO estacion_trabajo VALUES (848, '2', 'si', 26, '2017-02-15 18:31:06', '2017-03-27 19:59:59', 5);
INSERT INTO estacion_trabajo VALUES (853, '2', 'si', 26, '2017-02-15 18:31:06', '2017-03-27 19:59:59', 6);
INSERT INTO estacion_trabajo VALUES (858, '2', 'si', 26, '2017-02-15 18:31:06', '2017-03-27 19:59:59', 7);
INSERT INTO estacion_trabajo VALUES (863, '2', 'si', 26, '2017-02-15 18:31:06', '2017-03-27 20:00:00', 8);
INSERT INTO estacion_trabajo VALUES (868, '2', 'si', 26, '2017-02-15 18:31:06', '2017-03-27 20:00:00', 9);
INSERT INTO estacion_trabajo VALUES (832, '1', 'si', 26, '2017-02-15 18:31:06', '2017-03-27 19:59:59', 2);
INSERT INTO estacion_trabajo VALUES (791, '1', 'si', 24, '2017-02-15 18:30:44', '2017-02-15 18:30:44', 4);
INSERT INTO estacion_trabajo VALUES (793, '3', 'si', 24, '2017-02-15 18:30:44', '2017-02-15 18:30:44', 4);
INSERT INTO estacion_trabajo VALUES (794, '1', 'si', 24, '2017-02-15 18:30:44', '2017-02-15 18:30:44', 5);
INSERT INTO estacion_trabajo VALUES (796, '3', 'si', 24, '2017-02-15 18:30:44', '2017-02-15 18:30:44', 5);
INSERT INTO estacion_trabajo VALUES (797, '1', 'si', 24, '2017-02-15 18:30:44', '2017-02-15 18:30:44', 6);
INSERT INTO estacion_trabajo VALUES (799, '3', 'si', 24, '2017-02-15 18:30:44', '2017-02-15 18:30:44', 6);
INSERT INTO estacion_trabajo VALUES (800, '1', 'si', 24, '2017-02-15 18:30:44', '2017-02-15 18:30:44', 7);
INSERT INTO estacion_trabajo VALUES (802, '3', 'si', 24, '2017-02-15 18:30:44', '2017-02-15 18:30:44', 7);
INSERT INTO estacion_trabajo VALUES (803, '1', 'si', 24, '2017-02-15 18:30:44', '2017-02-15 18:30:44', 8);
INSERT INTO estacion_trabajo VALUES (805, '3', 'si', 24, '2017-02-15 18:30:44', '2017-02-15 18:30:44', 8);
INSERT INTO estacion_trabajo VALUES (806, '1', 'si', 24, '2017-02-15 18:30:44', '2017-02-15 18:30:44', 9);
INSERT INTO estacion_trabajo VALUES (808, '3', 'si', 24, '2017-02-15 18:30:44', '2017-02-15 18:30:44', 9);
INSERT INTO estacion_trabajo VALUES (424, '5', 'si', 3, '2017-02-15 17:23:20', '2017-02-25 17:01:20', 2);
INSERT INTO estacion_trabajo VALUES (431, '5', 'si', 3, '2017-02-15 17:23:20', '2017-02-25 17:01:20', 3);
INSERT INTO estacion_trabajo VALUES (438, '5', 'si', 3, '2017-02-15 17:23:20', '2017-02-25 17:01:20', 4);
INSERT INTO estacion_trabajo VALUES (452, '5', 'si', 3, '2017-02-15 17:23:20', '2017-02-25 17:01:21', 6);
INSERT INTO estacion_trabajo VALUES (473, '5', 'si', 3, '2017-02-15 17:23:20', '2017-02-25 17:01:21', 9);
INSERT INTO estacion_trabajo VALUES (430, '4', 'si', 3, '2017-02-15 17:23:20', '2017-02-25 17:01:21', 3);
INSERT INTO estacion_trabajo VALUES (437, '4', 'si', 3, '2017-02-15 17:23:20', '2017-02-25 17:01:21', 4);
INSERT INTO estacion_trabajo VALUES (447, '7', 'si', 3, '2017-02-15 17:23:20', '2017-02-25 17:01:21', 5);
INSERT INTO estacion_trabajo VALUES (451, '4', 'si', 3, '2017-02-15 17:23:20', '2017-02-25 17:01:21', 6);
INSERT INTO estacion_trabajo VALUES (454, '7', 'si', 3, '2017-02-15 17:23:20', '2017-02-25 17:01:21', 6);
INSERT INTO estacion_trabajo VALUES (458, '4', 'si', 3, '2017-02-15 17:23:20', '2017-02-25 17:01:21', 7);
INSERT INTO estacion_trabajo VALUES (416, '4', 'si', 3, '2017-02-15 17:23:20', '2017-02-25 17:01:21', 1);
INSERT INTO estacion_trabajo VALUES (419, '7', 'si', 3, '2017-02-15 17:23:20', '2017-02-25 17:01:21', 1);
INSERT INTO estacion_trabajo VALUES (551, '4', 'si', 9, '2017-02-15 17:23:34', '2017-02-25 20:42:23', 1);
INSERT INTO estacion_trabajo VALUES (417, '5', 'si', 3, '2017-02-15 17:23:20', '2017-02-25 17:01:20', 1);
INSERT INTO estacion_trabajo VALUES (549, '2', 'si', 9, '2017-02-15 17:23:34', '2017-02-25 20:42:23', 1);
INSERT INTO estacion_trabajo VALUES (630, '2', 'si', 10, '2017-02-15 17:23:41', '2017-02-21 18:43:28', 1);
INSERT INTO estacion_trabajo VALUES (632, '4', 'si', 10, '2017-02-15 17:23:41', '2017-02-21 18:43:28', 1);
INSERT INTO estacion_trabajo VALUES (633, '5', 'si', 10, '2017-02-15 17:23:41', '2017-02-21 18:43:28', 1);
INSERT INTO estacion_trabajo VALUES (634, '6', 'si', 10, '2017-02-15 17:23:41', '2017-02-21 18:43:28', 1);
INSERT INTO estacion_trabajo VALUES (635, '7', 'si', 10, '2017-02-15 17:23:41', '2017-02-21 18:43:28', 1);
INSERT INTO estacion_trabajo VALUES (636, '1', 'si', 10, '2017-02-15 17:23:41', '2017-02-21 18:43:28', 2);
INSERT INTO estacion_trabajo VALUES (637, '2', 'si', 10, '2017-02-15 17:23:41', '2017-02-21 18:43:28', 2);
INSERT INTO estacion_trabajo VALUES (638, '3', 'si', 10, '2017-02-15 17:23:41', '2017-02-21 18:43:28', 2);
INSERT INTO estacion_trabajo VALUES (640, '5', 'si', 10, '2017-02-15 17:23:41', '2017-02-21 18:43:28', 2);
INSERT INTO estacion_trabajo VALUES (641, '6', 'si', 10, '2017-02-15 17:23:41', '2017-02-21 18:43:28', 2);
INSERT INTO estacion_trabajo VALUES (642, '7', 'si', 10, '2017-02-15 17:23:41', '2017-02-21 18:43:28', 2);
INSERT INTO estacion_trabajo VALUES (643, '1', 'si', 10, '2017-02-15 17:23:41', '2017-02-21 18:43:28', 3);
INSERT INTO estacion_trabajo VALUES (472, '4', 'si', 3, '2017-02-15 17:23:20', '2017-02-25 17:01:21', 9);
INSERT INTO estacion_trabajo VALUES (475, '7', 'si', 3, '2017-02-15 17:23:20', '2017-02-25 17:01:21', 9);
INSERT INTO estacion_trabajo VALUES (423, '4', 'si', 3, '2017-02-15 17:23:20', '2017-02-25 17:01:21', 2);
INSERT INTO estacion_trabajo VALUES (555, '8', 'si', 9, '2017-02-15 17:23:34', '2017-02-25 20:42:23', 1);
INSERT INTO estacion_trabajo VALUES (468, '7', 'si', 3, '2017-02-15 17:23:20', '2017-02-25 17:01:21', 8);
INSERT INTO estacion_trabajo VALUES (558, '2', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:23', 2);
INSERT INTO estacion_trabajo VALUES (560, '4', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:23', 2);
INSERT INTO estacion_trabajo VALUES (561, '5', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:23', 2);
INSERT INTO estacion_trabajo VALUES (564, '8', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:23', 2);
INSERT INTO estacion_trabajo VALUES (565, '9', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:23', 2);
INSERT INTO estacion_trabajo VALUES (567, '2', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:23', 3);
INSERT INTO estacion_trabajo VALUES (569, '4', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:23', 3);
INSERT INTO estacion_trabajo VALUES (570, '5', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:23', 3);
INSERT INTO estacion_trabajo VALUES (572, '7', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:23', 3);
INSERT INTO estacion_trabajo VALUES (573, '8', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:23', 3);
INSERT INTO estacion_trabajo VALUES (574, '9', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:23', 3);
INSERT INTO estacion_trabajo VALUES (576, '2', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:23', 4);
INSERT INTO estacion_trabajo VALUES (578, '4', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:23', 4);
INSERT INTO estacion_trabajo VALUES (579, '5', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:23', 4);
INSERT INTO estacion_trabajo VALUES (583, '9', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:23', 4);
INSERT INTO estacion_trabajo VALUES (585, '2', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:23', 5);
INSERT INTO estacion_trabajo VALUES (587, '4', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:23', 5);
INSERT INTO estacion_trabajo VALUES (588, '5', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:23', 5);
INSERT INTO estacion_trabajo VALUES (590, '7', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:23', 5);
INSERT INTO estacion_trabajo VALUES (568, '3', 'si', 9, '2017-02-15 17:23:35', '2017-03-02 18:40:39', 3);
INSERT INTO estacion_trabajo VALUES (557, '1', 'si', 9, '2017-02-15 17:23:35', '2017-03-02 18:40:39', 2);
INSERT INTO estacion_trabajo VALUES (566, '1', 'si', 9, '2017-02-15 17:23:35', '2017-03-02 18:40:39', 3);
INSERT INTO estacion_trabajo VALUES (575, '1', 'si', 9, '2017-02-15 17:23:35', '2017-03-02 18:40:39', 4);
INSERT INTO estacion_trabajo VALUES (584, '1', 'si', 9, '2017-02-15 17:23:35', '2017-03-02 18:40:39', 5);
INSERT INTO estacion_trabajo VALUES (418, '6', 'si', 3, '2017-02-15 17:23:20', '2017-03-07 00:00:00', 1);
INSERT INTO estacion_trabajo VALUES (432, '6', 'si', 3, '2017-02-15 17:23:20', '2017-03-07 00:00:00', 3);
INSERT INTO estacion_trabajo VALUES (439, '6', 'si', 3, '2017-02-15 17:23:20', '2017-03-07 00:00:00', 4);
INSERT INTO estacion_trabajo VALUES (446, '6', 'si', 3, '2017-02-15 17:23:20', '2017-03-07 00:00:00', 5);
INSERT INTO estacion_trabajo VALUES (453, '6', 'si', 3, '2017-02-15 17:23:20', '2017-03-07 00:00:00', 6);
INSERT INTO estacion_trabajo VALUES (460, '6', 'si', 3, '2017-02-15 17:23:20', '2017-03-07 00:00:00', 7);
INSERT INTO estacion_trabajo VALUES (474, '6', 'si', 3, '2017-02-15 17:23:20', '2017-03-07 00:00:00', 9);
INSERT INTO estacion_trabajo VALUES (421, '2', 'si', 3, '2017-02-15 17:23:20', '2017-03-07 00:00:00', 2);
INSERT INTO estacion_trabajo VALUES (428, '2', 'si', 3, '2017-02-15 17:23:20', '2017-03-07 00:00:00', 3);
INSERT INTO estacion_trabajo VALUES (435, '2', 'si', 3, '2017-02-15 17:23:20', '2017-03-07 00:00:00', 4);
INSERT INTO estacion_trabajo VALUES (456, '2', 'si', 3, '2017-02-15 17:23:20', '2017-03-07 00:00:00', 7);
INSERT INTO estacion_trabajo VALUES (470, '2', 'si', 3, '2017-02-15 17:23:20', '2017-03-07 00:00:00', 9);
INSERT INTO estacion_trabajo VALUES (442, '2', 'si', 3, '2017-02-15 17:23:20', '2017-03-07 00:00:00', 5);
INSERT INTO estacion_trabajo VALUES (592, '9', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:23', 5);
INSERT INTO estacion_trabajo VALUES (594, '2', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:23', 6);
INSERT INTO estacion_trabajo VALUES (596, '4', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:23', 6);
INSERT INTO estacion_trabajo VALUES (589, '6', 'si', 9, '2017-02-15 17:23:35', '2017-03-01 00:00:00', 5);
INSERT INTO estacion_trabajo VALUES (798, '2', 'si', 24, '2017-02-15 18:30:44', '2017-03-03 15:41:58', 6);
INSERT INTO estacion_trabajo VALUES (801, '2', 'si', 24, '2017-02-15 18:30:44', '2017-03-03 15:41:58', 7);
INSERT INTO estacion_trabajo VALUES (804, '2', 'si', 24, '2017-02-15 18:30:44', '2017-03-03 15:41:58', 8);
INSERT INTO estacion_trabajo VALUES (807, '2', 'si', 24, '2017-02-15 18:30:44', '2017-03-03 15:41:58', 9);
INSERT INTO estacion_trabajo VALUES (580, '6', 'si', 9, '2017-02-15 17:23:35', '2017-03-01 00:00:00', 4);
INSERT INTO estacion_trabajo VALUES (792, '2', 'si', 24, '2017-02-15 18:30:44', '2017-03-03 15:41:58', 4);
INSERT INTO estacion_trabajo VALUES (597, '5', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:23', 6);
INSERT INTO estacion_trabajo VALUES (600, '8', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:23', 6);
INSERT INTO estacion_trabajo VALUES (601, '9', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:23', 6);
INSERT INTO estacion_trabajo VALUES (603, '2', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:24', 7);
INSERT INTO estacion_trabajo VALUES (605, '4', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:24', 7);
INSERT INTO estacion_trabajo VALUES (608, '7', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:24', 7);
INSERT INTO estacion_trabajo VALUES (609, '8', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:24', 7);
INSERT INTO estacion_trabajo VALUES (612, '2', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:24', 8);
INSERT INTO estacion_trabajo VALUES (450, '3', 'si', 3, '2017-02-15 17:23:20', '2017-04-03 00:00:00', 6);
INSERT INTO estacion_trabajo VALUES (457, '3', 'si', 3, '2017-02-15 17:23:20', '2017-04-03 00:00:00', 7);
INSERT INTO estacion_trabajo VALUES (464, '3', 'si', 3, '2017-02-15 17:23:20', '2017-04-03 00:00:00', 8);
INSERT INTO estacion_trabajo VALUES (471, '3', 'si', 3, '2017-02-15 17:23:20', '2017-04-03 00:00:00', 9);
INSERT INTO estacion_trabajo VALUES (415, '3', 'si', 3, '2017-02-15 17:23:20', '2017-04-03 00:00:00', 1);
INSERT INTO estacion_trabajo VALUES (434, '1', 'si', 3, '2017-02-15 17:23:20', '2017-04-03 00:00:00', 4);
INSERT INTO estacion_trabajo VALUES (441, '1', 'si', 3, '2017-02-15 17:23:20', '2017-04-03 00:00:00', 5);
INSERT INTO estacion_trabajo VALUES (455, '1', 'si', 3, '2017-02-15 17:23:20', '2017-04-03 00:00:00', 7);
INSERT INTO estacion_trabajo VALUES (614, '4', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:24', 8);
INSERT INTO estacion_trabajo VALUES (615, '5', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:24', 8);
INSERT INTO estacion_trabajo VALUES (617, '7', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:24', 8);
INSERT INTO estacion_trabajo VALUES (618, '8', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:24', 8);
INSERT INTO estacion_trabajo VALUES (619, '9', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:24', 8);
INSERT INTO estacion_trabajo VALUES (621, '2', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:24', 9);
INSERT INTO estacion_trabajo VALUES (623, '4', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:24', 9);
INSERT INTO estacion_trabajo VALUES (624, '5', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:24', 9);
INSERT INTO estacion_trabajo VALUES (628, '9', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:24', 9);
INSERT INTO estacion_trabajo VALUES (554, '7', 'si', 9, '2017-02-15 17:23:34', '2017-02-25 20:42:23', 1);
INSERT INTO estacion_trabajo VALUES (644, '2', 'si', 10, '2017-02-15 17:23:41', '2017-02-21 18:43:28', 3);
INSERT INTO estacion_trabajo VALUES (645, '3', 'si', 10, '2017-02-15 17:23:41', '2017-02-21 18:43:28', 3);
INSERT INTO estacion_trabajo VALUES (646, '4', 'si', 10, '2017-02-15 17:23:41', '2017-02-21 18:43:28', 3);
INSERT INTO estacion_trabajo VALUES (647, '5', 'si', 10, '2017-02-15 17:23:41', '2017-02-21 18:43:29', 3);
INSERT INTO estacion_trabajo VALUES (648, '6', 'si', 10, '2017-02-15 17:23:41', '2017-02-21 18:43:29', 3);
INSERT INTO estacion_trabajo VALUES (649, '7', 'si', 10, '2017-02-15 17:23:41', '2017-02-21 18:43:29', 3);
INSERT INTO estacion_trabajo VALUES (651, '2', 'si', 10, '2017-02-15 17:23:41', '2017-02-21 18:43:29', 4);
INSERT INTO estacion_trabajo VALUES (652, '3', 'si', 10, '2017-02-15 17:23:41', '2017-02-21 18:43:29', 4);
INSERT INTO estacion_trabajo VALUES (653, '4', 'si', 10, '2017-02-15 17:23:41', '2017-02-21 18:43:29', 4);
INSERT INTO estacion_trabajo VALUES (654, '5', 'si', 10, '2017-02-15 17:23:41', '2017-02-21 18:43:29', 4);
INSERT INTO estacion_trabajo VALUES (655, '6', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 4);
INSERT INTO estacion_trabajo VALUES (656, '7', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 4);
INSERT INTO estacion_trabajo VALUES (657, '1', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 5);
INSERT INTO estacion_trabajo VALUES (659, '3', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 5);
INSERT INTO estacion_trabajo VALUES (660, '4', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 5);
INSERT INTO estacion_trabajo VALUES (661, '5', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 5);
INSERT INTO estacion_trabajo VALUES (662, '6', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 5);
INSERT INTO estacion_trabajo VALUES (663, '7', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 5);
INSERT INTO estacion_trabajo VALUES (664, '1', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 6);
INSERT INTO estacion_trabajo VALUES (665, '2', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 6);
INSERT INTO estacion_trabajo VALUES (666, '3', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 6);
INSERT INTO estacion_trabajo VALUES (667, '4', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 6);
INSERT INTO estacion_trabajo VALUES (668, '5', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 6);
INSERT INTO estacion_trabajo VALUES (669, '6', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 6);
INSERT INTO estacion_trabajo VALUES (671, '1', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 7);
INSERT INTO estacion_trabajo VALUES (672, '2', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 7);
INSERT INTO estacion_trabajo VALUES (673, '3', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 7);
INSERT INTO estacion_trabajo VALUES (674, '4', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 7);
INSERT INTO estacion_trabajo VALUES (675, '5', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 7);
INSERT INTO estacion_trabajo VALUES (676, '6', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 7);
INSERT INTO estacion_trabajo VALUES (678, '1', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 8);
INSERT INTO estacion_trabajo VALUES (629, '1', 'si', 10, '2017-02-15 17:23:41', '2017-02-21 18:43:29', 1);
INSERT INTO estacion_trabajo VALUES (639, '4', 'si', 10, '2017-02-15 17:23:41', '2017-02-21 18:43:29', 2);
INSERT INTO estacion_trabajo VALUES (658, '2', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 5);
INSERT INTO estacion_trabajo VALUES (677, '7', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 7);
INSERT INTO estacion_trabajo VALUES (679, '2', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 8);
INSERT INTO estacion_trabajo VALUES (680, '3', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 8);
INSERT INTO estacion_trabajo VALUES (681, '4', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 8);
INSERT INTO estacion_trabajo VALUES (682, '5', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 8);
INSERT INTO estacion_trabajo VALUES (683, '6', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 8);
INSERT INTO estacion_trabajo VALUES (684, '7', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 8);
INSERT INTO estacion_trabajo VALUES (685, '1', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 9);
INSERT INTO estacion_trabajo VALUES (687, '3', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 9);
INSERT INTO estacion_trabajo VALUES (631, '3', 'si', 10, '2017-02-15 17:23:41', '2017-02-21 18:43:28', 1);
INSERT INTO estacion_trabajo VALUES (650, '1', 'si', 10, '2017-02-15 17:23:41', '2017-02-21 18:43:29', 4);
INSERT INTO estacion_trabajo VALUES (670, '7', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 6);
INSERT INTO estacion_trabajo VALUES (686, '2', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 9);
INSERT INTO estacion_trabajo VALUES (688, '4', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 9);
INSERT INTO estacion_trabajo VALUES (689, '5', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 9);
INSERT INTO estacion_trabajo VALUES (690, '6', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 9);
INSERT INTO estacion_trabajo VALUES (691, '7', 'si', 10, '2017-02-15 17:23:42', '2017-02-21 18:43:29', 9);
INSERT INTO estacion_trabajo VALUES (809, '1', 'si', 25, '2017-02-15 18:30:55', '2017-02-21 18:44:35', 1);
INSERT INTO estacion_trabajo VALUES (826, '2', 'si', 25, '2017-02-15 18:30:55', '2017-02-21 18:49:44', 9);
INSERT INTO estacion_trabajo VALUES (811, '1', 'si', 25, '2017-02-15 18:30:55', '2017-02-21 18:44:35', 2);
INSERT INTO estacion_trabajo VALUES (813, '1', 'si', 25, '2017-02-15 18:30:55', '2017-02-21 18:44:35', 3);
INSERT INTO estacion_trabajo VALUES (815, '1', 'si', 25, '2017-02-15 18:30:55', '2017-02-21 18:44:35', 4);
INSERT INTO estacion_trabajo VALUES (817, '1', 'si', 25, '2017-02-15 18:30:55', '2017-02-21 18:44:35', 5);
INSERT INTO estacion_trabajo VALUES (819, '1', 'si', 25, '2017-02-15 18:30:55', '2017-02-21 18:44:35', 6);
INSERT INTO estacion_trabajo VALUES (821, '1', 'si', 25, '2017-02-15 18:30:55', '2017-02-21 18:44:35', 7);
INSERT INTO estacion_trabajo VALUES (823, '1', 'si', 25, '2017-02-15 18:30:55', '2017-02-21 18:44:35', 8);
INSERT INTO estacion_trabajo VALUES (825, '1', 'si', 25, '2017-02-15 18:30:55', '2017-02-21 18:44:35', 9);
INSERT INTO estacion_trabajo VALUES (810, '2', 'si', 25, '2017-02-15 18:30:55', '2017-02-21 18:49:44', 1);
INSERT INTO estacion_trabajo VALUES (812, '2', 'si', 25, '2017-02-15 18:30:55', '2017-02-21 18:49:44', 2);
INSERT INTO estacion_trabajo VALUES (814, '2', 'si', 25, '2017-02-15 18:30:55', '2017-02-21 18:49:44', 3);
INSERT INTO estacion_trabajo VALUES (816, '2', 'si', 25, '2017-02-15 18:30:55', '2017-02-21 18:49:44', 4);
INSERT INTO estacion_trabajo VALUES (818, '2', 'si', 25, '2017-02-15 18:30:55', '2017-02-21 18:49:44', 5);
INSERT INTO estacion_trabajo VALUES (820, '2', 'si', 25, '2017-02-15 18:30:55', '2017-02-21 18:49:44', 6);
INSERT INTO estacion_trabajo VALUES (822, '2', 'si', 25, '2017-02-15 18:30:55', '2017-02-21 18:49:44', 7);
INSERT INTO estacion_trabajo VALUES (824, '2', 'si', 25, '2017-02-15 18:30:55', '2017-02-21 18:49:44', 8);
INSERT INTO estacion_trabajo VALUES (926, '1', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 1);
INSERT INTO estacion_trabajo VALUES (927, '2', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 1);
INSERT INTO estacion_trabajo VALUES (928, '3', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 1);
INSERT INTO estacion_trabajo VALUES (929, '4', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 1);
INSERT INTO estacion_trabajo VALUES (930, '1', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 2);
INSERT INTO estacion_trabajo VALUES (931, '2', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 2);
INSERT INTO estacion_trabajo VALUES (932, '3', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 2);
INSERT INTO estacion_trabajo VALUES (622, '3', 'si', 9, '2017-02-15 17:23:35', '2017-03-02 18:40:39', 9);
INSERT INTO estacion_trabajo VALUES (593, '1', 'si', 9, '2017-02-15 17:23:35', '2017-03-02 18:40:39', 6);
INSERT INTO estacion_trabajo VALUES (602, '1', 'si', 9, '2017-02-15 17:23:35', '2017-03-02 18:40:39', 7);
INSERT INTO estacion_trabajo VALUES (611, '1', 'si', 9, '2017-02-15 17:23:35', '2017-03-02 18:40:39', 8);
INSERT INTO estacion_trabajo VALUES (933, '4', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 2);
INSERT INTO estacion_trabajo VALUES (934, '1', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 3);
INSERT INTO estacion_trabajo VALUES (935, '2', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 3);
INSERT INTO estacion_trabajo VALUES (936, '3', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 3);
INSERT INTO estacion_trabajo VALUES (616, '6', 'si', 9, '2017-02-15 17:23:35', '2017-03-01 00:00:00', 8);
INSERT INTO estacion_trabajo VALUES (625, '6', 'si', 9, '2017-02-15 17:23:35', '2017-03-01 00:00:00', 9);
INSERT INTO estacion_trabajo VALUES (553, '6', 'si', 9, '2017-02-15 17:23:34', '2017-03-01 00:00:00', 1);
INSERT INTO estacion_trabajo VALUES (607, '6', 'si', 9, '2017-02-15 17:23:35', '2017-03-01 00:00:00', 7);
INSERT INTO estacion_trabajo VALUES (937, '4', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 3);
INSERT INTO estacion_trabajo VALUES (938, '1', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 4);
INSERT INTO estacion_trabajo VALUES (939, '2', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 4);
INSERT INTO estacion_trabajo VALUES (940, '3', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 4);
INSERT INTO estacion_trabajo VALUES (941, '4', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 4);
INSERT INTO estacion_trabajo VALUES (461, '7', 'si', 3, '2017-02-15 17:23:20', '2017-02-25 17:01:21', 7);
INSERT INTO estacion_trabajo VALUES (445, '5', 'si', 3, '2017-02-15 17:23:20', '2017-02-25 17:01:21', 5);
INSERT INTO estacion_trabajo VALUES (606, '5', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:24', 7);
INSERT INTO estacion_trabajo VALUES (466, '5', 'si', 3, '2017-02-15 17:23:20', '2017-02-25 17:01:21', 8);
INSERT INTO estacion_trabajo VALUES (626, '7', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:24', 9);
INSERT INTO estacion_trabajo VALUES (552, '5', 'si', 9, '2017-02-15 17:23:34', '2017-02-25 20:42:24', 1);
INSERT INTO estacion_trabajo VALUES (591, '8', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:24', 5);
INSERT INTO estacion_trabajo VALUES (610, '9', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:24', 7);
INSERT INTO estacion_trabajo VALUES (563, '7', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:24', 2);
INSERT INTO estacion_trabajo VALUES (942, '1', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 5);
INSERT INTO estacion_trabajo VALUES (943, '2', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 5);
INSERT INTO estacion_trabajo VALUES (944, '3', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 5);
INSERT INTO estacion_trabajo VALUES (945, '4', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 5);
INSERT INTO estacion_trabajo VALUES (946, '1', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 6);
INSERT INTO estacion_trabajo VALUES (947, '2', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 6);
INSERT INTO estacion_trabajo VALUES (948, '3', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 6);
INSERT INTO estacion_trabajo VALUES (949, '4', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 6);
INSERT INTO estacion_trabajo VALUES (950, '1', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 7);
INSERT INTO estacion_trabajo VALUES (951, '2', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 7);
INSERT INTO estacion_trabajo VALUES (952, '3', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 7);
INSERT INTO estacion_trabajo VALUES (953, '4', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 7);
INSERT INTO estacion_trabajo VALUES (954, '1', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 8);
INSERT INTO estacion_trabajo VALUES (955, '2', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 8);
INSERT INTO estacion_trabajo VALUES (956, '3', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 8);
INSERT INTO estacion_trabajo VALUES (957, '4', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 8);
INSERT INTO estacion_trabajo VALUES (958, '1', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 9);
INSERT INTO estacion_trabajo VALUES (959, '2', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 9);
INSERT INTO estacion_trabajo VALUES (960, '3', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 9);
INSERT INTO estacion_trabajo VALUES (961, '4', 'si', 22, '2017-02-23 20:24:36', '2017-02-23 20:24:36', 9);
INSERT INTO estacion_trabajo VALUES (1007, '1', 'si', 27, '2017-02-23 21:04:27', '2017-02-23 21:04:27', 1);
INSERT INTO estacion_trabajo VALUES (1008, '2', 'si', 27, '2017-02-23 21:04:27', '2017-02-23 21:04:27', 1);
INSERT INTO estacion_trabajo VALUES (1009, '3', 'si', 27, '2017-02-23 21:04:27', '2017-02-23 21:04:27', 1);
INSERT INTO estacion_trabajo VALUES (1010, '1', 'si', 27, '2017-02-23 21:04:27', '2017-02-23 21:04:27', 2);
INSERT INTO estacion_trabajo VALUES (1011, '2', 'si', 27, '2017-02-23 21:04:27', '2017-02-23 21:04:27', 2);
INSERT INTO estacion_trabajo VALUES (1012, '3', 'si', 27, '2017-02-23 21:04:27', '2017-02-23 21:04:27', 2);
INSERT INTO estacion_trabajo VALUES (1013, '1', 'si', 27, '2017-02-23 21:04:27', '2017-02-23 21:04:27', 3);
INSERT INTO estacion_trabajo VALUES (1014, '2', 'si', 27, '2017-02-23 21:04:27', '2017-02-23 21:04:27', 3);
INSERT INTO estacion_trabajo VALUES (1015, '3', 'si', 27, '2017-02-23 21:04:27', '2017-02-23 21:04:27', 3);
INSERT INTO estacion_trabajo VALUES (1016, '1', 'si', 27, '2017-02-23 21:04:27', '2017-02-23 21:04:27', 4);
INSERT INTO estacion_trabajo VALUES (1017, '2', 'si', 27, '2017-02-23 21:04:27', '2017-02-23 21:04:27', 4);
INSERT INTO estacion_trabajo VALUES (1018, '3', 'si', 27, '2017-02-23 21:04:27', '2017-02-23 21:04:27', 4);
INSERT INTO estacion_trabajo VALUES (1019, '1', 'si', 27, '2017-02-23 21:04:27', '2017-02-23 21:04:27', 5);
INSERT INTO estacion_trabajo VALUES (1020, '2', 'si', 27, '2017-02-23 21:04:27', '2017-02-23 21:04:27', 5);
INSERT INTO estacion_trabajo VALUES (1021, '3', 'si', 27, '2017-02-23 21:04:27', '2017-02-23 21:04:27', 5);
INSERT INTO estacion_trabajo VALUES (1022, '1', 'si', 27, '2017-02-23 21:04:27', '2017-02-23 21:04:27', 6);
INSERT INTO estacion_trabajo VALUES (1023, '2', 'si', 27, '2017-02-23 21:04:27', '2017-02-23 21:04:27', 6);
INSERT INTO estacion_trabajo VALUES (1024, '3', 'si', 27, '2017-02-23 21:04:27', '2017-02-23 21:04:27', 6);
INSERT INTO estacion_trabajo VALUES (1025, '1', 'si', 27, '2017-02-23 21:04:27', '2017-02-23 21:04:27', 7);
INSERT INTO estacion_trabajo VALUES (1026, '2', 'si', 27, '2017-02-23 21:04:27', '2017-02-23 21:04:27', 7);
INSERT INTO estacion_trabajo VALUES (1027, '3', 'si', 27, '2017-02-23 21:04:27', '2017-02-23 21:04:27', 7);
INSERT INTO estacion_trabajo VALUES (1028, '1', 'si', 27, '2017-02-23 21:04:27', '2017-02-23 21:04:27', 8);
INSERT INTO estacion_trabajo VALUES (1029, '2', 'si', 27, '2017-02-23 21:04:27', '2017-02-23 21:04:27', 8);
INSERT INTO estacion_trabajo VALUES (1030, '3', 'si', 27, '2017-02-23 21:04:27', '2017-02-23 21:04:27', 8);
INSERT INTO estacion_trabajo VALUES (1031, '1', 'si', 27, '2017-02-23 21:04:27', '2017-02-23 21:04:27', 9);
INSERT INTO estacion_trabajo VALUES (1032, '2', 'si', 27, '2017-02-23 21:04:27', '2017-02-23 21:04:27', 9);
INSERT INTO estacion_trabajo VALUES (1033, '3', 'si', 27, '2017-02-23 21:04:27', '2017-02-23 21:04:27', 9);
INSERT INTO estacion_trabajo VALUES (599, '7', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:24', 6);
INSERT INTO estacion_trabajo VALUES (581, '7', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:24', 4);
INSERT INTO estacion_trabajo VALUES (459, '5', 'si', 3, '2017-02-15 17:23:20', '2017-02-25 17:01:21', 7);
INSERT INTO estacion_trabajo VALUES (444, '4', 'si', 3, '2017-02-15 17:23:20', '2017-02-25 17:01:21', 5);
INSERT INTO estacion_trabajo VALUES (440, '7', 'si', 3, '2017-02-15 17:23:20', '2017-02-25 17:01:21', 4);
INSERT INTO estacion_trabajo VALUES (433, '7', 'si', 3, '2017-02-15 17:23:20', '2017-02-25 17:01:21', 3);
INSERT INTO estacion_trabajo VALUES (426, '7', 'si', 3, '2017-02-15 17:23:20', '2017-02-25 17:01:21', 2);
INSERT INTO estacion_trabajo VALUES (465, '4', 'si', 3, '2017-02-15 17:23:20', '2017-02-25 17:01:21', 8);
INSERT INTO estacion_trabajo VALUES (582, '8', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:24', 4);
INSERT INTO estacion_trabajo VALUES (627, '8', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:24', 9);
INSERT INTO estacion_trabajo VALUES (556, '9', 'si', 9, '2017-02-15 17:23:35', '2017-02-25 20:42:24', 1);
INSERT INTO estacion_trabajo VALUES (1034, '1', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 2);
INSERT INTO estacion_trabajo VALUES (1035, '2', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 2);
INSERT INTO estacion_trabajo VALUES (1037, '4', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 2);
INSERT INTO estacion_trabajo VALUES (1038, '5', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 2);
INSERT INTO estacion_trabajo VALUES (1039, '1', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 3);
INSERT INTO estacion_trabajo VALUES (1040, '2', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 3);
INSERT INTO estacion_trabajo VALUES (1042, '4', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 3);
INSERT INTO estacion_trabajo VALUES (1043, '5', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 3);
INSERT INTO estacion_trabajo VALUES (1044, '1', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 4);
INSERT INTO estacion_trabajo VALUES (1045, '2', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 4);
INSERT INTO estacion_trabajo VALUES (1047, '4', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 4);
INSERT INTO estacion_trabajo VALUES (1048, '5', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 4);
INSERT INTO estacion_trabajo VALUES (1049, '1', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 5);
INSERT INTO estacion_trabajo VALUES (1050, '2', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 5);
INSERT INTO estacion_trabajo VALUES (1052, '4', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 5);
INSERT INTO estacion_trabajo VALUES (1053, '5', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 5);
INSERT INTO estacion_trabajo VALUES (1054, '1', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 6);
INSERT INTO estacion_trabajo VALUES (586, '3', 'si', 9, '2017-02-15 17:23:35', '2017-03-02 18:40:39', 5);
INSERT INTO estacion_trabajo VALUES (577, '3', 'si', 9, '2017-02-15 17:23:35', '2017-03-02 18:40:39', 4);
INSERT INTO estacion_trabajo VALUES (559, '3', 'si', 9, '2017-02-15 17:23:35', '2017-03-02 18:40:39', 2);
INSERT INTO estacion_trabajo VALUES (604, '3', 'si', 9, '2017-02-15 17:23:35', '2017-03-02 18:40:39', 7);
INSERT INTO estacion_trabajo VALUES (620, '1', 'si', 9, '2017-02-15 17:23:35', '2017-03-02 18:40:39', 9);
INSERT INTO estacion_trabajo VALUES (548, '1', 'si', 9, '2017-02-15 17:23:34', '2017-03-02 18:40:39', 1);
INSERT INTO estacion_trabajo VALUES (425, '6', 'si', 3, '2017-02-15 17:23:20', '2017-03-07 00:00:00', 2);
INSERT INTO estacion_trabajo VALUES (414, '2', 'si', 3, '2017-02-15 17:23:20', '2017-03-07 00:00:00', 1);
INSERT INTO estacion_trabajo VALUES (1055, '2', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 6);
INSERT INTO estacion_trabajo VALUES (1057, '4', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 6);
INSERT INTO estacion_trabajo VALUES (1058, '5', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 6);
INSERT INTO estacion_trabajo VALUES (1059, '1', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 7);
INSERT INTO estacion_trabajo VALUES (1060, '2', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 7);
INSERT INTO estacion_trabajo VALUES (1062, '4', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 7);
INSERT INTO estacion_trabajo VALUES (1063, '5', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 7);
INSERT INTO estacion_trabajo VALUES (1064, '1', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 8);
INSERT INTO estacion_trabajo VALUES (1065, '2', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 8);
INSERT INTO estacion_trabajo VALUES (1067, '4', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 8);
INSERT INTO estacion_trabajo VALUES (1068, '5', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 8);
INSERT INTO estacion_trabajo VALUES (1069, '1', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 9);
INSERT INTO estacion_trabajo VALUES (1070, '2', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 9);
INSERT INTO estacion_trabajo VALUES (1072, '4', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 9);
INSERT INTO estacion_trabajo VALUES (1073, '5', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 9);
INSERT INTO estacion_trabajo VALUES (1074, '1', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 1);
INSERT INTO estacion_trabajo VALUES (1075, '2', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 1);
INSERT INTO estacion_trabajo VALUES (1077, '4', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 1);
INSERT INTO estacion_trabajo VALUES (1078, '5', 'si', 4, '2017-02-27 14:54:24', '2017-02-27 14:54:24', 1);
INSERT INTO estacion_trabajo VALUES (550, '3', 'si', 9, '2017-02-15 17:23:34', '2017-03-02 18:40:39', 1);
INSERT INTO estacion_trabajo VALUES (613, '3', 'si', 9, '2017-02-15 17:23:35', '2017-03-02 18:40:39', 8);
INSERT INTO estacion_trabajo VALUES (595, '3', 'si', 9, '2017-02-15 17:23:35', '2017-03-02 18:40:39', 6);
INSERT INTO estacion_trabajo VALUES (449, '2', 'si', 3, '2017-02-15 17:23:20', '2017-03-07 00:00:00', 6);
INSERT INTO estacion_trabajo VALUES (467, '6', 'si', 3, '2017-02-15 17:23:20', '2017-03-07 00:00:00', 8);
INSERT INTO estacion_trabajo VALUES (463, '2', 'si', 3, '2017-02-15 17:23:20', '2017-03-07 00:00:00', 8);
INSERT INTO estacion_trabajo VALUES (795, '2', 'si', 24, '2017-02-15 18:30:44', '2017-03-03 15:41:58', 5);
INSERT INTO estacion_trabajo VALUES (783, '2', 'si', 24, '2017-02-15 18:30:44', '2017-03-03 15:41:58', 1);
INSERT INTO estacion_trabajo VALUES (571, '6', 'si', 9, '2017-02-15 17:23:35', '2017-03-01 00:00:00', 3);
INSERT INTO estacion_trabajo VALUES (598, '6', 'si', 9, '2017-02-15 17:23:35', '2017-03-01 00:00:00', 6);
INSERT INTO estacion_trabajo VALUES (562, '6', 'si', 9, '2017-02-15 17:23:35', '2017-03-01 00:00:00', 2);
INSERT INTO estacion_trabajo VALUES (827, '1', 'si', 26, '2017-02-15 18:31:06', '2017-03-27 20:00:00', 1);
INSERT INTO estacion_trabajo VALUES (834, '3', 'si', 26, '2017-02-15 18:31:06', '2017-03-27 20:00:00', 2);
INSERT INTO estacion_trabajo VALUES (1046, '3', 'si', 4, '2017-02-27 14:54:24', '2017-04-03 00:00:00', 4);
INSERT INTO estacion_trabajo VALUES (1041, '3', 'si', 4, '2017-02-27 14:54:24', '2017-04-03 00:00:00', 3);
INSERT INTO estacion_trabajo VALUES (1036, '3', 'si', 4, '2017-02-27 14:54:24', '2017-04-03 00:00:00', 2);
INSERT INTO estacion_trabajo VALUES (1051, '3', 'si', 4, '2017-02-27 14:54:24', '2017-04-03 00:00:00', 5);
INSERT INTO estacion_trabajo VALUES (1056, '3', 'si', 4, '2017-02-27 14:54:24', '2017-04-03 00:00:00', 6);
INSERT INTO estacion_trabajo VALUES (1061, '3', 'si', 4, '2017-02-27 14:54:24', '2017-04-03 00:00:00', 7);
INSERT INTO estacion_trabajo VALUES (1066, '3', 'si', 4, '2017-02-27 14:54:24', '2017-04-03 00:00:00', 8);
INSERT INTO estacion_trabajo VALUES (1071, '3', 'si', 4, '2017-02-27 14:54:24', '2017-04-03 00:00:00', 9);
INSERT INTO estacion_trabajo VALUES (1076, '3', 'si', 4, '2017-02-27 14:54:24', '2017-04-03 00:00:00', 1);
INSERT INTO estacion_trabajo VALUES (443, '3', 'si', 3, '2017-02-15 17:23:20', '2017-04-03 00:00:00', 5);
INSERT INTO estacion_trabajo VALUES (422, '3', 'si', 3, '2017-02-15 17:23:20', '2017-04-03 00:00:00', 2);
INSERT INTO estacion_trabajo VALUES (429, '3', 'si', 3, '2017-02-15 17:23:20', '2017-04-03 00:00:00', 3);
INSERT INTO estacion_trabajo VALUES (436, '3', 'si', 3, '2017-02-15 17:23:20', '2017-04-03 00:00:00', 4);
INSERT INTO estacion_trabajo VALUES (469, '1', 'si', 3, '2017-02-15 17:23:20', '2017-04-03 00:00:00', 9);
INSERT INTO estacion_trabajo VALUES (462, '1', 'si', 3, '2017-02-15 17:23:20', '2017-04-03 00:00:00', 8);
INSERT INTO estacion_trabajo VALUES (420, '1', 'si', 3, '2017-02-15 17:23:20', '2017-04-03 00:00:00', 2);
INSERT INTO estacion_trabajo VALUES (413, '1', 'si', 3, '2017-02-15 17:23:20', '2017-04-03 00:00:00', 1);
INSERT INTO estacion_trabajo VALUES (427, '1', 'si', 3, '2017-02-15 17:23:20', '2017-04-03 00:00:00', 3);
INSERT INTO estacion_trabajo VALUES (448, '1', 'si', 3, '2017-02-15 17:23:20', '2017-04-03 00:00:00', 6);


--
-- Name: estacion_trabajo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: brojas
--

SELECT pg_catalog.setval('estacion_trabajo_id_seq', 1411, true);


--
-- Data for Name: facultad; Type: TABLE DATA; Schema: public; Owner: brojas
--

INSERT INTO facultad VALUES (1, 'Facultad de Ingeniería', 1, 'FACING', '2016-12-04 15:33:18.403204', '2017-03-17 15:09:23');
INSERT INTO facultad VALUES (3, 'Facultad de Ciencias Naturales, Matemática y del Medio Ambiente', 1, 'FACCNMMA', '2016-12-12 16:41:58.380799', '2017-03-17 15:09:50');
INSERT INTO facultad VALUES (5, 'Casa Central', 3, 'Casa Central', '2016-12-12 16:43:12.497186', '2017-03-17 15:10:28');
INSERT INTO facultad VALUES (6, 'Facultad de Ciencias de la Construcción y Ordenamiento Territorial', 3, 'FACCCOT', '2016-12-12 16:43:38.14185', '2017-03-17 15:10:59');
INSERT INTO facultad VALUES (7, 'Facultad de Humanidades y Tecnologías de la Comunicación Social', 3, 'FACHTCS', '2016-12-12 16:44:07.754673', '2017-03-17 15:11:24');
INSERT INTO facultad VALUES (45, 'Facultad de Administración y Economía', 2, 'FAE', '2017-03-17 19:15:31', '2017-03-17 19:20:41');


--
-- Name: facultad_id_seq; Type: SEQUENCE SET; Schema: public; Owner: brojas
--

SELECT pg_catalog.setval('facultad_id_seq', 47, true);


--
-- Data for Name: horario; Type: TABLE DATA; Schema: public; Owner: brojas
--

INSERT INTO horario VALUES (1203, '2017-04-03', 3, 6, 643, '13196151', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1204, '2017-04-10', 3, 6, 643, '13196151', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1205, '2017-04-17', 3, 6, 643, '13196151', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1206, '2017-04-24', 3, 6, 643, '13196151', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1207, '2017-05-01', 3, 6, 643, '13196151', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1208, '2017-05-08', 3, 6, 643, '13196151', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1209, '2017-05-15', 3, 6, 643, '13196151', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1210, '2017-05-22', 3, 6, 643, '13196151', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1211, '2017-05-29', 3, 6, 643, '13196151', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1212, '2017-06-05', 3, 6, 643, '13196151', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1213, '2017-06-12', 3, 6, 643, '13196151', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1214, '2017-06-19', 3, 6, 643, '13196151', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1215, '2017-06-26', 3, 6, 643, '13196151', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1216, '2017-07-03', 3, 6, 643, '13196151', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1287, '2017-04-08', 3, 2, 645, '4889256', 'semestral', '2017-04-08 00:00:00', '2017-04-08 00:00:00', 'si', 'docente', 'sabado');
INSERT INTO horario VALUES (1288, '2017-04-15', 3, 2, 645, '4889256', 'semestral', '2017-04-15 00:00:00', '2017-04-15 00:00:00', 'si', 'docente', 'sabado');
INSERT INTO horario VALUES (1289, '2017-04-22', 3, 2, 645, '4889256', 'semestral', '2017-04-22 00:00:00', '2017-04-22 00:00:00', 'si', 'docente', 'sabado');
INSERT INTO horario VALUES (1290, '2017-04-29', 3, 2, 645, '4889256', 'semestral', '2017-04-29 00:00:00', '2017-04-29 00:00:00', 'si', 'docente', 'sabado');
INSERT INTO horario VALUES (1291, '2017-05-06', 3, 2, 645, '4889256', 'semestral', '2017-05-06 00:00:00', '2017-05-06 00:00:00', 'si', 'docente', 'sabado');
INSERT INTO horario VALUES (1292, '2017-05-13', 3, 2, 645, '4889256', 'semestral', '2017-05-13 00:00:00', '2017-05-13 00:00:00', 'si', 'docente', 'sabado');
INSERT INTO horario VALUES (1293, '2017-05-20', 3, 2, 645, '4889256', 'semestral', '2017-05-20 00:00:00', '2017-05-20 00:00:00', 'si', 'docente', 'sabado');
INSERT INTO horario VALUES (1294, '2017-05-27', 3, 2, 645, '4889256', 'semestral', '2017-05-27 00:00:00', '2017-05-27 00:00:00', 'si', 'docente', 'sabado');
INSERT INTO horario VALUES (1295, '2017-06-03', 3, 2, 645, '4889256', 'semestral', '2017-06-03 00:00:00', '2017-06-03 00:00:00', 'si', 'docente', 'sabado');
INSERT INTO horario VALUES (1296, '2017-06-10', 3, 2, 645, '4889256', 'semestral', '2017-06-10 00:00:00', '2017-06-10 00:00:00', 'si', 'docente', 'sabado');
INSERT INTO horario VALUES (1297, '2017-06-17', 3, 2, 645, '4889256', 'semestral', '2017-06-17 00:00:00', '2017-06-17 00:00:00', 'si', 'docente', 'sabado');
INSERT INTO horario VALUES (1298, '2017-06-24', 3, 2, 645, '4889256', 'semestral', '2017-06-24 00:00:00', '2017-06-24 00:00:00', 'si', 'docente', 'sabado');
INSERT INTO horario VALUES (1299, '2017-07-01', 3, 2, 645, '4889256', 'semestral', '2017-07-01 00:00:00', '2017-07-01 00:00:00', 'si', 'docente', 'sabado');
INSERT INTO horario VALUES (1300, '2017-04-06', 3, 1, 642, '15780553', 'semestral', '2017-04-06 00:00:00', '2017-04-06 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1301, '2017-04-13', 3, 1, 642, '15780553', 'semestral', '2017-04-13 00:00:00', '2017-04-13 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1302, '2017-04-20', 3, 1, 642, '15780553', 'semestral', '2017-04-20 00:00:00', '2017-04-20 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1303, '2017-04-27', 3, 1, 642, '15780553', 'semestral', '2017-04-27 00:00:00', '2017-04-27 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1304, '2017-05-04', 3, 1, 642, '15780553', 'semestral', '2017-05-04 00:00:00', '2017-05-04 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1305, '2017-05-11', 3, 1, 642, '15780553', 'semestral', '2017-05-11 00:00:00', '2017-05-11 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1306, '2017-05-18', 3, 1, 642, '15780553', 'semestral', '2017-05-18 00:00:00', '2017-05-18 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1307, '2017-05-25', 3, 1, 642, '15780553', 'semestral', '2017-05-25 00:00:00', '2017-05-25 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1308, '2017-06-01', 3, 1, 642, '15780553', 'semestral', '2017-06-01 00:00:00', '2017-06-01 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1309, '2017-06-08', 3, 1, 642, '15780553', 'semestral', '2017-06-08 00:00:00', '2017-06-08 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1310, '2017-06-15', 3, 1, 642, '15780553', 'semestral', '2017-06-15 00:00:00', '2017-06-15 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1311, '2017-06-22', 3, 1, 642, '15780553', 'semestral', '2017-06-22 00:00:00', '2017-06-22 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1312, '2017-06-29', 3, 1, 642, '15780553', 'semestral', '2017-06-29 00:00:00', '2017-06-29 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1313, '2017-07-06', 3, 1, 642, '15780553', 'semestral', '2017-07-06 00:00:00', '2017-07-06 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1314, '2017-04-07', 3, 3, 644, '7257803', 'semestral', '2017-04-07 00:00:00', '2017-04-07 00:00:00', 'si', 'docente', 'viernes');
INSERT INTO horario VALUES (1315, '2017-04-14', 3, 3, 644, '7257803', 'semestral', '2017-04-14 00:00:00', '2017-04-14 00:00:00', 'si', 'docente', 'viernes');
INSERT INTO horario VALUES (1316, '2017-04-21', 3, 3, 644, '7257803', 'semestral', '2017-04-21 00:00:00', '2017-04-21 00:00:00', 'si', 'docente', 'viernes');
INSERT INTO horario VALUES (1317, '2017-04-28', 3, 3, 644, '7257803', 'semestral', '2017-04-28 00:00:00', '2017-04-28 00:00:00', 'si', 'docente', 'viernes');
INSERT INTO horario VALUES (1318, '2017-05-05', 3, 3, 644, '7257803', 'semestral', '2017-05-05 00:00:00', '2017-05-05 00:00:00', 'si', 'docente', 'viernes');
INSERT INTO horario VALUES (1319, '2017-05-12', 3, 3, 644, '7257803', 'semestral', '2017-05-12 00:00:00', '2017-05-12 00:00:00', 'si', 'docente', 'viernes');
INSERT INTO horario VALUES (1320, '2017-05-19', 3, 3, 644, '7257803', 'semestral', '2017-05-19 00:00:00', '2017-05-19 00:00:00', 'si', 'docente', 'viernes');
INSERT INTO horario VALUES (1321, '2017-05-26', 3, 3, 644, '7257803', 'semestral', '2017-05-26 00:00:00', '2017-05-26 00:00:00', 'si', 'docente', 'viernes');
INSERT INTO horario VALUES (1322, '2017-06-02', 3, 3, 644, '7257803', 'semestral', '2017-06-02 00:00:00', '2017-06-02 00:00:00', 'si', 'docente', 'viernes');
INSERT INTO horario VALUES (1217, '2017-04-06', 3, 6, 640, '5794377', 'semestral', '2017-04-06 00:00:00', '2017-04-06 00:00:00', 'no', 'docente', 'jueves');
INSERT INTO horario VALUES (1218, '2017-04-13', 3, 6, 640, '5794377', 'semestral', '2017-04-13 00:00:00', '2017-04-13 00:00:00', 'no', 'docente', 'jueves');
INSERT INTO horario VALUES (1219, '2017-04-20', 3, 6, 640, '5794377', 'semestral', '2017-04-20 00:00:00', '2017-04-20 00:00:00', 'no', 'docente', 'jueves');
INSERT INTO horario VALUES (1220, '2017-04-27', 3, 6, 640, '5794377', 'semestral', '2017-04-27 00:00:00', '2017-04-27 00:00:00', 'no', 'docente', 'jueves');
INSERT INTO horario VALUES (1221, '2017-05-04', 3, 6, 640, '5794377', 'semestral', '2017-05-04 00:00:00', '2017-05-04 00:00:00', 'no', 'docente', 'jueves');
INSERT INTO horario VALUES (1222, '2017-05-11', 3, 6, 640, '5794377', 'semestral', '2017-05-11 00:00:00', '2017-05-11 00:00:00', 'no', 'docente', 'jueves');
INSERT INTO horario VALUES (1223, '2017-05-18', 3, 6, 640, '5794377', 'semestral', '2017-05-18 00:00:00', '2017-05-18 00:00:00', 'no', 'docente', 'jueves');
INSERT INTO horario VALUES (1224, '2017-05-25', 3, 6, 640, '5794377', 'semestral', '2017-05-25 00:00:00', '2017-05-25 00:00:00', 'no', 'docente', 'jueves');
INSERT INTO horario VALUES (1225, '2017-06-01', 3, 6, 640, '5794377', 'semestral', '2017-06-01 00:00:00', '2017-06-01 00:00:00', 'no', 'docente', 'jueves');
INSERT INTO horario VALUES (1226, '2017-06-08', 3, 6, 640, '5794377', 'semestral', '2017-06-08 00:00:00', '2017-06-08 00:00:00', 'no', 'docente', 'jueves');
INSERT INTO horario VALUES (1227, '2017-06-15', 3, 6, 640, '5794377', 'semestral', '2017-06-15 00:00:00', '2017-06-15 00:00:00', 'no', 'docente', 'jueves');
INSERT INTO horario VALUES (1228, '2017-06-22', 3, 6, 640, '5794377', 'semestral', '2017-06-22 00:00:00', '2017-06-22 00:00:00', 'no', 'docente', 'jueves');
INSERT INTO horario VALUES (1229, '2017-06-29', 3, 6, 640, '5794377', 'semestral', '2017-06-29 00:00:00', '2017-06-29 00:00:00', 'no', 'docente', 'jueves');
INSERT INTO horario VALUES (1230, '2017-07-06', 3, 6, 640, '5794377', 'semestral', '2017-07-06 00:00:00', '2017-07-06 00:00:00', 'no', 'docente', 'jueves');
INSERT INTO horario VALUES (1323, '2017-06-09', 3, 3, 644, '7257803', 'semestral', '2017-06-09 00:00:00', '2017-06-09 00:00:00', 'si', 'docente', 'viernes');
INSERT INTO horario VALUES (1324, '2017-06-16', 3, 3, 644, '7257803', 'semestral', '2017-06-16 00:00:00', '2017-06-16 00:00:00', 'si', 'docente', 'viernes');
INSERT INTO horario VALUES (1325, '2017-06-23', 3, 3, 644, '7257803', 'semestral', '2017-06-23 00:00:00', '2017-06-23 00:00:00', 'si', 'docente', 'viernes');
INSERT INTO horario VALUES (1326, '2017-06-30', 3, 3, 644, '7257803', 'semestral', '2017-06-30 00:00:00', '2017-06-30 00:00:00', 'si', 'docente', 'viernes');
INSERT INTO horario VALUES (1327, '2017-07-07', 3, 3, 644, '7257803', 'semestral', '2017-07-07 00:00:00', '2017-07-07 00:00:00', 'si', 'docente', 'viernes');
INSERT INTO horario VALUES (1231, '2017-04-05', 3, 6, 618, '9666682', 'semestral', '2017-04-05 00:00:00', '2017-04-05 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1232, '2017-04-12', 3, 6, 618, '9666682', 'semestral', '2017-04-12 00:00:00', '2017-04-12 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1233, '2017-04-19', 3, 6, 618, '9666682', 'semestral', '2017-04-19 00:00:00', '2017-04-19 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1234, '2017-04-26', 3, 6, 618, '9666682', 'semestral', '2017-04-26 00:00:00', '2017-04-26 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1235, '2017-05-03', 3, 6, 618, '9666682', 'semestral', '2017-05-03 00:00:00', '2017-05-03 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1236, '2017-05-10', 3, 6, 618, '9666682', 'semestral', '2017-05-10 00:00:00', '2017-05-10 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1237, '2017-05-17', 3, 6, 618, '9666682', 'semestral', '2017-05-17 00:00:00', '2017-05-17 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1238, '2017-05-24', 3, 6, 618, '9666682', 'semestral', '2017-05-24 00:00:00', '2017-05-24 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1239, '2017-05-31', 3, 6, 618, '9666682', 'semestral', '2017-05-31 00:00:00', '2017-05-31 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1240, '2017-06-07', 3, 6, 618, '9666682', 'semestral', '2017-06-07 00:00:00', '2017-06-07 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1241, '2017-06-14', 3, 6, 618, '9666682', 'semestral', '2017-06-14 00:00:00', '2017-06-14 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1242, '2017-06-21', 3, 6, 618, '9666682', 'semestral', '2017-06-21 00:00:00', '2017-06-21 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1243, '2017-06-28', 3, 6, 618, '9666682', 'semestral', '2017-06-28 00:00:00', '2017-06-28 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1244, '2017-07-05', 3, 6, 618, '9666682', 'semestral', '2017-07-05 00:00:00', '2017-07-05 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1328, '2017-04-05', 3, 5, 644, '7257803', 'semestral', '2017-04-05 00:00:00', '2017-04-05 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1329, '2017-04-12', 3, 5, 644, '7257803', 'semestral', '2017-04-12 00:00:00', '2017-04-12 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1330, '2017-04-19', 3, 5, 644, '7257803', 'semestral', '2017-04-19 00:00:00', '2017-04-19 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1331, '2017-04-26', 3, 5, 644, '7257803', 'semestral', '2017-04-26 00:00:00', '2017-04-26 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1332, '2017-05-03', 3, 5, 644, '7257803', 'semestral', '2017-05-03 00:00:00', '2017-05-03 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1333, '2017-05-10', 3, 5, 644, '7257803', 'semestral', '2017-05-10 00:00:00', '2017-05-10 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1334, '2017-05-17', 3, 5, 644, '7257803', 'semestral', '2017-05-17 00:00:00', '2017-05-17 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1335, '2017-05-24', 3, 5, 644, '7257803', 'semestral', '2017-05-24 00:00:00', '2017-05-24 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1336, '2017-05-31', 3, 5, 644, '7257803', 'semestral', '2017-05-31 00:00:00', '2017-05-31 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1337, '2017-06-07', 3, 5, 644, '7257803', 'semestral', '2017-06-07 00:00:00', '2017-06-07 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1338, '2017-06-14', 3, 5, 644, '7257803', 'semestral', '2017-06-14 00:00:00', '2017-06-14 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1339, '2017-06-21', 3, 5, 644, '7257803', 'semestral', '2017-06-21 00:00:00', '2017-06-21 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1340, '2017-06-28', 3, 5, 644, '7257803', 'semestral', '2017-06-28 00:00:00', '2017-06-28 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1341, '2017-07-05', 3, 5, 644, '7257803', 'semestral', '2017-07-05 00:00:00', '2017-07-05 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1342, '2017-04-08', 3, 1, 645, '4889256', 'semestral', '2017-04-08 00:00:00', '2017-04-08 00:00:00', 'si', 'docente', 'sabado');
INSERT INTO horario VALUES (1343, '2017-04-15', 3, 1, 645, '4889256', 'semestral', '2017-04-15 00:00:00', '2017-04-15 00:00:00', 'si', 'docente', 'sabado');
INSERT INTO horario VALUES (1344, '2017-04-22', 3, 1, 645, '4889256', 'semestral', '2017-04-22 00:00:00', '2017-04-22 00:00:00', 'si', 'docente', 'sabado');
INSERT INTO horario VALUES (1345, '2017-04-29', 3, 1, 645, '4889256', 'semestral', '2017-04-29 00:00:00', '2017-04-29 00:00:00', 'si', 'docente', 'sabado');
INSERT INTO horario VALUES (1346, '2017-05-06', 3, 1, 645, '4889256', 'semestral', '2017-05-06 00:00:00', '2017-05-06 00:00:00', 'si', 'docente', 'sabado');
INSERT INTO horario VALUES (1347, '2017-05-13', 3, 1, 645, '4889256', 'semestral', '2017-05-13 00:00:00', '2017-05-13 00:00:00', 'si', 'docente', 'sabado');
INSERT INTO horario VALUES (1348, '2017-05-20', 3, 1, 645, '4889256', 'semestral', '2017-05-20 00:00:00', '2017-05-20 00:00:00', 'si', 'docente', 'sabado');
INSERT INTO horario VALUES (1349, '2017-05-27', 3, 1, 645, '4889256', 'semestral', '2017-05-27 00:00:00', '2017-05-27 00:00:00', 'si', 'docente', 'sabado');
INSERT INTO horario VALUES (1350, '2017-06-03', 3, 1, 645, '4889256', 'semestral', '2017-06-03 00:00:00', '2017-06-03 00:00:00', 'si', 'docente', 'sabado');
INSERT INTO horario VALUES (1351, '2017-06-10', 3, 1, 645, '4889256', 'semestral', '2017-06-10 00:00:00', '2017-06-10 00:00:00', 'si', 'docente', 'sabado');
INSERT INTO horario VALUES (1352, '2017-06-17', 3, 1, 645, '4889256', 'semestral', '2017-06-17 00:00:00', '2017-06-17 00:00:00', 'si', 'docente', 'sabado');
INSERT INTO horario VALUES (1353, '2017-06-24', 3, 1, 645, '4889256', 'semestral', '2017-06-24 00:00:00', '2017-06-24 00:00:00', 'si', 'docente', 'sabado');
INSERT INTO horario VALUES (1354, '2017-07-01', 3, 1, 645, '4889256', 'semestral', '2017-07-01 00:00:00', '2017-07-01 00:00:00', 'si', 'docente', 'sabado');
INSERT INTO horario VALUES (1245, '2017-04-06', 3, 7, 640, '5794377', 'semestral', '2017-04-06 00:00:00', '2017-04-06 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1246, '2017-04-13', 3, 7, 640, '5794377', 'semestral', '2017-04-13 00:00:00', '2017-04-13 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1247, '2017-04-20', 3, 7, 640, '5794377', 'semestral', '2017-04-20 00:00:00', '2017-04-20 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1248, '2017-04-27', 3, 7, 640, '5794377', 'semestral', '2017-04-27 00:00:00', '2017-04-27 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1249, '2017-05-04', 3, 7, 640, '5794377', 'semestral', '2017-05-04 00:00:00', '2017-05-04 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1250, '2017-05-11', 3, 7, 640, '5794377', 'semestral', '2017-05-11 00:00:00', '2017-05-11 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1251, '2017-05-18', 3, 7, 640, '5794377', 'semestral', '2017-05-18 00:00:00', '2017-05-18 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1252, '2017-05-25', 3, 7, 640, '5794377', 'semestral', '2017-05-25 00:00:00', '2017-05-25 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1253, '2017-06-01', 3, 7, 640, '5794377', 'semestral', '2017-06-01 00:00:00', '2017-06-01 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1254, '2017-06-08', 3, 7, 640, '5794377', 'semestral', '2017-06-08 00:00:00', '2017-06-08 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1255, '2017-06-15', 3, 7, 640, '5794377', 'semestral', '2017-06-15 00:00:00', '2017-06-15 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1256, '2017-06-22', 3, 7, 640, '5794377', 'semestral', '2017-06-22 00:00:00', '2017-06-22 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1257, '2017-06-29', 3, 7, 640, '5794377', 'semestral', '2017-06-29 00:00:00', '2017-06-29 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1258, '2017-07-06', 3, 7, 640, '5794377', 'semestral', '2017-07-06 00:00:00', '2017-07-06 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1259, '2017-04-06', 3, 2, 642, '15780553', 'semestral', '2017-04-06 00:00:00', '2017-04-06 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1260, '2017-04-13', 3, 2, 642, '15780553', 'semestral', '2017-04-13 00:00:00', '2017-04-13 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1261, '2017-04-20', 3, 2, 642, '15780553', 'semestral', '2017-04-20 00:00:00', '2017-04-20 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1262, '2017-04-27', 3, 2, 642, '15780553', 'semestral', '2017-04-27 00:00:00', '2017-04-27 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1263, '2017-05-04', 3, 2, 642, '15780553', 'semestral', '2017-05-04 00:00:00', '2017-05-04 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1264, '2017-05-11', 3, 2, 642, '15780553', 'semestral', '2017-05-11 00:00:00', '2017-05-11 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1265, '2017-05-18', 3, 2, 642, '15780553', 'semestral', '2017-05-18 00:00:00', '2017-05-18 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1266, '2017-05-25', 3, 2, 642, '15780553', 'semestral', '2017-05-25 00:00:00', '2017-05-25 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1267, '2017-06-01', 3, 2, 642, '15780553', 'semestral', '2017-06-01 00:00:00', '2017-06-01 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1268, '2017-06-08', 3, 2, 642, '15780553', 'semestral', '2017-06-08 00:00:00', '2017-06-08 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1269, '2017-06-15', 3, 2, 642, '15780553', 'semestral', '2017-06-15 00:00:00', '2017-06-15 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1270, '2017-06-22', 3, 2, 642, '15780553', 'semestral', '2017-06-22 00:00:00', '2017-06-22 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1271, '2017-06-29', 3, 2, 642, '15780553', 'semestral', '2017-06-29 00:00:00', '2017-06-29 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1272, '2017-07-06', 3, 2, 642, '15780553', 'semestral', '2017-07-06 00:00:00', '2017-07-06 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1273, '2017-04-03', 3, 7, 644, '7257803', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1274, '2017-04-10', 3, 7, 644, '7257803', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1275, '2017-04-17', 3, 7, 644, '7257803', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1276, '2017-04-24', 3, 7, 644, '7257803', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1277, '2017-05-01', 3, 7, 644, '7257803', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1278, '2017-05-08', 3, 7, 644, '7257803', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1279, '2017-05-15', 3, 7, 644, '7257803', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1280, '2017-05-22', 3, 7, 644, '7257803', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1281, '2017-05-29', 3, 7, 644, '7257803', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1081, '2017-04-03', 3, 1, 616, '10471648', 'semestral', '2017-04-03 00:00:00', '2017-03-27 20:53:13', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1082, '2017-04-10', 3, 1, 616, '10471648', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1083, '2017-04-17', 3, 1, 616, '10471648', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1084, '2017-04-24', 3, 1, 616, '10471648', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1085, '2017-05-01', 3, 1, 616, '10471648', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1086, '2017-05-08', 3, 1, 616, '10471648', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1087, '2017-05-15', 3, 1, 616, '10471648', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1088, '2017-05-22', 3, 1, 616, '10471648', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1089, '2017-05-29', 3, 1, 616, '10471648', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1090, '2017-06-05', 3, 1, 616, '10471648', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1091, '2017-06-12', 3, 1, 616, '10471648', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1092, '2017-06-19', 3, 1, 616, '10471648', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1093, '2017-06-26', 3, 1, 616, '10471648', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1094, '2017-07-03', 3, 1, 616, '10471648', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1095, '2017-04-03', 3, 3, 617, '5585040', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1096, '2017-04-10', 3, 3, 617, '5585040', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1097, '2017-04-17', 3, 3, 617, '5585040', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1098, '2017-04-24', 3, 3, 617, '5585040', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1099, '2017-05-01', 3, 3, 617, '5585040', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1100, '2017-05-08', 3, 3, 617, '5585040', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1101, '2017-05-15', 3, 3, 617, '5585040', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1102, '2017-05-22', 3, 3, 617, '5585040', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1103, '2017-05-29', 3, 3, 617, '5585040', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1104, '2017-06-05', 3, 3, 617, '5585040', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1105, '2017-06-12', 3, 3, 617, '5585040', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1106, '2017-06-19', 3, 3, 617, '5585040', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1107, '2017-06-26', 3, 3, 617, '5585040', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1108, '2017-07-03', 3, 3, 617, '5585040', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1109, '2017-04-03', 3, 5, 618, '9666682', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'no', 'docente', 'lunes');
INSERT INTO horario VALUES (1110, '2017-04-10', 3, 5, 618, '9666682', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'no', 'docente', 'lunes');
INSERT INTO horario VALUES (1111, '2017-04-17', 3, 5, 618, '9666682', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'no', 'docente', 'lunes');
INSERT INTO horario VALUES (1112, '2017-04-24', 3, 5, 618, '9666682', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'no', 'docente', 'lunes');
INSERT INTO horario VALUES (1113, '2017-05-01', 3, 5, 618, '9666682', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'no', 'docente', 'lunes');
INSERT INTO horario VALUES (1114, '2017-05-08', 3, 5, 618, '9666682', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'no', 'docente', 'lunes');
INSERT INTO horario VALUES (1115, '2017-05-15', 3, 5, 618, '9666682', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'no', 'docente', 'lunes');
INSERT INTO horario VALUES (1116, '2017-05-22', 3, 5, 618, '9666682', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'no', 'docente', 'lunes');
INSERT INTO horario VALUES (1117, '2017-05-29', 3, 5, 618, '9666682', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'no', 'docente', 'lunes');
INSERT INTO horario VALUES (1282, '2017-06-05', 3, 7, 644, '7257803', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1118, '2017-06-05', 3, 5, 618, '9666682', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'no', 'docente', 'lunes');
INSERT INTO horario VALUES (1119, '2017-06-12', 3, 5, 618, '9666682', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'no', 'docente', 'lunes');
INSERT INTO horario VALUES (1120, '2017-06-19', 3, 5, 618, '9666682', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'no', 'docente', 'lunes');
INSERT INTO horario VALUES (1121, '2017-06-26', 3, 5, 618, '9666682', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'no', 'docente', 'lunes');
INSERT INTO horario VALUES (1122, '2017-07-03', 3, 5, 618, '9666682', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'no', 'docente', 'lunes');
INSERT INTO horario VALUES (1123, '2017-04-05', 3, 3, 617, '5585040', 'semestral', '2017-04-05 00:00:00', '2017-04-05 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1124, '2017-04-12', 3, 3, 617, '5585040', 'semestral', '2017-04-12 00:00:00', '2017-04-12 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1125, '2017-04-19', 3, 3, 617, '5585040', 'semestral', '2017-04-19 00:00:00', '2017-04-19 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1126, '2017-04-26', 3, 3, 617, '5585040', 'semestral', '2017-04-26 00:00:00', '2017-04-26 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1127, '2017-05-03', 3, 3, 617, '5585040', 'semestral', '2017-05-03 00:00:00', '2017-05-03 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1128, '2017-05-10', 3, 3, 617, '5585040', 'semestral', '2017-05-10 00:00:00', '2017-05-10 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1129, '2017-05-17', 3, 3, 617, '5585040', 'semestral', '2017-05-17 00:00:00', '2017-05-17 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1130, '2017-05-24', 3, 3, 617, '5585040', 'semestral', '2017-05-24 00:00:00', '2017-05-24 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1131, '2017-05-31', 3, 3, 617, '5585040', 'semestral', '2017-05-31 00:00:00', '2017-05-31 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1132, '2017-06-07', 3, 3, 617, '5585040', 'semestral', '2017-06-07 00:00:00', '2017-06-07 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1133, '2017-06-14', 3, 3, 617, '5585040', 'semestral', '2017-06-14 00:00:00', '2017-06-14 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1134, '2017-06-21', 3, 3, 617, '5585040', 'semestral', '2017-06-21 00:00:00', '2017-06-21 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1135, '2017-06-28', 3, 3, 617, '5585040', 'semestral', '2017-06-28 00:00:00', '2017-06-28 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1136, '2017-07-05', 3, 3, 617, '5585040', 'semestral', '2017-07-05 00:00:00', '2017-07-05 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1137, '2017-04-04', 3, 5, 642, '15780553', 'semestral', '2017-04-04 00:00:00', '2017-04-04 00:00:00', 'no', 'docente', 'martes');
INSERT INTO horario VALUES (1138, '2017-04-11', 3, 5, 642, '15780553', 'semestral', '2017-04-11 00:00:00', '2017-04-11 00:00:00', 'no', 'docente', 'martes');
INSERT INTO horario VALUES (1139, '2017-04-18', 3, 5, 642, '15780553', 'semestral', '2017-04-18 00:00:00', '2017-04-18 00:00:00', 'no', 'docente', 'martes');
INSERT INTO horario VALUES (1140, '2017-04-25', 3, 5, 642, '15780553', 'semestral', '2017-04-25 00:00:00', '2017-04-25 00:00:00', 'no', 'docente', 'martes');
INSERT INTO horario VALUES (1141, '2017-05-02', 3, 5, 642, '15780553', 'semestral', '2017-05-02 00:00:00', '2017-05-02 00:00:00', 'no', 'docente', 'martes');
INSERT INTO horario VALUES (1142, '2017-05-09', 3, 5, 642, '15780553', 'semestral', '2017-05-09 00:00:00', '2017-05-09 00:00:00', 'no', 'docente', 'martes');
INSERT INTO horario VALUES (1143, '2017-05-16', 3, 5, 642, '15780553', 'semestral', '2017-05-16 00:00:00', '2017-05-16 00:00:00', 'no', 'docente', 'martes');
INSERT INTO horario VALUES (1144, '2017-05-23', 3, 5, 642, '15780553', 'semestral', '2017-05-23 00:00:00', '2017-05-23 00:00:00', 'no', 'docente', 'martes');
INSERT INTO horario VALUES (1145, '2017-05-30', 3, 5, 642, '15780553', 'semestral', '2017-05-30 00:00:00', '2017-05-30 00:00:00', 'no', 'docente', 'martes');
INSERT INTO horario VALUES (1146, '2017-06-06', 3, 5, 642, '15780553', 'semestral', '2017-06-06 00:00:00', '2017-06-06 00:00:00', 'no', 'docente', 'martes');
INSERT INTO horario VALUES (1147, '2017-04-05', 3, 1, 616, '10471648', 'semestral', '2017-04-05 00:00:00', '2017-04-05 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1148, '2017-04-12', 3, 1, 616, '10471648', 'semestral', '2017-04-12 00:00:00', '2017-04-12 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1149, '2017-04-19', 3, 1, 616, '10471648', 'semestral', '2017-04-19 00:00:00', '2017-04-19 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1150, '2017-04-26', 3, 1, 616, '10471648', 'semestral', '2017-04-26 00:00:00', '2017-04-26 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1151, '2017-05-03', 3, 1, 616, '10471648', 'semestral', '2017-05-03 00:00:00', '2017-05-03 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1152, '2017-05-10', 3, 1, 616, '10471648', 'semestral', '2017-05-10 00:00:00', '2017-05-10 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1153, '2017-05-17', 3, 1, 616, '10471648', 'semestral', '2017-05-17 00:00:00', '2017-05-17 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1154, '2017-05-24', 3, 1, 616, '10471648', 'semestral', '2017-05-24 00:00:00', '2017-05-24 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1155, '2017-05-31', 3, 1, 616, '10471648', 'semestral', '2017-05-31 00:00:00', '2017-05-31 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1156, '2017-06-07', 3, 1, 616, '10471648', 'semestral', '2017-06-07 00:00:00', '2017-06-07 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1157, '2017-06-14', 3, 1, 616, '10471648', 'semestral', '2017-06-14 00:00:00', '2017-06-14 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1158, '2017-06-21', 3, 1, 616, '10471648', 'semestral', '2017-06-21 00:00:00', '2017-06-21 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1159, '2017-06-28', 3, 1, 616, '10471648', 'semestral', '2017-06-28 00:00:00', '2017-06-28 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1160, '2017-07-05', 3, 1, 616, '10471648', 'semestral', '2017-07-05 00:00:00', '2017-07-05 00:00:00', 'si', 'docente', 'miercoles');
INSERT INTO horario VALUES (1161, '2017-04-06', 3, 5, 663, '9377008', 'semestral', '2017-04-06 00:00:00', '2017-04-06 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1162, '2017-04-13', 3, 5, 663, '9377008', 'semestral', '2017-04-13 00:00:00', '2017-04-13 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1163, '2017-04-20', 3, 5, 663, '9377008', 'semestral', '2017-04-20 00:00:00', '2017-04-20 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1164, '2017-04-27', 3, 5, 663, '9377008', 'semestral', '2017-04-27 00:00:00', '2017-04-27 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1165, '2017-05-04', 3, 5, 663, '9377008', 'semestral', '2017-05-04 00:00:00', '2017-05-04 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1166, '2017-05-11', 3, 5, 663, '9377008', 'semestral', '2017-05-11 00:00:00', '2017-05-11 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1167, '2017-05-18', 3, 5, 663, '9377008', 'semestral', '2017-05-18 00:00:00', '2017-05-18 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1168, '2017-05-25', 3, 5, 663, '9377008', 'semestral', '2017-05-25 00:00:00', '2017-05-25 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1169, '2017-06-01', 3, 5, 663, '9377008', 'semestral', '2017-06-01 00:00:00', '2017-06-01 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1170, '2017-06-08', 3, 5, 663, '9377008', 'semestral', '2017-06-08 00:00:00', '2017-06-08 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1171, '2017-06-15', 3, 5, 663, '9377008', 'semestral', '2017-06-15 00:00:00', '2017-06-15 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1172, '2017-06-22', 3, 5, 663, '9377008', 'semestral', '2017-06-22 00:00:00', '2017-06-22 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1173, '2017-06-29', 3, 5, 663, '9377008', 'semestral', '2017-06-29 00:00:00', '2017-06-29 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1174, '2017-07-06', 3, 5, 663, '9377008', 'semestral', '2017-07-06 00:00:00', '2017-07-06 00:00:00', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1175, '2017-04-04', 3, 1, 616, '10471648', 'semestral', '2017-04-04 00:00:00', '2017-04-04 00:00:00', 'no', 'docente', 'martes');
INSERT INTO horario VALUES (1176, '2017-04-11', 3, 1, 616, '10471648', 'semestral', '2017-04-11 00:00:00', '2017-04-11 00:00:00', 'no', 'docente', 'martes');
INSERT INTO horario VALUES (1177, '2017-04-18', 3, 1, 616, '10471648', 'semestral', '2017-04-18 00:00:00', '2017-04-18 00:00:00', 'no', 'docente', 'martes');
INSERT INTO horario VALUES (1178, '2017-04-25', 3, 1, 616, '10471648', 'semestral', '2017-04-25 00:00:00', '2017-04-25 00:00:00', 'no', 'docente', 'martes');
INSERT INTO horario VALUES (1179, '2017-05-02', 3, 1, 616, '10471648', 'semestral', '2017-05-02 00:00:00', '2017-05-02 00:00:00', 'no', 'docente', 'martes');
INSERT INTO horario VALUES (1180, '2017-05-09', 3, 1, 616, '10471648', 'semestral', '2017-05-09 00:00:00', '2017-05-09 00:00:00', 'no', 'docente', 'martes');
INSERT INTO horario VALUES (1181, '2017-05-16', 3, 1, 616, '10471648', 'semestral', '2017-05-16 00:00:00', '2017-05-16 00:00:00', 'no', 'docente', 'martes');
INSERT INTO horario VALUES (1182, '2017-05-23', 3, 1, 616, '10471648', 'semestral', '2017-05-23 00:00:00', '2017-05-23 00:00:00', 'no', 'docente', 'martes');
INSERT INTO horario VALUES (1183, '2017-05-30', 3, 1, 616, '10471648', 'semestral', '2017-05-30 00:00:00', '2017-05-30 00:00:00', 'no', 'docente', 'martes');
INSERT INTO horario VALUES (1184, '2017-06-06', 3, 1, 616, '10471648', 'semestral', '2017-06-06 00:00:00', '2017-06-06 00:00:00', 'no', 'docente', 'martes');
INSERT INTO horario VALUES (1185, '2017-06-13', 3, 1, 616, '10471648', 'semestral', '2017-06-13 00:00:00', '2017-06-13 00:00:00', 'no', 'docente', 'martes');
INSERT INTO horario VALUES (1186, '2017-06-20', 3, 1, 616, '10471648', 'semestral', '2017-06-20 00:00:00', '2017-06-20 00:00:00', 'no', 'docente', 'martes');
INSERT INTO horario VALUES (1187, '2017-06-27', 3, 1, 616, '10471648', 'semestral', '2017-06-27 00:00:00', '2017-06-27 00:00:00', 'no', 'docente', 'martes');
INSERT INTO horario VALUES (1188, '2017-07-04', 3, 1, 616, '10471648', 'semestral', '2017-07-04 00:00:00', '2017-07-04 00:00:00', 'no', 'docente', 'martes');
INSERT INTO horario VALUES (1189, '2017-04-05', 3, 2, 616, '10471648', 'semestral', '2017-04-05 00:00:00', '2017-04-05 00:00:00', 'no', 'docente', 'miercoles');
INSERT INTO horario VALUES (1190, '2017-04-12', 3, 2, 616, '10471648', 'semestral', '2017-04-12 00:00:00', '2017-04-12 00:00:00', 'no', 'docente', 'miercoles');
INSERT INTO horario VALUES (1191, '2017-04-19', 3, 2, 616, '10471648', 'semestral', '2017-04-19 00:00:00', '2017-04-19 00:00:00', 'no', 'docente', 'miercoles');
INSERT INTO horario VALUES (1192, '2017-04-26', 3, 2, 616, '10471648', 'semestral', '2017-04-26 00:00:00', '2017-04-26 00:00:00', 'no', 'docente', 'miercoles');
INSERT INTO horario VALUES (1193, '2017-05-03', 3, 2, 616, '10471648', 'semestral', '2017-05-03 00:00:00', '2017-05-03 00:00:00', 'no', 'docente', 'miercoles');
INSERT INTO horario VALUES (1194, '2017-05-10', 3, 2, 616, '10471648', 'semestral', '2017-05-10 00:00:00', '2017-05-10 00:00:00', 'no', 'docente', 'miercoles');
INSERT INTO horario VALUES (1195, '2017-05-17', 3, 2, 616, '10471648', 'semestral', '2017-05-17 00:00:00', '2017-05-17 00:00:00', 'no', 'docente', 'miercoles');
INSERT INTO horario VALUES (1196, '2017-05-24', 3, 2, 616, '10471648', 'semestral', '2017-05-24 00:00:00', '2017-05-24 00:00:00', 'no', 'docente', 'miercoles');
INSERT INTO horario VALUES (1197, '2017-05-31', 3, 2, 616, '10471648', 'semestral', '2017-05-31 00:00:00', '2017-05-31 00:00:00', 'no', 'docente', 'miercoles');
INSERT INTO horario VALUES (1198, '2017-06-07', 3, 2, 616, '10471648', 'semestral', '2017-06-07 00:00:00', '2017-06-07 00:00:00', 'no', 'docente', 'miercoles');
INSERT INTO horario VALUES (1199, '2017-06-14', 3, 2, 616, '10471648', 'semestral', '2017-06-14 00:00:00', '2017-06-14 00:00:00', 'no', 'docente', 'miercoles');
INSERT INTO horario VALUES (1200, '2017-06-21', 3, 2, 616, '10471648', 'semestral', '2017-06-21 00:00:00', '2017-06-21 00:00:00', 'no', 'docente', 'miercoles');
INSERT INTO horario VALUES (1201, '2017-06-28', 3, 2, 616, '10471648', 'semestral', '2017-06-28 00:00:00', '2017-06-28 00:00:00', 'no', 'docente', 'miercoles');
INSERT INTO horario VALUES (1202, '2017-07-05', 3, 2, 616, '10471648', 'semestral', '2017-07-05 00:00:00', '2017-07-05 00:00:00', 'no', 'docente', 'miercoles');
INSERT INTO horario VALUES (1283, '2017-06-12', 3, 7, 644, '7257803', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1284, '2017-06-19', 3, 7, 644, '7257803', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1285, '2017-06-26', 3, 7, 644, '7257803', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1286, '2017-07-03', 3, 7, 644, '7257803', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1424, '2017-04-10', 4, 1, 650, '5585040', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1425, '2017-04-17', 4, 1, 650, '5585040', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1426, '2017-04-24', 4, 1, 650, '5585040', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1427, '2017-05-01', 4, 1, 650, '5585040', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1428, '2017-05-08', 4, 1, 650, '5585040', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1429, '2017-05-15', 4, 1, 650, '5585040', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1430, '2017-05-22', 4, 1, 650, '5585040', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1431, '2017-05-29', 4, 1, 650, '5585040', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1432, '2017-06-05', 4, 1, 650, '5585040', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1433, '2017-06-12', 4, 1, 650, '5585040', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1434, '2017-06-19', 4, 1, 650, '5585040', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1435, '2017-06-26', 4, 1, 650, '5585040', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1436, '2017-07-03', 4, 1, 650, '5585040', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1438, '2017-04-10', 4, 2, 650, '5585040', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1439, '2017-04-17', 4, 2, 650, '5585040', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1440, '2017-04-24', 4, 2, 650, '5585040', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1441, '2017-05-01', 4, 2, 650, '5585040', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1442, '2017-05-08', 4, 2, 650, '5585040', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1443, '2017-05-15', 4, 2, 650, '5585040', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1444, '2017-05-22', 4, 2, 650, '5585040', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1445, '2017-05-29', 4, 2, 650, '5585040', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1446, '2017-06-05', 4, 2, 650, '5585040', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1447, '2017-06-12', 4, 2, 650, '5585040', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1448, '2017-06-19', 4, 2, 650, '5585040', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1449, '2017-06-26', 4, 2, 650, '5585040', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1450, '2017-07-03', 4, 2, 650, '5585040', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1451, '2017-04-03', 4, 3, 618, '9666682', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1452, '2017-04-10', 4, 3, 618, '9666682', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1453, '2017-04-17', 4, 3, 618, '9666682', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1423, '2017-04-03', 4, 1, 650, '5585040', 'semestral', '2017-04-03 00:00:00', '2017-03-28 15:53:14', 'no', 'docente', 'lunes');
INSERT INTO horario VALUES (1454, '2017-04-24', 4, 3, 618, '9666682', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1455, '2017-05-01', 4, 3, 618, '9666682', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1456, '2017-05-08', 4, 3, 618, '9666682', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1457, '2017-05-15', 4, 3, 618, '9666682', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1458, '2017-05-22', 4, 3, 618, '9666682', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1459, '2017-05-29', 4, 3, 618, '9666682', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1460, '2017-06-05', 4, 3, 618, '9666682', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1461, '2017-06-12', 4, 3, 618, '9666682', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1462, '2017-06-19', 4, 3, 618, '9666682', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1463, '2017-06-26', 4, 3, 618, '9666682', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1464, '2017-07-03', 4, 3, 618, '9666682', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1465, '2017-04-03', 4, 4, 653, '8927189', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1466, '2017-04-10', 4, 4, 653, '8927189', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1467, '2017-04-17', 4, 4, 653, '8927189', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1468, '2017-04-24', 4, 4, 653, '8927189', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1469, '2017-05-01', 4, 4, 653, '8927189', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1470, '2017-05-08', 4, 4, 653, '8927189', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1471, '2017-05-15', 4, 4, 653, '8927189', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1472, '2017-05-22', 4, 4, 653, '8927189', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1473, '2017-05-29', 4, 4, 653, '8927189', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1474, '2017-06-05', 4, 4, 653, '8927189', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1475, '2017-06-12', 4, 4, 653, '8927189', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1476, '2017-06-19', 4, 4, 653, '8927189', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1477, '2017-06-26', 4, 4, 653, '8927189', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1478, '2017-07-03', 4, 4, 653, '8927189', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1479, '2017-04-03', 4, 6, 657, '8697837', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1480, '2017-04-10', 4, 6, 657, '8697837', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1481, '2017-04-17', 4, 6, 657, '8697837', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1482, '2017-04-24', 4, 6, 657, '8697837', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1483, '2017-05-01', 4, 6, 657, '8697837', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1484, '2017-05-08', 4, 6, 657, '8697837', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1485, '2017-05-15', 4, 6, 657, '8697837', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1486, '2017-05-22', 4, 6, 657, '8697837', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1487, '2017-05-29', 4, 6, 657, '8697837', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1488, '2017-06-05', 4, 6, 657, '8697837', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1489, '2017-06-12', 4, 6, 657, '8697837', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1490, '2017-06-19', 4, 6, 657, '8697837', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1491, '2017-06-26', 4, 6, 657, '8697837', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1492, '2017-07-03', 4, 6, 657, '8697837', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1493, '2017-04-03', 4, 7, 617, '5585040', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1494, '2017-04-10', 4, 7, 617, '5585040', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1495, '2017-04-17', 4, 7, 617, '5585040', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1496, '2017-04-24', 4, 7, 617, '5585040', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1497, '2017-05-01', 4, 7, 617, '5585040', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1498, '2017-05-08', 4, 7, 617, '5585040', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1499, '2017-05-15', 4, 7, 617, '5585040', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1500, '2017-05-22', 4, 7, 617, '5585040', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1501, '2017-05-29', 4, 7, 617, '5585040', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1502, '2017-06-05', 4, 7, 617, '5585040', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1503, '2017-06-12', 4, 7, 617, '5585040', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1504, '2017-06-19', 4, 7, 617, '5585040', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1505, '2017-06-26', 4, 7, 617, '5585040', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1506, '2017-07-03', 4, 7, 617, '5585040', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1507, '2017-04-04', 4, 5, 645, '4889256', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1508, '2017-04-11', 4, 5, 645, '4889256', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1509, '2017-04-18', 4, 5, 645, '4889256', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1510, '2017-04-25', 4, 5, 645, '4889256', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1511, '2017-05-02', 4, 5, 645, '4889256', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1512, '2017-05-09', 4, 5, 645, '4889256', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1513, '2017-05-16', 4, 5, 645, '4889256', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1514, '2017-05-23', 4, 5, 645, '4889256', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1515, '2017-05-30', 4, 5, 645, '4889256', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1516, '2017-06-06', 4, 5, 645, '4889256', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1517, '2017-06-13', 4, 5, 645, '4889256', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1518, '2017-06-20', 4, 5, 645, '4889256', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1519, '2017-06-27', 4, 5, 645, '4889256', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1520, '2017-07-04', 4, 5, 645, '4889256', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1521, '2017-04-04', 4, 6, 646, '9531367', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1522, '2017-04-11', 4, 6, 646, '9531367', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1523, '2017-04-18', 4, 6, 646, '9531367', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1524, '2017-04-25', 4, 6, 646, '9531367', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1525, '2017-05-02', 4, 6, 646, '9531367', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1526, '2017-05-09', 4, 6, 646, '9531367', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1527, '2017-05-16', 4, 6, 646, '9531367', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1528, '2017-05-23', 4, 6, 646, '9531367', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1529, '2017-05-30', 4, 6, 646, '9531367', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1530, '2017-06-06', 4, 6, 646, '9531367', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1531, '2017-06-13', 4, 6, 646, '9531367', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1532, '2017-06-20', 4, 6, 646, '9531367', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1533, '2017-06-27', 4, 6, 646, '9531367', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1534, '2017-07-04', 4, 6, 646, '9531367', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1535, '2017-04-04', 4, 1, 616, '10471648', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1536, '2017-04-11', 4, 1, 616, '10471648', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1537, '2017-04-18', 4, 1, 616, '10471648', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1538, '2017-04-25', 4, 1, 616, '10471648', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1539, '2017-05-02', 4, 1, 616, '10471648', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1540, '2017-05-09', 4, 1, 616, '10471648', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1541, '2017-05-16', 4, 1, 616, '10471648', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1542, '2017-05-23', 4, 1, 616, '10471648', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1543, '2017-05-30', 4, 1, 616, '10471648', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1544, '2017-06-06', 4, 1, 616, '10471648', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1545, '2017-06-13', 4, 1, 616, '10471648', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1546, '2017-06-20', 4, 1, 616, '10471648', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1547, '2017-06-27', 4, 1, 616, '10471648', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1548, '2017-07-04', 4, 1, 616, '10471648', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1549, '2017-04-04', 3, 2, 616, '10471648', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1550, '2017-04-11', 3, 2, 616, '10471648', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1551, '2017-04-18', 3, 2, 616, '10471648', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1552, '2017-04-25', 3, 2, 616, '10471648', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1553, '2017-05-02', 3, 2, 616, '10471648', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1554, '2017-05-09', 3, 2, 616, '10471648', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1555, '2017-05-16', 3, 2, 616, '10471648', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1556, '2017-05-23', 3, 2, 616, '10471648', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1557, '2017-05-30', 3, 2, 616, '10471648', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1558, '2017-06-06', 3, 2, 616, '10471648', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1559, '2017-06-13', 3, 2, 616, '10471648', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1560, '2017-06-20', 3, 2, 616, '10471648', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1561, '2017-06-27', 3, 2, 616, '10471648', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1562, '2017-07-04', 3, 2, 616, '10471648', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1563, '2017-04-04', 4, 3, 617, '5585040', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1564, '2017-04-11', 4, 3, 617, '5585040', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1565, '2017-04-18', 4, 3, 617, '5585040', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1566, '2017-04-25', 4, 3, 617, '5585040', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1567, '2017-05-02', 4, 3, 617, '5585040', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1568, '2017-05-09', 4, 3, 617, '5585040', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1569, '2017-05-16', 4, 3, 617, '5585040', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1570, '2017-05-23', 4, 3, 617, '5585040', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1571, '2017-05-30', 4, 3, 617, '5585040', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1572, '2017-06-06', 4, 3, 617, '5585040', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1573, '2017-06-13', 4, 3, 617, '5585040', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1574, '2017-06-20', 4, 3, 617, '5585040', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1575, '2017-06-27', 4, 3, 617, '5585040', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1576, '2017-07-04', 4, 3, 617, '5585040', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1577, '2017-04-05', 4, 6, 618, '9666682', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1578, '2017-04-12', 4, 6, 618, '9666682', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1579, '2017-04-19', 4, 6, 618, '9666682', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1580, '2017-04-26', 4, 6, 618, '9666682', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1581, '2017-05-03', 4, 6, 618, '9666682', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1582, '2017-05-10', 4, 6, 618, '9666682', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1583, '2017-05-17', 4, 6, 618, '9666682', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1584, '2017-05-24', 4, 6, 618, '9666682', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1585, '2017-05-31', 4, 6, 618, '9666682', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1586, '2017-06-07', 4, 6, 618, '9666682', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1587, '2017-06-14', 4, 6, 618, '9666682', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1588, '2017-06-21', 4, 6, 618, '9666682', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1589, '2017-06-28', 4, 6, 618, '9666682', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1590, '2017-07-05', 4, 6, 618, '9666682', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1591, '2017-04-06', 4, 1, 618, '9666682', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1592, '2017-04-13', 4, 1, 618, '9666682', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1593, '2017-04-20', 4, 1, 618, '9666682', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1594, '2017-04-27', 4, 1, 618, '9666682', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1595, '2017-05-04', 4, 1, 618, '9666682', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1596, '2017-05-11', 4, 1, 618, '9666682', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1597, '2017-05-18', 4, 1, 618, '9666682', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1598, '2017-05-25', 4, 1, 618, '9666682', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1599, '2017-06-01', 4, 1, 618, '9666682', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1600, '2017-06-08', 4, 1, 618, '9666682', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1601, '2017-06-15', 4, 1, 618, '9666682', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1602, '2017-06-22', 4, 1, 618, '9666682', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1603, '2017-06-29', 4, 1, 618, '9666682', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1604, '2017-07-06', 4, 1, 618, '9666682', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1605, '2017-04-06', 4, 2, 618, '9666682', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1606, '2017-04-13', 4, 2, 618, '9666682', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1607, '2017-04-20', 4, 2, 618, '9666682', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1608, '2017-04-27', 4, 2, 618, '9666682', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1609, '2017-05-04', 4, 2, 618, '9666682', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1610, '2017-05-11', 4, 2, 618, '9666682', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1611, '2017-05-18', 4, 2, 618, '9666682', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1612, '2017-05-25', 4, 2, 618, '9666682', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1613, '2017-06-01', 4, 2, 618, '9666682', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1614, '2017-06-08', 4, 2, 618, '9666682', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1615, '2017-06-15', 4, 2, 618, '9666682', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1616, '2017-06-22', 4, 2, 618, '9666682', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1617, '2017-06-29', 4, 2, 618, '9666682', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1618, '2017-07-06', 4, 2, 618, '9666682', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1620, '2017-04-13', 4, 3, 617, '5585040', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1621, '2017-04-20', 4, 3, 617, '5585040', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1622, '2017-04-27', 4, 3, 617, '5585040', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1623, '2017-05-04', 4, 3, 617, '5585040', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1624, '2017-05-11', 4, 3, 617, '5585040', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1625, '2017-05-18', 4, 3, 617, '5585040', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1626, '2017-05-25', 4, 3, 617, '5585040', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1627, '2017-06-01', 4, 3, 617, '5585040', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1628, '2017-06-08', 4, 3, 617, '5585040', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1629, '2017-06-15', 4, 3, 617, '5585040', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1630, '2017-06-22', 4, 3, 617, '5585040', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1631, '2017-06-29', 4, 3, 617, '5585040', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1632, '2017-07-06', 4, 3, 617, '5585040', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1633, '2017-04-06', 4, 6, 653, '8927189', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1634, '2017-04-13', 4, 6, 653, '8927189', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1635, '2017-04-20', 4, 6, 653, '8927189', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1636, '2017-04-27', 4, 6, 653, '8927189', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1637, '2017-05-04', 4, 6, 653, '8927189', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1638, '2017-05-11', 4, 6, 653, '8927189', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1639, '2017-05-18', 4, 6, 653, '8927189', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1640, '2017-05-25', 4, 6, 653, '8927189', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1641, '2017-06-01', 4, 6, 653, '8927189', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1642, '2017-06-08', 4, 6, 653, '8927189', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1643, '2017-06-15', 4, 6, 653, '8927189', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1644, '2017-06-22', 4, 6, 653, '8927189', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1645, '2017-06-29', 4, 6, 653, '8927189', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1646, '2017-07-06', 4, 6, 653, '8927189', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1647, '2017-04-06', 4, 7, 653, '8927189', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1648, '2017-04-13', 4, 7, 653, '8927189', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1649, '2017-04-20', 4, 7, 653, '8927189', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1650, '2017-04-27', 4, 7, 653, '8927189', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1651, '2017-05-04', 4, 7, 653, '8927189', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1652, '2017-05-11', 4, 7, 653, '8927189', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1653, '2017-05-18', 4, 7, 653, '8927189', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1654, '2017-05-25', 4, 7, 653, '8927189', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1655, '2017-06-01', 4, 7, 653, '8927189', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1656, '2017-06-08', 4, 7, 653, '8927189', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1657, '2017-06-15', 4, 7, 653, '8927189', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1658, '2017-06-22', 4, 7, 653, '8927189', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1659, '2017-06-29', 4, 7, 653, '8927189', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1660, '2017-07-06', 4, 7, 653, '8927189', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1661, '2017-04-07', 4, 1, 616, '10471648', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1662, '2017-04-14', 4, 1, 616, '10471648', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1663, '2017-04-21', 4, 1, 616, '10471648', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1664, '2017-04-28', 4, 1, 616, '10471648', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1665, '2017-05-05', 4, 1, 616, '10471648', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1666, '2017-05-12', 4, 1, 616, '10471648', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1667, '2017-05-19', 4, 1, 616, '10471648', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1668, '2017-05-26', 4, 1, 616, '10471648', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1669, '2017-06-02', 4, 1, 616, '10471648', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1670, '2017-06-09', 4, 1, 616, '10471648', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1671, '2017-06-16', 4, 1, 616, '10471648', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1672, '2017-06-23', 4, 1, 616, '10471648', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1673, '2017-06-30', 4, 1, 616, '10471648', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1674, '2017-07-07', 4, 1, 616, '10471648', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1675, '2017-04-07', 4, 2, 616, '10471648', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1676, '2017-04-14', 4, 2, 616, '10471648', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1677, '2017-04-21', 4, 2, 616, '10471648', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1678, '2017-04-28', 4, 2, 616, '10471648', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1679, '2017-05-05', 4, 2, 616, '10471648', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1680, '2017-05-12', 4, 2, 616, '10471648', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1681, '2017-05-19', 4, 2, 616, '10471648', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1682, '2017-05-26', 4, 2, 616, '10471648', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1683, '2017-06-02', 4, 2, 616, '10471648', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1684, '2017-06-09', 4, 2, 616, '10471648', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1685, '2017-06-16', 4, 2, 616, '10471648', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1686, '2017-06-23', 4, 2, 616, '10471648', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1687, '2017-06-30', 4, 2, 616, '10471648', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1688, '2017-07-07', 4, 2, 616, '10471648', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1689, '2017-04-07', 4, 6, 621, '6443706', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1690, '2017-04-14', 4, 6, 621, '6443706', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1691, '2017-04-21', 4, 6, 621, '6443706', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1692, '2017-04-28', 4, 6, 621, '6443706', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1693, '2017-05-05', 4, 6, 621, '6443706', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1694, '2017-05-12', 4, 6, 621, '6443706', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1695, '2017-05-19', 4, 6, 621, '6443706', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1696, '2017-05-26', 4, 6, 621, '6443706', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1697, '2017-06-02', 4, 6, 621, '6443706', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1698, '2017-06-09', 4, 6, 621, '6443706', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1699, '2017-06-16', 4, 6, 621, '6443706', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1700, '2017-06-23', 4, 6, 621, '6443706', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1701, '2017-06-30', 4, 6, 621, '6443706', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1702, '2017-07-07', 4, 6, 621, '6443706', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1703, '2017-04-07', 4, 7, 621, '6443706', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1704, '2017-04-14', 4, 7, 621, '6443706', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1705, '2017-04-21', 4, 7, 621, '6443706', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1706, '2017-04-28', 4, 7, 621, '6443706', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1707, '2017-05-05', 4, 7, 621, '6443706', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1708, '2017-05-12', 4, 7, 621, '6443706', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1709, '2017-05-19', 4, 7, 621, '6443706', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1710, '2017-05-26', 4, 7, 621, '6443706', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1711, '2017-06-02', 4, 7, 621, '6443706', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1712, '2017-06-09', 4, 7, 621, '6443706', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1713, '2017-06-16', 4, 7, 621, '6443706', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1714, '2017-06-23', 4, 7, 621, '6443706', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1715, '2017-06-30', 4, 7, 621, '6443706', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1722, '2017-04-10', 9, 2, 634, '9666682', 'semestral', '2017-04-05 00:00:00', '2017-04-05 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1723, '2017-04-17', 9, 2, 634, '9666682', 'semestral', '2017-04-12 00:00:00', '2017-04-12 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1724, '2017-04-24', 9, 2, 634, '9666682', 'semestral', '2017-04-19 00:00:00', '2017-04-19 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1725, '2017-05-01', 9, 2, 634, '9666682', 'semestral', '2017-04-26 00:00:00', '2017-04-26 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1726, '2017-05-08', 9, 2, 634, '9666682', 'semestral', '2017-05-03 00:00:00', '2017-05-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1727, '2017-05-15', 9, 2, 634, '9666682', 'semestral', '2017-05-10 00:00:00', '2017-05-10 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1728, '2017-05-22', 9, 2, 634, '9666682', 'semestral', '2017-05-17 00:00:00', '2017-05-17 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1729, '2017-05-29', 9, 2, 634, '9666682', 'semestral', '2017-05-24 00:00:00', '2017-05-24 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1730, '2017-06-05', 9, 2, 634, '9666682', 'semestral', '2017-05-31 00:00:00', '2017-05-31 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1731, '2017-06-12', 9, 2, 634, '9666682', 'semestral', '2017-06-07 00:00:00', '2017-06-07 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1732, '2017-06-19', 9, 2, 634, '9666682', 'semestral', '2017-06-14 00:00:00', '2017-06-14 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1733, '2017-06-26', 9, 2, 634, '9666682', 'semestral', '2017-06-21 00:00:00', '2017-06-21 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1734, '2017-07-03', 9, 2, 634, '9666682', 'semestral', '2017-06-28 00:00:00', '2017-06-28 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1736, '2017-04-10', 9, 5, 655, '8927189', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1737, '2017-04-17', 9, 5, 655, '8927189', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1738, '2017-04-24', 9, 5, 655, '8927189', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1739, '2017-05-01', 9, 5, 655, '8927189', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1740, '2017-05-08', 9, 5, 655, '8927189', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1741, '2017-05-15', 9, 5, 655, '8927189', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1742, '2017-05-22', 9, 5, 655, '8927189', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1743, '2017-05-29', 9, 5, 655, '8927189', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1744, '2017-06-05', 9, 5, 655, '8927189', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1745, '2017-06-12', 9, 5, 655, '8927189', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1746, '2017-06-19', 9, 5, 655, '8927189', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1747, '2017-06-26', 9, 5, 655, '8927189', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1748, '2017-07-03', 9, 5, 655, '8927189', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1718, '2017-03-13', 9, 2, 634, '9666682', 'semestral', '2017-03-08 00:00:00', '2017-03-28 15:45:20', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1719, '2017-03-20', 9, 2, 634, '9666682', 'semestral', '2017-03-15 00:00:00', '2017-03-28 15:46:55', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1721, '2017-04-03', 9, 2, 634, '9666682', 'semestral', '2017-03-29 00:00:00', '2017-03-28 15:47:18', 'no', 'docente', 'lunes');
INSERT INTO horario VALUES (1735, '2017-04-03', 9, 5, 655, '8927189', 'semestral', '2017-04-03 00:00:00', '2017-03-28 15:47:36', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1720, '2017-03-27', 9, 2, 634, '9666682', 'semestral', '2017-03-22 00:00:00', '2017-03-28 15:47:47', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (1716, '2017-07-07', 4, 7, 621, '6443706', 'semestral', '2017-07-03 00:00:00', '2017-03-28 15:55:42', 'si', 'docente', 'viernes');
INSERT INTO horario VALUES (1749, '2017-04-03', 9, 6, 655, '8927189', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1750, '2017-04-10', 9, 6, 655, '8927189', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1751, '2017-04-17', 9, 6, 655, '8927189', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1752, '2017-04-24', 9, 6, 655, '8927189', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1753, '2017-05-01', 9, 6, 655, '8927189', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1754, '2017-05-08', 9, 6, 655, '8927189', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1755, '2017-05-15', 9, 6, 655, '8927189', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1756, '2017-05-22', 9, 6, 655, '8927189', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1757, '2017-05-29', 9, 6, 655, '8927189', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1758, '2017-06-05', 9, 6, 655, '8927189', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1759, '2017-06-12', 9, 6, 655, '8927189', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1760, '2017-06-19', 9, 6, 655, '8927189', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1761, '2017-06-26', 9, 6, 655, '8927189', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1762, '2017-07-03', 9, 6, 655, '8927189', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1763, '2017-04-04', 9, 2, 627, '6577123', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1764, '2017-04-11', 9, 2, 627, '6577123', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1765, '2017-04-18', 9, 2, 627, '6577123', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1766, '2017-04-25', 9, 2, 627, '6577123', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1767, '2017-05-02', 9, 2, 627, '6577123', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1768, '2017-05-09', 9, 2, 627, '6577123', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1769, '2017-05-16', 9, 2, 627, '6577123', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1770, '2017-05-23', 9, 2, 627, '6577123', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1771, '2017-05-30', 9, 2, 627, '6577123', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1772, '2017-06-06', 9, 2, 627, '6577123', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1773, '2017-06-13', 9, 2, 627, '6577123', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1774, '2017-06-20', 9, 2, 627, '6577123', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1775, '2017-06-27', 9, 2, 627, '6577123', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1776, '2017-07-04', 9, 2, 627, '6577123', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1777, '2017-04-04', 9, 3, 627, '6577123', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1778, '2017-04-11', 9, 3, 627, '6577123', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1779, '2017-04-18', 9, 3, 627, '6577123', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1780, '2017-04-25', 9, 3, 627, '6577123', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1781, '2017-05-02', 9, 3, 627, '6577123', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1782, '2017-05-09', 9, 3, 627, '6577123', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1783, '2017-05-16', 9, 3, 627, '6577123', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1784, '2017-05-23', 9, 3, 627, '6577123', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1785, '2017-05-30', 9, 3, 627, '6577123', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1786, '2017-06-06', 9, 3, 627, '6577123', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1787, '2017-06-13', 9, 3, 627, '6577123', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1788, '2017-06-20', 9, 3, 627, '6577123', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1789, '2017-06-27', 9, 3, 627, '6577123', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1790, '2017-07-04', 9, 3, 627, '6577123', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1791, '2017-04-04', 9, 5, 641, '8300624', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1792, '2017-04-11', 9, 5, 641, '8300624', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1793, '2017-04-18', 9, 5, 641, '8300624', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1794, '2017-04-25', 9, 5, 641, '8300624', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1795, '2017-05-02', 9, 5, 641, '8300624', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1796, '2017-05-09', 9, 5, 641, '8300624', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1797, '2017-05-16', 9, 5, 641, '8300624', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1798, '2017-05-23', 9, 5, 641, '8300624', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1799, '2017-05-30', 9, 5, 641, '8300624', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1800, '2017-06-06', 9, 5, 641, '8300624', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1801, '2017-06-13', 9, 5, 641, '8300624', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1802, '2017-06-20', 9, 5, 641, '8300624', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1803, '2017-06-27', 9, 5, 641, '8300624', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1804, '2017-07-04', 9, 5, 641, '8300624', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1805, '2017-04-04', 9, 6, 629, '9531367', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1806, '2017-04-11', 9, 6, 629, '9531367', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1807, '2017-04-18', 9, 6, 629, '9531367', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1808, '2017-04-25', 9, 6, 629, '9531367', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1809, '2017-05-02', 9, 6, 629, '9531367', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1810, '2017-05-09', 9, 6, 629, '9531367', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1811, '2017-05-16', 9, 6, 629, '9531367', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1812, '2017-05-23', 9, 6, 629, '9531367', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1813, '2017-05-30', 9, 6, 629, '9531367', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1814, '2017-06-06', 9, 6, 629, '9531367', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1815, '2017-06-13', 9, 6, 629, '9531367', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1816, '2017-06-20', 9, 6, 629, '9531367', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1817, '2017-06-27', 9, 6, 629, '9531367', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1818, '2017-07-04', 9, 6, 629, '9531367', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1819, '2017-04-04', 9, 7, 629, '9531367', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1820, '2017-04-11', 9, 7, 629, '9531367', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1821, '2017-04-18', 9, 7, 629, '9531367', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1822, '2017-04-25', 9, 7, 629, '9531367', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1823, '2017-05-02', 9, 7, 629, '9531367', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1824, '2017-05-09', 9, 7, 629, '9531367', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1825, '2017-05-16', 9, 7, 629, '9531367', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1826, '2017-05-23', 9, 7, 629, '9531367', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1827, '2017-05-30', 9, 7, 629, '9531367', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1828, '2017-06-06', 9, 7, 629, '9531367', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1829, '2017-06-13', 9, 7, 629, '9531367', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1830, '2017-06-20', 9, 7, 629, '9531367', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1831, '2017-06-27', 9, 7, 629, '9531367', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1832, '2017-07-04', 9, 7, 629, '9531367', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1833, '2017-04-05', 9, 2, 636, '13905620', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1834, '2017-04-12', 9, 2, 636, '13905620', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1835, '2017-04-19', 9, 2, 636, '13905620', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1836, '2017-04-26', 9, 2, 636, '13905620', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1837, '2017-05-03', 9, 2, 636, '13905620', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1838, '2017-05-10', 9, 2, 636, '13905620', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1839, '2017-05-17', 9, 2, 636, '13905620', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1840, '2017-05-24', 9, 2, 636, '13905620', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1841, '2017-05-31', 9, 2, 636, '13905620', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1842, '2017-06-07', 9, 2, 636, '13905620', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1843, '2017-06-14', 9, 2, 636, '13905620', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1844, '2017-06-21', 9, 2, 636, '13905620', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1845, '2017-06-28', 9, 2, 636, '13905620', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1846, '2017-07-05', 9, 2, 636, '13905620', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (1847, '2017-04-06', 9, 1, 637, '8000412', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1848, '2017-04-13', 9, 1, 637, '8000412', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1849, '2017-04-20', 9, 1, 637, '8000412', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1850, '2017-04-27', 9, 1, 637, '8000412', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1851, '2017-05-04', 9, 1, 637, '8000412', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1852, '2017-05-11', 9, 1, 637, '8000412', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1853, '2017-05-18', 9, 1, 637, '8000412', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1854, '2017-05-25', 9, 1, 637, '8000412', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1855, '2017-06-01', 9, 1, 637, '8000412', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1856, '2017-06-08', 9, 1, 637, '8000412', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1857, '2017-06-15', 9, 1, 637, '8000412', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1858, '2017-06-22', 9, 1, 637, '8000412', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1859, '2017-06-29', 9, 1, 637, '8000412', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1860, '2017-07-06', 9, 1, 637, '8000412', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1861, '2017-04-06', 9, 2, 666, '6577123', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1862, '2017-04-13', 9, 2, 666, '6577123', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1863, '2017-04-20', 9, 2, 666, '6577123', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1864, '2017-04-27', 9, 2, 666, '6577123', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1865, '2017-05-04', 9, 2, 666, '6577123', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1866, '2017-05-11', 9, 2, 666, '6577123', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1867, '2017-05-18', 9, 2, 666, '6577123', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1868, '2017-05-25', 9, 2, 666, '6577123', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1869, '2017-06-01', 9, 2, 666, '6577123', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1870, '2017-06-08', 9, 2, 666, '6577123', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1871, '2017-06-15', 9, 2, 666, '6577123', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1872, '2017-06-22', 9, 2, 666, '6577123', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1873, '2017-06-29', 9, 2, 666, '6577123', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1874, '2017-07-06', 9, 2, 666, '6577123', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1875, '2017-04-06', 9, 3, 646, '9531367', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1876, '2017-04-13', 9, 3, 646, '9531367', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1877, '2017-04-20', 9, 3, 646, '9531367', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1878, '2017-04-27', 9, 3, 646, '9531367', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1879, '2017-05-04', 9, 3, 646, '9531367', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1880, '2017-05-11', 9, 3, 646, '9531367', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1881, '2017-05-18', 9, 3, 646, '9531367', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1882, '2017-05-25', 9, 3, 646, '9531367', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1883, '2017-06-01', 9, 3, 646, '9531367', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1884, '2017-06-08', 9, 3, 646, '9531367', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1885, '2017-06-15', 9, 3, 646, '9531367', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1886, '2017-06-22', 9, 3, 646, '9531367', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1887, '2017-06-29', 9, 3, 646, '9531367', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1888, '2017-07-06', 9, 3, 646, '9531367', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (1889, '2017-04-07', 9, 1, 661, '8814653', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1890, '2017-04-14', 9, 1, 661, '8814653', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1891, '2017-04-21', 9, 1, 661, '8814653', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1892, '2017-04-28', 9, 1, 661, '8814653', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1893, '2017-05-05', 9, 1, 661, '8814653', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1894, '2017-05-12', 9, 1, 661, '8814653', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1895, '2017-05-19', 9, 1, 661, '8814653', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1896, '2017-05-26', 9, 1, 661, '8814653', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1897, '2017-06-02', 9, 1, 661, '8814653', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1898, '2017-06-09', 9, 1, 661, '8814653', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1899, '2017-06-16', 9, 1, 661, '8814653', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1900, '2017-06-23', 9, 1, 661, '8814653', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1901, '2017-06-30', 9, 1, 661, '8814653', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1902, '2017-07-07', 9, 1, 661, '8814653', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1903, '2017-04-07', 9, 2, 661, '8814653', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1904, '2017-04-14', 9, 2, 661, '8814653', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1905, '2017-04-21', 9, 2, 661, '8814653', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1906, '2017-04-28', 9, 2, 661, '8814653', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1907, '2017-05-05', 9, 2, 661, '8814653', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1908, '2017-05-12', 9, 2, 661, '8814653', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1909, '2017-05-19', 9, 2, 661, '8814653', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1910, '2017-05-26', 9, 2, 661, '8814653', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1911, '2017-06-02', 9, 2, 661, '8814653', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1912, '2017-06-09', 9, 2, 661, '8814653', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1913, '2017-06-16', 9, 2, 661, '8814653', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1914, '2017-06-23', 9, 2, 661, '8814653', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1915, '2017-06-30', 9, 2, 661, '8814653', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1916, '2017-07-07', 9, 2, 661, '8814653', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1917, '2017-04-07', 9, 5, 627, '6577123', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1918, '2017-04-14', 9, 5, 627, '6577123', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1919, '2017-04-21', 9, 5, 627, '6577123', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1920, '2017-04-28', 9, 5, 627, '6577123', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1921, '2017-05-05', 9, 5, 627, '6577123', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1922, '2017-05-12', 9, 5, 627, '6577123', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1923, '2017-05-19', 9, 5, 627, '6577123', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1924, '2017-05-26', 9, 5, 627, '6577123', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1925, '2017-06-02', 9, 5, 627, '6577123', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1926, '2017-06-09', 9, 5, 627, '6577123', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1927, '2017-06-16', 9, 5, 627, '6577123', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1928, '2017-06-23', 9, 5, 627, '6577123', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1929, '2017-06-30', 9, 5, 627, '6577123', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1931, '2017-04-07', 9, 6, 624, '17248964', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1932, '2017-04-14', 9, 6, 624, '17248964', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1933, '2017-04-21', 9, 6, 624, '17248964', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1934, '2017-04-28', 9, 6, 624, '17248964', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1935, '2017-05-05', 9, 6, 624, '17248964', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1936, '2017-05-12', 9, 6, 624, '17248964', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1937, '2017-05-19', 9, 6, 624, '17248964', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1938, '2017-05-26', 9, 6, 624, '17248964', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1939, '2017-06-02', 9, 6, 624, '17248964', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1940, '2017-06-09', 9, 6, 624, '17248964', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1941, '2017-06-16', 9, 6, 624, '17248964', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1942, '2017-06-23', 9, 6, 624, '17248964', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1943, '2017-06-30', 9, 6, 624, '17248964', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1944, '2017-07-07', 9, 6, 624, '17248964', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1945, '2017-04-07', 9, 7, 624, '17248964', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1946, '2017-04-14', 9, 7, 624, '17248964', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1947, '2017-04-21', 9, 7, 624, '17248964', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1948, '2017-04-28', 9, 7, 624, '17248964', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1949, '2017-05-05', 9, 7, 624, '17248964', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1950, '2017-05-12', 9, 7, 624, '17248964', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1951, '2017-05-19', 9, 7, 624, '17248964', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1952, '2017-05-26', 9, 7, 624, '17248964', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1953, '2017-06-02', 9, 7, 624, '17248964', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1954, '2017-06-09', 9, 7, 624, '17248964', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1955, '2017-06-16', 9, 7, 624, '17248964', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1956, '2017-06-23', 9, 7, 624, '17248964', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1957, '2017-06-30', 9, 7, 624, '17248964', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1958, '2017-07-07', 9, 7, 624, '17248964', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1960, '2017-04-10', 10, 2, 627, '6577123', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1961, '2017-04-17', 10, 2, 627, '6577123', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1962, '2017-04-24', 10, 2, 627, '6577123', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1963, '2017-05-01', 10, 2, 627, '6577123', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1964, '2017-05-08', 10, 2, 627, '6577123', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1965, '2017-05-15', 10, 2, 627, '6577123', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1966, '2017-05-22', 10, 2, 627, '6577123', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1967, '2017-05-29', 10, 2, 627, '6577123', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1968, '2017-06-05', 10, 2, 627, '6577123', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1969, '2017-06-12', 10, 2, 627, '6577123', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1970, '2017-06-19', 10, 2, 627, '6577123', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1971, '2017-06-26', 10, 2, 627, '6577123', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1972, '2017-07-03', 10, 2, 627, '6577123', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1973, '2017-04-03', 10, 7, 659, '13551137', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1974, '2017-04-10', 10, 7, 659, '13551137', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1975, '2017-04-17', 10, 7, 659, '13551137', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1976, '2017-04-24', 10, 7, 659, '13551137', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1977, '2017-05-01', 10, 7, 659, '13551137', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1978, '2017-05-08', 10, 7, 659, '13551137', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1979, '2017-05-15', 10, 7, 659, '13551137', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1980, '2017-05-22', 10, 7, 659, '13551137', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1981, '2017-05-29', 10, 7, 659, '13551137', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1982, '2017-06-05', 10, 7, 659, '13551137', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1930, '2017-07-07', 9, 5, 627, '6577123', 'semestral', '2017-07-03 00:00:00', '2017-03-28 15:55:56', 'si', 'docente', 'viernes');
INSERT INTO horario VALUES (1983, '2017-06-12', 10, 7, 659, '13551137', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1984, '2017-06-19', 10, 7, 659, '13551137', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1985, '2017-06-26', 10, 7, 659, '13551137', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1986, '2017-07-03', 10, 7, 659, '13551137', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (1987, '2017-04-04', 10, 3, 664, '8727547', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1988, '2017-04-11', 10, 3, 664, '8727547', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1989, '2017-04-18', 10, 3, 664, '8727547', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1990, '2017-04-25', 10, 3, 664, '8727547', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1991, '2017-05-02', 10, 3, 664, '8727547', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1992, '2017-05-09', 10, 3, 664, '8727547', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1993, '2017-05-16', 10, 3, 664, '8727547', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1994, '2017-05-23', 10, 3, 664, '8727547', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1995, '2017-05-30', 10, 3, 664, '8727547', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1996, '2017-06-06', 10, 3, 664, '8727547', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1997, '2017-06-13', 10, 3, 664, '8727547', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1998, '2017-06-20', 10, 3, 664, '8727547', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (1999, '2017-06-27', 10, 3, 664, '8727547', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2000, '2017-07-04', 10, 3, 664, '8727547', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2001, '2017-04-04', 10, 5, 646, '9531367', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2002, '2017-04-11', 10, 5, 646, '9531367', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2003, '2017-04-18', 10, 5, 646, '9531367', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2004, '2017-04-25', 10, 5, 646, '9531367', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2005, '2017-05-02', 10, 5, 646, '9531367', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2006, '2017-05-09', 10, 5, 646, '9531367', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2007, '2017-05-16', 10, 5, 646, '9531367', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2008, '2017-05-23', 10, 5, 646, '9531367', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2009, '2017-05-30', 10, 5, 646, '9531367', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2010, '2017-06-06', 10, 5, 646, '9531367', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2011, '2017-06-13', 10, 5, 646, '9531367', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2012, '2017-06-20', 10, 5, 646, '9531367', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2013, '2017-06-27', 10, 5, 646, '9531367', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2014, '2017-07-04', 10, 5, 646, '9531367', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2015, '2017-04-04', 10, 6, 647, '16641078', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2016, '2017-04-11', 10, 6, 647, '16641078', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2017, '2017-04-18', 10, 6, 647, '16641078', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2018, '2017-04-25', 10, 6, 647, '16641078', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2019, '2017-05-02', 10, 6, 647, '16641078', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2020, '2017-05-09', 10, 6, 647, '16641078', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2021, '2017-05-16', 10, 6, 647, '16641078', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2022, '2017-05-23', 10, 6, 647, '16641078', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2023, '2017-05-30', 10, 6, 647, '16641078', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2024, '2017-06-06', 10, 6, 647, '16641078', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2025, '2017-06-13', 10, 6, 647, '16641078', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2026, '2017-06-20', 10, 6, 647, '16641078', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2027, '2017-06-27', 10, 6, 647, '16641078', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2028, '2017-07-04', 10, 6, 647, '16641078', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2029, '2017-04-05', 10, 1, 662, '8814653', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2030, '2017-04-12', 10, 1, 662, '8814653', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2031, '2017-04-19', 10, 1, 662, '8814653', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2032, '2017-04-26', 10, 1, 662, '8814653', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2033, '2017-05-03', 10, 1, 662, '8814653', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2034, '2017-05-10', 10, 1, 662, '8814653', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2035, '2017-05-17', 10, 1, 662, '8814653', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2036, '2017-05-24', 10, 1, 662, '8814653', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2037, '2017-05-31', 10, 1, 662, '8814653', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2038, '2017-06-07', 10, 1, 662, '8814653', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2039, '2017-06-14', 10, 1, 662, '8814653', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2040, '2017-06-21', 10, 1, 662, '8814653', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2041, '2017-06-28', 10, 1, 662, '8814653', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2042, '2017-07-05', 10, 1, 662, '8814653', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2043, '2017-04-05', 10, 2, 662, '8814653', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2044, '2017-04-12', 10, 2, 662, '8814653', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2045, '2017-04-19', 10, 2, 662, '8814653', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2046, '2017-04-26', 10, 2, 662, '8814653', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2047, '2017-05-03', 10, 2, 662, '8814653', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2048, '2017-05-10', 10, 2, 662, '8814653', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2049, '2017-05-17', 10, 2, 662, '8814653', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2050, '2017-05-24', 10, 2, 662, '8814653', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2051, '2017-05-31', 10, 2, 662, '8814653', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2052, '2017-06-07', 10, 2, 662, '8814653', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2053, '2017-06-14', 10, 2, 662, '8814653', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2054, '2017-06-21', 10, 2, 662, '8814653', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2055, '2017-06-28', 10, 2, 662, '8814653', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2056, '2017-07-05', 10, 2, 662, '8814653', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2057, '2017-04-05', 10, 4, 664, '8727547', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2058, '2017-04-12', 10, 4, 664, '8727547', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2059, '2017-04-19', 10, 4, 664, '8727547', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2060, '2017-04-26', 10, 4, 664, '8727547', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2061, '2017-05-03', 10, 4, 664, '8727547', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2062, '2017-05-10', 10, 4, 664, '8727547', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2063, '2017-05-17', 10, 4, 664, '8727547', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2064, '2017-05-24', 10, 4, 664, '8727547', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2065, '2017-05-31', 10, 4, 664, '8727547', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2066, '2017-06-07', 10, 4, 664, '8727547', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2067, '2017-06-14', 10, 4, 664, '8727547', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2068, '2017-06-21', 10, 4, 664, '8727547', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2069, '2017-06-28', 10, 4, 664, '8727547', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2070, '2017-07-05', 10, 4, 664, '8727547', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2071, '2017-04-05', 10, 6, 658, '8727547', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2072, '2017-04-12', 10, 6, 658, '8727547', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2073, '2017-04-19', 10, 6, 658, '8727547', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2074, '2017-04-26', 10, 6, 658, '8727547', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2075, '2017-05-03', 10, 6, 658, '8727547', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2076, '2017-05-10', 10, 6, 658, '8727547', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2077, '2017-05-17', 10, 6, 658, '8727547', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2078, '2017-05-24', 10, 6, 658, '8727547', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2079, '2017-05-31', 10, 6, 658, '8727547', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2080, '2017-06-07', 10, 6, 658, '8727547', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2081, '2017-06-14', 10, 6, 658, '8727547', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2082, '2017-06-21', 10, 6, 658, '8727547', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2083, '2017-06-28', 10, 6, 658, '8727547', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2084, '2017-07-05', 10, 6, 658, '8727547', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2085, '2017-04-05', 10, 7, 659, '13551137', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2086, '2017-04-12', 10, 7, 659, '13551137', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2087, '2017-04-19', 10, 7, 659, '13551137', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2088, '2017-04-26', 10, 7, 659, '13551137', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2089, '2017-05-03', 10, 7, 659, '13551137', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2090, '2017-05-10', 10, 7, 659, '13551137', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2091, '2017-05-17', 10, 7, 659, '13551137', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2092, '2017-05-24', 10, 7, 659, '13551137', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2093, '2017-05-31', 10, 7, 659, '13551137', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2094, '2017-06-07', 10, 7, 659, '13551137', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2095, '2017-06-14', 10, 7, 659, '13551137', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2096, '2017-06-21', 10, 7, 659, '13551137', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2097, '2017-06-28', 10, 7, 659, '13551137', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2098, '2017-07-05', 10, 7, 659, '13551137', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2099, '2017-04-05', 10, 8, 659, '13551137', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2100, '2017-04-12', 10, 8, 659, '13551137', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2101, '2017-04-19', 10, 8, 659, '13551137', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2102, '2017-04-26', 10, 8, 659, '13551137', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2103, '2017-05-03', 10, 8, 659, '13551137', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2104, '2017-05-10', 10, 8, 659, '13551137', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2105, '2017-05-17', 10, 8, 659, '13551137', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2106, '2017-05-24', 10, 8, 659, '13551137', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2107, '2017-05-31', 10, 8, 659, '13551137', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2108, '2017-06-07', 10, 8, 659, '13551137', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2109, '2017-06-14', 10, 8, 659, '13551137', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2110, '2017-06-21', 10, 8, 659, '13551137', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2111, '2017-06-28', 10, 8, 659, '13551137', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2112, '2017-07-05', 10, 8, 659, '13551137', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2113, '2017-04-06', 10, 2, 627, '6577123', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2114, '2017-04-13', 10, 2, 627, '6577123', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2115, '2017-04-20', 10, 2, 627, '6577123', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2116, '2017-04-27', 10, 2, 627, '6577123', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2117, '2017-05-04', 10, 2, 627, '6577123', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2118, '2017-05-11', 10, 2, 627, '6577123', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2119, '2017-05-18', 10, 2, 627, '6577123', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2120, '2017-05-25', 10, 2, 627, '6577123', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2121, '2017-06-01', 10, 2, 627, '6577123', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2122, '2017-06-08', 10, 2, 627, '6577123', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2123, '2017-06-15', 10, 2, 627, '6577123', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2124, '2017-06-22', 10, 2, 627, '6577123', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2125, '2017-06-29', 10, 2, 627, '6577123', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2126, '2017-07-06', 10, 2, 627, '6577123', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2128, '2017-04-13', 10, 3, 627, '6577123', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2129, '2017-04-20', 10, 3, 627, '6577123', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2130, '2017-04-27', 10, 3, 627, '6577123', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2131, '2017-05-04', 10, 3, 627, '6577123', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2132, '2017-05-11', 10, 3, 627, '6577123', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2133, '2017-05-18', 10, 3, 627, '6577123', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2134, '2017-05-25', 10, 3, 627, '6577123', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2135, '2017-06-01', 10, 3, 627, '6577123', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2136, '2017-06-08', 10, 3, 627, '6577123', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2137, '2017-06-15', 10, 3, 627, '6577123', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2138, '2017-06-22', 10, 3, 627, '6577123', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2139, '2017-06-29', 10, 3, 627, '6577123', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2140, '2017-07-06', 10, 3, 627, '6577123', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2141, '2017-04-07', 10, 2, 666, '6577123', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2142, '2017-04-14', 10, 2, 666, '6577123', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2143, '2017-04-21', 10, 2, 666, '6577123', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2144, '2017-04-28', 10, 2, 666, '6577123', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2145, '2017-05-05', 10, 2, 666, '6577123', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2146, '2017-05-12', 10, 2, 666, '6577123', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2147, '2017-05-19', 10, 2, 666, '6577123', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2148, '2017-05-26', 10, 2, 666, '6577123', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2149, '2017-06-02', 10, 2, 666, '6577123', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2150, '2017-06-09', 10, 2, 666, '6577123', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2151, '2017-06-16', 10, 2, 666, '6577123', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2152, '2017-06-23', 10, 2, 666, '6577123', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2153, '2017-06-30', 10, 2, 666, '6577123', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2154, '2017-07-07', 10, 2, 666, '6577123', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2155, '2017-04-07', 10, 3, 666, '6577123', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2156, '2017-04-14', 10, 3, 666, '6577123', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2157, '2017-04-21', 10, 3, 666, '6577123', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2158, '2017-04-28', 10, 3, 666, '6577123', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2159, '2017-05-05', 10, 3, 666, '6577123', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2160, '2017-05-12', 10, 3, 666, '6577123', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2161, '2017-05-19', 10, 3, 666, '6577123', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2162, '2017-05-26', 10, 3, 666, '6577123', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2163, '2017-06-02', 10, 3, 666, '6577123', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2164, '2017-06-09', 10, 3, 666, '6577123', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2165, '2017-06-16', 10, 3, 666, '6577123', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2166, '2017-06-23', 10, 3, 666, '6577123', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2167, '2017-06-30', 10, 3, 666, '6577123', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2168, '2017-07-07', 10, 3, 666, '6577123', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2169, '2017-04-07', 10, 7, 630, '13551137', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2170, '2017-04-14', 10, 7, 630, '13551137', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2171, '2017-04-21', 10, 7, 630, '13551137', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2172, '2017-04-28', 10, 7, 630, '13551137', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2173, '2017-05-05', 10, 7, 630, '13551137', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2174, '2017-05-12', 10, 7, 630, '13551137', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2175, '2017-05-19', 10, 7, 630, '13551137', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2176, '2017-05-26', 10, 7, 630, '13551137', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2177, '2017-06-02', 10, 7, 630, '13551137', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2178, '2017-06-09', 10, 7, 630, '13551137', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2179, '2017-06-16', 10, 7, 630, '13551137', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2180, '2017-06-23', 10, 7, 630, '13551137', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2181, '2017-06-30', 10, 7, 630, '13551137', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2183, '2017-04-07', 10, 8, 630, '13551137', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2184, '2017-04-14', 10, 8, 630, '13551137', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2185, '2017-04-21', 10, 8, 630, '13551137', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2186, '2017-04-28', 10, 8, 630, '13551137', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2187, '2017-05-05', 10, 8, 630, '13551137', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2188, '2017-05-12', 10, 8, 630, '13551137', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2189, '2017-05-19', 10, 8, 630, '13551137', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2190, '2017-05-26', 10, 8, 630, '13551137', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2191, '2017-06-02', 10, 8, 630, '13551137', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2192, '2017-06-09', 10, 8, 630, '13551137', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2193, '2017-06-16', 10, 8, 630, '13551137', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2194, '2017-06-23', 10, 8, 630, '13551137', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2195, '2017-06-30', 10, 8, 630, '13551137', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2198, '2017-04-10', 24, 1, 648, '10724980', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2199, '2017-04-17', 24, 1, 648, '10724980', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2200, '2017-04-24', 24, 1, 648, '10724980', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2201, '2017-05-01', 24, 1, 648, '10724980', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2202, '2017-05-08', 24, 1, 648, '10724980', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2203, '2017-05-15', 24, 1, 648, '10724980', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2204, '2017-05-22', 24, 1, 648, '10724980', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2205, '2017-05-29', 24, 1, 648, '10724980', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2206, '2017-06-05', 24, 1, 648, '10724980', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2207, '2017-06-12', 24, 1, 648, '10724980', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2208, '2017-06-19', 24, 1, 648, '10724980', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2209, '2017-06-26', 24, 1, 648, '10724980', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2210, '2017-07-03', 24, 1, 648, '10724980', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2212, '2017-04-10', 24, 2, 648, '10724980', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2213, '2017-04-17', 24, 2, 648, '10724980', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2214, '2017-04-24', 24, 2, 648, '10724980', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2215, '2017-05-01', 24, 2, 648, '10724980', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2211, '2017-04-03', 24, 2, 648, '10724980', 'semestral', '2017-04-03 00:00:00', '2017-03-28 15:48:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (2196, '2017-07-07', 10, 8, 630, '13551137', 'semestral', '2017-07-03 00:00:00', '2017-03-28 15:54:48', 'no', 'docente', 'viernes');
INSERT INTO horario VALUES (2182, '2017-07-07', 10, 7, 630, '13551137', 'semestral', '2017-07-03 00:00:00', '2017-03-28 15:55:29', 'si', 'docente', 'viernes');
INSERT INTO horario VALUES (2216, '2017-05-08', 24, 2, 648, '10724980', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2217, '2017-05-15', 24, 2, 648, '10724980', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2218, '2017-05-22', 24, 2, 648, '10724980', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2219, '2017-05-29', 24, 2, 648, '10724980', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2220, '2017-06-05', 24, 2, 648, '10724980', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2221, '2017-06-12', 24, 2, 648, '10724980', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2222, '2017-06-19', 24, 2, 648, '10724980', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2223, '2017-06-26', 24, 2, 648, '10724980', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2224, '2017-07-03', 24, 2, 648, '10724980', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2225, '2017-04-04', 24, 2, 626, '15997886', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2226, '2017-04-11', 24, 2, 626, '15997886', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2227, '2017-04-18', 24, 2, 626, '15997886', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2228, '2017-04-25', 24, 2, 626, '15997886', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2229, '2017-05-02', 24, 2, 626, '15997886', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2230, '2017-05-09', 24, 2, 626, '15997886', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2231, '2017-05-16', 24, 2, 626, '15997886', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2232, '2017-05-23', 24, 2, 626, '15997886', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2233, '2017-05-30', 24, 2, 626, '15997886', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2234, '2017-06-06', 24, 2, 626, '15997886', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2235, '2017-06-13', 24, 2, 626, '15997886', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2236, '2017-06-20', 24, 2, 626, '15997886', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2237, '2017-06-27', 24, 2, 626, '15997886', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2238, '2017-07-04', 24, 2, 626, '15997886', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2239, '2017-04-04', 24, 3, 626, '15997886', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2240, '2017-04-11', 24, 3, 626, '15997886', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2241, '2017-04-18', 24, 3, 626, '15997886', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2242, '2017-04-25', 24, 3, 626, '15997886', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2243, '2017-05-02', 24, 3, 626, '15997886', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2244, '2017-05-09', 24, 3, 626, '15997886', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2245, '2017-05-16', 24, 3, 626, '15997886', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2246, '2017-05-23', 24, 3, 626, '15997886', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2247, '2017-05-30', 24, 3, 626, '15997886', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2248, '2017-06-06', 24, 3, 626, '15997886', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2249, '2017-06-13', 24, 3, 626, '15997886', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2250, '2017-06-20', 24, 3, 626, '15997886', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2251, '2017-06-27', 24, 3, 626, '15997886', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2252, '2017-07-04', 24, 3, 626, '15997886', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2253, '2017-04-04', 24, 4, 650, '5585040', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2254, '2017-04-11', 24, 4, 650, '5585040', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2255, '2017-04-18', 24, 4, 650, '5585040', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2256, '2017-04-25', 24, 4, 650, '5585040', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2257, '2017-05-02', 24, 4, 650, '5585040', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2258, '2017-05-09', 24, 4, 650, '5585040', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2259, '2017-05-16', 24, 4, 650, '5585040', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2260, '2017-05-23', 24, 4, 650, '5585040', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2261, '2017-05-30', 24, 4, 650, '5585040', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2262, '2017-06-06', 24, 4, 650, '5585040', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2263, '2017-06-13', 24, 4, 650, '5585040', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2264, '2017-06-20', 24, 4, 650, '5585040', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2265, '2017-06-27', 24, 4, 650, '5585040', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2266, '2017-07-04', 24, 4, 650, '5585040', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2268, '2017-04-11', 24, 5, 625, '9377008', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2269, '2017-04-18', 24, 5, 625, '9377008', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2270, '2017-04-25', 24, 5, 625, '9377008', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2271, '2017-05-02', 24, 5, 625, '9377008', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2272, '2017-05-09', 24, 5, 625, '9377008', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2273, '2017-05-16', 24, 5, 625, '9377008', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2274, '2017-05-23', 24, 5, 625, '9377008', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2275, '2017-05-30', 24, 5, 625, '9377008', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2276, '2017-06-06', 24, 5, 625, '9377008', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2277, '2017-06-13', 24, 5, 625, '9377008', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2278, '2017-06-20', 24, 5, 625, '9377008', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2279, '2017-06-27', 24, 5, 625, '9377008', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2280, '2017-07-04', 24, 5, 625, '9377008', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2281, '2017-04-04', 24, 6, 625, '9377008', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2282, '2017-04-11', 24, 6, 625, '9377008', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2283, '2017-04-18', 24, 6, 625, '9377008', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2284, '2017-04-25', 24, 6, 625, '9377008', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2285, '2017-05-02', 24, 6, 625, '9377008', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2286, '2017-05-09', 24, 6, 625, '9377008', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2287, '2017-05-16', 24, 6, 625, '9377008', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2288, '2017-05-23', 24, 6, 625, '9377008', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2289, '2017-05-30', 24, 6, 625, '9377008', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2290, '2017-06-06', 24, 6, 625, '9377008', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2291, '2017-06-13', 24, 6, 625, '9377008', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2292, '2017-06-20', 24, 6, 625, '9377008', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2293, '2017-06-27', 24, 6, 625, '9377008', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2294, '2017-07-04', 24, 6, 625, '9377008', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2295, '2017-04-05', 24, 1, 648, '10724980', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2296, '2017-04-12', 24, 1, 648, '10724980', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2297, '2017-04-19', 24, 1, 648, '10724980', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2298, '2017-04-26', 24, 1, 648, '10724980', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2299, '2017-05-03', 24, 1, 648, '10724980', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2300, '2017-05-10', 24, 1, 648, '10724980', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2301, '2017-05-17', 24, 1, 648, '10724980', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2302, '2017-05-24', 24, 1, 648, '10724980', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2303, '2017-05-31', 24, 1, 648, '10724980', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2304, '2017-06-07', 24, 1, 648, '10724980', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2305, '2017-06-14', 24, 1, 648, '10724980', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2306, '2017-06-21', 24, 1, 648, '10724980', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2307, '2017-06-28', 24, 1, 648, '10724980', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2308, '2017-07-05', 24, 1, 648, '10724980', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2309, '2017-04-05', 24, 2, 626, '15997886', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2310, '2017-04-12', 24, 2, 626, '15997886', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2311, '2017-04-19', 24, 2, 626, '15997886', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2312, '2017-04-26', 24, 2, 626, '15997886', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2313, '2017-05-03', 24, 2, 626, '15997886', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2314, '2017-05-10', 24, 2, 626, '15997886', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2315, '2017-05-17', 24, 2, 626, '15997886', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2316, '2017-05-24', 24, 2, 626, '15997886', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2317, '2017-05-31', 24, 2, 626, '15997886', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2318, '2017-06-07', 24, 2, 626, '15997886', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2319, '2017-06-14', 24, 2, 626, '15997886', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2320, '2017-06-21', 24, 2, 626, '15997886', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2321, '2017-06-28', 24, 2, 626, '15997886', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2322, '2017-07-05', 24, 2, 626, '15997886', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2323, '2017-04-05', 24, 4, 625, '18171154', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'ayudante', 'miercoles');
INSERT INTO horario VALUES (2324, '2017-04-12', 24, 4, 625, '18171154', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'ayudante', 'miercoles');
INSERT INTO horario VALUES (2325, '2017-04-19', 24, 4, 625, '18171154', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'ayudante', 'miercoles');
INSERT INTO horario VALUES (2326, '2017-04-26', 24, 4, 625, '18171154', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'ayudante', 'miercoles');
INSERT INTO horario VALUES (2327, '2017-05-03', 24, 4, 625, '18171154', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'ayudante', 'miercoles');
INSERT INTO horario VALUES (2328, '2017-05-10', 24, 4, 625, '18171154', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'ayudante', 'miercoles');
INSERT INTO horario VALUES (2329, '2017-05-17', 24, 4, 625, '18171154', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'ayudante', 'miercoles');
INSERT INTO horario VALUES (2330, '2017-05-24', 24, 4, 625, '18171154', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'ayudante', 'miercoles');
INSERT INTO horario VALUES (2331, '2017-05-31', 24, 4, 625, '18171154', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'ayudante', 'miercoles');
INSERT INTO horario VALUES (2332, '2017-06-07', 24, 4, 625, '18171154', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'ayudante', 'miercoles');
INSERT INTO horario VALUES (2333, '2017-06-14', 24, 4, 625, '18171154', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'ayudante', 'miercoles');
INSERT INTO horario VALUES (2334, '2017-06-21', 24, 4, 625, '18171154', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'ayudante', 'miercoles');
INSERT INTO horario VALUES (2335, '2017-06-28', 24, 4, 625, '18171154', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'ayudante', 'miercoles');
INSERT INTO horario VALUES (2336, '2017-07-05', 24, 4, 625, '18171154', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'ayudante', 'miercoles');
INSERT INTO horario VALUES (2337, '2017-04-06', 24, 2, 625, '9377008', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2338, '2017-04-13', 24, 2, 625, '9377008', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2339, '2017-04-20', 24, 2, 625, '9377008', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2340, '2017-04-27', 24, 2, 625, '9377008', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2341, '2017-05-04', 24, 2, 625, '9377008', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2342, '2017-05-11', 24, 2, 625, '9377008', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2343, '2017-05-18', 24, 2, 625, '9377008', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2344, '2017-05-25', 24, 2, 625, '9377008', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2345, '2017-06-01', 24, 2, 625, '9377008', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2346, '2017-06-08', 24, 2, 625, '9377008', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2347, '2017-06-15', 24, 2, 625, '9377008', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2348, '2017-06-22', 24, 2, 625, '9377008', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2349, '2017-06-29', 24, 2, 625, '9377008', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2350, '2017-07-06', 24, 2, 625, '9377008', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2352, '2017-04-10', 25, 2, 619, '14143131', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2353, '2017-04-17', 25, 2, 619, '14143131', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2354, '2017-04-24', 25, 2, 619, '14143131', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2355, '2017-05-01', 25, 2, 619, '14143131', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2356, '2017-05-08', 25, 2, 619, '14143131', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2357, '2017-05-15', 25, 2, 619, '14143131', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2358, '2017-05-22', 25, 2, 619, '14143131', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2359, '2017-05-29', 25, 2, 619, '14143131', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2360, '2017-06-05', 25, 2, 619, '14143131', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2361, '2017-06-12', 25, 2, 619, '14143131', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2362, '2017-06-19', 25, 2, 619, '14143131', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2363, '2017-06-26', 25, 2, 619, '14143131', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2364, '2017-07-03', 25, 2, 619, '14143131', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2365, '2017-04-03', 25, 3, 623, '9968958', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2366, '2017-04-10', 25, 3, 623, '9968958', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2367, '2017-04-17', 25, 3, 623, '9968958', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2368, '2017-04-24', 25, 3, 623, '9968958', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2369, '2017-05-01', 25, 3, 623, '9968958', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2370, '2017-05-08', 25, 3, 623, '9968958', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2371, '2017-05-15', 25, 3, 623, '9968958', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2372, '2017-05-22', 25, 3, 623, '9968958', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2373, '2017-05-29', 25, 3, 623, '9968958', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2374, '2017-06-05', 25, 3, 623, '9968958', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2375, '2017-06-12', 25, 3, 623, '9968958', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2376, '2017-06-19', 25, 3, 623, '9968958', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2377, '2017-06-26', 25, 3, 623, '9968958', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2378, '2017-07-03', 25, 3, 623, '9968958', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2379, '2017-04-03', 25, 5, 633, '7606339', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2380, '2017-04-10', 25, 5, 633, '7606339', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2381, '2017-04-17', 25, 5, 633, '7606339', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2382, '2017-04-24', 25, 5, 633, '7606339', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2383, '2017-05-01', 25, 5, 633, '7606339', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2384, '2017-05-08', 25, 5, 633, '7606339', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2385, '2017-05-15', 25, 5, 633, '7606339', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2386, '2017-05-22', 25, 5, 633, '7606339', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2387, '2017-05-29', 25, 5, 633, '7606339', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2388, '2017-06-05', 25, 5, 633, '7606339', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2389, '2017-06-12', 25, 5, 633, '7606339', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2390, '2017-06-19', 25, 5, 633, '7606339', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2391, '2017-06-26', 25, 5, 633, '7606339', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2392, '2017-07-03', 25, 5, 633, '7606339', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2393, '2017-04-03', 25, 6, 633, '7606339', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2394, '2017-04-10', 25, 6, 633, '7606339', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2395, '2017-04-17', 25, 6, 633, '7606339', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2396, '2017-04-24', 25, 6, 633, '7606339', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2397, '2017-05-01', 25, 6, 633, '7606339', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2398, '2017-05-08', 25, 6, 633, '7606339', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2399, '2017-05-15', 25, 6, 633, '7606339', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2400, '2017-05-22', 25, 6, 633, '7606339', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2401, '2017-05-29', 25, 6, 633, '7606339', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2402, '2017-06-05', 25, 6, 633, '7606339', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2403, '2017-06-12', 25, 6, 633, '7606339', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2404, '2017-06-19', 25, 6, 633, '7606339', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2405, '2017-06-26', 25, 6, 633, '7606339', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2406, '2017-07-03', 25, 6, 633, '7606339', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2408, '2017-04-11', 25, 3, 631, '7606339', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2409, '2017-04-18', 25, 3, 631, '7606339', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2410, '2017-04-25', 25, 3, 631, '7606339', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2411, '2017-05-02', 25, 3, 631, '7606339', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2412, '2017-05-09', 25, 3, 631, '7606339', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2413, '2017-05-16', 25, 3, 631, '7606339', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2414, '2017-05-23', 25, 3, 631, '7606339', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2415, '2017-05-30', 25, 3, 631, '7606339', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2416, '2017-06-06', 25, 3, 631, '7606339', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2417, '2017-06-13', 25, 3, 631, '7606339', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2418, '2017-06-20', 25, 3, 631, '7606339', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2419, '2017-06-27', 25, 3, 631, '7606339', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2420, '2017-07-04', 25, 3, 631, '7606339', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2421, '2017-04-04', 25, 8, 641, '8300624', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2422, '2017-04-11', 25, 8, 641, '8300624', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2423, '2017-04-18', 25, 8, 641, '8300624', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2424, '2017-04-25', 25, 8, 641, '8300624', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2425, '2017-05-02', 25, 8, 641, '8300624', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2426, '2017-05-09', 25, 8, 641, '8300624', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2427, '2017-05-16', 25, 8, 641, '8300624', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2428, '2017-05-23', 25, 8, 641, '8300624', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2429, '2017-05-30', 25, 8, 641, '8300624', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2430, '2017-06-06', 25, 8, 641, '8300624', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2431, '2017-06-13', 25, 8, 641, '8300624', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2432, '2017-06-20', 25, 8, 641, '8300624', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2433, '2017-06-27', 25, 8, 641, '8300624', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2434, '2017-07-04', 25, 8, 641, '8300624', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2435, '2017-04-04', 25, 9, 641, '8300624', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2436, '2017-04-11', 25, 9, 641, '8300624', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2437, '2017-04-18', 25, 9, 641, '8300624', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2438, '2017-04-25', 25, 9, 641, '8300624', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2439, '2017-05-02', 25, 9, 641, '8300624', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2440, '2017-05-09', 25, 9, 641, '8300624', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2441, '2017-05-16', 25, 9, 641, '8300624', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2442, '2017-05-23', 25, 9, 641, '8300624', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2443, '2017-05-30', 25, 9, 641, '8300624', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2444, '2017-06-06', 25, 9, 641, '8300624', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2445, '2017-06-13', 25, 9, 641, '8300624', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2446, '2017-06-20', 25, 9, 641, '8300624', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2447, '2017-06-27', 25, 9, 641, '8300624', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2448, '2017-07-04', 25, 9, 641, '8300624', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2449, '2017-04-05', 25, 4, 629, '9531367', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2450, '2017-04-12', 25, 4, 629, '9531367', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2451, '2017-04-19', 25, 4, 629, '9531367', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2452, '2017-04-26', 25, 4, 629, '9531367', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2453, '2017-05-03', 25, 4, 629, '9531367', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2454, '2017-05-10', 25, 4, 629, '9531367', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2455, '2017-05-17', 25, 4, 629, '9531367', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2456, '2017-05-24', 25, 4, 629, '9531367', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2457, '2017-05-31', 25, 4, 629, '9531367', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2458, '2017-06-07', 25, 4, 629, '9531367', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2459, '2017-06-14', 25, 4, 629, '9531367', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2460, '2017-06-21', 25, 4, 629, '9531367', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2461, '2017-06-28', 25, 4, 629, '9531367', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2462, '2017-07-05', 25, 4, 629, '9531367', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2463, '2017-04-05', 25, 5, 632, '13196151', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2464, '2017-04-12', 25, 5, 632, '13196151', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2465, '2017-04-19', 25, 5, 632, '13196151', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2466, '2017-04-26', 25, 5, 632, '13196151', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2467, '2017-05-03', 25, 5, 632, '13196151', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2468, '2017-05-10', 25, 5, 632, '13196151', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2469, '2017-05-17', 25, 5, 632, '13196151', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2470, '2017-05-24', 25, 5, 632, '13196151', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2471, '2017-05-31', 25, 5, 632, '13196151', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2472, '2017-06-07', 25, 5, 632, '13196151', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2473, '2017-06-14', 25, 5, 632, '13196151', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2474, '2017-06-21', 25, 5, 632, '13196151', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2475, '2017-06-28', 25, 5, 632, '13196151', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2476, '2017-07-05', 25, 5, 632, '13196151', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2477, '2017-04-05', 25, 6, 650, '5585040', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2478, '2017-04-12', 25, 6, 650, '5585040', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2479, '2017-04-19', 25, 6, 650, '5585040', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2480, '2017-04-26', 25, 6, 650, '5585040', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2481, '2017-05-03', 25, 6, 650, '5585040', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2482, '2017-05-10', 25, 6, 650, '5585040', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2483, '2017-05-17', 25, 6, 650, '5585040', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2484, '2017-05-24', 25, 6, 650, '5585040', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2485, '2017-05-31', 25, 6, 650, '5585040', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2486, '2017-06-07', 25, 6, 650, '5585040', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2487, '2017-06-14', 25, 6, 650, '5585040', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2488, '2017-06-21', 25, 6, 650, '5585040', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2489, '2017-06-28', 25, 6, 650, '5585040', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2490, '2017-07-05', 25, 6, 650, '5585040', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2491, '2017-04-05', 25, 7, 650, '5585040', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2492, '2017-04-12', 25, 7, 650, '5585040', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2493, '2017-04-19', 25, 7, 650, '5585040', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2494, '2017-04-26', 25, 7, 650, '5585040', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2495, '2017-05-03', 25, 7, 650, '5585040', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2496, '2017-05-10', 25, 7, 650, '5585040', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2497, '2017-05-17', 25, 7, 650, '5585040', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2498, '2017-05-24', 25, 7, 650, '5585040', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2499, '2017-05-31', 25, 7, 650, '5585040', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2500, '2017-06-07', 25, 7, 650, '5585040', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2501, '2017-06-14', 25, 7, 650, '5585040', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2502, '2017-06-21', 25, 7, 650, '5585040', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2503, '2017-06-28', 25, 7, 650, '5585040', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2504, '2017-07-05', 25, 7, 650, '5585040', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2505, '2017-04-06', 25, 1, 635, '10471648', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2506, '2017-04-13', 25, 1, 635, '10471648', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2507, '2017-04-20', 25, 1, 635, '10471648', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2508, '2017-04-27', 25, 1, 635, '10471648', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2509, '2017-05-04', 25, 1, 635, '10471648', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2510, '2017-05-11', 25, 1, 635, '10471648', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2511, '2017-05-18', 25, 1, 635, '10471648', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2512, '2017-05-25', 25, 1, 635, '10471648', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2513, '2017-06-01', 25, 1, 635, '10471648', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2514, '2017-06-08', 25, 1, 635, '10471648', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2515, '2017-06-15', 25, 1, 635, '10471648', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2516, '2017-06-22', 25, 1, 635, '10471648', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2517, '2017-06-29', 25, 1, 635, '10471648', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2518, '2017-07-06', 25, 1, 635, '10471648', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2519, '2017-04-06', 25, 2, 635, '10471648', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2520, '2017-04-13', 25, 2, 635, '10471648', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2521, '2017-04-20', 25, 2, 635, '10471648', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2522, '2017-04-27', 25, 2, 635, '10471648', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2523, '2017-05-04', 25, 2, 635, '10471648', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2524, '2017-05-11', 25, 2, 635, '10471648', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2525, '2017-05-18', 25, 2, 635, '10471648', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2526, '2017-05-25', 25, 2, 635, '10471648', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2527, '2017-06-01', 25, 2, 635, '10471648', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2528, '2017-06-08', 25, 2, 635, '10471648', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2529, '2017-06-15', 25, 2, 635, '10471648', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2530, '2017-06-22', 25, 2, 635, '10471648', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2531, '2017-06-29', 25, 2, 635, '10471648', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2532, '2017-07-06', 25, 2, 635, '10471648', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2533, '2017-04-06', 25, 3, 666, '6577123', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2534, '2017-04-13', 25, 3, 666, '6577123', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2535, '2017-04-20', 25, 3, 666, '6577123', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2536, '2017-04-27', 25, 3, 666, '6577123', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2537, '2017-05-04', 25, 3, 666, '6577123', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2538, '2017-05-11', 25, 3, 666, '6577123', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2539, '2017-05-18', 25, 3, 666, '6577123', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2540, '2017-05-25', 25, 3, 666, '6577123', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2541, '2017-06-01', 25, 3, 666, '6577123', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2542, '2017-06-08', 25, 3, 666, '6577123', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2543, '2017-06-15', 25, 3, 666, '6577123', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2544, '2017-06-22', 25, 3, 666, '6577123', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2545, '2017-06-29', 25, 3, 666, '6577123', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2546, '2017-07-06', 25, 3, 666, '6577123', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2547, '2017-04-06', 25, 5, 632, '13196151', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2548, '2017-04-13', 25, 5, 632, '13196151', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2549, '2017-04-20', 25, 5, 632, '13196151', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2550, '2017-04-27', 25, 5, 632, '13196151', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2551, '2017-05-04', 25, 5, 632, '13196151', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2552, '2017-05-11', 25, 5, 632, '13196151', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2553, '2017-05-18', 25, 5, 632, '13196151', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2554, '2017-05-25', 25, 5, 632, '13196151', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2555, '2017-06-01', 25, 5, 632, '13196151', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2556, '2017-06-08', 25, 5, 632, '13196151', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2557, '2017-06-15', 25, 5, 632, '13196151', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2558, '2017-06-22', 25, 5, 632, '13196151', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2559, '2017-06-29', 25, 5, 632, '13196151', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2560, '2017-07-06', 25, 5, 632, '13196151', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2561, '2017-04-06', 25, 8, 641, '8300624', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2562, '2017-04-13', 25, 8, 641, '8300624', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2563, '2017-04-20', 25, 8, 641, '8300624', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2564, '2017-04-27', 25, 8, 641, '8300624', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2565, '2017-05-04', 25, 8, 641, '8300624', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2566, '2017-05-11', 25, 8, 641, '8300624', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2567, '2017-05-18', 25, 8, 641, '8300624', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2568, '2017-05-25', 25, 8, 641, '8300624', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2569, '2017-06-01', 25, 8, 641, '8300624', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2570, '2017-06-08', 25, 8, 641, '8300624', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2571, '2017-06-15', 25, 8, 641, '8300624', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2572, '2017-06-22', 25, 8, 641, '8300624', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2573, '2017-06-29', 25, 8, 641, '8300624', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2574, '2017-07-06', 25, 8, 641, '8300624', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2575, '2017-04-06', 25, 9, 641, '8300624', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2576, '2017-04-13', 25, 9, 641, '8300624', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2577, '2017-04-20', 25, 9, 641, '8300624', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2578, '2017-04-27', 25, 9, 641, '8300624', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2579, '2017-05-04', 25, 9, 641, '8300624', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2580, '2017-05-11', 25, 9, 641, '8300624', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2581, '2017-05-18', 25, 9, 641, '8300624', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2582, '2017-05-25', 25, 9, 641, '8300624', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2583, '2017-06-01', 25, 9, 641, '8300624', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2584, '2017-06-08', 25, 9, 641, '8300624', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2585, '2017-06-15', 25, 9, 641, '8300624', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2586, '2017-06-22', 25, 9, 641, '8300624', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2587, '2017-06-29', 25, 9, 641, '8300624', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2588, '2017-07-06', 25, 9, 641, '8300624', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2589, '2017-04-07', 25, 3, 631, '7606339', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2590, '2017-04-14', 25, 3, 631, '7606339', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2591, '2017-04-21', 25, 3, 631, '7606339', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2592, '2017-04-28', 25, 3, 631, '7606339', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2593, '2017-05-05', 25, 3, 631, '7606339', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2594, '2017-05-12', 25, 3, 631, '7606339', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2595, '2017-05-19', 25, 3, 631, '7606339', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2596, '2017-05-26', 25, 3, 631, '7606339', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2597, '2017-06-02', 25, 3, 631, '7606339', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2598, '2017-06-09', 25, 3, 631, '7606339', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2599, '2017-06-16', 25, 3, 631, '7606339', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2600, '2017-06-23', 25, 3, 631, '7606339', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2601, '2017-06-30', 25, 3, 631, '7606339', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2602, '2017-07-07', 25, 3, 631, '7606339', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2604, '2017-04-10', 26, 2, 635, '10471648', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2605, '2017-04-17', 26, 2, 635, '10471648', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2606, '2017-04-24', 26, 2, 635, '10471648', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2607, '2017-05-01', 26, 2, 635, '10471648', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2608, '2017-05-08', 26, 2, 635, '10471648', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2609, '2017-05-15', 26, 2, 635, '10471648', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2610, '2017-05-22', 26, 2, 635, '10471648', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2611, '2017-05-29', 26, 2, 635, '10471648', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2612, '2017-06-05', 26, 2, 635, '10471648', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2613, '2017-06-12', 26, 2, 635, '10471648', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2614, '2017-06-19', 26, 2, 635, '10471648', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2615, '2017-06-26', 26, 2, 635, '10471648', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2616, '2017-07-03', 26, 2, 635, '10471648', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2617, '2017-04-03', 26, 3, 635, '10471648', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2618, '2017-04-10', 26, 3, 635, '10471648', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2619, '2017-04-17', 26, 3, 635, '10471648', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2620, '2017-04-24', 26, 3, 635, '10471648', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2621, '2017-05-01', 26, 3, 635, '10471648', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2622, '2017-05-08', 26, 3, 635, '10471648', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2623, '2017-05-15', 26, 3, 635, '10471648', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2624, '2017-05-22', 26, 3, 635, '10471648', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2625, '2017-05-29', 26, 3, 635, '10471648', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2626, '2017-06-05', 26, 3, 635, '10471648', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2627, '2017-06-12', 26, 3, 635, '10471648', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2628, '2017-06-19', 26, 3, 635, '10471648', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2629, '2017-06-26', 26, 3, 635, '10471648', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2630, '2017-07-03', 26, 3, 635, '10471648', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2631, '2017-04-03', 26, 6, 658, '8727547', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2632, '2017-04-10', 26, 6, 658, '8727547', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2633, '2017-04-17', 26, 6, 658, '8727547', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2634, '2017-04-24', 26, 6, 658, '8727547', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2635, '2017-05-01', 26, 6, 658, '8727547', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2636, '2017-05-08', 26, 6, 658, '8727547', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2637, '2017-05-15', 26, 6, 658, '8727547', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2638, '2017-05-22', 26, 6, 658, '8727547', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2639, '2017-05-29', 26, 6, 658, '8727547', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2640, '2017-06-05', 26, 6, 658, '8727547', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2641, '2017-06-12', 26, 6, 658, '8727547', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2642, '2017-06-19', 26, 6, 658, '8727547', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2643, '2017-06-26', 26, 6, 658, '8727547', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2644, '2017-07-03', 26, 6, 658, '8727547', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2645, '2017-04-03', 26, 7, 658, '8727547', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2646, '2017-04-10', 26, 7, 658, '8727547', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2647, '2017-04-17', 26, 7, 658, '8727547', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2648, '2017-04-24', 26, 7, 658, '8727547', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2649, '2017-05-01', 26, 7, 658, '8727547', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2650, '2017-05-08', 26, 7, 658, '8727547', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2651, '2017-05-15', 26, 7, 658, '8727547', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2652, '2017-05-22', 26, 7, 658, '8727547', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2653, '2017-05-29', 26, 7, 658, '8727547', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2654, '2017-06-05', 26, 7, 658, '8727547', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2655, '2017-06-12', 26, 7, 658, '8727547', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2656, '2017-06-19', 26, 7, 658, '8727547', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2657, '2017-06-26', 26, 7, 658, '8727547', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2658, '2017-07-03', 26, 7, 658, '8727547', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'lunes');
INSERT INTO horario VALUES (2659, '2017-04-04', 26, 1, 662, '8814653', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2660, '2017-04-11', 26, 1, 662, '8814653', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2661, '2017-04-18', 26, 1, 662, '8814653', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2662, '2017-04-25', 26, 1, 662, '8814653', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2663, '2017-05-02', 26, 1, 662, '8814653', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2664, '2017-05-09', 26, 1, 662, '8814653', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2665, '2017-05-16', 26, 1, 662, '8814653', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2666, '2017-05-23', 26, 1, 662, '8814653', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2667, '2017-05-30', 26, 1, 662, '8814653', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2668, '2017-06-06', 26, 1, 662, '8814653', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2670, '2017-06-20', 26, 1, 662, '8814653', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2671, '2017-06-27', 26, 1, 662, '8814653', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2672, '2017-07-04', 26, 1, 662, '8814653', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2673, '2017-04-04', 26, 2, 662, '8814653', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2674, '2017-04-11', 26, 2, 662, '8814653', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2675, '2017-04-18', 26, 2, 662, '8814653', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2676, '2017-04-25', 26, 2, 662, '8814653', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2677, '2017-05-02', 26, 2, 662, '8814653', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2678, '2017-05-09', 26, 2, 662, '8814653', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2679, '2017-05-16', 26, 2, 662, '8814653', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2680, '2017-05-23', 26, 2, 662, '8814653', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2681, '2017-05-30', 26, 2, 662, '8814653', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2682, '2017-06-06', 26, 2, 662, '8814653', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2683, '2017-06-13', 26, 2, 662, '8814653', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2684, '2017-06-20', 26, 2, 662, '8814653', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2685, '2017-06-27', 26, 2, 662, '8814653', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2686, '2017-07-04', 26, 2, 662, '8814653', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2688, '2017-04-11', 26, 4, 638, '7606339', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2689, '2017-04-18', 26, 4, 638, '7606339', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2690, '2017-04-25', 26, 4, 638, '7606339', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2691, '2017-05-02', 26, 4, 638, '7606339', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2692, '2017-05-09', 26, 4, 638, '7606339', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2693, '2017-05-16', 26, 4, 638, '7606339', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2694, '2017-05-23', 26, 4, 638, '7606339', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2695, '2017-05-30', 26, 4, 638, '7606339', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2696, '2017-06-06', 26, 4, 638, '7606339', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2697, '2017-06-13', 26, 4, 638, '7606339', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2698, '2017-06-20', 26, 4, 638, '7606339', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2699, '2017-06-27', 26, 4, 638, '7606339', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2700, '2017-07-04', 26, 4, 638, '7606339', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2701, '2017-04-04', 26, 5, 638, '7606339', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2702, '2017-04-11', 26, 5, 638, '7606339', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2703, '2017-04-18', 26, 5, 638, '7606339', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2704, '2017-04-25', 26, 5, 638, '7606339', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2705, '2017-05-02', 26, 5, 638, '7606339', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2706, '2017-05-09', 26, 5, 638, '7606339', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2707, '2017-05-16', 26, 5, 638, '7606339', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2708, '2017-05-23', 26, 5, 638, '7606339', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2709, '2017-05-30', 26, 5, 638, '7606339', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2710, '2017-06-06', 26, 5, 638, '7606339', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2711, '2017-06-13', 26, 5, 638, '7606339', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2712, '2017-06-20', 26, 5, 638, '7606339', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2713, '2017-06-27', 26, 5, 638, '7606339', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2714, '2017-07-04', 26, 5, 638, '7606339', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2715, '2017-04-04', 26, 6, 639, '8693477', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2716, '2017-04-11', 26, 6, 639, '8693477', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2717, '2017-04-18', 26, 6, 639, '8693477', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2718, '2017-04-25', 26, 6, 639, '8693477', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2719, '2017-05-02', 26, 6, 639, '8693477', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2720, '2017-05-09', 26, 6, 639, '8693477', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2721, '2017-05-16', 26, 6, 639, '8693477', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2722, '2017-05-23', 26, 6, 639, '8693477', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2723, '2017-05-30', 26, 6, 639, '8693477', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2724, '2017-06-06', 26, 6, 639, '8693477', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2725, '2017-06-13', 26, 6, 639, '8693477', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2726, '2017-06-20', 26, 6, 639, '8693477', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2727, '2017-06-27', 26, 6, 639, '8693477', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2728, '2017-07-04', 26, 6, 639, '8693477', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2729, '2017-04-04', 26, 7, 639, '8693477', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2730, '2017-04-11', 26, 7, 639, '8693477', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2731, '2017-04-18', 26, 7, 639, '8693477', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2732, '2017-04-25', 26, 7, 639, '8693477', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2733, '2017-05-02', 26, 7, 639, '8693477', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2734, '2017-05-09', 26, 7, 639, '8693477', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2735, '2017-05-16', 26, 7, 639, '8693477', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2736, '2017-05-23', 26, 7, 639, '8693477', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2737, '2017-05-30', 26, 7, 639, '8693477', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2738, '2017-06-06', 26, 7, 639, '8693477', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2739, '2017-06-13', 26, 7, 639, '8693477', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2740, '2017-06-20', 26, 7, 639, '8693477', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2741, '2017-06-27', 26, 7, 639, '8693477', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2742, '2017-07-04', 26, 7, 639, '8693477', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'martes');
INSERT INTO horario VALUES (2743, '2017-04-05', 26, 1, 619, '14143131', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2744, '2017-04-12', 26, 1, 619, '14143131', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2745, '2017-04-19', 26, 1, 619, '14143131', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2746, '2017-04-26', 26, 1, 619, '14143131', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2747, '2017-05-03', 26, 1, 619, '14143131', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2748, '2017-05-10', 26, 1, 619, '14143131', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2749, '2017-05-17', 26, 1, 619, '14143131', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2750, '2017-05-24', 26, 1, 619, '14143131', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2751, '2017-05-31', 26, 1, 619, '14143131', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2752, '2017-06-07', 26, 1, 619, '14143131', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2753, '2017-06-14', 26, 1, 619, '14143131', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2754, '2017-06-21', 26, 1, 619, '14143131', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2755, '2017-06-28', 26, 1, 619, '14143131', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2756, '2017-07-05', 26, 1, 619, '14143131', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2757, '2017-04-05', 26, 2, 619, '14143131', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2758, '2017-04-12', 26, 2, 619, '14143131', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2759, '2017-04-19', 26, 2, 619, '14143131', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2760, '2017-04-26', 26, 2, 619, '14143131', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2761, '2017-05-03', 26, 2, 619, '14143131', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2762, '2017-05-10', 26, 2, 619, '14143131', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2763, '2017-05-17', 26, 2, 619, '14143131', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2764, '2017-05-24', 26, 2, 619, '14143131', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2765, '2017-05-31', 26, 2, 619, '14143131', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2766, '2017-06-07', 26, 2, 619, '14143131', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2767, '2017-06-14', 26, 2, 619, '14143131', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2768, '2017-06-21', 26, 2, 619, '14143131', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2769, '2017-06-28', 26, 2, 619, '14143131', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2770, '2017-07-05', 26, 2, 619, '14143131', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2771, '2017-04-05', 26, 3, 658, '8727547', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2772, '2017-04-12', 26, 3, 658, '8727547', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2773, '2017-04-19', 26, 3, 658, '8727547', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2774, '2017-04-26', 26, 3, 658, '8727547', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2775, '2017-05-03', 26, 3, 658, '8727547', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2776, '2017-05-10', 26, 3, 658, '8727547', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2777, '2017-05-17', 26, 3, 658, '8727547', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2778, '2017-05-24', 26, 3, 658, '8727547', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2779, '2017-05-31', 26, 3, 658, '8727547', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2780, '2017-06-07', 26, 3, 658, '8727547', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2781, '2017-06-14', 26, 3, 658, '8727547', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2782, '2017-06-21', 26, 3, 658, '8727547', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2783, '2017-06-28', 26, 3, 658, '8727547', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2784, '2017-07-05', 26, 3, 658, '8727547', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2785, '2017-04-05', 26, 6, 660, '8693477', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2786, '2017-04-12', 26, 6, 660, '8693477', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2787, '2017-04-19', 26, 6, 660, '8693477', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2788, '2017-04-26', 26, 6, 660, '8693477', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2789, '2017-05-03', 26, 6, 660, '8693477', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2790, '2017-05-10', 26, 6, 660, '8693477', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2791, '2017-05-17', 26, 6, 660, '8693477', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2792, '2017-05-24', 26, 6, 660, '8693477', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2793, '2017-05-31', 26, 6, 660, '8693477', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2794, '2017-06-07', 26, 6, 660, '8693477', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2795, '2017-06-14', 26, 6, 660, '8693477', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2796, '2017-06-21', 26, 6, 660, '8693477', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2797, '2017-06-28', 26, 6, 660, '8693477', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2798, '2017-07-05', 26, 6, 660, '8693477', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2799, '2017-04-05', 26, 7, 660, '8693477', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2800, '2017-04-12', 26, 7, 660, '8693477', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2801, '2017-04-19', 26, 7, 660, '8693477', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2802, '2017-04-26', 26, 7, 660, '8693477', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2803, '2017-05-03', 26, 7, 660, '8693477', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2804, '2017-05-10', 26, 7, 660, '8693477', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2805, '2017-05-17', 26, 7, 660, '8693477', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2806, '2017-05-24', 26, 7, 660, '8693477', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2807, '2017-05-31', 26, 7, 660, '8693477', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2808, '2017-06-07', 26, 7, 660, '8693477', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2809, '2017-06-14', 26, 7, 660, '8693477', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2810, '2017-06-21', 26, 7, 660, '8693477', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2811, '2017-06-28', 26, 7, 660, '8693477', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2812, '2017-07-05', 26, 7, 660, '8693477', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'miercoles');
INSERT INTO horario VALUES (2813, '2017-04-06', 26, 2, 623, '9968958', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2814, '2017-04-13', 26, 2, 623, '9968958', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2815, '2017-04-20', 26, 2, 623, '9968958', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2816, '2017-04-27', 26, 2, 623, '9968958', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2817, '2017-05-04', 26, 2, 623, '9968958', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2818, '2017-05-11', 26, 2, 623, '9968958', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2819, '2017-05-18', 26, 2, 623, '9968958', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2820, '2017-05-25', 26, 2, 623, '9968958', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2821, '2017-06-01', 26, 2, 623, '9968958', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2822, '2017-06-08', 26, 2, 623, '9968958', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2823, '2017-06-15', 26, 2, 623, '9968958', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2824, '2017-06-22', 26, 2, 623, '9968958', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2825, '2017-06-29', 26, 2, 623, '9968958', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2826, '2017-07-06', 26, 2, 623, '9968958', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2828, '2017-04-13', 26, 3, 623, '9968958', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2829, '2017-04-20', 26, 3, 623, '9968958', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2830, '2017-04-27', 26, 3, 623, '9968958', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2831, '2017-05-04', 26, 3, 623, '9968958', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2832, '2017-05-11', 26, 3, 623, '9968958', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2833, '2017-05-18', 26, 3, 623, '9968958', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2834, '2017-05-25', 26, 3, 623, '9968958', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2835, '2017-06-01', 26, 3, 623, '9968958', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2836, '2017-06-08', 26, 3, 623, '9968958', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2837, '2017-06-15', 26, 3, 623, '9968958', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2838, '2017-06-22', 26, 3, 623, '9968958', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2839, '2017-06-29', 26, 3, 623, '9968958', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2840, '2017-07-06', 26, 3, 623, '9968958', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'jueves');
INSERT INTO horario VALUES (2841, '2017-04-07', 26, 2, 651, '6870038', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2842, '2017-04-14', 26, 2, 651, '6870038', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2843, '2017-04-21', 26, 2, 651, '6870038', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2844, '2017-04-28', 26, 2, 651, '6870038', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2845, '2017-05-05', 26, 2, 651, '6870038', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2846, '2017-05-12', 26, 2, 651, '6870038', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2847, '2017-05-19', 26, 2, 651, '6870038', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2848, '2017-05-26', 26, 2, 651, '6870038', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2849, '2017-06-02', 26, 2, 651, '6870038', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2850, '2017-06-09', 26, 2, 651, '6870038', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2851, '2017-06-16', 26, 2, 651, '6870038', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2852, '2017-06-23', 26, 2, 651, '6870038', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2853, '2017-06-30', 26, 2, 651, '6870038', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2854, '2017-07-07', 26, 2, 651, '6870038', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2855, '2017-04-07', 26, 3, 651, '6870038', 'semestral', '2017-04-03 00:00:00', '2017-04-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2856, '2017-04-14', 26, 3, 651, '6870038', 'semestral', '2017-04-10 00:00:00', '2017-04-10 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2857, '2017-04-21', 26, 3, 651, '6870038', 'semestral', '2017-04-17 00:00:00', '2017-04-17 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2858, '2017-04-28', 26, 3, 651, '6870038', 'semestral', '2017-04-24 00:00:00', '2017-04-24 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2859, '2017-05-05', 26, 3, 651, '6870038', 'semestral', '2017-05-01 00:00:00', '2017-05-01 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2860, '2017-05-12', 26, 3, 651, '6870038', 'semestral', '2017-05-08 00:00:00', '2017-05-08 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2861, '2017-05-19', 26, 3, 651, '6870038', 'semestral', '2017-05-15 00:00:00', '2017-05-15 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2862, '2017-05-26', 26, 3, 651, '6870038', 'semestral', '2017-05-22 00:00:00', '2017-05-22 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2863, '2017-06-02', 26, 3, 651, '6870038', 'semestral', '2017-05-29 00:00:00', '2017-05-29 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2864, '2017-06-09', 26, 3, 651, '6870038', 'semestral', '2017-06-05 00:00:00', '2017-06-05 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2865, '2017-06-16', 26, 3, 651, '6870038', 'semestral', '2017-06-12 00:00:00', '2017-06-12 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2866, '2017-06-23', 26, 3, 651, '6870038', 'semestral', '2017-06-19 00:00:00', '2017-06-19 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2867, '2017-06-30', 26, 3, 651, '6870038', 'semestral', '2017-06-26 00:00:00', '2017-06-26 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (2868, '2017-07-07', 26, 3, 651, '6870038', 'semestral', '2017-07-03 00:00:00', '2017-07-03 00:00:00', 'Pendiente', 'docente', 'viernes');
INSERT INTO horario VALUES (1717, '2017-03-06', 9, 2, 634, '9666682', 'semestral', '2017-03-01 00:00:00', '2017-03-28 15:45:00', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (2669, '2017-06-13', 26, 1, 662, '8814653', 'semestral', '2017-06-12 00:00:00', '2017-03-28 15:45:08', 'si', 'docente', 'martes');
INSERT INTO horario VALUES (1437, '2017-04-03', 4, 2, 650, '5585040', 'semestral', '2017-04-03 00:00:00', '2017-03-28 15:45:30', 'no', 'docente', 'lunes');
INSERT INTO horario VALUES (2603, '2017-04-03', 26, 2, 635, '10471648', 'semestral', '2017-04-03 00:00:00', '2017-03-28 15:45:43', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (2197, '2017-04-03', 24, 1, 648, '10724980', 'semestral', '2017-04-03 00:00:00', '2017-03-28 15:47:07', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (2127, '2017-04-06', 10, 3, 627, '6577123', 'semestral', '2017-04-03 00:00:00', '2017-03-28 15:53:32', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (1959, '2017-04-03', 10, 2, 627, '6577123', 'semestral', '2017-04-03 00:00:00', '2017-03-28 15:53:47', 'si', 'docente', 'lunes');
INSERT INTO horario VALUES (2687, '2017-04-04', 26, 4, 638, '7606339', 'semestral', '2017-04-03 00:00:00', '2017-03-28 15:54:01', 'si', 'docente', 'martes');
INSERT INTO horario VALUES (1619, '2017-04-06', 4, 3, 617, '5585040', 'semestral', '2017-04-03 00:00:00', '2017-03-28 15:54:18', 'si', 'docente', 'jueves');
INSERT INTO horario VALUES (2351, '2017-04-03', 25, 2, 619, '14143131', 'semestral', '2017-04-03 00:00:00', '2017-03-28 15:54:35', 'no', 'docente', 'lunes');
INSERT INTO horario VALUES (2407, '2017-04-04', 25, 3, 631, '7606339', 'semestral', '2017-04-03 00:00:00', '2017-03-28 15:55:01', 'si', 'docente', 'martes');
INSERT INTO horario VALUES (2267, '2017-04-04', 24, 5, 625, '9377008', 'semestral', '2017-04-03 00:00:00', '2017-03-28 15:55:14', 'si', 'docente', 'martes');
INSERT INTO horario VALUES (2827, '2017-04-06', 26, 3, 623, '9968958', 'semestral', '2017-04-03 00:00:00', '2017-03-28 15:56:36', 'si', 'docente', 'jueves');


--
-- Data for Name: horario_alum; Type: TABLE DATA; Schema: public; Owner: brojas
--



--
-- Name: horario_alum_id_seq; Type: SEQUENCE SET; Schema: public; Owner: brojas
--

SELECT pg_catalog.setval('horario_alum_id_seq', 49, true);


--
-- Name: horario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: brojas
--

SELECT pg_catalog.setval('horario_id_seq', 2868, true);


--
-- Data for Name: periodo; Type: TABLE DATA; Schema: public; Owner: brojas
--

INSERT INTO periodo VALUES (2, 'II', '09:40:00', '11:10:00', '2016-12-11 16:56:28.002522', '2016-12-11 16:56:28.002522');
INSERT INTO periodo VALUES (3, 'III', '11:20:00', '12:50:00', '2016-12-11 16:56:45.536578', '2016-12-11 16:56:45.536578');
INSERT INTO periodo VALUES (4, 'IV', '13:00:00', '14:30:00', '2016-12-11 16:57:10.64195', '2016-12-11 16:57:10.64195');
INSERT INTO periodo VALUES (5, 'V', '14:40:00', '16:10:00', '2016-12-11 16:57:28.136008', '2016-12-11 16:57:28.136008');
INSERT INTO periodo VALUES (6, 'VI', '16:20:00', '17:50:00', '2016-12-11 16:57:45.182463', '2016-12-11 16:57:45.182463');
INSERT INTO periodo VALUES (7, 'VII', '18:00:00', '19:30:00', '2016-12-11 16:58:05.840654', '2016-12-11 16:58:05.840654');
INSERT INTO periodo VALUES (8, 'VIII', '19:00:00', '20:30:00', '2016-12-11 16:58:24.113485', '2016-12-11 16:58:24.113485');
INSERT INTO periodo VALUES (9, 'IX', '20:40:00', '22:10:00', '2016-12-11 16:58:41.445092', '2016-12-11 16:58:41.445092');
INSERT INTO periodo VALUES (1, 'I', '08:00:00', '09:30:00', '2016-12-11 16:56:12.482543', '2017-02-23 21:45:13');


--
-- Name: periodo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: brojas
--

SELECT pg_catalog.setval('periodo_id_seq', 19, true);


--
-- Data for Name: rol; Type: TABLE DATA; Schema: public; Owner: brojas
--

INSERT INTO rol VALUES (1, 'administrador', 'administra el sistema', '2016-12-04 13:22:54.734506', '2016-12-04 13:22:54.734506');
INSERT INTO rol VALUES (2, 'funcionario', 'ahaha', '2016-12-04 13:23:25.551664', '2016-12-04 13:23:25.551664');
INSERT INTO rol VALUES (3, 'docente', 'profes', '2016-12-04 13:23:34.892849', '2016-12-04 13:23:34.892849');
INSERT INTO rol VALUES (4, 'ayudante', 'ayudantias', '2016-12-04 13:23:46.589', '2016-12-04 13:23:46.589');
INSERT INTO rol VALUES (5, 'alumno', 'estudiantes', '2016-12-04 13:23:56.010023', '2016-12-04 13:23:56.010023');
INSERT INTO rol VALUES (6, 'director', 'administrador de labs particulares', '2016-12-04 14:33:17.649129', '2016-12-04 14:33:17.649129');


--
-- Name: rol_id_seq; Type: SEQUENCE SET; Schema: public; Owner: brojas
--

SELECT pg_catalog.setval('rol_id_seq', 10, true);


--
-- Data for Name: rol_users; Type: TABLE DATA; Schema: public; Owner: brojas
--

INSERT INTO rol_users VALUES (96, '9156824', 1, '2017-02-26 18:40:32', '2017-02-26 18:40:32');
INSERT INTO rol_users VALUES (97, '9156824', 2, '2017-02-26 18:40:32', '2017-02-26 18:40:32');
INSERT INTO rol_users VALUES (98, '9156824', 4, '2017-02-26 18:40:32', '2017-02-26 18:40:32');
INSERT INTO rol_users VALUES (99, '9156824', 6, '2017-02-26 18:40:32', '2017-02-26 18:40:32');
INSERT INTO rol_users VALUES (100, '9156824', 5, '2017-02-26 15:41:27.418482', '2017-02-26 15:41:27.418482');
INSERT INTO rol_users VALUES (101, '9156824', 3, '2017-02-26 15:41:51.045066', '2017-02-26 15:41:51.045066');
INSERT INTO rol_users VALUES (120, '18454895', 5, '2017-03-07 19:55:12', '2017-03-07 19:55:12');
INSERT INTO rol_users VALUES (121, '18454895', 1, '2017-03-07 19:55:44', '2017-03-07 19:55:44');
INSERT INTO rol_users VALUES (122, '18454895', 2, '2017-03-07 19:55:44', '2017-03-07 19:55:44');
INSERT INTO rol_users VALUES (123, '18454895', 4, '2017-03-07 19:55:44', '2017-03-07 19:55:44');
INSERT INTO rol_users VALUES (124, '18454895', 6, '2017-03-07 19:55:44', '2017-03-07 19:55:44');
INSERT INTO rol_users VALUES (125, '18454895', 3, '2017-03-07 16:57:01.715062', '2017-03-07 16:57:01.715062');
INSERT INTO rol_users VALUES (129, '17708487', 5, '2017-03-11 00:03:05', '2017-03-11 00:03:05');
INSERT INTO rol_users VALUES (132, '10848101', 2, '2017-03-16 13:50:44', '2017-03-16 13:50:44');
INSERT INTO rol_users VALUES (133, '8000644', 2, '2017-03-16 13:51:17', '2017-03-16 13:51:17');
INSERT INTO rol_users VALUES (134, '10084966', 2, '2017-03-16 17:49:11', '2017-03-16 17:49:11');
INSERT INTO rol_users VALUES (135, '9829109', 2, '2017-03-16 17:49:45', '2017-03-16 17:49:45');
INSERT INTO rol_users VALUES (137, '17836564', 5, '2017-03-17 19:24:14', '2017-03-17 19:24:14');
INSERT INTO rol_users VALUES (138, '18117925', 5, '2017-03-20 21:05:42', '2017-03-20 21:05:42');
INSERT INTO rol_users VALUES (139, '10471648', 3, '2017-03-21 12:46:35.756002', '2017-03-21 12:46:35.756002');
INSERT INTO rol_users VALUES (140, '10724980', 3, '2017-03-21 12:46:45.770476', '2017-03-21 12:46:45.770476');
INSERT INTO rol_users VALUES (141, '12291295', 3, '2017-03-21 12:47:00.524809', '2017-03-21 12:47:00.524809');
INSERT INTO rol_users VALUES (142, '13196151', 3, '2017-03-21 12:47:10.627445', '2017-03-21 12:47:10.627445');
INSERT INTO rol_users VALUES (143, '13551137', 3, '2017-03-21 12:47:16.73977', '2017-03-21 12:47:16.73977');
INSERT INTO rol_users VALUES (144, '13905620', 3, '2017-03-21 12:47:22.974476', '2017-03-21 12:47:22.974476');
INSERT INTO rol_users VALUES (145, '14143131', 3, '2017-03-21 12:47:32.025957', '2017-03-21 12:47:32.025957');
INSERT INTO rol_users VALUES (146, '14569153', 3, '2017-03-21 12:47:37.099947', '2017-03-21 12:47:37.099947');
INSERT INTO rol_users VALUES (147, '15780553', 3, '2017-03-21 12:47:43.321203', '2017-03-21 12:47:43.321203');
INSERT INTO rol_users VALUES (148, '15997886', 3, '2017-03-21 12:48:12.970429', '2017-03-21 12:48:12.970429');
INSERT INTO rol_users VALUES (149, '16641078', 3, '2017-03-21 12:48:19.811527', '2017-03-21 12:48:19.811527');
INSERT INTO rol_users VALUES (150, '17248964', 3, '2017-03-21 12:48:29.046788', '2017-03-21 12:48:29.046788');
INSERT INTO rol_users VALUES (151, '4889256', 3, '2017-03-21 12:48:42.618185', '2017-03-21 12:48:42.618185');
INSERT INTO rol_users VALUES (153, '5794377', 3, '2017-03-21 12:49:05.590672', '2017-03-21 12:49:05.590672');
INSERT INTO rol_users VALUES (155, '6059586', 3, '2017-03-21 12:49:18.021124', '2017-03-21 12:49:18.021124');
INSERT INTO rol_users VALUES (156, '6443706', 3, '2017-03-21 12:49:26.181682', '2017-03-21 12:49:26.181682');
INSERT INTO rol_users VALUES (157, '6577123', 3, '2017-03-21 12:49:35.653998', '2017-03-21 12:49:35.653998');
INSERT INTO rol_users VALUES (158, '6870038', 3, '2017-03-21 12:49:43.113641', '2017-03-21 12:49:43.113641');
INSERT INTO rol_users VALUES (159, '7606339', 3, '2017-03-21 12:49:56.853647', '2017-03-21 12:49:56.853647');
INSERT INTO rol_users VALUES (160, '7760554', 3, '2017-03-21 12:50:07.275544', '2017-03-21 12:50:07.275544');
INSERT INTO rol_users VALUES (161, '7900209', 3, '2017-03-21 12:50:14.833763', '2017-03-21 12:50:14.833763');
INSERT INTO rol_users VALUES (162, '8000412', 3, '2017-03-21 12:50:23.376586', '2017-03-21 12:50:23.376586');
INSERT INTO rol_users VALUES (163, '8300624', 3, '2017-03-21 12:50:33.882193', '2017-03-21 12:50:33.882193');
INSERT INTO rol_users VALUES (165, '8693477', 3, '2017-03-21 12:50:49.081166', '2017-03-21 12:50:49.081166');
INSERT INTO rol_users VALUES (166, '8697837', 3, '2017-03-21 12:50:57.170872', '2017-03-21 12:50:57.170872');
INSERT INTO rol_users VALUES (167, '8727547', 3, '2017-03-21 12:51:04.243046', '2017-03-21 12:51:04.243046');
INSERT INTO rol_users VALUES (168, '8814653', 3, '2017-03-21 12:51:11.614199', '2017-03-21 12:51:11.614199');
INSERT INTO rol_users VALUES (169, '8895953', 3, '2017-03-21 12:51:19.842989', '2017-03-21 12:51:19.842989');
INSERT INTO rol_users VALUES (170, '8927189', 3, '2017-03-21 12:51:28.431787', '2017-03-21 12:51:28.431787');
INSERT INTO rol_users VALUES (172, '9377008', 3, '2017-03-21 12:51:55.165251', '2017-03-21 12:51:55.165251');
INSERT INTO rol_users VALUES (173, '9531367', 3, '2017-03-21 12:52:04.16084', '2017-03-21 12:52:04.16084');
INSERT INTO rol_users VALUES (175, '9666682', 3, '2017-03-21 12:52:23.819955', '2017-03-21 12:52:23.819955');
INSERT INTO rol_users VALUES (176, '9531367', 3, '2017-03-21 12:52:39.630681', '2017-03-21 12:52:39.630681');
INSERT INTO rol_users VALUES (177, '9666682', 3, '2017-03-21 12:52:48.179019', '2017-03-21 12:52:48.179019');
INSERT INTO rol_users VALUES (178, '9968958', 3, '2017-03-21 12:52:56.030427', '2017-03-21 12:52:56.030427');
INSERT INTO rol_users VALUES (180, '5585040', 3, '2017-03-21 17:17:22.797533', '2017-03-21 17:17:22.797533');
INSERT INTO rol_users VALUES (186, '17876307', 5, '2017-03-25 21:47:36', '2017-03-25 21:47:36');
INSERT INTO rol_users VALUES (188, '18171154', 5, '2017-03-25 21:48:53', '2017-03-25 21:48:53');
INSERT INTO rol_users VALUES (189, '7257803', 3, '2017-03-26 16:41:45.565861', '2017-03-26 16:41:45.565861');
INSERT INTO rol_users VALUES (190, '17708487', 4, '2017-03-26 16:57:45.806591', '2017-03-26 16:57:45.806591');
INSERT INTO rol_users VALUES (191, '18171154', 4, '2017-03-26 16:57:53.930731', '2017-03-26 16:57:53.930731');
INSERT INTO rol_users VALUES (192, '6467542', 3, '2017-03-27 15:05:06', '2017-03-27 15:05:06');


--
-- Name: rol_users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: brojas
--

SELECT pg_catalog.setval('rol_users_id_seq', 192, true);


--
-- Data for Name: sala; Type: TABLE DATA; Schema: public; Owner: brojas
--

INSERT INTO sala VALUES (12, 'lab industria', 6, '2016-12-11 22:59:14', '2016-12-11 22:59:21', 2);
INSERT INTO sala VALUES (3, 'Laboratorio N1', 7, '2016-12-04 18:38:42', '2017-02-15 17:23:20', 1);
INSERT INTO sala VALUES (9, 'Laboratorio N3', 9, '2016-12-05 18:39:20', '2017-02-15 17:23:34', 1);
INSERT INTO sala VALUES (10, 'Laboratorio N4', 7, '2016-12-05 18:39:32', '2017-02-15 17:23:41', 1);
INSERT INTO sala VALUES (24, 'Laboratorio N5', 3, '2017-02-15 18:30:43', '2017-02-15 18:30:43', 1);
INSERT INTO sala VALUES (25, 'Laboratorio N6', 2, '2017-02-15 18:30:55', '2017-02-15 18:30:55', 1);
INSERT INTO sala VALUES (26, 'Laboratorio N7', 5, '2017-02-15 18:31:06', '2017-02-15 18:31:06', 1);
INSERT INTO sala VALUES (22, 'Mecánica', 4, '2017-01-05 17:55:54', '2017-02-23 20:24:35', 4);
INSERT INTO sala VALUES (27, 'Electricidad', 3, '2017-02-22 18:23:46', '2017-02-23 21:04:27', 3);
INSERT INTO sala VALUES (4, 'Laboratorio N2', 5, '2016-12-04 18:39:07', '2017-02-27 14:54:23', 1);


--
-- Name: sala_id_seq; Type: SEQUENCE SET; Schema: public; Owner: brojas
--

SELECT pg_catalog.setval('sala_id_seq', 36, true);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: brojas
--

INSERT INTO users VALUES (2, '9156824', 'ruben.antonio.rojas@gmail.com', 'Rubén Antonio', 'Rojas Urbina', '$2y$10$4eWGeWsn5UQ1w.00M25aQOjEGOxm2e7skMRQiMJFJQweu0UqeSF2u', 'perfiles/S3c24vziO3afIaYyto7JV2DpeusVnp-k8n2BLAa9IfH7NdHAVUboMmIbVi66v-avatar04.png', NULL, '2016-12-04 16:26:19', '2017-02-28 19:43:09');
INSERT INTO users VALUES (89, '17708487', 'frubilar@icci.cl', 'Fernando Javier', 'Rubilar Zepeda', NULL, 'perfiles/h1m7G86a6OR1tLguLSNjj20czNunkW-XjSiKjE0nySu06OWdp3dutyuujpnJc-user2-160x160.png', NULL, '2017-03-10 20:33:10', '2017-03-11 00:03:05');
INSERT INTO users VALUES (90, '10848101', 'lab.informatica@utem.cl', 'MARIO HERNAN ', 'MORALES CORVALAN', '$2y$10$d2D69VO578aJofUC.65/guL6ujiwPgZUgNslK9DrFZMAZ.ndR2t7K', 'perfiles/h1m7G86a6OR1tLguLSNjj20czNunkW-XjSiKjE0nySu06OWdp3dutyuujpnJc-user2-160x160.png', NULL, '2017-03-16 13:50:44', '2017-03-16 13:50:44');
INSERT INTO users VALUES (91, '8000644', 'lab.informatica@utem.cl', 'JOSE MANUEL ', 'BARRIGA PADILLA', '$2y$10$2FYyT/PbccaJSLGzopAbEu7B8VPAg.tVcAQi.e8aSses3Kjk1wxa6', 'perfiles/h1m7G86a6OR1tLguLSNjj20czNunkW-XjSiKjE0nySu06OWdp3dutyuujpnJc-user2-160x160.png', NULL, '2017-03-16 13:51:17', '2017-03-16 13:51:17');
INSERT INTO users VALUES (92, '10084966', 'lab.informatica@utem.cl', 'ANDRES ALEJANDRO', 'COLLINAO SAEZ', '$2y$10$Kw21t9ORzEwga4dXflIyV.joZyZbgY2VyAEaqPLVUzQBwK7u.6zw2', 'perfiles/h1m7G86a6OR1tLguLSNjj20czNunkW-XjSiKjE0nySu06OWdp3dutyuujpnJc-user2-160x160.png', NULL, '2017-03-16 17:49:11', '2017-03-16 17:49:11');
INSERT INTO users VALUES (93, '9829109', 'lab.informatica@utem.cl', 'OMAR HERIBERTO', 'VILLALOBOS SOLIS', '$2y$10$zf/j0SVdgEAF.BAIxCP6TOrL5y4aSS24y85iR9YDzj5uExXzrn5Du', 'perfiles/h1m7G86a6OR1tLguLSNjj20czNunkW-XjSiKjE0nySu06OWdp3dutyuujpnJc-user2-160x160.png', NULL, '2017-03-16 17:49:45', '2017-03-16 17:49:45');
INSERT INTO users VALUES (94, '10471648', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-16 18:44:39', '2017-03-16 18:44:39');
INSERT INTO users VALUES (95, '8697837', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-16 18:44:39', '2017-03-16 18:44:39');
INSERT INTO users VALUES (96, '8000412', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-16 18:44:39', '2017-03-16 18:44:39');
INSERT INTO users VALUES (97, '8727547', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-16 18:44:39', '2017-03-16 18:44:39');
INSERT INTO users VALUES (98, '7606339', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-16 18:44:39', '2017-03-16 18:44:39');
INSERT INTO users VALUES (99, '7760554', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-16 18:44:39', '2017-03-16 18:44:39');
INSERT INTO users VALUES (100, '6870038', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-16 18:44:39', '2017-03-16 18:44:39');
INSERT INTO users VALUES (101, '8693477', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-16 18:44:39', '2017-03-16 18:44:39');
INSERT INTO users VALUES (102, '13196151', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-16 18:44:39', '2017-03-16 18:44:39');
INSERT INTO users VALUES (103, '6577123', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-16 18:44:39', '2017-03-16 18:44:39');
INSERT INTO users VALUES (104, '8814653', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-16 18:44:39', '2017-03-16 18:44:39');
INSERT INTO users VALUES (105, '6059586', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-16 18:44:39', '2017-03-16 18:44:39');
INSERT INTO users VALUES (106, '13551137', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-16 18:44:39', '2017-03-16 18:44:39');
INSERT INTO users VALUES (107, '9666682', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-16 18:53:40', '2017-03-16 18:53:40');
INSERT INTO users VALUES (108, '8895953', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-16 18:53:40', '2017-03-16 18:53:40');
INSERT INTO users VALUES (110, '17836564', 'you_gracielitaboo@hotmail.com', 'Graciela Monica', 'Rojas Diaz', NULL, 'perfiles/h1m7G86a6OR1tLguLSNjj20czNunkW-XjSiKjE0nySu06OWdp3dutyuujpnJc-user2-160x160.png', NULL, '2017-03-17 19:24:13', '2017-03-17 19:24:14');
INSERT INTO users VALUES (1, '18454895', 'brojasflores@hotmail.com', 'Barbara Belen', 'Rojas Flores', NULL, 'perfiles/M78HyP2xxafQ8IHvoQA7mGpNtQ4IpL-babii.jpg', NULL, '2016-12-04 16:25:15', '2017-03-17 19:40:07');
INSERT INTO users VALUES (111, '14143131', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users VALUES (112, '6443706', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users VALUES (113, '9968958', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users VALUES (114, '17248964', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users VALUES (115, '9377008', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users VALUES (116, '15997886', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users VALUES (117, '9531367', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users VALUES (118, '13905620', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users VALUES (119, '5794377', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users VALUES (120, '8300624', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users VALUES (121, '15780553', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users VALUES (122, '4889256', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users VALUES (123, '16641078', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users VALUES (124, '10724980', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users VALUES (125, '12291295', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users VALUES (126, '7900209', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users VALUES (127, '8927189', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users VALUES (128, '14569153', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users VALUES (129, '18117925', 'dist0pia@msn.com', 'Nicolas Eladio', 'Vera Palominos', NULL, 'perfiles/h1m7G86a6OR1tLguLSNjj20czNunkW-XjSiKjE0nySu06OWdp3dutyuujpnJc-user2-160x160.png', NULL, '2017-03-20 21:05:42', '2017-03-20 21:05:42');
INSERT INTO users VALUES (134, '5585040', NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-21 20:16:03', '2017-03-21 20:16:03');
INSERT INTO users VALUES (139, '17876307', 'pperez@boaboa.org', 'Patricio Alejan', 'Perez Valverde', NULL, 'perfiles/h1m7G86a6OR1tLguLSNjj20czNunkW-XjSiKjE0nySu06OWdp3dutyuujpnJc-user2-160x160.png', NULL, '2017-03-25 21:32:43', '2017-03-25 21:47:36');
INSERT INTO users VALUES (140, '18171154', 'nicosoto12@hotmail.com', 'Nicolas Valenti', 'Soto Soto', NULL, 'perfiles/h1m7G86a6OR1tLguLSNjj20czNunkW-XjSiKjE0nySu06OWdp3dutyuujpnJc-user2-160x160.png', NULL, '2017-03-25 21:43:38', '2017-03-25 21:48:53');
INSERT INTO users VALUES (141, '7257803', '', '', '', '', '', '', '2017-03-26 16:41:30.863856', '2017-03-26 16:41:30.863856');
INSERT INTO users VALUES (142, '6467542', 'lortega@utem.cl', 'Lidia Del Carmen', 'Ortega Silva', NULL, 'perfiles/h1m7G86a6OR1tLguLSNjj20czNunkW-XjSiKjE0nySu06OWdp3dutyuujpnJc-user2-160x160.png', NULL, '2017-03-27 15:01:31', '2017-03-27 15:09:49');


--
-- Data for Name: users_carrera; Type: TABLE DATA; Schema: public; Owner: brojas
--

INSERT INTO users_carrera VALUES (25, '17708487', 53, '2017-03-14 16:17:58.88779', '2017-03-14 16:17:58.88779');
INSERT INTO users_carrera VALUES (26, '18454895', 53, '2017-03-16 20:15:59', '2017-03-16 20:15:59');
INSERT INTO users_carrera VALUES (27, '18454895', 53, '2017-03-16 20:21:31', '2017-03-16 20:21:31');
INSERT INTO users_carrera VALUES (28, '18454895', 53, '2017-03-16 20:21:46', '2017-03-16 20:21:46');
INSERT INTO users_carrera VALUES (29, '18454895', 53, '2017-03-16 20:21:57', '2017-03-16 20:21:57');
INSERT INTO users_carrera VALUES (30, '18454895', 53, '2017-03-16 20:22:20', '2017-03-16 20:22:20');
INSERT INTO users_carrera VALUES (31, '18454895', 53, '2017-03-16 20:23:46', '2017-03-16 20:23:46');
INSERT INTO users_carrera VALUES (32, '18454895', 53, '2017-03-16 20:29:03', '2017-03-16 20:29:03');
INSERT INTO users_carrera VALUES (34, '18454895', 53, '2017-03-16 20:31:55', '2017-03-16 20:31:55');
INSERT INTO users_carrera VALUES (35, '18454895', 53, '2017-03-17 12:19:15', '2017-03-17 12:19:15');
INSERT INTO users_carrera VALUES (36, '18454895', 53, '2017-03-17 19:35:05', '2017-03-17 19:35:05');
INSERT INTO users_carrera VALUES (37, '17836564', 137, '2017-03-17 19:36:19', '2017-03-17 19:36:19');
INSERT INTO users_carrera VALUES (38, '18454895', 53, '2017-03-17 19:37:51', '2017-03-17 19:37:51');
INSERT INTO users_carrera VALUES (39, '18454895', 53, '2017-03-17 20:18:01', '2017-03-17 20:18:01');
INSERT INTO users_carrera VALUES (40, '18454895', 53, '2017-03-17 20:19:55', '2017-03-17 20:19:55');
INSERT INTO users_carrera VALUES (41, '18454895', 53, '2017-03-17 20:20:34', '2017-03-17 20:20:34');
INSERT INTO users_carrera VALUES (42, '18454895', 53, '2017-03-17 20:20:38', '2017-03-17 20:20:38');
INSERT INTO users_carrera VALUES (43, '18454895', 53, '2017-03-17 20:22:23', '2017-03-17 20:22:23');
INSERT INTO users_carrera VALUES (44, '18454895', 53, '2017-03-20 00:26:46', '2017-03-20 00:26:46');
INSERT INTO users_carrera VALUES (45, '18454895', 53, '2017-03-20 14:20:00', '2017-03-20 14:20:00');
INSERT INTO users_carrera VALUES (46, '18454895', 53, '2017-03-20 19:04:54', '2017-03-20 19:04:54');
INSERT INTO users_carrera VALUES (47, '17836564', 137, '2017-03-20 21:05:00', '2017-03-20 21:05:00');
INSERT INTO users_carrera VALUES (48, '18117925', 53, '2017-03-20 21:05:42', '2017-03-20 21:05:42');
INSERT INTO users_carrera VALUES (49, '18454895', 53, '2017-03-20 21:06:18', '2017-03-20 21:06:18');
INSERT INTO users_carrera VALUES (50, '17876307', 63, '2017-03-25 21:47:36', '2017-03-25 21:47:36');
INSERT INTO users_carrera VALUES (51, '18171154', 53, '2017-03-25 21:48:53', '2017-03-25 21:48:53');
INSERT INTO users_carrera VALUES (52, '18454895', 53, '2017-03-25 21:58:59', '2017-03-25 21:58:59');
INSERT INTO users_carrera VALUES (53, '18454895', 53, '2017-03-25 22:36:38', '2017-03-25 22:36:38');
INSERT INTO users_carrera VALUES (54, '18454895', 53, '2017-03-25 22:38:32', '2017-03-25 22:38:32');
INSERT INTO users_carrera VALUES (55, '18454895', 53, '2017-03-26 17:15:33', '2017-03-26 17:15:33');
INSERT INTO users_carrera VALUES (56, '18171154', 53, '2017-03-26 20:01:39', '2017-03-26 20:01:39');
INSERT INTO users_carrera VALUES (57, '18454895', 53, '2017-03-26 20:03:17', '2017-03-26 20:03:17');
INSERT INTO users_carrera VALUES (58, '18454895', 53, '2017-03-27 14:10:13', '2017-03-27 14:10:13');
INSERT INTO users_carrera VALUES (59, '18454895', 53, '2017-03-27 15:41:59', '2017-03-27 15:41:59');
INSERT INTO users_carrera VALUES (60, '18454895', 53, '2017-03-28 12:39:27', '2017-03-28 12:39:27');


--
-- Data for Name: users_dpto; Type: TABLE DATA; Schema: public; Owner: brojas
--

INSERT INTO users_dpto VALUES (59, '9156824', 1, '2017-02-26 18:40:32', '2017-02-26 18:40:32');
INSERT INTO users_dpto VALUES (93, '17708487', 1, '2017-03-14 16:17:44.508133', '2017-03-14 16:17:44.508133');
INSERT INTO users_dpto VALUES (94, '10848101', 1, '2017-03-16 13:50:44', '2017-03-16 13:50:44');
INSERT INTO users_dpto VALUES (95, '8000644', 1, '2017-03-16 13:51:17', '2017-03-16 13:51:17');
INSERT INTO users_dpto VALUES (96, '10084966', 1, '2017-03-16 17:49:11', '2017-03-16 17:49:11');
INSERT INTO users_dpto VALUES (97, '9829109', 1, '2017-03-16 17:49:45', '2017-03-16 17:49:45');
INSERT INTO users_dpto VALUES (98, '10471648', 1, '2017-03-16 18:44:39', '2017-03-16 18:44:39');
INSERT INTO users_dpto VALUES (99, '8697837', 1, '2017-03-16 18:44:39', '2017-03-16 18:44:39');
INSERT INTO users_dpto VALUES (100, '8000412', 1, '2017-03-16 18:44:39', '2017-03-16 18:44:39');
INSERT INTO users_dpto VALUES (101, '8727547', 1, '2017-03-16 18:44:39', '2017-03-16 18:44:39');
INSERT INTO users_dpto VALUES (102, '7606339', 1, '2017-03-16 18:44:39', '2017-03-16 18:44:39');
INSERT INTO users_dpto VALUES (103, '7760554', 1, '2017-03-16 18:44:39', '2017-03-16 18:44:39');
INSERT INTO users_dpto VALUES (104, '6870038', 1, '2017-03-16 18:44:39', '2017-03-16 18:44:39');
INSERT INTO users_dpto VALUES (105, '8693477', 1, '2017-03-16 18:44:39', '2017-03-16 18:44:39');
INSERT INTO users_dpto VALUES (106, '13196151', 1, '2017-03-16 18:44:39', '2017-03-16 18:44:39');
INSERT INTO users_dpto VALUES (107, '6577123', 1, '2017-03-16 18:44:39', '2017-03-16 18:44:39');
INSERT INTO users_dpto VALUES (108, '8814653', 1, '2017-03-16 18:44:39', '2017-03-16 18:44:39');
INSERT INTO users_dpto VALUES (109, '6059586', 1, '2017-03-16 18:44:39', '2017-03-16 18:44:39');
INSERT INTO users_dpto VALUES (110, '13551137', 1, '2017-03-16 18:44:39', '2017-03-16 18:44:39');
INSERT INTO users_dpto VALUES (111, '9666682', 1, '2017-03-16 18:53:40', '2017-03-16 18:53:40');
INSERT INTO users_dpto VALUES (112, '8895953', 1, '2017-03-16 18:53:40', '2017-03-16 18:53:40');
INSERT INTO users_dpto VALUES (117, '18454895', 1, '2017-03-17 12:19:15', '2017-03-17 12:19:15');
INSERT INTO users_dpto VALUES (119, '17836564', 53, '2017-03-17 19:36:19', '2017-03-17 19:36:19');
INSERT INTO users_dpto VALUES (129, '14143131', 1, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users_dpto VALUES (130, '6443706', 1, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users_dpto VALUES (131, '9968958', 1, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users_dpto VALUES (132, '17248964', 1, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users_dpto VALUES (133, '9377008', 1, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users_dpto VALUES (134, '15997886', 1, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users_dpto VALUES (135, '9531367', 1, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users_dpto VALUES (136, '13905620', 1, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users_dpto VALUES (137, '5794377', 1, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users_dpto VALUES (138, '8300624', 1, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users_dpto VALUES (139, '15780553', 1, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users_dpto VALUES (140, '4889256', 1, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users_dpto VALUES (141, '16641078', 1, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users_dpto VALUES (142, '10724980', 1, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users_dpto VALUES (143, '12291295', 1, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users_dpto VALUES (144, '7900209', 1, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users_dpto VALUES (145, '8927189', 1, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users_dpto VALUES (146, '14569153', 1, '2017-03-20 19:44:01', '2017-03-20 19:44:01');
INSERT INTO users_dpto VALUES (148, '18117925', 1, '2017-03-20 21:05:42', '2017-03-20 21:05:42');
INSERT INTO users_dpto VALUES (153, '5585040', 1, '2017-03-21 20:16:03', '2017-03-21 20:16:03');
INSERT INTO users_dpto VALUES (159, '17876307', 1, '2017-03-25 21:47:36', '2017-03-25 21:47:36');
INSERT INTO users_dpto VALUES (160, '18171154', 1, '2017-03-25 21:48:53', '2017-03-25 21:48:53');
INSERT INTO users_dpto VALUES (161, '18454895', 1, '2017-03-25 21:58:59', '2017-03-25 21:58:59');
INSERT INTO users_dpto VALUES (163, '18454895', 1, '2017-03-25 22:36:38', '2017-03-25 22:36:38');
INSERT INTO users_dpto VALUES (164, '18454895', 1, '2017-03-25 22:38:32', '2017-03-25 22:38:32');
INSERT INTO users_dpto VALUES (165, '18454895', 1, '2017-03-26 17:15:33', '2017-03-26 17:15:33');
INSERT INTO users_dpto VALUES (166, '7257803', 1, '2017-03-26 16:41:58.736868', '2017-03-26 16:41:58.736868');
INSERT INTO users_dpto VALUES (167, '18171154', 1, '2017-03-26 20:01:39', '2017-03-26 20:01:39');
INSERT INTO users_dpto VALUES (168, '18454895', 1, '2017-03-26 20:03:17', '2017-03-26 20:03:17');
INSERT INTO users_dpto VALUES (169, '18454895', 1, '2017-03-27 14:10:13', '2017-03-27 14:10:13');
INSERT INTO users_dpto VALUES (170, '6467542', 38, '2017-03-27 15:09:49', '2017-03-27 15:09:49');
INSERT INTO users_dpto VALUES (171, '18454895', 1, '2017-03-27 15:41:59', '2017-03-27 15:41:59');
INSERT INTO users_dpto VALUES (172, '18454895', 1, '2017-03-28 12:39:27', '2017-03-28 12:39:27');


--
-- Name: users_dpto_id_seq; Type: SEQUENCE SET; Schema: public; Owner: brojas
--

SELECT pg_catalog.setval('users_dpto_id_seq', 172, true);


--
-- Name: users_escuela_id_seq; Type: SEQUENCE SET; Schema: public; Owner: brojas
--

SELECT pg_catalog.setval('users_escuela_id_seq', 60, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: brojas
--

SELECT pg_catalog.setval('users_id_seq', 142, true);


--
-- Name: asignatura_pkey; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY asignatura
    ADD CONSTRAINT asignatura_pkey PRIMARY KEY (id);


--
-- Name: campus_nombre_key; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY campus
    ADD CONSTRAINT campus_nombre_key UNIQUE (nombre);


--
-- Name: campus_pkey; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY campus
    ADD CONSTRAINT campus_pkey PRIMARY KEY (id);


--
-- Name: carrera_codigo_key; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY carrera
    ADD CONSTRAINT carrera_codigo_key UNIQUE (codigo);


--
-- Name: carrera_codigo_nombre_key; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY carrera
    ADD CONSTRAINT carrera_codigo_nombre_key UNIQUE (codigo, nombre);


--
-- Name: carrera_pkey; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY carrera
    ADD CONSTRAINT carrera_pkey PRIMARY KEY (id);


--
-- Name: carrera_sala_pkey; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY carrera_sala
    ADD CONSTRAINT carrera_sala_pkey PRIMARY KEY (id);


--
-- Name: curso_asignatura_id_semestre_anio_seccion_key; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY curso
    ADD CONSTRAINT curso_asignatura_id_semestre_anio_seccion_key UNIQUE (asignatura_id, semestre, anio, seccion);


--
-- Name: curso_pkey; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY curso
    ADD CONSTRAINT curso_pkey PRIMARY KEY (id);


--
-- Name: departamento_nombre_facultad_id_key; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY departamento
    ADD CONSTRAINT departamento_nombre_facultad_id_key UNIQUE (nombre, facultad_id);


--
-- Name: departamento_pkey; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY departamento
    ADD CONSTRAINT departamento_pkey PRIMARY KEY (id);


--
-- Name: escuela_nombre_departamento_id_key; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY escuela
    ADD CONSTRAINT escuela_nombre_departamento_id_key UNIQUE (nombre, departamento_id);


--
-- Name: escuela_pkey; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY escuela
    ADD CONSTRAINT escuela_pkey PRIMARY KEY (id);


--
-- Name: estacion_trabajo_pkey; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY estacion_trabajo
    ADD CONSTRAINT estacion_trabajo_pkey PRIMARY KEY (id);


--
-- Name: facultad_nombre_key; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY facultad
    ADD CONSTRAINT facultad_nombre_key UNIQUE (nombre);


--
-- Name: facultad_pkey; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY facultad
    ADD CONSTRAINT facultad_pkey PRIMARY KEY (id);


--
-- Name: horario_alum_fecha_sala_id_periodo_id_estacion_trabajo_id_key; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY horario_alum
    ADD CONSTRAINT horario_alum_fecha_sala_id_periodo_id_estacion_trabajo_id_key UNIQUE (fecha, sala_id, periodo_id, estacion_trabajo_id);


--
-- Name: horario_alum_pkey; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY horario_alum
    ADD CONSTRAINT horario_alum_pkey PRIMARY KEY (id);


--
-- Name: horario_fecha_sala_id_periodo_id_curso_id_key; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY horario
    ADD CONSTRAINT horario_fecha_sala_id_periodo_id_curso_id_key UNIQUE (fecha, sala_id, periodo_id, curso_id);


--
-- Name: horario_pkey; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY horario
    ADD CONSTRAINT horario_pkey PRIMARY KEY (id);


--
-- Name: periodo_bloque_key; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY periodo
    ADD CONSTRAINT periodo_bloque_key UNIQUE (bloque);


--
-- Name: periodo_inicio_fin_key; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY periodo
    ADD CONSTRAINT periodo_inicio_fin_key UNIQUE (inicio, fin);


--
-- Name: periodo_pkey; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY periodo
    ADD CONSTRAINT periodo_pkey PRIMARY KEY (id);


--
-- Name: rol_nombre_key; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY rol
    ADD CONSTRAINT rol_nombre_key UNIQUE (nombre);


--
-- Name: rol_pkey; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY rol
    ADD CONSTRAINT rol_pkey PRIMARY KEY (id);


--
-- Name: rol_users_pkey; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY rol_users
    ADD CONSTRAINT rol_users_pkey PRIMARY KEY (id);


--
-- Name: sala_nombre_key; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY sala
    ADD CONSTRAINT sala_nombre_key UNIQUE (nombre);


--
-- Name: sala_pkey; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY sala
    ADD CONSTRAINT sala_pkey PRIMARY KEY (id);


--
-- Name: users_dpto_pkey; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY users_dpto
    ADD CONSTRAINT users_dpto_pkey PRIMARY KEY (id);


--
-- Name: users_escuela_pkey; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY users_carrera
    ADD CONSTRAINT users_escuela_pkey PRIMARY KEY (id);


--
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: brojas; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (rut);


--
-- Name: asignatura_carrera_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY asignatura
    ADD CONSTRAINT asignatura_carrera_id_fkey FOREIGN KEY (carrera_id) REFERENCES carrera(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: carrera_escuela_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY carrera
    ADD CONSTRAINT carrera_escuela_id_fkey FOREIGN KEY (escuela_id) REFERENCES escuela(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: carrera_sala_carrera_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY carrera_sala
    ADD CONSTRAINT carrera_sala_carrera_id_fkey FOREIGN KEY (carrera_id) REFERENCES carrera(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: carrera_sala_sala_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY carrera_sala
    ADD CONSTRAINT carrera_sala_sala_id_fkey FOREIGN KEY (sala_id) REFERENCES sala(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: curso_asignatura_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY curso
    ADD CONSTRAINT curso_asignatura_id_fkey FOREIGN KEY (asignatura_id) REFERENCES asignatura(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: departamento_facultad_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY departamento
    ADD CONSTRAINT departamento_facultad_id_fkey FOREIGN KEY (facultad_id) REFERENCES facultad(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: escuela_departamento_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY escuela
    ADD CONSTRAINT escuela_departamento_id_fkey FOREIGN KEY (departamento_id) REFERENCES departamento(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: estacion_trabajo_periodo_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY estacion_trabajo
    ADD CONSTRAINT estacion_trabajo_periodo_id_fkey FOREIGN KEY (periodo_id) REFERENCES periodo(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: estacion_trabajo_sala_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY estacion_trabajo
    ADD CONSTRAINT estacion_trabajo_sala_id_fkey FOREIGN KEY (sala_id) REFERENCES sala(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: facultad_campus_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY facultad
    ADD CONSTRAINT facultad_campus_id_fkey FOREIGN KEY (campus_id) REFERENCES campus(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: horario_alum_estacion_trabajo_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY horario_alum
    ADD CONSTRAINT horario_alum_estacion_trabajo_id_fkey FOREIGN KEY (estacion_trabajo_id) REFERENCES estacion_trabajo(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: horario_alum_periodo_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY horario_alum
    ADD CONSTRAINT horario_alum_periodo_id_fkey FOREIGN KEY (periodo_id) REFERENCES periodo(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: horario_alum_rut_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY horario_alum
    ADD CONSTRAINT horario_alum_rut_fkey FOREIGN KEY (rut) REFERENCES users(rut) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: horario_alum_sala_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY horario_alum
    ADD CONSTRAINT horario_alum_sala_id_fkey FOREIGN KEY (sala_id) REFERENCES sala(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: horario_curso_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY horario
    ADD CONSTRAINT horario_curso_id_fkey FOREIGN KEY (curso_id) REFERENCES curso(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: horario_periodo_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY horario
    ADD CONSTRAINT horario_periodo_id_fkey FOREIGN KEY (periodo_id) REFERENCES periodo(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: horario_rut_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY horario
    ADD CONSTRAINT horario_rut_fkey FOREIGN KEY (rut) REFERENCES users(rut) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: horario_sala_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY horario
    ADD CONSTRAINT horario_sala_id_fkey FOREIGN KEY (sala_id) REFERENCES sala(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: rol_users_rol_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY rol_users
    ADD CONSTRAINT rol_users_rol_id_fkey FOREIGN KEY (rol_id) REFERENCES rol(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: rol_users_rut_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY rol_users
    ADD CONSTRAINT rol_users_rut_fkey FOREIGN KEY (rut) REFERENCES users(rut) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: sala_departamento_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY sala
    ADD CONSTRAINT sala_departamento_id_fkey FOREIGN KEY (departamento_id) REFERENCES departamento(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: users_dpto_departamento_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY users_dpto
    ADD CONSTRAINT users_dpto_departamento_id_fkey FOREIGN KEY (departamento_id) REFERENCES departamento(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: users_dpto_rut_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY users_dpto
    ADD CONSTRAINT users_dpto_rut_fkey FOREIGN KEY (rut) REFERENCES users(rut) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: users_escuela_carrera_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY users_carrera
    ADD CONSTRAINT users_escuela_carrera_id_fkey FOREIGN KEY (carrera_id) REFERENCES carrera(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: users_escuela_rut_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brojas
--

ALTER TABLE ONLY users_carrera
    ADD CONSTRAINT users_escuela_rut_fkey FOREIGN KEY (rut) REFERENCES users(rut) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

