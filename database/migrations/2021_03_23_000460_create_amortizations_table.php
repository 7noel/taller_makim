<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmortizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amortizations', function (Blueprint $table) {
            $table->id();
            $table->decimal('value_proof', 12, 2);
            $table->decimal('value_payment', 12, 2);
            $table->bigInteger('proof_id')->unsigned();
            $table->bigInteger('payment_id')->unsigned();
            $table->bigInteger('my_company')->unsigned();

            $table->foreign('my_company')->references('id')->on('companies');
            $table->foreign('proof_id')->references('id')->on('proofs');
            $table->foreign('payment_id')->references('id')->on('payments');
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
        Schema::dropIfExists('amortizations');
    }
}
