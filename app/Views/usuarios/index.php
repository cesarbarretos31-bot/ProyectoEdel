<h2>Lista de Usuarios</h2>

<a href="<?= site_url('usuarios/crear') ?>">Crear Usuario</a>

<table border="1" cellpadding="10">
    <tr>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($usuarios as $u): ?>
        <tr>
            <td><?= $u['nombre'] ?></td>
            <td><?= $u['correo'] ?></td>
            <td>
                <a href="<?= site_url('usuarios/editar/'.$u['id']) ?>">Editar</a>
                <a href="<?= site_url('usuarios/eliminar/'.$u['id']) ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
