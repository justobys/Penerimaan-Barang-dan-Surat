<?php

namespace App\Controllers;

use App\Models\User;

class Login extends BaseController
{
    public function index()
    {
        // Mengambil pesan sukses/error dari flash data
        $successMessage = session()->getFlashdata('success');
        $errorMessage = session()->getFlashdata('err');

        // Menampilkan pesan sukses/error jika ada
        if ($successMessage) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom: 10px;">';
            echo $successMessage;
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
        } elseif ($errorMessage) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-bottom: 10px;">';
            echo $errorMessage;
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
        }
        return view('login');
    }

    public function auth()
    {
        $session = session();
        $model = new User();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $model->where('email', $email)->first();

        if ($data) {
            $pass = $data['password'];

            if (password_verify($password, $pass)) {
                $ses_data = [
                    'id' => $data['id'],
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'password' => $data['password'],
                    'logged_in' => TRUE
                ];
                $session->setFlashdata('success', 'Login Berhasil');
                $session->set($ses_data);
                return redirect()->to('/Dashboard');
            } else {
                $session->setFlashdata('err', 'Password/email salah!, Silahkan Periksa Kembali! ');
                return redirect()->to('/login');
            }
        }
    }
    function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
?>