<?php

namespace App\Controllers;

use App\Models\DataBarangM;

class DaftarBarang extends BaseController
{
    public function index()
    {
        $model = new DataBarangM();
        $search = $this->request->getGet('search');
        $date = $this->request->getGet('date');
        $data = $model->getData($search, $date); // Pass both $search and $date
        return view('penerimaan_barang', compact('data'));
    }


    public function tambahBarang()
    {
        // Load the model
        $model = new DataBarangM();
        $dataPegawai = $model->getTablePegawai();

        // Check if the form is submitted
        if ($this->request->getMethod() === 'post') {
            // Validate form data if needed

            // Get form data
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

                // Save the file path in the database
                $data['foto_barang'] = 'uploads/' . $newName;
            }

            // Insert data into the database
            $model->insertBarang($data);

            // Redirect to a success page or do something else
            return redirect()->to('/DaftarBarang')->with('success', 'Data Barang Berhasil Dimasukkan');
        }

        // Load the view with the form
        return view('inputbarang', compact('dataPegawai'));
    }
    public function ubahBarang($id)
    {
        // Load the model
        $model = new DataBarangM();
        $dataPegawai = $model->getTablePegawai();

        // Get existing data from the database
        $barang = $model->getBarangById($id);

        // Check if the form is submitted
        if ($this->request->getMethod() === 'post') {
            // Validate form data if needed

            // Get form data
            $data = [
                'status' => $this->request->getPost('status'),
            ];

            // Update data in the database
            $model->updateBarang($id, $data);

            // Redirect to a success page or do something else
            return redirect()->to('/DaftarBarang')->with('success', 'Status Barang Berhasil Diubah');
        }

        // Load the view with the form and existing data
        return view('ubahbarang', ['dataPegawai' => $dataPegawai, 'barang' => $barang]);
    }
}