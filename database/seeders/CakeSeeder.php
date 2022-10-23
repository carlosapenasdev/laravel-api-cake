<?php

namespace Database\Seeders;

use App\Models\Cake;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cake::factory(5)->hasLeads(5)->create();
    }
}
