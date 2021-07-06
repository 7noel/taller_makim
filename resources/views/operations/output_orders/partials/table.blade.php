<table class="{{ config('options.styles.table') }}">
	<thead class="{{ config('options.styles.thead') }}">
		<tr>
			<th>#</th>
			<th>Fecha</th>
			<th>Placa</th>
			<th>Empresa</th>
			<th>Estado</th>
			<th>Total</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach($models as $model)
		<tr data-id="{{ $model->id }}">
			<td>{{ $model->sn }}</td>
			<td>{{ $model->placa }}</td>
			<td>{{ $model->created_at->formatLocalized('%d/%m/%Y') }}</td>
			<td>{{ $model->company->company_name }} </td>
			<td>{{ $model->status }}</td>
			<td>{{ config('options.table_sunat.moneda_symbol.'.$model->currency_id)." ".$model->total}} </td>
			<td>
				@if($model->proof_id == 0)
				<a href="{{ route('orders.by_quote', $model->id) }}" class="btn btn-outline-secondary btn-sm" title="Generar Venta">{!! $icons['invoice'] !!}</a>
				@else
				<a href="{{ route('output_orders.show', $model->id) }}" class="btn btn-outline-default btn-sm" title="Ver Pedido">{!! $icons['invoice'] !!}</a>
				@endif
				@if(1==1)
				<a href="{{ route( 'print_order' , $model->id ) }}" target="_blank" class="btn btn-outline-success btn-sm" title="Imprimir">{!! $icons['printer'] !!}</a>
				@else
				<a href="#" class="btn btn-outline-success btn-sm" title="Imprimir" disabled="disabled">{!! $icons['printer'] !!}</a>
				@endif
				<a href="{{ route( 'output_orders.show' , $model) }}" class="btn btn-outline-info btn-sm" title="Editar">{!! $icons['view'] !!}</a>
				<a href="{{ route( 'output_orders.edit' , $model) }}" class="btn btn-outline-primary btn-sm" title="Editar">{!! $icons['edit'] !!}</a>
				<a href="#" class="btn-delete btn btn-outline-danger btn-sm" title="Eliminar">{!! $icons['remove'] !!}</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>