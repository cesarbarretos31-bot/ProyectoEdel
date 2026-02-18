<?php
$uri = service('uri')->getPath();
?>

<style>
/* ===============================
   ULTRA-PREMIUM EMO CAROUSEL
   Estética: Cyber-Punk / Scene 2000s
================================ */

/* -------- BREADCRUMBS MODERNO -------- */
.emo-breadcrumb {
    margin: 30px 0;
    animation: fadeInDown 0.8s ease;
}

.emo-breadcrumb ol {
    background: rgba(10, 10, 10, 0.8);
    backdrop-filter: blur(15px);
    padding: 12px 25px;
    border-radius: 50px;
    border: 1px solid rgba(255, 0, 95, 0.3);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5), inset 0 0 15px rgba(255, 0, 95, 0.1);
    display: inline-flex;
    list-style: none;
}

.emo-breadcrumb a {
    color: #ff2d5f;
    text-decoration: none;
    font-family: 'Courier New', monospace;
    font-weight: bold;
    font-size: 13px;
    text-transform: uppercase;
    transition: 0.3s;
}

.emo-breadcrumb a:hover {
    color: #fff;
    text-shadow: 0 0 12px #ff2d5f, 0 0 20px #ff2d5f;
}

.emo-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
    content: "⚡";
    color: #444;
    padding: 0 10px;
}

.emo-breadcrumb .active {
    color: #eee;
    font-family: 'Courier New', monospace;
    letter-spacing: 1px;
}

/* -------- CAROUSEL DE ALTO IMPACTO -------- */
.emo-carousel {
    position: relative;
    width: 100%;
    height: 600px; /* Un poco más alto para mayor impacto */
    overflow: hidden;
    background: #000;
    border-radius: 25px;
    border: 2px solid rgba(255, 0, 95, 0.4);
    box-shadow: 0 0 60px rgba(255, 0, 95, 0.2), inset 0 0 100px rgba(0,0,0,0.8);
}

/* Overlay de escaneo (Efecto Retro-Futurista) */
.emo-carousel::after {
    content: "";
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.15) 50%), 
                linear-gradient(90deg, rgba(255, 0, 0, 0.03), rgba(0, 255, 0, 0.01), rgba(0, 0, 255, 0.03));
    background-size: 100% 3px, 3px 100%;
    pointer-events: none;
    z-index: 5;
}

.emo-carousel .slides {
    display: flex;
    height: 100%;
    transition: transform 1.2s cubic-bezier(0.85, 0, 0.15, 1); /* Transición suave tipo cine */
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
    filter: brightness(0.7) contrast(1.1);
    transform: scale(1.05);
    transition: transform 6s linear; /* Efecto Ken Burns lento */
}

/* Cuando el slide está activo (clase manejada por JS opcionalmente o solo el efecto base) */
.emo-carousel .slide:hover img {
    transform: scale(1.15);
}

.emo-carousel h5 {
    position: absolute;
    bottom: 50px;
    right: 50px; /* Movido a la derecha para un look más editorial */
    margin: 0;
    color: #fff;
    font-family: 'Montserrat', sans-serif;
    font-weight: 900;
    font-size: 2.5rem;
    text-transform: uppercase;
    text-align: right;
    line-height: 1;
    z-index: 10;
    text-shadow: 4px 4px 0px #ff0050;
    animation: slideUpText 1s ease;
}

.emo-carousel h5 span {
    display: block;
    font-size: 1rem;
    font-weight: 300;
    letter-spacing: 8px;
    color: #ff0050;
    text-shadow: none;
}

/* -------- ANIMACIONES -------- */
@keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes slideUpText {
    from { opacity: 0; transform: translateY(50px); filter: blur(10px); }
    to { opacity: 1; transform: translateY(0); filter: blur(0); }
}
</style>

<div class="container-fluid px-4">
    <nav class="emo-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Inicio</a></li>
            <?php if ($uri === 'carrusel'): ?>
                <li class="breadcrumb-item active">Carrusel</li>
            <?php elseif ($uri === 'carrusel/nuevo'): ?>
                <li class="breadcrumb-item"><a href="<?= site_url('carrusel') ?>">Carrusel</a></li>
                <li class="breadcrumb-item active">Nuevo</li>
            <?php elseif ($uri === 'formulario'): ?>
                <li class="breadcrumb-item active">Formulario</li>
            <?php elseif ($uri === 'registro'): ?>
                <li class="breadcrumb-item active">Registro</li>
            <?php endif; ?>
        </ol>
    </nav>

    <div class="emo-carousel" id="emoCarousel">
        <div class="slides">
            <?php if (!empty($imagenes)): ?>
                <?php foreach ($imagenes as $img): ?>
                    <div class="slide">
                        <img src="/img/<?= esc($img['nombre_archivo']) ?>" alt="slide">
                        <h5>
                            <span>GALERÍA</span>
                            <?= esc($img['titulo']) ?>
                        </h5>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="slide">
                    <img src="https://images.unsplash.com/photo-1550684848-fac1c5b4e853?q=80&w=2070" alt="no-signal">
                    <h5><span>ERROR 404</span>NO SIGNAL</h5>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
(() => {
    const container = document.querySelector('#emoCarousel .slides');
    const slides = document.querySelectorAll('#emoCarousel .slide');
    if(!container || slides.length === 0) return;

    let index = 0;

    const nextSlide = () => {
        index = (index + 1) % slides.length;
        container.style.transform = `translateX(-${index * 100}%)`;
    };

    // Cambio automático con tiempo profesional
    let timer = setInterval(nextSlide, 5000);

    // Pausar al pasar el mouse
    const mainContainer = document.querySelector('#emoCarousel');
    mainContainer.addEventListener('mouseenter', () => clearInterval(timer));
    mainContainer.addEventListener('mouseleave', () => timer = setInterval(nextSlide, 5000));
})();
</script>