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
        Schema::table('sensor', function (Blueprint $table) {
            $table->integer('suhu')->default(0);
            $table->float('kelembaban')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sensor', function (Blueprint $table) {
            $table->dropColumn('suhu');
            $table->dropColumn('kelembaban');
        });
    }
};
