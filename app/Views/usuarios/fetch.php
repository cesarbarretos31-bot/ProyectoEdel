<!DOCTYPE html>
<html>
<head>
    <title>CRUD Usuarios Fetch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: Arial; padding: 20px; }
        input { padding: 8px; margin: 5px; }
        button { padding: 8px 12px; cursor: pointer; }
        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        th { background: #333; color: white; }
    </style>
</head>
<body>

<h2>CRUD Usuarios (Fetch + DOM)</h2>

<form id="formUsuario">
    <input type="hidden" id="id">

    <input type="text" id="nombre" placeholder="Nombre" required>
    <input type="email" id="correo" placeholder="Correo" required>
    <input type="password" id="password" placeholder="Password">

    <button type="submit">Guardar</button>
</form>

<table>
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

const tabla = document.getElementById('tablaUsuarios');
const form = document.getElementById('formUsuario');

const idInput = document.getElementById('id');
const nombre = document.getElementById('nombre');
const correo = document.getElementById('correo');
const password = document.getElementById('password');


// 🔥 1️⃣ CARGAR USUARIOS
function cargarUsuarios() {
    fetch(`${BASE}/api/usuarios`)
        .then(res => res.json())
        .then(data => {
            tabla.innerHTML = '';

            data.forEach(usuario => {
                const fila = document.createElement('tr');

                fila.innerHTML = `
                    <td>${usuario.nombre}</td>
                    <td>${usuario.correo}</td>
                    <td>
                        <button onclick="editar(${usuario.id})">Editar</button>
                        <button onclick="eliminar(${usuario.id})">Eliminar</button>
                    </td>
                `;

                tabla.appendChild(fila);
            });
        });
}


// 🔥 2️⃣ GUARDAR / ACTUALIZAR
form.addEventListener('submit', function(e) {
    e.preventDefault();

    const id = idInput.value;
    const url = id 
        ? `${BASE}/api/usuarios/${id}` 
        : `${BASE}/api/usuarios`;

    const formData = new FormData();
    formData.append('nombre', nombre.value);
    formData.append('correo', correo.value);
    formData.append('password', password.value);

    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        form.reset();
        idInput.value = '';
        cargarUsuarios();
    });
});


// 🔥 3️⃣ EDITAR
function editar(id) {
    fetch(`${BASE}/api/usuarios/${id}`)
        .then(res => res.json())
        .then(data => {
            idInput.value = data.id;
            nombre.value = data.nombre;
            correo.value = data.correo;
        });
}


// 🔥 4️⃣ ELIMINAR
function eliminar(id) {
    if (!confirm("¿Eliminar usuario?")) return;

    fetch(`${BASE}/api/usuarios/${id}`, {
        method: 'DELETE'
    })
    .then(res => res.json())
    .then(() => cargarUsuarios());
}


// 🔥 5️⃣ CARGA INICIAL
cargarUsuarios();
</script>

</body>
</html>
