<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_providers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('phone', 10);
            $table->string('email', 200)->unique();
            $table->timestamps();
        });

        Schema::create('phisical_resources', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description', 1000);
            $table->text('weekly_timetable');//{L: 8-12, M:12-20...}
            $table->string('schedule_type', 10);// minute | hour
            $table->text('schedule_units');//2, 4, 5
            $table->boolean('open')->nullable(false)->default(false);

            $table->timestamps();

            //the id of the service provider
            $table->unsignedBigInteger('service_provider_id');
            $table->foreign('service_provider_id')->references('id')->on('service_providers');
        });


        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('client_name', 100);
            $table->string('client_phone', 10);
            $table->string('client_email', 200);
            
            $table->datetime('start_time');
            $table->string('schedule_unit');
            $table->string('state')->default('Pending');//Pending, Approved, Cancelled

            $table->timestamps();

            //the id of the service
            $table->unsignedBigInteger('phisical_resource_id');
            $table->foreign('phisical_resource_id')->references('id')->on('phisical_resources');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
        Schema::dropIfExists('phisical_resources');
        Schema::dropIfExists('service_providers');
    }
};
