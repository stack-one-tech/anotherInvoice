<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'customerNumbr',
        'fullForename',
        'fullSurname',
        'companyName',
        'supplement',
        'road',
        'houseNumber',
        'streetSupplement',
        'zipCode',
        'cityName',
        'country',
        'countryCode',
        'phone',
        'web',
        'email',
        'mimeLogoUrl',
        'mimeLogoScale',
        'iban',
        'bic',
        'taxNumber',
        'bankName',
    ];
}
