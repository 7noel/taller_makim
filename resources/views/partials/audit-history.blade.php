@php
    $audits = $model->audits()
        ->with('user')
        ->latest()
        ->limit(50)
        ->get();

    $camposIgnorar = ['updated_at','created_at','entity_type','id'];

    $labels = [
        'placa'       => 'Placa',
        'marca'       => 'Marca',
        'modelo'      => 'Modelo',
        'color'       => 'Color',
        'cliente_id'  => 'Cliente',
        'deleted_at'  => 'Fecha eliminación'
    ];

    $collapseId = 'audit-history-'.class_basename($model).'-'.$model->id;
@endphp

@if($audits->isNotEmpty())

<div class="mb-2">
    <a class="btn btn-link p-0" data-toggle="collapse" href="#{{ $collapseId }}">
        Ver Historial
    </a>
</div>

<div class="collapse col-md-6" id="{{ $collapseId }}">
    <table class="table table-sm table-striped table-bordered">
        <thead class="thead-light">
            <tr>
                <th width="120">Fecha</th>
                <th width="100">Hora</th>
                <th width="200">Usuario</th>
                <th width="120">Evento</th>
                <th width="120">Acción</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($audits as $audit)
            <tr>
                <td>{{ $audit->created_at->format('Y-m-d') }}</td>
                <td>{{ $audit->created_at->format('h:i:s A') }}</td>
                <td>{{ optional($audit->user)->name ?? 'Sistema' }}</td>
                <td>
                    @switch($audit->event)
                        @case('created')  <span class="badge badge-success">Creado</span> @break
                        @case('updated')  <span class="badge badge-warning">Actualizado</span> @break
                        @case('deleted')  <span class="badge badge-danger">Eliminado</span> @break
                        @case('restored') <span class="badge badge-info">Restaurado</span> @break
                        @default           <span class="badge badge-secondary">{{ $audit->event }}</span>
                    @endswitch
                </td>
                <td class="text-center">
                    <button class="btn btn-sm btn-info" data-toggle="collapse" data-target="#audit-detail-{{ $audit->id }}">
                        Ver cambios
                    </button>
                </td>
            </tr>
            <tr id="audit-detail-{{ $audit->id }}" class="collapse">
                <td colspan="5">
                @if($audit->old_values || $audit->new_values)
                    <table class="table table-sm table-bordered mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th width="250">Campo</th>
                                <th>Antes</th>
                                <th>Después</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach (array_unique(array_merge(
                            array_keys($audit->old_values ?? []),
                            array_keys($audit->new_values ?? [])
                        )) as $campo)

                        @continue(in_array($campo, $camposIgnorar))
                        @php
                            $valorAnterior = $audit->old_values[$campo] ?? null;
                            $valorNuevo    = $audit->new_values[$campo] ?? null;
                            $nombreCampo   = $labels[$campo] ?? $campo;

                            if(is_array($valorAnterior)) $valorAnterior = json_encode($valorAnterior);
                            if(is_array($valorNuevo))    $valorNuevo    = json_encode($valorNuevo);

                            $valorAnterior = $valorAnterior ?? '-';
                            $valorNuevo    = $valorNuevo ?? '-';
                        @endphp
                            <tr>
                                <td><strong>{{ $nombreCampo }}</strong></td>
                                <td>{{ $valorAnterior }}</td>
                                <td>
                                    @if($valorAnterior != $valorNuevo)
                                        <span class="text-success font-weight-bold">{{ $valorNuevo }}</span>
                                    @else
                                        {{ $valorNuevo }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info mb-0">
                        No hay cambios registrados.
                    </div>
                @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@endif