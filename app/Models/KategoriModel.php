<?php

namespace App\Models;

use CodeIgniter\Model;
use phpDocumentor\Reflection\PseudoTypes\False_;

class KategoriModel extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $allowedFields = ['id_kategori', 'nm_kategori'];


    // Membuat kode kategori secara otomatis
    public function kodeKategori()
    {
        $query = $this->select('RIGHT(kategori.id_kategori,4) as id_kategori', False)->find();

        if ($query != NULL) {
            // mengecek jk kode telah tersedia
            $data = max($query);
            $kode = $data['id_kategori'] + 1;
        } else {
            $kode = 1;
        }

        $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodeTampil = "KT" . $batas;
        return $kodeTampil;
    }
}
