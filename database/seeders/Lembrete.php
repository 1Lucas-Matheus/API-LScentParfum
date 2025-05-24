<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Lembrete extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reminders')->insert([
            ['reminder' => 'Pagamento futuro', 'dateTime' => '2025/02/20'],
            ['reminder' => 'Promoção dia das mães', 'dateTime' => '2026/04/19'],
            ['reminder' => 'Aniversário de 1 ano', 'dateTime' => '2026/05/01'],
            ['reminder' => 'Aniversário de 2 anos', 'dateTime' => '2027/05/01'],
            ['reminder' => 'Aniversário de 3 anos', 'dateTime' => '2028/05/01'],
            ['reminder' => 'Aniversário de 4 anos', 'dateTime' => '2029/05/01'],
            ['reminder' => 'Aniversário de 5 anos', 'dateTime' => '2030/05/01']
        ]);
    }
}
