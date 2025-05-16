<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Cupom extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('coupons')->insert([
            ['value' => 10, 'key' => '7nzUx-NTrYW4'],
            ['value' => 20, 'key' => 'jQ2I7-IwFUKr'],
            ['value' => 30, 'key' => 'pPeS@-$C7CrH'],
            ['value' => 40, 'key' => 'E8eRh-jVV@eR'],
            ['value' => 50, 'key' => 'Gy0Xk-39ufBu']
        ]);
    }
}
