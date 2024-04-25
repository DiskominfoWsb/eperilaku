<?php

namespace Database\Seeders;

use App\Models\Golongan;
use App\Models\User;
use Illuminate\Database\Seeder;
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
        $user = User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'administrator@localhost',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $user->pegawai()->create([
            'nip' => '000000000000000000',
            'nama' => 'Admin',
            'gelar_depan' => '-',
            'gelar_belakang' => '-',
            't_lahir' => 'Wonosobo',
            'tgl_lahir' => '1990-11-29',
            'jns_kelamin' => 'L',
            'jabatan' => 'Staff',
            'instansi' => null,
            'golongan_uuid' => Golongan::where('golongan', 'III')->where('ruang', 'd')->first()->uuid,
            'no_telp' => '0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
