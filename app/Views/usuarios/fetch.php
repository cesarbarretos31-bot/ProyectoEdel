<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios | Panel Pro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --danger: #ef4444;
            --success: #10b981;
        }

        body {
            background-color: var(--bg);
            color: var(--text-main);
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 900px;
        }

        /* Breadcrumbs moderno */
        .breadcrumbs {
            margin-bottom: 24px;
            font-size: 13px;
            color: var(--text-muted);
            display: flex;
            gap: 8px;
        }
        .breadcrumbs a { text-decoration: none; color: var(--primary); font-weight: 600; }
        .breadcrumbs span { color: var(--border); }

        /* Encabezado y controles */
        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        h2 { margin: 0; font-size: 28px; font-weight: 600; letter-spacing: -0.5px; }

        .search-container { position: relative; flex-grow: 1; max-width: 400px; }
        
        input[type="text"], input[type="email"], input[type="password"] {
            padding: 10px 15px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 14px;
            width: 100%;
            box-sizing: border-box;
            transition: all 0.2s;
            outline: none;
        }

        input:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1); }

        button {
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-new { background: var(--primary); color: white; }
        .btn-new:hover { background: var(--primary-hover); transform: translateY(-1px); }

        .btn-edit { background: #f1f5f9; color: var(--text-main); margin-right: 5px; }
        .btn-edit:hover { background: #e2e8f0; }

        .btn-delete { background: #fee2e2; color: var(--danger); }
        .btn-delete:hover { background: #fecaca; }

        /* Tabla Estilo Card */
        .card-table {
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
            overflow: hidden;
            border: 1px solid var(--border);
        }

        table { width: 100%; border-collapse: collapse; text-align: left; }
        
        th {
            background: #f8fafc;
            padding: 16px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border);
        }

        td { padding: 16px; border-bottom: 1px solid var(--border); font-size: 14px; }
        tr:last-child td { border-bottom: none; }
        tr:hover { background-color: #fbfcfd; }

        /* Paginación */
        #paginacion { margin-top: 25px; display: flex; justify-content: center; gap: 5px; }
        #paginacion button {
            padding: 8px 14px;
            background: white;
            border: 1px solid var(--border);
            color: var(--text-main);
        }
        #paginacion button.activa { background: var(--primary); color: white; border-color: var(--primary); }
        #paginacion button:disabled { opacity: 0.5; cursor: not-allowed; }

        /* Modal Rediseñado */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-contenido {
            background: white;
            padding: 32px;
            border-radius: 16px;
            width: 90%;
            max-width: 400px;
            position: relative;
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
        }

        #formUsuario input { margin-bottom: 15px; }
        #formUsuario button[type="submit"] { width: 100%; justify-content: center; background: var(--primary); color: white; padding: 12px; }

        .cerrar { position: absolute; right: 20px; top: 20px; font-size: 24px; cursor: pointer; color: var(--text-muted); }

        @media(max-width:768px){
            .header-actions { flex-direction: column; align-items: stretch; }
            table, thead, tbody, th, td, tr { display: block; }
            thead { display: none; }
            td { display: flex; justify-content: space-between; padding: 10px 16px; border-bottom: 1px solid var(--border); }
            td::before { content: attr(data-label); font-weight: 600; color: var(--text-muted); }
        }
    </style>
</head>

<body>

<div class="container">
    <nav class="breadcrumbs">
        <a href="<?= base_url() ?>">Inicio</a>
        <span>/</span>
        <a href="<?= base_url('usuarios') ?>">Usuarios</a>
        <span>/</span>
        <span style="color: var(--text-main)">Listado</span>
    </nav>

    <div class="header-actions">
        <h2>Usuarios</h2>
        <div class="search-container">
            <input type="text" id="buscar" placeholder="🔍 Buscar por nombre o correo...">
        </div>
        <button class="btn-new" onclick="abrirModal()">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Nuevo Usuario
        </button>
    </div>

    <div class="card-table">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th style="text-align: right;">Acciones</th>
                </tr>
            </thead>
            <tbody id="tablaUsuarios"></tbody>
        </table>
    </div>

    <div id="paginacion"></div>
</div>

<div id="modal" class="modal">
    <div class="modal-contenido">
        <span class="cerrar" onclick="cerrarModal()">&times;</span>
        <h3 id="tituloModal" style="margin-top:0; margin-bottom: 20px;">Nuevo Usuario</h3>

        <form id="formUsuario">
            <input type="hidden" id="id" name="id">
            <label style="font-size: 12px; font-weight: 600; color: var(--text-muted); display: block; margin-bottom: 5px;">Nombre Completo</label>
            <input type="text" id="nombre" name="nombre" placeholder="Ej. Juan Pérez" required>
            
            <label style="font-size: 12px; font-weight: 600; color: var(--text-muted); display: block; margin-bottom: 5px;">Correo Electrónico</label>
            <input type="email" id="correo" name="correo" placeholder="correo@ejemplo.com" required>
            
            <label style="font-size: 12px; font-weight: 600; color: var(--text-muted); display: block; margin-bottom: 5px;">Contraseña</label>
            <input type="password" id="password" name="password" placeholder="••••••••">
            
            <button type="submit">Guardar Cambios</button>
        </form>
    </div>
</div>

<script>
const BASE = "<?= base_url() ?>";
const tabla = document.getElementById("tablaUsuarios");
const form = document.getElementById("formUsuario");
const buscar = document.getElementById("buscar");
const paginacion = document.getElementById("paginacion");
const modal = document.getElementById("modal");

let usuariosGlobal = [];
let paginaActual = 1;
const registrosPorPagina = 5;

function cargarUsuarios(){
    fetch(`${BASE}/api/usuarios`)
    .then(res=>res.json())
    .then(data=>{
        usuariosGlobal = data;
        mostrarPagina();
    });
}

function mostrarPagina(){
    tabla.innerHTML = "";
    const inicio = (paginaActual-1)*registrosPorPagina;
    const fin = inicio + registrosPorPagina;
    const datos = usuariosGlobal.slice(inicio,fin);

    datos.forEach(u=>{
        tabla.innerHTML += `
        <tr>
            <td data-label="Nombre"><strong>${u.nombre}</strong></td>
            <td data-label="Correo" style="color: var(--text-muted)">${u.correo}</td>
            <td data-label="Acciones" style="text-align: right;">
                <button class="btn-edit" onclick="editar(${u.id})">Editar</button>
                <button class="btn-delete" onclick="eliminar(${u.id})">Eliminar</button>
            </td>
        </tr>
        `;
    });
    generarPaginacion();
}

function generarPaginacion(){
    paginacion.innerHTML="";
    const total = Math.ceil(usuariosGlobal.length/registrosPorPagina);
    if(total<=1) return;

    for(let i=1;i<=total;i++){
        paginacion.innerHTML += `
        <button onclick="cambiarPagina(${i})" class="${i===paginaActual?'activa':''}">
        ${i}
        </button>`;
    }
}

function cambiarPagina(num){
    paginaActual = num;
    mostrarPagina();
}

function abrirModal(){
    document.getElementById("tituloModal").innerText="Crear Cuenta";
    form.reset();
    document.getElementById("id").value="";
    modal.style.display="flex";
}

function cerrarModal(){ modal.style.display="none"; }

form.addEventListener("submit", function(e) {
    e.preventDefault();
    const id = document.getElementById("id").value;
    const formData = new FormData(form);
    let url = `${BASE}/api/usuarios`;
    
    if (id) {
        url = `${BASE}/api/usuarios/${id}`;
        formData.append('_method', 'PUT'); 
    }

    fetch(url, {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(() => {
        cerrarModal();
        cargarUsuarios();
    });
});

function editar(id){
    fetch(`${BASE}/api/usuarios/${id}`)
    .then(res=>res.json())
    .then(data=>{
        document.getElementById("tituloModal").innerText="Actualizar Datos";
        document.getElementById("id").value=data.id;
        document.getElementById("nombre").value=data.nombre;
        document.getElementById("correo").value=data.correo;
        modal.style.display="flex";
    });
}

function eliminar(id){
    if(!confirm("¿Estás seguro de que deseas eliminar este usuario?")) return;
    fetch(`${BASE}/api/usuarios/${id}`, {
        method: "DELETE",
        headers: { "X-Requested-With": "XMLHttpRequest" }
    })
    .then(() => cargarUsuarios());
}

buscar.addEventListener("keyup", function(){
    const texto = this.value.trim();
    if(texto === ""){ cargarUsuarios(); return; }
    fetch(`${BASE}/api/usuarios/buscar?q=${texto}`)
    .then(res=>res.json())
    .then(data=>{
        usuariosGlobal = data;
        paginaActual = 1;
        mostrarPagina();
    });
});

cargarUsuarios();
</script>
</body>
</html>