<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_invoice_quote')->nullable();
            $table->foreign('id_invoice_quote')->references('id')->on('invoice_quote')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->integer('price')->nullable();
            $table->float('amount', 8, 2)->nullable();
            $table->integer('total')->nullable();
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
        Schema::dropIfExists('records_services');
    }
}
