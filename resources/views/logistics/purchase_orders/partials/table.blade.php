<table class="{{ config('options.styles.table') }}">
	<thead class="{{ config('options.styles.thead') }}">
		<tr>
			<th>#</th>
			<th>Fecha</th>
			<th>Empresa</th>
			<th>Estado</th>
			<th>Total</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach($models as $model)
		<tr data-id="{{ $model->id }}">
			<td>{{ $model->id }}</td>
			<td>{{ $model->created_at->formatLocalized('%d/%m/%Y') }}</td>
			<td>{{ $model->company->company_name }} </td>
			<td>{{ $model->status }}</td>
			<td>{{ $model->currency->symbol." ".$model->total}} </td>
			<td>
				@if($model->proof_id == 0)
				<a href="{{ route('issuance_vouchers.by_order', $model->id) }}" target="_blank" class="btn btn-default btn-sm" title="Generar Comnprobante">{!! config('options.icons.invoice') !!}</a>
				@endif
				@if($model->checked_at)
				<a href="{{ route( 'print_order' , $model->id ) }}" target="_blank" class="btn btn-success btn-sm" title="Imprimir">{!! config('options.icons.printer') !!} </a>
				@else
				<a href="#" class="btn btn-success btn-sm" title="Imprimir" disabled="disabled">{!! config('options.icons.printer') !!}</a>
				@endif
				<a href="{{ route( 'orders.edit' , $model) }}" class="btn btn-primary btn-sm" title="Editar">{!! config('options.icons.edit') !!}</a>
				<a href="#" class="btn-delete btn btn-danger btn-sm" title="Eliminar">{!! config('options.icons.remove') !!}</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>