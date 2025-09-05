{!! Form::hidden('my_company', auth()->user()->my_company, ['id'=>'my_company']) !!}
{!! Form::hidden('is_downloadable', 0, ['id'=>'is_downloadable']) !!}
{!! Form::hidden('with_tax', 1, ['id'=>'with_tax']) !!}
{!! Form::hidden('car_id', null, ['id'=>'car_id']) !!}
{!! Form::hidden('action', $action, ['id'=>'action']) !!}
<div class="form-row mb-3">
	<div class="col-sm-2">
		<div class="custom-control custom-switch">
			{!! Form::checkbox('approved_at', ((isset($model) and $action=='edit')? $model->approved_at : "on"), ((isset($model->approved_at) and $action=='edit') ? !is_null($model->approved_at) : false), ['class'=>'custom-control-input', 'id'=>'approved_at']) !!}
			<label class="custom-control-label" for="approved_at">Aprobado/Completado</label>
		</div>
	</div>
</div>
<div class="form-row">
	<div class="col-md-1 col-sm-2">
		{!! Form::label('sn', 'OC') !!}
		@if(isset($model) and $model->order_type == 'input_orders')
		{!! Form::text('sn', null, ['class'=>'form-control-sm form-control-plaintext text-center', 'readonly']) !!}
		@else
		{!! Form::text('sn', '',['class'=>'form-control-sm form-control-plaintext text-center', 'readonly']) !!}
		@endif
	</div>
	@if(isset($quote->id))
	<div class="col-md-1 col-sm-2">
		{!! Form::hidden('order_id', $quote->id, ['id'=>'order_id']) !!}
		{!! Form::label('quote_sn', 'Req') !!}
		{!! Form::text('quote_sn', $quote->sn, ['class'=>'form-control-sm form-control-plaintext text-center', 'readonly']) !!}
	</div>
	@endif
<div class="col-sm-4">
{!! Form::label('txtProvider','Proveedor:', ['class'=>'control-label']) !!}
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
	<div class="col-sm-1">
		{!! Field::select('currency_id', config('options.table_sunat.moneda'), (isset($model) ? null : 1), ['empty'=>'Seleccionar', 'label'=>'Moneda', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('payment_condition_id', $payment_conditions, (isset($model) ? null : 1), ['empty'=>'Seleccionar', 'label'=>'Cond. P.', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-md-2 col-sm-4">
		{!! Field::text('attention', ['label' => 'Atención', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-md-4 col-sm-6">
		{!! Field::text('comment', ['label' => 'Comentarios', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
</div>

@include('operations.input_orders.partials.details')