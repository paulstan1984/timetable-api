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
            $table->timestamps();

            //the id of the service provider
            $table->unsignedBigInteger('service_provider_id');
            $table->foreign('service_provider_id')->references('id')->on('service_providers');
        });

        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('phone', 10);
            $table->string('email', 200)->unique();
            $table->timestamps();
        });

        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();

            //the id of the service provider
            $table->unsignedBigInteger('service_provider_id');
            $table->foreign('service_provider_id')->references('id')->on('service_providers');
        });

        Schema::create('open_days', function (Blueprint $table) {
            $table->id();
            $table->integer('type');//0-Sunday, 6-Monday

            //the id of the timetable
            $table->unsignedBigInteger('timetable_id');
            $table->foreign('timetable_id')->references('id')->on('timetables');
        });

        Schema::create('open_times', function (Blueprint $table) {
            $table->id();
            $table->time('start_time');
            $table->time('end_time');

            //the id of the openday
            $table->unsignedBigInteger('open_day_id');
            $table->foreign('open_day_id')->references('id')->on('open_days');

        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('type', 10);
            $table->integer('duration');

            //the id of the phisical resource
            $table->unsignedBigInteger('phisical_resource_id');
            $table->foreign('phisical_resource_id')->references('id')->on('phisical_resources');

        });

        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->datetime('start_time');
            $table->string('state');//Pending, Approved, Cancelled

            //the id of the client
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');

            //the id of the timetable
            $table->unsignedBigInteger('timetable_id');
            $table->foreign('timetable_id')->references('id')->on('timetables');

            //the id of the service
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services');
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
        Schema::dropIfExists('services');
        Schema::dropIfExists('open_times');
        Schema::dropIfExists('open_days');
        Schema::dropIfExists('timetables');
        Schema::dropIfExists('clients');
        Schema::dropIfExists('phisical_resources');
        Schema::dropIfExists('service_providers');
    }
};
