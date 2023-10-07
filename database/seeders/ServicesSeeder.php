<?php

namespace Database\Seeders;

use App\Models\Services;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['name' => 'BCA VA','is_active' => 1],
            ['name' => 'GOPAY','is_active' => 1],
            ['name' => 'DANA','is_active' => 1]
        ];

        foreach($services as $items){
            Services::create($items);
        }
    }
}
