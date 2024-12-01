<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        DB::table('users')->insert([
            'username' => 'roktaroka',
            'email' => 'aroktaroka@gmail.com',
            'password' => Hash::make('roktaroka'),
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
