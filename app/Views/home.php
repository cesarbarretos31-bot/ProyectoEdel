<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= view('partials/breadcrumbs') ?>
    <title>Página Principal | MORENSISTEM</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-glow: #a000ff;
            --secondary-glow: #ff0055;
            --bg-color: #050505;
            --card-bg: rgba(20, 20, 20, 0.7);
        }

        body {
            min-height: 100vh;
            background-color: var(--bg-color);
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(160, 0, 255, 0.1) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(255, 0, 85, 0.1) 0%, transparent 40%);
            font-family: 'Montserrat', sans-serif;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            margin: 0;
        }

        /* Animación de fondo */
        .bg-glow {
            position: absolute;
            width: 300px;
            height: 300px;
            background: var(--primary-glow);
            filter: blur(120px);
            border-radius: 50%;
            z-index: -1;
            opacity: 0.2;
            animation: move 15s infinite alternate;
        }

        @keyframes move {
            from { transform: translate(-50%, -50%); }
            to { transform: translate(50%, 50%); }
        }

        .main-card {
            background: var(--card-bg);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5), 0 0 30px rgba(160, 0, 255, 0.1);
            border-radius: 24px;
            padding: 60px 40px;
            max-width: 850px;
            width: 90%;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .main-title h1 {
            font-weight: 800;
            font-size: 3rem;
            text-align: center;
            letter-spacing: 6px;
            margin-bottom: 5px;
            background: linear-gradient(135deg, #fff 30%, var(--primary-glow) 70%, var(--secondary-glow));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-transform: uppercase;
        }

        .subtitle {
            text-align: center;
            font-size: 0.8rem;
            font-weight: 400;
            letter-spacing: 4px;
            color: #aaa;
            margin-bottom: 50px;
            text-transform: uppercase;
        }

        .btn-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
        }

        .emo-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 25px 15px;
            text-decoration: none;
            border-radius: 18px;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 1.5px;
            color: #fff;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .emo-btn i {
            font-size: 2rem;
            background: linear-gradient(135deg, #fff, var(--primary-glow));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            transition: transform 0.3s ease;
        }

        .emo-btn:hover {
            transform: translateY(-8px);
            background: rgba(160, 0, 255, 0.1);
            border-color: var(--primary-glow);
            box-shadow: 0 15px 30px rgba(160, 0, 255, 0.2);
            color: #fff;
        }

        .emo-btn:hover i {
            transform: scale(1.2);
        }

        /* Variante de color para botones específicos */
        .emo-btn::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--primary-glow), var(--secondary-glow));
            transition: all 0.4s ease;
            transform: translateX(-50%);
        }

        .emo-btn:hover::after {
            width: 80%;
        }

        .footer-text {
            text-align: center;
            margin-top: 50px;
            font-size: 0.7rem;
            color: #555;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        /* Responsivo */
        @media (max-width: 576px) {
            .main-title h1 { font-size: 2rem; }
            .main-card { padding: 40px 20px; }
        }
    </style>
</head>

<body>
    <div class="bg-glow"></div>

    <div class="main-card">

        <div class="main-title">
            <h1>MORENSISTEM</h1>
        </div>

    

        <div class="btn-container">

            <a class="emo-btn" href="<?= site_url('carrusel') ?>">
                <i class="bi bi-images"></i>
                <span>CARRUSEL</span>
            </a>

            <a class="emo-btn" href="<?= site_url('carrusel/nuevo') ?>">
                <i class="bi bi-plus-circle-dotted"></i>
                <span>NUEVA IMAGEN</span>
            </a>

            <a class="emo-btn" href="<?= site_url('formulario') ?>">
                <i class="bi bi-ui-checks"></i>
                <span>FORMULARIO</span>
            </a>

            <a class="emo-btn" href="<?= site_url('registro') ?>">
                <i class="bi bi-person-badge"></i>
                <span>REGISTRO</span>
            </a>

            <a class="emo-btn" href="<?= site_url('usuarios') ?>">
                <i class="bi bi-database-gear"></i>
                <span>CRUD</span>
            </a>

        </div>

        

    </div>

</body>
</html>