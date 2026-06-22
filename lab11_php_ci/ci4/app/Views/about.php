<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h1><?= esc($title); ?></h1>
<hr>

<div style="display:flex; gap:24px; align-items:flex-start; margin-bottom:24px;">
    <img src="<?= base_url('images/kampus.jpg') ?>" alt="Kampus"
         style="width:220px; border-radius:8px; flex-shrink:0;"
         onerror="this.style.display='none'">
    <p>
        <strong>Universitas Pelita Bangsa</strong> adalah perguruan tinggi swasta yang berlokasi
        di Cikarang, Bekasi, Jawa Barat. Berdiri dengan visi menghasilkan lulusan yang unggul,
        berkarakter, dan berdaya saing di tingkat nasional maupun global.
    </p>
</div>

<h2>Visi</h2>
<p>Menjadi universitas unggulan yang menghasilkan sumber daya manusia berkualitas,
berkarakter, dan berdaya saing global pada tahun 2030.</p>

<h2>Misi</h2>
<ul>
    <li>Menyelenggarakan pendidikan tinggi yang berkualitas dan relevan dengan kebutuhan industri.</li>
    <li>Melaksanakan penelitian inovatif yang bermanfaat bagi masyarakat.</li>
    <li>Menyelenggarakan pengabdian kepada masyarakat secara berkelanjutan.</li>
    <li>Membangun kerjasama strategis dengan institusi dalam dan luar negeri.</li>
</ul>

<h2>Program Studi</h2>
<table style="width:100%; border-collapse:collapse; margin-top:8px;">
    <thead>
        <tr style="background:#1a73e8; color:#fff;">
            <th style="padding:10px; text-align:left;">Program Studi</th>
            <th style="padding:10px; text-align:left;">Jenjang</th>
            <th style="padding:10px; text-align:left;">Akreditasi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $prodi = [
            ['Teknik Informatika',      'S1', 'Baik Sekali'],
            ['Sistem Informasi',        'S1', 'Baik Sekali'],
            ['Manajemen',               'S1', 'Baik'],
            ['Akuntansi',               'S1', 'Baik'],
            ['Ilmu Hukum',              'S1', 'Baik'],
        ];
        foreach ($prodi as $i => $p): ?>
        <tr style="background:<?= $i % 2 === 0 ? '#f9f9f9' : '#fff' ?>;">
            <td style="padding:9px 10px; border-bottom:1px solid #e0e0e0;"><?= $p[0] ?></td>
            <td style="padding:9px 10px; border-bottom:1px solid #e0e0e0;"><?= $p[1] ?></td>
            <td style="padding:9px 10px; border-bottom:1px solid #e0e0e0;"><?= $p[2] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>