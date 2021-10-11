<table class="{{ config('options.styles.table') }}">
	<thead class="{{ config('options.styles.thead') }}">
		<tr>
			<th>#</th>
			<th>Nombre</th>
			<th>Símbolo</th>
			<th>Tipo</th>
			<th class="text-right">Valor</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach($models as $model)
		<tr data-id="{{ $model->id }}">
			<td>{{ $model->id }}</td>
			<td>{{ $model->name }}</td>
			<td>{{ $model->symbol }}</td>
			<td>{{ config('options.unit_types.'.$model->relation_id) }}</td>
			<td class="text-right">{{ $model->value_1 }}</td>
			<td>
				<a href="{{ route( $routes['edit'] , $model) }}" class="btn btn-outline-primary btn-sm" title="Editar">{!! $icons['edit'] !!}</a>
				<a href="#" class="btn-delete btn btn-outline-danger btn-sm" title="Eliminar">{!! $icons['remove'] !!}</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>