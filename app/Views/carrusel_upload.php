<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Imagen</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font estilo 2000 -->
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
            border-bottom: 1px solid #32003f;
            text-align: center;
        }

        .emo-header h4 {
            letter-spacing: 2px;
            font-weight: 600;
        }

        label {
            color: #bfbfbf;
            font-size: 0.9rem;
            letter-spacing: 1px;
        }

        .form-control {
            background: #121212;
            border: 1px solid #333;
            color: #fff;
        }

        .form-control:focus {
            background: #121212;
            color: #fff;
            border-color: #a000ff;
            box-shadow: 0 0 0 0.15rem rgba(160, 0, 255, 0.25);
        }

        .btn-emo {
            background: linear-gradient(135deg, #a000ff, #4b006e);
            border: none;
            color: #fff;
            letter-spacing: 1px;
            transition: all 0.3s ease;
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

        .emo-footer {
            text-align: center;
            font-size: 0.75rem;
            color: #666;
            margin-top: 15px;
            letter-spacing: 1px;
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
    <div class="card emo-card mx-auto" style="max-width: 520px;">
        
        <div class="card-header emo-header text-white">
            <h4>UPLOAD YOUR DARK IMAGE</h4>
        </div>

        <div class="card-body">

            <?php if (session()->has('errors')) : ?>
                <div class="alert">
                    <ul class="mb-0">
                        <?php foreach (session('errors') as $error) : ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>

            <?php if (session()->has('error')) : ?>
                <div class="alert">
                    <?= session('error') ?>
                </div>
            <?php endif ?>

            <form action="<?= site_url('carrusel/guardar') ?>" method="post" enctype="multipart/form-data">

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

        <div class="emo-footer">
            © DARK ERA • 2000s MOOD
        </div>

    </div>
</div>

</body>
</html>
