<?php


namespace App\Services;

use App\Models\InvoiceItem;

class InvoiceItemFormatter
{
    private static $instance;
    private array $businessSettings;
    private function __construct()
    {
    }
    public static function make(): self
    {
        if (is_null(static::$instance))
            static::$instance = new self();
        return static::$instance;
    }
    public function handle($items, $businessSettings)
    {
        $this->businessSettings = $businessSettings;
        $formattedItems = [];
        foreach ($items as $item) {
            $formattedItems[] = $this->format($item);
        }
        return $formattedItems;
    }
    public function format(InvoiceItem $item)
    {
        $itemFormatted
            = [
                'internalCode' => $item->item_id, //item id
                'description' => $item->name, //description
                'itemType' => 'EGS',
                'itemCode' => $item->item_id, //item id
                'unitType' => 'KGM',
                'quantity' => $item->quantity,
                'unitPrice' => $item->price, //price
                'netSale' => $item->sub_total,
                'totalSale' => $item->sub_total, //subtotal
                'total' => $item->total, //total price

            ];
        if ($item->discount)
            $itemFormatted['commercialDiscountData'] = [
                $this->formatDiscount($item->discount)
            ];
        // dd($itemFormatted);
        return $itemFormatted;
    }
    public function formatDiscount($amount)
    {
        return [
            'description' => 'Discount',
            'amount' => $amount
        ];
    }
    public function formatTax($amount)
    {
        return [
            'taxType' => $this->businessSettings['taxType'],
            'amount' => $amount,
            'subType' => $this->businessSettings['subTypeTax']
        ];
    }
}