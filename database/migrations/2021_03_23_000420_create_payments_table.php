<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->unsigned();
            $table->date('issued_at');
            $table->string('number');
            $table->boolean('is_output');
            $table->decimal('value', 12, 2);
            $table->decimal('input', 12, 2);
            $table->decimal('output', 12, 2);
            $table->decimal('exchange', 7, 4);
            $table->bigInteger('proof_id')->unsigned();
            $table->bigInteger('bank_id')->unsigned();
            $table->integer('metodo');
            $table->bigInteger('currency_id')->unsigned();
            $table->bigInteger('my_company')->unsigned();
            $table->string('description');

            $table->foreign('bank_id')->references('id')->on('banks');
            $table->foreign('my_company')->references('id')->on('companies');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
