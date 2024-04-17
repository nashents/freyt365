<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('horses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->bigInteger('horse_make_id')->nullable();
            $table->bigInteger('horse_model_id')->nullable();
            $table->string('horse_number')->nullable();
            $table->string('fleet_number')->nullable();
            $table->string('year')->nullable();
            $table->string('color')->nullable();
            $table->string('condition')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('country_of_origin')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('mileage')->nullable();
            $table->string('next_service')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('fuel_measurement')->nullable();
            $table->string('track_usage')->nullable();
            $table->string('fuel_consumption')->nullable()->default(0);
            $table->string('fuel_tank_capacity')->default(0);
            $table->string('fuel_balance')->default(0);
            $table->string('no_of_wheels')->default(10);
            $table->string('chasis_number')->nullable();
            $table->string('engine_number')->nullable();
            $table->string('engine_type')->nullable();
            $table->string('engine_cpl')->nullable();
            $table->string('gearbox_type')->nullable();
            $table->string('differential_type')->nullable();
            $table->string('differential_ratio')->nullable();
            $table->string('compressor_size')->nullable();
            $table->string('compressor_type')->nullable();
            $table->string('universal_j_size')->nullable();
            $table->string('rear_spring_type')->nullable();
            $table->string('front_spring_type')->nullable();
            $table->string('flange_size')->nullable();
            $table->string('steering_box_type')->nullable();
            $table->string('cab_type')->nullable();
            $table->string('air_dryer_system')->nullable();
            $table->string('fifth_wheel_type')->nullable();
            $table->string('starter_type')->nullable();
            $table->string('starter_size')->nullable();
            $table->string('alternator_size')->nullable();
            $table->string('alternator_type')->nullable();
            $table->string('fuel_filtering_type')->nullable();
            $table->string('king_pin_type')->nullable();
            $table->string('fan_belt_type')->nullable();
            $table->string('fan_belt_size')->nullable();
            $table->string('water_pump_belt_type')->nullable();
            $table->string('water_pump_belt_size')->nullable();
            $table->string('engine_mounting_type')->nullable();
            $table->string('steering_reservoir')->nullable();
            $table->string('braking_system_type')->nullable();
            $table->string('clutch_size')->nullable();
            $table->string('tnak_rhs')->nullable();
            $table->string('battery_size')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('service')->default(0);
            $table->boolean('approval')->default(0);
            $table->boolean('mechanical')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horses');
    }
};
