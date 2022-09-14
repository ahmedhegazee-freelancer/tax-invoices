<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_id',
        'ticket_id',
        'name',
        'quantity',
        'price',
        'sub_total',
        'total',
        'discount',
    ];
    protected $casts = [
        'sub_total' => 'double',
        'total' => 'double',
        'discount' => 'double',
        'quantity' => 'double',
        'quantity' => 'double',
        'price' => 'double',
    ];
}