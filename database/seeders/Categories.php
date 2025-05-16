<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Categories extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Amadeirado'],
            ['id' => 2, 'name' => 'Floral'],
            ['id' => 3, 'name' => 'Cítrico'],
            ['id' => 4, 'name' => 'Oriental'],
            ['id' => 5, 'name' => 'Aquático']
        ]);
    }
}
