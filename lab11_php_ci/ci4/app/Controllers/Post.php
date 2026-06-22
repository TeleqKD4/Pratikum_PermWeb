<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Post extends ResourceController
{
    protected $modelName = 'App\Models\ArtikelModel';
    protected $format    = 'json';

    // Mengambil semua artikel (GET)
    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    // Mengambil detail artikel (GET)
    public function show($id = null)
    {
        $data = $this->model->find($id);
        if ($data) {
            return $this->respond($data);
        }
        return $this->failNotFound('Artikel tidak ditemukan');
    }

    // Menambah artikel baru (POST)
    public function create()
    {
        $data = [
            'judul' => $this->request->getPost('judul'),
            'isi'   => $this->request->getPost('isi'),
            'slug'  => url_title($this->request->getPost('judul'), '-', true),
        ];

        if ($this->model->insert($data)) {
            return $this->respondCreated(['message' => 'Data artikel berhasil dibuat']);
        }
        return $this->fail($this->model->errors());
    }

    // Menghapus artikel (DELETE)
    public function delete($id = null)
    {
        $data = $this->model->find($id);
        if ($data) {
            $this->model->delete($id);
            return $this->respondDeleted(['message' => 'Data artikel berhasil dihapus']);
        }
        return $this->failNotFound('Artikel tidak ditemukan');
    }
}