<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TableNameSeeder extends Seeder
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
            'role' => 'Kepala Sekolah',
            'password' => Hash::make('123456'),
        ]);

        // User Admin
        DB::table('roles')->insert([
            'name' => 'Guru',
            'email' => 'divaanggreiniharahap@gmail.com',
            'role' => 'Guru',
            'password' => Hash::make('123456'),
        ]);

        // User Biasa
        DB::table('roles')->insert([
            'name' => 'Tata Usaha',
            'email' => 'naufalfauzanst@gmail.com',
            'role' => 'Tata Usaha',
            'password' => Hash::make('123456'),
        ]);

         // User Biasa
         DB::table('roles')->insert([
            'name' => 'Siswa',
            'email' => 'keisyaa.tan@gmail.com',
            'role' => 'Siswa',
            'password' => Hash::make('123456'),
        ]);
    }
}