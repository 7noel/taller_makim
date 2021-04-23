<div class="form-row">
	{!! Form::hidden('id_type', '6', ['id'=>'id_type', 'required']) !!}
	{!! Form::hidden('country', 'PE', ['id'=>'country', 'required']) !!}

	@if(isset($model))
	{!! Form::hidden('doc', 'PE', ['id'=>'doc', 'required']) !!}
	<div class="col-sm-2">
		{!! Field::text('doc1', ['label' => 'Número RUC', 'class'=>'form-control-sm text-uppercase', 'required', 'readonly']) !!}
	</div>
	@else
	<div class="col-sm-2">
		{!! Field::text('doc', ['label' => 'Número RUC', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	@endif

	<div class="col-sm-4">
		{!! Field::text('company_name', ['label' => 'Razón Social', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>

	@if(isset($model))
	<div class="col-sm-4">
		{!! Field::text('brand_name', ['label' => 'Marca', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	@endif

	<div class="col-sm-2">
		{!! Field::text('paternal_surname', ['label' => 'Ap Paterno', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('maternal_surname', ['label' => 'Ap Materno', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('name', ['label' => 'Nombre', 'class'=>'form-control-sm text-uppercase']) !!}
	</div>
	{!! Form::hidden('country', 'PE', ['id'=>'country', 'required']) !!}
	<div class="col-sm-2">
		{!! Field::select('departamento', $ubigeo['departamento'], $ubigeo['value']['departamento'], ['empty'=>'Seleccionar', 'label'=>'Departamento', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('provincia', $ubigeo['provincia'], $ubigeo['value']['provincia'], ['empty'=>'Seleccionar', 'label'=>'Provincia', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('ubigeo_code', $ubigeo['distrito'], $ubigeo['value']['distrito'], ['empty'=>'Seleccionar', 'label'=>'Distrito', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-4">
		{!! Field::text('address', ['label' => 'Dirección', 'class'=>'form-control-sm text-uppercase', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('phone', ['label' => 'Teléfono', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('mobile', ['label' => 'Celular', 'class'=>'form-control-sm']) !!}
	</div>
</div>
<div class="form-row">
	<div class="col-sm-2">
		{!! Field::email('email', ['label' => 'Email', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::password('password', ['label' => 'Contraseña', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::password('confirmed_password', ['label' => 'Confirmar', 'class'=>'form-control-sm', 'required']) !!}
	</div>
	@if(isset($model))
	<div class="col-sm-2">
		{!! Field::text('web', ['label'=>'Página web', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('nubefact_ruta', ['label'=>'Ruta de Nubefact', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::text('nubefact_token', ['label'=>'Token de Nubefact', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::file('logo', ['label'=>'Logo', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('size_factura', config('options.config.size'), ['label'=>'Format de Facturas', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('size_boleta', config('options.config.size'), ['label'=>'Format de PDF Boletas', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('size_retencion', config('options.config.size_2'), ['label'=>'Format de Retenciones', 'class'=>'form-control-sm']) !!}
	</div>
	<div class="col-sm-2">
		{!! Field::select('size_percepcion', config('options.config.size_2'), ['label'=>'Format de Percepciones', 'class'=>'form-control-sm']) !!}
	</div>
	@endif
</div>
@if(isset($model))
@php $i=0; @endphp
<table class="table table-sm table-responsive-xl">
	<thead>
		<tr>
			<th scope="col">Sucursal</th>
			<th scope="col">Dirección</th>
			<th scope="col">Distrito</th>
			<th scope="col">Celular</th>
			<th scope="col">Contacto</th>
			<th scope="col">Acciones</th>
		</tr>
	</thead>
	<tbody id="tableItems">
	@if(isset($model->branches))
	@foreach($model->branches as $branch)
		<tr data-id="{{ $branch->id }}">
			{!! Form::hidden("branches[$i][id]", $branch->id, ['class'=>'branchId','data-branchId'=>'']) !!}
			{!! Form::hidden("branches[$i][ubigeo_code]", $branch->ubigeo_code, ['class'=>'ubigeoId','data-ubigeoId'=>'']) !!}

			<td>{!! Form::text("branches[$i][company_name]", null, ['class'=>'form-control form-control-sm txtName text-uppercase', 'data-name'=>'', 'required'=>'required']) !!}</td>
			<td>{!! Form::text("branches[$i][address]", null, ['class'=>'form-control form-control-sm txtAddress text-uppercase', 'data-address'=>'']) !!}</td>
			<td>{!! Form::text("branches[$i][ubigeo]", $branch->ubigeo->departamento.'-'.$branch->ubigeo->provincia.'-'.$branch->ubigeo->distrito, ['class'=>'form-control form-control-sm txtUbigeo text-uppercase', 'data-ubigeo'=>'']) !!}</td>
			<td>{!! Form::text("branches[$i][mobile]", null, ['class'=>'form-control form-control-sm txtMobile text-uppercase', 'data-mobile'=>'']) !!}</td>
			<td>{!! Form::text("branches[$i][contact]", null, ['class'=>'form-control form-control-sm txtContact text-uppercase', 'data-contact'=>'']) !!}</td>
			<td class="text-center form-inline">
				<a href="#" class="btn btn-outline-danger btn-sm btn-delete-item" title="Eliminar">{!! $icons['remove'] !!}</a>
				<input type="checkbox" name="branches[{{$i}}][is_deleted]" data-isdeleted class="isdeleted hidden">
			</td>
		</tr>
		@php $i++; @endphp
	@endforeach
	@endif
	</tbody>
</table>
<template id="template-row-item">
	<tr>
		{!! Form::hidden('data1', null, ['class'=>'branchId','data-branchId'=>'']) !!}
		{!! Form::hidden('data2', null, ['class'=>'ubigeoId','data-ubigeoId'=>'']) !!}
		<td>{!! Form::text('data3', null, ['class'=>'form-control form-control-sm txtName text-uppercase', 'data-name'=>'', 'required'=>'required']) !!}</td>
		<td>{!! Form::text('data4', null, ['class'=>'form-control form-control-sm txtAddress text-uppercase', 'data-address'=>'']) !!}</td>
		<td>{!! Form::text('data5', null, ['class'=>'form-control form-control-sm txtUbigeo text-uppercase', 'data-ubigeo'=>'']) !!}</td>
		<td>{!! Form::text('data7', null, ['class'=>'form-control form-control-sm txtMobile text-uppercase', 'data-mobile'=>'']) !!}</td>
		<td>{!! Form::text('data6', null, ['class'=>'form-control form-control-sm txtContact text-uppercase', 'data-contact'=>'']) !!}</td>
		<td class="text-center form-inline">
			<a href="#" class="btn btn-outline-danger btn-sm btn-delete-item" title="Eliminar">{!! $icons['remove'] !!}</a>
			<input type="checkbox" name="data8" data-isdeleted class="isdeleted hidden">
		</td>
	</tr>
</template>
{!! Form::hidden('items', $i, ['id'=>'items']) !!}
<a href="#" id="btnAddBranch" class="btn btn-outline-primary btn-sm" title="Agregar Sucursal">{!! config('options.icons.add') !!} Agregar Sucursal</a>
<br><br>
@endif