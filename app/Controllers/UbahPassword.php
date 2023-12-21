<?php

namespace App\Controllers;

use App\Models\User;

class UbahPassword extends BaseController
{
    public function index()
    {
        return view('ubahpassword');
    }

    public function ubah()
    {

        $session = session();
        $model = new User();

        // Jika form submit
        if ($this->request->getMethod() === 'post') {
            // Validasi input
            $validation = \Config\Services::validation();
            $validationRules = [
                'password' => 'required|min_length[6]',
                'password_confirm' => 'required|matches[password]',
            ];
            $validation->setRules($validationRules);

            if ($validation->withRequest($this->request)->run()) {
                // Ambil data dari form
                $id = $session->get('id');
                $password = $this->request->getPost('password');

                // Hash password sebelum menyimpan ke database
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                // Update password di database
                $model->updatePassword($id, $hashedPassword);

                // Redirect atau tampilkan pesan sukses
                return redirect()->to('Dashboard')->with('success', 'Password berhasil diubah');
            } else {
                // Jika validasi gagal, tampilkan pesan error
                return redirect()->back()->with('errors', 'Password gagal diubah');
            }
        }
    }
}