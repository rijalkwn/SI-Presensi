<?php

namespace Database\Seeders;

use App\Models\Setting;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'jam_masuk' => '08:00:00',
            'jam_pulang' => '17:00:00',
            'latitude' => '-6.175392',
            'longitude' => '106.865036',
            'radius' => '100',
        ]);
    }
}
