<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class KepegawaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kepegawaians')->insert([
            [
                'status_kepegawaian' => 'Guru Tidak Tetap',
            ],
            [
                'status_kepegawaian' => 'Pegawai Tidak Tetap',
            ],
            [
                'status_kepegawaian' => 'Guru Tamu',
            ],
        ]);
    }
}
