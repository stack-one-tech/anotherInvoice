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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reciverID');
            $table->string('invoiceNumber'); // RE4123
            $table->string('invoiceDate');    // 02.02.2024
            $table->string('customerNumber');  // NEK004
            $table->string('openingText');  // "Sehr geehrte Damen und Herren,\n hiermit stellen wir Ihnen die Rechnung für unsere Leistungenaus."
            $table->string('closingText');  // "Wir danken für Ihr Vertrauen und freuen uns auf eine weitere Zusammenarbeit.\n Mit freundlichen Grüßen,\n Maria Musterfrau"
            $table->string('paymentTerms');  // "Zahlbar innerhalb von 14 Tagen ohne Abzug."
            $table->json('invoice_items');  // {"1":{"product_id":1, "qty":44.6}, "2":{"product_id":3, "qty":1}, "3":{"product_id":3, "qty":1}}
            $table->string('ustNotice');  // "Umsatzsteuerbefreit nach § 19 UStG"
            $table->string('serviceTimeText');  // "Leistungszeitraum: 04.05.2023 - 04.06.2023"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
