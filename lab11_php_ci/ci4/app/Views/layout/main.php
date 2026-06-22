<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'My Website' ?></title>
    <link rel="stylesheet" href="<?= base_url('style.css'); ?>">
</head>
<body>
<div id="container">

    <header>
        <h1>Layout Sederhana</h1>
    </header>

    <nav>
        <a href="<?= base_url('/'); ?>" class="active">Home</a>
        <a href="<?= base_url('/artikel'); ?>">Artikel</a>
        <a href="<?= base_url('/about'); ?>">About</a>
        <a href="<?= base_url('/contact'); ?>">Kontak</a>
           <?php if (session()->get('logged_in')): ?>
        <a href="<?= base_url('/admin/artikel'); ?>">Admin</a>
        <a href="<?= base_url('/user/logout'); ?>"
           style="float:right; background:#e53935; color:#fff !important;
                  padding: 12px 18px; margin:0;">
            Logout (<?= esc(session()->get('user_name')) ?>)
        </a>
    <?php endif; ?>
    </nav>

    <section id="wrapper">
        <section id="main">
            <?= $this->renderSection('content') ?>
        </section>

        <aside id="sidebar">
            <?= view_cell('App\Cells\ArtikelTerkini::render') ?>

            <div class="widget-box">
                <h3 class="title">Widget Header</h3>
                <ul>
                    <li><a href="#">Widget Link</a></li>
                    <li><a href="#">Widget Link</a></li>
                </ul>
            </div>

            <div class="widget-box">
                <h3 class="title">Widget Text</h3>
                <p>Vestibulum lorem elit, iaculis in nisl volutpat,
                    malesuada tincidunt arcu. Proin in leo fringilla,
                    vestibulum mi porta, faucibus felis. Integer pharetra
                    est nunc, nec pretium nunc pretium ac.</p>
            </div>
        </aside>
    </section>

    <footer>
        <p>&copy; <?= date('Y') ?> - Universitas Pelita Bangsa</p>
    </footer>

</div>
</body>
</html>