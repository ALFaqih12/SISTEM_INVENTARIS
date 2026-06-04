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
        Schema::create('t_inventory', function (Blueprint $table) {

            $table->id('inventory_id');

            $table->integer('quantity')->default(0);

            $table->decimal('price', 18, 2)->default(0);

            $table->text('spesification')->nullable();

            $table->string('status')->default('available');

            $table->string('foto')->nullable();

            $table->text('description')->nullable();

            $table->string('merk')->nullable();

            $table->string('barcode')->nullable();

            $table->date('expired_date')->nullable();

            $table->foreignId('item_id')
                ->constrained('m_items', 'item_id');

            $table->foreignId('inventory_transaction_id')
                ->constrained(
                    't_inventory_transactions',
                    'inventory_transaction_id'
                );

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
