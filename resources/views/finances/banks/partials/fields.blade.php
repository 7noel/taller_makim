{!! Form::hidden('my_company', session('my_company')->id, ['id'=>'my_company']) !!}
<div class="form-row mb-3">
	<div class="col-sm-2">
		<div class="custom-control custom-switch">
			{!! Form::checkbox('show', '1', null,['class'=>'custom-control-input', 'id'=>'show']) !!}
			<label class="custom-control-label" for="show">Mostrar</label>
		</div>
	</div>
</div>
<div class="form-row">
	<div class="col-sm-6">
		{!! Field::select('type', config('options.tipo_banco'), ['label' => 'Tipo Cuenta', 'class'=>'form-control-sm', 'required', 'empty'=>'Seleccionar']) !!}
	</div>
	<div class="col-sm-6">
		{!! Field::text('name', ['label' => 'Nombre de la Cuenta', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-sm-6">
		{!! Field::text('number', ['label' => 'Cuenta', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-6">
		{!! Field::text('cci', ['label' => 'CCI', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-6">
		{!! Field::select('currency_id', config('options.table_sunat.moneda'), ['label' => 'Moneda', 'class'=>'form-control-sm', 'required', 'empty'=>'Seleccionar']) !!}
	</div>
	<div class="col-sm-6">
	@if(isset($model))
		<label>Saldo Inicial</label>
		<p class="form-control-plaintext">{{ $model->initial }}</p>
	@else
		{!! Field::number('initial', ['label' => 'Saldo Inicial', 'class'=>'form-control-sm', 'required', 'step'=>0]) !!}
	@endif
	</div>
	<div class="col-sm-12">
		{!! Field::text('description', ['label' => 'Descripcion', 'class'=>'form-control-sm']) !!}
	</div>
</div>