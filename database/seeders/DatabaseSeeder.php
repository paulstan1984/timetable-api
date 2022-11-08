<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PhisicalResource;
use App\Models\ServiceProvider;
use App\Models\Reservation;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ServiceProvider::factory(1)->create();
        PhisicalResource::factory(2)->create();
        Reservation::factory(4)->create();
        //still working here
    }
}
