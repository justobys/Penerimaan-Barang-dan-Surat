<?php

namespace App\Controllers;

use App\Models\PegawaiM;

class Pegawai extends BaseController
{
    public function index()
    {
        $model = new PegawaiM();
        $search = $this->request->getGet('search');
        $data = $model->getDataPegawai($search);
        return view('pegawai', compact('data'));
    }

    public function tambah()
    {
        $model = new PegawaiM();
        $dataPegawai = $model->getTablePegawai();

        if ($this->request->getMethod() === 'post') {
            $data = [
                'nama_pegawai' => $this->request->getPost('nama_pegawai'),
                'email' => $this->request->getPost('email'),
            ];

            $model->insertPegawai($data);
            return redirect()->to('/Pegawai')->with('success', 'Data Pegawai Berhasil Dimasukkan');
        }

        return view('inputpegawai', compact('dataPegawai'));
    }

    public function edit($idpegawai)
    {
        $model = new PegawaiM;
        $dataPegawai = $model->getPegawaiById($idpegawai); // Adjust this line to fetch specific data

        if ($this->request->getMethod() === 'post') {
            $data = [
                'nama_pegawai' => $this->request->getPost('nama_pegawai'),
                'email' => $this->request->getPost('email'),
            ];
            $model->updatePegawai($idpegawai, $data);
            return redirect()->to('/Pegawai')->with('success', 'Data Pegawai Berhasil Diubah');
        }

        return view('ubahpegawai', ['dataPegawai' => $dataPegawai]);
    }

    public function hapus($idpegawai)
    {
        $model = new PegawaiM;
        $model->deletePegawai($idpegawai);
        return redirect()->to('/Pegawai')->with('success', 'Data Pegawai Berhasil Dihapus');
    }
}
?>