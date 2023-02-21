<?php

namespace controllers;

use Lib\Pages;
use Lib\Utils;
use Models\Curso;

class CursoController
{
    private Pages $pages;

    public function __construct()
    {
        $this->pages = new Pages();
    }
    public function create()
    {


        try {
            // Obtener los datos del formulario
            $nombre = $_POST['nombre'] ?? '';
            $descripcion = $_POST['descripcion'] ?? '';
            $ponente = $_POST['ponente_id'] ?? '';
            $fecha_inicio = $_POST['fecha_inicio'] ?? '';
            $fecha_fin = $_POST['fecha_fin'] ?? '';

            // Validar los datos del formulario
            $data = [
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'ponente' => $ponente,
                'fecha_inicio' => $fecha_inicio,
                'fecha_fin' => $fecha_fin
            ];


            $data = Utils::validarDatosCurso($data,);
            if (is_string($data)) {
                $this->pages->render('curso/create', ['error' => $data]);
                return;
            }
            //Validar que el email no este registrado
            $curso = new Curso();
            $curso->setNombre($nombre);
            $curso = $curso->getOne($nombre);
            if ($curso) {
                $this->pages->render('curso/create', ['error' => 'El curso ya esta registrado']);
                return;
            }

            // Llamar al método login del modelo Ponente
            $curso = new Curso();
            $curso->setNombre($nombre);
            $curso->setDescripcion($descripcion);
            $curso->setPonenteId($ponente);
            $curso->setFechaInicio($fecha_inicio);
            $curso->setFechaFin($fecha_fin);
            $create_result = $curso->insert();

            if ($create_result) {
                //si el login es corrcto guardamos los datos del usuario en la sesion y lo mandamos a la pagina de inicio
                $_SESSION['curso'] = $create_result;

                // Redirigir al usuario a la página de inicio
                header('Location: cursos');

            } else {
                // Mostrar un mensaje de error en el formulario de login
                $this->pages->render('curso/create', ['error' => 'Error al crear el curso']);
            }

        } catch (\PDOException|\Exception $e) {
            $this->pages->render('curso/create', ['error' => $e->getMessage()]);
            return;
        }
    }

    public function delete(mixed $id)
    {
        try {
            $curso = new Curso();
            $curso->setId($id);
            if ($curso->delete()) {
                header('Location: cursos');
            } else {
                $this->pages->render('curso/cursos', ['error' => 'Error al eliminar el curso']);
            }

        } catch (\PDOException|\Exception $e) {
            $this->pages->render('curso/create', ['error' => $e->getMessage()]);
            return;
        }
    }

    /*hacemos el metodo edit, de la misma forma que para ponente pero con los valores de cursos: public function edit(mixed $id)
    {
        try {
            // Obtener los datos del formulario
            $nombre = $_POST['nombre'] ?? '';
            $apellidos = $_POST['apellidos'] ?? '';
            $email = $_POST['email'] ?? '';
            // Validar los datos del formulario
            $data = [
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'email' => $email,
            ];

            $data = Utils::validarDatosPonente($data,);
            if (is_string($data)) {
                $this->pages->render('ponente/edit', ['error' => $data]);
                return;
            }
            //Validar que el email no este registrado, si es el mismo no pasa nada
            $ponente = new Ponente();
            $ponente->setEmail($email);
            $ponente = $ponente->getOne($email);
            if ($ponente && $ponente[0]["id"] != $id) {
                $this->pages->render('ponente/edit', ['error' => 'El email ya esta registrado']);
                return;
            }


            // Llamar al método login del modelo Ponente
            $ponente = new Ponente();
            $ponente->setId($id);
            $ponente->setNombre($nombre);
            $ponente->setApellidos($apellidos);
            $ponente->setEmail($email);
            $update_result = $ponente->update();

            if ($update_result) {
                //si el login es corrcto guardamos los datos del usuario en la sesion y lo mandamos a la pagina de inicio
                $_SESSION['ponente'] = $update_result;

                // Redirigir al usuario a la página de inicio
                header('Location: ponentes');

            } else {
                // Mostrar un mensaje de error en el formulario de login
                $this->pages->render('ponente/edit', ['error' => 'Error al actualizar el ponente']);
            }

        } catch (\PDOException|\Exception $e) {
            $this->pages->render('ponente/edit', ['error' => $e->getMessage()]);
            return;
        }
    }*/

    public function edit(mixed $id)
    {
        try {
            // Obtener los datos del formulario
            $nombre = $_POST['nombre'] ?? '';
            $descripcion = $_POST['descripcion'] ?? '';
            $ponente = $_POST['ponente_id'] ?? '';
            $fecha_inicio = $_POST['fecha_inicio'] ?? '';
            $fecha_fin = $_POST['fecha_fin'] ?? '';

            // Validar los datos del formulario
            $data = [
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'ponente' => $ponente,
                'fecha_inicio' => $fecha_inicio,
                'fecha_fin' => $fecha_fin
            ];

            $data = Utils::validarDatosCurso($data,);

            if (is_string($data)) {
                $this->pages->render('curso/edit', ['error' => $data]);
                return;
            }


            // Llamar al método login del modelo Ponente
            $curso = new Curso();
            $curso->setId($id);
            $curso->setNombre($nombre);
            $curso->setDescripcion($descripcion);
            $curso->setPonenteId($ponente);
            $curso->setFechaInicio($fecha_inicio);
            $curso->setFechaFin($fecha_fin);
            $update_result = $curso->update();

            if ($update_result) {
                //si el login es corrcto guardamos los datos del usuario en la sesion y lo mandamos a la pagina de inicio
                $_SESSION['curso'] = $update_result;

                // Redirigir al usuario a la página de inicio
                header('Location: cursos');

            } else {
                // Mostrar un mensaje de error en el formulario de login
                $this->pages->render('curso/edit', ['error' => 'Error al actualizar el curso']);
            }

        } catch (\PDOException|\Exception $e) {
            $this->pages->render('curso/edit', ['error' => $e->getMessage()]);
            return;
        }


    }
}