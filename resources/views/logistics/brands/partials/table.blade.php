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
				<a href="{{ route( str_replace('index', 'edit', Request::route()->getAction()['as']) , $model) }}" class="btn btn-primary btn-sm" title="Editar">{!! config('options.icons.edit') !!}</a>
				<a href="#" class="btn-delete btn btn-danger btn-sm" title="Eliminar">{!! config('options.icons.remove') !!}</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>