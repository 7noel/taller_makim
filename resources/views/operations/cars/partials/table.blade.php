<table id="miTablaAjax" class="{{ config('options.styles.table') }}">
	<thead class="{{ config('options.styles.thead') }}">
		<tr>
			<th>#</th>
			<th>Placa</th>
			<th>Modelo</th>
			<th>Año</th>
			<th>VIN</th>
			<th>Cliente</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach($models as $model)
		<tr data-id="{{ $model->id }}">
			<td>{{ $model->id }}</td>
			<td>{{ $model->placa }} </td>
			<td>{{ $model->modelo->brand->name." ".$model->modelo->name }} </td>
			<td>{{ $model->year }} </td>
			<td>{{ $model->vin }} </td>
			<td>{{ $model->company->company_name }} </td>
			<td>
				<a href="{{ route($routes['show'], $model->id) }}" class="btn btn-outline-secondary btn-sm" title="Ver">{!! $icons['view'] !!}</a>
				<a href="{{ route( str_replace('index', 'edit', Request::route()->getAction()['as']) , $model) }}" class="btn btn-outline-primary btn-sm" title="Editar">{!! $icons['edit'] !!}</a>
				<a href="#" class="btn-delete btn btn-outline-danger btn-sm" title="Eliminar">{!! $icons['remove'] !!}</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

<script>
$(document).ready(function () {
    $('#miTablaAjax').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("cars.ajaxList") }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'placa', name: 'placa' },
            { data: 'marca_modelo', name: 'marca_modelo' },
            { data: 'year', name: 'year' },
            { data: 'vin', name: 'vin' },
            { data: 'company_name', name: 'company_name' },
            { data: 'acciones', name: 'acciones', orderable: false, searchable: false }
        ],
        lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"] ],
        pageLength: 50,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        }
    });
});
</script>
