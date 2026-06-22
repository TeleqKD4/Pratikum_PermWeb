<?= $this->include('template/admin_header'); ?>
<h2><?= $title; ?></h2>

<form action="" method="post" enctype="multipart/form-data">
    <?= csrf_field(); ?>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $err): ?>
                    <li><?= esc($err); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <p>
        <label for="judul">Judul</label>
        <input type="text" name="judul" value="<?= $artikel['judul']; ?>" id="judul" class="form-control" required>
    </p>
    <p>
        <label for="id_kategori">Kategori</label>
        <select name="id_kategori" id="id_kategori" class="form-control" required>
            <?php foreach($kategori as $k): ?>
                <option value="<?= $k['id_kategori']; ?>" <?= ($artikel['id_kategori'] == $k['id_kategori']) ? 'selected' : ''; ?>>
                    <?= $k['nama_kategori']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>
    <p>
        <label for="isi">Isi</label>
        <textarea name="isi" id="isi" cols="50" rows="10" class="form-control"><?= $artikel['isi']; ?></textarea>
    </p>

    <?php if (!empty($artikel['gambar'])): ?>
        <p>
            <label>Gambar Saat Ini:</label><br>
            <img src="<?= base_url('/gambar/' . $artikel['gambar']); ?>" width="150" alt="Gambar Artikel" style="margin-bottom: 10px;"><br>
            <small style="color: gray;">Biarkan/kosongkan jika tidak ingin mengubah gambar.</small>
        </p>
    <?php endif; ?>

    <p>
        <label for="gambar">Pilih Gambar Artikel</label><br>
        <input type="file" name="gambar" id="gambar">
    </p>

    <p><input type="submit" value="Kirim" class="btn btn-primary btn-large"></p>
</form>
<?= $this->include('template/admin_footer'); ?>