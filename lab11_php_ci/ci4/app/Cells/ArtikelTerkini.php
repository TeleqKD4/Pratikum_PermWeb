<?php

namespace App\Cells;

use App\Models\ArtikelModel;

class ArtikelTerkini  // <-- hapus "extends Cell"
{
    public function render(?string $kategori = null, int $limit = 5): string
    {
        $model = new ArtikelModel();

       $builder = $model->orderBy('id', 'DESC');
       
        if ($kategori !== null) {
            $builder = $builder->where('kategori', $kategori);
        }

        $artikel = $builder->limit($limit)->findAll();

        return view('components/artikel_terkini', [
            'artikel'  => $artikel,
            'kategori' => $kategori,
        ]);
    }
}