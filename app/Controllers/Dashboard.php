<?php

namespace App\Controllers;

use App\Models\DataBarangM;
use App\Models\DataSuratM;
use App\Models\PegawaiM;

class Dashboard extends BaseController
{
    public function index()
    {
        // Models
        $modelBarang = new DataBarangM();
        $modelSurat = new DataSuratM();
        $modelhitung = new PegawaiM();

        // Menghitung total semua
        $data['totalBarang'] = $modelBarang->getTotalBarang();
        $data['totalSurat'] = $modelSurat->getTotalSurat();
        $data['totaluser'] = $modelhitung->getTotalUser();
        $data['totalPegawai'] = $modelhitung->getTotalPegawai();

        // Fetch data from both models
        $dataBarang = $modelBarang->getTableBarang();
        $dataSurat = $modelSurat->getTableSurat();

        // Combine the results
        $data['tbl_penerimaan_barang'] = $dataBarang;
        $data['tbl_penerimaan_surat'] = $dataSurat;

        return view('dashboard', $data);
    }
    public function chartDataBarang()
    {
        $model = new DataBarangM();
        $data = $model->getTableBarang();
        // print_r($data);
        echo json_encode($data);
    }
}
