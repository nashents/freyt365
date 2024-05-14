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
        Schema::create('clearing_agents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('phonenumber')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->string('city')->nullable();
            $table->string('suburb')->nullable();
            $table->string('street_address')->nullable();
            $table->boolean('status')->nullable()->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clearing_agents');
    }
};
