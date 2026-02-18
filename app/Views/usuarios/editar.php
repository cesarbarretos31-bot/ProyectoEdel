<h2>Editar Usuario</h2>

<form action="<?= site_url('usuarios/actualizar/'.$usuario['id']) ?>" method="post">
    <input type="text" name="nombre" value="<?= $usuario['nombre'] ?>" required>
    <input type="email" name="correo" value="<?= $usuario['correo'] ?>" required>
    <input type="password" name="password" placeholder="Nueva contraseña (opcional)">
    <button type="submit">Actualizar</button>
</form>
