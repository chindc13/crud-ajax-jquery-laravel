<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();
        
        DB::table('users')->insert([
            'name'        => "Jerryson Derraco",
            'email'       => "jerryson.derraco13@gmail.com",
            'username'    => "jerryson.derraco13",
            'birth'       => "1997-04-08",
            'created_at'  => "2023-12-16 00:00:00",
        ]);

        DB::table('users')->insert([
            'name'        => "Loraine Derraco",
            'email'       => "loraine@gmail.com",
            'username'    => "loraine123",
            'birth'       => "1997-04-08",
            'created_at'  => "2023-12-16 00:00:00",
        ]);
    }
}
