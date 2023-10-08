<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Kzulfazriawan',
            'email' => 'kzulfazriawan@example.com',
            'password' => bcrypt('your_password_here'), // Replace with a secure password
            'is_active' => true
        ]);

        $this->call([
            ServicesSeeder::class,
            TransactionsSeeder::class,
            BalancesSeeder::class
        ]);

    }
}
