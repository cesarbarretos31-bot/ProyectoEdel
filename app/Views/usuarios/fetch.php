<h2>CRUD Usuarios (Fetch)</h2>

<form id="formUsuario">
    <input type="hidden" id="id">

    <input type="text" id="nombre" placeholder="Nombre" required>
    <input type="email" id="correo" placeholder="Correo" required>
    <input type="password" id="password" placeholder="Password">

    <button type="submit">Guardar</button>
</form>

<hr>

<table border="1" width="100%">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody id="tablaUsuarios"></tbody>
</table>

<script>
const BASE = "<?= base_url() ?>";
</script>
<script src="<?= base_url('js/usuarios.js') ?>"></script>
