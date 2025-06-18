<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin123@example.com',
            'password' => bcrypt('admin123'),
        ]);

        $this->call([
            Categories::class,
            Perfumes::class,
            Cupom::class,
            Lembrete::class
        ]);
    }
}
