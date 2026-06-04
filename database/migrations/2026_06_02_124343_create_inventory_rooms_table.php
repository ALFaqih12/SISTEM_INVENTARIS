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
        Schema::create('t_inventory_room', function (Blueprint $table) {

            $table->id('inventory_room_id');

            $table->string('status')->default('active');

            $table->date('inventory_date');

            $table->foreignId('inventory_id')
                ->constrained(
                    't_inventory',
                    'inventory_id'
                )
                ->cascadeOnDelete();

            $table->foreignId('room_id')
                ->constrained(
                    'm_rooms',
                    'room_id'
                )
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_rooms');
    }
};
