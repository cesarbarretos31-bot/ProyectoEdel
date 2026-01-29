<?php
$uri = service('uri')->getPath();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?= view('partials/breadcrumbs') ?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Subir Imagen</title>



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
   BREADCRUMB EMO
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
   CARD UPLOAD
================================ */
.emo-card {
    background: #0e0e0e;
    border: 1px solid #2c2c2c;
    box-shadow: 0 0 30px rgba(160, 0, 255, 0.15);
    border-radius: 14px;
}

.emo-header {
    background: linear-gradient(135deg, #4b006e, #1a001f);
    border-bottom: 1px solid #32003f;
    text-align: center;
    letter-spacing: 2px;
}

label {
    color: #bfbfbf;
    font-size: 0.85rem;
    letter-spacing: 1px;
}

.form-control {
    background: #121212;
    border: 1px solid #333;
    color: #fff;
}

.form-control:focus {
    border-color: #a000ff;
    box-shadow: 0 0 0 0.15rem rgba(160, 0, 255, 0.25);
}

.btn-emo {
    background: linear-gradient(135deg, #a000ff, #4b006e);
    border: none;
    color: #fff;
    letter-spacing: 1px;
    transition: .3s;
}

.btn-emo:hover {
    background: linear-gradient(135deg, #ff0055, #70002f);
    transform: translateY(-1px);
}

.btn-cancel {
    background: transparent;
    border: 1px solid #555;
    color: #aaa;
}

.btn-cancel:hover {
    background: #222;
    color: #fff;
}

.alert {
    background: #1a001f;
    border: 1px solid #4b006e;
    color: #ff9bff;
}

input[type="file"]::file-selector-button {
    background: #4b006e;
    border: none;
    color: #fff;
    padding: 6px 14px;
    margin-right: 10px;
}

input[type="file"]::file-selector-button:hover {
    background: #a000ff;
}
</style>
</head>

<body>

<div class="container mt-5">

<!-- ===============================
     BREADCRUMB
================================ -->
<nav class="emo-breadcrumb">
<ol>

<li>
    <a href="<?= site_url('/') ?>">Inicio</a>
</li>

<?php if ($uri === 'carrusel/nuevo'): ?>
    <li class="sep">⛧</li>
    <li><a href="<?= site_url('carrusel') ?>">Carrusel</a></li>
    <li class="sep">⛧</li>
    <li class="active">Nuevo</li>

<?php elseif ($uri === 'carrusel'): ?>
    <li class="sep">⛧</li>
    <li class="active">Carrusel</li>

<?php elseif ($uri === 'formulario'): ?>
    <li class="sep">⛧</li>
    <li class="active">Formulario</li>

<?php elseif ($uri === 'registro'): ?>
    <li class="sep">⛧</li>
    <li class="active">Registro</li>
<?php endif; ?>

</ol>
</nav>

<!-- ===============================
     CARD UPLOAD
================================ -->
<div class="card emo-card mx-auto" style="max-width:520px;">

<div class="card-header emo-header text-white">
    <h4>SUBIR IMAGEN</h4>
</div>

<div class="card-body">

<?php if (session()->has('errors')): ?>
<div class="alert">
<ul class="mb-0">
<?php foreach (session('errors') as $error): ?>
    <li><?= esc($error) ?></li>
<?php endforeach ?>
</ul>
</div>
<?php endif ?>

<?php if (session()->has('error')): ?>
<div class="alert"><?= session('error') ?></div>
<?php endif ?>

<form action="<?= site_url('carrusel/guardar') ?>" method="post" enctype="multipart/form-data">
<?= csrf_field() ?>

<div class="mb-3">
    <label>TÍTULO</label>
    <input type="text" name="titulo" class="form-control" required>
</div>

<div class="mb-3">
    <label>DESCRIPCIÓN</label>
    <textarea name="descripcion" class="form-control" rows="3"></textarea>
</div>

<div class="mb-4">
    <label>IMAGEN</label>
    <input type="file" name="imagen" class="form-control" required accept="image/*">
</div>

<div class="d-grid gap-2">
    <button type="submit" class="btn btn-emo">
        SUBIR AL CARRUSEL
    </button>

    <a href="<?= site_url('carrusel') ?>" class="btn btn-cancel">
        CANCELAR
    </a>
</div>

</form>

</div>
</div>
</div>

</body>
</html>
