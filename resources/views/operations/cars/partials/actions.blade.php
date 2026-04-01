<a href="{{ route($type.'.show', $model->id) }}" class="btn btn-outline-secondary btn-sm">{!! $icons['view'] !!}</a>
<a href="{{ route($type.'.edit', $model) }}" class="btn btn-outline-primary btn-sm">{!! $icons['edit'] !!}</a>
{!! Form::open(['route' => [$type.'.destroy', $model->id], 'method' => 'DELETE', 'style' => 'display:inline']) !!}
	<button type="submit" class="btn btn-outline-danger btn-sm btn-delete" title="Eliminar">{!! $icons['remove'] !!}</button>
{!! Form::close() !!}
