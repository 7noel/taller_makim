<table class="{{ config('options.styles.table') }}">
	<thead class="{{ config('options.styles.thead') }}">
		<tr>
			<th>#</th>
			<th>Fecha</th>
			<th>Placa</th>
			<th>Cliente</th>
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
		<tr data-id="{{ $model->id }}" data-tipo="OT">
			<td>{{ $model->sn }}</td>
			<td>{{ $model->created_at->formatLocalized('%d/%m/%Y') }}</td>
			<td style="white-space: nowrap;">{{ $model->placa }}</td>
			<td>{{ $model->company->company_name }} </td>
			<td class="status"><span class="{{ $clase }}">{{ $model->status }}</span></td>
			<td style="white-space: nowrap;">
				<a href="{{ route( 'print_inventory' , $model->id ) }}" target="_blank" class="btn btn-outline-secondary btn-sm" title="Inventario">{!! $icons['car'] !!}</a>
			@if($model->status=='APROB')
				<a href="{{ route('output_vouchers.by_order', $model->id) }}" class="btn btn-outline-secondary btn-sm" title="Generar Venta">{!! $icons['invoice'] !!}</a>
			@endif
			@if(in_array($model->status,['CERR', 'ANUL']))
				<a href="{{ route('output_orders.show', $model->id) }}" class="btn btn-outline-secondary btn-sm" title="Ver OT">{!! $icons['view'] !!}</a>
			@else
				<a href="{{ route( 'output_orders.edit' , $model) }}" class="btn btn-outline-primary btn-sm" title="Editar">{!! $icons['edit'] !!}</a>
				<a href="#" class="btn-anular btn btn-outline-danger btn-sm" title="Eliminar">{!! $icons['remove'] !!}</a>
			@endif
			</td>
		</tr>
		@endforeach
	</tbody>
</table>