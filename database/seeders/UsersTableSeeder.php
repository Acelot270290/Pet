<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Insere um usuário administrador
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('123456'),
            'cargo_id' => 1, 
        ]);

        // Insere um usuário cliente
        DB::table('users')->insert([
            'name' => 'Client User',
            'email' => 'client@example.com',
            'password' => Hash::make('123456'),
            'cargo_id' => 2, 
        ]);
    }
}

