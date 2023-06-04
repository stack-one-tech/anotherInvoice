<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'invoice_date',
        'due_date',
        'product_id',
        'quantity',
        'rate',
        'tax',
        'total',
        'status',
        'user_id',
    ];
}
