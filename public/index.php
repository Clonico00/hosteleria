<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use Lib\Router;
use Lib\Pages;

use Models\User;
use Models\Ponente;
use Models\Curso;

use Controllers\UserController;
use Controllers\PonenteController;
use Controllers\CursoController;

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

Router::add('GET', '/cursos', function () {
    // Cargar la vista del menú de navegación y la sección de registro
    include __DIR__ . '/../views/layout/header.php';
    //con Pages, le pasamos a show.php la variable $cursos, la cual contendra todos los cursos
    $pages = new Pages();
    $pages->render('curso/show', ['cursos' => (new Curso())->getAll()]);
    include __DIR__ . '/../views/layout/footer.php';
});

Router::add('GET', '/ponentes', function () {
    // Cargar la vista del menú de navegación y la sección de registro
    include __DIR__ . '/../views/layout/header.php';
    //con Pages, le pasamos a show.php la variable $ponentes, la cual contendra todos los ponentes
    $pages = new Pages();
    $pages->render('ponente/show', ['ponentes' => (new Ponente())->getAll()]);
    include __DIR__ . '/../views/layout/footer.php';
});

Router::add('GET', '/cursoscrear', function () {
    // Cargar la vista del menú de navegación y la sección de registro
    include __DIR__ . '/../views/layout/header.php';
    include __DIR__ . '/../views/curso/create.php';
    include __DIR__ . '/../views/layout/footer.php';
});

Router::add('POST', '/cursocrear', function () {
    // Cargar la vista del menú de navegación y la sección de registro
    $controller = new CursoController();
    $controller->create();
});

Router::add('POST', '/cursoborrar', function () {
    // Cargar la vista del menú de navegación y la sección de registro
    $controller = new CursoController();
    $controller->delete($_POST['id']);
});

Router::add('GET', '/ponentecrear', function () {
    // Cargar la vista del menú de navegación y la sección de registro
    include __DIR__ . '/../views/layout/header.php';
    include __DIR__ . '/../views/ponente/create.php';
    include __DIR__ . '/../views/layout/footer.php';
});

Router::add('POST', '/ponentecrear', function () {
    // Cargar la vista del menú de navegación y la sección de registro
    $controller = new PonenteController();
    $controller->create();
});

Router::add('POST', '/ponenteeditar', function () {
    // Cargar la vista del menú de navegación y la sección de registro
    include __DIR__ . '/../views/layout/header.php';
    $_SESSION['emailPonente'] = $_POST['email'];
    include __DIR__ . '/../views/ponente/edit.php';
    include __DIR__ . '/../views/layout/footer.php';
});

Router::add('POST', '/ponenteedit', function () {
    // Cargar la vista del menú de navegación y la sección de registro
    $controller = new PonenteController();
    $controller->edit($_POST['id']);
});

Router::add('POST', '/ponenteborrar', function () {
    // Cargar la vista del menú de navegación y la sección de registro
    $controller = new PonenteController();
    $controller->delete($_POST['id']);
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
