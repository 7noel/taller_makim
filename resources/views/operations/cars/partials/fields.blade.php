<a href="{{ route('clients.create') }}" class="btn btn-sm btn-link">[[ Crear Cliente ]]</a>
<!-- Button trigger modal -->
<button type="button" class="btn btn-sm btn-link" data-toggle="modal" data-target="#marcaModal" id="link-crear-marca">
	[[ Crear Marca ]]
</button>
<!-- Button trigger modal -->
<button type="button" class="btn btn-sm btn-link d-none" data-toggle="modal" data-target="#marcaModal" id="link-crear-modelo">
	[[ Crear Modelo ]]
</button>

<!-- Modal Marca -->
<div class="modal fade" id="marcaModal" tabindex="-1" aria-labelledby="marcaModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="marcaModalLabel">Crear Marca y Modelo</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<input type="hidden" id="marca_id">
					<label for="marca" class="col-form-label-sm">Marca</label>
					<input type="text" class="form-control form-control-sm text-uppercase" id="marca">
					<div id="marcaFeedback" class="invalid-feedback">Esta marca ya existe</div>
				</div>
				<div class="form-group">
					<label for="modelo_name" class="col-form-label-sm">Modelo</label>
					<input type="text" class="form-control form-control-sm text-uppercase" id="modelo_name">
					<div id="modeloNameFeedback" class="invalid-feedback">Esta modelo ya existe</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" id="btn-crear-marca">Grabar Marca y Modelo</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Modelo -->
<!-- <div class="modal fade" id="modeloModal" tabindex="-1" aria-labelledby="modeloModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modeloModalLabel">Crear Modelo</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<input type="hidden" id="marca_id">
					<label for="marca" class="col-form-label-sm">Marca: </label>
				</div>
				<div class="form-group">
					<label for="modelo" class="col-form-label-sm">Modelo</label>
					<input type="text" class="form-control form-control-sm" id="modelo">
					<div id="modeloFeedback" class="invalid-feedback">Esta modelo ya existe</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" id="btn-crear-modelo">Grabar Modelo</button>
			</div>
		</div>
	</div>
</div> -->

{!! Form::hidden('my_company', session('my_company')->id, ['id'=>'my_company']) !!}
{!! Form::hidden('company_id', ((isset($client->id)) ? $client->id : null), ['id'=>'company_id']) !!}
@if(!isset($model))
	{!! Form::hidden('slug', 24) !!}
@endif
<div class="form-row">
	<div class="col-sm-2">
		{!! Field::text('placa', ['label' => 'Placa', 'id'=>'txtplaca', 'class'=>'form-control-sm text-uppercase', 'max'=>'7', 'required']) !!}
	</div>
	<div class="col-sm-4">
		@if(isset($client->id))
		{!! Field::text('txtCompany', $client->company_name, ['label' => 'Cliente', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
		@else
		{!! Field::text('txtCompany', ((isset($model->company_id)) ? $model->company->company_name : null), ['label' => 'Cliente', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
		@endif
	</div>
	<div class="col-sm-2">
		{!! Field::select('brand_id', $brands, ['empty'=>'Seleccionar', 'label'=>'Marca', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('modelo_id', $modelos, ['empty'=>'Seleccionar', 'label'=>'Modelo', 'class'=>'form-control-sm', 'required']) !!}
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
	</div>{{--
	<div class="col-sm-2">
		{!! Field::date('f_revision', ['label' => 'Pro_Rev_T', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-2">
		<div class="custom-control custom-checkbox">
			{!! Form::checkbox('add_contact', '1', null,['class'=>'custom-control-input', 'id'=>'add_contact']) !!}
	  		<label class="custom-control-label" for="add_contact">Agregar un Contacto</label>
  		</div>
	</div>--}}
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

@if(isset($client->id) or !isset($model))
<div class="form-row mb-3">
	<div class="col-sm-2">
		<div class="custom-control custom-switch">
			{!! Form::checkbox('crear_ingreso', 'on', true, ['class'=>'custom-control-input', 'id'=>'crear_ingreso']) !!}
			<label class="custom-control-label" for="crear_ingreso">Crear Recepción</label>
		</div>
	</div>
</div>
@endif