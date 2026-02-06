<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>
</head>
<body>

<h2>Registro de Usuarios</h2>

<form id="formUsuario">
    <input type="hidden" id="usuario_id">

    <input type="text" id="nombre" placeholder="Nombre" required>
    <input type="email" id="correo" placeholder="Correo" required>
    <input type="password" id="password" placeholder="Password">

    <button type="submit">Guardar</button>
</form>

<hr>

<h3>Lista de usuarios</h3>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody id="tablaUsuarios"></tbody>
</table>

<script src="/js/usuarios.js"></script>
</body>
</html>
