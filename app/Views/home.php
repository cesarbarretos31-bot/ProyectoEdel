<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>CRUD Usuarios | MORENSISTEM</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;800&display=swap" rel="stylesheet">

<style>
    :root {
        --primary-glow: #a000ff;
        --secondary-glow: #ff0055;
        --bg-color: #050505;
        --card-bg: rgba(20, 20, 20, 0.8);
        --input-bg: rgba(255, 255, 255, 0.05);
    }

    body {
        min-height: 100vh;
        background-color: var(--bg-color);
        background-image: 
            radial-gradient(circle at 10% 20%, rgba(160, 0, 255, 0.1) 0%, transparent 40%),
            radial-gradient(circle at 90% 80%, rgba(255, 0, 85, 0.1) 0%, transparent 40%);
        font-family: 'Montserrat', sans-serif;
        color: #ffffff;
        padding: 40px 20px;
        margin: 0;
    }

    /* Fondo animado */
    .bg-glow {
        position: fixed;
        width: 400px;
        height: 400px;
        background: var(--primary-glow);
        filter: blur(120px);
        border-radius: 50%;
        z-index: -1;
        opacity: 0.15;
        animation: move 20s infinite alternate;
    }

    @keyframes move {
        from { transform: translate(-20%, -20%); }
        to { transform: translate(120%, 120%); }
    }

    .main-card {
        background: var(--card-bg);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
        border-radius: 24px;
        padding: 40px;
        max-width: 1000px;
        margin: 0 auto;
        animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    h2 {
        font-weight: 800;
        letter-spacing: 4px;
        text-transform: uppercase;
        background: linear-gradient(135deg, #fff 30%, var(--primary-glow) 70%, var(--secondary-glow));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 30px;
        text-align: center;
    }

    /* Inputs y Formulario */
    input[type="text"], input[type="email"], input[type="password"] {
        background: var(--input-bg);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        color: #fff;
        padding: 12px 20px;
        margin: 8px 0;
        width: 100%;
        transition: all 0.3s;
    }

    input:focus {
        outline: none;
        border-color: var(--primary-glow);
        box-shadow: 0 0 15px rgba(160, 0, 255, 0.3);
        background: rgba(255, 255, 255, 0.08);
    }

    #buscar {
        margin-bottom: 25px;
        border-left: 4px solid var(--primary-glow);
    }

    #formUsuario {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        align-items: end;
        background: rgba(255,255,255,0.02);
        padding: 20px;
        border-radius: 18px;
        margin-bottom: 40px;
    }

    button {
        padding: 12px 25px;
        border-radius: 12px;
        border: none;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s;
        cursor: pointer;
    }

    button[type="submit"] {
        background: linear-gradient(135deg, var(--primary-glow), #6a00af);
        color: white;
        box-shadow: 0 4px 15px rgba(160, 0, 255, 0.4);
    }

    button[type="submit"]:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(160, 0, 255, 0.6);
    }

    /* Tabla */
    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
        margin-top: 20px;
    }

    th {
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 2px;
        color: #888;
        padding: 15px;
        border: none;
    }

    td {
        background: rgba(255, 255, 255, 0.03);
        padding: 15px;
        border: none;
        vertical-align: middle;
    }

    tr td:first-child { border-radius: 12px 0 0 12px; }
    tr td:last-child { border-radius: 0 12px 12px 0; }

    tr:hover td {
        background: rgba(255, 255, 255, 0.07);
    }

    /* Botones de acción en tabla */
    td button {
        padding: 6px 12px;
        font-size: 0.75rem;
        margin-right: 5px;
        background: rgba(255, 255, 255, 0.1);
        color: #ccc;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    td button:first-child:hover {
        background: var(--primary-glow);
        color: white;
    }

    td button:last-child:hover {
        background: var(--secondary-glow);
        color: white;
    }

    /* Paginación */
    #paginacion {
        margin-top: 30px;
        display: flex;
        justify-content: center;
        gap: 8px;
    }

    #paginacion button {
        background: rgba(255,255,255,0.05);
        color: #fff;
        min-width: 40px;
        border: 1px solid rgba(255,255,255,0.1);
    }

    #paginacion button.activa {
        background: var(--primary-glow);
        border-color: var(--primary-glow);
        box-shadow: 0 0 15px rgba(160, 0, 255, 0.5);
    }

    #paginacion button:disabled {
        opacity: 0.2;
        cursor: not-allowed;
    }

    /* Breadcrumbs */
    .breadcrumbs {
        margin-bottom: 30px;
        font-size: 0.8rem;
        display: flex;
        gap: 10px;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .breadcrumbs a {
        text-decoration: none;
        color: var(--primary-glow);
        font-weight: 600;
    }

    .breadcrumbs span { color: #444; }
    .breadcrumbs .activo { color: #fff; }

    /* Responsivo Móvil */
    @media(max-width:768px){
        #formUsuario { grid-template-columns: 1fr; }
        table, thead, tbody, th, td, tr { display: block; }
        thead { display: none; }
        tr { margin-bottom: 20px; }
        td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            border-radius: 0 !important;
        }
        td::before {
            content: attr(data-label);
            font-weight: bold;
            color: var(--primary-glow);
            font-size: 0.7rem;
        }
    }
</style>
</head>

<body>
    <div class="bg-glow"></div>

    <div class="main-card">
        <nav class="breadcrumbs">
            <a href="<?= base_url() ?>">Inicio</a>
            <span>/</span>
            <a href="<?= base_url('usuarios') ?>">Usuarios</a>
            <span>/</span>
            <span class="activo">Gestión CRUD</span>
        </nav>

        <h2>Control de Usuarios</h2>

        <div class="row">
            <div class="col-12">
                <input type="text" id="buscar" placeholder="  Buscar usuario por nombre o correo...">
            </div>
        </div>

        <form id="formUsuario">
            <input type="hidden" id="id" name="id">
            <div>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre completo" required>
            </div>
            <div>
                <input type="email" id="correo" name="correo" placeholder="Correo electrónico" required>
            </div>
            <div>
                <input type="password" id="password" name="password" placeholder="Contraseña">
            </div>
            <button type="submit"><i class="bi bi-save2"></i> Guardar</button>
        </form>

        <div class="table-responsive">
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

        <div id="paginacion"></div>
    </div>

<script>
// EL SCRIPT SE MANTIENE EXACTAMENTE IGUAL AL ORIGINAL
const BASE = "<?= base_url() ?>";
const tabla = document.getElementById("tablaUsuarios");
const form = document.getElementById("formUsuario");
const buscar = document.getElementById("buscar");
const paginacion = document.getElementById("paginacion");

let usuariosGlobal = [];
let paginaActual = 1;
const registrosPorPagina = 5;

function cargarUsuarios(){
    fetch(`${BASE}/api/usuarios`)
    .then(res=>res.json())
    .then(data=>{
        usuariosGlobal = data;
        paginaActual = 1;
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
            <td data-label="Nombre">${u.nombre}</td>
            <td data-label="Correo">${u.correo}</td>
            <td data-label="Acciones">
                <button onclick="editar(${u.id})"><i class="bi bi-pencil-square"></i></button>
                <button onclick="eliminar(${u.id})"><i class="bi bi-trash3"></i></button>
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

    paginacion.innerHTML += `<button onclick="cambiarPagina(1)" ${paginaActual===1?'disabled':''}>&laquo;&laquo;</button>`;
    paginacion.innerHTML += `<button onclick="cambiarPagina(${paginaActual-1})" ${paginaActual===1?'disabled':''}>&laquo;</button>`;

    for(let i=1;i<=total;i++){
        paginacion.innerHTML += `
        <button onclick="cambiarPagina(${i})" class="${i===paginaActual?'activa':''}">
        ${i}
        </button>`;
    }

    paginacion.innerHTML += `<button onclick="cambiarPagina(${paginaActual+1})" ${paginaActual===total?'disabled':''}>&raquo;</button>`;
    paginacion.innerHTML += `<button onclick="cambiarPagina(${total})" ${paginaActual===total?'disabled':''}>&raquo;&raquo;</button>`;
}

function cambiarPagina(num){
    const total = Math.ceil(usuariosGlobal.length/registrosPorPagina);
    if(num<1 || num>total) return;
    paginaActual = num;
    mostrarPagina();
}

form.addEventListener("submit",function(e){
    e.preventDefault();
    const id = document.getElementById("id").value;
    const formData = new FormData(form);
    let url = `${BASE}/api/usuarios`;
    if(id){
        url = `${BASE}/api/usuarios/${id}`;
        formData.append('_method','PUT');
    }
    fetch(url,{ method:"POST", body:formData })
    .then(res=>res.json())
    .then(()=>{
        form.reset();
        document.getElementById("id").value = ""; 
        cargarUsuarios();
    });
});

function editar(id){
    fetch(`${BASE}/api/usuarios/${id}`)
    .then(res=>res.json())
    .then(data=>{
        document.getElementById("id").value = data.id;
        document.getElementById("nombre").value = data.nombre;
        document.getElementById("correo").value = data.correo;
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}

function eliminar(id){
    if(!confirm("¿Eliminar usuario?")) return;
    fetch(`${BASE}/api/usuarios/${id}`,{ method:"DELETE" })
    .then(res=>res.json())
    .then(()=>cargarUsuarios());
}

buscar.addEventListener("keyup",function(){
    const texto = this.value.trim();
    if(texto===""){ cargarUsuarios(); return; }
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