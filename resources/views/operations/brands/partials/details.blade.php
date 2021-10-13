<div>
	@php $i=0; @endphp
	<table class="table table-sm">
		<thead>
			<tr>
				<th>Modelo</th>
				<th>Descripción</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody id="tableModelos">
		@if(isset($model->modelos))
		@foreach($model->modelos as $modelo)
			<tr data-id="{{ $modelo->id }}">
				{!! Form::hidden("modelos[$i][id]", $modelo->id, ['class'=>'modeloId','data-modeloId'=>'']) !!}
				<td>{!! Form::text("modelos[$i][name]", $modelo->name, ['class'=>'form-control form-control-sm name text-uppercase', 'data-name'=>'']) !!}</td>
				<td>{!! Form::text("modelos[$i][description]", $modelo->description, ['class'=>'form-control form-control-sm description text-uppercase', 'data-description'=>'']) !!}</td>

				<td class="text-center form-inline">
					<a href="#" class="btn btn-outline-danger btn-sm btn-delete-item" title="Eliminar">{!! $icons['remove'] !!}</a>
				</td>
			</tr>
			@php $i++; @endphp
		@endforeach
		@endif
		</tbody>
	</table>
	<template id="template-row-modelo">
		<tr>
			<td>{!! Form::text('data1', null, ['class'=>'form-control form-control-sm name text-uppercase', 'data-name'=>'']) !!}</td>
			<td>{!! Form::text('data2', null, ['class'=>'form-control form-control-sm description text-uppercase', 'data-description'=>'']) !!}</td>
			<td class="text-center form-inline">
				<a href="#" class="btn btn-outline-danger btn-sm btn-delete-item" title="Eliminar">{!! $icons['remove'] !!}</a>
			</td>
		</tr>
	</template>
	{!! Form::hidden('items_1', $i, ['id'=>'items_1']) !!}
	<a href="#" id="btnAddModelo" class="btn btn-success btn-sm" title="Agregar Modelo">{!! config('options.icons.add') !!} Agregar Modelo</a>
</div>