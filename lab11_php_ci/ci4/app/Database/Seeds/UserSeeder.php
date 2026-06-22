<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $model = model('UserModel');

        // Cek apakah user sudah ada agar tidak duplikat
        $exists = $model->where('useremail', 'admin@email.com')->first();

        if (! $exists) {
            $model->insert([
                'username'     => 'admin',
                'useremail'    => 'admin@email.com',
                'userpassword' => password_hash('admin123', PASSWORD_DEFAULT),
            ]);
            echo "User admin berhasil dibuat.\n";
        } else {
            echo "User admin sudah ada, skip.\n";
        }
    }
}