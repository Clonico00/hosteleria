<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cursos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
          crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Cursos</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Fecha inicio</th>
                    <th scope="col">Fecha fin</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <td>


                </td>
                <td>


                </td>
                <td>


                </td>
                <td>


                </td>
                <td>


                </td>
                <td>
                    <form action="cursoeditar" method="POST" class="d-inline">
                        <input type="hidden" name="id" value="">
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </form>
                    <form action="cursoborrar" method="POST"
                          onsubmit="return confirm('¿Estas seguro de que quieres borrar este ponente?');"
                          class="d-inline">
                        <input type="hidden" name="id" value="">
                        <button type="submit" class="btn btn-danger">Borrar</button>
                    </form>
                </td>
                <!--                --><?php //foreach ($cursos as $curso): ?>
                <!--                    <tr>-->
                <!--                        <th scope="row">--><?php //= $curso['id'] ?><!--</th>-->
                <!--                        <td>--><?php //= $curso['nombre'] ?><!--</td>-->
                <!--                        <td>--><?php //= $curso['descripcion'] ?><!--</td>-->
                <!--                        <td>--><?php //= $curso['fecha_inicio'] ?><!--</td>-->
                <!--                        <td>--><?php //= $curso['fecha_fin'] ?><!--</td>-->
                <!--                    </tr>-->
                <!--                --><?php //endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <a class="btn btn-success" href="cursoscrear">Agregar curso</a>

</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-ys8f5G5A5o5uzRxY9gTTW8h+hHheF5Z+ncv6U1k6UJ4C4P4fPA4vCq3NTKT8PVT0"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>
</body>
</html>
