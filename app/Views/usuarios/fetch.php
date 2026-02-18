<!DOCTYPE html>
<html lang="es">
<head>
    <title>CRUD Usuarios Fetch - Elite Interface</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&family=JetBrains+Mono&display=swap" rel="stylesheet">
    <style>
        /* =========================================
           VOID CORE DESIGN
           ========================================= */
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

        /* 🔍 BUSCADOR & INPUTS */
        input { 
            background: rgba(20, 20, 20, 0.8);
            border: 1px solid #333;
            padding: 12px 18px; 
            margin: 8px 0; 
            border-radius: 8px;
            color: #fff;
            font-family: 'JetBrains Mono', monospace;
            transition: all 0.3s ease;
            outline: none;
        }

        input:focus {
            border-color: #a000ff;
            box-shadow: 0 0 12px rgba(160, 0, 255, 0.4);
            background: #000;
        }

        #buscar {
            width: 100%;
            max-width: 400px;
            border-left: 4px solid #ff0050;
        }

        /* 🔘 BOTONES */
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
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }

        button:hover { 
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(160, 0, 255, 0.5);
            filter: brightness(1.2);
        }

        button[onclick*="eliminar"] {
            background: linear-gradient(135deg, #ff0050, #b3003b);
        }

        button[onclick*="editar"] {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* 📋 TABLA NEÓN */
        .table-container {
            background: rgba(10, 10, 10, 0.6);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            margin-top: 30px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        }

        table { 
            width: 100%; 
            border-collapse: collapse; 
        }

        th, td { 
            padding: 16px; 
            text-align: left; 
            border-bottom: 1px solid rgba(255, 255, 255, 0.05); 
        }

        th { 
            background: transparent;
            color: #ff0050; 
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 2px;
        }

        td { font-family: 'JetBrains Mono', monospace; font-size: 14px; }

        tr:hover {
            background: rgba(160, 0, 255, 0.05);
        }

        /* 🍞 BREADCRUMBS */
        .breadcrumbs {
            margin-bottom: 30px;
            font-family: 'JetBrains Mono', monospace;
            background: rgba(255, 255, 255, 0.03);
            padding: 10px 20px;
            border-radius: 30px;
            display: inline-block;
        }

        .breadcrumbs a {
            text-decoration: none;
            color: #a000ff;
            font-weight: bold;
        }

        .breadcrumbs span { color: #555; margin: 0 10px; }

        .breadcrumbs .activo { color: #fff; text-shadow: 0 0 8px #a000ff; }

        /* 🔔 ESTADOS & FEEDBACK */
        #estadoBusqueda { 
            margin-top: 15px; 
            font-size: 13px;
            color: #ff0050;
            font-family: 'JetBrains Mono', monospace;
        }

        .resaltado { 
            background: rgba(255, 0, 80, 0.3); 
            color: #fff;
            padding: 2px 4px;
            border-radius: 4px;
        }

        /* FORM LAYOUT */
        #formUsuario {
            background: rgba(255, 255, 255, 0.02);
            padding: 20px;
            border-radius: 12px;
            border: 1px dashed rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }
    </style>
</head>
<body>

<div style="max-width: 1000px; margin: auto;">
    <h2>USER_DATABASE</h2>
    
    <nav class="breadcrumbs" id="breadcrumbs"></nav>

    <div style="margin-bottom: 25px;">
        <input type="text" id="buscar" placeholder="🔍 SEARCH_SYSTEM_FILES...">
        <p id="estadoBusqueda"></p>
    </div>

    <form id="formUsuario">
        <input type="hidden" id="id">
        <input type="text" id="nombre" placeholder="Nombre" required>
        <input type="email" id="correo" placeholder="Correo electrónico" required>
        <input type="password" id="password" placeholder="Contraseña">
        <button type="submit">Sincronizar</button>
    </form>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Nombre de Usuario</th>
                    <th>Identificador de Correo</th>
                    <th>Protocolos</th>
                </tr>
            </thead>
            <tbody id="tablaUsuarios"></tbody>
        </table>
    </div>
</div>

<script>
// EL SCRIPT PERMANECE 100% IGUAL
const BASE = "<?= base_url() ?>";

const tabla = document.getElementById('tablaUsuarios');
const form = document.getElementById('formUsuario');

const idInput = document.getElementById('id');
const nombre = document.getElementById('nombre');
const correo = document.getElementById('correo');
const password = document.getElementById('password');

const buscarInput = document.getElementById('buscar');
const estado = document.getElementById('estadoBusqueda');


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
    .then(() => {
        form.reset();
        idInput.value = '';
        cargarUsuarios();
        estado.textContent = '✅ Registro guardado/actualizado';
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
            estado.textContent = '✏ Editando usuario';
        });
}


// 🔥 4️⃣ ELIMINAR
function eliminar(id) {
    if (!confirm("¿Eliminar usuario?")) return;

    fetch(`${BASE}/api/usuarios/${id}`, {
        method: 'DELETE'
    })
    .then(res => res.json())
    .then(() => {
        cargarUsuarios();
        estado.textContent = '🗑 Usuario eliminado';
    });
}


// 🔥 5️⃣ BUSCAR EN TIEMPO REAL
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

                const nombreResaltado = usuario.nombre.replace(
                    new RegExp(texto, "gi"),
                    match => `<span class="resaltado">${match}</span>`
                );

                const correoResaltado = usuario.correo.replace(
                    new RegExp(texto, "gi"),
                    match => `<span class="resaltado">${match}</span>`
                );

                const fila = document.createElement('tr');

                fila.innerHTML = `
                    <td>${nombreResaltado}</td>
                    <td>${correoResaltado}</td>
                    <td>
                        <button onclick="editar(${usuario.id})">Editar</button>
                        <button onclick="eliminar(${usuario.id})">Eliminar</button>
                    </td>
                `;

                tabla.appendChild(fila);
            });
        });
});


// 🔥 6️⃣ CARGA INICIAL
cargarUsuarios();
function generarBreadcrumbs() {

    const nav = document.getElementById('breadcrumbs');

    // Obtener ruta actual
    const rutaCompleta = window.location.pathname;

    // Separar por /
    const partes = rutaCompleta.split('/').filter(parte => parte !== '');

    let html = `<a href="${BASE}">Inicio</a>`;
    let acumulado = '';

    partes.forEach((parte, index) => {

        acumulado += '/' + parte;

        // Último elemento = activo
        if (index === partes.length - 1) {

            html += `
                <span>›</span>
                <span class="activo">
                    ${capitalizar(parte)}
                </span>
            `;

        } else {

            html += `
                <span>›</span>
                <a href="${BASE}${acumulado}">
                    ${capitalizar(parte)}
                </a>
            `;
        }

    });

    nav.innerHTML = html;
}

function capitalizar(texto) {
    return texto.charAt(0).toUpperCase() + texto.slice(1);
}

generarBreadcrumbs();
</script>

</body>
</html>