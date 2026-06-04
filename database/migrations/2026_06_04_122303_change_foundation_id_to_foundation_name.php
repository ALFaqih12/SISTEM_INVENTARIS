<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('m_buildings', function (Blueprint $table) {
            $table->dropColumn('foundation_id');
            $table->string('foundation_name')->nullable();
        });

        Schema::table('m_item_types', function (Blueprint $table) {
            $table->dropColumn('foundation_id');
            $table->string('foundation_name')->nullable();
        });

        Schema::table('m_transaction_type', function (Blueprint $table) {
            $table->dropColumn('foundation_id');
            $table->string('foundation_name')->nullable();
        });
    }

    public function down(): void
    {
        //
    }
};