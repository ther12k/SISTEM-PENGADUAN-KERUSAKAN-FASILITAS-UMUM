<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'email'     => 'admin@example.com',
                'username'  => 'admin',
                'password'  => password_hash('admin123', PASSWORD_DEFAULT),
                'role'      => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'email'     => 'pelanggan@example.com',
                'username'  => 'pelanggan',
                'password'  => password_hash('pelanggan123', PASSWORD_DEFAULT),
                'role'      => 'pelanggan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'email'     => 'user@example.com',
                'username'  => 'user',
                'password'  => password_hash('user123', PASSWORD_DEFAULT),
                'role'      => 'pelanggan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Using Query Builder
        $this->db->table('users')->insertBatch($data);
    }
}