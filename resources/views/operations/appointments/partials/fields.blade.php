{!! Form::hidden('my_company', session('my_company')->id, ['id'=>'my_company']) !!}
{!! Form::hidden('with_tax', 1, ['id'=>'with_tax']) !!}
{!! Form::hidden('company_id', null, ['id'=>'company_id']) !!}
{!! Form::hidden('car_id', null, ['id'=>'car_id']) !!}
<div class="form-row mb-3">
	<div class="col-sm-2">
		<div class="custom-control custom-switch">
			{!! Form::checkbox('approved_at', ((isset($model))? $model->approved_at : "on"), ((isset($model->approved_at)) ? !is_null($model->approved_at) : false), ['class'=>'custom-control-input', 'id'=>'approved_at']) !!}
			<label class="custom-control-label" for="approved_at">Efectiva</label>
		</div>
	</div>
</div>
<div class="form-row">
	<div class="col-md-4 col-sm-4">
		<div id="field_start_at" class="form-group">
			<label for="start_at">Fecha y Hora<span class="badge badge-info">!</span></label>
			{!! Form::datetimeLocal('start_at', ((isset($model)) ? $model->start_at->format('Y-m-d\TH:i') : null), ['class'=>'form-control form-control-sm text-uppercase', 'required']) !!}
		</div>
	</div>
	<div class="col-md-2 col-sm-4">
		{!! Field::text('placa', null, ['label' => 'Placa', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-md-2 col-sm-4">
		{!! Field::text('modelo', null, ['label' => 'Modelo', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-md-2 col-sm-4">
		{!! Field::select('type_service', config('options.types_service'), ['empty'=>'Seleccionar', 'label'=>'Servicio', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-md-2 col-sm-4 d-none">
		{!! Field::select('preventivo', config('options.preventivos'), ['empty'=>'Seleccionar', 'label'=>'Preventivo (km)', 'class'=>'form-control-sm']) !!}
	</div>
</div>
<div class="form-row">
	<div class="col-md-4 col-sm-6">
		{!! Field::text('company_name', null, ['label' => 'Cliente', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-md-2 col-sm-4">
		{!! Field::email('email', null, ['label' => 'Email', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-md-2 col-sm-4">
		{!! Field::text('mobile', null, ['label' => 'Celular', 'class'=>'form-control-sm', 'required']) !!}
	</div>
</div>
<div class="form-row">
	<div class="col-md-8 col-sm-12">
		{!! Field::text('comment', ['label' => 'Comentarios', 'class'=>'form-control-sm']) !!}
	</div>
</div>