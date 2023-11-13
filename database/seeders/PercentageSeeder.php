<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Percentage;

class PercentageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Percentage::create([
            'percentage' => 10,
        ]);
    }
}
