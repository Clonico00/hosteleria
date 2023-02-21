<?php

namespace controllers;

use Lib\Pages;
use Lib\Utils;
use Models\Ponente;

class PonenteController
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
                $this->pages->render('ponente/create', ['error' => $data]);
                return;
            }
            //Validar que el email no este registrado
            $ponente = new Ponente();
            $ponente->setEmail($email);
            $ponente = $ponente->getOne($email);
            if ($ponente) {
                $this->pages->render('ponente/create', ['error' => 'El email ya esta registrado']);
                return;
            }

            // Llamar al método login del modelo Ponente
            $ponente = new Ponente();
            $ponente->setNombre($nombre);
            $ponente->setApellidos($apellidos);
            $ponente->setEmail($email);
            $create_result = $ponente->insert();

            if ($create_result) {
                //si el login es corrcto guardamos los datos del usuario en la sesion y lo mandamos a la pagina de inicio
                $_SESSION['ponente'] = $create_result;

                // Redirigir al usuario a la página de inicio
                header('Location: ponentes');

            } else {
                // Mostrar un mensaje de error en el formulario de login
                $this->pages->render('ponente/create', ['error' => 'Error al crear el ponente']);
            }

        } catch (\PDOException|\Exception $e) {
            $this->pages->render('ponente/create', ['error' => $e->getMessage()]);
            return;
        }
    }

    public function delete(mixed $id)
    {
        try {
            $ponente = new Ponente();
            $ponente->setId($id);
            $delete_result = $ponente->delete();
            if ($delete_result) {
                header('Location: ponentes');
            } else {
                $this->pages->render('ponente/delete', ['error' => 'Error al eliminar el ponente']);
            }
        } catch (\PDOException|\Exception $e) {
            $this->pages->render('ponente/delete', ['error' => $e->getMessage()]);
            return;
        }
    }

    public function edit(mixed $id)
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
    }
}