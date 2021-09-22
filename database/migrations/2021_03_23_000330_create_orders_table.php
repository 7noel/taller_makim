<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.@
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->boolean('mov');
            $table->string('sn'); // numero correlativo para cotizaciones y pedidos para las 3 empresas
            $table->string('order_type'); // typo de documento {1=>'order', 2=>'quote'}
            $table->string('type_op'); // segun ello afecta el valor promedio
            $table->bigInteger('document_type_id')->unsigned();
            $table->bigInteger('company_id')->unsigned();
            $table->bigInteger('car_id')->unsigned();
            $table->string('placa');
            $table->decimal('kilometraje', 12,0);
            $table->string('type_service');
            $table->string('preventivo');
            $table->bigInteger('branch_id')->unsigned();
            $table->bigInteger('shipper_id')->unsigned();
            $table->bigInteger('shipper_branch_id')->unsigned();
            $table->bigInteger('payment_condition_id')->unsigned();
            $table->bigInteger('currency_id')->unsigned();
            $table->string('attention');
            $table->string('matter');
            $table->string('delivery_period');
            $table->string('installation_period');
            $table->string('delivery_place');
            $table->string('offer_period');
            $table->bigInteger('seller_id')->unsigned();
            $table->dateTime('approved_at')->nullable();
            $table->dateTime('checked_at')->nullable();
            $table->dateTime('invoiced_at')->nullable();
            $table->dateTime('sent_at')->nullable();
            $table->dateTime('canceled_at')->nullable();
            $table->string('status');
            $table->boolean('with_tax');
            $table->decimal('gross_value', 12,2);
            $table->decimal('discount', 12,2);
            $table->decimal('discount_items',15,2);
            $table->decimal('subtotal', 12,2);
            $table->decimal('tax', 12,2);
            $table->decimal('total', 12,2);
            $table->decimal('amortization', 12,2);
            $table->decimal('exchange', 12,2);
            $table->decimal('exchange_sunat', 12,2);
            $table->bigInteger('order_id')->unsigned(); // id del pedido relacionado (solo para cotizacion)
            $table->bigInteger('proof_id')->unsigned(); // id del comprobante (solo para pedido)
            $table->bigInteger('user_id')->unsigned();
            $table->text('comment');
            $table->bigInteger('my_company')->unsigned();

            $table->foreign('my_company')->references('id')->on('companies');
            $table->foreign('company_id')->references('id')->on('companies');
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
        Schema::dropIfExists('orders');
    }
}
