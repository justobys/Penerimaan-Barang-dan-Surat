<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiM extends Model
{
    protected $table = 'tbl_pegawai';

    public function getTablePegawai()
    {
        return $this->db->table($this->table)
            ->get()
            ->getResultArray();
    }
    public function getDataPegawai($search)
    {
        return $this->db->table($this->table)
            ->like('nama_pegawai', $search ?? '')
            ->orLike("email", $search ?? '')
            ->get()
            ->getResultArray();
    }

    public function insertPegawai($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updatePegawai($idpegawai, array $data)
    {
        return $this->db->table($this->table)
            ->where('id_pegawai', $idpegawai)
            ->update($data);
    }
    public function getPegawaiById($idpegawai)
    {
        return $this->db->table($this->table)
            ->where('id_pegawai', $idpegawai)
            ->get()
            ->getRowArray();
    }

    public function deletePegawai($idpegawai)
    {
        return $this->db->table($this->table)
            ->where('id_pegawai', $idpegawai)
            ->delete();
    }

    // Menghitung Jumlah data
    public function getTotalUser()
    {
        $query = $this->db->table('tbl_user')->get();
        $result = $query->getResult();
        return count($result);
    }

    public function getTotalPegawai()
    {
        $query = $this->db->table('tbl_pegawai')->get();
        $result = $query->getResult();
        return count($result);
    }
}