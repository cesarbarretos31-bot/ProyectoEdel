<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>CRUD Usuarios | MORENSISTEM</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

<style>
/* Estilo Cyber-Blue 2000s */
body{ background: radial-gradient(circle at center, #001d3d 0%, #000814 100%); color: #e0e0e0; font-family: 'Montserrat', sans-serif; padding: 20px; min-height: 100vh; }
h2{ margin-top: 0; font-family: 'Share Tech Mono', monospace; color: #fff; text-transform: uppercase; letter-spacing: 3px; text-shadow: 0 0 10px #00f2ff; }
input, button{ padding: 10px; margin: 5px 0; font-family: 'Share Tech Mono', monospace; outline: none; }
input{ background: rgba(0, 0, 0, 0.6); border: 1px solid #00f2ff; color: #00f2ff; border-radius: 4px; width: 100%; box-sizing: border-box; }
button{ cursor: pointer; background: #00f2ff; color: #000; border: none; border-radius: 4px; font-weight: bold; transition: 0.3s; text-transform: uppercase; }
button:hover{ background: #39ff14; box-shadow: 0 0 15px #39ff14; }
table{ width: 100%; border-collapse: collapse; margin-top: 20px; background: rgba(0, 29, 61, 0.4); }
th, td{ padding: 12px; border-bottom: 1px solid rgba(0, 242, 255, 0.2); text-align: left; }
th{ color: #39ff14; text-transform: uppercase; border-bottom: 2px solid #00f2ff; }
#paginacion{ margin-top: 20px; text-align: center; }
#paginacion button{ margin: 3px; padding: 5px 12px; background: transparent; border: 1px solid #00f2ff; color: #00f2ff; }
#paginacion button.activa{ background: #00f2ff; color: #000; }
.breadcrumbs{ margin-bottom: 20px; font-size: 14px; display: flex; gap: 8px; font-family: 'Courier New', monospace; }
.breadcrumbs a{ text-decoration: none; color: #00f2ff; }
.breadcrumbs span{ color: #39ff14; }
.breadcrumbs .activo{ color: #fff; font-weight: bold; }
.modal{ display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.85); backdrop-filter: blur(5px); justify-content: center; align-items: center; z-index: 1000; }
.modal-contenido{ background: #001d3d; padding: 25px; border: 2px solid #00f2ff; border-radius: 10px; width: 100%; max-width: 400px; position: relative; }
.cerrar{ position: absolute; right: 15px; top: 10px; font-size: 22px; cursor: pointer; color: #39ff14; }
@media(max-width:768px){ table, thead, tbody, th, td, tr{ display: block; } thead{ display: none; } tr{ margin-bottom: 15px; background: rgba(0, 29, 61, 0.8); padding: 10px; border: 1px solid #00f2ff; } td{ display: flex; justify-content: space-between; border-bottom: 1px solid rgba(0, 242, 255, 0.1); } td::before{ content: attr(data-label); font-weight: bold; color: #00f2ff; } }
</style>
</head>

<body>

<nav class="breadcrumbs">
    <a href="<?= base_url() ?>">Inicio</a>
    <span>⛧</span>
    <a href="<?= base_url('usuarios') ?>">Usuarios</a>
    <span>⛧</span>
    <span class="activo">CRUD</span>
</nav>

<h2>CRUD Usuarios</h2>

<input type="text" id="buscar" placeholder="Buscar usuario..." style="width: auto;">
<button onclick="abrirModal()">+ Nuevo Usuario</button>

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

<div id="paginacion"></div>

<div id="modal" class="modal">
    <div class="modal-contenido">
        <span class="cerrar" onclick="cerrarModal()">&times;</span>
        <h3 id="tituloModal" style="color:#00f2ff; font-family:'Share Tech Mono'">Nuevo Usuario</h3>

        <form id="formUsuario">
            <input type="hidden" id="id" name="id">
            <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
            <input type="email" id="correo" name="correo" placeholder="Correo" required>
            <input type="password" id="password" name="password" placeholder="Contraseña (opcional)">
            <button type="submit" style="width:100%; margin-top:15px">Guardar Cambios</button>
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
        // USAMOS COMILLAS SIMPLES PARA LOS IDS EN LOS ONCLICK
        tabla.innerHTML += `
        <tr>
            <td data-label="Nombre">${u.nombre}</td>
            <td data-label="Correo">${u.correo}</td>
            <td data-label="Acciones">
                <button onclick="editar('${u.id}')">Editar</button>
                <button onclick="eliminar('${u.id}')" style="background:#ff0055; color:white;">Eliminar</button>
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
        paginacion.innerHTML += `<button onclick="cambiarPagina(${i})" class="${i===paginaActual?'activa':''}">${i}</button>`;
    }
}

function cambiarPagina(num){ paginaActual = num; mostrarPagina(); }

function abrirModal(){
    document.getElementById("tituloModal").innerText="Nuevo Usuario";
    form.reset();
    document.getElementById("id").value="";
    modal.style.display="flex";
}

function cerrarModal(){ modal.style.display="none"; }

/* EDITAR - FIX DEFINITIVO */
function editar(id){
    console.log("Editando ID:", id); // Verifica en consola que el ID llega bien
    fetch(`${BASE}/api/usuarios/${id}`)
    .then(res => res.json())
    .then(data => {
        console.log("Datos recibidos:", data); // Verifica qué campos trae tu API
        
        // Asegúrate que estos nombres coincidan con tu base de datos
        document.getElementById("id").value = data.id;
        document.getElementById("nombre").value = data.nombre || data.name || "";
        document.getElementById("correo").value = data.correo || data.email || "";
        document.getElementById("password").value = ""; 

        document.getElementById("tituloModal").innerText = "Editar Usuario";
        modal.style.display = "flex";
    })
    .catch(err => console.error("Error Fetch:", err));
}

form.addEventListener("submit",function(e){
    e.preventDefault();
    const id = document.getElementById("id").value;
    const formData = new FormData(form);
    let url = `${BASE}/api/usuarios`;

    if(id){
        url = `${BASE}/api/usuarios/${id}`;
        formData.append('_method','PUT'); // Para que CI4 lo reconozca como actualización
    }

    fetch(url,{ method:"POST", body:formData })
    .then(res=>res.json())
    .then(res=>{
        console.log("Respuesta guardado:", res);
        cerrarModal();
        cargarUsuarios();
    });
});

function eliminar(id){
    if(!confirm("¿Eliminar?")) return;
    fetch(`${BASE}/api/usuarios/${id}`,{ method:"DELETE" })
    .then(()=>cargarUsuarios());
}

buscar.addEventListener("keyup",function(){
    const texto=this.value.trim();
    if(texto===""){ cargarUsuarios(); return; }
    fetch(`${BASE}/api/usuarios/buscar?q=${texto}`)
    .then(res=>res.json())
    .then(data=>{ usuariosGlobal=data; paginaActual=1; mostrarPagina(); });
});

cargarUsuarios();
</script>
</body>
</html>