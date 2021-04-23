<table class="{{ config('options.styles.table') }}">
	<thead class="{{ config('options.styles.thead') }}">
		<tr>
			<th>#</th>
			<th>Fecha</th>
			<th>Documento</th>
			<th>Empresa</th>
			<th>Total</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach($models as $model)
		<tr data-id="{{ $model->id }}">
			<td>{{ $model->id }}</td>
			<td>{{ \Carbon::createFromFormat('Y-m-d', $model->issued_at)->formatLocalized('%d/%m/%Y') }} </td>
			<td>{{ $model->document_type->name." ".$model->series." ".$model->number }} </td>
			<td>{{ $model->company->company_name }} </td>
			<td>{{ $model->total }} </td>
			<td>
				<a href="{{ route( str_replace('index', 'edit', Request::route()->getAction()['as']) , $model) }}" class="btn btn-outline-primary btn-sm" title="Editar">{!! config('options.icons.edit') !!}</a>
				<a href="#" class="btn-outline-delete btn btn-danger btn-sm" title="Eliminar">{!! config('options.icons.remove') !!}</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>