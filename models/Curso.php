<?php

namespace models;

use Lib\BaseDatos;
use PDOException;

class Curso
{

    private $id;
    private $nombre;
    private $descripcion;

    private $ponente_id;

    private $fecha_inicio;
    private $fecha_fin;


    private BaseDatos $bd;
    public function __construct()
    {
        $this->bd = new BaseDatos();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getPonenteId()
    {
        return $this->ponente_id;
    }

    /**
     * @param mixed $ponente_id
     */
    public function setPonenteId($ponente_id): void
    {
        $this->ponente_id = $ponente_id;
    }

    /**
     * @return mixed
     */
    public function getFechaInicio()
    {
        return $this->fecha_inicio;
    }

    /**
     * @param mixed $fecha_inicio
     */
    public function setFechaInicio($fecha_inicio): void
    {
        $this->fecha_inicio = $fecha_inicio;
    }

    /**
     * @return mixed
     */
    public function getFechaFin()
    {
        return $this->fecha_fin;
    }

    /**
     * @param mixed $fecha_fin
     */
    public function setFechaFin($fecha_fin): void
    {
        $this->fecha_fin = $fecha_fin;
    }

    /*hacemos estos metodos pero con los atributos de Curso: public function getAll(): array {
        $sql = "SELECT * FROM hosteleria.ponentes";
        $this->bd->consulta($sql);
        return $this->bd->extraer_todos();
    }

    public function getOne($email): array {

        $sql = "SELECT * FROM hosteleria.ponentes WHERE email = '$email'";
        $this->bd->consulta($sql);
        return $this->bd->extraer_todos();
    }

    public function insert(): bool {
        try {
            $sql = "INSERT INTO hosteleria.ponentes (nombre, apellidos, email) VALUES ('$this->nombre', '$this->apellidos', '$this->email')";
            $this->bd->consulta($sql);
            return $this->bd->filasAfectadas() > 0;

        } catch (PDOException $e) {
            return false;
        }
    }

    public function update(): bool {
        try {
            $sql = "UPDATE hosteleria.ponentes SET nombre = '$this->nombre', apellidos = '$this->apellidos', email = '$this->email' WHERE id = $this->id";
            $this->bd->consulta($sql);
            return $this->bd->filasAfectadas() > 0;

        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete(): bool {
        try {
            $sql = "DELETE FROM hosteleria.ponentes WHERE id = $this->id";
            $this->bd->consulta($sql);
            return $this->bd->filasAfectadas() > 0;

        } catch (PDOException $e) {
            return false;
        }
    }*/

    public function getAll(): array {
        $sql = "SELECT * FROM hosteleria.cursos";
        $this->bd->consulta($sql);
        return $this->bd->extraer_todos();
    }

    public function getOne($id): array {
        $sql = "SELECT * FROM hosteleria.cursos WHERE id = '$id'";
        $this->bd->consulta($sql);
        return $this->bd->extraer_todos();
    }

    public function insert(): bool {
        try {
            $sql = "INSERT INTO hosteleria.cursos (nombre, descripcion, ponente_id, fecha_inicio, fecha_fin) VALUES ('$this->nombre', '$this->descripcion', '$this->ponente_id', '$this->fecha_inicio', '$this->fecha_fin')";
            $this->bd->consulta($sql);
            return $this->bd->filasAfectadas() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update(): bool {
        try {
            $sql = "UPDATE hosteleria.cursos SET nombre = '$this->nombre', descripcion = '$this->descripcion', ponente_id = '$this->ponente_id', fecha_inicio = '$this->fecha_inicio', fecha_fin = '$this->fecha_fin' WHERE id = $this->id";
            $this->bd->consulta($sql);
            return $this->bd->filasAfectadas() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete(): bool {
        try {
            $sql = "DELETE FROM hosteleria.cursos WHERE id = $this->id";
            $this->bd->consulta($sql);
            return $this->bd->filasAfectadas() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }


}