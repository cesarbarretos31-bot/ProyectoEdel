<h2>Crear Usuario</h2>

<form action="<?= site_url('usuarios/guardar') ?>" method="post">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="email" name="correo" placeholder="Correo" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Guardar</button>
</form>
