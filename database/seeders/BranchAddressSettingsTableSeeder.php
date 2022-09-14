<?php

namespace Database\Seeders;

use App\Models\BranchAddressSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchAddressSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BranchAddressSetting::insert([
            ['key' => 'country', 'value' => 'EG'],
            ['key' => 'governate', 'value' => 'Giza'],
            ['key' => 'regionCity', 'value' => 'Dokki'],
            ['key' => 'street', 'value' => '17 Nabil Al Wakad'],
            ['key' => 'buildingNumber', 'value' => '17'],
        ]);
    }
}