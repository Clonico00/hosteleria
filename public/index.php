<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use Lib\Router;
use Models\User;
use Controllers\UserController;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
// Ruta raíz
Router::add('GET', '/', function () {
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

Router::dispatch();
