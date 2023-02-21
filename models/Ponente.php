<?php

namespace models;

use Lib\BaseDatos;
use PDOException;

class Ponente
{
    private $id;
    private $nombre;
    private $apellidos;
    private $email;

    private BaseDatos $bd;
    public function __construct()
    {
        $this->bd = new BaseDatos();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'email' => $this->email
        ];
    }

    public function getAll(): array {
        $sql = "SELECT * FROM hosteleria.ponentes";
        $this->bd->consulta($sql);
        return $this->bd->extraer_todos();
    }

    public function getOne($email): array {

        $sql = "SELECT * FROM hosteleria.ponentes WHERE email = '$email'";
        $this->bd->consulta($sql);
        return $this->bd->extraer_todos();
    }

    public function getOneById($id): array {

        $sql = "SELECT * FROM hosteleria.ponentes WHERE id = '$id'";
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
    }



}