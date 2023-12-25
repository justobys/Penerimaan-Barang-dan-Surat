<?php

namespace App\Controllers;

use App\Models\DataBarangM;
use App\Models\PegawaiM;

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

    public function sendEmailNotification($id, $type)
    {
        // Ambil informasi barang dari database
        $modelBarang = new DataBarangM();
        $barang = $modelBarang->getBarangById($id);

        // Ambil informasi pegawai dari database
        $modelPegawai = new PegawaiM(); // Ganti dengan model pegawai yang sesuai
        $pegawai = $modelPegawai->getPegawaiById($barang['id_pegawai']);

        // Kirim email notifikasi
        $email = \Config\Services::email();
        $email->setTo($pegawai['email']);
        $email->setSubject('Notifikasi Barang Masuk');

        if ($type === 'surat') {
            $message = "Surat dengan nomor {$barang['no_resi']} telah diterima.";
        } elseif ($type === 'barang') {
            $message = "Barang dengan nomor {$barang['no_resi']} telah diterima.";
        } else {
            // Jenis notifikasi tidak valid
            echo json_encode(['status' => 'error', 'message' => 'Jenis notifikasi tidak valid.']);
            return;
        }

        $email->setMessage($message);

        if ($email->send()) {
            // Email terkirim
            echo json_encode(['status' => 'success', 'message' => 'Email notifikasi berhasil dikirim.']);
        } else {
            // Gagal mengirim email
            echo json_encode(['status' => 'error', 'message' => 'Gagal mengirim email notifikasi.']);
        }
    }

}