<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ArtikelModel;

class AjaxController extends BaseController
{
    public function index()
    {
        // Menambahkan judul halaman
        $data['title'] = "Data Artikel (AJAX)";
        return view('ajax/index', $data);
    }

    public function getData()
    {
        $model = new ArtikelModel();
        // Mengambil semua data artikel
        $data = $model->findAll();
        
        // Kirim data dalam format JSON
        return $this->response->setJSON($data);
    }

    public function delete($id)
    {
        $model = new ArtikelModel();
        $model->delete($id);
        
        $data = [
            'status' => 'OK'
        ];
        // Kirim data dalam format JSON
        return $this->response->setJSON($data);
    }
}