<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->dateTime('closing_date')->nullable(); //CLOSING_DATE
            $table->unsignedBigInteger('ticket_id')->index(); //ID
            $table->decimal('sub_total');
            $table->decimal('total'); //TOTAL_PRICE
            $table->decimal('discount'); //TOTAL_DISCOUNT
            $table->decimal('tax'); //TOTAL_TAX
            $table->decimal('fees'); //SERVICE_CHARGE
            $table->string('terminal_id'); //TERMINAL_ID
            $table->boolean('paid');
            $table->boolean('deleted');
            $table->boolean('voided');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};