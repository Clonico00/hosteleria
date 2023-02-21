<?php

namespace models;

use Lib\BaseDatos;
use PDOException;

class User
{
    private int $id;
    private string $nombre;
    private string $apellidos;
    private string $email;
    private string $password;
    private string $rol;
    private string $confirmado;
    private BaseDatos $bd;
    public function __construct()
    {
        $this->bd = new BaseDatos();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    /**
     * @param string $apellidos
     */
    public function setApellidos(string $apellidos): void
    {
        $this->apellidos = $apellidos;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getRol(): string
    {
        return $this->rol;
    }

    /**
     * @param string $rol
     */
    public function setRol(string $rol): void
    {
        $this->rol = $rol;
    }

    /**
     * @return string
     */
    public function getConfirmado(): string
    {
        return $this->confirmado;
    }

    /**
     * @param string $confirmado
     */
    public function setConfirmado(string $confirmado): void
    {
        $this->confirmado = $confirmado;
    }

    public function getAll(): array {
        $sql = "SELECT * FROM hosteleria.usuarios";
        $this->bd->consulta($sql);
        return $this->bd->extraer_todos();
    }

    public function getOne(int $id): array {
        $sql = "SELECT * FROM hosteleria.usuarios WHERE id = :id";
        $this->bd->consulta($sql, [":id" => $id]);
        return $this->bd->extraer_registro();
    }

    public function getUserByEmail($email): array|false {
        $sql = "SELECT * FROM hosteleria.usuarios WHERE email = '$email'";
        $this->bd->consulta($sql);
        return $this->bd->extraer_registro();
    }

    public function insert(): bool {
        try {
            $sql = "INSERT INTO hosteleria.usuarios (nombre, apellidos, email, password, rol, confirmado) VALUES ('$this->nombre', '$this->apellidos', '$this->email', '$this->password', '$this->rol', '$this->confirmado')";
            $this->bd->consulta($sql);
            return $this->bd->filasAfectadas() > 0;

        } catch (PDOException $e) {
            return false;
        }
    }

    public function update(): bool {
        try {
            $sql = "UPDATE hosteleria.usuarios SET nombre = '$this->nombre', apellidos = '$this->apellidos', email = '$this->email', password = '$this->password', rol = '$this->rol', confirmado = '$this->confirmado' WHERE id = $this->id";
            $this->bd->consulta($sql);
            return $this->bd->filasAfectadas() > 0;

        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete(): bool {
        try {
            $sql = "DELETE FROM hosteleria.usuarios WHERE id = $this->id";
            $this->bd->consulta($sql);
            return $this->bd->filasAfectadas() > 0;

        } catch (PDOException $e) {
            return false;
        }
    }

    public function login($email): bool|array {
        $sql = "SELECT * FROM hosteleria.usuarios WHERE email = '$email'";
        $this->bd->consulta($sql);
        if ($this->bd->filasAfectadas() > 0) {
            return $this->bd->extraer_todos()[0];
        }
        return false;
    }

    public function confirmarCuenta(): bool
    {
        $sql = "UPDATE hosteleria.usuarios SET confirmado = 1 WHERE email = '$this->email'";
        $this->bd->consulta($sql);
        return $this->bd->filasAfectadas() > 0;
    }


}