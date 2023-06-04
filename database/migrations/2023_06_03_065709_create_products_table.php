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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); //Software-Testing, System-Monitoring
            $table->unsignedBigInteger('singlePrice'); // 6800
            $table->string('unit'); // h, Stk.
            $table->string('currency'); // €, $
            $table->decimal('tax_rate'); // 19
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
