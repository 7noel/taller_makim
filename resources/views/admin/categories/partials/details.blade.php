<div>
	@php $i=0; @endphp
	<table class="table table-sm">
		<thead>
			<tr>
				<th>Item</th>
				<th>Unidad</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody id="tableModelos">
		@if(isset($model->childs))
		@foreach($model->childs as $modelo)
			<tr data-id="{{ $modelo->id }}">
				{!! Form::hidden("modelos[$i][id]", $modelo->id, ['class'=>'modeloId','data-modeloId'=>'']) !!}
				<td>{!! Form::text("modelos[$i][name]", $modelo->name, ['class'=>'form-control form-control-sm name text-uppercase', 'data-name'=>'']) !!}</td>
				<td>{!! Form::select("modelos[$i][description]", $units, $modelo->description, ['class'=>'form-control form-control-sm description', 'data-description'=>'']) !!}</td>

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
			<td>{!! Form::text('data1', null, ['class'=>'form-control form-control-sm name text-uppercase', 'data-name'=>'', 'required']) !!}</td>
			<td>{!! Form::select('data2', $units, null, ['class'=>'form-control form-control-sm description', 'data-description'=>'', 'required']) !!}</td>
			<td class="text-center form-inline">
				<a href="#" class="btn btn-outline-danger btn-sm btn-delete-item" title="Eliminar">{!! $icons['remove'] !!}</a>
			</td>
		</tr>
	</template>
	{!! Form::hidden('items_1', $i, ['id'=>'items_1']) !!}
	<a href="#" id="btnAddModelo" class="btn btn-success btn-sm mb-3" title="Agregar Item">{!! config('options.icons.add') !!} Agregar Item</a>
</div>