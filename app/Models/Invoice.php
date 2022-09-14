<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'closing_date',
        'ticket_id',
        'sub_total',
        'total',
        'discount',
        'tax',
        'fees',
        'terminal_id',
        'paid',
        'voided',
        'deleted',
    ];
    protected $casts = [
        'sub_total' => 'double',
        'total' => 'double',
        'discount' => 'double',
        'tax' => 'double',
        'fees' => 'double',
    ];
    public function items()
    {
        return $this->hasMany(InvoiceItem::class, 'ticket_id', 'ticket_id')->select([
            'item_id',
            'ticket_id',
            'name',
            'quantity',
            'price',
            'sub_total',
            'total',
            'discount',
        ]);
    }
}