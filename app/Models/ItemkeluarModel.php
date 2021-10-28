<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemkeluarModel extends Model
{
    protected $table = 'itembrgkeluar';
    protected $allowedFields = ['id_brgkeluar', 'id_barang', 'nm_barang', 'satuan', 'harga', 'qty'];


    // Join Tabel barang dan item barang keluar
    public function getItembyBarang($id)
    {
        $query = $this->db->table('barang');
        $query = $this->select('*');
        $query = $this->join('barang', 'barang.id_barang = itembrgkeluar.id_barang', 'left');
        $join = $query->where('id_brgkeluar', $id)->findAll();

        return $join;
    }
    public function getItembyBrgkeluar($id)
    {
        $query = $this->db->table('brgkeluar');
        $query = $this->select('*');
        $query = $this->join('brgkeluar', 'brgkeluar.id_brgkeluar = itembrgkeluar.id_brgkeluar', 'left');
        $join = $query->where('itembrgkeluar.id_brgkeluar', $id)->findAll();

        return $join;
    }

    // Join Table Barang keluar dan Item Barang keluar

}
