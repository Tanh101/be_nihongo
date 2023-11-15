<?php

namespace Database\Seeders;

use App\Models\Mean;
use Database\Factories\MeanFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeaningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mean::factory()->count(10)->create();
    }
}
