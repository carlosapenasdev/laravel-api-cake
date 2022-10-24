<?php

namespace Database\Seeders;

use App\Models\Cake;
use App\Models\CakeLead;
use App\Models\Lead;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class CakeLead50kSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::channel('stderr')->info('Seeding Cakes');
        $this->createCakes();

        Log::channel('stderr')->info('Seeding Leads');
        $this->createLeads();

        Log::channel('stderr')->info('Seeding CakeLeads');
        $this->createCakeLeads();

        Log::channel('stderr')->info('Firing Events');
        $this->fireCakeLeadsEvent();

        Log::channel('stderr')->info('Ended CakeLead50kSeeder');
    }

    private function createCakes() {
        $data = [];

        for ($i=0; $i < 50000; $i++) {
            $data[] = Cake::factory()->make()->toArray();
        }

        foreach (array_chunk($data, 1000) as $chunck) {
            Cake::insert($chunck);
        }
    }

    private function createLeads() {
        $data = [];

        for ($i=0; $i < 50000; $i++) {
            $data[] = Lead::factory()->make()->toArray();
        }

        foreach (array_chunk($data, 1000) as $chunck) {
            Lead::insert($chunck);
        }
    }

    private function createCakeLeads() {
        $data = [];

        for ($i=0; $i < 50000; $i++) {
            $data[] = [
                'cake_id' => rand(1,50000),
                'lead_id' => rand(1,50000),
            ];
        }

        foreach (array_chunk($data, 1000) as $chunck) {
            CakeLead::insert($chunck);
        }
    }

    private function fireCakeLeadsEvent() {
        $models = CakeLead::all();
        foreach ($models as $model) {
            event('eloquent.created: App\Models\CakeLead', $model);
        }
    }
}
