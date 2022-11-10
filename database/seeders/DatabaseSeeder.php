<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PhisicalResource;
use App\Models\ServiceProvider;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservations')->delete();
        DB::table('phisical_resources')->delete();
        DB::table('service_providers')->delete();
        
        $service_provider = ServiceProvider::factory(1, [
            'name' => 'Baza Sportivă Transilvania',
            'phone' => '0742321007',
            'email' => 'office@clubtransilvania.ro'
        ])->has(PhisicalResource::factory(2)->state(new Sequence(
            [
                'name' => 'Teren de tenis 1',
                'description' => 'Teren de tenis cu zgură',
                'weekly_timetable' => json_encode([
                    'Mo' => [8, 20],
                    'Tu' => [8, 20],
                    'We' => [8, 12, 14, 20],
                    'Th' => [8, 20],
                    'Fr' => [8, 20],
                    'Sa' => [],
                    'Su' => [],
                ]),
                'schedule_type' => 'hour',
                'schedule_units' => json_encode(['1' => 'O oră', '2' => 'două ore']),
                'open' => true,

            ],
            [
                'name' => 'Teren de tenis 2',
                'description' => 'Teren de tenis cu zgură',
                'weekly_timetable' => json_encode([
                    'Mo' => [8, 20],
                    'Tu' => [8, 20],
                    'We' => [8, 12, 14, 20],
                    'Th' => [8, 20],
                    'Fr' => [8, 20],
                    'Sa' => [],
                    'Su' => [],
                ]),
                'schedule_type' => 'hour',
                'schedule_units' => json_encode(['1' => 'O oră', '2' => 'două ore']),
                'open' => true,

            ]
        )), 'phisical_resources')
        ->create()
        ->first();
        
        Reservation::factory(5)->state(new Sequence(
            [
                'start_time' => '2022-11-10 9:00',
                'schedule_unit' => 2,
                'phisical_resource_id' => $service_provider->phisical_resources->first()->id
            ],
            [
                'start_time' => '2022-11-11 9:00',
                'schedule_unit' => 1,
                'phisical_resource_id' => $service_provider->phisical_resources->first()->id
            ],
            [
                'start_time' => '2022-11-14 9:00',
                'schedule_unit' => 2,
                'phisical_resource_id' => $service_provider->phisical_resources->last()->id
            ],
            [
                'start_time' => '2022-11-15 9:00',
                'schedule_unit' => 2,
                'phisical_resource_id' => $service_provider->phisical_resources->first()->id
            ],
            [
                'start_time' => '2022-11-10 10:00',
                'schedule_unit' => 1,
                'phisical_resource_id' => $service_provider->phisical_resources->last()->id
            ]
        ))->create();
        
    }
}
