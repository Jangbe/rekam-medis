<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['Dokter','dokter@gmail.com','dokter'],
            ['Pegawai','pegawai@gmail.com','pegawai'],
            ['Apoteker','apoteker@gmail.com','apoteker'],
        ];
        foreach($users as $user){
            User::create([
                'name' => $user[0],
                'email' => $user[1],
                'role' => $user[2],
                'password' => bcrypt('123456')
            ]);
        }
    }
}
