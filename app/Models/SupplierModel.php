<?php

namespace App\Models;

use CodeIgniter\Model;
use phpDocumentor\Reflection\PseudoTypes\False_;

class SupplierModel extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'id_supplier';
    protected $allowedFields = ['id_supplier', 'nm_supplier', 'alamat', 'no_hp', 'email'];


    // Membuat kode supplier secara otomatis
    public function kodesupplier()
    {
        $query = $this->select('RIGHT(supplier.id_supplier,4) as id_supplier', False)->find();

        if ($query != NULL) {
            // mengecek jk kode telah tersedia
            $data = max($query);
            $kode = $data['id_supplier'] + 1;
        } else {
            $kode = 1;
        }

        $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodeTampil = "SP" . $batas;
        return $kodeTampil;
    }

    // public function getKategori()
    // {
    //     $query = $this->db->table('kategori');
    //     $query = $this->select('*');
    //     $query = $this->join('kategori', 'kategori.id_kategori = supplier.kategori', 'left');
    //     $join = $query->findAll();

    //     return $join;
    // }
}
