<div class="btn-group">
    <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
        {!! $icons['more'] !!} <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
        <li><a href="{{ route('create_order_by_company', $model) }}">Crear cotización</a></li>
    </ul>
</div>
<a href="{{ route($type.'.show', $model->id) }}" class="btn btn-outline-secondary btn-sm">{!! $icons['view'] !!}</a>
<a href="{{ route($type.'.edit', $model) }}" class="btn btn-outline-primary btn-sm">{!! $icons['edit'] !!}</a>
{!! Form::open(['route' => [$type.'.destroy', $model->id], 'method' => 'DELETE', 'style' => 'display:inline']) !!}
    <button type="submit" class="btn btn-outline-danger btn-sm btn-delete" title="Eliminar">{!! $icons['remove'] !!}</button>
{!! Form::close() !!}
