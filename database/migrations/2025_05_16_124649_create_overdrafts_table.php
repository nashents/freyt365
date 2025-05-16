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
        Schema::create('overdrafts', function (Blueprint $table) {
               $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('company_id')->constrained()->onDelete('cascade');
                $table->foreignId('wallet_id')->constrained()->onDelete('cascade');
                $table->decimal('limit', 10, 2)->default(0); // e.g., 1000.00
                $table->boolean('is_active')->default(true);
                $table->timestamps();
                $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overdrafts');
    }
};
