<?php

namespace App\Controllers;

use App\Models\DataBarangM;
use App\Models\DataSuratM;

class Dashboard extends BaseController
{
    public function index()
    {
        $modelBarang = new DataBarangM();
        $modelSurat = new DataSuratM();

        // Fetch data from both models
        $dataBarang = $modelBarang->getTableBarang();
        $dataSurat = $modelSurat->getTableSurat();

        // Combine the results
        $data['tbl_penerimaan_barang'] = $dataBarang;
        $data['tbl_penerimaan_surat'] = $dataSurat;

        return view('dashboard', $data);
    }
}
