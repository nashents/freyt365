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
            $table->bigInteger('border_id')->unsigned()->nullable();
            $table->string('clearing_agent_number')->nullable();
            $table->string('name')->nullable();
            $table->string('phonenumber')->nullable();
            $table->string('worknumber')->nullable();
            $table->string('used_by')->nullable();
            $table->string('email')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('suburb')->nullable();
            $table->string('street_address')->nullable();
            $table->string('status')->nullable();
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
