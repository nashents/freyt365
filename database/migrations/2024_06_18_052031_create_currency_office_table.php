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
        Schema::create('currency_office', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('currency_id')->unsigned()->nullable();
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
            $table->bigInteger('office_id')->unsigned()->nullable();
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency_office');
    }
};
