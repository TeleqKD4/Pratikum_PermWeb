<?php
namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel; // Pastikan UserModel sudah kamu buat sebelumnya di Modul 4/10

class Auth extends ResourceController
{
    protected $format = 'json';

    public function login()
    {
        // 1. Ambil data dari form VueJS
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        
        $model = new UserModel();
        
        // 2. Cari user berdasarkan username atau email
        $user = $model->where('username', $username)
                      ->orWhere('useremail', $username)
                      ->first();

        // 3. Jika user ditemukan
        if ($user) {
            // Verifikasi password (Bisa password biasa, bisa hash)
            if ($password === $user['userpassword'] || password_verify($password, $user['userpassword'])) {
                
                // Jika sukses, kembalikan Token ke VueJS
                return $this->respond([
                    'status'   => 200,
                    'error'    => null,
                    'messages' => 'Login Berhasil',
                    'data'     => [
                        'id'       => $user['id'],
                        'username' => $user['username'],
                        'token'    => base64_encode("TOKEN-SECRET-" . $user['username'])
                    ]
                ], 200);
            }
        }

        // 4. Jika gagal (user tidak ada atau password salah)
        return $this->failUnauthorized('Username atau Password yang Anda masukkan salah.');
    }
}