<style>
/* UNA SOLA CLASE PARA TODO */
.emo-carousel {
    position: relative;
    width: 100%;
    height: 500px;
    overflow: hidden;
    background: #0b0b0b;
    border-radius: 18px;
    box-shadow: 0 0 40px rgba(255,0,80,.35);
}

/* IMÁGENES */
.emo-carousel img {
    width: 100%;
    height: 500px;
    object-fit: cover;
    filter: brightness(0.65) contrast(1.2) saturate(1.3);
    animation: glitchFade 1.2s ease;
}

/* TEXTO */
.emo-carousel h5 {
    position: absolute;
    bottom: 35px;
    left: 50%;
    transform: translateX(-50%);
    color: #fff;
    font-family: 'Courier New', monospace;
    letter-spacing: 2px;
    text-transform: uppercase;
    background: rgba(0,0,0,.65);
    padding: 12px 26px;
    border: 1px solid rgba(255,0,80,.6);
    box-shadow: 0 0 20px rgba(255,0,80,.5);
    animation: textPulse 2s infinite;
}

/* ANIMACIÓN IMAGEN */
@keyframes glitchFade {
    0% { opacity: 0; transform: scale(1.08); }
    100% { opacity: 1; transform: scale(1); }
}

/* ANIMACIÓN TEXTO */
@keyframes textPulse {
    0%,100% { box-shadow: 0 0 20px rgba(255,0,80,.4); }
    50% { box-shadow: 0 0 35px rgba(255,0,80,.9); }
}
</style>

<div class="emo-carousel carousel-inner">
    <?php if(!empty($imagenes)): ?>
        <?php foreach ($imagenes as $key => $img): ?>
            <div class="carousel-item <?= ($key === 0) ? 'active' : '' ?>">
                <img src="/img/<?= $img['nombre_archivo'] ?>">
                <h5><?= esc($img['titulo']) ?></h5>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="carousel-item active">
            <img src="https://via.placeholder.com/800x400?text=No+hay+imagenes">
            <h5>NO SIGNAL</h5>
        </div>
    <?php endif; ?>
</div>
