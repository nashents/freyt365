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
        Schema::create('fuel_type_office', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('office_id')->unsigned()->nullable();
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('cascade');
            $table->bigInteger('fuel_type_id')->unsigned()->nullable();
            $table->foreign('fuel_type_id')->references('id')->on('fuel_types')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuel_type_office');
    }
};
