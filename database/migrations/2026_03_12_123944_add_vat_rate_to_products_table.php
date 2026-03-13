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
    Schema::table('products', function (Blueprint $table) {
        $table->integer('vat_rate')->default(23)->after('price'); // Dodaje kolumnę VAT po cenie
    });
}

    /**
     * Reverse the migrations.
     */
public function down(): void
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('vat_rate');
    });
}
};
