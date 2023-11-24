<?php

namespace Database\Seeders;

use App\Models\Estate;
use Database\Factories\EstateFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class EstateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EstateFactory::new()
            ->for(UserFactory::new())
            ->createMany(15);
    }
}
