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
}