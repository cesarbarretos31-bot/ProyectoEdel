<div class="carousel-inner">
    <?php if(!empty($imagenes)): ?>
        <?php foreach ($imagenes as $key => $img): ?>
            <div class="carousel-item <?= ($key === 0) ? 'active' : '' ?>">
                <img src="/img/<?= $img['nombre_archivo'] ?>" class="d-block w-100" style="height:500px; object-fit:cover;">
                <div class="carousel-caption">
                    <h5><?= esc($img['titulo']) ?></h5>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="carousel-item active">
            <img src="https://via.placeholder.com/800x400?text=No+hay+imagenes" class="d-block w-100">
        </div>
    <?php endif; ?>
</div>