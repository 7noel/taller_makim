{!! Form::hidden('my_company', session('my_company')->id, ['id'=>'my_company']) !!}
{!! Form::hidden('with_tax', 0, ['id'=>'with_tax']) !!}
{!! Form::hidden('company_id', null, ['id'=>'company_id']) !!}
<div class="form-row">
	<div class="col-md-1 col-sm-2">
		{!! Form::label('sn', 'Nro') !!}
		{!! Form::text('sn', null, ['class'=>'form-control-sm form-control-plaintext text-center', 'readonly']) !!}
	</div>
	<div class="col-md-3 col-sm-4">
		{!! Field::text('txtCompany', ((isset($model->company_id)) ? $model->company->company_name : null), ['label' => 'Cliente', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('branch_id', $bs, ['empty'=>'Seleccionar', 'label'=>'Sucursal', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-md-2 col-sm-4">
		@if(isset(\Auth::user()->employee->job_id) and (\Auth::user()->employee->job_id == 8 or \Auth::user()->id==3))
		{!! Field::select('seller_id', [\Auth::user()->employee->id => \Auth::user()->employee->full_name], ['empty'=>'Seleccionar', 'label'=>'Vendedor', 'class'=>'form-control-sm', 'required']) !!}
		@else
		{!! Field::select('seller_id', $sellers, ['empty'=>'Seleccionar', 'label'=>'Vendedor', 'class'=>'form-control-sm', 'required']) !!}
		@endif
	</div>
	<div class="col-sm-2">
		{!! Field::select('currency_id', config('options.table_sunat.moneda'), (isset($model) ? null : 1), ['empty'=>'Seleccionar', 'label'=>'Moneda', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('payment_condition_id', config('options.payment_conditions'), (isset($model) ? null : 1), ['empty'=>'Seleccionar', 'label'=>'Cond. P.', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-md-2 col-sm-4">
		{!! Field::text('condition', ['label' => 'Detalle Cond P.', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-md-2 col-sm-4">
		{!! Form::hidden('shipper_id', null, ['id'=>'shipper_id']) !!}
		{!! Field::text('txtShipper', ((isset($model) and $model->shipper_id>0) ? $model->shipper->company_name : null), ['label' => 'Transportista', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('branch_shipper_id', $bs_shipper, ['empty'=>'Seleccionar', 'label'=>'Agencia', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-md-2 col-sm-4">
		{!! Field::text('attention', ['label' => 'Atención', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-md-4 col-sm-6">
		{!! Field::text('comment', ['label' => 'Comentarios', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
</div>
<div class="form-group form-group-sm">
	@if(1==1)
	@endif
	@if(1==0)
	{!! Form::label('status','Status:', ['class'=>'col-sm-1 control-label']) !!}
	<div class="col-sm-7 status-checked">
		<label class="checkbox-inline" title="Verificado por Administración">
			{!! Form::checkbox('checked_at', (isset($model)) ? $model->checked_at : "on") !!} Verificado
		</label>
		<label class="checkbox-inline" title="Aprobado por el Cliente">
			{!! Form::checkbox('approved_at', (isset($model)) ? $model->approved_at : "on") !!} Aprobado
		</label>
		<label class="checkbox-inline" title="Facturado al Cliente">
			{!! Form::checkbox('invoiced_at', (isset($model)) ? $model->invoiced_at : "on") !!} Facturado
		</label>
		<label class="checkbox-inline" title="Productos fueron enviados al Cliente">
			{!! Form::checkbox('sent_at', (isset($model)) ? $model->sent_at : "on") !!} Enviado
		</label>
		<label class="checkbox-inline" title="Documento Cancelado">
			{!! Form::checkbox('canceled_at', (isset($model)) ? $model->canceled_at : "on") !!} Cancelado
		</label>
	</div>
	@endif
</div>
@include('operations.output_quotes.partials.details')