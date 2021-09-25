<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProofsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proofs', function (Blueprint $table) {

            $table->id();
            $table->date('issued_at'); // fecha de emision
            $table->boolean('is_import'); // true si es una importacion
            $table->string('proof_type'); // typo de documento
            $table->boolean('mov'); // 1 ingresa mercaderia, 0 sale mercaderia
            $table->string('type_op'); // segun ello afecta el valor promedio
            $table->bigInteger('car_id')->unsigned();
            $table->string('placa');
            $table->bigInteger('company_id')->unsigned();
            $table->bigInteger('my_company')->unsigned();
            $table->integer('sunat_transaction')->unsigned();
            $table->integer('igv_code')->unsigned();
            $table->bigInteger('document_type_id')->unsigned();
            $table->string('sn');
            $table->string('series');
            $table->string('number');
            // Guia para las compras
            $table->date('dispatch_note_date');
            $table->string('dispatch_note_number');
            $table->string('dam');
            // Guia de Remisión
            $table->bigInteger('company_store_id')->unsigned(); // sucursal del cliente
            $table->bigInteger('transfer_reason_id')->unsigned(); // motivo de traslado
            $table->bigInteger('shipper_id')->unsigned(); // transportista
            // Condiciones de pago
            $table->bigInteger('payment_condition_id')->unsigned();
            $table->date('expired_at'); // fecha de vencimiento

            $table->bigInteger('currency_id')->unsigned();
            $table->decimal('exchange', 10, 4); // tipo de cambio dolar
            $table->decimal('exchange2', 10, 4); // tipó de cambio euro
            $table->boolean('with_tax'); // true si los montos unitarios es incluido igv
            $table->decimal('total_descuento', 12,2);
            $table->decimal('total_anticipo', 12,2);
            $table->decimal('total_gravada', 12,2);
            $table->decimal('total_gratuita', 12,2);
            $table->decimal('gross_value', 12,2);
            $table->decimal('discount', 12,2);
            $table->decimal('discount_items',15,2);
            $table->decimal('subtotal',14,2);
            $table->decimal('tax',14,2);
            $table->decimal('total',14,2);
            $table->decimal('factor',10,4); // para exportaciones
            $table->decimal('amortization', 12, 2);
            $table->bigInteger('seller_id')->unsigned(); // id del vendedor
            $table->bigInteger('swap_id')->unsigned(); // id del canje para las letras
            $table->bigInteger('reference_id')->unsigned(); // referencia id de guia (para FA y BO), de FA BO (para las NC y ND)
            $table->integer('status_id')->unsigned();
            $table->string('status_sunat');
            $table->boolean('send_sunat');
            $table->text('response_sunat');
            $table->text('response_voided');
            $table->text('ticket_voided');
            $table->string('email');
            $table->string('email_1');
            $table->string('email_2');

            $table->foreign('my_company')->references('id')->on('companies');
            $table->foreign('company_id')->references('id')->on('companies');
            // $table->foreign('seller_id')->references('id')->on('employees');
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
        Schema::dropIfExists('proofs');
    }
}
