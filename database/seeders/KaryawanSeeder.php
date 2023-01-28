<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('karyawans')->insert([
            'nip' => '123',
            'nama' => 'Rijal kurniawan',
            'email' => 'rijal@gmail.com',
            'jabatan_id' => '1',
        ]);
        DB::table('karyawans')->insert([
            'nip' => '124',
            'nama' => 'Lutfiani',
            'email' => 'lutfiani@gmail.com',
            'jabatan_id' => '1',
        ]);
        DB::table('karyawans')->insert([
            'nip' => '125',
            'nama' => 'Paijo',
            'email' => 'paijo@gmail.com',
            'jabatan_id' => '3',
        ]);
        DB::table('karyawans')->insert([
            'nip' => '126',
            'nama' => 'King',
            'email' => 'king@gmail.com',
            'jabatan_id' => '2',
        ]);
    }
}
