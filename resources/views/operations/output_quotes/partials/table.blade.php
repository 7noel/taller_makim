<table class="{{ config('options.styles.table') }}">
	<thead class="{{ config('options.styles.thead') }}">
		<tr>
			<th>#</th>
			<th>Fecha</th>
			<th>Placa</th>
			<th>Cliente</th>
			<th>Estado</th>
			<th>Mnd</th>
			<th>Total</th>
			<th>OT</th>
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
		<tr data-id="{{ $model->id }}" data-tipo="COT">
			<td>{{ $model->sn }}</td>
			<td>{{ $model->created_at->formatLocalized('%d/%m/%Y') }}</td>
			<td>{{ $model->placa }}</td>
			<td>{{ $model->company->company_name }} </td>
			<td><span class="{{ $clase }}">{{ $model->status }}</span></td>
			<td>{{ config('options.table_sunat.moneda_sunat.'.$model->currency_id) }}</td>
			<td>{{ $model->total}} </td>
			<td>
				@if($model->order_id>0)
				<a href="{{ '/operations/output_orders/?sn='.$model->order_id }}" class="btn btn-link btn-sm" title="Ver OT">{{ $model->order_id }}</a>
				@else
				SIN OT
				@endif
			</td>
			<td>
				<a href="{{ route( 'print_order' , $model->id ) }}" target="_blank" class="btn btn-outline-success btn-sm" title="Imprimir">{!! $icons['printer'] !!}</a>
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