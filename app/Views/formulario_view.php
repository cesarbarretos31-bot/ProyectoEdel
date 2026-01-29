<?php
$uri = service('uri')->getPath();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?= view('partials/breadcrumbs') ?>

<meta charset="UTF-8">
<title>Formulario Validado</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;600&display=swap" rel="stylesheet">

<style>
/* ===============================
   BASE DARK EMO
================================ */
body {
    background: radial-gradient(circle at top, #1b1b1b, #000);
    font-family: 'Montserrat', sans-serif;
    color: #e0e0e0;
}

/* ===============================
   BREADCRUMB EMO (UNA SOLA CLASE)
================================ */
.emo-breadcrumb {
    margin-bottom: 35px;
    animation: emoIn .6s ease;
}

.emo-breadcrumb ol {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    background: linear-gradient(145deg, #0b0b0b, #141414);
    padding: 14px 22px;
    border-radius: 14px;
    box-shadow: 0 0 25px rgba(160,0,255,.35);
    font-family: 'Courier New', monospace;
    list-style: none;
}

.emo-breadcrumb a {
    color: #c77dff;
    text-decoration: none;
    text-transform: uppercase;
    font-size: 13px;
    position: relative;
}

.emo-breadcrumb a::after {
    content: '';
    position: absolute;
    bottom: -4px;
    left: 0;
    width: 0;
    height: 2px;
    background: #c77dff;
    transition: .3s;
}

.emo-breadcrumb a:hover::after {
    width: 100%;
}

.emo-breadcrumb .active {
    color: #fff;
    letter-spacing: 1px;
    text-shadow: 0 0 6px rgba(255,255,255,.4);
}

.emo-breadcrumb .sep {
    color: #444;
}

@keyframes emoIn {
    from { opacity: 0; transform: translateY(-8px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ===============================
   CARD FORM
================================ */
.emo-card {
    background: #0e0e0e;
    border: 1px solid #2c2c2c;
    box-shadow: 0 0 30px rgba(160, 0, 255, 0.15);
    border-radius: 14px;
}

.emo-header {
    background: linear-gradient(135deg, #4b006e, #1a001f);
    text-align: center;
    letter-spacing: 2px;
}

label {
    font-size: 0.8rem;
    letter-spacing: 1px;
    color: #bbb;
}

.form-control {
    background: #121212;
    border: 1px solid #333;
    color: #fff;
}

.form-control:focus {
    border-color: #a000ff;
    box-shadow: 0 0 0 0.15rem rgba(160, 0, 255, 0.3);
}

.btn-emo {
    background: linear-gradient(135deg, #a000ff, #4b006e);
    border: none;
    color: #fff;
    letter-spacing: 1px;
}

.alert {
    background: #1a001f;
    border: 1px solid #4b006e;
    color: #ff9bff;
}
</style>
</head>

<body>

<div class="container mt-5">

<!-- ===============================
     BREADCRUMB FUNCIONAL
================================ -->
<nav class="emo-breadcrumb">
<ol>

<li>
    <a href="<?= site_url('/') ?>">Inicio</a>
</li>

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

<!-- ===============================
     FORM CARD
================================ -->
<div class="card emo-card mx-auto" style="max-width:600px">

<div class="card-header emo-header">
    <h4>FORMULARIO VALIDADO</h4>
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
<div class="alert"><?= session('success') ?></div>
<?php endif ?>

<form method="post" action="<?= site_url('formulario/procesar') ?>">
<?= csrf_field() ?>

<div class="mb-3">
<label>NOMBRE</label>
<input type="text" name="nombre" class="form-control" required>
</div>

<div class="mb-3">
<label>CORREO</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>EDAD</label>
<input type="number" name="edad" class="form-control" min="18" max="99" required>
</div>

<div class="mb-3">
<label>PRECIO</label>
<input type="text" name="precio" class="form-control" required>
</div>

<div class="mb-3">
<label>FECHA NACIMIENTO</label>
<input type="date" name="fecha" class="form-control" required>
</div>

<div class="mb-4">
<label>CONTRASEÑA</label>
<input type="password" name="password" class="form-control" minlength="8" required>
</div>

<button class="btn btn-emo w-100">VALIDAR DATOS</button>
</form>

</div>
</div>
</div>

</body>
</html>
