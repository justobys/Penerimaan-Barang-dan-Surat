<?php

namespace App\Models;

use CodeIgniter\Model;

class DataSuratM extends Model
{
    protected $table = 'tbl_penerimaan_surat';

    public function getTableSurat($limit = 10)
    {
        return $this->db->table($this->table)
            ->select('tbl_penerimaan_surat.*, tbl_pegawai.nama_pegawai')
            ->join('tbl_pegawai', 'tbl_pegawai.id_pegawai = tbl_penerimaan_surat.id_pegawai', 'left') // Sesuaikan dengan kolom relasi yang benar
            ->orderBy('tanggal', 'DESC')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }

    public function getTableSuratAll()
    {
        return $this->db->table($this->table)
            ->select('tbl_penerimaan_surat.*, tbl_pegawai.nama_pegawai')
            ->join('tbl_pegawai', 'tbl_pegawai.id_pegawai = tbl_penerimaan_surat.id_pegawai', 'left') // Sesuaikan dengan kolom relasi yang benar
            ->get()
            ->getResultArray();
    }

    public function getTablePegawai()
    {
        return $this->db->table('tbl_pegawai')
            ->get()
            ->getResultArray();
    }

    public function insertSurat($data)
    {
        $data['tanggal'] = date('Y-m-d H:i:s');
        return $this->db->table($this->table)->insert($data);
    }


    public function updateSurat($id, array $data)
    {
        return $this->db->table($this->table)
            ->where('id', $id)
            ->update($data);
    }

    public function getSuratById($id)
    {
        return $this->find($id);
    }

    public function getData($search, $start_date, $end_date, $status)
    {
        $query = $this->db->table($this->table)
            ->select('tbl_penerimaan_surat.*, tbl_pegawai.nama_pegawai')
            ->join('tbl_pegawai', 'tbl_pegawai.id_pegawai = tbl_penerimaan_surat.id_pegawai', 'left');

        if (!empty($search)) {
            $query->like('tbl_penerimaan_surat.no_resi', $search);
            $query->orLike('tbl_penerimaan_surat.nama_surat', $search);
            $query->orLike('tbl_pegawai.nama_pegawai', $search);
        }

        if (!empty($start_date) && !empty($end_date)) {
            $query->where('tbl_penerimaan_surat.tanggal >=', $start_date);
            $query->where('tbl_penerimaan_surat.tanggal <=', $end_date);
        }

        if (!empty($status)) {
            if ($status == 'received') {
                $query->where('tbl_penerimaan_surat.status', 'Diterima');
            } elseif ($status == 'not_received') {
                $query->where('tbl_penerimaan_surat.status', 'Belum Diterima');
            }
        }
        return $query->get()->getResultArray();
    }


    public function deleteSurat($id)
    {
        return $this->db->table($this->table)
            ->where('id', $id)
            ->delete();
    }

}
?>