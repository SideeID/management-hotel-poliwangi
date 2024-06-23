<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RatePlan;

class RatePlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RatePlan::create([
            'tipe_rooms' => 'Standart Room',
            'price' => 1000,
        ]);

        RatePlan::create([
            'tipe_rooms' => 'VIP Room',
            'price' => 1500,
        ]);
    }
}
