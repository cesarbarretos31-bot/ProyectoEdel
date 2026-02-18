<?php
$uri = service('uri')->getPath();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?= view('partials/breadcrumbs') ?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Formulario Validado</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">

<style>
/* ===============================
    BASE DARK EMO - REFINADO
================================ */
body {
    background: radial-gradient(circle at center, #1a0b2e 0%, #0a0a0a 100%);
    font-family: 'Montserrat', sans-serif;
    color: #e0e0e0;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

/* ===============================
    BREADCRUMB - ESTILO NEÓN DISCRETO
================================ */
.emo-breadcrumb {
    margin-bottom: 40px;
    animation: emoFadeIn .8s ease-out;
}

.emo-breadcrumb ol {
    display: flex;
    align-items: center;
    gap: 12px;
    background: rgba(15, 15, 15, 0.8);
    backdrop-filter: blur(10px);
    padding: 12px 25px;
    border-radius: 50px; /* Bordes más orgánicos */
    border: 1px solid rgba(160, 0, 255, 0.2);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
    list-style: none;
}

.emo-breadcrumb a {
    color: #c77dff;
    text-decoration: none;
    text-transform: uppercase;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 1.5px;
    transition: all 0.3s ease;
}

.emo-breadcrumb a:hover {
    color: #fff;
    text-shadow: 0 0 10px #a000ff;
}

.emo-breadcrumb .active {
    color: #fff;
    font-size: 11px;
    font-weight: 300;
    letter-spacing: 1.5px;
    opacity: 0.7;
}

.emo-breadcrumb .sep {
    color: #555;
    font-size: 10px;
}

/* ===============================
    CARD FORM - PREMIUM LOOK
================================ */
.emo-card {
    background: rgba(18, 18, 18, 0.95);
    border: 1px solid rgba(255, 255, 255, 0.05);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.8), 
                0 0 20px rgba(160, 0, 255, 0.1);
    border-radius: 20px;
    overflow: hidden; /* Para que el header respete los bordes */
    transition: transform 0.3s ease;
}

.emo-header {
    background: linear-gradient(135deg, #4b006e 0%, #1a001f 100%);
    padding: 25px;
    border-bottom: 1px solid rgba(160, 0, 255, 0.3);
}

.emo-header h4 {
    margin: 0;
    font-weight: 600;
    font-size: 1.2rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}

.card-body {
    padding: 40px;
}

/* INPUTS */
label {
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 2px;
    color: #888;
    margin-bottom: 8px;
    display: block;
    transition: color 0.3s;
}

.form-control {
    background: #0a0a0a;
    border: 1px solid #2a2a2a;
    color: #fff;
    padding: 12px 15px;
    border-radius: 10px;
    font-weight: 300;
    transition: all 0.3s ease;
}

.form-control:focus {
    background: #111;
    border-color: #a000ff;
    box-shadow: 0 0 15px rgba(160, 0, 255, 0.2);
    color: #fff;
}

.form-control:focus + label {
    color: #a000ff;
}

/* BOTÓN PROFESIONAL */
.btn-emo {
    background: linear-gradient(135deg, #a000ff 0%, #6a00af 100%);
    border: none;
    border-radius: 10px;
    padding: 14px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 2px;
    transition: all 0.4s ease;
    box-shadow: 0 4px 15px rgba(160, 0, 255, 0.3);
    margin-top: 10px;
}

.btn-emo:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(160, 0, 255, 0.5);
    background: linear-gradient(135deg, #b026ff 0%, #7b00cc 100%);
}

/* ALERTAS REFINADAS */
.alert {
    background: rgba(75, 0, 110, 0.1);
    border: 1px solid rgba(160, 0, 255, 0.3);
    border-radius: 12px;
    color: #e0aaff;
    font-size: 0.9rem;
    backdrop-filter: blur(5px);
}

@keyframes emoFadeIn {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}

</style>
</head>

<body>

<div class="container mt-5 mb-5">

    <nav class="emo-breadcrumb d-flex justify-content-center">
        <ol>
            <li><a href="<?= site_url('/') ?>">Inicio</a></li>

            <?php if ($uri === 'formulario'): ?>
                <li class="sep">⛧</li>
                <li class="active">Formulario</li>
            <?php elseif ($uri === 'registro'): ?>
                <li class="sep">⛧</li>
                <li><a href="<?= site_url('formulario') ?>">Formulario</a></li>
                <li class="sep">⛧</li>
                <li class="active">Registro</li>
            <?php elseif ($uri === 'carrusel'): ?>
                <li class="sep">⛧</li>
                <li class="active">Carrusel</li>
            <?php elseif ($uri === 'carrusel/nuevo'): ?>
                <li class="sep">⛧</li>
                <li><a href="<?= site_url('carrusel') ?>">Carrusel</a></li>
                <li class="sep">⛧</li>
                <li class="active">Nuevo</li>
            <?php endif; ?>
        </ol>
    </nav>

    <div class="card emo-card mx-auto" style="max-width:550px">
        <div class="card-header emo-header text-center">
            <h4>FORMULARIO</h4>
        </div>

        <div class="card-body">
            <?php if (session()->has('errors')): ?>
                <div class="alert">
                    <ul class="mb-0">
                        <?php foreach (session('errors') as $e): ?>
                            <li><?= esc($e) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>

            <?php if (session()->has('success')): ?>
                <div class="alert text-center"><?= session('success') ?></div>
            <?php endif ?>

            <form method="post" action="<?= site_url('formulario/procesar') ?>">
                <?= csrf_field() ?>

                <div class="mb-4">
                    <label>NOMBRE COMPLETO</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Ej. John Doe" required>
                </div>

                <div class="row">
                    <div class="col-md-8 mb-4">
                        <label>CORREO ELECTRÓNICO</label>
                        <input type="email" name="email" class="form-control" placeholder="nombre@ejemplo.com" required>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label>EDAD</label>
                        <input type="number" name="edad" class="form-control" min="18" max="99" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label>PRECIO</label>
                        <input type="text" name="precio" class="form-control" placeholder="$ 0.00" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label>FECHA NACIMIENTO</label>
                        <input type="date" name="fecha" class="form-control" required>
                    </div>
                </div>

                <div class="mb-5">
                    <label>CONTRASEÑA</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" minlength="8" required>
                </div>

                <button class="btn btn-emo w-100 py-3">
                    FINALIZAR REGISTRO
                </button>
            </form>
        </div>
    </div>
</div>

</body>
</html>