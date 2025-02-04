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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->bigInteger('receiving_wallet_id')->unsigned()->nullable();
            $table->bigInteger('parent_transaction_id')->unsigned()->nullable();
            $table->bigInteger('wallet_id')->unsigned()->nullable();
            $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('cascade');
            $table->bigInteger('currency_id')->unsigned()->nullable();
            $table->bigInteger('charge_id')->unsigned()->nullable();
            $table->string('transaction_number')->nullable();
            $table->string('transaction_reference')->nullable();
            $table->bigInteger('transaction_type_id')->unsigned()->nullable();
            $table->string('mop')->nullable();
            $table->string('movement')->nullable();
            $table->string('charge')->nullable();
            $table->string('charge_amount')->nullable();
            $table->string('amount')->nullable();
            $table->string('wallet_balance')->nullable();
            $table->string('transaction_date')->nullable();
            $table->string('reference_code')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->bigInteger('authorized_by_id')->unsigned()->nullable();
            $table->foreign('authorized_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('authorization')->default('pending');
            $table->text('reason')->nullable();
            $table->bigInteger('verified_by_id')->unsigned()->nullable();
            $table->foreign('verified_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('verification')->default('pending');
            $table->text('verification_reason')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
