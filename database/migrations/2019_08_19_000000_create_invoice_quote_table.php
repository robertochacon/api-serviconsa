<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceQuoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_quote', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('client')->nullable();
            $table->string('attended')->nullable();
            $table->string('taxes')->nullable();
            $table->string('discount')->nullable();
            $table->string('total')->nullable();
            $table->string('observation')->nullable();
            $table->string('terms')->nullable();
            $table->enum('type',['invoice','quote'])->default('quote');
            $table->enum('status',['active','inactive'])->default('active');
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
        Schema::dropIfExists('invoice_quote');
    }
}
