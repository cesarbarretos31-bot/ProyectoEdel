<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>CRUD Usuarios | MORENSISTEM</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

<style>
/* ===============================
   ESTILO CYBER 2000s (Y2K)
================================ */
:root {
    --primary: #00f2ff;
    --secondary: #39ff14;
    --bg-dark: #000814;
    --card-bg: rgba(0, 29, 61, 0.6);
}

body {
    background: radial-gradient(circle at center, #001d3d 0%, #000814 100%);
    color: #e0e0e0;
    font-family: 'Montserrat', sans-serif;
    padding: 20px;
    min-height: 100vh;
}

h2 { 
    font-family: 'Share Tech Mono', monospace;
    color: #fff;
    text-transform: uppercase;
    letter-spacing: 4px;
    text-shadow: 0 0 15px var(--primary);
    margin-bottom: 25px;
}

/* Breadcrumbs al estilo Morensistem 2000s */
.breadcrumbs {
    margin-bottom: 30px;
    font-family: 'Courier New', monospace;
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 10px;
    background: var(--card-bg);
    padding: 10px 20px;
    border-radius: 50px;
    border: 1px solid rgba(0, 242, 255, 0.3);
    width: fit-content;
}

.breadcrumbs a {
    text-decoration: none;
    color: var(--primary);
    text-transform: uppercase;
}

.breadcrumbs span { color: var(--secondary); text-shadow: 0 0 5px var(--secondary); }
.breadcrumbs .activo { color: #fff; font-weight: bold; }

/* Inputs y Botones Estilo Terminal */
input[type="text"], input[type="email"], input[type="password"] {
    background: rgba(0, 0, 0, 0.5);
    border: 1px solid var(--primary);
    color: var(--primary);
    padding: 10px;
    font-family: 'Share Tech Mono', monospace;
    outline: none;
    border-radius: 4px;
    transition: 0.3s;
}

input:focus {
    box-shadow: 0 0 10px var(--primary);
}

button {
    cursor: pointer;
    background: linear-gradient(135deg, var(--primary), #0077b6);
    color: #000;
    border: none;
    border-radius: 4px;
    padding: 10px 20px;
    font-family: 'Share Tech Mono', monospace;
    font-weight: bold;
    text-transform: uppercase;
    transition: 0.3s;
}

button:hover {
    background: var(--secondary);
    box-shadow: 0 0 15px var(--secondary);
    transform: scale(1.05);
}

/* Tabla Estilo Matrix / Cyber */
table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 8px;
    margin-top: 20px;
}

th {
    font-family: 'Share Tech Mono', monospace;
    color: var(--secondary);
    text-transform: uppercase;
    text-align: left;
    padding: 12px;
    border-bottom: 2px solid var(--secondary);
}

td {
    background: var(--card-bg);
    padding: 15px;
    border-top: 1px solid rgba(0, 242, 255, 0.1);
    border-bottom: 1px solid rgba(0, 242, 255, 0.1);
}

td:first-child { border-left: 1px solid rgba(0, 242, 255, 0.1); border-radius: 8px 0 0 8px; }
td:last-child { border-right: 1px solid rgba(0, 242, 255, 0.1); border-radius: 0 8px 8px 0; }

/* Paginación */
#paginacion {
    margin-top: 30px;
}

#paginacion button {
    background: transparent;
    border: 1px solid var(--primary);
    color: var(--primary);
    margin: 0 4px;
}

#paginacion button.activa {
    background: var(--primary);
    color: #000;
}

/* MODAL RETRO-FUTURISTA */
.modal {
    background: rgba(0, 8, 20, 0.9);
    backdrop-filter: blur(8px);
}

.modal-contenido {
    background: #001d3d;
    border: 2px solid var(--primary);
    box-shadow: 0 0 30px rgba(0, 242, 255, 0.3);
    color: #fff;
    padding: 30px;
}

.cerrar { color: var(--secondary); }

@keyframes fadeIn {
    from { transform: translateY(-20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

/* Adaptación móvil con estilo */
@media(max-width:768px){
    tr { border: 1px solid var(--primary); margin-bottom: 10px; display: block; border-radius: 10px; }
    td { display: flex; justify-content: space-between; border: none; }
    td::before { content: attr(data-label); color: var(--primary); font-family: 'Share Tech Mono'; }
}
</style>
</head>

<body>

<nav class="breadcrumbs">
    <a href="<?= base_url() ?>">System</a>
    <span>⛧</span>
    <a href="<?= base_url('usuarios') ?>">Users</a>
    <span>⛧</span>
    <span class="activo">Terminal_CRUD</span>
</nav>

<h2>> Administrador_Usuarios_v2.0</h2>

<div style="display: flex; gap: 10px; flex-wrap: wrap;">
    <input type="text" id="buscar" placeholder="Escaneando base de datos...">
    <button onclick="abrirModal()">[+] Registrar_Sujeto</button>
</div>

<table>
    <thead>
        <tr>
            <th>Identificador_Nombre</th>
            <th>Protocolo_Correo</th>
            <th>Acciones_Root</th>
        </tr>
    </thead>
    <tbody id="tablaUsuarios"></tbody>
</table>

<div id="paginacion"></div>

<div id="modal" class="modal">
    <div class="modal-contenido">
        <span class="cerrar" onclick="cerrarModal()">&times;</span>
        <h3 id="tituloModal" style="font-family: 'Share Tech Mono'; color: var(--primary);">NUEVO_REGISTRO</h3>

        <form id="formUsuario">
            <input type="hidden" id="id" name="id">
            <div style="display: flex; flex-direction: column; gap: 15px;">
                <input type="text" id="nombre" name="nombre" placeholder="Nombre completo" required>
                <input type="email" id="correo" name="correo" placeholder="Email corporativo" required>
                <input type="password" id="password" name="password" placeholder="Key_Password">
                <button type="submit">Ejecutar_Guardado</button>
            </div>
        </form>
    </div>
</div>

<script>
/* Lógica estrictamente original sin cambios de funcionalidad */
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
                <button onclick="editar(${u.id})">Edit</button>
                <button onclick="eliminar(${u.id})" style="background:transparent; border:1px solid #ff0055; color:#ff0055;">Kill</button>
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
        paginacion.innerHTML += `<button onclick="cambiarPagina(${i})" class="${i===paginaActual?'activa':''}">${i}</button>`;
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

function abrirModal(){
    document.getElementById("tituloModal").innerText="NUEVO_REGISTRO";
    form.reset();
    document.getElementById("id").value="";
    modal.style.display="flex";
}

function cerrarModal(){ modal.style.display="none"; }

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
        cerrarModal();
        cargarUsuarios();
    });
});

function editar(id){
    fetch(`${BASE}/api/usuarios/${id}`)
    .then(res=>res.json())
    .then(data=>{
        document.getElementById("tituloModal").innerText="MODIFICAR_SUJETO";
        document.getElementById("id").value=data.id;
        document.getElementById("nombre").value=data.nombre;
        document.getElementById("correo").value=data.correo;
        modal.style.display="flex";
    });
}

function eliminar(id){
    if(!confirm("¿CONFIRMAR ELIMINACIÓN DE REGISTRO?")) return;
    fetch(`${BASE}/api/usuarios/${id}`,{ method:"DELETE" })
    .then(res=>res.json())
    .then(()=>cargarUsuarios());
}

buscar.addEventListener("keyup",function(){
    const texto=this.value.trim();
    if(texto===""){ cargarUsuarios(); return; }
    fetch(`${BASE}/api/usuarios/buscar?q=${texto}`)
    .then(res=>res.json())
    .then(data=>{
        usuariosGlobal=data;
        paginaActual=1;
        mostrarPagina();
    });
});

cargarUsuarios();
</script>

</body>
</html>