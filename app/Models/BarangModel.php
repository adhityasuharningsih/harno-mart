<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $allowedFields = ['id_barang', 'nm_barang', 'kategori', 'satuan', 'harga', 'stok', 'created_at', 'updated_at'];
    protected $useTimestamps = true;


    // Membuat kode barang secara otomatis
    public function kodebarang()
    {
        $query = $this->select('RIGHT(barang.id_barang,4) as id_barang', False)->find();

        if ($query != NULL) {
            // mengecek jk kode telah tersedia
            $data = max($query);
            $kode = $data['id_barang'] + 1;
        } else {
            $kode = 1;
        }

        $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodeTampil = "BR" . $batas;
        return $kodeTampil;
    }

    public function getKategori()
    {
        $query = $this->db->table('kategori');
        $query = $this->select('*');
        $query = $this->join('kategori', 'kategori.id_kategori = barang.kategori', 'left');
        $join = $query->findAll();

        return $join;
    }
}
