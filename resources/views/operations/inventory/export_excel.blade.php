<table class="{{ config('options.styles.table') }}">
	<thead class="{{ config('options.styles.thead') }}">
		<tr>
			<th><strong>#</strong></th>
			<th><strong>Fecha</strong></th>
			<th><strong>Placa</strong></th>
			<th><strong>Marca</strong></th>
			<th><strong>Cliente</strong></th>
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
			<td>{{ $model->created_at->formatLocalized('%d/%m/%Y') }}</td>
			<td>{{ $model->placa }}</td>
			<td>{{ $model->car->brand->name }}</td>
			<td>{{ $model->company->company_name }} </td>
			<td class="status">{{ $model->status }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
