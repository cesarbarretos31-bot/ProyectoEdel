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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;800&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-glow: #a000ff;
            --secondary-glow: #ff0055;
            --dark-bg: #050505;
            --glass-card: rgba(15, 15, 15, 0.85);
        }

        body {
            background-color: var(--dark-bg);
            background-image: 
                radial-gradient(circle at 20% 30%, rgba(160, 0, 255, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(255, 0, 85, 0.05) 0%, transparent 50%);
            font-family: 'Montserrat', sans-serif;
            color: #e0e0e0;
            min-height: 100vh;
            padding-bottom: 50px;
        }

        /* ===============================
           BREADCRUMB (VITAL IMPORTANCE)
        ================================ */
        .emo-breadcrumb {
            margin: 30px 0;
            animation: fadeInDown 0.8s ease;
        }

        .emo-breadcrumb ol {
            display: inline-flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            padding: 12px 25px;
            border-radius: 50px;
            border: 1px solid rgba(160, 0, 255, 0.3);
            list-style: none;
            gap: 5px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .emo-breadcrumb a {
            color: #888;
            text-decoration: none;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s;
        }

        .emo-breadcrumb a:hover { 
            color: var(--primary-glow);
            text-shadow: 0 0 8px var(--primary-glow);
        }

        /* Tu estrella ⛧ con estilo Neón */
        .emo-breadcrumb .sep { 
            margin: 0 10px;
            color: var(--secondary-glow); 
            font-size: 1.1rem; 
            text-shadow: 0 0 8px var(--secondary-glow);
        }

        .emo-breadcrumb .active {
            color: #fff;
            font-family: 'Share Tech Mono', monospace;
            background: rgba(160, 0, 255, 0.15);
            padding: 2px 12px;
            border-radius: 4px;
            text-shadow: 0 0 10px var(--primary-glow);
        }

        /* -------- CARD DE FORMULARIO -------- */
        .emo-card {
            background: var(--glass-card);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.6);
            overflow: hidden;
            animation: fadeInUp 0.8s ease;
        }

        .emo-header {
            background: linear-gradient(90deg, #1a002e, #2e001a);
            padding: 25px;
            border-bottom: 2px solid var(--primary-glow);
            text-align: center;
        }

        .emo-header h4 {
            font-weight: 800;
            letter-spacing: 4px;
            margin: 0;
            font-size: 1.2rem;
            background: linear-gradient(to right, #fff, var(--primary-glow));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* -------- INPUTS ESTILO CYBER -------- */
        label {
            font-size: 0.7rem;
            font-weight: 600;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 8px;
            display: block;
        }

        .input-group-text {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid #333;
            color: var(--primary-glow);
            border-right: none;
        }

        .form-control {
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid #333;
            color: #fff;
            font-size: 0.9rem;
            padding: 12px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(160, 0, 255, 0.05);
            border-color: var(--primary-glow);
            box-shadow: 0 0 15px rgba(160, 0, 255, 0.2);
            color: #fff;
        }

        .btn-emo {
            background: linear-gradient(135deg, var(--primary-glow), var(--secondary-glow));
            border: none;
            padding: 15px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            border-radius: 12px;
            color: white;
            transition: all 0.4s;
        }

        .btn-emo:hover {
            transform: scale(1.02);
            box-shadow: 0 0 30px rgba(160, 0, 255, 0.5);
            filter: brightness(1.2);
        }

        /* -------- ALERTAS -------- */
        .alert {
            border-radius: 12px;
            background: rgba(255, 0, 85, 0.1);
            border: 1px solid var(--secondary-glow);
            color: #ff99bb;
            font-size: 0.85rem;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>

<div class="container mt-4">

    <nav class="emo-breadcrumb">
        <ol>
            <li><a href="<?= site_url('/') ?>"><i class="bi bi-house-door"></i> Inicio</a></li>
            
            <?php if ($uri === 'formulario'): ?>
                <li class="sep">⛧</li>
                <li class="active">TERMINAL_DATOS</li>

            <?php elseif ($uri === 'registro'): ?>
                <li class="sep">⛧</li>
                <li><a href="<?= site_url('formulario') ?>">Formulario</a></li>
                <li class="sep">⛧</li>
                <li class="active">NUEVO_REGISTRO</li>

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
        <div class="emo-header">
            <h4><i class="bi bi-shield-lock-fill me-2"></i> VALIDACIÓN DE ACCESO</h4>
        </div>

        <div class="card-body p-4 p-md-5">

            <?php if (session()->has('errors')): ?>
                <div class="alert alert-dismissible fade show">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <strong>Error de integridad:</strong>
                    <ul class="mt-2 mb-0">
                        <?php foreach (session('errors') as $e): ?>
                            <li><?= esc($e) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>

            <?php if (session()->has('success')): ?>
                <div class="alert alert-success bg-success bg-opacity-10 border-success text-success">
                    <i class="bi bi-check-circle-fill me-2"></i> <?= session('success') ?>
                </div>
            <?php endif ?>

            <form method="post" action="<?= site_url('formulario/procesar') ?>">
                <?= csrf_field() ?>

                <div class="mb-4">
                    <label>Identificación de Usuario</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre completo" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-7 mb-4">
                        <label>Enlace de Red (Email)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope-at"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="correo@sistema.com" required>
                        </div>
                    </div>
                    <div class="col-md-5 mb-4">
                        <label>Ciclos (Edad)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-hash"></i></span>
                            <input type="number" name="edad" class="form-control" min="18" max="99" required>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label>Créditos / Precio</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-currency-bitcoin"></i></span>
                        <input type="text" name="precio" class="form-control" placeholder="0.00" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label>Fecha de Activación</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                        <input type="date" name="fecha" class="form-control" required>
                    </div>
                </div>

                <div class="mb-5">
                    <label>Código Encriptado (Contraseña)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-key"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" minlength="8" required>
                    </div>
                </div>

                <button class="btn btn-emo w-100">
                    <i class="bi bi-cpu-fill me-2"></i> PROCESAR INFORMACIÓN
                </button>
            </form>

        </div>
    </div>
</div>

</body>
</html>