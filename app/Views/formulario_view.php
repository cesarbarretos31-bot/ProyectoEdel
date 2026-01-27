<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Formulario Validado</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;600&display=swap" rel="stylesheet">

<style>
body {
    background: radial-gradient(circle at top, #1b1b1b, #000);
    font-family: 'Montserrat', sans-serif;
    color: #e0e0e0;
}

.emo-card {
    background: #0e0e0e;
    border: 1px solid #2c2c2c;
    box-shadow: 0 0 30px rgba(160, 0, 255, 0.15);
    border-radius: 14px;
}

.emo-header {
    background: linear-gradient(135deg, #4b006e, #1a001f);
    text-align: center;
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

<form id="formulario" method="post" action="<?= site_url('formulario/procesar') ?>">
<?= csrf_field() ?>

<div class="mb-3">
<label>NOMBRE</label>
<input type="text" name="nombre" class="form-control" required pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]{3,}">
</div>

<div class="mb-3">
<label>CORREO</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>EDAD (18-99)</label>
<input type="number" name="edad" class="form-control" min="18" max="99" required>
</div>

<div class="mb-3">
<label>PRECIO</label>
<input type="text" name="precio" class="form-control" pattern="^\d+(\.\d{1,2})?$" required>
</div>

<div class="mb-3">
<label>FECHA DE NACIMIENTO</label>
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
