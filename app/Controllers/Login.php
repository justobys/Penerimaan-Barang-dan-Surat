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
        $data = $model->where('email', $email)->first();

        if ($data) {
            $pass = $data['password'];

            if (password_verify($password, $pass)) {
                // Store user data in the session
                $ses_data = [
                    'id' => $data['id'],
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'logged_in' => true,
                ];
                $session->set($ses_data);

                // Redirect to the dashboard with success message
                return redirect()->to('Dashboard')->with('success', 'Login Berhasil');
            }
        }

        // If email or password is incorrect, redirect to login with error message
        return redirect()->to('Login')->with('error', 'Password/email salah! Silahkan periksa kembali!');
    }

    public function logout()
    {
        // Destroy the session on logout
        session()->destroy();
        return redirect()->to('/login');
    }
}
