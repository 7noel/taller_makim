<table class="{{ config('options.styles.table') }}">
	<thead class="{{ config('options.styles.thead') }}">
		<tr>
			<th>#</th>
			<th>Nombre</th>
			<th>Descripción</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach($models as $model)
		<tr data-id="{{ $model->id }}">
			<td>{{ $model->id }}</td>
			<td>{{ $model->name }} </td>
			<td>{{ $model->description }} </td>
			<td>
				<a href="{{ route( $routes['edit'] , $model) }}" class="btn btn-primary btn-xs" title="Editar">{!! $icons['edit'] !!}</a>
				<a href="#" class="btn-delete btn btn-danger btn-xs" title="Eliminar">{!! $icons['remove'] !!}</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>