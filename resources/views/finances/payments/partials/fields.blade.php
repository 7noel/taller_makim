{!! Form::hidden('my_company', session('my_company')->id, ['id'=>'my_company']) !!}
{!! Form::hidden('currency_id', 1, ['id'=>'proof_id']) !!}
@if($proof)
{!! Form::hidden('proof_id', $proof->id, ['id'=>'proof_id']) !!}
@endif

<div class="form-row">
	<div class="col-sm-2">
		<label>Comprobante</label>
		{{-- <p class="form-control-plaintext">{{ $proof->document_type->description." ".$proof->sn }}</p> --}}
		<p class="form-control-plaintext">{{ $proof->sn }}</p>
	</div>
	<div class="col-sm-4">
		<label>Cliente/Proveedor</label>
		<p class="form-control-plaintext">{{ $proof->company->company_name }}</p>
	</div>
	<div class="col-sm-1">
		<label>Emisión</label>
		<p class="form-control-plaintext">{{ date('d/m/y', strtotime($proof->issued_at)) }}</p>
	</div>
	<div class="col-sm-1">
		<label>Vence</label>
		<p class="form-control-plaintext">{{ date('d/m/y', strtotime($proof->expired_at)) }}</p>
	</div>
	<div class="col-sm-1">
		<label for="total">Total Comp.</label>
		<p class="form-control-plaintext">{{ config('options.table_sunat.moneda_symbol.'.$proof->currency_id) .' '.$proof->total }}</p>
	</div>
	<div class="col-sm-1">
		<label for="deuda">Pagado</label>
		<p class="form-control-plaintext" id="deuda">{{ config('options.table_sunat.moneda_symbol.'.$proof->currency_id) .' '.$proof->amortization }}</p>
	</div>
	<div class="col-sm-1">
		<label for="deuda">Deuda</label>
		<p class="form-control-plaintext" id="deuda">{{ config('options.table_sunat.moneda_symbol.'.$proof->currency_id) .' '.round($proof->total - $proof->amortization, 2) }}</p>
	</div>
</div>
<div class="form-row">
	<div class="col-sm-2">
		{!! Field::select('bank_id', $banks, null, ['empty'=>'Seleccionar', 'label'=>'Cuenta', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('metodo', config('options.metodos_pago'), ['label'=>'Método', 'empty'=>'Seleccionar', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::date('issued_at', date('Y-m-d'), ['label'=>'Fecha Pago','class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::number('value', ['label' => 'Valor a pagar', 'class'=>'form-control-sm text-uppercase', 'required', 'step'=>'0.01']) !!}
	</div>
	<div class="col-sm-4">
		{!! Field::text('description', ['label' => 'Descripción', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
</div>