<div class="container mt-5">

    <h2>Crear nuevo ponente</h2>
    <?php if (!empty($error)): ?>
        <div style="color: red;">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
    <form action="ponentecrear" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre">
        </div>
        <div class="form-group">
            <label for="apellidos">Apellidos:</label>
            <input class="form-control" id="apellidos" name="apellidos">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>

        <button type="submit" class="btn btn-primary">Crear Ponente</button>
    </form>
</div>
