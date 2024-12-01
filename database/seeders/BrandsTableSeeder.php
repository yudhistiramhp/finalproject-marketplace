<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        DB::table('brands')->insert([
            'name' => 'Fantech',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('brands')->insert([
            'name' => 'Lenovo',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('brands')->insert([
            'name' => 'SIDU',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('brands')->insert([
            'name' => 'Nike',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('brands')->insert([
            'name' => 'Adidas',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
