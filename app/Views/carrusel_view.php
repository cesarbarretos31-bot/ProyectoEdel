<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrusel en CI4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Ajuste opcional para que las imágenes tengan altura uniforme */
        .carousel-item img {
            height: 500px;
            object-fit: cover; /* Recorta la imagen para que no se deforme */
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <h2>Mi Carrusel CodeIgniter 4</h2>
        
        <div id="miCarrusel" class="carousel slide" data-bs-ride="carousel">
            
            <div class="carousel-indicators">
                <?php foreach ($imagenes as $key => $imagen): ?>
                    <button type="button" data-bs-target="#miCarrusel" data-bs-slide-to="<?= $key ?>" 
                        class="<?= ($key === 0) ? 'active' : '' ?>" 
                        aria-current="<?= ($key === 0) ? 'true' : 'false' ?>" 
                        aria-label="Slide <?= $key + 1 ?>"></button>
                <?php endforeach; ?>
            </div>

            <div class="carousel-inner">
                <?php foreach ($imagenes as $key => $imagen): ?>
                    <div class="carousel-item <?= ($key === 0) ? 'active' : '' ?>">
                        <img src="<?= base_url('assets/img/' . $imagen['src']) ?>" class="d-block w-100" alt="<?= $imagen['alt'] ?>">
                        
                        <div class="carousel-caption d-none d-md-block">
                            <h5><?= $imagen['titulo'] ?></h5>
                            <p><?= $imagen['desc'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#miCarrusel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#miCarrusel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>