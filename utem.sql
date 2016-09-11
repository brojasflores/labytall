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
-- Name: asignatura; Type: TABLE; Schema: public; Owner: barbarita; Tablespace: 
--

CREATE TABLE asignatura (
    id bigint NOT NULL,
    codigo character varying(255) NOT NULL,
    nombre character varying(255) NOT NULL,
    descripcion text,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.asignatura OWNER TO barbarita;

--
-- Name: asignatura_id_seq; Type: SEQUENCE; Schema: public; Owner: barbarita
--

CREATE SEQUENCE asignatura_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.asignatura_id_seq OWNER TO barbarita;

--
-- Name: asignatura_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: barbarita
--

ALTER SEQUENCE asignatura_id_seq OWNED BY asignatura.id;


--
-- Name: curso; Type: TABLE; Schema: public; Owner: barbarita; Tablespace: 
--

CREATE TABLE curso (
    id bigint NOT NULL,
    asignatura_id bigint NOT NULL,
    semestre integer NOT NULL,
    anio integer NOT NULL,
    seccion integer NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.curso OWNER TO barbarita;

--
-- Name: curso_id_seq; Type: SEQUENCE; Schema: public; Owner: barbarita
--

CREATE SEQUENCE curso_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.curso_id_seq OWNER TO barbarita;

--
-- Name: curso_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: barbarita
--

ALTER SEQUENCE curso_id_seq OWNED BY curso.id;


--
-- Name: horario; Type: TABLE; Schema: public; Owner: barbarita; Tablespace: 
--

CREATE TABLE horario (
    id bigint NOT NULL,
    fecha date DEFAULT now() NOT NULL,
    sala_id bigint NOT NULL,
    periodo_id integer NOT NULL,
    curso_id bigint NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.horario OWNER TO barbarita;

--
-- Name: horario_id_seq; Type: SEQUENCE; Schema: public; Owner: barbarita
--

CREATE SEQUENCE horario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.horario_id_seq OWNER TO barbarita;

--
-- Name: horario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: barbarita
--

ALTER SEQUENCE horario_id_seq OWNED BY horario.id;


--
-- Name: periodo; Type: TABLE; Schema: public; Owner: barbarita; Tablespace: 
--

CREATE TABLE periodo (
    id bigint NOT NULL,
    bloque character varying(255) NOT NULL,
    inicio time without time zone NOT NULL,
    fin time without time zone NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.periodo OWNER TO barbarita;

--
-- Name: periodo_id_seq; Type: SEQUENCE; Schema: public; Owner: barbarita
--

CREATE SEQUENCE periodo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.periodo_id_seq OWNER TO barbarita;

--
-- Name: periodo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: barbarita
--

ALTER SEQUENCE periodo_id_seq OWNED BY periodo.id;


--
-- Name: rol; Type: TABLE; Schema: public; Owner: barbarita; Tablespace: 
--

CREATE TABLE rol (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    descripcion text,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.rol OWNER TO barbarita;

--
-- Name: rol_id_seq; Type: SEQUENCE; Schema: public; Owner: barbarita
--

CREATE SEQUENCE rol_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.rol_id_seq OWNER TO barbarita;

--
-- Name: rol_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: barbarita
--

ALTER SEQUENCE rol_id_seq OWNED BY rol.id;


--
-- Name: rol_usuario; Type: TABLE; Schema: public; Owner: barbarita; Tablespace: 
--

CREATE TABLE rol_usuario (
    id integer NOT NULL,
    rut integer NOT NULL,
    rol_id integer NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.rol_usuario OWNER TO barbarita;

--
-- Name: rol_usuario_id_seq; Type: SEQUENCE; Schema: public; Owner: barbarita
--

CREATE SEQUENCE rol_usuario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.rol_usuario_id_seq OWNER TO barbarita;

--
-- Name: rol_usuario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: barbarita
--

ALTER SEQUENCE rol_usuario_id_seq OWNED BY rol_usuario.id;


--
-- Name: sala; Type: TABLE; Schema: public; Owner: barbarita; Tablespace: 
--

CREATE TABLE sala (
    id bigint NOT NULL,
    nombre character varying(255) NOT NULL,
    capacidad integer NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.sala OWNER TO barbarita;

--
-- Name: sala_id_seq; Type: SEQUENCE; Schema: public; Owner: barbarita
--

CREATE SEQUENCE sala_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sala_id_seq OWNER TO barbarita;

--
-- Name: sala_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: barbarita
--

ALTER SEQUENCE sala_id_seq OWNED BY sala.id;


--
-- Name: usuario; Type: TABLE; Schema: public; Owner: barbarita; Tablespace: 
--

CREATE TABLE usuario (
    id bigint NOT NULL,
    rut integer NOT NULL,
    email character varying(255),
    nombres character varying(255),
    apellidos character varying(255),
    pass character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.usuario OWNER TO barbarita;

--
-- Name: usuario_id_seq; Type: SEQUENCE; Schema: public; Owner: barbarita
--

CREATE SEQUENCE usuario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuario_id_seq OWNER TO barbarita;

--
-- Name: usuario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: barbarita
--

ALTER SEQUENCE usuario_id_seq OWNED BY usuario.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: barbarita
--

ALTER TABLE ONLY asignatura ALTER COLUMN id SET DEFAULT nextval('asignatura_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: barbarita
--

ALTER TABLE ONLY curso ALTER COLUMN id SET DEFAULT nextval('curso_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: barbarita
--

ALTER TABLE ONLY horario ALTER COLUMN id SET DEFAULT nextval('horario_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: barbarita
--

ALTER TABLE ONLY periodo ALTER COLUMN id SET DEFAULT nextval('periodo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: barbarita
--

ALTER TABLE ONLY rol ALTER COLUMN id SET DEFAULT nextval('rol_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: barbarita
--

ALTER TABLE ONLY rol_usuario ALTER COLUMN id SET DEFAULT nextval('rol_usuario_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: barbarita
--

ALTER TABLE ONLY sala ALTER COLUMN id SET DEFAULT nextval('sala_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: barbarita
--

ALTER TABLE ONLY usuario ALTER COLUMN id SET DEFAULT nextval('usuario_id_seq'::regclass);


--
-- Data for Name: asignatura; Type: TABLE DATA; Schema: public; Owner: barbarita
--



--
-- Name: asignatura_id_seq; Type: SEQUENCE SET; Schema: public; Owner: barbarita
--

SELECT pg_catalog.setval('asignatura_id_seq', 1, false);


--
-- Data for Name: curso; Type: TABLE DATA; Schema: public; Owner: barbarita
--



--
-- Name: curso_id_seq; Type: SEQUENCE SET; Schema: public; Owner: barbarita
--

SELECT pg_catalog.setval('curso_id_seq', 1, false);


--
-- Data for Name: horario; Type: TABLE DATA; Schema: public; Owner: barbarita
--



--
-- Name: horario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: barbarita
--

SELECT pg_catalog.setval('horario_id_seq', 1, false);


--
-- Data for Name: periodo; Type: TABLE DATA; Schema: public; Owner: barbarita
--



--
-- Name: periodo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: barbarita
--

SELECT pg_catalog.setval('periodo_id_seq', 1, false);


--
-- Data for Name: rol; Type: TABLE DATA; Schema: public; Owner: barbarita
--

INSERT INTO rol VALUES (1, 'administrador', 'administrador total del sistema', '2016-09-11 12:21:28.192549', '2016-09-11 12:21:28.192549');
INSERT INTO rol VALUES (2, 'funcionario', 'asignan laboratorios, no pueden hacer crud con usuarios', '2016-09-11 12:25:33.316454', '2016-09-11 12:25:33.316454');
INSERT INTO rol VALUES (3, 'docente', 'reserva un laboratorio completo por máximo 2 periodos (por asignatura)', '2016-09-11 12:33:46.497446', '2016-09-11 12:33:46.497446');
INSERT INTO rol VALUES (4, 'ayudante', 'reserva un laboratorio completo por máximo un periodo.', '2016-09-11 12:34:46.332285', '2016-09-11 12:34:46.332285');
INSERT INTO rol VALUES (5, 'alumno', 'puede reservar una estación de trabajo por un periodo.', '2016-09-11 12:35:52.537371', '2016-09-11 12:35:52.537371');


--
-- Name: rol_id_seq; Type: SEQUENCE SET; Schema: public; Owner: barbarita
--

SELECT pg_catalog.setval('rol_id_seq', 5, true);


--
-- Data for Name: rol_usuario; Type: TABLE DATA; Schema: public; Owner: barbarita
--

INSERT INTO rol_usuario VALUES (3, 928389872, 1, '2016-09-11 19:06:58', '2016-09-11 19:06:58');
INSERT INTO rol_usuario VALUES (4, 928389872, 2, '2016-09-11 19:06:58', '2016-09-11 19:06:58');
INSERT INTO rol_usuario VALUES (5, 928389872, 4, '2016-09-11 19:06:58', '2016-09-11 19:06:58');


--
-- Name: rol_usuario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: barbarita
--

SELECT pg_catalog.setval('rol_usuario_id_seq', 5, true);


--
-- Data for Name: sala; Type: TABLE DATA; Schema: public; Owner: barbarita
--

INSERT INTO sala VALUES (3, 'Laboratorio N°3', 13, '2016-09-11 02:32:08', '2016-09-11 02:33:12');
INSERT INTO sala VALUES (2, 'Laboratorio N°2', 44, '2016-09-10 22:37:08.889494', '2016-09-11 02:35:05');
INSERT INTO sala VALUES (4, 'Laboratorio N°4', 32, '2016-09-11 02:36:14', '2016-09-11 02:36:14');
INSERT INTO sala VALUES (1, 'Laboratorio N°1', 33, '2016-09-10 22:36:54.660874', '2016-09-11 02:43:28');


--
-- Name: sala_id_seq; Type: SEQUENCE SET; Schema: public; Owner: barbarita
--

SELECT pg_catalog.setval('sala_id_seq', 6, true);


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: barbarita
--

INSERT INTO usuario VALUES (5, 9746516, 'samara.schneider@langosh.com', 'Stuart', 'Bosco', 'ncX9AF', NULL, '2016-09-11 12:49:47.490215', '2016-09-11 12:49:47.490215');
INSERT INTO usuario VALUES (6, 2590912, 'robin.halvorson@legros.com', 'Jammie', 'Brakus', '^Zr))''rs''.v''l', NULL, '2016-09-11 12:49:47.501304', '2016-09-11 12:49:47.501304');
INSERT INTO usuario VALUES (7, 12036037, 'rjones@gmail.com', 'Libby', 'O''Connell', '@Koy{r', NULL, '2016-09-11 12:49:47.511666', '2016-09-11 12:49:47.511666');
INSERT INTO usuario VALUES (8, 10439023, 'shawn92@lynch.com', 'Antonia', 'Altenwerth', '%]jv^|_(@sQ<,0@bOQ6i', NULL, '2016-09-11 12:49:47.524392', '2016-09-11 12:49:47.524392');
INSERT INTO usuario VALUES (9, 11433581, 'nikko22@mcdermott.info', 'Watson', 'Gerhold', 'mUt|GL0iZvWy#<', NULL, '2016-09-11 12:49:47.534117', '2016-09-11 12:49:47.534117');
INSERT INTO usuario VALUES (10, 2121178, 'rleannon@hotmail.com', 'Madaline', 'Spinka', 'KJ!)d?D^Da', NULL, '2016-09-11 12:49:47.544363', '2016-09-11 12:49:47.544363');
INSERT INTO usuario VALUES (11, 4914484, 'nritchie@zieme.biz', 'Cordia', 'Mayer', '[5LW]a/4PyX', NULL, '2016-09-11 12:49:47.555976', '2016-09-11 12:49:47.555976');
INSERT INTO usuario VALUES (12, 10867856, 'hyman.gerhold@yahoo.com', 'Estel', 'Cummings', 'H:DQv5"Y{`U{n<C:c_H', NULL, '2016-09-11 12:49:47.567613', '2016-09-11 12:49:47.567613');
INSERT INTO usuario VALUES (13, 10963091, 'aubree.erdman@yahoo.com', 'Efrain', 'Greenholt', 'm?)ACZ1e\kuhXlb', NULL, '2016-09-11 12:49:47.578688', '2016-09-11 12:49:47.578688');
INSERT INTO usuario VALUES (14, 10165081, 'ubernhard@padberg.com', 'Lewis', 'Gutkowski', 'NhR~6gV?\&ObK80?{e-', NULL, '2016-09-11 12:49:47.589733', '2016-09-11 12:49:47.589733');
INSERT INTO usuario VALUES (15, 3018718, 'lakin.jana@lueilwitz.com', 'Mafalda', 'Schowalter', '{cD\Drn[R<', NULL, '2016-09-11 12:49:47.602008', '2016-09-11 12:49:47.602008');
INSERT INTO usuario VALUES (16, 19450046, 'nat.daugherty@yahoo.com', 'Cayla', 'Nolan', 'Y9H/^3gkSCee!E?6kd(', NULL, '2016-09-11 12:49:47.610967', '2016-09-11 12:49:47.610967');
INSERT INTO usuario VALUES (17, 3154323, 'blaise74@walter.com', 'Jayden', 'Rodriguez', 'H5^C9dXv''', NULL, '2016-09-11 12:49:47.624242', '2016-09-11 12:49:47.624242');
INSERT INTO usuario VALUES (18, 7104768, 'kshlerin.aglae@hotmail.com', 'Anne', 'Veum', 'Kn0CU/ef.KN', NULL, '2016-09-11 12:49:47.633749', '2016-09-11 12:49:47.633749');
INSERT INTO usuario VALUES (19, 3580092, 'tina12@yahoo.com', 'Stefanie', 'Kuvalis', '>-3GkC8()''*BT', NULL, '2016-09-11 12:49:47.644081', '2016-09-11 12:49:47.644081');
INSERT INTO usuario VALUES (20, 17128413, 'shanel13@yahoo.com', 'Kiera', 'Stokes', '5";^I?UE$xsyP8i^7vmN', NULL, '2016-09-11 12:49:47.655262', '2016-09-11 12:49:47.655262');
INSERT INTO usuario VALUES (21, 12382527, 'okeefe.lura@yahoo.com', 'Ramona', 'Mann', 'V0f]3q3j!!uq"G', NULL, '2016-09-11 12:49:47.666827', '2016-09-11 12:49:47.666827');
INSERT INTO usuario VALUES (22, 11820534, 'willie.parisian@parisian.org', 'Lorenzo', 'Terry', '@'';R.N2-H', NULL, '2016-09-11 12:49:47.679601', '2016-09-11 12:49:47.679601');
INSERT INTO usuario VALUES (23, 1831358, 'celestino88@hotmail.com', 'Garnet', 'Aufderhar', 's(QA1xu]hAo@>', NULL, '2016-09-11 12:49:47.689376', '2016-09-11 12:49:47.689376');
INSERT INTO usuario VALUES (24, 19601141, 'aisha55@adams.com', 'Rebeca', 'Dickens', '8*Nn05W0#g%US', NULL, '2016-09-11 12:49:47.701557', '2016-09-11 12:49:47.701557');
INSERT INTO usuario VALUES (25, 14789466, 'kutch.jackie@gmail.com', 'Reggie', 'Keebler', '%vVpSBzvW{.[h', NULL, '2016-09-11 12:49:47.709008', '2016-09-11 12:49:47.709008');
INSERT INTO usuario VALUES (26, 6707572, 'ottis.mayert@yahoo.com', 'Remington', 'Barton', '{6ykKOgmXsmheM', NULL, '2016-09-11 12:49:47.722995', '2016-09-11 12:49:47.722995');
INSERT INTO usuario VALUES (27, 6197857, 'wintheiser.gerard@macejkovic.com', 'Rupert', 'Littel', '>>z}si1Ya6%`19_lXM_2', NULL, '2016-09-11 12:49:47.736723', '2016-09-11 12:49:47.736723');
INSERT INTO usuario VALUES (28, 6006229, 'bogan.marian@yahoo.com', 'Bud', 'Reichel', 'CY"ON(`-L!ydRbT|!Z>;', NULL, '2016-09-11 12:49:47.744057', '2016-09-11 12:49:47.744057');
INSERT INTO usuario VALUES (29, 6227959, 'rhiannon10@yahoo.com', 'Samir', 'Predovic', '>MGe7?_9rb7N,n-', NULL, '2016-09-11 12:49:47.756155', '2016-09-11 12:49:47.756155');
INSERT INTO usuario VALUES (30, 18008221, 'nikolaus.helene@gmail.com', 'Lea', 'Ritchie', 'nc8+:Qrm5=JR0j$fXw2', NULL, '2016-09-11 12:49:47.766846', '2016-09-11 12:49:47.766846');
INSERT INTO usuario VALUES (31, 7286707, 'boehm.deanna@hotmail.com', 'Laverna', 'Gleichner', '],c}lv0&', NULL, '2016-09-11 12:49:47.777837', '2016-09-11 12:49:47.777837');
INSERT INTO usuario VALUES (32, 14967460, 'hoeger.christelle@larkin.com', 'Felipe', 'Feil', 'ADC{M_;q8)|&qrcs', NULL, '2016-09-11 12:49:47.790506', '2016-09-11 12:49:47.790506');
INSERT INTO usuario VALUES (33, 12274057, 'daniel.kathleen@bartoletti.com', 'Providenci', 'Rath', 'D"%M^U0C@NNf', NULL, '2016-09-11 12:49:47.801327', '2016-09-11 12:49:47.801327');
INSERT INTO usuario VALUES (34, 9998892, 'ellie.kuhic@hotmail.com', 'Aditya', 'Daugherty', '''&_?iB,]Qdd$vJvR', NULL, '2016-09-11 12:49:47.811663', '2016-09-11 12:49:47.811663');
INSERT INTO usuario VALUES (35, 19044050, 'laverne.schuster@gmail.com', 'Shania', 'Rohan', 'F/|Uyou1bPnta%dD', NULL, '2016-09-11 12:49:47.82236', '2016-09-11 12:49:47.82236');
INSERT INTO usuario VALUES (36, 2136619, 'makayla02@hauck.com', 'Ima', 'Monahan', 'WS\&wtOf\4Or~V>', NULL, '2016-09-11 12:49:47.835597', '2016-09-11 12:49:47.835597');
INSERT INTO usuario VALUES (37, 13213466, 'terry.spinka@hotmail.com', 'Sallie', 'Prosacco', ',hSR'':*cLb]$R', NULL, '2016-09-11 12:49:47.84451', '2016-09-11 12:49:47.84451');
INSERT INTO usuario VALUES (39, 6276505, 'doris.reilly@hotmail.com', 'Selina', 'Stanton', 'Z%9{?7dx#I', NULL, '2016-09-11 12:49:47.867295', '2016-09-11 12:49:47.867295');
INSERT INTO usuario VALUES (40, 5908018, 'abshire.megane@yahoo.com', 'Catharine', 'Parisian', 'bR\,Wj', NULL, '2016-09-11 12:49:47.877928', '2016-09-11 12:49:47.877928');
INSERT INTO usuario VALUES (41, 19651927, 'frederique.beer@hotmail.com', 'Adrian', 'Zboncak', '[bCIxJ!BQXW?', NULL, '2016-09-11 12:49:47.888941', '2016-09-11 12:49:47.888941');
INSERT INTO usuario VALUES (42, 5399658, 'gparisian@hotmail.com', 'Neal', 'Ebert', '1+zC`1', NULL, '2016-09-11 12:49:47.900547', '2016-09-11 12:49:47.900547');
INSERT INTO usuario VALUES (43, 17681271, 'arturo.parker@waters.org', 'Mable', 'Jast', '1zZHaOb(', NULL, '2016-09-11 12:49:47.912223', '2016-09-11 12:49:47.912223');
INSERT INTO usuario VALUES (44, 13521718, 'napoleon.wisozk@aufderhar.com', 'Murray', 'Morissette', 'ia6G@Z5|''cRJ', NULL, '2016-09-11 12:49:47.92433', '2016-09-11 12:49:47.92433');
INSERT INTO usuario VALUES (45, 9669394, 'bradford24@zboncak.com', 'Simeon', 'Haley', '0Z#gpVA7O=*W)', NULL, '2016-09-11 12:49:47.935017', '2016-09-11 12:49:47.935017');
INSERT INTO usuario VALUES (46, 15908761, 'bvonrueden@mayert.com', 'Sheila', 'Gusikowski', 'r`.y8YZ=#', NULL, '2016-09-11 12:49:47.945166', '2016-09-11 12:49:47.945166');
INSERT INTO usuario VALUES (47, 18956938, 'frieda.smith@gmail.com', 'Ervin', 'Rice', 'T8''c7L+;W6iC<i>', NULL, '2016-09-11 12:49:47.956006', '2016-09-11 12:49:47.956006');
INSERT INTO usuario VALUES (48, 5657446, 'augustine.hudson@hartmann.com', 'Willis', 'Bayer', '.%sE(-', NULL, '2016-09-11 12:49:47.965623', '2016-09-11 12:49:47.965623');
INSERT INTO usuario VALUES (49, 18269317, 'ray.gorczany@gmail.com', 'Bryon', 'Friesen', '>/YJRy,(nseO9;+-CxC', NULL, '2016-09-11 12:49:47.977427', '2016-09-11 12:49:47.977427');
INSERT INTO usuario VALUES (50, 14762193, 'ratke.erik@bartoletti.com', 'Tito', 'Hoeger', 'd4Ay_k7H>\stcElqTL7', NULL, '2016-09-11 12:49:47.989678', '2016-09-11 12:49:47.989678');
INSERT INTO usuario VALUES (51, 2335121, 'aisha71@jaskolski.com', 'Dorris', 'Bogisich', 'aSZy"RR<*7WTXUfp8:''', NULL, '2016-09-11 12:49:48.000699', '2016-09-11 12:49:48.000699');
INSERT INTO usuario VALUES (52, 7064513, 'fstanton@grady.com', 'Kari', 'Shields', '=V1y*pD!S]5', NULL, '2016-09-11 12:49:48.011536', '2016-09-11 12:49:48.011536');
INSERT INTO usuario VALUES (53, 2501718, 'oritchie@hahn.net', 'Desmond', 'Lockman', 'H`Y$=G/j)', NULL, '2016-09-11 12:49:48.02357', '2016-09-11 12:49:48.02357');
INSERT INTO usuario VALUES (54, 14014846, 'beatty.kavon@gmail.com', 'Luella', 'Cremin', '7qd*!Ri]ohk''k1W0WRzA', NULL, '2016-09-11 12:49:48.033625', '2016-09-11 12:49:48.033625');
INSERT INTO usuario VALUES (55, 15710471, 'edison.stracke@gmail.com', 'Candice', 'Hudson', 'KgFV8(iYdqD', NULL, '2016-09-11 12:49:48.043908', '2016-09-11 12:49:48.043908');
INSERT INTO usuario VALUES (56, 10539942, 'jewel.wilderman@armstrong.org', 'Brandon', 'Kris', 'u8WK|R_&4SG', NULL, '2016-09-11 12:49:48.056786', '2016-09-11 12:49:48.056786');
INSERT INTO usuario VALUES (57, 10951783, 'pierre80@yahoo.com', 'Oren', 'Sauer', 'Zbuw3R0$_5qY', NULL, '2016-09-11 12:49:48.066084', '2016-09-11 12:49:48.066084');
INSERT INTO usuario VALUES (58, 17765556, 'weissnat.mia@mitchell.info', 'Ben', 'Dach', 'r0Gbg@q6s7J8V5T=', NULL, '2016-09-11 12:49:48.079518', '2016-09-11 12:49:48.079518');
INSERT INTO usuario VALUES (59, 2790434, 'deja.rau@gmail.com', 'Dave', 'Hessel', 'R9U{<!', NULL, '2016-09-11 12:49:48.089114', '2016-09-11 12:49:48.089114');
INSERT INTO usuario VALUES (60, 10790616, 'ellen.dooley@hotmail.com', 'Kaleb', 'Rath', '.T;|[FF"<,:k\H{o&<', NULL, '2016-09-11 12:49:48.09974', '2016-09-11 12:49:48.09974');
INSERT INTO usuario VALUES (61, 1550310, 'mayert.katlyn@mills.biz', 'Gene', 'O''Connell', 'P}}B39W2L./', NULL, '2016-09-11 12:49:48.111809', '2016-09-11 12:49:48.111809');
INSERT INTO usuario VALUES (62, 9644732, 'fnikolaus@hotmail.com', 'Keshaun', 'Orn', '3[j}gYk}UJ6?:D-!5', NULL, '2016-09-11 12:49:48.122204', '2016-09-11 12:49:48.122204');
INSERT INTO usuario VALUES (63, 10643542, 'fritsch.reymundo@gmail.com', 'Clair', 'Armstrong', 'ffE;@"|.|V2NOt', NULL, '2016-09-11 12:49:48.132686', '2016-09-11 12:49:48.132686');
INSERT INTO usuario VALUES (64, 8184812, 'katharina.krajcik@emmerich.com', 'Queen', 'Hartmann', ']kUJ:_|ZSm]JNE', NULL, '2016-09-11 12:49:48.14603', '2016-09-11 12:49:48.14603');
INSERT INTO usuario VALUES (65, 3730783, 'carolanne25@nitzsche.com', 'Cordie', 'Feil', 'jjx>Mr/1r/$Z=k6X@', NULL, '2016-09-11 12:49:48.156981', '2016-09-11 12:49:48.156981');
INSERT INTO usuario VALUES (66, 8704910, 'bauch.arno@lowe.com', 'Cale', 'Padberg', 'N<(zMp', NULL, '2016-09-11 12:49:48.167324', '2016-09-11 12:49:48.167324');
INSERT INTO usuario VALUES (67, 12394818, 'hgreenfelder@yahoo.com', 'Myrtice', 'Raynor', 'B?GMyp|3', NULL, '2016-09-11 12:49:48.176692', '2016-09-11 12:49:48.176692');
INSERT INTO usuario VALUES (68, 15756630, 'oparker@armstrong.org', 'Orpha', 'VonRueden', 'j<RulL_0X*szJ]O', NULL, '2016-09-11 12:49:48.188941', '2016-09-11 12:49:48.188941');
INSERT INTO usuario VALUES (69, 5885453, 'douglas.cheyenne@yahoo.com', 'Rita', 'Roberts', '~Pb]7m', NULL, '2016-09-11 12:49:48.200024', '2016-09-11 12:49:48.200024');
INSERT INTO usuario VALUES (70, 13951453, 'akunde@hotmail.com', 'Kariane', 'Hackett', 'fQ88xi', NULL, '2016-09-11 12:49:48.210145', '2016-09-11 12:49:48.210145');
INSERT INTO usuario VALUES (71, 16199513, 'mclaughlin.percy@abbott.com', 'Lindsay', 'Satterfield', 'jdpU)![v?`', NULL, '2016-09-11 12:49:48.221497', '2016-09-11 12:49:48.221497');
INSERT INTO usuario VALUES (72, 2413518, 'lgreenholt@gmail.com', 'Keyon', 'Gusikowski', '6|bv.XAl((G=''/7', NULL, '2016-09-11 12:49:48.232374', '2016-09-11 12:49:48.232374');
INSERT INTO usuario VALUES (73, 8019339, 'eula.johnston@yahoo.com', 'Heidi', 'Lang', 'Ogt3IGriom$2fMmR', NULL, '2016-09-11 12:49:48.243653', '2016-09-11 12:49:48.243653');
INSERT INTO usuario VALUES (74, 16648179, 'hkuhn@steuber.info', 'Esta', 'Hilpert', ',vu[v3znP=JAX^2>5k]', NULL, '2016-09-11 12:49:48.256928', '2016-09-11 12:49:48.256928');
INSERT INTO usuario VALUES (75, 7239883, 'rogahn.myrtis@oconner.com', 'Kiley', 'Lindgren', 'ea{Tyw', NULL, '2016-09-11 12:49:48.267595', '2016-09-11 12:49:48.267595');
INSERT INTO usuario VALUES (76, 11498776, 'twintheiser@schuster.biz', 'Genevieve', 'Orn', 'cGdIDv~F<(CxCHez`|:m', NULL, '2016-09-11 12:49:48.278249', '2016-09-11 12:49:48.278249');
INSERT INTO usuario VALUES (77, 18716213, 'hkulas@armstrong.com', 'Houston', 'Quitzon', '=AotY"(Ezs{5\Ag', NULL, '2016-09-11 12:49:48.289352', '2016-09-11 12:49:48.289352');
INSERT INTO usuario VALUES (78, 5628930, 'pacocha.gonzalo@gmail.com', 'Omari', 'Ernser', 'W}T}5TdB0', NULL, '2016-09-11 12:49:48.299458', '2016-09-11 12:49:48.299458');
INSERT INTO usuario VALUES (79, 14220620, 'arnaldo74@hotmail.com', 'Ethel', 'Dickinson', 'K(X8):=2', NULL, '2016-09-11 12:49:48.310435', '2016-09-11 12:49:48.310435');
INSERT INTO usuario VALUES (80, 15878383, 'qupton@bruen.com', 'Katrina', 'Paucek', 'w/VC,8zA\''Z_', NULL, '2016-09-11 12:49:48.323527', '2016-09-11 12:49:48.323527');
INSERT INTO usuario VALUES (81, 16326645, 'vrice@gmail.com', 'Elliott', 'Jakubowski', 'W%9)[5sc[', NULL, '2016-09-11 12:49:48.332443', '2016-09-11 12:49:48.332443');
INSERT INTO usuario VALUES (82, 14084096, 'qschneider@gibson.info', 'Jaeden', 'Gerhold', ')yxRdK:Kc9IQuX', NULL, '2016-09-11 12:49:48.34459', '2016-09-11 12:49:48.34459');
INSERT INTO usuario VALUES (83, 15627446, 'iflatley@cummings.com', 'Holly', 'Collins', 'B/6l:*M7p]g''rnC6fX7M', NULL, '2016-09-11 12:49:48.355903', '2016-09-11 12:49:48.355903');
INSERT INTO usuario VALUES (84, 4134725, 'chelsea22@wiza.net', 'Fermin', 'Gislason', '%<Bxd_92Ke{GmW', NULL, '2016-09-11 12:49:48.367283', '2016-09-11 12:49:48.367283');
INSERT INTO usuario VALUES (85, 10914537, 'kian.ward@gmail.com', 'Liana', 'Bartell', 'lb]3")j.[r>qQmcHn', NULL, '2016-09-11 12:49:48.377166', '2016-09-11 12:49:48.377166');
INSERT INTO usuario VALUES (86, 6459941, 'tnienow@yahoo.com', 'Muriel', 'Homenick', '5vtp&*lA/>qA', NULL, '2016-09-11 12:49:48.388886', '2016-09-11 12:49:48.388886');
INSERT INTO usuario VALUES (87, 12784806, 'koch.crawford@adams.com', 'Brenden', 'Turner', '?f4R$wDCQ;KPW:miM', NULL, '2016-09-11 12:49:48.400436', '2016-09-11 12:49:48.400436');
INSERT INTO usuario VALUES (88, 14056929, 'zosinski@yahoo.com', 'Oral', 'Schulist', 'oR&]>M.U&K/".&-/C+', NULL, '2016-09-11 12:49:48.410697', '2016-09-11 12:49:48.410697');
INSERT INTO usuario VALUES (89, 17121980, 'emmerich.lillie@cole.net', 'Lawson', 'Green', '`4i.`uW+9/.x(wr:T', NULL, '2016-09-11 12:49:48.422465', '2016-09-11 12:49:48.422465');
INSERT INTO usuario VALUES (90, 3940785, 'schaden.shaun@roob.com', 'Cordia', 'Bahringer', 'Xhxg1cDe<', NULL, '2016-09-11 12:49:48.433532', '2016-09-11 12:49:48.433532');
INSERT INTO usuario VALUES (91, 5636687, 'leatha04@hotmail.com', 'Lue', 'Reichert', '.#),Sp;<', NULL, '2016-09-11 12:49:48.443344', '2016-09-11 12:49:48.443344');
INSERT INTO usuario VALUES (92, 12582255, 'bobbie.pollich@hotmail.com', 'Vince', 'Torp', '`Q@J>7qO9', NULL, '2016-09-11 12:49:48.455418', '2016-09-11 12:49:48.455418');
INSERT INTO usuario VALUES (93, 12028193, 'rhoda64@yundt.com', 'Marisa', 'Breitenberg', '7soSV{n', NULL, '2016-09-11 12:49:48.467423', '2016-09-11 12:49:48.467423');
INSERT INTO usuario VALUES (94, 11171828, 'bfarrell@witting.com', 'Nico', 'Hyatt', '`f0x1X', NULL, '2016-09-11 12:49:48.477725', '2016-09-11 12:49:48.477725');
INSERT INTO usuario VALUES (95, 12984151, 'kyundt@weber.info', 'Freeman', 'Goyette', 'J:Z%J+gk[JMS', NULL, '2016-09-11 12:49:48.487536', '2016-09-11 12:49:48.487536');
INSERT INTO usuario VALUES (96, 15056594, 'qschoen@yahoo.com', 'Jennifer', 'O''Reilly', '&5U/4wZ~Fz', NULL, '2016-09-11 12:49:48.49947', '2016-09-11 12:49:48.49947');
INSERT INTO usuario VALUES (97, 9000904, 'oswaldo91@leannon.org', 'Viviane', 'Trantow', ',i\x=ca]:AnTLM;$.k`', NULL, '2016-09-11 12:49:48.511349', '2016-09-11 12:49:48.511349');
INSERT INTO usuario VALUES (98, 9572890, 'alyce61@murphy.org', 'Domenico', 'McLaughlin', 'q@Tmm\NvN->', NULL, '2016-09-11 12:49:48.523277', '2016-09-11 12:49:48.523277');
INSERT INTO usuario VALUES (99, 3725469, 'mckenzie.raphaelle@hotmail.com', 'Newton', 'Schoen', 'Rv_nNWBXRDbh>_', NULL, '2016-09-11 12:49:48.533079', '2016-09-11 12:49:48.533079');
INSERT INTO usuario VALUES (100, 3046754, 'aorn@gmail.com', 'Pat', 'Auer', 'ZakLfz4e{qoC', NULL, '2016-09-11 12:49:48.54331', '2016-09-11 12:49:48.54331');
INSERT INTO usuario VALUES (101, 11171282, 'bswift@gmail.com', 'Krystina', 'Armstrong', 'U<Y~qp_,(#;iz^q', NULL, '2016-09-11 12:49:48.554959', '2016-09-11 12:49:48.554959');
INSERT INTO usuario VALUES (103, 987654321, 'msn2@msn.com', 'nombre2', 'apellido32', '$2y$10$PlPPn65qQi8HcprDmS.Rm.2NEV3qPurFAPxnNLrbLqoL9lt2.xP.a', NULL, '2016-09-11 16:44:09', '2016-09-11 16:44:09');
INSERT INTO usuario VALUES (1, 18454895, 'brojasflores@hotmail.com', 'Bárbara Belén', 'Rojas Flores', 'barbara123', 'barbara123', '2016-09-11 12:37:20.677255', '2016-09-11 16:55:33');
INSERT INTO usuario VALUES (104, 928389872, 'jdjfh@jshd.cl', 'sljkdkj', 'skjdlfd', '$2y$10$FnZRUk9nHQTIZtgF0CWzPemlPQt4pl8PEZ05JnVb/mRnLkw1bxEw2', NULL, '2016-09-11 19:06:58', '2016-09-11 19:06:58');


--
-- Name: usuario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: barbarita
--

SELECT pg_catalog.setval('usuario_id_seq', 104, true);


--
-- Name: asignatura_codigo_key; Type: CONSTRAINT; Schema: public; Owner: barbarita; Tablespace: 
--

ALTER TABLE ONLY asignatura
    ADD CONSTRAINT asignatura_codigo_key UNIQUE (codigo);


--
-- Name: asignatura_pkey; Type: CONSTRAINT; Schema: public; Owner: barbarita; Tablespace: 
--

ALTER TABLE ONLY asignatura
    ADD CONSTRAINT asignatura_pkey PRIMARY KEY (id);


--
-- Name: curso_asignatura_id_semestre_anio_seccion_key; Type: CONSTRAINT; Schema: public; Owner: barbarita; Tablespace: 
--

ALTER TABLE ONLY curso
    ADD CONSTRAINT curso_asignatura_id_semestre_anio_seccion_key UNIQUE (asignatura_id, semestre, anio, seccion);


--
-- Name: curso_pkey; Type: CONSTRAINT; Schema: public; Owner: barbarita; Tablespace: 
--

ALTER TABLE ONLY curso
    ADD CONSTRAINT curso_pkey PRIMARY KEY (id);


--
-- Name: horario_fecha_sala_id_periodo_id_key; Type: CONSTRAINT; Schema: public; Owner: barbarita; Tablespace: 
--

ALTER TABLE ONLY horario
    ADD CONSTRAINT horario_fecha_sala_id_periodo_id_key UNIQUE (fecha, sala_id, periodo_id);


--
-- Name: horario_pkey; Type: CONSTRAINT; Schema: public; Owner: barbarita; Tablespace: 
--

ALTER TABLE ONLY horario
    ADD CONSTRAINT horario_pkey PRIMARY KEY (id);


--
-- Name: periodo_bloque_key; Type: CONSTRAINT; Schema: public; Owner: barbarita; Tablespace: 
--

ALTER TABLE ONLY periodo
    ADD CONSTRAINT periodo_bloque_key UNIQUE (bloque);


--
-- Name: periodo_inicio_fin_key; Type: CONSTRAINT; Schema: public; Owner: barbarita; Tablespace: 
--

ALTER TABLE ONLY periodo
    ADD CONSTRAINT periodo_inicio_fin_key UNIQUE (inicio, fin);


--
-- Name: periodo_pkey; Type: CONSTRAINT; Schema: public; Owner: barbarita; Tablespace: 
--

ALTER TABLE ONLY periodo
    ADD CONSTRAINT periodo_pkey PRIMARY KEY (id);


--
-- Name: rol_nombre_key; Type: CONSTRAINT; Schema: public; Owner: barbarita; Tablespace: 
--

ALTER TABLE ONLY rol
    ADD CONSTRAINT rol_nombre_key UNIQUE (nombre);


--
-- Name: rol_pkey; Type: CONSTRAINT; Schema: public; Owner: barbarita; Tablespace: 
--

ALTER TABLE ONLY rol
    ADD CONSTRAINT rol_pkey PRIMARY KEY (id);


--
-- Name: rol_usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: barbarita; Tablespace: 
--

ALTER TABLE ONLY rol_usuario
    ADD CONSTRAINT rol_usuario_pkey PRIMARY KEY (id);


--
-- Name: rol_usuario_rut_rol_id_key; Type: CONSTRAINT; Schema: public; Owner: barbarita; Tablespace: 
--

ALTER TABLE ONLY rol_usuario
    ADD CONSTRAINT rol_usuario_rut_rol_id_key UNIQUE (rut, rol_id);


--
-- Name: sala_pkey; Type: CONSTRAINT; Schema: public; Owner: barbarita; Tablespace: 
--

ALTER TABLE ONLY sala
    ADD CONSTRAINT sala_pkey PRIMARY KEY (id);


--
-- Name: usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: barbarita; Tablespace: 
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (id);


--
-- Name: usuario_rut_key; Type: CONSTRAINT; Schema: public; Owner: barbarita; Tablespace: 
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_rut_key UNIQUE (rut);


--
-- Name: curso_asignatura_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: barbarita
--

ALTER TABLE ONLY curso
    ADD CONSTRAINT curso_asignatura_id_fkey FOREIGN KEY (asignatura_id) REFERENCES asignatura(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: horario_curso_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: barbarita
--

ALTER TABLE ONLY horario
    ADD CONSTRAINT horario_curso_id_fkey FOREIGN KEY (curso_id) REFERENCES curso(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: horario_periodo_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: barbarita
--

ALTER TABLE ONLY horario
    ADD CONSTRAINT horario_periodo_id_fkey FOREIGN KEY (periodo_id) REFERENCES periodo(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: horario_sala_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: barbarita
--

ALTER TABLE ONLY horario
    ADD CONSTRAINT horario_sala_id_fkey FOREIGN KEY (sala_id) REFERENCES sala(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: rol_usuario_rol_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: barbarita
--

ALTER TABLE ONLY rol_usuario
    ADD CONSTRAINT rol_usuario_rol_id_fkey FOREIGN KEY (rol_id) REFERENCES rol(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: rol_usuario_rut_fkey; Type: FK CONSTRAINT; Schema: public; Owner: barbarita
--

ALTER TABLE ONLY rol_usuario
    ADD CONSTRAINT rol_usuario_rut_fkey FOREIGN KEY (rut) REFERENCES usuario(rut) ON UPDATE CASCADE ON DELETE CASCADE;


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

