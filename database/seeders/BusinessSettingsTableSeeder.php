<?php

namespace Database\Seeders;

use App\Models\BusinessSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BusinessSetting::insert([
            ['key' => 'receiptType', 'value' => 's'],
            ['key' => 'typeVersion', 'value' => '1.1'],
            ['key' => 'Order Delivery Mode', 'value' => 'FC'],
            ['key' => 'rin', 'value' => '###'],
            ['key' => 'companyTradeName', 'value' => '###'],
            ['key' => 'branchCode', 'value' => '###'],
            // ['key' => 'Device Serial Number', 'value' => '###'],
            // ['key' => 'Syndicate License Number', 'value' => '###'],
            ['key' => 'activityCode', 'value' => '###'],
            ['key' => 'taxType', 'value' => 'T1'],
            ['key' => 'subTypeTax', 'value' => 'V001'],
            ['key' => 'paymentMethod', 'value' => 'C'],

        ]);
    }
}