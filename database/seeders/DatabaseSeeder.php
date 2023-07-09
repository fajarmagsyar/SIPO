<?php

namespace Database\Seeders;

use App\Models\Admin;
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
        Admin::create([
            'nama_admin' => 'Fajar Magsyar',
            'role' => '1',
            'no_hp' => '0821320812321',
            'email' => 'fajar@mail.com',
            'password' => Hash::make('ateblukup'),
        ]);
    }
}
