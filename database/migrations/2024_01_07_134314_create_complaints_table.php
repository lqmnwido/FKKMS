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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('complaint_ID')->unique();
            $table->string('User_ID');
            $table->string('PupukAdmin_ID');
            $table->string('FKTechnicalTeam_ID');
            $table->integer('complaintCategory_ID');
            $table->integer('complaintStatus_ID');
            $table->DATE('Date');
            $table->time('Time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
