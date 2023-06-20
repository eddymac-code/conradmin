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
        Schema::create('room_reservations', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number', 255)->unique();
            $table->string('source')->default('admin');
            $table->string('guest_name');
            $table->string('guest_id');
            $table->string('country');
            $table->string('phone');
            $table->foreignId('room_id')->constrained();
            $table->date('check_in');
            $table->date('check_out');
            $table->time('time_in');
            $table->time('time_out');
            $table->json('special_requests')->nullable();
            $table->integer('status')->default(0);
            $table->decimal('total_cost', 10, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_reservations');
    }
};
