<?php

namespace App\Services;

use App\Models\BranchAddressSetting;
use App\Models\BusinessSetting;
use App\Models\Invoice;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class InvoiceFormatter
{
    private  static  $instance;
    private array $businessSettings = [];
    private array $branchAddress = [];
    private function __construct()
    {
    }
    public static function make()
    {
        if (!isset(static::$instance)) {
            static::$instance = new InvoiceFormatter();
        }

        return static::$instance->initialize();
    }
    public function initialize()
    {
        Cache::forget('business_settings');
        Cache::forget('branch_address');
        $this->businessSettings = [];
        $this->branchAddress = [];
        if (!count($this->businessSettings)) {
            $this->businessSettings = BusinessSettingsService::make()->get();
        }
        if (!count($this->branchAddress)) {
            $this->branchAddress = BranchAddressService::make()->get();
        }

        return $this;
    }

    public function format(Invoice $invoice, string $previous = "")
    {
        return [
            'header' => $this->formatHeader($invoice->closing_date, $invoice->ticket_id, $previous),
            'documentType' => $this->formatDocument(),
            'seller' => $this->formatSeller($invoice->terminal_id),
            'buyer' => [
                'type' => 'P'
            ],
            'itemData' => InvoiceItemFormatter::make()->handle($invoice->items, $this->businessSettings),
            'totalSales' => $invoice->sub_total, //subtotal
            'totalCommercialDiscount' => $invoice->discount, //total discounts,
            'taxTotals' => $this->formatTax($invoice->tax),
            'paymentMethod' => $this->businessSettings['paymentMethod'],
            'netAmount' => $invoice->sub_total, //subtotal
            'feesAmount' => $invoice->fees, //service charge,
            'totalAmount' => $invoice->total //total price
        ];
    }
    public function formatSeller($terminalId)
    {
        return [
            'rin' => $this->businessSettings['rin'],
            'companyTradeName' => $this->businessSettings['companyTradeName'],
            'branchCode' => $this->businessSettings['branchCode'],
            'branchAddress' => $this->formatBranchAddress(),
            'deviceSerialNumber' => $terminalId, //Terminal ID
            'activityCode' => $this->businessSettings['activityCode']
        ];
    }
    public function formatBranchAddress()
    {
        return $this->branchAddress;
    }
    public function formatTax($taxAmount)
    {
        //get business settings taxType
        return [
            'taxType' => $this->businessSettings['taxType'],
            'amount' => $taxAmount //total tax
        ];
    }
    public function formatDocument()
    {
        return [
            'receiptType' => $this->businessSettings['receiptType'],
            'typeVersion' => $this->businessSettings['typeVersion']
        ];
    }
    public function formatHeader(string $date, string $receiptNumber, string $previous = "")
    {

        return [
            'dateTimeIssued' => Carbon::parse($date)->toIso8601ZuluString(), //closing Date
            'receiptNumber' => $receiptNumber,
            'uuid' => $this->generateUUID($receiptNumber),
            'previousUUID' => !empty($previous) ? $this->generateUUID($previous) : "",
            'currency' => 'EGP',
            'orderdeliveryMode' => $this->businessSettings['Order Delivery Mode'],
        ];
    }
    public function generateUUID(string $id)
    {
        return hash('sha256', $id);
    }
}