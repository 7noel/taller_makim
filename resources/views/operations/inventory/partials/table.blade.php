<table class="{{ config('options.styles.table') }}">
	<thead class="{{ config('options.styles.thead') }}">
		<tr>
			<th class="text-center">#</th>
			<th class="text-center">Fecha</th>
			<th class="text-center">Hora</th>
			<th class="text-center">Placa</th>
			<th class="text-center">Marca</th>
			<th class="text-center">Modelo</th>
			<th>Cliente</th>
			<th class="text-center">Estado</th>
			<th class="text-center">Acciones</th>
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
			<td class="text-center">{{ $model->sn }}</td>
			<td class="text-center">{{ $model->created_at->format('d/m/Y') }}</td>
			<td class="text-center">{{ $model->created_at->format('H:i:s') }}</td>
			<td class="text-center" style="white-space: nowrap;">{{ $model->placa }}</td>
			<td class="" style="white-space: nowrap;">{{ optional($model->car->brand)->name }}</td>
			<td class="" style="white-space: nowrap;">{{ optional($model->car->modelo)->name }}</td>
			<td>{{ optional($model->company)->company_name }} </td>
			<td class="status text-center"><span class="{{ $clase }}">{{ $model->status }}</span></td>
			<td class="text-center" style="white-space: nowrap;">
				<a href="{{ route( 'order.print_inventory' , $model->id ) }}" target="_blank" class="btn btn-outline-secondary btn-sm" title="Inventario">{!! $icons['pdf'] !!}</a>
			@if($model->status=='APROB')
				<a href="{{ route('output_vouchers.by_order', $model->id) }}" class="btn btn-outline-secondary btn-sm" title="Generar Venta">{!! $icons['invoice'] !!}</a>
			@endif
			@if(in_array($model->status,['CERR', 'ANUL']))
				<a href="{{ route('output_orders.show', $model->id) }}" class="btn btn-outline-secondary btn-sm" title="Ver OT">{!! $icons['view'] !!}</a>
			@else
				<a href="{{ route( 'inventory.edit' , $model) }}" class="btn btn-outline-primary btn-sm" title="Editar">{!! $icons['edit'] !!}</a>
				<a href="#" class="btn-anular btn btn-outline-danger btn-sm" title="Eliminar">{!! $icons['remove'] !!}</a>
			@endif
			</td>
		</tr>
		@endforeach
	</tbody>
</table>