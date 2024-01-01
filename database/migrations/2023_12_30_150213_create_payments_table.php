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
            $table->string('Payment_ID')->unique();
            $table->string('User_ID')->unique();
            $table->string('PaymentType')->nullable();
            $table->integer('PaymentMonth');
            $table->DATE('PaymentDate');
            $table->double('Price');
            $table->double('Total_Price');
            $table->timestamps();
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
