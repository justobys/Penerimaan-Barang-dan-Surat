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

}
