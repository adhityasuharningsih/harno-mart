<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\BrgmasukModel;

class Barang extends BaseController
{
    
    public function index()
    {
        $data = [
            'title' => 'Barang | Harno-Mart',
            'validation' => \Config\Services::validation(),


            // Menampilkan semua data pada tabel Barang
            'brg' => (new BrgmasukModel())->findAll(),
            'barang' => (new BarangModel())->getKategori(),
            'kategori' => (new KategoriModel())->findAll(),
            'kode' => (new BarangModel())->kodebarang()

        ];
        return view('/barang/barang', $data);
    }

    public function simpan()
    {
        // validasi Input
        if (!$this->validate([
            'nm_barang' => [
                'rules' => 'required|is_unique[barang.nm_barang]',
                'errors' => [
                    'required' => '<b>Nama</b> barang  harus diisi',
                    'is_unique' => '<b>Nama</b> barang sudah ada'
                ]
            ],
            'satuan' => [
                'rules' => 'required[barang.satuan]',
                'errors' => ['required' => '<b>Satuan</b> barang  harus diisi']
            ],
            'harga' => [
                'rules' => 'required[barang.harga]',
                'errors' => ['required' => '<b>Harga</b> barang  harus diisi']
            ],
            'stok' => [
                'rules' => 'required[barang.stok]',
                'errors' => ['required' => '<b>Stok</b> barang  harus diisi']
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/admin/barang/index')->withInput()->with('validation', $validation);
            session()->setFlashdata('validation');
        }

        // insert data ke database
        (new BarangModel())->insert([
            'id_barang' => $this->request->getVar('id_barang'),
            'nm_barang' => $this->request->getVar('nm_barang'),
            'kategori' => $this->request->getVar('kategori'),
            'satuan' => $this->request->getVar('satuan'),
            'harga' => $this->request->getVar('harga'),
            'stok' => $this->request->getVar('stok')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/admin/barang');
    }

    public function ubah()
    {
        $single = (new BarangModel())->find($_POST['id_barang']);
        if ($_POST['nm_barang'] == $single['nm_barang']) {
            $rule_nama = 'required';
        } else {
            $rule_nama = 'required|is_unique[barang.nm_barang]';
        }
        // validasi Ubah
        if (!$this->validate([
            'nm_barang' => [
                'rules' => $rule_nama,
                'errors' => [
                    'required' => '<b>Nama</b> barang  harus diisi',
                    'is_unique' => '<b>Nama</b> barang sudah ada'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/admin/barang/index' . $_POST['id_barang'])->withInput()->with('validation', $validation);
            session()->setFlashdata('validation');
        }

        (new BarangModel())->save([
            'id_barang' => $this->request->getVar('id_barang'),
            'nm_barang' => $this->request->getVar('nm_barang'),
            'kategori' => $this->request->getVar('kategori'),
            'satuan' => $this->request->getVar('satuan'),
            'harga' => $this->request->getVar('harga'),
            'stok' => $this->request->getVar('stok')
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/admin/barang');
    }

    //Hapus data
    public function hapus($id)
    {
        // d($id);
        (new BarangModel())->delete($id);

        session()->setFlashdata('pesan', 'Data ' . $id . ' berhasil dihapus');

        return redirect()->to('/admin/barang');
    }


    // cetak laporan 
    public function cetaklaporan()
    {
        $data = [
            'title' => 'Laporan Stok | Harno-Mart',
            'barang' => (new BarangModel())->getKategori(),
            'tgl' => date('d F Y'),
            date_default_timezone_set('Asia/Jakarta')
        ];

        return view('/barang/laporan-stok', $data);
    }

    // Menampilkan value dr java script berdasarkan id yang dipilih
    public function getBarangbyId()
    {
        echo json_encode((new BarangModel())->find($_POST['id_barang']));
    }
}
