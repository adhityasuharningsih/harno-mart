<?php

namespace App\Models;

use CodeIgniter\Model;

class BrgkeluarModel extends Model
{
    protected $table = 'brgkeluar';
    protected $primaryKey = 'id_brgkeluar';
    protected $allowedFields = ['id_brgkeluar', 'total', 'catatan', 'created_at'];
    // protected $useTimestamps = true;

    // membuat kode barang masuk secara otomatis
    public function kodebrgkeluar()
    {
        $query = $this->select('RIGHT(brgkeluar.id_brgkeluar,4) as id_brgkeluar', False)->find();

        if ($query != NULL) {
            // mengecek jk kode telah tersedia
            $data = max($query);
            $kode = $data['id_brgkeluar'] + 1;
        } else {
            $kode = 1;
        }

        $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodeTampil = "BK" . $batas;
        return $kodeTampil;
    }

    public function tanggal()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('l, d F Y');
        return $tgl;
    }
}
