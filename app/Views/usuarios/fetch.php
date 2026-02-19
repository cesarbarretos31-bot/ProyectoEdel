<!DOCTYPE html>
<html lang="es">
<head>
    <title>CRUD Usuarios - Elite Interface</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&family=JetBrains+Mono&display=swap" rel="stylesheet">

<style>
body { 
    background: radial-gradient(circle at top, #1a0b2e 0%, #000000 100%);
    color: #e0e0e0;
    font-family: 'Montserrat', sans-serif; 
    padding: 40px 20px; 
    margin: 0;
}

h2 {
    letter-spacing: 5px;
    text-transform: uppercase;
}

input {
    background: rgba(20,20,20,0.8);
    border: 1px solid #333;
    padding: 12px;
    border-radius: 8px;
    color: #fff;
    margin: 5px 0;
}

button {
    background: linear-gradient(135deg, #a000ff, #6a00af);
    color: white;
    padding: 10px 18px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

button:hover { filter: brightness(1.2); }

.table-container {
    margin-top: 30px;
    background: rgba(10,10,10,0.6);
    padding: 20px;
    border-radius: 15px;
}

table { width: 100%; border-collapse: collapse; }

th, td { padding: 14px; text-align: left; }

th { color: #ff0050; }

tr:hover { background: rgba(160,0,255,0.05); }

.breadcrumbs {
    margin-bottom: 20px;
}

#paginacion {
    margin-top: 20px;
    text-align: center;
}

#paginacion button {
    margin: 3px;
    padding: 6px 12px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.2);
}

#paginacion button.activa {
    background: linear-gradient(135deg, #a000ff, #6a00af);
}

#paginacion button:disabled {
    opacity: 0.3;
    cursor: not-allowed;
}

/* RESPONSIVE */
@media (max-width:768px){

    table, thead, tbody, th, td, tr {
        display:block;
        width:100%;
    }

    thead { display:none; }

    tr {
        margin-bottom:15px;
        background:rgba(255,255,255,0.03);
        padding:15px;
        border-radius:12px;
    }

    td {
        display:flex;
        justify-content:space-between;
        padding:8px 0;
    }

    td::before {
        content:attr(data-label);
        font-weight:bold;
        color:#ff0050;
    }

    td:last-child {
        flex-direction:column;
        gap:8px;
    }

    td:last-child button { width:100%; }
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

<div id="paginacion"></div>

</div>

<script>
const BASE = "<?= base_url() ?>";

const tabla = document.getElementById('tablaUsuarios');
const form = document.getElementById('formUsuario');
const buscarInput = document.getElementById('buscar');
const estado = document.getElementById('estadoBusqueda');
const paginacion = document.getElementById('paginacion');

let usuariosGlobal = [];
let paginaActual = 1;
const registrosPorPagina = 5;


// CARGAR USUARIOS
function cargarUsuarios(){
    fetch(`${BASE}/api/usuarios`)
    .then(res => res.json())
    .then(data=>{
        usuariosGlobal = data;
        paginaActual = 1;
        mostrarPagina();
    });
}


// MOSTRAR PAGINA
function mostrarPagina(){
    tabla.innerHTML='';

    const inicio = (paginaActual-1)*registrosPorPagina;
    const fin = inicio + registrosPorPagina;

    const datos = usuariosGlobal.slice(inicio,fin);

    datos.forEach(usuario=>{
        tabla.innerHTML+=`
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

    generarBotones();
}


// GENERAR PAGINACION
function generarBotones(){

    paginacion.innerHTML='';
    const totalPaginas = Math.ceil(usuariosGlobal.length / registrosPorPagina);
    if(totalPaginas<=1) return;

    // <<
    paginacion.innerHTML+=`
    <button onclick="cambiarPagina(1)" ${paginaActual===1?'disabled':''}>
    &laquo;&laquo;
    </button>`;

    // <
    paginacion.innerHTML+=`
    <button onclick="cambiarPagina(${paginaActual-1})" ${paginaActual===1?'disabled':''}>
    &laquo;
    </button>`;

    // numeros
    for(let i=1;i<=totalPaginas;i++){
        paginacion.innerHTML+=`
        <button onclick="cambiarPagina(${i})"
        class="${i===paginaActual?'activa':''}">
        ${i}
        </button>`;
    }

    // >
    paginacion.innerHTML+=`
    <button onclick="cambiarPagina(${paginaActual+1})"
    ${paginaActual===totalPaginas?'disabled':''}>
    &raquo;
    </button>`;

    // >>
    paginacion.innerHTML+=`
    <button onclick="cambiarPagina(${totalPaginas})"
    ${paginaActual===totalPaginas?'disabled':''}>
    &raquo;&raquo;
    </button>`;
}


// CAMBIAR PAGINA
function cambiarPagina(num){
    const totalPaginas = Math.ceil(usuariosGlobal.length / registrosPorPagina);
    if(num<1 || num>totalPaginas) return;
    paginaActual=num;
    mostrarPagina();
}


// GUARDAR
form.addEventListener('submit',e=>{
    e.preventDefault();
    const id=document.getElementById('id').value;
    const url=id?`${BASE}/api/usuarios/${id}`:`${BASE}/api/usuarios`;
    const formData=new FormData(form);

    fetch(url,{method:'POST',body:formData})
    .then(res=>res.json())
    .then(()=>{
        form.reset();
        cargarUsuarios();
    });
});


// EDITAR
function editar(id){
    fetch(`${BASE}/api/usuarios/${id}`)
    .then(res=>res.json())
    .then(data=>{
        document.getElementById('id').value=data.id;
        document.getElementById('nombre').value=data.nombre;
        document.getElementById('correo').value=data.correo;
    });
}


// ELIMINAR
function eliminar(id){
    if(!confirm("¿Eliminar usuario?")) return;
    fetch(`${BASE}/api/usuarios/${id}`,{method:'DELETE'})
    .then(res=>res.json())
    .then(()=>cargarUsuarios());
}


// BUSCAR
buscarInput.addEventListener('keyup',function(){
    const texto=this.value.trim();
    if(texto==='') return cargarUsuarios();

    fetch(`${BASE}/api/usuarios/buscar?q=${texto}`)
    .then(res=>res.json())
    .then(data=>{
        usuariosGlobal=data;
        paginaActual=1;
        mostrarPagina();
    });
});


// BREADCRUMB
function generarBreadcrumbs(){
    document.getElementById('breadcrumbs').innerHTML=
    `<a href="${BASE}">Inicio</a> › <span>Usuarios</span>`;
}

generarBreadcrumbs();
cargarUsuarios();
</script>

</body>
</html>
