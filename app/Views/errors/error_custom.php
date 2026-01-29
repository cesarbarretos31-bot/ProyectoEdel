<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Error</title>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;600&display=swap" rel="stylesheet">

<style>
body {
    background: radial-gradient(circle at top, #1b1b1b, #000);
    font-family: 'Montserrat', sans-serif;
    color: #e0e0e0;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

.error-box {
    background: #0e0e0e;
    border: 1px solid #32003f;
    box-shadow: 0 0 40px rgba(160,0,255,.4);
    border-radius: 18px;
    padding: 40px;
    text-align: center;
    max-width: 520px;
}

.error-box h1 {
    font-size: 4rem;
    color: #a000ff;
}

.error-box p {
    letter-spacing: 1px;
    margin-bottom: 25px;
}

.error-box a {
    color: #c77dff;
    text-decoration: none;
    border: 1px solid #4b006e;
    padding: 10px 22px;
    border-radius: 10px;
}

.error-box a:hover {
    background: #4b006e;
    color: #fff;
}
</style>
</head>

<body>

<div class="error-box">
    <h1>💔</h1>
    <p>Algo salió mal.<br>No era el momento.</p>

    <a href="<?= site_url('/') ?>">Volver al inicio</a>
</div>

</body>
</html>
