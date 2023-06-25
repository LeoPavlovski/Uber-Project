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
            Schema::create('trips', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->foreign('user_id')->references('id')->on('users');
                $table->unsignedBigInteger('driver_id')->nullable();
                $table->foreign('driver_id')->references('id')->on('drivers');
                $table->boolean('is_started')->default(false);
                $table->boolean('is_completed')->default(false);
                $table->json('origin');
                $table->json('destination')->nullable();
                $table->string('destination_name')->nullable();
                $table->json('driver_location')->nullable();
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
