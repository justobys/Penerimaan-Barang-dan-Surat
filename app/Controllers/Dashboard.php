<?php

namespace App\Controllers;

use App\Models\Datatable;

class Dashboard extends BaseController
{
    public function index()
    {
        return view('dashboard');
    }

    public function datatable()
    {
        $model = new Datatable();
        $data['brg'] = $model->getTableBarang();

        // Debugging line
        print_r($data['brg']);

        return $this->response->setJSON($data);
    }

}
