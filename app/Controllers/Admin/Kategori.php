<?php

namespace App\Controllers\Admin;

//memanggil Controller
use \App\Controllers\BaseController;
//Memanggil models
use \App\Models\KategoriModel;

class Kategori extends BaseController
{
    public function index()
    {
        $data = [
            'title' => "Kategori Barang | Harno-Mart",
            'validation' => \Config\Services::validation(),
            // Menampilkan semua data pada tabel kategori
            'kategori' => (new KategoriModel())->findAll(),
            // menampilkan kode 
            'kode' => (new KategoriModel())->kodeKategori()
        ];
        return view('kategori/kategori', $data);
    }

    // Menyimpan inputan dr form ke database
    public function simpan()
    {
        // validasi Input
        if (!$this->validate([
            'nm_kategori' => [
                'rules' => 'required|is_unique[kategori.nm_kategori]',
                'errors' => [
                    'required' => 'Nama Kategori  harus diisi',
                    'is_unique' => 'Nama Kategori sudah ada'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/admin/kategori/index')->withInput()->with('validation', $validation);
            session()->setFlashdata('validation');
        }

        // insert data ke database
        (new KategoriModel())->insert([
            'id_kategori' => $this->request->getVar('id_kategori'),
            'nm_kategori' => $this->request->getVar('nm_kategori')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/admin/kategori');

        // dd($this->request->getVar());
    }

    // ubah data
    public function ubah()
    {
        $single = (new KategoriModel())->find($_POST['id_kategori']);
        if ($_POST['nm_kategori'] == $single['nm_kategori']) {
            $rule_nama = 'required';
        } else {
            $rule_nama = 'required|is_unique[kategori.nm_kategori]';
        }
        // validasi Input
        if (!$this->validate([
            'nm_kategori' => [
                'rules' => $rule_nama,
                'errors' => [
                    'required' => 'Nama Kategori  harus diisi',
                    'is_unique' => 'Nama Kategori sudah ada'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/admin/kategori/index/' . $_POST['id_kategori'])->withInput()->with('validation', $validation);
            session()->setFlashdata('validation');
        }
        (new KategoriModel())->save([
            'id_kategori' => $this->request->getVar('id_kategori'),
            'nm_kategori' => $this->request->getVar('nm_kategori')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil dirubah');

        return redirect()->to('/admin/kategori');
    }

    //Hapus data
    public function hapus($id)
    {
        // d($id);
        (new KategoriModel())->delete($id);

        session()->setFlashdata('pesan', 'Data ' . $id . ' berhasil dihapus');

        return redirect()->to('/admin/kategori');
    }

    // menemukan id kategori agar bisa dibaca javascripst
    public function getKategoribyId()
    {
        echo json_encode((new KategoriModel())->find($_POST['id_kategori']));
    }
}
