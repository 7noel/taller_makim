<table id="miTablaAjax" class="{{ config('options.styles.table') }}">
	<thead class="{{ config('options.styles.thead') }}">
		<tr>
			<th>#</th>
			<th>Empleado</th>
			<th>Documento</th>
			<th>Cargo</th>
			<th>Local</th>
			<th>Vale?</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach($models as $model)
		<tr data-id="{{ $model->id }}">
			<td>{{ $model->id }}</td>
			<td>{{ $model->company_name }}</td>
			<td>{{ config('options.client_doc.'.$model->id_type).' '.$model->doc }}</td>
			<td>{{ $model->job->name }}</td>
			<td>{{ $model->mycompany->brand_name }}</td>
			<td>{{ (isset($model->config['vale']) and $model->config['vale']!='' ) ? 'SI' : 'NO' }}</td>
			<td>
				<a href="{{ route( $routes['edit'] , $model) }}" class="btn btn-outline-primary btn-sm" title="Editar">{!! $icons['edit'] !!}</a>
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
        ajax: '{{ route("employees.ajaxList") }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'company_name', name: 'company_name' },
            { data: 'doc', name: 'doc' },
            { data: 'job', name: 'job' },
            { data: 'local', name: 'local' },
            { data: 'vale', name: 'vale' },
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
