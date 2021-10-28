<?php

namespace App\Models;

use CodeIgniter\Model;

class BrgmasukModel extends Model
{
    protected $table = 'brgmasuk';
    protected $primaryKey = 'id_brgmasuk';
    protected $allowedFields = ['id_brgmasuk', 'id_supplier', 'foto_struk', 'catatan', 'total', 'created_at', 'updated_at'];
    // protected $useTimestamps = true;

    // membuat kode barang masuk secara otomatis
    public function kodebrgmasuk()
    {
        $query = $this->select('RIGHT(brgmasuk.id_brgmasuk,4) as id_brgmasuk', False)->find();

        if ($query != NULL) {
            // mengecek jk kode telah tersedia
            $data = max($query);
            $kode = $data['id_brgmasuk'] + 1;
        } else {
            $kode = 1;
        }

        $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodeTampil = "BM" . $batas;
        return $kodeTampil;
    }

    public function tanggal()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('l, d F Y');
        return $tgl;
    }

    public function getSupplier()
    {
        $query = $this->db->table('supplier');
        $query = $this->select('*');
        $query = $this->join('supplier', 'supplier.id_supplier = brgmasuk.id_supplier', 'left');
        $join = $query->findAll();

        return $join;
    }

    public function getItem()
    {
    }
}
