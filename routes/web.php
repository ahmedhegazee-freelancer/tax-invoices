<?php

use App\Models\Invoice;
use App\Models\User;
use App\Services\DatabaseService;
use App\Services\HeaderFormatter;
use App\Services\InvoiceFormatter;
use App\Services\InvoiceService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Str;

Route::get('/', function () {

    return view('welcome');
});


Route::get('invoices', function () {
    return InvoiceService::make()->getLastInvoiceDate();
});