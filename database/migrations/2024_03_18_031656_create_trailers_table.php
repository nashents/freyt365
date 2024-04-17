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
        Schema::create('trailers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->bigInteger('trailer_make_id')->nullable();
            $table->bigInteger('trailer_model_id')->nullable();
            $table->string('trailer_number')->nullable();
            $table->string('fleet_number')->nullable();
            $table->string('chasis_number')->nullable();
            $table->string('suspension_type')->nullable();
            $table->string('year')->nullable();
            $table->string('color')->nullable();
            $table->string('condition')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('capacity')->nullable();
            $table->string('country_of_origin')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('no_of_wheels')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('service')->default(0);
            $table->boolean('approval')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trailers');
    }
};
