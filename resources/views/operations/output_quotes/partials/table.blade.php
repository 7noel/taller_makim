<table class="{{ config('options.styles.table') }}">
	<thead class="{{ config('options.styles.thead') }}">
		<tr>
			<th class="text-center">#</th>
			<th class="text-center">Fecha</th>
			<th class="text-center">Placa</th>
			<th>Cliente</th>
			<th class="text-center">Tipo</th>
			<th class="text-center">Estado</th>
			<th class="text-center">Mnd</th>
			<th class="text-center">Total</th>
			<th class="text-center">OT</th>
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
		<tr data-id="{{ $model->id }}" data-tipo="COT">
			@if($model->is_walk_in)
			<td class="text-center walk-in-cell" title="TRANSITO" style="white-space: nowrap;">
			@else
			<td class="text-center" style="white-space: nowrap;">
			@endif
				{{ $model->sn }}
			</td>
			<td>{{ $model->created_at->formatLocalized('%d/%m/%Y') }}</td>
			<td>{{ $model->placa }}</td>
			<td>{{ $model->company->company_name }} </td>
			<td>{{ $model->type_service }}</td>
			<td><span class="{{ $clase }}">{{ $model->status }}</span></td>
			<td>{{ config('options.table_sunat.moneda_sunat.'.$model->currency_id) }}</td>
			<td>{{ $model->total}} </td>
			<td class="text-center" style="white-space: nowrap;">
				@if($model->inventario)
				<a href="{{ route('inventory.show', $model->order_id) }}" class="btn btn-link btn-sm" title="Ver Inventario">{{ $model->inventario->sn }}</a>
				@elseif($model->status != 'ANUL')
				<a href="{{ route('inventory.recepcion_by_quote', $model->id) }}" class="btn btn-link btn-sm" title="Crear Inventario">Crear</a>
				@else
				SIN OT
				@endif
			</td>
			<td class="nowrap">
				<!-- <a href="{{ route( 'print_order' , $model->id ) }}" target="_blank" class="btn btn-outline-success btn-sm" title="Imprimir">{!! $icons['printer'] !!}</a> -->
				<a href="{{ route( 'output_quotes.print_details' , $model->id ) }}" target="_blank" class="btn btn-outline-success btn-sm" title="PDF por Items"><i class="fa-regular fa-file-lines"></i> Items</a>
				<a href="{{ route( 'output_quotes.print_categories' , $model->id ) }}" target="_blank" class="btn btn-outline-success btn-sm" title="PDF por Categorías"><i class="fa-regular fa-file"></i> Categorías</a>
				<a href="{{ route( 'output_quotes.print_taller' , $model->id ) }}" target="_blank" class="btn btn-outline-secondary btn-sm" title="PDF para Taller">{!! $icons['pdf'] !!} Taller</a>
			@if($model->status=='APROB')
				<a href="{{ route('orders.by_quote', $model->id) }}" class="btn btn-outline-secondary btn-sm" title="Generar Pedido">{!! $icons['invoice'] !!}</a>
			@endif
			@if(in_array($model->status,['CERR', 'ANUL']))
				<a href="{{ route('output_quotes.show', $model->id) }}" class="btn btn-outline-secondary btn-sm" title="Ver Pedido">{!! $icons['view'] !!}</a>
			@else
				<a href="{{ route( 'output_quotes.edit' , $model) }}" class="btn btn-outline-primary btn-sm" title="Editar">{!! $icons['edit'] !!}</a>
				<a href="#" class="btn-anular btn btn-outline-danger btn-sm" title="Eliminar">{!! $icons['remove'] !!}</a>
			@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>

<style>
	.nowrap {
		white-space: nowrap;
	}
	.walk-in-cell {
	    background-color: #fff3cd; /* ámbar suave Bootstrap */
	    border-left: 5px solid #ffc107; /* ámbar fuerte */
	}
</style>