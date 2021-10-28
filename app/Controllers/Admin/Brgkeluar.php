<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BrgkeluarModel;
use App\Models\BarangModel;
use App\Models\ItemkeluarModel;

class Brgkeluar extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Barang Keluar | Harno-Mart',
            'validation' => \Config\Services::validation(),

            'brgkeluar' => (new BrgkeluarModel())->findAll()
        ];

        return view('/brgkeluar/tabel-brgkeluar', $data);
    }

    public function formbrgkeluar()
    {
        $session = session();
        $cartItem = 0;

        if (!empty($session->cart)) {
            $cartItem = (new BarangModel())->find($session->cart);
        }

        $data = [
            'title' => 'Barang Keluar | Harno-Mart',

            'barang' => (new BarangModel())->findAll(),
            'item' => $cartItem,

            'kode' => (new BrgkeluarModel())->kodebrgkeluar(),
            'tgl' => (new BrgkeluarModel())->tanggal(),
            date_default_timezone_set('Asia/Jakarta')
        ];

        return view('/brgkeluar/form-brgkeluar', $data);
    }


    // Cart Item
    public function addCart($id)
    {

        $session = session();

        // jika stok 0
        $barang = (new BarangModel())->find($id);
        if ($barang['stok'] > 0) {
            // untuk mengecek session cart
            if (!isset($session->cart) == true) {
                $cart = array($id);
                $session->set('cart', $cart);
            }

            // untuk mengecek id, agar tidak dobel
            if (!in_array($id, $session->cart)) {
                $cart = $session->cart;
                array_push($cart, $id);
                $session->set('cart', $cart);
            }
        } else
            session()->setFlashdata('gagal', 'Stok barang yang dipilih  kosong');


        // dd($session->cart);
        return redirect()->to('/admin/brgkeluar/formbrgkeluar');
    }

    public function deleteCart($id)
    {
        $session = session();
        $cart = $session->cart;

        $key = array_search($id, $cart);

        unset($cart[$key]);

        $session->set('cart', $cart);

        // $session->remove('cart');
        return redirect()->to('/admin/brgkeluar/formbrgkeluar');

        // dd($session->cart);
    }

    public function simpan()
    {

        // Input data tabel brg Keluar
        $session = session();
        // validasi 
        if (empty($session->cart)) {
            session()->setFlashdata('gagal', '<b>Gagal Menambahkan Barang Keluar </b>' . '<br>Item barang kosong');
            return redirect()->to('/admin/brgkeluar');
        }
        (new BrgkeluarModel())->insert([
            'id_brgkeluar' => $this->request->getVar('id_brgkeluar'),
            'catatan' => $this->request->getVar('catatan'),
            'total' => $this->request->getVar('total'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // input data itembrg Keluar
        $dataItem = (new BarangModel())->find($session->cart);
        $n = count($dataItem);

        // menyimpan data item berdasarkan item barang
        for ($i = 0; $i < $n; $i++) {
            $id_barang = $dataItem[$i]['id_barang'];
            $nm_barang = $dataItem[$i]['nm_barang'];
            $satuan = $dataItem[$i]['satuan'];
            $stok = $dataItem[$i]['stok'];
            // $harga = $dataItem[$i]['harga'];
            // $qty = $dataItem[$i]['qty'];

            (new ItemkeluarModel())->insert([
                'id_brgkeluar' => $_POST['id_brgkeluar'],
                'id_barang' => $id_barang,
                'nm_barang' => $nm_barang,
                'satuan' => $satuan,
                'harga' => $_POST['harga_' . $i + 1],
                'qty' => $_POST['qty_' . $i + 1]
                // 'id_brgmasuk' => $this->request->getVar('id_brgmasuk'),
            ]);

            (new BarangModel())->save([
                'id_barang' => $id_barang,
                'stok' => $stok - $_POST['qty_' . $i + 1]
            ]);
        }
        // dd($this->request->getVar());
        $session->remove('cart');
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/admin/brgkeluar/index');
    }

    // EDIT Start
    public function ubah($id)
    {
        $session = session();
        $cartItem = 0;

        if (!empty($session->newCart)) {
            $cartItem = (new BarangModel())->find($session->newCart);
        }

        $data = [
            'title' => 'Barang Keluar | Harno-Mart',

            'brgkeluar' => (new BrgkeluarModel())->find($id),
            'item' => (new ItemkeluarModel())->getItembyBarang($id),
            'barang' => (new BarangModel())->findAll(),
            'newItem' => $cartItem
        ];
        return view('/brgkeluar/ubah-brgkeluar', $data);
    }

    // Hapus item dalam edit data
    public function deleteItem($barang, $brgkeluar)
    {
        (new ItemkeluarModel())->where(['id_brgkeluar' => $brgkeluar, 'id_barang' => $barang])->delete();

        return redirect()->to('/admin/brgkeluar');
    }

    // menambahkan item baru dalam ubah data
    public function addNewitem($id, $brgkeluar)
    {
        $session = session();

        $item = (new ItemkeluarModel())->where(['id_brgkeluar' => $brgkeluar, 'id_barang => $id'])->find();

        if (empty($item)) {
            if (!isset($session->newCart) == true) {
                $cart = array($id);
                $session->set('newCart', $cart);
            }

            if (!in_array($id, $session->newCart)) {
                $cart = $session->newCart;
                array_push($cart, $id);
                $session->set('newCart', $cart);
            }
        }

        // dd($session->cart);
        return redirect()->to('/admin/keluar/ubah/' . $brgkeluar);
    }

    // Menghapus item dalam ubah data
    public function hapusNewitem($id, $brgkeluar)
    {
        $session = session();
        $cart = $session->newCart;

        $key = array_search($id, $cart);

        unset($cart[$key]);

        $session->set('newCart', $cart);

        return redirect()->to('/admin/brgkeluar/ubah/' . $brgkeluar);
    }

    // Hapus Pembelian

    public function hapus($id)
    {
        (new BrgkeluarModel())->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/admin/brgkeluar');
    }

    public function cetaklaporan()
    {
        $brgkeluar = (new BrgkeluarModel())->where(['created_at >=' => $_POST['tgl_awal'], 'created_at <=' => $_POST['tgl_akhir']])->findAll();

        if (!empty($brgkeluar)) {
            $data = [
                'title' => 'Laporan Barang Keluar | Harno-Mart',
                'tgl' => date('d F Y'),
                date_default_timezone_set('Asia/Jakarta'),

                'brgkeluar' => $brgkeluar,
                'tglawal' => $_POST['tgl_awal'],
                'tglakhir' => $_POST['tgl_akhir']
            ];
            return view('/brgkeluar/laporan-keluar', $data);
        } else {
            session()->setFlashdata('gagal', '<b> Gagal Menampilkan Laporan </b> <br>' . 'Tidak ada transaksi antara tanggal ' . $_POST['tgl_awal'] . 'sampai ' . $_POST['tgl_akhir']);
            return redirect()->to('/admin/brgkeluar');
        }
    }

    public function cetakdetail($id)
    {
        $data = [
            'title' => 'Cetak Detail Barang Keluar | Harno-Mart',
            'tgl' => date('d F Y'),
            date_default_timezone_set('Asia/Jakarta'),

            'brgkeluar' => (new BrgkeluarModel())->find($id),
            'item' => (new ItemkeluarModel())->getItembyBrgkeluar($id),
        ];
        return view('/brgkeluar/cetak-detailkeluar', $data);
    }


    // Menampilkan value dr java script berdasarkan id yang dipilih
    public function getItembyBrgkeluar()
    {
        echo json_encode((new ItemkeluarModel())->where('id_brgkeluar', $_POST['id_brgkeluar'])->findAll());
    }

    public function getBrgkeluarbyId()
    {
        echo json_encode((new BrgkeluarModel())->find($_POST['id_brgkeluar']));
    }
}
