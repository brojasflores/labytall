BEGIN TRANSACTION;

DROP TABLE IF EXISTS users CASCADE;
CREATE TABLE users (
    id bigserial NOT NULL,
    rut varchar(255),
    email varchar(255),
    nombres varchar(255),
    apellidos varchar(255),
    password varchar(255),
    perfiles varchar(255),
	remember_token character varying(100),
	created_at timestamp NOT NULL DEFAULT NOW(),
	updated_at timestamp NOT NULL DEFAULT NOW(),
	UNIQUE (email),
    PRIMARY KEY (rut)
);



DROP TABLE IF EXISTS periodo CASCADE;
CREATE TABLE periodo (
	id bigserial NOT NULL,
	bloque varchar(255) NOT NULL,
	inicio time NOT NULL,
    fin time NOT NULL,
	created_at timestamp NOT NULL DEFAULT NOW(),
	updated_at timestamp NOT NULL DEFAULT NOW(),
	UNIQUE (bloque),
    UNIQUE (inicio, fin),
	PRIMARY KEY (id)
);


DROP TABLE IF EXISTS rol CASCADE;
CREATE TABLE rol (
	id serial NOT NULL,
	nombre varchar(255) NOT NULL,
	descripcion text,
	created_at timestamp NOT NULL DEFAULT NOW(),
	updated_at timestamp NOT NULL DEFAULT NOW(),
	UNIQUE (nombre),
	PRIMARY KEY (id)
);


DROP TABLE IF EXISTS rol_users CASCADE;
CREATE TABLE rol_users (
	id serial NOT NULL,
	rut varchar(255) NOT NULL REFERENCES users(rut) ON UPDATE CASCADE ON DELETE CASCADE,
	rol_id int NOT NULL REFERENCES rol(id) ON UPDATE CASCADE ON DELETE CASCADE,
	created_at timestamp NOT NULL DEFAULT NOW(),
	updated_at timestamp NOT NULL DEFAULT NOW(),
	PRIMARY KEY (id)
);


DROP TABLE IF EXISTS sala CASCADE;
CREATE TABLE sala (
	id bigserial NOT NULL,
	nombre varchar(255) NOT NULL,
	capacidad int NOT NULL,
	created_at timestamp NOT NULL DEFAULT NOW(),
	updated_at timestamp NOT NULL DEFAULT NOW(),
	UNIQUE (nombre),
	PRIMARY KEY (id)
);


DROP TABLE IF EXISTS asignatura CASCADE;
CREATE TABLE asignatura (
	id bigserial NOT NULL,
	codigo varchar(255) NOT NULL,
	nombre varchar(255) NOT NULL,
	descripcion text,
	created_at timestamp NOT NULL DEFAULT NOW(),
	updated_at timestamp NOT NULL DEFAULT NOW(),
	UNIQUE (codigo),
	PRIMARY KEY (id)
);

DROP TABLE IF EXISTS curso CASCADE;
CREATE TABLE curso (
	id bigserial NOT NULL,
	asignatura_id bigint NOT NULL REFERENCES asignatura(id) ON UPDATE CASCADE ON DELETE CASCADE,
    semestre int NOT NULL,
    anio int NOT NULL,
	seccion int NOT NULL,
	created_at timestamp NOT NULL DEFAULT NOW(),
	updated_at timestamp NOT NULL DEFAULT NOW(),
	UNIQUE (asignatura_id, semestre, anio, seccion),
	PRIMARY KEY (id)
);



DROP TABLE IF EXISTS horario CASCADE;
CREATE TABLE horario (
    id bigserial NOT NULL,
    fecha date NOT NULL DEFAULT NOW(),
    sala_id bigint NOT NULL REFERENCES sala(id) ON UPDATE CASCADE ON DELETE CASCADE,
    periodo_id int NOT NULL REFERENCES periodo(id) ON UPDATE CASCADE ON DELETE CASCADE,
	curso_id bigint NOT NULL REFERENCES curso(id) ON UPDATE CASCADE ON DELETE CASCADE,
	rut varchar(255),
	permanencia varchar(255),
	created_at timestamp NOT NULL DEFAULT NOW(),
	updated_at timestamp NOT NULL DEFAULT NOW(),
    UNIQUE (fecha, sala_id, periodo_id, curso_id),
    PRIMARY KEY (id)
);

DROP TABLE IF EXISTS estacion_trabajo CASCADE;
CREATE TABLE estacion_trabajo (
    id bigserial NOT NULL,
    nombre varchar(255),
    disponibilidad varchar(255),
    sala_id bigint NOT NULL REFERENCES sala(id) ON UPDATE CASCADE ON DELETE CASCADE,
	created_at timestamp NOT NULL DEFAULT NOW(),
	updated_at timestamp NOT NULL DEFAULT NOW(),
    PRIMARY KEY (id)
);

DROP TABLE IF EXISTS horario_alum CASCADE;
CREATE TABLE horario_alum (
    id bigserial NOT NULL,
    fecha date NOT NULL DEFAULT NOW(),
    rut varchar(255),
    periodo_id int NOT NULL REFERENCES periodo(id) ON UPDATE CASCADE ON DELETE CASCADE,
    sala_id bigint NOT NULL REFERENCES sala(id) ON UPDATE CASCADE ON DELETE CASCADE,
	estacion_trabajo_id bigint NOT NULL REFERENCES estacion_trabajo(id) ON UPDATE CASCADE ON DELETE CASCADE,
	permanencia varchar(255),
	created_at timestamp NOT NULL DEFAULT NOW(),
	updated_at timestamp NOT NULL DEFAULT NOW(),
    UNIQUE (fecha, sala_id, periodo_id, estacion_trabajo_id),
    PRIMARY KEY (id)
);


COMMIT;