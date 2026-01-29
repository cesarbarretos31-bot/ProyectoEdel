<?php
$uri = service('uri')->getPath();
?>

<style>
/* ===============================
   EMO CAROUSEL + BREADCRUMB 2000s
   UNA SOLA CLASE / UN SOLO BLOQUE
================================ */

/* -------- CAROUSEL -------- */
.emo-carousel {
    position: relative;
    width: 100%;
    height: 500px;
    overflow: hidden;
    background: #050505;
    border-radius: 18px;
    box-shadow: 0 0 40px rgba(255,0,80,.45);
}

.emo-carousel .slides {
    display: flex;
    height: 100%;
    transition: transform 1s ease-in-out;
}

.emo-carousel .slide {
    min-width: 100%;
    position: relative;
}

.emo-carousel img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(.6) contrast(1.25) saturate(1.4);
}

.emo-carousel h5 {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    color: #fff;
    font-family: 'Courier New', monospace;
    letter-spacing: 2px;
    text-transform: uppercase;
    background: rgba(0,0,0,.7);
    padding: 12px 28px;
    border: 1px solid rgba(255,0,80,.7);
    box-shadow: 0 0 25px rgba(255,0,80,.8);
}

/* -------- BREADCRUMBS -------- */
.emo-breadcrumb {
    margin: 25px 0;
}

.emo-breadcrumb ol {
    background: #0b0b0b;
    padding: 14px 22px;
    border-radius: 14px;
    box-shadow: 0 0 20px rgba(255,0,80,.35);
    font-family: 'Courier New', monospace;
}

.emo-breadcrumb a {
    color: #ff305f;
    text-decoration: none;
}

.emo-breadcrumb a:hover {
    text-shadow: 0 0 10px rgba(255,0,80,.9);
}

.emo-breadcrumb .active {
    color: #fff;
    letter-spacing: 1px;
}
</style>

<!-- ===============================
     BREADCRUMBS
================================ -->
<?= view('partials/breadcrumbs') ?>

<nav class="emo-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?= site_url('/') ?>">Inicio</a>
        </li>

        <?php if ($uri === 'carrusel'): ?>
            <li class="breadcrumb-item active">Carrusel</li>

        <?php elseif ($uri === 'carrusel/nuevo'): ?>
            <li class="breadcrumb-item">
                <a href="<?= site_url('carrusel') ?>">Carrusel</a>
            </li>
            <li class="breadcrumb-item active">Nuevo Carrusel</li>

        <?php elseif ($uri === 'formulario'): ?>
            <li class="breadcrumb-item active">Formulario</li>

        <?php elseif ($uri === 'registro'): ?>
            <li class="breadcrumb-item active">Registro</li>
        <?php endif; ?>
    </ol>
</nav>

<!-- ===============================
     CAROUSEL
================================ -->
<div class="emo-carousel" id="emoCarousel">
    <div class="slides">
        <?php if (!empty($imagenes)): ?>
            <?php foreach ($imagenes as $img): ?>
                <div class="slide">
                    <img src="/img/<?= esc($img['nombre_archivo']) ?>">
                    <h5><?= esc($img['titulo']) ?></h5>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="slide">
                <img src="https://via.placeholder.com/800x400?text=No+hay+imagenes">
                <h5>NO SIGNAL</h5>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
(() => {
    const container = document.querySelector('#emoCarousel .slides');
    const slides = document.querySelectorAll('#emoCarousel .slide');
    let index = 0;

    setInterval(() => {
        index = (index + 1) % slides.length;
        container.style.transform = `translateX(-${index * 100}%)`;
    }, 3500);
})();
</script>
