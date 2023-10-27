<?php

namespace Database\Seeders;

use Database\Factories\OptionFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OptionFactory::new()->createMany(15);
    }
}
