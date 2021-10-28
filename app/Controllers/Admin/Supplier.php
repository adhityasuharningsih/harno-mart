<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SupplierModel;

class Supplier extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Supplier | Harno-Mart',
            'validation' => \Config\Services::validation(),

            // Menampilkan data supplier dari database
            'supplier' => (new SupplierModel())->findAll(),
            'kode' => (new SupplierModel())->kodesupplier()
        ];

        return view('/supplier/supplier', $data);
    }

    public function simpan()
    {
        //Validasi
        if (!$this->validate([
            'nm_supplier' => [
                'rules' => 'required|is_unique[supplier.nm_supplier]',
                'errors' => [
                    'required' => '<b>Nama</b> supplier harus diisi',
                    'is_unique' => '<b>Nama</b> supplier sudah ada'
                ]
            ],
            'alamat' => [
                'rules' => 'required[supplier.alamat]',
                'errors' => ['required' => '<b>Alamat</b> supplier harus diisi']
            ],
            'no_hp' => [
                'rules' => 'required[supplier.no_hp]',
                'errors' => ['required' => '<b>No Telefon</b> supplier harus diisi']
            ],

        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/admin/supplier/index')->withInput()->with('validation', $validation);

            session()->getFlashdata('validation');
        }

        (new SupplierModel())->insert([
            'id_supplier' => $this->request->getVar('id_supplier'),
            'nm_supplier' => $this->request->getVar('nm_supplier'),
            'alamat' => $this->request->getVar('alamat'),
            'no_hp' => $this->request->getVar('no_hp'),
            'email' => $this->request->getVar('email')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/admin/supplier');
        // dd($this->request->getVar());
    }

    public function ubah()
    {
        //agar ketika merubah data tak muncul notif nama data sudah ada
        $single = (new SupplierModel())->find($_POST['id_supplier']);
        if ($_POST['nm_supplier'] == $single['nm_supplier']) {
            $rule_nama = 'required';
        } else {
            $rule_nama = 'required|is_unique[supplier.nm_supplier]';
        }
        // validasi Ubah
        if (!$this->validate([
            'nm_supplier' => [
                'rules' => $rule_nama,
                'errors' => [
                    'required' => '<b>Nama</b> barang  harus diisi',
                    'is_unique' => '<b>Nama</b> barang sudah ada'
                ]
            ]
        ])) {

            $validation = \Config\Services::validation();
            return redirect()->to('/admin/supplier/index' . $_POST['id_supplier'])->withInput()->with('validation', $validation);
            session()->setFlashdata('validation');
        }

        (new SupplierModel())->save([
            'id_supplier' => $this->request->getVar('id_supplier'),
            'nm_supplier' => $this->request->getVar('nm_supplier'),
            'alamat' => $this->request->getVar('alamat'),
            'no_hp' => $this->request->getVar('no_hp'),
            'email' => $this->request->getVar('email')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/admin/supplier');
    }

    public function hapus($id)
    {
        (new SupplierModel())->delete($id);

        session()->setFlashdata('pesan', 'Data <b>' . $id .  '</b> berhasil dihapus');
        return redirect()->to('/admin/supplier');
    }


    // Menampilkan value dr java script berdasarkan id yang dipilih
    public function getSupplierbyId()
    {
        echo json_encode((new SupplierModel())->find($_POST['id_supplier']));
    }
}
