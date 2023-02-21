<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use Lib\Router;
use Models\User;
use Controllers\UserController;

$dotenv = Dotenv::createImmutable(dirname(__DIR__ . '/public'));
$dotenv->load();
Router::add('GET', '/', function () {
    // Cargar la vista del menú de navegación y las secciones de inicio de sesión y registro
    include __DIR__ . '/../views/layout/header.php';
    include __DIR__ . '/../views/index.php';
    include __DIR__ . '/../views/layout/footer.php';
});
// Ruta raíz
Router::add('GET', '/index', function () {
    // Cargar la vista del menú de navegación y las secciones de inicio de sesión y registro
    include __DIR__ . '/../views/layout/header.php';
    include __DIR__ . '/../views/index.php';
    include __DIR__ . '/../views/layout/footer.php';
});


Router::add('GET', '/login', function () {
    // Cargar la vista del menú de navegación y la sección de inicio de sesión
    include __DIR__ . '/../views/layout/header.php';
    include __DIR__ . '/../views/login_form.php';
    include __DIR__ . '/../views/layout/footer.php';
});

Router::add('GET', '/register', function () {
    // Cargar la vista del menú de navegación y la sección de registro
    include __DIR__ . '/../views/layout/header.php';
    include __DIR__ . '/../views/register_form.php';
    include __DIR__ . '/../views/layout/footer.php';
});

// Ruta de registro de usuario
Router::add('POST', '/register', function () {
    $controller = new UserController();
    $controller->register();
});

// Ruta de inicio de sesión de usuario
Router::add('POST', '/login', function () {
    $controller = new UserController();
    $controller->login();
});

// Ruta de cierre de sesión de usuario
Router::add('GET', '/logout', function () {
    // Eliminar los datos de la sesión
    session_start();
    session_destroy();
    // Redirigir al usuario a la página de inicio
    include __DIR__ . '/../views/layout/header.php';
    include __DIR__ . '/../views/index.php';
    include __DIR__ . '/../views/layout/footer.php';
});


Router::add('POST', '/verificar_correo', function () {
    session_start();
    $codigo = $_POST['codigo'];
    //comprobamos que el codigo de verificacion es correcto comprandolo con el que hay en la sesion
    if ($codigo == $_SESSION['codigoVerificacion']) {
        //cogemos el usuario gracias al correo, y al metodo getUserByEmail
        $user = new User();
        $usuario = $user->getUserByEmail($_SESSION['email']);
        //guardamos los datos de $usuario en un objeto de tipo User
        $user->setId($usuario['id']);
        $user->setNombre($usuario['nombre']);
        $user->setApellidos($usuario['apellidos']);
        $user->setEmail($usuario['email']);
        $user->setPassword($usuario['password']);
        $user->setRol($usuario['rol']);
        $user->setConfirmado("1");

        //actualizamos el usuario con el metodo update
        if ($user->update()) {
            //si se actualiza correctamente, redirigimos al usuario a la pagina de login
            header('Location: login');
            exit();
        } else {
            //si no se actualiza correctamente, le mandamos otra vez al formulario de verificacion
            include __DIR__ . '/../views/layout/header.php';
            include __DIR__ . '/../views/verificar_correo.php';
            include __DIR__ . '/../views/layout/footer.php';
            exit();
        }
    } else {
        //si no es correcto mandamos, le mandamos otra vez al formulario de verificacion

        include __DIR__ . '/../views/layout/header.php';
        include __DIR__ . '/../views/verificar_correo.php';
        include __DIR__ . '/../views/layout/footer.php';
        exit();
    }

});


Router::dispatch();
