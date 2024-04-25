<?php

namespace Database\Seeders;

use App\Models\Setting;
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
            'name' => 'Nama',
            'description' => 'Deskripsi',
            'alamat' => 'Alamat',
            'phone' => '0286 333333',
            'images' => 'logo.png',
            'logo' => 'logo.png',
            'frontend_background' => 'background.jpeg',
        ]);
    }
}
