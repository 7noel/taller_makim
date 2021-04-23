					<table class="table table-hover table-sm">
						<thead>
							<tr>
								<th>#</th>
								<th>Nombre</th>
								<th>Descripción</th>
								<th class="text-center">#Modelos</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($models as $model)
							<tr data-id="{{ $model->id }}">
								<td>{{ $model->id }}</td>
								<td>{{ $model->name }} </td>
								<td>{{ $model->description }} </td>
								<td class="text-center">{{ $model->modelos->count() }}</td>
								<td>
									<a href="{{ route( str_replace('index', 'edit', Request::route()->getAction()['as']) , $model) }}" class="btn btn-outline-primary btn-sm" title="Editar">{!! $icons['edit'] !!}</a>
									<a href="#" class="btn-delete btn btn-outline-danger btn-sm" title="Eliminar">{!! $icons['remove'] !!}</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>