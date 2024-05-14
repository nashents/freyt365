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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->bigInteger('vendor_id')->unsigned()->nullable();
            $table->bigInteger('invoice_id')->unsigned()->nullable();
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->bigInteger('trip_id')->unsigned()->nullable();
            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');
            $table->string('payment_number')->nullable();
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->bigInteger('driver_id')->unsigned()->nullable();
            $table->bigInteger('currency_id')->unsigned()->nullable();
            $table->bigInteger('bank_account_id')->unsigned()->nullable();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('mode_of_payment')->nullable();
            $table->text('specify_other')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('reference_code')->nullable();
            $table->string('pop')->nullable();
            $table->string('amount')->nullable();
            $table->string('drawdown_balance')->default(0);
            $table->string('balance')->nullable();
            $table->string('date')->nullable();
            $table->string('category')->nullable();
            $table->string('type')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
