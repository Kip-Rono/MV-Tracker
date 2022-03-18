<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotorVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motor_vehicle', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('reg_no', 20)->unique();
            $table->string('year_of_man', 10);
            $table->string('vehicle_type', 50)->nullable();
            $table->integer('tonnage')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('motor_vehicle');
    }
}
