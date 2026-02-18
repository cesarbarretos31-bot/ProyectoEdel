<?php
$uri = service('uri')->getPath();
?>

<style>
/* =========================================
   VOID & NEON ARCHITECTURE (ULTRA-IMPRESSIVE)
   ========================================= */

/* Fondo Base: Negro profundo con aura de movimiento */
body {
    background-color: #000;
    background-image: 
        radial-gradient(circle at 10% 20%, rgba(160, 0, 255, 0.1) 0%, transparent 40%),
        radial-gradient(circle at 90% 80%, rgba(255, 0, 80, 0.1) 0%, transparent 40%);
    color: #fff;
    font-family: 'Montserrat', sans-serif;
    min-height: 100vh;
    margin: 0;
    overflow-x: hidden;
}

/* -------- BREADCRUMB: CYBER-PATH -------- */
.emo-breadcrumb {
    margin: 40px 0;
    perspective: 1000px;
}

.emo-breadcrumb ol {
    background: rgba(5, 5, 5, 0.6);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-left: 4px solid #ff0050;
    padding: 15px 30px;
    border-radius: 0 50px 50px 0;
    display: inline-flex;
    list-style: none;
    box-shadow: 20px 20px 60px rgba(0, 0, 0, 0.8);
}

.emo-breadcrumb a {
    color: #ff0050;
    text-transform: uppercase;
    font-weight: 800;
    font-size: 12px;
    letter-spacing: 2px;
    text-decoration: none;
    transition: 0.3s ease;
}

.emo-breadcrumb a:hover {
    color: #fff;
    text-shadow: 0 0 15px #ff0050, 0 0 30px #ff0050;
}

.emo-breadcrumb .active {
    color: #666;
    font-style: italic;
}

/* -------- CAROUSEL: THE VOID DISPLAY -------- */
.emo-carousel {
    position: relative;
    width: 100%;
    height: 600px;
    background: #000;
    border-radius: 30px;
    border: 1px solid rgba(255, 255, 255, 0.05);
    box-shadow: 0 50px 100px rgba(0, 0, 0, 0.9);
    overflow: hidden;
}

/* Marco de luz perimetral (Glow dinámico) */
.emo-carousel::before {
    content: '';
    position: absolute;
    inset: -2px;
    background: linear-gradient(45deg, #ff0050, #a000ff, #ff0050);
    z-index: -1;
    filter: blur(10px);
    opacity: 0.3;
}

.emo-carousel .slides {
    display: flex;
    height: 100%;
    transition: transform 1.2s cubic-bezier(0.9, 0, 0.1, 1);
}

.emo-carousel .slide {
    min-width: 100%;
    position: relative;
}

.emo-carousel img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(0.5) contrast(1.2);
    mask-image: linear-gradient(to bottom, black 70%, transparent 100%);
}

/* Tipografía de Impacto Brutal */
.emo-carousel .content-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background: radial-gradient(circle, transparent 20%, rgba(0,0,0,0.8) 100%);
    pointer-events: none;
}

.emo-carousel h5 {
    font-size: 5rem;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: -2px;
    margin: 0;
    background: linear-gradient(to bottom, #fff 30%, #ff0050 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    filter: drop-shadow(0 0 30px rgba(255, 0, 80, 0.5));
    transform: skew(-5deg);
}

.emo-carousel .sub-title {
    font-family: 'Courier New', monospace;
    color: #fff;
    letter-spacing: 15px;
    font-size: 1rem;
    opacity: 0.6;
    margin-top: -10px;
}

/* Barra de progreso de tiempo */
.progress-bar-emo {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 4px;
    background: #ff0050;
    box-shadow: 0 0 15px #ff0050;
    z-index: 20;
    width: 0%;
}

/* Efecto Glitch sutil */
@keyframes glitch {
    0% { transform: translate(0); }
    20% { transform: translate(-2px, 2px); }
    40% { transform: translate(-2px, -2px); }
    60% { transform: translate(2px, 2px); }
    80% { transform: translate(2px, -2px); }
    100% { transform: translate(0); }
}

.emo-carousel:hover h5 {
    animation: glitch 0.3s infinite linear;
}

</style>

<div class="container-fluid py-4 px-5">

    <nav class="emo-breadcrumb" aria-label="breadcrumb">
        <ol>
            <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">SYSTEM_START</a></li>
            <?php if ($uri === 'carrusel'): ?>
                <li class="breadcrumb-item active">/CORE/GALLERY</li>
            <?php elseif ($uri === 'carrusel/nuevo'): ?>
                <li class="breadcrumb-item"><a href="<?= site_url('carrusel') ?>">GALLERY</a></li>
                <li class="breadcrumb-item active">/NEW_ENTRY</li>
            <?php endif; ?>
        </ol>
    </nav>

    <div class="emo-carousel" id="emoCarousel">
        <div class="progress-bar-emo" id="progressBar"></div>
        
        <div class="slides">
            <?php if (!empty($imagenes)): ?>
                <?php foreach ($imagenes as $img): ?>
                    <div class="slide">
                        <img src="/img/<?= esc($img['nombre_archivo']) ?>" alt="visual">
                        <div class="content-overlay">
                            <h5><?= esc($img['titulo']) ?></h5>
                            <div class="sub-title">ARCHIVE_FILE_2026</div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="slide">
                    <img src="https://images.unsplash.com/photo-1614850523296-d8c1af93d400?q=80&w=2070" alt="empty">
                    <div class="content-overlay">
                        <h5>NO_SIGNAL</h5>
                        <div class="sub-title">SYSTEM_FATAL_ERROR</div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
(() => {
    const container = document.querySelector('#emoCarousel .slides');
    const slides = document.querySelectorAll('#emoCarousel .slide');
    const progress = document.querySelector('#progressBar');
    if(!container || slides.length === 0) return;

    let index = 0;
    const duration = 5000; // 5 segundos

    const updateProgress = () => {
        progress.style.transition = 'none';
        progress.style.width = '0%';
        setTimeout(() => {
            progress.style.transition = `width ${duration}ms linear`;
            progress.style.width = '100%';
        }, 10);
    };

    const nextSlide = () => {
        index = (index + 1) % slides.length;
        container.style.transform = `translateX(-${index * 100}%)`;
        updateProgress();
    };

    updateProgress();
    let timer = setInterval(nextSlide, duration);

    // Interacción
    const mainContainer = document.querySelector('#emoCarousel');
    mainContainer.addEventListener('mouseenter', () => {
        clearInterval(timer);
        progress.style.opacity = '0';
    });
    mainContainer.addEventListener('mouseleave', () => {
        timer = setInterval(nextSlide, duration);
        progress.style.opacity = '1';
        updateProgress();
    });
})();
</script>