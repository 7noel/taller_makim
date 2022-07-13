{!! Form::hidden('my_company', session('my_company')->id, ['id'=>'my_company']) !!}
{!! Form::hidden('with_tax', 1, ['id'=>'with_tax']) !!}

{!! Form::hidden('sunat_transaction', $sunat_transaction, ['class'=>'form-control']) !!}
{!! Form::hidden('igv_code', 1, ['class'=>'form-control']) !!}
{!! Form::hidden('issued_at', ((isset($model->issued_at)) ? $model->issued_at : date('Y-m-d')), ['class'=>'form-control']) !!}
{!! Form::hidden('sn', ((isset($model->sn) and !isset($order))? $model->sn : ''), ['id'=>'sn']) !!}
{!! Form::hidden('action', $action, ['id'=>'action']) !!}

@if(1==1)
<div class="form-row mb-3">
	<div class="col-sm-2">
		<div class="custom-control custom-switch">
			{!! Form::checkbox('send_sunat', '1', null,['class'=>'custom-control-input', 'id'=>'send_sunat']) !!}
			<label class="custom-control-label" for="send_sunat">Enviar a SUNAT</label>
		</div>
	</div>
</div>
@endif
<div class="form-row">
	@if(isset($order))
	<div class="col-md-1 col-sm-2">
		{!! Form::hidden('order_id', $order->id, ['id'=>'order_id']) !!}
		{!! Form::label('order_sn', 'Orden') !!}
		{!! Form::text('order_sn', $order->sn, ['class'=>'form-control-sm form-control-plaintext text-center', 'readonly']) !!}
	</div>
	@endif
	<div class="col-sm-2">
		{!! Form::label('document_type_id','Documento', ['class'=>'control-label']) !!}
		{!! Form::select('document_type_id', $documents, null, ['class'=>'form-control form-control-sm']) !!}
	</div>
	<div class="col-md-1 col-sm-2">
		{!! Field::text('placa', ((isset($model->placa)) ? $model->placa : null), ['label' => 'Placa', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-sm-4">
	{!! Form::label('txtcompany','Compañía:', ['class'=>'control-label']) !!}
		@if(isset($company))
			{!! Form::hidden('company_id', $company->id, ['id'=>'company_id']) !!}
			@if($is_issuance == 0 and $is_proof == 1)
			{!! Form::hidden('is_import', (($company->country_id==1465) ? 0 : 1), ['id'=>'is_import']) !!}
			else
			{!! Form::hidden('is_import', null, ['id'=>'is_import']) !!}
			@endif
			{!! Form::text('company', $company->company_name, ['class'=>'form-control form-control-sm', 'id'=>'txtCompany', 'required']) !!}
		@else
			{!! Form::hidden('company_id', ((isset($model)) ? $model->company_id : null), ['id'=>'company_id']) !!}
			{!! Form::hidden('is_import', null, ['id'=>'is_import']) !!}
			{!! Form::text('company', ((isset($model->company_id)) ? $model->company->company_name : null), ['class'=>'form-control form-control-sm', 'id'=>'txtCompany', 'required']) !!}
		@endif
	</div>
	<div class="col-md-2 col-sm-4">
		@if(isset(\Auth::user()->employee->job_id) and (\Auth::user()->employee->job_id == 8 or \Auth::user()->id==3))
		{!! Field::select('seller_id', [\Auth::user()->employee->id => \Auth::user()->employee->full_name], ['empty'=>'Seleccionar', 'label'=>'Asesor', 'class'=>'form-control-sm', 'required']) !!}
		@else
		{!! Field::select('seller_id', $sellers, ['empty'=>'Seleccionar', 'label'=>'Asesor', 'class'=>'form-control-sm', 'required']) !!}
		@endif
	</div>
	<div class="col-sm-1">
		{!! Field::select('currency_id', config('options.table_sunat.moneda'), (isset($model) ? $model->currency_id : 1), ['empty'=>'Seleccionar', 'label'=>'Moneda', 'class'=>'form-control-sm', 'required']) !!}
	</div>
</div>
<div class="form-row">
	{!! Form::hidden('reference_id', null) !!}
	<div class="col-sm-2 d-none">
		{!! Form::label('reference_number','Referencia', ['class'=>'control-label']) !!}
		{!! Form::text('reference_number', ((isset($model->reference_id) and $model->reference_id>0) ? $model->reference->number : ''), ['class'=>'form-control']) !!}
	</div>
	<div class="col-sm-2 d-none">
	{!! Form::label('note_type_id','Motivo de Nota', ['class'=>'control-label']) !!}
		{!! Form::select('note_type_id', config('options.table_sunat.tipo_de_nota_de_credito') , ((isset($model->note_type_id)) ? $model->note_type_id : ''), ['class'=>'form-control']) !!}
	</div>
</div>
<div class="form-row">
	<div class="col-sm-2">
		{!! Field::number('exchange', ['label' => 'Cambio (US$)', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('payment_condition_id', $payment_conditions, (isset($model) ? $model->payment_condition_id : 1), ['empty'=>'Seleccionar', 'label'=>'Cond. P.', 'class'=>'form-control-sm', 'required']) !!}
	</div>
</div>

@include('finances.output_vouchers.partials.details')