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
        <input type="text" name="judul" id="judul" class="form-control" value="<?= old('judul'); ?>" required>
    </p>
    <p>
        <label for="id_kategori">Kategori</label>
        <select name="id_kategori" id="id_kategori" class="form-control" required>
            <option value="">-- Pilih Kategori --</option>
            <?php foreach($kategori as $k): ?>
                <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
            <?php endforeach; ?>
        </select>
    </p>
    <p>
        <label for="isi">Isi</label>
        <textarea name="isi" id="isi" cols="50" rows="10" class="form-control"></textarea>
    </p>
    
    <p>
        <label for="gambar">Gambar Artikel</label><br>
        <input type="file" name="gambar" id="gambar">
    </p>
    
    <p><input type="submit" value="Kirim" class="btn btn-primary btn-large"></p>
</form>
<?= $this->include('template/admin_footer'); ?>