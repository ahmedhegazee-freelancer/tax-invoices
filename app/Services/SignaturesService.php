<?php

namespace App\Services;

use App\Models\Signature;
use Illuminate\Support\Facades\Cache;

class SignaturesService
{
    private static $instance;
    private function __construct()
    {
    }
    public static function make(): SignaturesService
    {
        if (is_null(static::$instance))
            static::$instance = new self();
        return static::$instance;
    }
    public function update(array $data)
    {
        Signature::upsert($data, ['signatureType', 'value'], ['signatureType', 'value']);
        Cache::forget('signatures');
        return $this->get();
    }

    public function get()
    {
        return Cache::rememberForever('branch_address', function () {
            return Signature::select(['signatureType', 'value'])->get()->toArray();
        });
    }
}