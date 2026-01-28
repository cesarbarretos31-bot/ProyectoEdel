<style>
/* UNA SOLA CLASE PARA TODO */
.emo-carousel {
    position: relative;
    width: 100%;
    height: 500px;
    overflow: hidden;
    background: #050505;
    border-radius: 18px;
    box-shadow: 0 0 40px rgba(255,0,80,.45);
}

/* CONTENEDOR DE SLIDES */
.emo-carousel .slides {
    display: flex;
    width: 100%;
    height: 100%;
    transition: transform 1s ease-in-out;
}

/* CADA SLIDE */
.emo-carousel .slide {
    min-width: 100%;
    height: 100%;
    position: relative;
}

/* IMAGEN */
.emo-carousel img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(.6) contrast(1.25) saturate(1.4);
}

/* TEXTO */
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
</style>

<div class="emo-carousel" id="emoCarousel">
    <div class="slides">
        <?php if(!empty($imagenes)): ?>
            <?php foreach ($imagenes as $img): ?>
                <div class="slide">
                    <img src="/img/<?= $img['nombre_archivo'] ?>">
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
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb bg-dark p-3 rounded shadow-sm">
        <li class="breadcrumb-item">
            <a href="<?= site_url('/') ?>" class="text-decoration-none text-danger">
                Inicio
            </a>
        </li>

        <li class="breadcrumb-item">
            <a href="<?= site_url('carrusel') ?>" class="text-decoration-none text-danger">
                Carrusel
            </a>
        </li>

        <li class="breadcrumb-item active text-light" aria-current="page">
            Galería
        </li>
    </ol>
</nav>


<script>
(() => {
    const carousel = document.querySelector('#emoCarousel .slides');
    const slides = document.querySelectorAll('#emoCarousel .slide');
    let index = 0;

    setInterval(() => {
        index++;
        if (index >= slides.length) index = 0;
        carousel.style.transform = `translateX(-${index * 100}%)`;
    }, 3500); // velocidad del cambio
})();
</script>
