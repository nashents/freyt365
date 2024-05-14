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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->string('trip_number')->nullable();
            $table->string('number')->nullable();
            $table->string('trip_ref')->nullable();
            $table->bigInteger('horse_id')->nullable();
            $table->bigInteger('driver_id')->unsigned()->nullable();
            $table->string('customer_id')->nullable();
            $table->bigInteger('currency_id')->nullable();
            $table->string('offloading_point')->nullable();
            $table->string('loading_point')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('cargo')->nullable();
            $table->string('start_date')->nullable();
            $table->string('weight')->nullable()->default(0);
            $table->string('litreage')->nullable()->default(0);
            $table->string('rate')->nullable()->default(0);
            $table->string('freight')->nullable()->default(0);
            $table->string('status')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
    });
            
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
