<?php

namespace App\Services;

use App\Models\BusinessSetting;
use Illuminate\Support\Carbon;



class HeaderFormatter
{
    private static HeaderFormatter $instance;
    private function __construct()
    {
    }
    public static function make(): HeaderFormatter
    {
        if (!isset(static::$instance))
            static::$instance = new HeaderFormatter();
        return static::$instance;
    }
}