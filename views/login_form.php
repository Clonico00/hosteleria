<h1>Iniciar sesión</h1>
<?php if (!empty($error)): ?>
    <div style="color: red;">
        <?php echo $error; ?>
    </div>
<?php endif; ?>
<form method="post" action="login">
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" value="" required>
    </div>
    <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Iniciar sesión">
    </div>
</form>
