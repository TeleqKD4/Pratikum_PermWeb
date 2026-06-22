<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    /**
     * Daftar semua user (hanya untuk keperluan admin/debug)
     */
    public function index(): string
    {
        $model = new UserModel();
        return view('user/index', [
            'title' => 'Daftar User',
            'users' => $model->findAll(),
        ]);
    }

    /**
     * Halaman & proses Login
     */
    public function login(): string|object
    {
        helper(['form']);

        // Jika sudah login, langsung ke admin
        if (session()->get('logged_in')) {
            return redirect()->to('/admin/artikel');
        }

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Tampilkan form jika belum submit
        if (!$email) {
            return view('user/login');
        }

        $model = new UserModel();
        $login = $model->where('useremail', $email)->first();

        if ($login) {
            if (password_verify($password, $login['userpassword'])) {
                session()->set([
                    'user_id'    => $login['id'],
                    'user_name'  => $login['username'],
                    'user_email' => $login['useremail'],
                    'logged_in'  => true,
                ]);
                return redirect()->to('/admin/artikel');
            }

            session()->setFlashdata('flash_msg', 'Password salah.');
            return redirect()->to('/user/login');
        }

        session()->setFlashdata('flash_msg', 'Email tidak terdaftar.');
        return redirect()->to('/user/login');
    }

    /**
     * Logout – hancurkan sesi dan kembali ke login
     */
    public function logout(): object
    {
        session()->destroy();
        return redirect()->to('/user/login');
    }
}