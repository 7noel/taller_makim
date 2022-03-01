{!! Form::hidden('my_company', session('my_company')->id, ['id'=>'my_company']) !!}
{!! Form::hidden('with_tax', 1, ['id'=>'with_tax']) !!}

{!! Form::hidden('sunat_transaction', $sunat_transaction, ['class'=>'form-control']) !!}
{!! Form::hidden('igv_code', 1, ['class'=>'form-control']) !!}
{!! Form::hidden('sn', ((isset($model->sn) and !isset($order))? $model->sn : ''), ['id'=>'sn']) !!}
{!! Form::hidden('action', $action, ['id'=>'action']) !!}

<div class="form-row">
	<div class="col-sm-2">
		{!! Form::label('document_type_id','Documento', ['class'=>'control-label']) !!}
		{!! Form::select('document_type_id', config('options.docs_compras'), null, ['class'=>'form-control form-control-sm']) !!}
	</div>
	<div class="col-sm-1">
		{!! Field::text('series', ['label' => 'Serie', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('number', ['label' => 'Número', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::date('issued_at', ((isset($model)) ? $model->issued_at : date('Y-m-d')), ['label' => 'Fecha', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-sm-1">
		{!! Field::select('currency_id', config('options.table_sunat.moneda'), (isset($model) ? $model->currency_id : 1), ['empty'=>'Seleccionar', 'label'=>'Moneda', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::number('exchange', ['label' => 'Cambio (US$)', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('payment_condition_id', $payment_conditions, (isset($model) ? $model->payment_condition_id : 1), ['empty'=>'Seleccionar', 'label'=>'Cond. P.', 'class'=>'form-control-sm', 'required']) !!}
	</div>
</div>
<div class="form-row">
	<div class="col-sm-4">
	{!! Form::label('txtProvider','Compañía:', ['class'=>'control-label']) !!}
		@if(isset($company))
			{!! Form::hidden('company_id', $company->id, ['id'=>'company_id']) !!}
			@if($is_issuance == 0 and $is_proof == 1)
			{!! Form::hidden('is_import', (($company->country_id==1465) ? 0 : 1), ['id'=>'is_import']) !!}
			else
			{!! Form::hidden('is_import', null, ['id'=>'is_import']) !!}
			@endif
			{!! Form::text('company', $company->company_name, ['class'=>'form-control form-control-sm', 'id'=>'txtProvider', 'required']) !!}
		@else
			{!! Form::hidden('company_id', ((isset($model)) ? $model->company_id : null), ['id'=>'company_id']) !!}
			{!! Form::hidden('is_import', null, ['id'=>'is_import']) !!}
			{!! Form::text('company', ((isset($model->company_id)) ? $model->company->company_name : null), ['class'=>'form-control form-control-sm', 'id'=>'txtProvider', 'required']) !!}
		@endif
	</div>
</div>

@include('finances.input_vouchers.partials.details')