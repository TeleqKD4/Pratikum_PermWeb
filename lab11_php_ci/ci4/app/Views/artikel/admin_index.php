<?= $this->include('template/admin_header'); ?>

<h2><?= $title; ?></h2>

<a href="<?= base_url('admin/artikel/add'); ?>" class="btn btn-success mb-3">Tambah Artikel</a>

<form id="searchForm" class="mb-3">
    <div class="row">
        <div class="col-md-3 mb-2">
            <input type="text" id="searchBox" class="form-control" placeholder="Cari judul artikel...">
        </div>
        <div class="col-md-3 mb-2">
            <select id="categoryFilter" class="form-control">
                <option value="">Semua Kategori</option>
                <?php foreach($kategori as $k): ?>
                    <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3 mb-2">
            <select id="sortFilter" class="form-control">
                <option value="id-DESC">Terbaru Ke Terlama</option>
                <option value="id-ASC">Terlama Ke Terbaru</option>
                <option value="judul-ASC">Judul A-Z</option>
                <option value="judul-DESC">Judul Z-A</option>
            </select>
        </div>
        <div class="col-md-3 mb-2">
            <button type="submit" class="btn btn-primary btn-block">Cari</button>
        </div>
    </div>
</form>

<div id="loadingIndicator" style="display: none;" class="text-center mb-3">
    <i>Memuat data, mohon tunggu...</i>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="artikelTableBody">
        </tbody>
</table>

<div id="paginationContainer" class="d-flex justify-content-center mt-3"></div>

<script src="<?= base_url('assets/js/jquery.min.js'); ?>"></script>

<script>
$(document).ready(function() {
    const searchForm = $('#searchForm');
    const searchBox = $('#searchBox');
    const categoryFilter = $('#categoryFilter');
    const sortFilter = $('#sortFilter');
    const tableBody = $('#artikelTableBody');
    const paginationContainer = $('#paginationContainer');
    const loadingIndicator = $('#loadingIndicator');

    // Fungsi utama untuk mengambil data via AJAX
    function loadData(page = 1) {
        let q = searchBox.val();
        let kat = categoryFilter.val();
        let sortVal = sortFilter.val().split('-'); // Memecah id-DESC menjadi id dan DESC

        // URL dengan parameter
        let url = "<?= base_url('admin/artikel') ?>?page=" + page + "&q=" + encodeURIComponent(q) + "&kategori_id=" + kat + "&sort_by=" + sortVal[0] + "&sort_order=" + sortVal[1];

        // Tampilkan indikator loading (Tugas 3)
        loadingIndicator.show();
        tableBody.css('opacity', '0.4'); // Tabel dibuat sedikit transparan

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                loadingIndicator.hide();
                tableBody.css('opacity', '1');

                let html = '';
                // 1. Tampilkan Data ke Tabel
                if(response.artikel && response.artikel.length > 0) {
                    response.artikel.forEach(function(row) {
                        let namaKat = row.nama_kategori ? row.nama_kategori : 'Tanpa Kategori';
                        let statusKat = row.status ? row.status : 'Aktif';

                        html += '<tr>';
                        html += '<td>' + row.id + '</td>';
                        html += '<td><b>' + row.judul + '</b></td>';
                        html += '<td>' + namaKat + '</td>';
                        html += '<td>' + statusKat + '</td>';
                        html += '<td>';
                        html += '<a href="<?= base_url('admin/artikel/edit/') ?>' + row.id + '" class="btn btn-sm btn-info mr-1">Ubah</a> ';
                        html += '<a href="<?= base_url('admin/artikel/delete/') ?>' + row.id + '" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin hapus?\')">Hapus</a>';
                        html += '</td>';
                        html += '</tr>';
                    });
                } else {
                    html = '<tr><td colspan="5" class="text-center">Data artikel tidak ditemukan.</td></tr>';
                }
                tableBody.html(html);

                // 2. Buat Navigasi Pagination
                let paginationHtml = '';
                if(response.pager && response.pager.pageCount > 1) {
                    paginationHtml += '<ul class="pagination">';
                    for(let i = 1; i <= response.pager.pageCount; i++) {
                        let activeClass = (i == response.pager.currentPage) ? 'active' : '';
                        paginationHtml += '<li class="page-item ' + activeClass + '"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>';
                    }
                    paginationHtml += '</ul>';
                }
                paginationContainer.html(paginationHtml);
            },
            error: function() {
                loadingIndicator.hide();
                tableBody.css('opacity', '1');
                tableBody.html('<tr><td colspan="5" class="text-center text-danger">Gagal memuat data dari server!</td></tr>');
            }
        });
    }

    // Trigger (Pemicu) Pencarian
    searchForm.on('submit', function(e) {
        e.preventDefault(); // Mencegah form reload halaman
        loadData(1);
    });

    // Trigger ketika Kategori atau Urutan (Sorting) diubah
    categoryFilter.on('change', function() { loadData(1); });
    sortFilter.on('change', function() { loadData(1); });

    // Trigger ketika tombol angka Halaman diklik
    $(document).on('click', '.page-link', function(e) {
        e.preventDefault();
        let page = $(this).data('page');
        if(page) {
            loadData(page);
        }
    });

    // Jalankan pengambilan data pertama kali saat halaman dibuka
    loadData(1);
});
</script>

<?= $this->include('template/admin_footer'); ?>