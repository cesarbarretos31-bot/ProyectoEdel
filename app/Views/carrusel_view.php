<?php
$uri = service('uri')->getPath();
?>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;600;800&family=Share+Tech+Mono&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
/* ===============================
   ESTILO PROFESIONAL MORENSISTEM
================================ */

:root {
    --accent-color: #ff0055;
    --glow-color: rgba(255, 0, 85, 0.5);
    --glass-bg: rgba(10, 10, 10, 0.75);
}

/* -------- BREADCRUMBS MODERNO -------- */
.emo-breadcrumb {
    margin: 30px 0;
    perspective: 1000px;
}

.emo-breadcrumb ol {
    background: var(--glass-bg);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    padding: 12px 25px;
    border-radius: 50px; /* Estilo píldora */
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5), inset 0 0 10px rgba(255, 0, 85, 0.1);
    display: inline-flex;
    list-style: none;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: "〉";
    color: var(--accent-color);
    font-weight: 800;
    font-size: 0.7rem;
}

.emo-breadcrumb a {
    color: #eee;
    text-decoration: none;
    font-family: 'Montserrat', sans-serif;
    font-size: 0.85rem;
    font-weight: 600;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.emo-breadcrumb a i {
    color: var(--accent-color);
}

.emo-breadcrumb a:hover {
    color: var(--accent-color);
    text-shadow: 0 0 8px var(--glow-color);
}

.emo-breadcrumb .active {
    color: #888;
    font-family: 'Share Tech Mono', monospace;
    text-transform: uppercase;
    padding-left: 10px;
}

/* -------- CAROUSEL PREMIUM -------- */
.emo-carousel {
    position: relative;
    width: 100%;
    height: 550px;
    overflow: hidden;
    background: #000;
    border-radius: 24px;
    box-shadow: 0 30px 60px rgba(0,0,0,0.8);
    border: 1px solid rgba(255, 255, 255, 0.05);
}

/* Viñeta para realzar profundidad */
.emo-carousel::after {
    content: "";
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: radial-gradient(circle, transparent 40%, rgba(0,0,0,0.8) 100%);
    pointer-events: none;
    z-index: 2;
}

.emo-carousel .slides {
    display: flex;
    height: 100%;
    transition: transform 1.2s cubic-bezier(0.65, 0, 0.35, 1);
}

.emo-carousel .slide {
    min-width: 100%;
    position: relative;
    overflow: hidden;
}

.emo-carousel img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transform: scale(1.05); /* Efecto zoom inicial */
    transition: transform 10s linear;
}

/* Animación Ken Burns al estar activo */
.emo-carousel .slide.active img {
    transform: scale(1.2);
}

/* Caption Dinámico */
.emo-carousel .caption-box {
    position: absolute;
    bottom: 50px;
    left: 50px;
    z-index: 10;
    max-width: 80%;
}

.emo-carousel h5 {
    color: #fff;
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 2.5rem;
    text-transform: uppercase;
    margin: 0;
    padding: 10px 20px;
    background: linear-gradient(90deg, var(--accent-color), transparent);
    border-left: 5px solid #fff;
    clip-path: polygon(0 0, 100% 0, 95% 100%, 0% 100%);
    opacity: 0;
    transform: translateX(-50px);
    transition: all 0.8s 0.5s ease-out;
}

.slide.active h5 {
    opacity: 1;
    transform: translateX(0);
}

/* Barra de progreso inferior */
.carousel-progress {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 4px;
    background: var(--accent-color);
    width: 0%;
    z-index: 20;
    box-shadow: 0 0 15px var(--accent-color);
}
</style>

<nav class="emo-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?= site_url('/') ?>"><i class="bi bi-house-door"></i> Inicio</a>
        </li>

        <?php if ($uri === 'carrusel'): ?>
            <li class="breadcrumb-item active">/ Galería</li>

        <?php elseif ($uri === 'carrusel/nuevo'): ?>
            <li class="breadcrumb-item">
                <a href="<?= site_url('carrusel') ?>">Galería</a>
            </li>
            <li class="breadcrumb-item active">/ Editor</li>

        <?php elseif ($uri === 'formulario'): ?>
            <li class="breadcrumb-item active">/ Formulario Intel</li>

        <?php elseif ($uri === 'registro'): ?>
            <li class="breadcrumb-item active">/ Data Entry</li>
        <?php endif; ?>
    </ol>
</nav>

<div class="emo-carousel" id="emoCarousel">
    <div class="carousel-progress" id="progressBar"></div>
    
    <div class="slides">
        <?php if (!empty($imagenes)): ?>
            <?php foreach ($imagenes as $index => $img): ?>
                <div class="slide <?= $index === 0 ? 'active' : '' ?>">
                    <img src="/img/<?= esc($img['nombre_archivo']) ?>">
                    <div class="caption-box">
                        <h5><?= esc($img['titulo']) ?></h5>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="slide active">
                <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&q=80&w=1200">
                <div class="caption-box">
                    <h5>NO DATA FOUND</h5>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
(() => {
    const container = document.querySelector('#emoCarousel .slides');
    const slides = document.querySelectorAll('#emoCarousel .slide');
    const progress = document.querySelector('#progressBar');
    let index = 0;
    const intervalTime = 5000; // 5 segundos por slide

    function updateCarousel() {
        // Reiniciar barra de progreso
        progress.style.transition = 'none';
        progress.style.width = '0%';
        
        setTimeout(() => {
            progress.style.transition = `width ${intervalTime}ms linear`;
            progress.style.width = '100%';
        }, 50);

        // Mover Slides
        container.style.transform = `translateX(-${index * 100}%)`;
        
        // Manejar clases activas para animaciones CSS
        slides.forEach(s => s.classList.remove('active'));
        slides[index].classList.add('active');

        index = (index + 1) % slides.length;
    }

    // Iniciar el ciclo
    updateCarousel();
    setInterval(updateCarousel, intervalTime);
})();
</script>