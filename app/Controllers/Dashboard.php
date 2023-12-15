<?php

namespace App\Controllers;

use App\Models\DataBarangM;

class Dashboard extends BaseController
{
    public function index()
    {
        $model = new DataBarangM();
        $data = $model->getTableBarang();
        return view('dashboard', compact('data'));
    }

    // public function datatable()
    // {
    //     $model = new Datatable();
    //     $data['brg'] = $model->getTableBarang();

    //     // Debugging line
    //     print_r($data['brg']);

    //     return $this->response->setJSON($data);
    // }

}
