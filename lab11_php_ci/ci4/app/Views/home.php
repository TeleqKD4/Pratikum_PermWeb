<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- Hero Banner -->
<div style="background:linear-gradient(135deg,#1a73e8,#0d47a1); color:#fff;
            padding:32px 28px; border-radius:8px; margin-bottom:28px;">
    <h1 style="font-size:1.8rem; margin-bottom:8px;">🎓 Selamat Datang di Website Kami</h1>
    <p style="opacity:0.9; font-size:1rem;">
        Universitas Pelita Bangsa – Mencetak generasi unggul, berkarakter, dan berdaya saing global.
    </p>
    <div style="margin-top:18px; display:flex; gap:12px; flex-wrap:wrap;">
        <a href="<?= base_url('/artikel') ?>"
           style="background:#fff; color:#1a73e8; padding:9px 20px;
                  border-radius:5px; font-weight:600; font-size:0.9rem;">
            📰 Lihat Artikel
        </a>
        <a href="<?= base_url('/about') ?>"
           style="background:rgba(255,255,255,0.15); color:#fff; padding:9px 20px;
                  border-radius:5px; font-weight:600; font-size:0.9rem;">
            Tentang Kami →
        </a>
    </div>
</div>

<!-- Info Cards -->
<div style="display:flex; gap:16px; flex-wrap:wrap; margin-bottom:28px;">
    <?php
    $cards = [
        ['🏛️', '5+',   'Program Studi Terakreditasi'],
        ['👨‍🎓', '10.000+', 'Mahasiswa Aktif'],
        ['👨‍🏫', '200+',  'Dosen Berpengalaman'],
        ['🤝', '50+',   'Mitra Industri'],
    ];
    foreach ($cards as $c): ?>
    <div style="flex:1; min-width:140px; background:#f0f6ff; border:1px solid #c5d9f7;
                border-radius:8px; padding:18px 14px; text-align:center;">
        <div style="font-size:1.8rem;"><?= $c[0] ?></div>
        <div style="font-size:1.4rem; font-weight:700; color:#1a73e8; margin:4px 0;"><?= $c[1] ?></div>
        <div style="font-size:0.8rem; color:#555;"><?= $c[2] ?></div>
    </div>
    <?php endforeach; ?>
</div>

<!-- Pengumuman -->
<h2 style="font-size:1.15rem; color:#1a73e8; border-left:4px solid #1a73e8;
           padding-left:10px; margin-bottom:14px;">📢 Pengumuman Terbaru</h2>
<ul style="list-style:none; padding:0; margin-bottom:28px;">
    <?php
    $pengumuman = [
        ['🗓️ 10 Mar 2026', 'Pendaftaran Mahasiswa Baru Gelombang 2 Dibuka'],
        ['🗓️ 05 Mar 2026', 'Jadwal Ujian Akhir Semester Genap 2025/2026'],
        ['🗓️ 28 Feb 2026', 'Seminar Nasional Teknologi Informasi – Gratis untuk Mahasiswa'],
        ['🗓️ 20 Feb 2026', 'Beasiswa Prestasi Akademik Semester Genap Dibuka'],
    ];
    foreach ($pengumuman as $p): ?>
    <li style="padding:12px 14px; border-bottom:1px solid #eee;
               display:flex; gap:14px; align-items:flex-start;">
        <span style="color:#888; font-size:0.8rem; white-space:nowrap; padding-top:2px;"><?= $p[0] ?></span>
        <span style="color:#333;"><?= $p[1] ?></span>
    </li>
    <?php endforeach; ?>
</ul>

<!-- Fasilitas -->
<h2 style="font-size:1.15rem; color:#1a73e8; border-left:4px solid #1a73e8;
           padding-left:10px; margin-bottom:14px;">🏫 Fasilitas Kampus</h2>
<div style="display:flex; gap:12px; flex-wrap:wrap; margin-bottom:10px;">
    <?php
    $fasilitas = [
        '🖥️ Laboratorium Komputer',
        '📚 Perpustakaan Digital',
        '🏋️ Pusat Olahraga',
        '🍽️ Kantin & Food Court',
        '🛜 WiFi Seluruh Area',
        '🚌 Shuttle Bus',
    ];
    foreach ($fasilitas as $f): ?>
    <div style="background:#f9f9f9; border:1px solid #e0e0e0; border-radius:20px;
                padding:7px 16px; font-size:0.88rem; color:#444;">
        <?= $f ?>
    </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>