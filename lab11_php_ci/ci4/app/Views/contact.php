<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h1><?= esc($title); ?></h1>
<hr>

<div style="display:flex; gap:32px; flex-wrap:wrap;">

    <!-- Info Kontak -->
    <div style="flex:1; min-width:220px;">
        <h2>Informasi Kontak</h2>
        <table style="margin-top:10px; border-collapse:collapse; width:100%;">
            <tr>
                <td style="padding:8px 0; font-weight:600; width:36px;">📍</td>
                <td style="padding:8px 0;">Jl. Inspeksi Kalimalang No.1, Cibitung,<br>Bekasi, Jawa Barat 17520</td>
            </tr>
            <tr>
                <td style="padding:8px 0;">📞</td>
                <td style="padding:8px 0;">(021) 8936499</td>
            </tr>
            <tr>
                <td style="padding:8px 0;">✉️</td>
                <td style="padding:8px 0;">info@pelitabangsa.ac.id</td>
            </tr>
            <tr>
                <td style="padding:8px 0;">🌐</td>
                <td style="padding:8px 0;"><a href="https://pelitabangsa.ac.id" target="_blank">pelitabangsa.ac.id</a></td>
            </tr>
            <tr>
                <td style="padding:8px 0;">🕐</td>
                <td style="padding:8px 0;">Senin – Jumat: 08.00 – 16.00 WIB</td>
            </tr>
        </table>
    </div>

    <!-- Form Kontak -->
    <div style="flex:2; min-width:280px;">
        <h2>Kirim Pesan</h2>
        <div style="margin-top:10px;">
            <div style="margin-bottom:14px;">
                <label style="display:block; font-weight:600; margin-bottom:4px;">Nama Lengkap</label>
                <input type="text" placeholder="Masukkan nama Anda"
                    style="width:100%; padding:9px 12px; border:1px solid #ccc;
                           border-radius:5px; font-size:14px; box-sizing:border-box;">
            </div>
            <div style="margin-bottom:14px;">
                <label style="display:block; font-weight:600; margin-bottom:4px;">Email</label>
                <input type="email" placeholder="contoh@email.com"
                    style="width:100%; padding:9px 12px; border:1px solid #ccc;
                           border-radius:5px; font-size:14px; box-sizing:border-box;">
            </div>
            <div style="margin-bottom:14px;">
                <label style="display:block; font-weight:600; margin-bottom:4px;">Subjek</label>
                <input type="text" placeholder="Subjek pesan"
                    style="width:100%; padding:9px 12px; border:1px solid #ccc;
                           border-radius:5px; font-size:14px; box-sizing:border-box;">
            </div>
            <div style="margin-bottom:16px;">
                <label style="display:block; font-weight:600; margin-bottom:4px;">Pesan</label>
                <textarea rows="5" placeholder="Tuliskan pesan Anda di sini..."
                    style="width:100%; padding:9px 12px; border:1px solid #ccc;
                           border-radius:5px; font-size:14px; box-sizing:border-box; resize:vertical;"></textarea>
            </div>
            <button style="background:#1a73e8; color:#fff; border:none; padding:10px 24px;
                           border-radius:5px; font-size:14px; cursor:pointer;">
                Kirim Pesan
            </button>
        </div>
    </div>

</div>

<?= $this->endSection() ?>