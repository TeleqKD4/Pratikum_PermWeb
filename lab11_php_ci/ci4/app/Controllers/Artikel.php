<?php
namespace App\Controllers;

use App\Models\ArtikelModel;
use App\Models\KategoriModel;

class Artikel extends BaseController
{
    public function index()
    {
        $title  = 'Daftar Artikel';
        $model  = new ArtikelModel();
        $artikel = $model->getArtikelDenganKategori(); // Gunakan method join yang baru
        
        return view('artikel/index', compact('artikel', 'title'));
    }

    public function admin_index()
    {
        $title = 'Daftar Artikel (Admin)';
        $model = new ArtikelModel();
        $kategoriModel = new KategoriModel();

        // Mengambil input pencarian, filter, dan halaman
        $q = $this->request->getVar('q') ?? '';
        $kategori_id = $this->request->getVar('kategori_id') ?? '';
        
        // TUGAS 4: Parameter Sorting
        $sort_by = $this->request->getVar('sort_by') ?? 'id';
        $sort_order = $this->request->getVar('sort_order') ?? 'DESC';

        $builder = $model->select('artikel.*, kategori.nama_kategori')
                         ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left');

        if ($q != '') {
            $builder->like('artikel.judul', $q);
        }
        
        if ($kategori_id != '') {
            $builder->where('artikel.id_kategori', $kategori_id);
        }

      
        $builder->orderBy('artikel.' . $sort_by, $sort_order);

      
        $artikel = $builder->paginate(5); 
        $pager = $model->pager;

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'artikel' => $artikel,
                'pager'   => [
                    'currentPage' => $pager->getCurrentPage(),
                    'pageCount'   => $pager->getPageCount()
                ]
            ]);
        }

        $data = [
            'title'       => $title,
            'kategori'    => $kategoriModel->findAll(),
        ];

        return view('artikel/admin_index', $data);
    }

    public function add()
    {
        // Validasi input + file upload (tipe & ukuran)
        $rules = [
            'judul'       => 'required',
            'id_kategori' => 'required|integer',
            // File gambar boleh kosong (artikel tanpa gambar), tapi kalau ada harus valid
            'gambar'      => 'is_image[gambar]|max_size[gambar,2048]|mime_in[gambar,image/jpg,image/jpeg,image/png,image/gif,image/webp]',
        ];

        if ($this->request->getMethod() == 'POST' && $this->validate($rules)) {
            $model = new ArtikelModel();

            // --- PROSES UPLOAD GAMBAR ---
            $file     = $this->request->getFile('gambar');
            $namaFile = '';

            if ($file && $file->isValid() && !$file->hasMoved()) {
                // Pastikan folder ada (auto-create)
                $uploadPath = ROOTPATH . 'public/gambar';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                // Generate nama random untuk mencegah nama bentrok
                $newName = $file->getRandomName();
                $file->move($uploadPath, $newName);
                $namaFile = $newName;
            }
            // ----------------------------

            $model->insert([
                'judul'       => $this->request->getPost('judul'),
                'isi'         => $this->request->getPost('isi'),
                'slug'        => url_title($this->request->getPost('judul'), '-', true),
                'id_kategori' => $this->request->getPost('id_kategori'),
                'gambar'      => $namaFile,
            ]);

            session()->setFlashdata('success', 'Artikel berhasil ditambahkan.');
            return redirect()->to('/admin/artikel');
        } else {
            $kategoriModel = new KategoriModel();
            $data = [
                'title'       => 'Tambah Artikel',
                'kategori'    => $kategoriModel->findAll(),
                'validation'  => \Config\Services::validation(), // kirim error ke view
            ];
            return view('artikel/form_add', $data);
        }
    }

   public function edit($id)
    {
        $model = new ArtikelModel();
        $artikelLama = $model->find($id);

        if (empty($artikelLama)) {
            session()->setFlashdata('error', 'Artikel tidak ditemukan.');
            return redirect()->to('/admin/artikel');
        }

        $rules = [
            'judul'       => 'required',
            'id_kategori' => 'required|integer',
            'gambar'      => 'is_image[gambar]|max_size[gambar,2048]|mime_in[gambar,image/jpg,image/jpeg,image/png,image/gif,image/webp]',
        ];

        if ($this->request->getMethod() == 'POST' && $this->validate($rules)) {
            $file     = $this->request->getFile('gambar');
            $namaFile = $artikelLama['gambar']; // default: pakai gambar lama

            $uploadPath = ROOTPATH . 'public/gambar';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Kalau ada upload baru
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move($uploadPath, $newName);
                $namaFile = $newName;

                // Hapus gambar lama (kalau ada)
                if (!empty($artikelLama['gambar']) && file_exists($uploadPath . '/' . $artikelLama['gambar'])) {
                    unlink($uploadPath . '/' . $artikelLama['gambar']);
                }
            }

            $model->update($id, [
                'judul'       => $this->request->getPost('judul'),
                'isi'         => $this->request->getPost('isi'),
                'id_kategori' => $this->request->getPost('id_kategori'),
                'gambar'      => $namaFile,
            ]);

            session()->setFlashdata('success', 'Artikel berhasil diperbarui.');
            return redirect()->to('/admin/artikel');
        } else {
            $kategoriModel = new KategoriModel();
            $data = [
                'title'       => 'Edit Artikel',
                'artikel'     => $artikelLama,
                'kategori'    => $kategoriModel->findAll(),
                'validation'  => \Config\Services::validation(),
            ];
            return view('artikel/form_edit', $data);
        }
    }

    public function delete($id)
    {
        $model = new ArtikelModel();

        // Hapus juga file gambar di server (kalau ada)
        $artikel = $model->find($id);
        if ($artikel && !empty($artikel['gambar'])) {
            $filePath = ROOTPATH . 'public/gambar/' . $artikel['gambar'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $model->delete($id);
        session()->setFlashdata('success', 'Artikel berhasil dihapus.');
        return redirect()->to('/admin/artikel');
    }

    public function view($slug)
    {
        $model = new ArtikelModel();
        
        // Modifikasi khusus untuk menjawab TUGAS No. 2 (Menampilkan kategori di detail)
        $data['artikel'] = $model->select('artikel.*, kategori.nama_kategori')
                                 ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left')
                                 ->where('slug', $slug)
                                 ->first();

        if (empty($data['artikel'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Artikel tidak ditemukan.');
        }

        $data['title'] = $data['artikel']['judul'];
        return view('artikel/detail', $data);
    }
}