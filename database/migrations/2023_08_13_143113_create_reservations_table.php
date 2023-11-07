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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->integer('type');
            $table->integer('facility_id');
            $table->string('reference_number', 255)->unique();
            $table->string('source')->default('admin');
            $table->string('client_name');
            $table->string('client_id');
            $table->string('client_country');
            $table->string('client_phone');
            $table->date('check_in');
            $table->date('check_out');
            $table->json('special_requests')->nullable();
            $table->integer('status')->default(0);
            $table->decimal('total_cost', 10, 2);
            $table->timestamps();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
