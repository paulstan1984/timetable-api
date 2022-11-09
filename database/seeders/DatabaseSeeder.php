<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PhisicalResource;
use App\Models\ServiceProvider;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('reservations')->truncate();
        // DB::table('phisical_resources')->truncate();
        // DB::table('service_providers')->truncate();
        
        ServiceProvider::factory(1, [
            'name' => 'Baza Sportivă Transilvania',
            'phone' => '0745777898',
            'email' => 'office@clubtransilvania.ro'
        ])->has(PhisicalResource::factory(2,  [
            'name' => 'Teren de tenis',
            'description' => 'Teren de tenis cu zgură',
            'weekly_timetable' => json_encode([
                ['Mo' => '8-20'],
                ['Tu' => '8-20'],
                ['We' => '8-20'],
                ['Th' => '8-20'],
                ['Fr' => '8-20'],
                ['Sa' => '8-20'],
                ['Su' => '8-20'],
            ]),
            'schedule_type' => 'hour',
            'schedule_units' => json_encode(['1', '2']),
            'open' => true,

        ]), 'phisical_resources')
        ->create();
        ;
        // Reservation::factory(4)->create();
        //still working here
    }
}
