const tabla = document.getElementById('tablaUsuarios');
const form = document.getElementById('formUsuario');

const idInput = document.getElementById('id');
const nombre = document.getElementById('nombre');
const correo = document.getElementById('correo');
const password = document.getElementById('password');

function cargarUsuarios() {
    fetch(`${BASE}/api/usuarios`)
        .then(res => res.json())
        .then(data => {
            tabla.innerHTML = '';

            data.forEach(usuario => {
                tabla.innerHTML += `
                    <tr>
                        <td>${usuario.nombre}</td>
                        <td>${usuario.correo}</td>
                        <td>
                            <button onclick="editar(${usuario.id})">Editar</button>
                            <button onclick="eliminar(${usuario.id})">Eliminar</button>
                        </td>
                    </tr>
                `;
            });
        });
}

form.addEventListener('submit', e => {
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
    .then(() => {
        form.reset();
        idInput.value = '';
        cargarUsuarios();
    });
});

function editar(id) {
    fetch(`${BASE}/api/usuarios/${id}`)
        .then(res => res.json())
        .then(data => {
            idInput.value = data.id;
            nombre.value = data.nombre;
            correo.value = data.correo;
        });
}

function eliminar(id) {
    if (!confirm("¿Eliminar usuario?")) return;

    fetch(`${BASE}/api/usuarios/${id}`, {
        method: 'DELETE'
    })
    .then(res => res.json())
    .then(() => cargarUsuarios());
}

cargarUsuarios();
const buscarInput = document.getElementById('buscar');
const estado = document.getElementById('estadoBusqueda');

if (buscarInput) {

    buscarInput.addEventListener('keyup', function() {

        const texto = this.value.trim();

        if (texto === '') {
            estado.textContent = '';
            cargarUsuarios();
            return;
        }

        estado.textContent = '🔎 Buscando...';

        fetch(`${BASE}/api/usuarios/buscar?q=${texto}`)
            .then(res => res.json())
            .then(data => {

                tabla.innerHTML = '';

                if (data.length === 0) {
                    estado.textContent = '❌ No se encontraron resultados';
                    return;
                }

                estado.textContent = `✅ ${data.length} resultado(s) encontrado(s)`;

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
    });

}
