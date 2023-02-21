<div class="container mt-5">

    <h2>Editar ponente</h2>
    <?php
    /*obtenemos el ponente gracias a que su email esta en la variable de sesion*/

    use Models\Ponente;

    $ponente = (new Ponente())->getOne($_SESSION['emailPonente']);

    if (!empty($error)): ?>

        <div style="color: red;">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
    <form action="ponenteedit" method="POST">
        <input type="hidden" name="id" value="<?= $ponente[0]['id'] ?>">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $ponente[0]['nombre'] ?>">
        </div>
        <div class="form-group">
            <label for="apellidos">Apellidos:</label>
            <input type="text" class="form-control"   name="apellidos" value="<?= $ponente[0]['apellidos'] ?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $ponente[0]['email'] ?>">
        </div>

        <button type="submit" class="btn btn-primary">Editar Ponente</button>
    </form>
</div>
