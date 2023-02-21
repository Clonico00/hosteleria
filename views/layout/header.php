<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        header {
            background-color: #f5f5f5;
            padding: 20px 0;
            border-top: 1px solid #ddd;
        }
    </style>
    <title>Bienvenido</title>
</head>
<body class="container-fluid p-0">
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">
                Escuela de Hostelería Buen Yantar
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <?php
                if (isset($_SESSION['user'])) {
                    echo '<div class="navbar-nav">
                    <a href="cursos" class="nav-item nav-link">Cursos</a>
                    <a href="ponentes" class="nav-item nav-link">Ponentes</a> 
                </div>
                <div class="navbar-nav ms-auto">
                    <a class="nav-item nav-link">' . $_SESSION['user']['nombre'] . '</a>
                    <a class="btn btn-outline-primary my-2 my-sm-0" href="logout">Cerrar sesión</a>
                </div>';
                } else {
                    echo ' <div class="navbar-nav">
                                    <a href="#" class="nav-item nav-link">Cursos</a>
                                </div>
                                <div class="navbar-nav ms-auto">
                                    <a class="btn btn-outline-primary my-2 my-sm-0" href="login">Iniciar sesión</a>
                                    <a class="btn btn-outline-primary my-2 my-sm-0" href="register">Registrarse</a>
                                </div>
                            </div>
                        </div>';
                }
                ?>
            </div>
    </nav>

</header>
</body>
</html>