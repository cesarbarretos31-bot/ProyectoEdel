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
    /* VARIABLES DE LA SEGUNDA VISTA */
    :root {
        --primary-glow: #a000ff;
        --secondary-glow: #ff0055;
        --bg-color: #050505;
        --card-bg: rgba(20, 20, 20, 0.7);
    }

    body {
        min-height: 100vh;
        background-color: var(--bg-color);
        background-image: 
            radial-gradient(circle at 10% 20%, rgba(160, 0, 255, 0.1) 0%, transparent 40%),
            radial-gradient(circle at 90% 80%, rgba(255, 0, 85, 0.1) 0%, transparent 40%);
        font-family: 'Montserrat', sans-serif;
        color: #ffffff;
        margin: 0;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .bg-glow {
        position: fixed;
        width: 300px;
        height: 300px;
        background: var(--primary-glow);
        filter: blur(120px);
        border-radius: 50%;
        z-index: -1;
        opacity: 0.2;
        animation: move 15s infinite alternate;
    }

    @keyframes move {
        from { transform: translate(-50%, -50%); }
        to { transform: translate(50%, 50%); }
    }

    /* CONTENEDOR MAMALÓN */
    .main-card {
        background: var(--card-bg);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
        border-radius: 24px;
        padding: 40px;
        width: 100%;
        max-width: 900px;
        animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    h2 {
        font-weight: 800;
        font-size: 2.2rem;
        letter-spacing: 4px;
        background: linear-gradient(135deg, #fff 30%, var(--primary-glow) 70%, var(--secondary-glow));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-transform: uppercase;
        margin-bottom: 30px;
        text-align: center;
    }

    /* INPUTS ESTILO MORENSISTEM */
    input {
        background: rgba(255, 255, 255, 0.05) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: white !important;
        border-radius: 10px !important;
        padding: 12px !important;
        margin-bottom: 10px !important;
        width: 100%;
        transition: 0.3s;
    }

    input:focus {
        outline: none;
        border-color: var(--primary-glow) !important;
        box-shadow: 0 0 10px rgba(160, 0, 255, 0.3);
    }

    /* BOTONES */
    button {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        color: white;
        border-radius: 12px;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.4s;
        cursor: pointer;
    }

    button:hover {
        background: rgba(160, 0, 255, 0.2);
        border-color: var(--primary-glow);
        transform: translateY(-2px);
    }

    button[type="submit"] {
        background: linear-gradient(90deg, var(--primary-glow), var(--secondary-glow));
        border: none;
        width: 100%;
        margin-top: 10px;
    }

    /* TABLA */
    table {
        width: 100%;
        margin-top: 30px;
        border-collapse: separate;
        border-spacing: 0 8px;
    }

    th {
        color: #888;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 2px;
        padding: 10px;
    }

    td {
        background: rgba(255, 255, 255, 0.03);
        padding: 15px;
    }

    tr td:first-child { border-radius: 12px 0 0 12px; }
    tr td:last-child { border-radius: 0 12px 12px 0; }

    /* PAGINACIÓN */
    #paginacion button.activa {
        background: var(--primary-glow);
        box-shadow: 0 0 15px rgba(160, 0, 255, 0.4);
    }

    /* BREADCRUMBS */
    .breadcrumbs a { color: var(--primary-glow); text-decoration: none; font-weight: 600; }
    .breadcrumbs span { color: #555; margin: 0 5px; }
    .breadcrumbs .activo { color: #fff; }

    @media(max-width:768px){
        table, thead, tbody, th, td, tr{ display:block; }
        thead{ display:none; }
        tr{ margin-bottom:15px; background: rgba(255,255,255,0.03); padding:10px; border-radius: 12px; }
        td{ display:flex; justify-content:space-between; border: none; }
        td::before{ content:attr(data-label); font-weight:bold; color: var(--primary-glow); }
    }
</style>
</head>

<body>
    <div class="bg-glow"></div>

    <div class="main-card">
        <nav class="breadcrumbs">
            <a href="<?= base_url() ?>">Inicio</a>
            <span>›</span>
            <a href="<?= base_url('usuarios') ?>">Usuarios</a>
            <span>›</span>
            <span class="activo">CRUD</span>
        </nav>

        <h2>CRUD Usuarios</h2>

        <input type="text" id="buscar" placeholder=" Buscar usuario...">

        <form id="formUsuario">
            <input type="hidden" id="id" name="id">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
                </div>
                <div class="col-md-4">
                    <input type="email" id="correo" name="correo" placeholder="Correo" required>
                </div>
                <div class="col-md-4">
                    <input type="password" id="password" name="password" placeholder="Contraseña">
                </div>
            </div>
            <button type="submit">GUARDAR REGISTRO</button>
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
/* TU LÓGICA ORIGINAL - NO TOCADA 
   He verificado que todos los IDs (buscar, formUsuario, id, nombre, correo, password, tablaUsuarios, paginacion) 
   coincidan exactamente con tu script original.
*/
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
                <button onclick="editar(${u.id})">Editar</button>
                <button onclick="eliminar(${u.id})">Eliminar</button>
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
        document.getElementById("id").value = ""; // Limpiar id manual por seguridad
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