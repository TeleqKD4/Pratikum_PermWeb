<div class="widget-box">
    <h3 class="title">
        Artikel Terkini
        <?php if (!empty($kategori)): ?>
            <small>(<?= esc($kategori); ?>)</small>
        <?php endif; ?>
    </h3>

    <?php if (!empty($artikel)): ?>
        <ul>
            <?php foreach ($artikel as $row): ?>
                <li>
                    <a href="<?= base_url('/artikel/' . $row['slug']); ?>">
                        <?= esc($row['judul']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Belum ada artikel terkini.</p>
    <?php endif; ?>
</div>