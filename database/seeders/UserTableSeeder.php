<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User Superadmin
        DB::table('roles')->insert([
            'ID_Roles' => '1',
            'name' => 'Superadmin',
            'email' => 'keisyaa012@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'Kepala Sekolah',
        ]);

        // User Admin
        DB::table('roles')->insert([
            'name' => 'Guru',
            'email' => 'divaanggreiniharahap@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'Guru',
        ]);

        // User Biasa
        DB::table('roles')->insert([
            'name' => 'Tata Usaha',
            'email' => 'naufalfauzanst@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'Tata Usaha',
        ]);

         // User Biasa
         DB::table('roles')->insert([
            'name' => 'Siswa',
            'email' => 'keisyaa.tan@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'Siswa',
        ]);
    }
}
