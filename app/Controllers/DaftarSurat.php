<?php

namespace App\Controllers;

use App\Models\DataSuratM;
use App\Models\PegawaiM;

class DaftarSurat extends BaseController
{
    public function index()
    {
        $model = new DataSuratM();
        $search = $this->request->getGet('search');
        $startdate = $this->request->getGet('StartDate');
        $enddate = $this->request->getGet('EndDate');
        $status = $this->request->getGet('status');
        $data = $model->getData($search, $startdate, $enddate, $status);
        return view('penerimaan_Surat', compact('data'));
    }

    public function tambahSurat()
    {
        // Load the model
        $model = new DataSuratM();
        $dataPegawai = $model->getTablePegawai();

        // Mengecek apakah formnya terisi
        if ($this->request->getMethod() === 'post') {
            $data = [
                'no_surat' => $this->request->getPost('no_surat'),
                'nama_Surat' => $this->request->getPost('nama_surat'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'id_pegawai' => $this->request->getPost('id_pegawai'),
                'status' => $this->request->getPost('status'),
            ];

            // File upload handling
            $foto_surat = $this->request->getFile('foto_surat');
            if ($foto_surat && $foto_surat->isValid() && !$foto_surat->hasMoved()) {
                $newName = $foto_surat->getRandomName();
                $foto_surat->move(ROOTPATH . 'public/uploads', $newName);

                // Menyimpan file ke database
                $data['foto_surat'] = 'uploads/' . $newName;
            }

            // Memasukkan data ke dalam database
            $model->insertSurat($data);

            return redirect()->to('/DaftarSurat')->with('success', 'Data Surat Berhasil Dimasukkan');
        }

        return view('inputSurat', compact('dataPegawai'));
    }
    public function ubahSurat($id)
    {
        // Load the model
        $model = new DataSuratM();
        $dataPegawai = $model->getTablePegawai();

        // Mengambil data dari database
        $surat = $model->getSuratById($id);

        if ($this->request->getMethod() === 'post') {
            $data = [
                'status' => $this->request->getPost('status'),
            ];
            $model->updateSurat($id, $data);
            return redirect()->to('/DaftarSurat')->with('success', 'Status Surat Berhasil Diubah');
        }
        return view('ubahSurat', ['dataPegawai' => $dataPegawai, 'surat' => $surat]);
    }

    public function hapusSurat($id)
    {
        $model = new DataSuratM();
        $model->deleteSurat($id);
        return redirect()->to('/DaftarSurat')->with('success', 'Data Surat Berhasil Dihapus');
    }

    // public function sendEmailNotification($id, $type)
    // {
    //     // Ambil informasi barang dari database
    //     $modelBarang = new DataSuratM();
    //     $surat = $modelBarang->getBarangById($id);

    //     // Ambil informasi pegawai dari database
    //     $modelPegawai = new PegawaiM(); // Ganti dengan model pegawai yang sesuai
    //     $pegawai = $modelPegawai->getPegawaiById($surat['id_pegawai']);

    //     // Kirim email notifikasi
    //     $email = \Config\Services::email();
    //     $email->setTo($pegawai['email']);
    //     $email->setSubject('Notifikasi Barang Masuk');

    //     if ($type === 'surat') {
    //         $message = "Surat dengan nomor {$surat['no_surat']} telah diterima.";
    //     } elseif ($type === 'barang') {
    //         $message = "Barang dengan nomor {$surat['no_surat']} telah diterima.";
    //     } else {
    //         // Jenis notifikasi tidak valid
    //         echo json_encode(['status' => 'error', 'message' => 'Jenis notifikasi tidak valid.']);
    //         return;
    //     }

    //     $email->setMessage($message);

    //     if ($email->send()) {
    //         // Email terkirim
    //         echo json_encode(['status' => 'success', 'message' => 'Email notifikasi berhasil dikirim.']);
    //     } else {
    //         // Gagal mengirim email
    //         echo json_encode(['status' => 'error', 'message' => 'Gagal mengirim email notifikasi.']);
    //     }
    // }
}