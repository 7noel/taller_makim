{!! Form::hidden('my_company', session('my_company')->id, ['id'=>'my_company']) !!}
{!! Form::hidden('company_id', ((isset($client->id)) ? $client->id : null), ['id'=>'company_id']) !!}
<div class="form-row">
	<div class="col-sm-2">
		{!! Field::text('placa', ['label' => 'Placa', 'class'=>'form-control-sm text-uppercase', 'max'=>'7', 'required']) !!}
	</div>
	<div class="col-sm-4">
		@if(isset($client->id))
		{!! Field::text('txtCompany', $client->company_name, ['label' => 'Cliente', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
		@else
		{!! Field::text('txtCompany', ((isset($model->company_id)) ? $model->company->company_name : null), ['label' => 'Cliente', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
		@endif
	</div>
	<div class="col-sm-2">
		{!! Field::select('modelo_id', $modelos, ['empty'=>'Seleccionar', 'label'=>'Modelo', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('version', ['label' => 'Versión', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('body', $bodies, ['empty'=>'Seleccionar', 'label'=>'Tipo', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('color', ['label' => 'Color', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-4">
		{!! Field::text('vin', ['label' => 'VIN', 'class'=>'form-control-sm text-uppercase', 'max'=>'17', 'required']) !!}
	</div>
	<div class="col-sm-4">
		{!! Field::text('motor', ['label' => 'Nro Motor', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('codigo', ['label' => 'Codigo', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('year', ['label' => 'Año', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::date('f_revision', ['label' => 'Pro_Rev_T', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-2">
		<div class="custom-control custom-checkbox">
			{!! Form::checkbox('add_contact', '1', null,['class'=>'custom-control-input', 'id'=>'add_contact']) !!}
	  		<label class="custom-control-label" for="add_contact">Agregar un Contacto</label>
  		</div>
	</div>
</div>
<div class="form-row contact d-none">
	<div class="col-sm-4">
		{!! Field::text('contact_name', ((!isset($model) and isset($client))? $client->company_name :null), ['label' => 'Contacto', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::email('contact_email', ((!isset($model) and isset($client))? $client->email :null), ['label' => 'Email', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('contact_phone', ((!isset($model) and isset($client))? $client->phone :null), ['label' => 'Tel Fijo', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('contact_mobile', ((!isset($model) and isset($client))? $client->mobile :null), ['label' => 'Celular', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
</div>