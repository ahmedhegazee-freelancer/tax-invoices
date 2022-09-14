<?php

namespace App\Services;

use App\Models\BusinessSetting;
use Illuminate\Support\Facades\Cache;

class BusinessSettingsService
{
    private static BusinessSettingsService $instance;
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
        BusinessSetting::upsert($data, ['key'], ['value']);
        Cache::forget('business_settings');
        return $this->get();
    }

    public function get()
    {
        return Cache::rememberForever('business_settings', function () {
            return BusinessSetting::select(['key', 'value'])->get()->pluck('value', 'key')->toArray();
        });
    }
}