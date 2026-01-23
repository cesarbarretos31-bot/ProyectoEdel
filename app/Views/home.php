<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página Principal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 50px;
        }
        h1 {
            text-align: center;
        }
        .btn-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
        }
        a.button {
            display: inline-block;
            padding: 15px 25px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.3s;
        }
        a.button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Mi Página de Inicio</h1>

    <div class="btn-container">
        <a class="button" href="<?= site_url('usuario/prueba') ?>">Usuario Prueba</a>
        <a class="button" href="<?= site_url('testdb') ?>">Test DB</a>
        <a class="button" href="<?= site_url('carrusel') ?>">Carrusel</a>
        <a class="button" href="<?= site_url('carrusel/nuevo') ?>">Nuevo Carrusel</a>
        <a class="button" href="<?= site_url('formulario') ?>">Formulario</a>
        <a class="button" href="<?= site_url('registro') ?>">Registro</a>
    </div>
</body>
</html>
