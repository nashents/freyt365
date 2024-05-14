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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('invoice_number')->nullable();
            $table->string('number')->nullable();
            $table->bigInteger('discount_id')->unsigned()->nullable();
            $table->bigInteger('bank_account_id')->unsigned()->nullable();
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->bigInteger('trip_id')->unsigned()->nullable();
            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');
            $table->bigInteger('currency_id')->unsigned()->nullable();
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
            $table->text('subheading')->nullable();
            $table->text('footer')->nullable();
            $table->text('memo')->nullable();
            $table->string('date')->nullable();
            $table->string('expiry')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('vat')->nullable();
            $table->string('vat_amount')->nullable();
            $table->string('total')->nullable();
            $table->string('balance')->nullable();
            $table->string('exchange_rate')->nullable();
            $table->string('exchange_amount')->nullable();
            $table->bigInteger('authorized_by_id')->unsigned()->nullable();
            $table->foreign('authorized_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('authorization')->default('pending');
            $table->text('comments')->nullable();
            $table->text('reason')->nullable();
            $table->string('status')->default('Unpaid');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
