<?= $this->include('template/admin_header'); ?>

<h2><?= $title; ?></h2>

<a href="<?= base_url('admin/artikel/add'); ?>" class="btn btn-success mb-3">Tambah Artikel</a>

<table class="table table-bordered" id="artikelTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

<script src="<?= base_url('assets/js/jquery.min.js'); ?>"></script>

<script>
$(document).ready(function() {
    // Fungsi untuk menampilkan pesan loading
    function showLoadingMessage() {
        $('#artikelTable tbody').html('<tr><td colspan="4" class="text-center">Loading data...</td></tr>');
    }

    // Fungsi untuk memuat data menggunakan AJAX
    function loadData() {
        showLoadingMessage(); 

        $.ajax({
            url: "<?= base_url('ajax/getData') ?>",
            method: "GET",
            dataType: "json",
            success: function(data) {
                var tableBody = "";
                
                // Mengecek apakah ada data di database
                if (data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        var row = data[i];
                        tableBody += '<tr>';
                        tableBody += '<td>' + row.id + '</td>';
                        tableBody += '<td>' + row.judul + '</td>';
                        // Memberikan nilai default "Aktif" jika status kosong
                        tableBody += '<td>' + (row.status ? row.status : 'Aktif') + '</td>';
                        
                        tableBody += '<td>';
                        // TUGAS: Mengaktifkan fungsi Ubah (Edit) data
                        tableBody += '<a href="<?= base_url('admin/artikel/edit/') ?>' + row.id + '" class="btn btn-sm btn-primary mr-1">Edit</a>';
                        // Tombol Hapus (Delete)
                        tableBody += '<a href="#" class="btn btn-sm btn-danger btn-delete" data-id="' + row.id + '">Hapus</a>';
                        tableBody += '</td>';
                        
                        tableBody += '</tr>';
                    }
                } else {
                    tableBody = '<tr><td colspan="4" class="text-center">Belum ada data.</td></tr>';
                }
                
                // Memasukkan data ke dalam tabel html
                $('#artikelTable tbody').html(tableBody);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#artikelTable tbody').html('<tr><td colspan="4" class="text-center text-danger">Gagal memuat data.</td></tr>');
            }
        });
    }

    // Memanggil fungsi loadData() saat halaman pertama kali dibuka
    loadData();

    // Fungsi aksi ketika tombol hapus diklik
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        
        if (confirm('Apakah Anda yakin ingin menghapus artikel ini?')) {
            $.ajax({
                // Menggunakan method POST untuk menghindari error routing bawaan CI4 pada DELETE
                url: "<?= base_url('ajax/delete/') ?>" + id,
                method: "POST", 
                success: function(response) {
                    // Jika berhasil dihapus, panggil loadData() untuk refresh tabel tanpa reload halaman
                    loadData(); 
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error deleting article: ' + textStatus + ' ' + errorThrown);
                }
            });
        }
    });
});
</script>

<?= $this->include('template/admin_footer'); ?>