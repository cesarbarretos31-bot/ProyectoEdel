<?php
$uri = service('uri')->getPath();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Control | MORENSISTEM</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;800&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
    :root {
        --primary-glow: #a000ff;
        --secondary-glow: #ff0055;
        --dark-bg: #050505;
    }

    body {
        background: radial-gradient(circle at top right, #1a002e 0%, #050505 60%),
                    radial-gradient(circle at bottom left, #2e001a 0%, #050505 60%);
        font-family: 'Montserrat', sans-serif;
        color: #e0e0e0;
        min-height: 100vh;
        overflow-x: hidden;
    }

    /* BREADCRUMB ESTILO MORENSISTEM */
    .emo-breadcrumb {
        margin: 40px 0;
        animation: fadeInDown 0.8s ease forwards;
    }

    .emo-breadcrumb ol {
        display: inline-flex;
        background: rgba(255, 255, 255, 0.02);
        backdrop-filter: blur(15px);
        padding: 15px 30px;
        border-radius: 20px;
        border: 1px solid rgba(160, 0, 255, 0.4);
        box-shadow: 0 0 20px rgba(160, 0, 255, 0.2);
        list-style: none;
        font-family: 'Courier New', monospace;
    }

    .emo-breadcrumb a {
        color: #c77dff;
        text-decoration: none;
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 1px;
    }

    .emo-breadcrumb .sep {
        color: var(--secondary-glow);
        margin: 0 15px;
        text-shadow: 0 0 8px var(--secondary-glow);
    }

    .emo-breadcrumb .active {
        color: #fff;
        text-shadow: 0 0 10px var(--primary-glow);
    }

    /* HUB DE COMANDO (CARDS PASADAS DE LANZA) */
    .command-node {
        background: rgba(15, 15, 15, 0.7);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 20px;
        padding: 30px;
        position: relative;
        transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        overflow: hidden;
        cursor: pointer;
        text-decoration: none;
        display: block;
        height: 100%;
    }

    .command-node::before {
        content: "";
        position: absolute;
        top: 0; left: 0; width: 100%; height: 2px;
        background: linear-gradient(90deg, transparent, var(--primary-glow), transparent);
        transform: translateX(-100%);
        transition: 0.5s;
    }

    .command-node:hover::before { transform: translateX(100%); }

    .command-node:hover {
        background: rgba(160, 0, 255, 0.05);
        border-color: var(--primary-glow);
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6), 0 0 20px rgba(160, 0, 255, 0.2);
    }

    .node-icon {
        font-size: 3rem;
        margin-bottom: 20px;
        background: linear-gradient(135deg, #fff, var(--primary-glow));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        transition: 0.4s;
    }

    .command-node:hover .node-icon {
        transform: rotateY(180deg);
        filter: drop-shadow(0 0 10px var(--primary-glow));
    }

    .node-title {
        font-family: 'Share Tech Mono', monospace;
        font-size: 1.4rem;
        font-weight: 800;
        letter-spacing: 2px;
        margin-bottom: 10px;
        color: #fff;
    }

    .node-desc {
        font-size: 0.85rem;
        color: #888;
        line-height: 1.6;
    }

    .status-tag {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 0.6rem;
        font-weight: 800;
        padding: 4px 10px;
        border-radius: 4px;
        background: rgba(160, 0, 255, 0.2);
        color: var(--primary-glow);
        border: 1px solid var(--primary-glow);
        text-transform: uppercase;
    }

    /* ANIMACIONES */
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
    </style>
</head>

<body>

<div class="container py-5">
    
    <div class="text-center mb-5">
        <h1 style="font-weight: 800; letter-spacing: 10px; color: #fff; text-shadow: 0 0 20px var(--primary-glow);">MORENSISTEM</h1>
        <p style="font-family: 'Share Tech Mono'; color: var(--secondary-glow);">// CORE_INTERFACE_ACTIVE //</p>
    </div>

    <nav class="emo-breadcrumb d-flex justify-content-center">
        <ol>
            <li><a href="<?= site_url('/') ?>">System</a></li>
            <li class="sep">⛧</li>
            <li class="active">Main_Hub</li>
        </ol>
    </nav>

    <div class="row g-4 justify-content-center">
        
        <div class="col-md-5 col-lg-4">
            <a href="<?= site_url('carrusel') ?>" class="command-node">
                <span class="status-tag">Live</span>
                <div class="node-icon"><i class="bi bi-grid-3x3-gap"></i></div>
                <div class="node-title">CARRUSEL</div>
                <div class="node-desc">Visualización y control de la galería principal. Gestión de flujo visual activo.</div>
            </a>
        </div>

        <div class="col-md-5 col-lg-4">
            <a href="<?= site_url('carrusel/nuevo') ?>" class="command-node">
                <span class="status-tag" style="border-color: #00ffcc; color: #00ffcc; background: rgba(0,255,204,0.1)">Upload</span>
                <div class="node-icon"><i class="bi bi-plus-circle-dotted"></i></div>
                <div class="node-title">NUEVO_ITEM</div>
                <div class="node-desc">Inyectar nuevos assets multimedia al carrusel del sistema central.</div>
            </a>
        </div>

        <div class="col-md-5 col-lg-4">
            <a href="<?= site_url('usuarios-fetch') ?>" class="command-node">
                <span class="status-tag" style="border-color: var(--secondary-glow); color: var(--secondary-glow); background: rgba(255,0,85,0.1)">Data</span>
                <div class="node-icon"><i class="bi bi-database-fill-gear"></i></div>
                <div class="node-title">DATOS_FETCH</div>
                <div class="node-desc">Sincronización masiva y extracción de perfiles de usuario vía protocolo Fetch.</div>
            </a>
        </div>

        <div class="col-md-5 col-lg-4">
            <form id="regForm" action="<?= site_url('registro') ?>" method="POST" style="display:none;"><?= csrf_field() ?></form>
            <div onclick="document.getElementById('regForm').submit();" class="command-node">
                <span class="status-tag">Secure</span>
                <div class="node-icon"><i class="bi bi-person-plus-fill"></i></div>
                <div class="node-title">REGISTRO</div>
                <div class="node-desc">Ejecutar protocolo de alta de nuevos sujetos en la base de datos maestra.</div>
            </div>
        </div>

    </div>

    <div class="mt-5 pt-5 text-center" style="font-family: 'Share Tech Mono'; font-size: 0.7rem; color: #444; letter-spacing: 2px;">
        <div class="mb-2">ROOT@MORENSISTEM:~$ <span class="text-white">INIT_SEQUENCE_COMPLETE</span></div>
        <div>[ STATUS: <span style="color: #00ffcc;">OPTIMAL</span> ] [ ENCRYPTION: <span style="color: #00ffcc;">AES-256</span> ]</div>
    </div>

</div>

</body>
</html>