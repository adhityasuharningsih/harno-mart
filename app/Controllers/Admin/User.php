<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;



class User extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Pengguna | Harno-Mart',
            'validation' => \Config\Services::validation(),

            'user' => (new UserModel())->findAll(),
            'kode' => (new UserModel())->kodeuser()
        ];

        return view('user/user', $data);
    }

    public function simpan()
    {
        //Validasi
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[user.nama]',
                'errors' => [
                    'required' => '<b>Nama</b> user harus diisi',
                    'is_unique' => '<b>Nama</b> user sudah ada'
                ]
            ],
            'alamat' => [
                'rules' => 'required[user.alamat]',
                'errors' => ['required' => '<b>Alamat</b> user harus diisi']
            ],
            'no_hp' => [
                'rules' => 'required[user.no_hp]',
                'errors' => ['required' => '<b>No Telefon</b> user harus diisi']
            ],
            'username' => [
                'rules' => 'required[user.username]',
                'errors' => ['required' => '<b>Username</b> user harus diisi']
            ],
            'password' => [
                'rules' => 'required[user.password]',
                'errors' => ['required' => '<b>Password</b> user harus diisi']
            ],
            'level' => [
                'rules' => 'required[user.level]',
                'errors' => ['required' => '<b>Level</b> user harus diisi']
            ]

        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/admin/user/index')->withInput()->with('validation', $validation);

            session()->getFlashdata('validation');
        }

        (new UserModel())->insert([
            'id_user' => $this->request->getVar('id_user'),
            'nama' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),
            'no_hp' => $this->request->getVar('no_hp'),
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'level' => $this->request->getVar('level')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/admin/user');
    }

    public function ubah()
    {
        //agar ketika merubah data tak muncul notif nama data sudah ada
        $single = (new UserModel())->find($_POST['id_user']);
        if ($_POST['nama'] == $single['nama']) {
            $rule_nama = 'required';
        } else {
            $rule_nama = 'required|is_unique[user.nama]';
        }

        //Validasi
        if (!$this->validate([
            'nama' => [
                'rules' => $rule_nama,
                'errors' => [
                    'required' => '<b>Nama</b> user harus diisi',
                    'is_unique' => '<b>Nama</b> user sudah ada'
                ]
            ]

        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/admin/user/index' . $_POST['id_user'])->withInput()->with('validation', $validation);

            session()->getFlashdata('validation');
        }

        (new UserModel())->save([
            'id_user' => $this->request->getVar('id_user'),
            'nama' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),
            'no_hp' => $this->request->getVar('no_hp'),
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'level' => $this->request->getVar('level')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/admin/user');
    }

    public function hapus($id)
    {
        (new UserModel())->delete($id);

        session()->setFlashdata('pesan', 'Data <b>' . $id .  '</b> berhasil dihapus');
        return redirect()->to('/admin/user');
    }

    public function getUserbyId()
    {
        echo json_encode((new UserModel())->find($_POST['id_user']));
    }
}
