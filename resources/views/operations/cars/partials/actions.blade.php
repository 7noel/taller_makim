<a href="{{ route($type.'.show', $model->id) }}" class="btn btn-outline-secondary btn-sm">{!! $icons['view'] !!}</a>
<a href="{{ route($type.'.edit', $model) }}" class="btn btn-outline-primary btn-sm">{!! $icons['edit'] !!}</a>
<a href="#" class="btn-delete btn btn-outline-danger btn-sm">{!! $icons['remove'] !!}</a>
