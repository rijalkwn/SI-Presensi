<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nip' => '1234567890',
            'nama' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);
        DB::table('users')->insert([
            'nip' => '123',
            'nama' => 'Rijal kurniawan',
            'email' => 'rijal@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'user',
        ]);
    }
}
