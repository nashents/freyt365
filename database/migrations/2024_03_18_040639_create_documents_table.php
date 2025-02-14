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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('folder_id')->nullable();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->bigInteger('horse_id')->nullable()->unsigned();
            $table->bigInteger('trailer_id')->nullable()->unsigned();
            $table->string('category')->nullable();
            $table->string('title')->nullable();
            $table->string('filename')->nullable();
            $table->string('expires_at')->nullable();
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
        Schema::dropIfExists('documents');
    }
};
