document.addEventListener('DOMContentLoaded', () => {
    cargarUsuarios();

    document.getElementById('formUsuario')
        .addEventListener('submit', guardarUsuario);
});
function cargarUsuarios() {
    fetch('/usuarios')
        .then(res => res.json())
        .then(data => {
            let filas = '';
            data.forEach(u => {
                filas += `
                    <tr>
                        <td>${u.id}</td>
                        <td>${u.nombre}</td>
                        <td>${u.correo}</td>
                        <td>
                            <button onclick="editar(${u.id})">Editar</button>
                            <button onclick="eliminar(${u.id})">Eliminar</button>
                        </td>
                    </tr>
                `;
            });
            document.getElementById('tablaUsuarios').innerHTML = filas;
        });
}
function guardarUsuario(e) {
    e.preventDefault();

    const id = document.getElementById('usuario_id').value;

    const formData = new FormData();
    formData.append('nombre', document.getElementById('nombre').value);
    formData.append('correo', document.getElementById('correo').value);
    formData.append('password', document.getElementById('password').value);

    let url = '/usuarios/guardar';

    if (id) {
        url = `/usuarios/actualizar/${id}`;
    }

    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(res => res.text())
    .then(() => {
        limpiarFormulario();
        cargarUsuarios();
    });
}
function editar(id) {
    fetch(`/usuarios/obtener/${id}`)
        .then(res => res.json())
        .then(u => {
            document.getElementById('usuario_id').value = u.id;
            document.getElementById('nombre').value = u.nombre;
            document.getElementById('correo').value = u.correo;
            document.getElementById('password').value = '';
        });
}
function guardarUsuario(e) {
    e.preventDefault();

    const id = document.getElementById('usuario_id').value;

    const formData = new FormData();
    formData.append('nombre', document.getElementById('nombre').value);
    formData.append('correo', document.getElementById('correo').value);
    formData.append('password', document.getElementById('password').value);

    let url = '/usuarios/guardar';

    if (id) {
        url = `/usuarios/actualizar/${id}`;
    }

    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(res => res.text())
    .then(() => {
        limpiarFormulario();
        cargarUsuarios();
    });
}
function eliminar(id) {
    if (!confirm('¿Eliminar usuario?')) return;

    fetch(`/usuarios/eliminar/${id}`, {
        method: 'DELETE'
    })
    .then(() => cargarUsuarios());
}
function limpiarFormulario() {
    document.getElementById('usuario_id').value = '';
    document.getElementById('formUsuario').reset();
}
function limpiarFormulario() {
    document.getElementById('usuario_id').value = '';
    document.getElementById('formUsuario').reset();
}
