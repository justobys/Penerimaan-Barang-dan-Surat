<?php

namespace App\Controllers;

use App\Models\DataBarangM;

class DaftarBarang extends BaseController
{
    public function index()
    {
        $model = new DataBarangM();
        $search = $this->request->getGet('search');
        $startdate = $this->request->getGet('StartDate');
        $enddate = $this->request->getGet('EndDate');
        $status = $this->request->getGet('status');
        $data = $model->getData($search, $startdate, $enddate, $status);
        return view('penerimaan_barang', compact('data'));
    }



    public function tambahBarang()
    {
        // Load the model
        $model = new DataBarangM();
        $dataPegawai = $model->getTablePegawai();

        // Mengecek apakah formnya terisi
        if ($this->request->getMethod() === 'post') {
            $data = [
                'no_resi' => $this->request->getPost('no_resi'),
                'nama_barang' => $this->request->getPost('nama_barang'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'id_pegawai' => $this->request->getPost('id_pegawai'),
                'status' => $this->request->getPost('status'),
            ];

            // File upload handling
            $foto_barang = $this->request->getFile('foto_barang');
            if ($foto_barang->isValid() && !$foto_barang->hasMoved()) {
                $newName = $foto_barang->getRandomName();
                $foto_barang->move(ROOTPATH . 'public/uploads', $newName);

                // Menyimpan file ke database
                $data['foto_barang'] = 'uploads/' . $newName;
            }

            // Memasukkan data ke dalam database
            $model->insertBarang($data);

            return redirect()->to('/DaftarBarang')->with('success', 'Data Barang Berhasil Dimasukkan');
        }

        return view('inputbarang', compact('dataPegawai'));
    }
    public function ubahBarang($id)
    {
        // Load the model
        $model = new DataBarangM();
        $dataPegawai = $model->getTablePegawai();

        // Mengambil data dari database
        $barang = $model->getBarangById($id);

        if ($this->request->getMethod() === 'post') {
            $data = [
                'status' => $this->request->getPost('status'),
            ];
            $model->updateBarang($id, $data);
            return redirect()->to('/DaftarBarang')->with('success', 'Status Barang Berhasil Diubah');
        }
        return view('ubahbarang', ['dataPegawai' => $dataPegawai, 'barang' => $barang]);
    }

    public function hapusBarang($id)
    {
        $model = new DataBarangM();
        $model->deleteBarang($id);
        return redirect()->to('/DaftarBarang')->with('success', 'Data Barang Berhasil Dihapus');
    }
}