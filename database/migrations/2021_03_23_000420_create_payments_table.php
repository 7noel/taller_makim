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
            $table->decimal('exchange', 7, 4);
            $table->bigInteger('bank_id')->unsigned();
            $table->bigInteger('currency_id')->unsigned();

            $table->string('tipo_operacion');
            $table->string('cta_origen');
            $table->string('cta_destino');
            $table->string('titular_destino');
            $table->bigInteger('currency2_id')->unsigned();
            $table->decimal('monto', 12, 2);
            $table->bigInteger('my_company')->unsigned();

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
