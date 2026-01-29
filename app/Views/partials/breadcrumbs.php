<nav class="emo-breadcrumb mb-4">
    <ol class="breadcrumb mb-0">
        <?php foreach (breadcrumbs() as $index => $item): ?>
            <?php if ($index + 1 < count(breadcrumbs())): ?>
                <li class="breadcrumb-item">
                    <a href="<?= $item['url'] ?>">
                        <?= esc($item['title']) ?>
                    </a>
                </li>
            <?php else: ?>
                <li class="breadcrumb-item active">
                    <?= esc($item['title']) ?>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ol>
</nav>
