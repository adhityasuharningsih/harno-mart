<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\BrgmasukModel;
use App\Models\BrgkeluarModel;
use App\Models\SupplierModel;

class Pages extends BaseController
{

    // Controller HOME atau Tampilan utama
    public function index()
    {
        $data = [
            'title' => 'Home | Harno-Mart',
            'kategori' => (new KategoriModel())->findAll(),
            'brgmasuk' => (new BrgmasukModel())->findAll(),
            'brgkeluar' => (new BrgkeluarModel())->findAll(),
            'supplier' => (new SupplierModel())->findAll()
        ];

        // Mennampilkan Section dr halaman yg memanggil halaman ini
        return view('pages/dashboard', $data);
    }
}
