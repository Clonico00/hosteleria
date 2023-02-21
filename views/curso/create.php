<div class="container mt-5">
    <h2>Crear nuevo curso</h2>
    <?php if (!empty($error)): ?>
        <div style="color: red;">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
    <form action="cursocrear" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre">
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <input class="form-control" id="descripcion" name="descripcion">
        <?php
        //obtenemos todos los ponentes
        use Models\Ponente;
        $ponentes = (new Ponente())->getAll();

        //creamos un select con todos los ponentes

        echo '<div class="form-group">
              <label for="ponente">Ponente:</label>
              <select name="ponente_id" class="form-control">';
                    foreach ($ponentes as $ponente){
                        echo '<option value="'.$ponente['id'].'">'.$ponente['nombre'].' '.$ponente['apellidos'].'</option>';
                    }
        echo '</select>';

        ?>
        <div class="form-group">
            <label for="fecha_inicio">Fecha de inicio:</label>
            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="2022-02-20" min="2022-02-20">
        </div>
        <div class="form-group">
            <label for="fecha_fin">Fecha de fin:</label>
            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="2022-02-20" min="2022-02-20">
        </div>
        <button type="submit" class="btn btn-primary">Crear curso</button>
    </form>
</div>
