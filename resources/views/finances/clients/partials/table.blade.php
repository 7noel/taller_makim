<table id="miTablaAjax" class="{{ config('options.styles.table') }}">
	<thead class="{{ config('options.styles.thead') }}">
		<tr>
			<th>#</th>
			<th>Razón Social</th>
			<th>DNI/RUC</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach($models as $model)
		<tr data-id="{{ $model->id }}">
			<td>{{ $model->id }}</td>
			<td>{{ $model->company_name }} </td>
			<td>{{ $model->doc }} </td>
			<td>
				<div class="btn-group">
					<button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						{!! $icons['more'] !!} <span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<li><a href="{{ route('create_order_by_company', $model) }}">Crear cotización</a></li>
						<!-- <li><a href="{/{ route('create_purchase_by_company', $model) }/}">Crear compra</a></li> -->
					</ul>
				</div>
				<a href="{{ route($routes['show'], $model->id) }}" class="btn btn-outline-secondary btn-sm" title="Ver">{!! $icons['view'] !!}</a>
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
        ajax: '{{ route("clients.ajaxList") }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'company_name', name: 'company_name' },
            { data: 'doc', name: 'doc' },
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
