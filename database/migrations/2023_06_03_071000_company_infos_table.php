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
        Schema::create('company_infos', function (Blueprint $table) {
            $table->id();
            $table->string('customerNumbr'); //KD11
            $table->string('fullForename'); //Maria
            $table->string('fullSurname');    //Musterfrau
            $table->string('companyName');  //Musterfirma GmbH
            $table->string('supplement');  //z.Hd. Frau Musterfrau
            $table->string('road');  // Musterstraße
            $table->string('houseNumber');  // 1
            $table->string('streetSupplement');  // EG
            $table->string('zipCode');  // 04103
            $table->string('cityName');  // Leipzig
            $table->string('country');  // Deutschland
            $table->string('countryCode');  // DE
            $table->string('phone');  // +49 341 1234567
            $table->string('web');  // www.musterfirma.de
            $table->string('email');  // info@musterfirma.de
            $table->string('mimeLogoUrl');  // https://cdn.pictro.de/Test/logoTest.png
            $table->string('mimeLogoScale');  // 0.25
            $table->string('iban');  // DE02100100100006820101
            $table->string('bic');  //PBNKDEFF
            $table->string('taxNumber');  // DE123456789
            $table->string('bankName');  // Postbank
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
