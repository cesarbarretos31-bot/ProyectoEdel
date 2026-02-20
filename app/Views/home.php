<?php
$uri = service('uri')->getPath();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terminal de Validación | MORENSISTEM</title>

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
        min-height: 100vh;
        padding-bottom: 50px;
    }

    /* ===============================
       BREADCRUMB EMO (COMO LAS TIENES)
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
        color: #444; /* Tu color de separador original */
        font-weight: bold;
    }

    @keyframes emoIn {
        from { opacity: 0; transform: translateY(-8px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ===============================
       CARD STYLE (COMO LAS TIENES)
    ================================ */
    .emo-card {
        background: #0e0e0e;
        border: 1px solid #2c2c2c;
        box-shadow: 0 0 30px rgba(160, 0, 255, 0.15);
        border-radius: 14px;
        overflow: hidden;
    }

    .emo-header {
        background: linear-gradient(135deg, #4b006e, #1a001f);
        border-bottom: 1px solid #32003f;
        text-align: center;
        letter-spacing: 2px;
        padding: 15px;
    }

    label {
        color: #bfbfbf;
        font-size: 0.85rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 5px;
        display: block;
    }

    .form-control {
        background: #121212;
        border: 1px solid #333;
        color: #fff;
        border-radius: 8px;
    }

    .form-control:focus {
        background: #151515;
        border-color: #a000ff;
        box-shadow: 0 0 0 0.15rem rgba(160, 0, 255, 0.25);
        color: #fff;
    }

    .btn-emo {
        background: linear-gradient(135deg, #a000ff, #4b006e);
        border: none;
        color: #fff;
        letter-spacing: 1px;
        transition: .3s;
        padding: 12px;
        font-weight: 600;
    }

    .btn-emo:hover {
        background: linear-gradient(135deg, #ff0055, #70002f);
        transform: translateY(-1px);
        color: #fff;
    }

    .btn-cancel {
        background: transparent;
        border: 1px solid #555;
        color: #aaa;
        padding: 10px;
        text-decoration: none;
        text-align: center;
        border-radius: 6px;
        transition: .3s;
    }

    .btn-cancel:hover {
        background: #222;
        color: #fff;
    }

    .alert {
        background: #1a001f;
        border: 1px solid #4b006e;
        color: #ff9bff;
        border-radius: 10px;
    }
    </style>
</head>

<body>

<div class="container mt-5">

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

    <div class="card emo-card mx-auto" style="max-width:520px;">
        <div class="emo-header text-white">
            <h4>TERMINAL DE DATOS</h4>
        </div>

        <div class="card-body p-4">

            <?php if (session()->has('errors')): ?>
                <div class="alert">
                    <ul class="mb-0">
                        <?php foreach (session('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>

            <form action="<?= site_url('formulario/procesar') ?>" method="post">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label>NOMBRE COMPLETO</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <div class="row">
                    <div class="col-md-7 mb-3">
                        <label>CORREO ELECTRÓNICO</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label>EDAD</label>
                        <input type="number" name="edad" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label>PRECIO / CRÉDITOS</label>
                    <input type="text" name="precio" class="form-control" placeholder="0.00" required>
                </div>

                <div class="mb-4">
                    <label>CÓDIGO DE ACCESO</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-emo">
                        VALIDAR INFORMACIÓN
                    </button>

                    <a href="<?= site_url('/') ?>" class="btn btn-cancel">
                        CANCELAR
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>

</body>
</html>