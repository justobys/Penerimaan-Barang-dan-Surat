<?php

namespace App\Models;

use CodeIgniter\Model;

class Datatable extends Model
{
    protected $table = 'tbl_penerimaan_barang';

    public function getTableBarang()
    {
        return $this->db->table($this->table)
            ->select('tbl_penerimaan_barang.*, tbl_pegawai.nama_pegawai')
            ->join('tbl_pegawai', 'tbl_pegawai.id_pegawai = tbl_penerimaan_barang.id_pegawai', 'left') // Sesuaikan dengan kolom relasi yang benar
            ->get()
            ->getResultArray();
    }

}
?>