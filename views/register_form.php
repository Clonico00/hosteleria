<h1>Registro de Usuario</h1>
<?php if (!empty($error)): ?>
    <div style="color: red;">
        <?php echo $error; ?>
    </div>
<?php endif; ?>

<form method="post" action="register">
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>
    <div class="form-group">
        <label for="apellidos">Apellidos:</label>
        <input type="text" class="form-control" id="apellidos" name="apellidos" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="register" value="Registrarse">
    </div>
</form>