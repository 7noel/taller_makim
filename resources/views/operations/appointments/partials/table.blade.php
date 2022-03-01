<table class="{{ config('options.styles.table') }}">
	<thead class="{{ config('options.styles.thead') }}">
		<tr>
			<th>Fecha y Hora</th>
			<th>Cliente</th>
			<th>Placa</th>
			<th>Modelo</th>
			<th>Servicio</th>
			<th>Estado</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
	@foreach($models as $model)
		@php
		if ($model->status=='APROB') {
			$clase = 'badge badge-primary';
		} elseif ($model->status=='CERR') {
			$clase = 'badge badge-success';
		} elseif ($model->status=='ANUL') {
			$clase = 'badge badge-danger';
		} else {
			$clase = 'badge badge-info';
		}
		@endphp
		<tr data-id="{{ $model->id }}">
			<td>{{ $model->start_at->format('d/m/Y h:i a') }}</td>
			<td>{{ $model->company_name }} </td>
			<td>{{ $model->placa }}</td>
			<td>{{ $model->modelo }}</td>
			<td>{{ $model->type_service }}</td>
			<td><span class="{{ $clase }}">{{ $model->status }}</span></td>
			<td>
				<a href="{{ route('appointments.show', $model->id) }}" class="btn btn-outline-secondary btn-sm" title="Ver OT">{!! $icons['view'] !!}</a>
				<a href="{{ route( 'appointments.edit' , $model) }}" class="btn btn-outline-primary btn-sm" title="Editar">{!! $icons['edit'] !!}</a>
				<a href="#" class="btn-anular btn btn-outline-danger btn-sm" title="Eliminar">{!! $icons['remove'] !!}</a>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>