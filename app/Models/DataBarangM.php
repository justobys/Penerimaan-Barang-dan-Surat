<?php

namespace App\Models;

use CodeIgniter\Model;

class DataBarangM extends Model
{
    protected $table = 'tbl_penerimaan_barang';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'no_resi',
        'nama_barang',
        'deskripsi',
        'id_pegawai',
        'status',
        'foto_barang',
        'tanggal'
    ];

    public function getTableBarang($limit = 10)
    {
        return $this->db->table($this->table)
            ->select('tbl_penerimaan_barang.*, tbl_pegawai.nama_pegawai')
            ->join('tbl_pegawai', 'tbl_pegawai.id_pegawai = tbl_penerimaan_barang.id_pegawai', 'left')
            ->orderBy('tanggal', 'DESC')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }

    public function getTableBarangAll()
    {
        return $this->db->table($this->table)
            ->select('tbl_penerimaan_barang.*, tbl_pegawai.nama_pegawai')
            ->join('tbl_pegawai', 'tbl_pegawai.id_pegawai = tbl_penerimaan_barang.id_pegawai', 'left') // Sesuaikan dengan kolom relasi yang benar
            ->get()
            ->getResultArray();
    }

    public function getTablePegawai()
    {
        return $this->db->table('tbl_pegawai')
            ->get()
            ->getResultArray();
    }

    public function insertBarang($data)
    {
        $data['tanggal'] = date('Y-m-d H:i:s');
        return $this->db->table($this->table)->insert($data);
    }


    public function updateBarang($id, array $data)
    {
        $data['tanggal'] = date('Y-m-d H:i:s');
        return $this->db->table($this->table)
            ->where('id', $id)
            ->update($data);
    }

    public function getBarangById($id)
    {
        return $this->find($id);
    }

    public function getData($search, $start_date, $end_date, $status)
    {
        $query = $this->db->table($this->table)
            ->select('tbl_penerimaan_barang.*, tbl_pegawai.nama_pegawai')
            ->join('tbl_pegawai', 'tbl_pegawai.id_pegawai = tbl_penerimaan_barang.id_pegawai', 'left');

        if (!empty($search)) {
            $query->like('tbl_penerimaan_barang.no_resi', $search);
            $query->orLike('tbl_penerimaan_barang.nama_barang', $search);
            $query->orLike('tbl_pegawai.nama_pegawai', $search);
        }

        if (!empty($start_date) && !empty($end_date)) {
            $query->where('tbl_penerimaan_barang.tanggal >=', $start_date);
            $query->where('tbl_penerimaan_barang.tanggal <=', $end_date);
        }

        if (!empty($status)) {
            if ($status == 'received') {
                $query->where('tbl_penerimaan_barang.status', 'Diterima');
            } elseif ($status == 'not_received') {
                $query->where('tbl_penerimaan_barang.status', 'Belum Diterima');
            }
        }
        return $query->get()->getResultArray();
    }


    public function deleteBarang($id)
    {
        return $this->db->table($this->table)
            ->where('id', $id)
            ->delete();
    }

    // Menghitung Total Barang
    public function getTotalBarang()
    {
        $query = $this->db->table('tbl_penerimaan_barang')->get();
        $result = $query->getResult();
        return count($result);
    }
}
?>