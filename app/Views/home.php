<!DOCTYPE html>
<html lang="es">
<head>
  

<meta charset="UTF-8">
  <?= view('partials/breadcrumbs') ?>
<title>Página Principal</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;600;800&display=swap" rel="stylesheet">

<style>
body {
    min-height: 100vh;
    background: radial-gradient(circle at top, #1b1b1b, #000);
    font-family: 'Montserrat', sans-serif;
    color: #e0e0e0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.main-card {
    background: #0e0e0e;
    border: 1px solid #2c2c2c;
    box-shadow: 0 0 40px rgba(160, 0, 255, 0.2);
    border-radius: 18px;
    padding: 50px 40px;
    max-width: 700px;
    width: 100%;
}

.main-title {
    text-align: center;
    margin-bottom: 10px;
}

.main-title h1 {
    font-weight: 800;
    letter-spacing: 3px;
    background: linear-gradient(135deg, #a000ff, #ff0055);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.subtitle {
    text-align: center;
    font-size: 0.9rem;
    letter-spacing: 2px;
    color: #888;
    margin-bottom: 40px;
}

.btn-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
}

.emo-btn {
    padding: 18px;
    text-align: center;
    text-decoration: none;
    border-radius: 14px;
    font-weight: 600;
    letter-spacing: 1px;
    color: #fff;
    background: linear-gradient(135deg, #4b006e, #1a001f);
    border: 1px solid #32003f;
    box-shadow: 0 0 15px rgba(160, 0, 255, 0.15);
    transition: all 0.35s ease;
    position: relative;
    overflow: hidden;
}

.emo-btn::before {
    content: "";
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(160,0,255,0.25), transparent 60%);
    opacity: 0;
    transition: opacity 0.4s;
}

.emo-btn:hover::before {
    opacity: 1;
}

.emo-btn:hover {
    transform: translateY(-4px) scale(1.02);
    box-shadow: 0 0 30px rgba(255, 0, 85, 0.35);
    background: linear-gradient(135deg, #a000ff, #ff0055);
}

.footer-text {
    text-align: center;
    margin-top: 35px;
    font-size: 0.75rem;
    color: #666;
    letter-spacing: 2px;
}
</style>
</head>

<body>

<div class="main-card">

    <div class="main-title">
        <h1>MORENSISTEM</h1>
    </div>

    <div class="subtitle">
        PANEL PRINCIPAL · ACCESO RÁPIDO
    </div>

    <div class="btn-container">

        <a class="emo-btn" href="<?= site_url('carrusel') ?>">
            CARRUSEL
        </a>

        <a class="emo-btn" href="<?= site_url('carrusel/nuevo') ?>">
            NUEVO CARRUSEL
        </a>

        <a class="emo-btn" href="<?= site_url('formulario') ?>">
            FORMULARIO
        </a>

        <a class="emo-btn" href="<?= site_url('registro') ?>">
            REGISTRO
        </a>
           </a>

        <a class="emo-btn" href="<?= site_url('usuarios') ?>">
            CRUD
        </a>

    </div>

    <div class="footer-text">
        © <?= date('Y') ?> · SYSTEM INTERFACE
    </div>

</div>

</body>
</html>
