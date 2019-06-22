DROP DATABASE tickets;

CREATE DATABASE tickets;

DROP TABLE tickets.usuarios;

CREATE TABLE tickets.usuarios (
    user_id INT NOT NULL AUTO_INCREMENT,
    user_nombre VARCHAR(50),
    user_correo VARCHAR(255),
    user_password VARCHAR(255),
    user_empresa VARCHAR(50),
    user_direccion VARCHAR(50),
    user_telefono VARCHAR(15),
    user_web_empresa VARCHAR(50),
    user_cargo VARCHAR(50),
    priv_id INT,
    PRIMARY KEY (user_id)
);

DROP TABLE tickets.privilegios;

CREATE TABLE tickets.privilegios (
priv_id INT,
priv_titulo VARCHAR(50),
priv_descripcion VARCHAR(50),
PRIMARY KEY (priv_id)
);

INSERT INTO tickets.usuarios (user_id,user_nombre,user_correo,user_password,user_empresa,user_direccion,user_telefono,user_web_empresa,user_cargo,priv_id) 
value (null,"Eduardo Lynch Araya","eduardolynch94@gmail.com","123456","Eware Consulting","Amunategui 20, Santiago","+56996630457","www.eware.com","Consultor Informático",1);
COMMIT;

INSERT INTO tickets.usuarios (user_id,user_nombre,user_correo,user_password,user_empresa,user_direccion,user_telefono,user_web_empresa,user_cargo,priv_id) 
value (null,"Alvaro Cardoza","acardoza@carcom.com","123456","Carcom","Quilicura 1234, Santiago","+56912345678","www.carcom.com","Soporte Informático",2);

INSERT INTO tickets.usuarios (user_id,user_nombre,user_correo,user_password,user_empresa,user_direccion,user_telefono,user_web_empresa,user_cargo,priv_id) 
value (null,"Jaime Larrondo","jlarrondo@gmail.com","123456","Junaeb Consulting","Bandera 2331, Santiago","+56996612547","www.junaeb.com","Administrador DBA",3);

SELECT * FROM tickets.usuarios;

INSERT INTO tickets.privilegios (priv_id,priv_titulo,priv_descripcion)
value (1,"Administrador","Dios de la web"); 

INSERT INTO tickets.privilegios (priv_id,priv_titulo,priv_descripcion)
value (2,"Tecnico","Soporte TI");

INSERT INTO tickets.privilegios (priv_id,priv_titulo,priv_descripcion)
value (3,"Usuario","Usuario");

SELECT * FROM tickets.privilegios;

SELECT 
    user_id,
    user_nombre,
    user_correo,
    user_password,
    user_empresa,
    user_direccion,
    user_telefono,
    user_web_empresa,
    user_cargo,
    p.priv_id,
    priv_titulo,
    priv_descripcion
FROM
    tickets.usuarios u
        INNER JOIN
    tickets.privilegios p ON u.priv_id = p.priv_id;

CREATE TABLE tickets.gruposoporte (
gsoporte_id INT NOT NULL AUTO_INCREMENT,
gsoporte_titulo VARCHAR(50),
gsoporte_descripcion VARCHAR(50),
user_id INT,
PRIMARY KEY (gsoporte_id)
);

DROP TABLE tickets.ticket;

CREATE TABLE tickets.ticket (
  ticket_id INT NOT NULL AUTO_INCREMENT,
  ticket_titulo VARCHAR(100),
  user_id INT,
  gsoporte_id INT,
  ticket_descripcion VARCHAR(255),
  ticket_estado_id INT(1) NOT NULL DEFAULT '1',
  ticket_fecha_creacion datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  ticket_fecha_actualizado datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (ticket_id)
);

DROP TABLE tickets.ticket_estado;

CREATE TABLE tickets.ticket_estado (
ticket_estado_id INT NOT NULL AUTO_INCREMENT,
ticket_estado_titulo VARCHAR(10),
PRIMARY KEY (ticket_estado_id)
);

INSERT INTO tickets.ticket_estado (ticket_estado_id,ticket_estado_titulo)
value (1,"Abierto");
INSERT INTO tickets.ticket_estado (ticket_estado_id,ticket_estado_titulo)
value (2,"Cerrado");

SELECT 
    ticket_titulo,
    ticket_descripcion,
    gsoporte_titulo,
    te.ticket_estado_titulo,
    t.ticket_fecha_creacion,
    t.ticket_fecha_actualizado
FROM
    tickets.ticket t
        INNER JOIN
    tickets.ticket_estado te ON t.ticket_estado_id = te.ticket_estado_id
        INNER JOIN
    tickets.gruposoporte g ON g.gsoporte_id = t.gsoporte_id
WHERE
    ticket_titulo IS NOT NULL;

SELECT * FROM tickets.ticket_estado;