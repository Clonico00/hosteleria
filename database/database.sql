CREATE DATABASE IF NOT EXISTS hosteleria;

USE hosteleria;

CREATE TABLE IF NOT EXISTS usuarios (
                                        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                        nombre VARCHAR(50) NOT NULL,
                                        apellidos VARCHAR(100) NOT NULL,
                                        email VARCHAR(100) NOT NULL UNIQUE,
                                        password VARCHAR(255) NOT NULL,
                                        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS ponentes (
                                        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                        nombre VARCHAR(50) NOT NULL,
                                        apellidos VARCHAR(100) NOT NULL,
                                        email VARCHAR(100) NOT NULL UNIQUE,
                                        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS cursos (
                                      id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      nombre VARCHAR(100) NOT NULL,
                                      descripcion TEXT NOT NULL,
                                      fecha_inicio DATE NOT NULL,
                                      fecha_fin DATE NOT NULL,
                                      ponente_id INT(11) UNSIGNED NOT NULL,
                                      created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                      CONSTRAINT FK_cursos_ponentes FOREIGN KEY (ponente_id) REFERENCES ponentes(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE cursos ADD CONSTRAINT UQ_cursos_nombre_ponente_id UNIQUE KEY (nombre, ponente_id);


