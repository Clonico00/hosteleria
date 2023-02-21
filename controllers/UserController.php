<?php

namespace controllers;

use Lib\Pages;
use Models\User;
use Lib\Utils;

class UserController
{
    private Pages $pages;

    public function __construct()
    {
        $this->pages = new Pages();
    }
    public function login()
    {
        session_start();
        try {
            // Obtener los datos del formulario
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Llamar al método login del modelo User
            $user = new User();
            $login_result = $user->login($email, $password);

            if ($login_result) {
                //Comprobamos que el usuario este confirmado
                if ($login_result['confirmado'] == 0) {
                    // Mostrar un mensaje de error en el formulario de login
                    $this->pages->render('login_form', ['error' => 'Usuario no confirmado']);
                    return;
                }

                //si el login es corrcto guardamos los datos del usuario en la sesion y lo mandamos a la pagina de inicio
                $_SESSION['user'] = $login_result;

                // Redirigir al usuario a la página de inicio
                header('Location: index');

            } else {
                // Mostrar un mensaje de error en el formulario de login
                $this->pages->render('login_form', ['error' => 'Usuario o contraseña incorrectos']);
            }
        }catch (\PDOException|\Exception $e) {
            $this->pages->render('login_form', ['error' => $e->getMessage()]);
            return;
        }
    }

    /**
     * @throws \Exception
     */
    public function register()
    {
        session_start();
        try {
            //hacemos el registro igual que en el login
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $rol = 'cliente'; // Por ejemplo, para este caso establecemos el rol como cliente.
            $confirmado = 0; // Establecemos confirmado como 0 porque el usuario aún no ha confirmado su cuenta.

            // Generar un código de verificación aleatorio
            $codigoVerificacion = $this->generarCodigoVerificacion();

            // Validar los datos usando los metodos de Lib\Utils
            $data = [
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'email' => $email,
                'password' => $password,
                'rol' => $rol,
                'confirmado' => $confirmado
            ];
            //comprobamos que los datos sean correctos, si nos devuelve $data es que todo es correcto si nos devuelve un string es que hay un error
            $data = Utils::validarDatosUsuario($data);
            if (is_string($data)) {
                $this->pages->render('register_form', ['error' => $data]);
                return;
            }

            // Validar que el email no exista en la base de datos
            $user = new User();
            $user->setEmail($email);
            $user_exists = $user->getUserByEmail($email);
            if ($user_exists) {
                $this->pages->render('register_form', ['error' => 'El email ya existe']);
                return;
            }

            // Encriptar la contraseña
            $password = password_hash($password, PASSWORD_DEFAULT);

            // Guardar los datos en la base de datos
            $usuario = new User();
            $usuario->setNombre($nombre);
            $usuario->setApellidos($apellidos);
            $usuario->setEmail($email);
            $usuario->setPassword($password);
            $usuario->setRol($rol);
            $usuario->setConfirmado($confirmado);
            $usuario->setCodigoVerificacion($codigoVerificacion);
            if ($usuario->insert()) {
                // Redirigir al usuario a la página principal de la aplicación
                $this->enviarCorreoVerificacion($email, $codigoVerificacion);
                //guardamos el codigo de verificacion en la sesion para que cuando el usuario lo introduzca en el formulario de verificacion lo podamos comprobar
                $_SESSION['codigoVerificacion'] = $codigoVerificacion;
                //guardamos el email del usuario en la sesion para que cuando el usuario lo introduzca en el formulario de verificacion lo podamos comprobar
                $_SESSION['email'] = $email;
                $this->pages->render('verificar_correo');
                return;
            } else {
                // Mostrar un mensaje de error en el formulario de registro
                $this->pages->render('register_form', ['error' => 'Error al guardar el usuario']);
                return;
            }

        } catch (\PDOException|\Exception $e) {
            $this->pages->render('register_form', ['error' => $e->getMessage()]);
            return;
        }
    }

    public function enviarCorreoVerificacion($email, $codigoVerificacion) {
        // Configurar los detalles del correo electrónico
        $to = $email;
        $subject = 'Verificación de correo electrónico';
        $message = 'Tu código de verificación es: ' . $codigoVerificacion;
        $headers = 'From: webmaster@example.com' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        // Enviar el correo electrónico
        mail($to, $subject, $message, $headers);
    }

    private function generarCodigoVerificacion()
    {
        // Generar un código de verificación aleatorio
        $codigoVerificacion = bin2hex(random_bytes(16));
        return $codigoVerificacion;
    }


}