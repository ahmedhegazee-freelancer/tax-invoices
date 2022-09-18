<?php

namespace App\Services;

use App\Models\BranchAddressSetting;

use Illuminate\Support\Facades\Cache;

class BranchAddressService
{
    private static BranchAddressService $instance;
    private function __construct()
    {
    }
    public static function make()
    {
        if (!isset(static::$instance))
            static::$instance = new self();
        return static::$instance;
    }
    public function update(array $data)
    {
        BranchAddressSetting::upsert($data, ['key'], ['value']);
        Cache::forget('branch_address');
        return $this->get();
    }

    public function get()
    {
        return Cache::rememberForever('branch_address', function () {
            return BranchAddressSetting::select(['key', 'value'])->get()->pluck('value', 'key')->toArray();
        });
    }
}