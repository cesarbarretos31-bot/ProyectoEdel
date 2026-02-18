<!DOCTYPE html>
<html lang="es">
<head>
    <title>CRUD Usuarios Fetch - Elite Interface</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&family=JetBrains+Mono&display=swap" rel="stylesheet">

    <style>
        body { 
            background: radial-gradient(circle at top, #1a0b2e 0%, #000000 100%);
            color: #e0e0e0;
            font-family: 'Montserrat', sans-serif; 
            padding: 40px 20px; 
            min-height: 100vh;
            margin: 0;
        }

        h2 {
            font-weight: 700;
            letter-spacing: 5px;
            color: #fff;
            text-shadow: 0 0 15px rgba(160, 0, 255, 0.6);
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        input { 
            background: rgba(20, 20, 20, 0.8);
            border: 1px solid #333;
            padding: 12px 18px; 
            margin: 8px 0; 
            border-radius: 8px;
            color: #fff;
            font-family: 'JetBrains Mono', monospace;
            transition: 0.3s ease;
            outline: none;
        }

        input:focus {
            border-color: #a000ff;
            box-shadow: 0 0 12px rgba(160, 0, 255, 0.4);
            background: #000;
        }

        #buscar { width: 100%; max-width: 400px; border-left: 4px solid #ff0050; }

        button { 
            background: linear-gradient(135deg, #a000ff, #6a00af);
            color: white;
            padding: 10px 20px; 
            border: none;
            border-radius: 6px;
            cursor: pointer; 
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s;
        }

        button:hover { 
            transform: translateY(-2px);
            filter: brightness(1.2);
        }

        button[onclick*="eliminar"] {
            background: linear-gradient(135deg, #ff0050, #b3003b);
        }

        button[onclick*="editar"] {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .table-container {
            background: rgba(10, 10, 10, 0.6);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            margin-top: 30px;
        }

        table { width: 100%; border-collapse: collapse; }

        th, td { padding: 16px; text-align: left; }

        th { 
            color: #ff0050; 
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 2px;
        }

        td { font-family: 'JetBrains Mono', monospace; font-size: 14px; }

        tr:hover { background: rgba(160, 0, 255, 0.05); }

        .breadcrumbs {
            margin-bottom: 30px;
            font-family: 'JetBrains Mono', monospace;
            background: rgba(255, 255, 255, 0.03);
            padding: 10px 20px;
            border-radius: 30px;
            display: inline-block;
        }

        .breadcrumbs a { text-decoration: none; color: #a000ff; font-weight: bold; }
        .breadcrumbs span { color: #555; margin: 0 10px; }
        .breadcrumbs .activo { color: #fff; }

        #estadoBusqueda { margin-top: 10px; font-size: 13px; }

        .resaltado { background: rgba(255, 0, 80, 0.3); padding: 2px 4px; border-radius: 4px; }

        #formUsuario {
            background: rgba(255, 255, 255, 0.02);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {

            #formUsuario { flex-direction: column; align-items: stretch; }
            #formUsuario input,
            #formUsuario button { width: 100%; }

            table, thead, tbody, th, td, tr { display: block; width: 100%; }
            thead { display: none; }

            tr {
                margin-bottom: 15px;
                background: rgba(255,255,255,0.03);
                padding: 15px;
                border-radius: 12px;
            }

            td {
                border: none;
                padding: 8px 0;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            td::before {
                content: attr(data-label);
                font-weight: bold;
                color: #ff0050;
                font-size: 11px;
            }

            td:last-child { flex-direction: column; gap: 8px; }
            td:last-child button { width: 100%; }
        }
    </style>
</head>
<body>

<div style="max-width:1000px;margin:auto;">
    <h2>CRUD</h2>

    <nav class="breadcrumbs" id="breadcrumbs"></nav>

    <input type="text" id="buscar" placeholder="Buscar usuario...">
    <p id="estadoBusqueda"></p>

    <form id="formUsuario">
        <input type="hidden" id="id">
        <input type="text" id="nombre" placeholder="Nombre" required>
        <input type="email" id="correo" placeholder="Correo" required>
        <input type="password" id="password" placeholder="Contraseña">
        <button type="submit">Guardar</button>
    </form>

    <div class="table-container">
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
    </div>
</div>

<script>
const BASE = "<?= base_url() ?>";
const tabla = document.getElementById('tablaUsuarios');
const form = document.getElementById('formUsuario');
const buscarInput = document.getElementById('buscar');
const estado = document.getElementById('estadoBusqueda');

function cargarUsuarios() {
    fetch(`${BASE}/api/usuarios`)
        .then(res => res.json())
        .then(data => {
            tabla.innerHTML = '';
            data.forEach(usuario => {
                tabla.innerHTML += `
                    <tr>
                        <td data-label="Nombre">${usuario.nombre}</td>
                        <td data-label="Correo">${usuario.correo}</td>
                        <td data-label="Acciones">
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
    const id = document.getElementById('id').value;
    const url = id ? `${BASE}/api/usuarios/${id}` : `${BASE}/api/usuarios`;

    const formData = new FormData(form);

    fetch(url, { method: 'POST', body: formData })
        .then(res => res.json())
        .then(() => { form.reset(); cargarUsuarios(); });
});

function editar(id) {
    fetch(`${BASE}/api/usuarios/${id}`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('id').value = data.id;
            document.getElementById('nombre').value = data.nombre;
            document.getElementById('correo').value = data.correo;
        });
}

function eliminar(id) {
    if (!confirm("¿Eliminar usuario?")) return;
    fetch(`${BASE}/api/usuarios/${id}`, { method: 'DELETE' })
        .then(res => res.json())
        .then(() => cargarUsuarios());
}

buscarInput.addEventListener('keyup', function() {
    const texto = this.value.trim();
    if (texto === '') return cargarUsuarios();

    fetch(`${BASE}/api/usuarios/buscar?q=${texto}`)
        .then(res => res.json())
        .then(data => {
            tabla.innerHTML = '';
            estado.textContent = `${data.length} resultado(s)`;
            data.forEach(usuario => {
                tabla.innerHTML += `
                    <tr>
                        <td data-label="Nombre">${usuario.nombre}</td>
                        <td data-label="Correo">${usuario.correo}</td>
                        <td data-label="Acciones">
                            <button onclick="editar(${usuario.id})">Editar</button>
                            <button onclick="eliminar(${usuario.id})">Eliminar</button>
                        </td>
                    </tr>
                `;
            });
        });
});

function generarBreadcrumbs() {
    const nav = document.getElementById('breadcrumbs');
    nav.innerHTML = `<a href="${BASE}">Inicio</a> › <span class="activo">Usuarios</span>`;
}

generarBreadcrumbs();
cargarUsuarios();
</script>

</body>
</html>
