const tabla = document.getElementById('tablaUsuarios');
const form = document.getElementById('formUsuario');

function cargar() {
    fetch(`${BASE_URL}/usuario/listar`)

        .then(r => r.json())
        .then(data => {
            tabla.innerHTML = '';
            data.forEach(u => {
                tabla.innerHTML += `
                    <tr>
                        <td>${u.nombre}</td>
                        <td>${u.correo}</td>
                        <td>
                            <button onclick="editar(${u.id})">✏️</button>
                            <button onclick="eliminar(${u.id})">❌</button>
                        </td>
                    </tr>
                `;
            });
        });
}

form.onsubmit = e => {
    e.preventDefault();

    const id = document.getElementById('id').value;
    const url = id ? `/usuario/actualizar/${id}` : '/usuario/guardar';

    fetch(url, {
        method: 'POST',
        body: new FormData(form)
    }).then(() => {
        form.reset();
        cargar();
    });
};

function editar(id) {
    fetch(`${BASE_URL}/usuario/obtener/${id}`)
        .then(r => r.json())
        .then(u => {
            document.getElementById('id').value = u.id;
            document.getElementById('nombre').value = u.nombre;
            document.getElementById('correo').value = u.correo;
        });
}

function eliminar(id) {
    fetch(`${BASE_URL}  /usuario/eliminar/${id}`, { method: 'DELETE' })
        .then(() => cargar());
}

cargar();
