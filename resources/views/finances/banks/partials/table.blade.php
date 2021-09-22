<table class="{{ config('options.styles.table') }}">
	<thead class="{{ config('options.styles.thead') }}">
		<tr>
			<th>#</th>
			<th>Nombre</th>
			<th>Tipo de Cuenta</th>
			<th>Descripcion</th>
			<th>Mostrar</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach($models as $model)
		<tr data-id="{{ $model->id }}">
			<td>{{ $model->id }}</td>
			<td>{{ $model->name }} </td>
			<td>{{ config("options.tipo_banco.$model->type") }}</td>
			<td>{{ $model->description }} </td>
			<td>
				@if($model->show)
					{!! $icons['check'] !!}
				@else
					{!! $icons['close'] !!}
				@endif
			</td>
			<td>
				<a href="{{ route( $routes['show'], $model) }}" class="btn btn-outline-success btn-sm" title="Visualizar">{!! $icons['view'] !!}</a>
				<a href="{{ route( $routes['edit'], $model) }}" class="btn btn-outline-primary btn-sm" title="Editar">{!! $icons['edit'] !!}</a>
				<a href="#" class="btn-delete btn btn-outline-danger btn-sm" title="Eliminar">{!! $icons['remove'] !!}</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>