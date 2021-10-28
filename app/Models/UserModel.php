<?php

namespace App\Models;

use CodeIgniter\Model;
use phpDocumentor\Reflection\PseudoTypes\False_;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['id_user', 'nama', 'alamat', 'no_hp', 'username', 'password', 'level'];


    // Membuat kode user secara otomatis
    public function kodeuser()
    {
        $query = $this->select('RIGHT(user.id_user,3) as id_user', False)->find();

        if ($query != NULL) {
            // mengecek jk kode telah tersedia
            $data = max($query);
            $kode = $data['id_user'] + 1;
        } else {
            $kode = 1;
        }

        $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodeTampil = "USER" . $batas;
        return $kodeTampil;
    }
}
