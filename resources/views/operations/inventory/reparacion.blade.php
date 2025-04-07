@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<h5 class="{{ config('options.styles.card_header') }}"> REPARACIÓN #{{ $model->sn }}
				</h5>
				<div class="card-body">
					{!! Form::model($model, ['route'=> ['update_status_order', $model] , 'method'=>'PUT', 'class'=>'', 'enctype'=>"multipart/form-data"]) !!}
						@if(Request::url() != URL::previous())
						<input type="hidden" name="last_page" value="{{ URL::previous() }}">
						@endif

						{!! Form::hidden('action', '', ['id'=>'action']) !!}
						<div class="form-row">
							<div class="col-sm-2">
				                {!! Field::text('placa', null, ['label' => 'Placa', 'class'=>'form-control-sm form-control-plaintext']) !!}
				            </div>
				            <div class="col-md-2 col-sm-4">
				                <div class="form-group">
				                    <label for="brand">Marca</label>
				                    {!! Form::text('brand', $model->car->brand->name, ['class'=>'form-control-sm form-control-plaintext', 'id'=>'brand']) !!}
				                </div>
				            </div>
				            <div class="col-md-2 col-sm-4">
				                <div class="form-group">
				                    <label for="modelo">Modelo</label>
				                    {!! Form::text('modelo', $model->car->modelo->name, ['class'=>'form-control-sm form-control-plaintext', 'id'=>'modelo']) !!}
				                </div>
				            </div>
						</div>
						<div class="form-row">
				            <div class="col-md-2 col-sm-4">
				                <div class="form-group">
				                {!! Field::text('company', $model->company->company_name, ['label' => 'Propietario', 'class'=>'form-control-sm form-control-plaintext']) !!}
				                </div>
				            </div>
						</div>

@if($model->orders[0])
	@foreach($model->orders as $quote)
@php
$detalles_normales = $quote->details->where('is_downloadable', 0)->sortBy('comment');
$detalles_repuestos = $quote->details->where('is_downloadable', 1)->sortBy('comment');

$repuestos_pagados = $detalles_repuestos->where('value', '>', 0);
$repuestos_compania = $detalles_repuestos->where('value', '=', 0);
@endphp

<table class="{{ config('options.styles.table') }}">
    <thead class="{{ config('options.styles.thead') }}">
        <th>Servicio / Categoría</th>
        <th>Cantidad</th>
        <th>Venta</th>
        <th width="100px">Costo S/</th>
        <th>Asignado a:</th>
    </thead>
    <tbody>
        {{-- DETALLES NORMALES agrupados por comment --}}
        @php $comentario_actual = null; @endphp
        @foreach($detalles_normales as $detail)
            @if ($comentario_actual !== $detail->comment)
                @php
                    $grupo = $detalles_normales->where('comment', $detail->comment);
                    $comentario_actual = $detail->comment;
                    $idGrupo = Str::slug($comentario_actual, '_');
                @endphp
                {{-- Fila resumen del grupo --}}
                <tr class="table-secondary font-weight-bold">
                    <td>{{ $comentario_actual }}</td>
                    <td class="grupo-cantidad" data-group="{{ $idGrupo }}">{{ $grupo->sum('quantity') }}</td>
                    <td class="grupo-total" data-group="{{ $idGrupo }}">{{ number_format($grupo->sum('total'), 2) }}</td>
                    <td><input type="number" step="0.01" class="form-control form-control-sm costo-total" data-group="{{ $idGrupo }}"></td>
                    <td>
                        <select class="form-control form-control-sm asignado-grupo" data-group="{{ $idGrupo }}">
                            <option value="">-- Asignar --</option>
                            <option value="JUAN">JUAN</option>
                            <option value="LUIS">LUIS</option>
                        </select>
                    </td>
                </tr>
            @endif
            <tr class="detalle" data-group="{{ $idGrupo }}">
                <td>{{ $detail->product->name }}</td>
                <td class="cantidad">{{ $detail->quantity }}</td>
                <td>{{ $detail->total }}</td>
                <td>{!! Form::number("details[$quote->id][$detail->id]['costo_soles']", 0.00, ['class'=>'form-control form-control-sm costo-item']) !!}</td>
                <td>{!! Form::select("details[$quote->id][$detail->id]['asignado_a']", ['JUAN'=>'JUAN', 'LUIS'=>'LUIS'], null, ['class'=>'form-control form-control-sm asignado-individual']) !!}</td>
            </tr>
        @endforeach

        {{-- Repuestos pagados --}}
        @if($repuestos_pagados->isNotEmpty())
            <tr class="table-secondary font-weight-bold">
                <td colspan="5">REPUESTOS</td>
            </tr>
            @foreach($repuestos_pagados as $detail)
                <tr>
                    <td>{{ $detail->product->name }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ $detail->total }}</td>
                    <td>{!! Form::number("details[$quote->id][$detail->id]['costo_soles']", 0.00, ['class'=>'form-control form-control-sm']) !!}</td>
                    <td>{!! Form::select("details[$quote->id][$detail->id]['asignado_a']", ['JUAN'=>'JUAN', 'LUIS'=>'LUIS'], null, ['class'=>'form-control form-control-sm']) !!}</td>
                </tr>
            @endforeach
        @endif

        {{-- Repuestos por compañía --}}
        @if($repuestos_compania->isNotEmpty())
            <tr class="table-secondary font-weight-bold">
                <td colspan="5">REPUESTOS POR COMPAÑÍA</td>
            </tr>
            @foreach($repuestos_compania as $detail)
                <tr>
                    <td>{{ $detail->product->name }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ $detail->total }}</td>
                    <td>{!! Form::number("details[$quote->id][$detail->id]['costo_soles']", 0.00, ['class'=>'form-control form-control-sm']) !!}</td>
                    <td>{!! Form::select("details[$quote->id][$detail->id]['asignado_a']", ['JUAN'=>'JUAN', 'LUIS'=>'LUIS'], null, ['class'=>'form-control form-control-sm']) !!}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

	@endforeach
@endif

						<div class="form-row">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-outline-success" id="submit">{!! $icons['save'] !!} Guardar</button>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
<script>
$(function(){
    // Asignar personal a todos los ítems del grupo
    $('.asignado-grupo').change(function(){
        let grupo = $(this).data('group');
        let val = $(this).val();
        $(`tr[data-group="${grupo}"] select.asignado-individual`).val(val);
    });

    // Distribuir costo total proporcionalmente
    $('.costo-total').change(function(){
        let grupo = $(this).data('group');
        let costoTotal = parseFloat($(this).val()) || 0;

        let cantidades = [];
        let totalCantidad = 0;

        $(`tr[data-group="${grupo}"]`).each(function(){
            let cantidad = parseFloat($(this).find('.cantidad').text()) || 0;
            cantidades.push(cantidad);
            totalCantidad += cantidad;
        });

        $(`tr[data-group="${grupo}"]`).each(function(i){
            let proporción = cantidades[i] / totalCantidad;
            let prorrateado = (costoTotal * proporción).toFixed(2);
            $(this).find('.costo-item').val(prorrateado);
        });
    });
});
</script>
@endsection
