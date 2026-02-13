<?= breadcrumbs([
    ['title'=>'Inicio','url'=>site_url('/')],
    ['title'=>'Usuarios','url'=>site_url('usuarios')],
    ['title'=>'Listado','url'=>'']
]) ?>

<div class="container mt-4">
    <form id="formUsuario">
        <input type="hidden" id="id">

        <input class="form-control mb-2" id="nombre" placeholder="Nombre" required>
        <input class="form-control mb-2" id="correo" placeholder="Correo" required>
        <input class="form-control mb-2" id="password" placeholder="Password">

        <button class="btn btn-primary w-100">Guardar</button>
    </form>

    <table class="table table-dark mt-4">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="tablaUsuarios"></tbody>
    </table>
</div>

<script>
const BASE_URL = "<?= base_url() ?>";
</script>

<script src="<?= base_url('js/usuarios.js') ?>"></script>
