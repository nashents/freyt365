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
            $table->bigInteger('payment_id')->nullable()->unsigned();
            $table->bigInteger('folder_id')->nullable();
            $table->bigInteger('cash_flow_id')->nullable()->unsigned();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->bigInteger('recovery_id')->nullable()->unsigned();
            $table->bigInteger('requisition_id')->nullable()->unsigned();
            $table->bigInteger('agent_id')->nullable()->unsigned();
            $table->bigInteger('purchase_id')->nullable()->unsigned();
            $table->bigInteger('asset_id')->nullable()->unsigned();
            $table->bigInteger('inventory_id')->nullable()->unsigned();
            $table->bigInteger('transporter_id')->nullable()->unsigned();
            $table->bigInteger('clearing_agent_id')->unsigned()->nullable();
            $table->bigInteger('vendor_id')->nullable()->unsigned();
            $table->bigInteger('horse_id')->nullable()->unsigned();
            $table->bigInteger('trailer_id')->nullable()->unsigned();
            $table->bigInteger('vehicle_id')->nullable()->unsigned();
            $table->bigInteger('broker_id')->nullable()->unsigned();
            $table->bigInteger('customer_id')->nullable()->unsigned();
            $table->bigInteger('employee_id')->nullable()->unsigned();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
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
