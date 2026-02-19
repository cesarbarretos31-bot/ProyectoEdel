<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>CRUD Usuarios</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
body{
    background:#111;
    color:#fff;
    font-family:Arial;
    padding:20px;
}

input,button{
    padding:8px;
    margin:5px 0;
}

button{
    cursor:pointer;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

th,td{
    padding:10px;
    border-bottom:1px solid #333;
}

#paginacion{
    margin-top:20px;
    text-align:center;
}

#paginacion button{
    margin:3px;
    padding:5px 10px;
}

#paginacion button.activa{
    background:#6a00af;
    color:#fff;
}

#paginacion button:disabled{
    opacity:0.4;
}

@media(max-width:768px){
    table, thead, tbody, th, td, tr{
        display:block;
    }
    thead{ display:none; }
    tr{
        margin-bottom:15px;
        background:#1a1a1a;
        padding:10px;
    }
    td{
        display:flex;
        justify-content:space-between;
    }
    td::before{
        content:attr(data-label);
        font-weight:bold;
    }
}
</style>
</head>

<body>

<h2>CRUD Usuarios</h2>

<input type="text" id="buscar" placeholder="Buscar usuario...">

<form id="formUsuario">
    <input type="hidden" id="id" name="id">
    <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
    <input type="email" id="correo" name="correo" placeholder="Correo" required>
    <input type="password" id="password" name="password" placeholder="Contraseña">
    <button type="submit">Guardar</button>
</form>

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

<script>

const BASE = "<?= base_url() ?>";

const tabla = document.getElementById("tablaUsuarios");
const form = document.getElementById("formUsuario");
const buscar = document.getElementById("buscar");
const paginacion = document.getElementById("paginacion");

let usuariosGlobal = [];
let paginaActual = 1;
const registrosPorPagina = 5;


// ==================== CARGAR ====================
function cargarUsuarios(){
    fetch(`${BASE}/api/usuarios`)
    .then(res=>res.json())
    .then(data=>{
        usuariosGlobal = data;
        paginaActual = 1;
        mostrarPagina();
    });
}


// ==================== MOSTRAR PAGINA ====================
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
                <button onclick="editar(${u.id})">Editar</button>
                <button onclick="eliminar(${u.id})">Eliminar</button>
            </td>
        </tr>
        `;
    });

    generarPaginacion();
}


// ==================== PAGINACION ====================
function generarPaginacion(){

    paginacion.innerHTML="";
    const total = Math.ceil(usuariosGlobal.length/registrosPorPagina);
    if(total<=1) return;

    // <<
    paginacion.innerHTML += `
    <button onclick="cambiarPagina(1)" ${paginaActual===1?'disabled':''}>
    &laquo;&laquo;
    </button>`;

    // <
    paginacion.innerHTML += `
    <button onclick="cambiarPagina(${paginaActual-1})" ${paginaActual===1?'disabled':''}>
    &laquo;
    </button>`;

    for(let i=1;i<=total;i++){
        paginacion.innerHTML += `
        <button onclick="cambiarPagina(${i})"
        class="${i===paginaActual?'activa':''}">
        ${i}
        </button>`;
    }

    // >
    paginacion.innerHTML += `
    <button onclick="cambiarPagina(${paginaActual+1})"
    ${paginaActual===total?'disabled':''}>
    &raquo;
    </button>`;

    // >>
    paginacion.innerHTML += `
    <button onclick="cambiarPagina(${total})"
    ${paginaActual===total?'disabled':''}>
    &raquo;&raquo;
    </button>`;
}


function cambiarPagina(num){
    const total = Math.ceil(usuariosGlobal.length/registrosPorPagina);
    if(num<1 || num>total) return;
    paginaActual = num;
    mostrarPagina();
}


// ==================== GUARDAR / ACTUALIZAR ====================
form.addEventListener("submit",function(e){
    e.preventDefault();

    const id = document.getElementById("id").value;
    const formData = new FormData(form);

    let url = `${BASE}/api/usuarios`;

    if(id){
        url = `${BASE}/api/usuarios/${id}`;
        formData.append('_method','PUT'); // IMPORTANTE
    }

    fetch(url,{
        method:"POST",
        body:formData
    })
    .then(res=>res.json())
    .then(()=>{
        form.reset();
        cargarUsuarios();
    });
});


// ==================== EDITAR ====================
function editar(id){
    fetch(`${BASE}/api/usuarios/${id}`)
    .then(res=>res.json())
    .then(data=>{
        document.getElementById("id").value = data.id;
        document.getElementById("nombre").value = data.nombre;
        document.getElementById("correo").value = data.correo;
    });
}


// ==================== ELIMINAR ====================
function eliminar(id){
    if(!confirm("¿Eliminar usuario?")) return;

    fetch(`${BASE}/api/usuarios/${id}`,{
        method:"DELETE"
    })
    .then(res=>res.json())
    .then(()=>cargarUsuarios());
}


// ==================== BUSCAR ====================
buscar.addEventListener("keyup",function(){
    const texto = this.value.trim();

    if(texto===""){
        cargarUsuarios();
        return;
    }

    fetch(`${BASE}/api/usuarios/buscar?q=${texto}`)
    .then(res=>res.json())
    .then(data=>{
        usuariosGlobal = data;
        paginaActual = 1;
        mostrarPagina();
    });
});


// ==================== INICIAR ====================
cargarUsuarios();

</script>

</body>
</html>
