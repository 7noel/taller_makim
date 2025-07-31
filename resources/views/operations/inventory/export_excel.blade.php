<table class="{{ config('options.styles.table') }}">
	<thead class="{{ config('options.styles.thead') }}">
		<tr>
			<th><strong>#</strong></th>
			<th><strong>Fecha</strong></th>
			<th><strong>Hora</strong></th>
			<th><strong>Cliente</strong></th>
			<th><strong>Contacto</strong></th>
			<th><strong>Celular</strong></th>
			<th><strong>Placa</strong></th>
			<th><strong>Marca</strong></th>
			<th><strong>Modelo</strong></th>
			<th><strong>Año</strong></th>
			<th><strong>Color</strong></th>
			<th><strong>Estado</strong></th>
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
		<tr data-id="{{ $model->id }}" data-tipo="OT">
			<td>{{ $model->sn }}</td>
			<td>{{ $model->created_at->format('d/m/Y') }}</td>
			<td>{{ $model->created_at->format('H:i:s') }}</td>
			<td>{{ optional($model->company)->company_name }} </td>
			<td>{{ optional($model->inventory)->contact_name }}</td>
			<td>{{ optional($model->inventory)->contact_mobile }}</td>
			<td>{{ $model->placa }}</td>
			<td>{{ optional($model->car->brand)->name }}</td>
			<td>{{ optional($model->car->modelo)->name }}</td>
			<td>{{ optional($model->car)->year }}</td>
			<td>{{ optional($model->car)->color }}</td>
			<td class="status">{{ $model->status }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
