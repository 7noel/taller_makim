<table class="{{ config('options.styles.table') }}">
	<thead class="{{ config('options.styles.thead') }}">
		<tr>
			<th>#</th>
			<th>Fecha</th>
			<th>RUC/DNI</th>
			<th>Empresa</th>
			<th>Total</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach($models as $model)
		<tr data-id="{{ $model->id }}">
			<td>{{ $model->id }}</td>
			<td>{{ $model->created_at->formatLocalized('%d/%m/%Y') }} </td>
			<td>{{ $model->company->doc }} </td>
			<td>{{ $model->company->company_name }} </td>
			<td>{{ $model->currency->symbol." ".$model->amount_letters}} </td>
			<td>
				@if($model->payment_condition_id == 3)
				<a href="{{ route( 'issuance_swaps.byProof' , $model->id) }}" class="btn btn-outline-default btn-sm" title="Letras">{!! config('options.icons.invoice') !!}</a>
				@else
				<a href="{{ route( 'amortizations.byProof' , $model->id) }}" class="btn btn-outline-default btn-sm" title="Pagos">{!! config('options.icons.pay') !!}</a>
				@endif
				<a href="{{ route( str_replace('index', 'edit', Request::route()->getAction()['as']) , $model) }}" class="btn btn-outline-primary btn-sm" title="Editar">{!! config('options.icons.edit') !!}</a>
				<a href="#" class="btn-delete btn btn-outline-danger btn-sm" title="Eliminar">{!! config('options.icons.remove') !!}</a>
			<a href="{{ ($model->response_sunat == '')? '#' : json_decode($model->response_sunat)->enlace_del_pdf }}">{!! $icons['pdf'] !!}</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>