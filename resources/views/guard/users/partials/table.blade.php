<table id="miTabla" class="{{ config('options.styles.table') }}">
	<thead class="{{ config('options.styles.thead') }}">
		<tr>
			<th>#</th>
			<th>Usuario</th>
			<th>Email</th>
			<th>Local</th>
			<th class="text-center">Super Usuario</th>
			<th class="text-center">Acciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach($models as $model)
		<tr data-id="{{ $model->id }}">
			<td>{{ $model->id }}</td>
			<td>{{ $model->name }} </td>
			<td>{{ $model->email }} </td>
			<td>{{ $model->mycompany->brand_name }} </td>
			<td align="center">
				@if($model->is_superuser)
				{!! $icons['check'] !!}
				@endif
			</td>
			<td class="text-center">
				<a href="{{ route( $routes['edit'] , $model) }}" class="btn btn-outline-primary btn-sm" title="Editar">{!! $icons['edit'] !!}</a>
				<a href="#" class="btn-delete btn btn-outline-danger btn-sm" title="Eliminar">{!! $icons['remove'] !!}</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>