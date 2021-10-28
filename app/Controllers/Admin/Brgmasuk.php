<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\BrgmasukModel;
use App\Models\ItemModel;
use App\Models\SupplierModel;


class Brgmasuk extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Barang Masuk | Harno-Mart',
            'supplier' => (new BrgmasukModel())->getSupplier()
        ];

        return view('/brgmasuk/tabel-brgmasuk', $data);
    }


    public function formbarang()
    {
        $session = session();
        $cartItem = 0;

        if (!empty($session->cart)) {
            $cartItem = (new BarangModel())->find($session->cart);
        }
        // dd($cartItem);
        $data = [
            'title' => 'Barang Masuk | Harno-Mart',

            'barang' => (new BarangModel())->findAll(),
            'item' => $cartItem,

            'supplier' => (new SupplierModel())->findAll(),
            'kode' => (new BrgmasukModel())->kodebrgmasuk(),
            'tgl' => (new BrgmasukModel())->tanggal(),
            date_default_timezone_set('Asia/Jakarta')
        ];

        return view('/brgmasuk/form-brgmasuk', $data);
    }

    // Tambah data barang masuk
    // Cart Item
    public function addCart($id)
    {

        $session = session();
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

        // dd($session->cart);
        return redirect()->to('/admin/brgmasuk/formbarang');
    }

    public function deleteCart($id)
    {
        $session = session();
        $cart = $session->cart;

        $key = array_search($id, $cart);

        unset($cart[$key]);

        $session->set('cart', $cart);

        // $session->remove('cart');
        return redirect()->to('/admin/brgmasuk/formbarang');

        // dd($session->cart);
    }

    // Simpan data barang masuk
    public function simpan()
    {
        $session = session();
        // validasi 
        if (empty($session->cart)) {
            session()->setFlashdata('gagal', '<b>Gagal Menambahkan Barang Masuk</b>' . '<br>Item barang kosong');
            return redirect()->to('/admin/brgmasuk');
        }
        // Input data tabel brg masuk
        (new BrgmasukModel())->insert([
            'id_brgmasuk' => $this->request->getVar('id_brgmasuk'),
            'id_supplier' => $this->request->getVar('supplier'),
            'foto_struk' => $this->request->getVar('gambar'),
            'catatan' => $this->request->getVar('catatan'),
            'total' => $this->request->getVar('total'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // input data itembrg masuk
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

            (new ItemModel())->insert([
                'id_brgmasuk' => $_POST['id_brgmasuk'],
                'id_barang' => $id_barang,
                'nm_barang' => $nm_barang,
                'satuan' => $satuan,
                'harga' => $_POST['harga_' . $i + 1],
                'qty' => $_POST['qty_' . $i + 1]
                // 'id_brgmasuk' => $this->request->getVar('id_brgmasuk'),
            ]);

            // update data stok pda tabel barang
            (new BarangModel())->save([
                'id_barang' => $id_barang,
                'harga' => $_POST['harga_' . $i + 1],
                'stok' => $stok + $_POST['qty_' . $i + 1]
            ]);
        }
        // dd($this->request->getVar());
        $session->remove('cart');
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/admin/brgmasuk/index');
    }
    // end tambah barang masuk

    // EDIT Start
    // halaman edit
    public function ubah($id)
    {
        $session = session();
        $cartItem = 0;

        if (!empty($session->newCart)) {
            $cartItem = (new BarangModel())->find($session->newCart);
        }

        $data = [
            'title' => 'Barang Masuk | Harno-Mart',

            'brgmasuk' => (new BrgmasukModel())->find($id),
            'item' => (new ItemModel())->getItembyBarang($id),
            'barang' => (new BarangModel())->findAll(),
            'supplier' => (new SupplierModel())->findAll(),
            'newItem' => $cartItem
        ];
        return view('/brgmasuk/ubah-brgmasuk', $data);
    }

    // Hapus item dalam edit data
    public function deleteItem($barang, $brgmasuk)
    {
        (new ItemModel())->where(['id_brgmasuk' => $brgmasuk, 'id_barang' => $barang])->delete();

        return redirect()->to('/admin/brgmasuk/ubah/' . $brgmasuk);
    }

    // menambahkan item baru dalam ubah data
    public function addNewitem($id, $brgmasuk)
    {
        $session = session();

        $item = (new ItemModel())->where(['id_brgmasuk' => $brgmasuk, 'id_barang' => $id])->find();

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
        return redirect()->to('/admin/brgmasuk/ubah/' . $brgmasuk);
    }

    // Menghapus item dalam ubah data
    public function hapusNewitem($id, $brgmasuk)
    {
        $session = session();
        $cart = $session->newCart;

        $key = array_search($id, $cart);

        unset($cart[$key]);

        $session->set('newCart', $cart);

        return redirect()->to('/admin/brgmasuk/ubah/' . $brgmasuk);
    }

    // Update data barang masuk
    public function update()
    {
        $session = session();

        (new BrgmasukModel())->save([
            'id_brgmasuk' => $_POST['id_brgmasuk'],
            'id_supplier' => $_POST['supplier'],
            'catatan' => $_POST['catatan'],
            'total' => $_POST['total'],
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $item = (new ItemModel())->getItembyBrgmasuk($_POST['id_brgmasuk']);

        for ($i = 0; $i < count($item); $i++) {
            $query = (new ItemModel())->where(['id_brgmasuk' => $_POST['id_brgmasuk'], 'id_barang' => $item[$i]['id_barang']]);
            $query->set(['harga' => $_POST['harga_' . $i + 1]])->update();
            $query->set(['qty' => $_POST['qty_' . $i + 1]])->update();
        }

        if (!empty($session->newCart)) {
            $dataItem = (new BarangModel())->find($session->newCart);
            for ($i = 0; $i <= count($dataItem); $i++) {
                $id_barang = $dataItem[$i - 1]['id_barang'];
                $nm_barang = $dataItem[$i - 1]['nm_barang'];
                $satuan = $dataItem[$i - 1]['satuan'];
                $stok = $dataItem[$i - 1]['stok'];

                (new ItemModel())->insert([
                    'id_brgmasuk' => $_POST['id_brgmasuk'],
                    'id_barang' => $id_barang,
                    'nm_barang' => $nm_barang,
                    'satuan' => $satuan,
                    'harga' => $_POST['harga_' . count($item) + $i],
                    'qty' => $_POST['qty_' . count($item) + $i]
                ]);

                // update data stok pda tabel barang
                (new BarangModel())->save([
                    'id_barang' => $id_barang,
                    'harga' => $_POST['harga_' . $i + 1],
                    'stok' => $stok + $_POST['qty_' . $i + 1]
                ]);
            }
        }

        $session->remove('newCart');
        session()->setFlashdata('pesan', 'Transaksi barang masuk ' . $_POST['id_brgmasuk'] . ' berhasil dirubah');

        return redirect()->to('/admin/brgmasuk');
    }

    // end ubah barang masuk

    // Hapus Pembelian

    public function delete($id)
    {

        (new BrgmasukModel())->delete($id);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/admin/brgmasuk');
    }

    public function cetaklaporan()
    {
        $brgmasuk = (new BrgmasukModel())->where(['created_at >=' => $_POST['tgl_awal'], 'created_at <=' => $_POST['tgl_akhir']])->findAll();

        if (!empty($brgmasuk)) {
            $data = [
                'title' => 'Laporan Barang Masuk | Harno-Mart',
                'tgl' => date('d F Y'),
                date_default_timezone_set('Asia/Jakarta'),

                'brgmasuk' => $brgmasuk,
                'supplier' => (new BrgmasukModel())->getSupplier(),
                'tglawal' => $_POST['tgl_awal'],
                'tglakhir' => $_POST['tgl_akhir']
            ];
            return view('/brgmasuk/laporan-masuk', $data);
        } else {
            session()->setFlashdata('gagal', '<b> Gagal Menampilkan Laporan </b> <br>' . 'Tidak ada transaksi antara tanggal ' . $_POST['tgl_awal'] . ' sampai ' . $_POST['tgl_akhir']);
            return redirect()->to('/admin/brgmasuk');
        }
    }

    public function cetakdetail($id)
    {
        $data = [
            'title' => 'Cetak Detail Barang Masuk | Harno-Mart',
            'tgl' => date('d F Y'),
            date_default_timezone_set('Asia/Jakarta'),

            'supplier' => (new BrgmasukModel())->getSupplier($id),
            'brgmasuk' => (new BrgmasukModel())->find($id),
            'item' => (new ItemModel())->getItembyBrgmasuk($id),
        ];
        return view('/brgmasuk/cetak-detailmasuk', $data);
    }


    // Menampilkan value dr java script berdasarkan id yang dipilih
    // public function getSupplierbyId()
    // {
    //     echo json_encode((new BarangModel())->find($_POST['id_supplier']));
    // }

    public function getItembyBrgmasuk()
    {
        echo json_encode((new ItemModel())->where('id_brgmasuk', $_POST['id_brgmasuk'])->findAll());
    }

    public function getBrgmasukbyId()
    {
        echo json_encode((new BrgmasukModel())->find($_POST['id_brgmasuk']));
    }
}
