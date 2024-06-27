<?php

namespace App\Controllers;

use App\Models\User;

class Login extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function auth()
    {
        $session = session();
        $model = new User();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        // $rememberMe = $this->request->getVar('remember');

        $data = $model->where('email', $email)->first();

        if ($data) {
            $pass = $data['password'];

            if (password_verify($password, $pass)) {
                $ses_data = [
                    'id' => $data['id'],
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'logged_in' => true,
                ];

                $session->set($ses_data);

                // if ($rememberMe) {
                //     $this->setRememberMeCookie($data['id']);
                // }

                return redirect()->to('/Dashboard')->with('success', 'Login Berhasil');
            }
        }

        return redirect()->to('/login')->with('error', 'Password/email salah! Silahkan periksa kembali!');
    }

    // private function setRememberMeCookie($userId)
    // {
    //     helper('cookie');
    //     helper('text');
    //     $token = random_string('alnum', 32); // Menggenerate random token
    //     $model = new User();

    //     // Jika pengguna sudah memiliki remember_token, lakukan update
    //     $model->update($userId, ['remember_token' => $token]);

    //     // Jika pengguna belum memiliki remember_token, lakukan insert
    //     if ($model->affectedRows() == 0) {
    //         $model->save(['id' => $userId, 'remember_token' => $token]);
    //     }

    //     // Set the Remember Me cookie with a long expiration time (e.g., two weeks)
    //     set_cookie('remember_me', $token, 60 * 60 * 24 * 14); // 14 days expiration
    // }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
