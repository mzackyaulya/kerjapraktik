<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'foto' => '',
            'name' => 'RamaTranz',
            'email' => 'ramatranzplg@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'A',
            'alamat' => 'Jl. Mayor Santoso No.3112, 20 Ilir D. III, Kec. Ilir Tim. I, Kota Palembang, Sumatera Selatan 30121',
        ]);
    }
}
