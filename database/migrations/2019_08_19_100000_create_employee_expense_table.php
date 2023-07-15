<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeExpenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_expense', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_employee')->nullable();
            $table->foreign('id_employee')->references('id')->on('employees');
            $table->string('description')->nullable();
            $table->integer('total')->nullable();
            $table->enum('type',['commissions','diet','fuel'])->default('commissions');
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
        Schema::dropIfExists('employee_expense');
    }
}
