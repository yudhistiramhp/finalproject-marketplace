<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        DB::table('products')->insert([
            'name' => 'Mouse Fantech',
            'image_link' => '',
            'category_id' => 1,
            'brand_id' => 1,
            'price' => 170000,
            'stock' => 10,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
