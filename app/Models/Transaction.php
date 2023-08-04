<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use CrudTrait;
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'invoice_number',
        'stock_code',
        'description',
        'quantity',
        'invoice_date',
        'unit_price',
        'customer_id',
        'country',
        'total_price',
    ];
}
