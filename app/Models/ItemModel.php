<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table = 'itembrgmasuk';
    protected $allowedFields = ['id_brgmasuk', 'id_barang', 'nm_barang', 'satuan', 'harga', 'qty'];


    // Join Tabel barang dan item barang masuk
    public function getItembyBarang($id)
    {
        $query = $this->db->table('barang');
        $query = $this->select('*');
        $query = $this->join('barang', 'barang.id_barang = itembrgmasuk.id_barang', 'left');
        $join = $query->where('id_brgmasuk', $id)->findAll();

        return $join;
    }
    public function getItembyBrgmasuk($id)
    {
        $query = $this->db->table('brgmasuk');
        $query = $this->select('*');
        $query = $this->join('brgmasuk', 'brgmasuk.id_brgmasuk = itembrgmasuk.id_brgmasuk', 'left');
        $join = $query->where('itembrgmasuk.id_brgmasuk', $id)->findAll();

        return $join;
    }

    // Join Table Barang Masuk dan Item Barang Masuk

}
