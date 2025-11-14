@extends('layouts.app')

@section('content')
<style>
#historial-fechas div {
    font-size: 0.9rem;
    margin-bottom: 2px;
}
.btn-estado:hover span {
    filter: brightness(0.9);
    box-shadow: 0 0 5px rgba(0,0,0,0.2);
    cursor: pointer;
}
</style>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<h5 class="{{ config('options.styles.card_header') }}"> REPARACIÓN #{{ $model->sn }}
				</h5>
				<div class="card-body">
					{!! Form::model($model, ['route'=> ['repair.update', $model] , 'method'=>'PUT', 'class'=>'form-loading', 'id'=>'form-reparacion', 'enctype'=>"multipart/form-data"]) !!}
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
				            <div class="col-md-2 col-sm-4">
				                <div class="form-group">
				                {!! Field::text('company', $model->company->company_name, ['label' => 'Propietario', 'class'=>'form-control-sm form-control-plaintext']) !!}
				                </div>
				            </div>
						</div>
                        <div class="form-row">
                            <div class="col-md-2 col-sm-4">
                                {!! Field::select('my_company', $locales, \Auth::user()->my_company, ['label' => 'Local de Trabajos', 'empty'=>'Seleccionar', 'class'=>'form-control-sm', 'required'=>'required']) !!}
                            </div>
                        </div>

@if($model->quotes[0])
	@foreach($model->quotes as $quote)
        @php
        $detalles_normales = $quote->details->where('is_downloadable', 0)->sortBy('comment');
        $detalles_repuestos = $quote->details->where('is_downloadable', 1)->sortBy('comment');

        $repuestos_pagados = $detalles_repuestos->where('value', '>', 0);
        $repuestos_compania = $detalles_repuestos->where('value', '=', 0);
        @endphp

<a href="{{ route( 'output_quotes.edit' , $quote->id ) }}" class="btn btn-link btn-sm" title="Editar Presupuesto {{ $quote->type_service }}">EDITAR {!! $quote->sn !!} / {{ $quote->type_service }}</a>

<table class="{{ config('options.styles.table') }}">
    <thead class="{{ config('options.styles.thead') }}">
        <th>Servicio / Categoría</th>
        <th>Cantidad</th>
        <th>Venta</th>
        <th width="100px">Costo S/</th>
        <th>Asignado a:</th>
        <th>¿Generar Vale?</th>
    </thead>
    <tbody>
        {{-- DETALLES NORMALES agrupados por comment --}}
        @php $comentario_actual = null; @endphp
        @foreach($detalles_normales as $detail)
            @php
                $grupo_categoria = Str::slug($detail->comment, '_');
                $tiene_voucher = $detalles_normales
                    ->where('comment', $detail->comment)
                    ->where('voucher_id', '>', 0)
                    ->isNotEmpty();

                $tiene_maestros = isset($masters[$grupo_categoria]) && count($masters[$grupo_categoria]) > 0;
            @endphp
            @if($tiene_maestros || $tiene_maestros)
                @if ($comentario_actual !== $detail->comment)
                    @php
                        $grupo = $detalles_normales->where('comment', $detail->comment);
                        $comentario_actual = $detail->comment;
                        $idGrupo = Str::slug($detail->comment, '_') . '_quote_' . $quote->id;
                    @endphp
                    {{-- Fila resumen del grupo --}}
                    <tr class="table-secondary font-weight-bold" data-group="{{ $idGrupo }}">
                        <td>{{ $comentario_actual }}</td>
                        <td class="grupo-cantidad text-right" data-group="{{ $idGrupo }}">{{ $grupo->sum('quantity') }}</td>
                        <td class="grupo-total text-right" data-group="{{ $idGrupo }}">{{ number_format($grupo->sum('total'), 2) }}</td>
                        <td><input type="number" step="0.01" class="form-control form-control-sm costo-total text-right" data-group="{{ $idGrupo }}"></td>
                        <td>
                            <select class="form-control form-control-sm asignado-grupo" data-group="{{ $idGrupo }}">
                                <option value="">-- Asignar --</option>
                            </select>
                        </td>
                        <td>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input voucher-grupo" id="voucherGrupo{{ $idGrupo }}" data-group="{{ $idGrupo }}">
                                <label class="custom-control-label" for="voucherGrupo{{ $idGrupo }}">Vales</label>
                            </div>
                        </td>
                    </tr>
                @endif
                <tr class="detalle" data-group="{{ $idGrupo }}">
                    {!! Form::hidden("details[$detail->id][order_id]", $quote->id) !!}
                    {!! Form::hidden("details[$detail->id][car_id]", $quote->car_id) !!}
                    {!! Form::hidden("details[$detail->id][placa]", $quote->placa) !!}
                    <td>{{ $detail->product->name }}</td>
                    <td class="cantidad text-right">{{ $detail->quantity }}</td>
                    <td class="text-right">{{ $detail->total }}</td>
                    <td class="text-right">
                        @if($detail->voucher_id > 0)
                        {!! Form::number("details[$detail->id][cost]", $detail->cost, ['class'=>'form-control form-control-sm costo-item text-right', 'step'=>'0.01', 'disabled']) !!}
                        @else
                        {!! Form::number("details[$detail->id][cost]", $detail->cost, ['class'=>'form-control form-control-sm costo-item text-right', 'step'=>'0.01']) !!}
                        @endif
                    </td>
                    <td>
                        @if($detail->voucher_id>0)
                        {{ $detail->technician->company_name }}
                        @else
                        {!! Form::select("details[$detail->id][technician_id]", [$detail->technician_id => $detail->technician_id], $detail->technician_id, ['class'=>'form-control form-control-sm asignado-individual']) !!}
                        @endif
                    </td>
                    <td>
                        @if($detail->voucher_id>0)
                        {{ $detail->voucher->sn }}
                        @else
                        <div class="custom-control custom-switch">
                            {!! Form::checkbox("details[$detail->id][voucher]", 'on', false, [
                                'class' => 'custom-control-input voucher-individual',
                                'id' => 'customSwitch'.$detail->id,
                                'data-group' => $idGrupo
                            ]) !!}
                            <label class="custom-control-label" for="customSwitch{{$detail->id}}">Vale</label>
                        </div>
                        @endif
                    </td>
                </tr>
            @endif
        @endforeach

        {{-- Repuestos pagados --}}
        @if($repuestos_pagados->isNotEmpty() and 1==0)
            <tr class="table-secondary font-weight-bold">
                <td colspan="6">REPUESTOS</td>
            </tr>
            @foreach($repuestos_pagados as $detail)
                <tr>
                    <td>{{ $detail->product->name }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ $detail->total }}</td>
                    <td>{!! Form::number("details[$quote->id][$detail->id]['costo_soles']", 0.00, ['class'=>'form-control form-control-sm']) !!}</td>
                    <td>{!! Form::select("details[$quote->id][$detail->id]['asignado_a']", ['JUAN'=>'JUAN', 'LUIS'=>'LUIS'], null, ['class'=>'form-control form-control-sm']) !!}</td>
                    <td></td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

        {{-- Repuestos por compañía --}}
        @if($repuestos_compania->isNotEmpty())
<table class="table table-sm table-bordered table-hover">
    <thead class="thead-light">
        <tr class="text-center">
            <th>Repuesto</th>
            <th>Cantidad</th>
            <th>Estado</th>
            <th>Guía / Proveedor</th>
            <th>Último movimiento</th>
        </tr>
    </thead>
    <tbody>
        @foreach($repuestos_compania as $item)
        @php
            $prefix = "repuestos_compania[{$item->id}]";
            // Definir la fecha más relevante en orden de prioridad
            $fecha = $item->delivered_at
                ?? $item->received_at
                ?? $item->requested_at
                ?? $item->created_at;
            $fecha_formateada = optional($fecha)->format('d/m/Y h:i a');
        @endphp
        <tr data-index="{{ $item->id }}"
            data-estado-real="{{ $item->status }}"
            data-fecha-creacion="{{ optional($item->created_at)->format('d/m/Y h:i A') }}"
            data-fecha-pedido="{{ optional($item->requested_at)->format('d/m/Y h:i A') }}"
            data-fecha-estimada="{{ optional($item->expected_at)->format('d/m/Y h:i A') }}"
            data-fecha-alerta="{{ optional($item->alert_at)->format('d/m/Y h:i A') }}"
            data-fecha-recepcion="{{ optional($item->received_at)->format('d/m/Y h:i A') }}"
            data-proveedor="{{ $item->provider }}"
            data-guia="{{ $item->guide_number }}"
            data-fecha-entrega="{{ optional($item->delivered_at)->format('d/m/Y h:i A') }}"
            data-fecha-backend="{{ optional($fecha)->format('d/m/Y h:i A') }}">
            <input type="hidden" name="{{ $prefix }}[status]" value="{{ $item->status }}">
            <input type="hidden" name="{{ $prefix }}[requested_at]" value="{{ optional($item->requested_at)->format('Y-m-d\TH:i') }}">
            <input type="hidden" name="{{ $prefix }}[expected_at]" value="{{ optional($item->expected_at)->format('Y-m-d') }}">
            <input type="hidden" name="{{ $prefix }}[alert_at]" value="{{ optional($item->alert_at)->format('Y-m-d') }}">
            <input type="hidden" name="{{ $prefix }}[received_at]" value="{{ optional($item->received_at)->format('Y-m-d\TH:i') }}">
            <input type="hidden" name="{{ $prefix }}[guide_number]" value="{{ $item->guide_number }}">
            <input type="hidden" name="{{ $prefix }}[provider]" value="{{ $item->provider }}">
            <input type="hidden" name="{{ $prefix }}[delivered_at]" value="{{ optional($item->delivered_at)->format('Y-m-d\TH:i') }}">

            <td>{{ $item->product->name ?? '—' }}</td>
            <td class="text-center">{{ $item->quantity ?? 0 }}</td>
<td class="text-center">
    <button type="button"
        class="btn btn-sm p-0 border-0 bg-transparent btn-estado"
        data-index="{{ $item->id }}">
        <span class="badge badge-{{ 
            $item->status === 'ENTREGADO' ? 'success' : 
            ($item->status === 'ALMACEN' ? 'info' : 
            ($item->status === 'PENDIENTE' ? 'warning' : 'secondary')) 
        }}">
            {{ $item->status ?? 'REGISTRADO' }}
        </span>
    </button>
</td>
            <td>
                <small>{{ $item->guide_number ?? '-' }} {{ $item->provider ?? '-' }}</small>
            </td>
            <td>
                <small>{{ $fecha_formateada ?? '-' }}</small>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

        @endif

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

<!-- Modal Estado Repuesto -->
<div class="modal fade" id="modalEstado" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title">Actualizar estado del repuesto</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="mb-2 text-muted">
            <strong id="modal-producto"></strong>
        </div>
        <!-- === HISTORIAL DEL REPUESTO === -->
        <div id="bloque-historial" class="mb-3">
            <h6 class="text-muted">Historial del repuesto</h6>
            <div id="historial-fechas"></div>
        </div>

        <form id="formEstadoTemporal">
          <input type="hidden" id="modal-id">

          <div class="form-row">
            <div class="col-md-6 mb-2">
              <label>Estado actual</label>
              <input type="text" id="estado_actual" class="form-control form-control-sm" readonly>
            </div>
            <div class="col-md-6 mb-2">
              <label>Nuevo estado</label>
              <select id="nuevo_estado" class="form-control form-control-sm">
                <option value="">-- Seleccionar --</option>
                <option value="PENDIENTE">PENDIENTE (Pedido)</option>
                <option value="ALMACEN">ALMACÉN (Recibido)</option>
                <option value="ENTREGADO">ENTREGADO</option>
              </select>
            </div>
          </div>

          <div id="bloque-pedido" class="estado-bloque d-none">
            <hr>
            <h6><i class="fas fa-box"></i> Información de pedido</h6>
            <div class="form-row">
              <div class="col-md-4">
                <label>Fecha de pedido</label>
                <input type="datetime-local" id="pedido_fecha" class="form-control form-control-sm">
              </div>
              <div class="col-md-4">
                <label>Fecha estimada de llegada</label>
                <input type="date" id="pedido_estimado" class="form-control form-control-sm">
              </div>
              <div class="col-md-4">
                <label>Fecha alerta</label>
                <input type="date" id="pedido_alerta" class="form-control form-control-sm">
              </div>
            </div>
          </div>

          <div id="bloque-recepcion" class="estado-bloque d-none">
            <hr>
            <h6><i class="fas fa-truck"></i> Recepción</h6>
            <div class="form-row">
              <div class="col-md-4">
                <label>Fecha recepción</label>
                <input type="datetime-local" id="recepcion_fecha" class="form-control form-control-sm">
              </div>
              <div class="col-md-4">
                <label>Guía de remisión</label>
                <input type="text" id="recepcion_guia" class="form-control form-control-sm text-uppercase">
              </div>
              <div class="col-md-4">
                <label>Proveedor</label>
                <input type="text" id="recepcion_proveedor" class="form-control form-control-sm text-uppercase">
              </div>
            </div>
          </div>

          <div id="bloque-entrega" class="estado-bloque d-none">
            <hr>
            <h6><i class="fas fa-hand-holding"></i> Entrega</h6>
            <div class="form-row">
              <div class="col-md-6">
                <label>Fecha de entrega</label>
                <input type="datetime-local" id="entrega_fecha" class="form-control form-control-sm">
              </div>
              <div class="col-md-6">
                <label>Observación</label>
                <input type="text" id="entrega_observacion" class="form-control form-control-sm">
              </div>
            </div>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btn-sm" id="btn-aplicar-estado">Aplicar cambios</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal de respuesta -->
<div class="modal fade" id="respuestaModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content text-center">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Operación exitosa</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="respuestaMensaje"></p>
      </div>
      <div class="modal-footer justify-content-center">
        <a href="{{ route('vales.index') }}" class="btn btn-outline-success">
            <i class="fas fa-clipboard-list mr-1"></i> Vales
        </a>
        <a href="{{ route('panel', 'REPAR') }}" class="btn btn-outline-info">
            <i class="fa-solid fa-car"></i> Tablero
        </a>
        <button type="button" class="btn btn-outline-secondary" id="btnRecargar">
            <i class="fas fa-sync-alt mr-1"></i> Recargar página
        </button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
$(function(){
    const masters = @json($masters); // { categoria1: [...companies], categoria2: [...companies], ... }
    console.log(masters)

    // Al marcar/desmarcar el switch de grupo, aplicar a todos los del grupo
    $('.voucher-grupo').change(function() {
        const grupo = $(this).data('group');
        const checked = $(this).is(':checked');

        $(`.voucher-individual[data-group="${grupo}"]`).prop('checked', checked);
    });

    function actualizarSelectsPorLocal(myCompanyId) {
        // 🔹 PRIMERO: actualizar los selects individuales
        $('.asignado-individual').each(function() {
            const grupo = $(this).closest('tr').data('group');
            const $select = $(this);
            const valorActual = $select.val();

            $select.empty().append(`<option value="">-- Asignar --</option>`);

            const categoria = grupo.replace(/_quote_\d+$/, ''); 
            const opciones = masters[categoria] || [];
            let encontrado = false;

            opciones.forEach(company => {
                if (parseInt(company.my_company) === parseInt(myCompanyId)) {
                    const selected = (parseInt(company.id) === parseInt(valorActual)) ? 'selected' : '';
                    if (selected) encontrado = true;

                    $select.append(`<option value="${company.id}" ${selected}>${company.company_name}</option>`);
                }
            });

            if (!encontrado) {
                $select.val('');
            }
        });

        // 🔹 LUEGO: actualizar los selects de grupo según la mayoría
        $('.asignado-grupo').each(function() {
            const grupo = $(this).data('group');
            const $select = $(this);

            // Contar valores de los selects individuales ya actualizados
            let conteo = {};
            $(`tr[data-group="${grupo}"] select.asignado-individual`).each(function() {
                const val = $(this).val();
                if (val !== "") {
                    conteo[val] = (conteo[val] || 0) + 1;
                }
            });

            let valorMayoría = null;
            let max = 0;
            Object.entries(conteo).forEach(([valor, cantidad]) => {
                if (cantidad > max) {
                    max = cantidad;
                    valorMayoría = valor;
                }
            });

            const valorActual = $select.val();
            $select.empty().append(`<option value="">-- Asignar --</option>`);

            const categoria = grupo.replace(/_quote_\d+$/, ''); 
            const opciones = masters[categoria] || [];
            let seleccionado = false;

            opciones.forEach(company => {
                if (parseInt(company.my_company) === parseInt(myCompanyId)) {
                    const selected =
                        (company.id == valorActual || company.id == valorMayoría) ? 'selected' : '';
                    if (selected) seleccionado = true;

                    $select.append(`<option value="${company.id}" ${selected}>${company.company_name}</option>`);
                }
            });

            if (!seleccionado) {
                $select.val('');
            }
        });
    }

    function actualizarTotalesDeGrupo() {
        $('.costo-total').each(function () {
            const grupo = $(this).data('group');
            const $filas = $(`tr[data-group="${grupo}"] .costo-item`);

            let total = 0;
            let todosTienenVoucher = true;

            $filas.each(function () {
                const valor = parseFloat($(this).val()) || 0;
                total += valor;

                if (!$(this).prop('disabled')) {
                    todosTienenVoucher = false;
                }
            });

            // Mostrar total
            $(this).val(total.toFixed(2));

            // Desactivar input si todos están con voucher
            if (todosTienenVoucher) {
                $(this).prop('readonly', true); // también podrías usar .prop('disabled', true)
            } else {
                $(this).prop('readonly', false);
            }
        });
    }

    // Inicializa al cargar
    const myCompanyInicial = $('select[name="my_company"]').val();
    actualizarSelectsPorLocal(myCompanyInicial);
    actualizarTotalesDeGrupo();

    // Cambia dinámicamente si el local cambia
    $('select[name="my_company"]').change(function(){
        const nuevoLocal = $(this).val();
        actualizarSelectsPorLocal(nuevoLocal);
    });

    // Copia selección de grupo a ítems del grupo
    $('.asignado-grupo').change(function(){
        let grupo = $(this).data('group');
        let val = $(this).val();
        $(`tr[data-group="${grupo}"] select.asignado-individual`).val(val);
    });

    $('.costo-total').on('focus', function () {
        $(this).data('valor-anterior', $(this).val());
    });

    // Distribuir costo total proporcionalmente
    $('.costo-total').change(function () {
        const grupo = $(this).data('group');
        const nuevoTotal = parseFloat($(this).val()) || 0;
        const $filas = $(`tr[data-group="${grupo}"]`);

        let totalVoucher = 0;
        let totalCantidad = 0;
        const items = [];

        // Recolectar data
        $filas.each(function () {
            const $input = $(this).find('.costo-item');
            const cantidad = parseFloat($(this).find('.cantidad').text()) || 0;
            const valorActual = parseFloat($input.val()) || 0;
            const tieneVoucher = $input.prop('disabled');

            totalCantidad += cantidad;

            if (tieneVoucher) {
                totalVoucher += valorActual;
            } else {
                items.push({
                    $input,
                    cantidad,
                    actual: valorActual
                });
            }
        });

        // Validar que el nuevo total no sea menor que el total de ítems con voucher
        if (nuevoTotal < totalVoucher) {
            alert(`El monto total no puede ser menor a lo ya asignado: S/ ${totalVoucher.toFixed(2)}`);
            const valorAnterior = $(this).data('valor-anterior');
            $(this).val(valorAnterior);
            return;
        }

        // Si no hay ítems para distribuir, salir
        if (items.length === 0) {
            $(this).val(nuevoTotal.toFixed(2));
            return;
        }

        const restante = nuevoTotal - totalVoucher;

        // Calcular distribución proporcional
        let sumaParcial = 0;
        const proporciones = [];

        items.forEach(item => {
            const raw = (item.cantidad / totalCantidad) * restante;
            const base = Math.floor(raw * 100) / 100;
            const residuo = raw - base;
            sumaParcial += base;
            proporciones.push({ item, valor: base, residuo });
        });

        // Ajuste de diferencia
        let diferencia = Math.round((restante - sumaParcial) * 100); // en centavos
        proporciones.sort((a, b) => b.residuo - a.residuo);

        for (let i = 0; i < diferencia; i++) {
            proporciones[i % proporciones.length].valor += 0.01;
        }

        // Asignar a inputs
        proporciones.forEach(p => {
            p.item.$input.val(p.valor.toFixed(2));
        });

        // Mostrar total formateado
        $(this).val(nuevoTotal.toFixed(2));
    });


    // Recalcular el costo total al modificar individualmente los costos
    $('.costo-item').on('change', function() {
        let grupo = $(this).closest('tr').data('group');
        let totalGrupo = 0;

        $(`tr[data-group="${grupo}"] .costo-item`).each(function() {
            totalGrupo += parseFloat($(this).val()) || 0;
        });

        $(`.costo-total[data-group="${grupo}"]`).val(totalGrupo.toFixed(2));
    });

});


$(function(){
    const DEFAULT_ESTIMADO_DIAS = 7;
    const alertRules = [
        { max: 7, alert: 3 },
        { max: 15, alert: 7 },
        { max: 30, alert: 15 },
    ];

    const nextStateMap = {
        'REGISTRADO': 'PENDIENTE',
        'PENDIENTE': 'ALMACEN',
        'ALMACEN': 'ENTREGADO',
        'ENTREGADO': null
    };

    let currentId = null;

    // === Abrir modal ===
    $(document).on('click', '.btn-estado', function() {
        // === LIMPIAR CAMPOS DEL MODAL ANTES DE CARGAR NUEVO REPUESTO ===
        $('#pedido_fecha, #pedido_estimado, #pedido_alerta, #recepcion_fecha, #recepcion_proveedor, #recepcion_guia, #entrega_fecha, #entrega_observacion').val('');

        currentId = $(this).data('index');
        const row = $(this).closest('tr');
        const prefix = `repuestos_compania[${currentId}]`;

        // Leer estado real desde data-estado-real
        const estadoReal = (row.data('estado-real') || '').toUpperCase();
        const siguienteEstado = nextStateMap[estadoReal];

        // Si ya está entregado, bloquear
        if (!siguienteEstado) {
            alert('El repuesto permanece en el mismo estado.');
            return;
        }

        // Detectar si hay cambio pendiente
        const inputNext = row.find(`[name="${prefix}[status]"]`);
        const nextPendiente = inputNext.length ? inputNext.val() : null;

        // Si hay cambio pendiente, el estado actual sigue siendo el real (backend)
        // pero el siguiente será el pendiente (ya marcado)
        let estadoActual = estadoReal;
        let seleccionado = nextPendiente || estadoReal;
        // ⚡ Solo considera “pendiente” si el valor del input difiere del real
        // if (nextPendiente && nextPendiente !== estadoReal) {
        //     seleccionado = nextPendiente;
        //     row.addClass('table-warning'); // visual opcional
        // } else {
        //     seleccionado = estadoReal;
        //     row.removeClass('table-warning'); // limpia sombreado si ya está alineado
        // }

        $('#modal-id').val(currentId);
        $('#estado_actual').val(estadoActual);

        // Generar select: siempre actual + siguiente
        let options = `<option value="${estadoActual}" ${seleccionado === estadoActual ? 'selected' : ''}>${estadoActual} (Mantener)</option>`;
        options += `<option value="${siguienteEstado}" ${seleccionado === siguienteEstado ? 'selected' : ''}>${siguienteEstado}</option>`;
        $('#nuevo_estado').html(options);

        // Reset de bloques
        $('.estado-bloque').addClass('d-none');
        const estadoSeleccionado = $('#nuevo_estado').val();

        // === Mostrar bloque y precargar datos si existen ===
        const prefixRow = `repuestos_compania[${currentId}]`;
        const valReq = row.find(`[name="${prefixRow}[requested_at]"]`).val();
        const valExp = row.find(`[name="${prefixRow}[expected_at]"]`).val();
        const valAle = row.find(`[name="${prefixRow}[alert_at]"]`).val();
        const valRec = row.find(`[name="${prefixRow}[received_at]"]`).val();
        const valEnt = row.find(`[name="${prefixRow}[delivered_at]"]`).val();

        mostrarBloquePorEstado(estadoSeleccionado);

        // Precargar si existen
        if (estadoSeleccionado === 'PENDIENTE') {
            if (valReq) $('#pedido_fecha').val(valReq);
            if (valExp) $('#pedido_estimado').val(valExp);
            if (valAle) $('#pedido_alerta').val(valAle);
        }
        if (estadoSeleccionado === 'ALMACEN') {
            if (valRec) $('#recepcion_fecha').val(valRec);
            const valProv = row.find(`[name="${prefixRow}[provider]"]`).val();
            const valGuia = row.find(`[name="${prefixRow}[guide_number]"]`).val();
            if (valProv) $('#recepcion_proveedor').val(valProv);
            if (valGuia) $('#recepcion_guia').val(valGuia);
        }
        if (estadoSeleccionado === 'ENTREGADO') {
            if (valEnt) $('#entrega_fecha').val(valEnt);
        }
        
        // === Mostrar historial desde atributos data o inputs ===
        let historialHTML = '';
        const format = formatDateTime; // reutiliza tu función existente

        const fechas = {
            'Fecha de creación': row.data('created-at') || row.find(`[name="${prefix}[created_at]"]`).val(),
            'Fecha de pedido': row.find(`[name="${prefix}[requested_at]"]`).val(),
            'Llegada estimada': row.find(`[name="${prefix}[expected_at]"]`).val(),
            'Fecha de alerta': row.find(`[name="${prefix}[alert_at]"]`).val(),
            'Fecha de recepción': row.find(`[name="${prefix}[received_at]"]`).val(),
            'Fecha de entrega': row.find(`[name="${prefix}[delivered_at]"]`).val()
        };

        // Proveedor y guía
        const proveedor = row.find(`[name="${prefix}[provider]"]`).val();
        const guia = row.find(`[name="${prefix}[guide_number]"]`).val();

        // Generar HTML solo para los campos existentes
        Object.entries(fechas).forEach(([label, value]) => {
            if (value) {
                let fechaFmt = value.includes('T') ? format(new Date(value)) : value;
                historialHTML += `<div><strong>${label}:</strong> ${fechaFmt}</div>`;
            }
        });

        // Agregar proveedor y guía solo si existen
        if (proveedor || guia) {
            historialHTML += `<div><strong>Proveedor:</strong> ${proveedor || '-'} <strong>Guía:</strong> ${guia || '-'}</div>`;
        }

        // Insertar o limpiar el historial
        $('#historial-lista').html(historialHTML || '<em>Sin información registrada</em>');

        // === Mostrar historial del backend ===
        const historial = [];

        // Tomar las fechas del backend (atributos data- del <tr>)
        const fechaCreacion = row.data('fecha-creacion');
        const fechaPedido = row.data('fecha-pedido');
        const fechaEstimada = row.data('fecha-estimada');
        const fechaAlerta = row.data('fecha-alerta');
        const fechaRecepcion = row.data('fecha-recepcion');
        const proveedorBD = row.data('proveedor');  // 👈 cambiado
        const guiaBD = row.data('guia');            // 👈 cambiado
        const fechaEntrega = row.data('fecha-entrega');

        // Construir dinámicamente las líneas del historial (solo si existen)
        if (fechaCreacion) historial.push(`<div>📅 <strong>Fecha de creación:</strong> ${fechaCreacion}</div>`);
        if (fechaPedido) historial.push(`<div>🛒 <strong>Fecha de pedido:</strong> ${fechaPedido}</div>`);
        if (fechaEstimada) historial.push(`<div>⏰ <strong>Llegada estimada:</strong> ${fechaEstimada}</div>`);
        if (fechaAlerta) historial.push(`<div>⚠️ <strong>Fecha de alerta:</strong> ${fechaAlerta}</div>`);
        if (fechaRecepcion) historial.push(`<div>📦 <strong>Recepción:</strong> ${fechaRecepcion}</div>`);
        if (proveedorBD || guiaBD) historial.push(`<div>🏷️ <strong>Proveedor:</strong> ${proveedorBD ?? '-'} — <strong>Guía:</strong> ${guiaBD ?? '-'}</div>`);
        if (fechaEntrega) historial.push(`<div>✅ <strong>Entrega:</strong> ${fechaEntrega}</div>`);

        // Insertar el historial o un mensaje vacío
        $('#historial-fechas').html(historial.length ? historial.join('') : '<div class="text-muted">Sin registros anteriores.</div>');

        $('#modalEstado').modal('show');
        $('#modal-producto').text(`${row.find('td:first').text().trim()} — ${row.find('td:eq(1)').text().trim()} und`);

    });


    // === Cambio de opción en "Nuevo estado" ===
    $('#nuevo_estado').on('change', function() {
        const estado = $(this).val();

        // Mostrar dinámicamente el bloque correcto
        mostrarBloquePorEstado(estado);

        // Si el usuario mantiene el mismo estado → no sobreescribas nada
        if ($('#estado_actual').val() === estado) return;

        // === Si cambia a un estado nuevo (sin datos previos) inicializa los campos ===
        const hoy = new Date();
        const hoyISO = new Date(hoy.getTime() - hoy.getTimezoneOffset() * 60000)
            .toISOString()
            .slice(0, 16);

        if (estado === 'PENDIENTE' && !$('#pedido_fecha').val()) {
            $('#pedido_fecha').val(hoyISO);
            const estimado = new Date(hoy);
            estimado.setDate(estimado.getDate() + DEFAULT_ESTIMADO_DIAS);
            $('#pedido_estimado').val(estimado.toISOString().slice(0, 10));
            calcularAlerta();
        }
        else if (estado === 'ALMACEN' && !$('#recepcion_fecha').val()) {
            $('#recepcion_fecha').val(hoyISO);
        }
        else if (estado === 'ENTREGADO' && !$('#entrega_fecha').val()) {
            $('#entrega_fecha').val(hoyISO);
        }
    });


    // === Calcular fecha alerta ===
    $('#pedido_estimado').on('change', calcularAlerta);

    // 2️⃣ Si cambia la fecha de pedido → recalcular estimada y alerta (solo si el estado real es REGISTRADO)
    $('#pedido_fecha').on('change', function() {
        const estadoReal = $('#estado_actual').val(); // viene del backend
        if (estadoReal !== 'REGISTRADO') return;

        const nuevaPedido = new Date($(this).val());
        if (isNaN(nuevaPedido)) return;

        // Recalcular fecha estimada: pedido + DEFAULT_ESTIMADO_DIAS
        const estimado = new Date(nuevaPedido);
        estimado.setDate(estimado.getDate() + DEFAULT_ESTIMADO_DIAS);
        $('#pedido_estimado').val(estimado.toISOString().slice(0,10));

        $('#pedido_estimado').addClass('bg-warning');
        setTimeout(() => $('#pedido_estimado').removeClass('bg-warning'), 500);

        // Luego recalcula alerta en base a las nuevas fechas
        calcularAlerta();
    });
    function calcularAlerta(){
        const pedidoFecha = new Date($('#pedido_fecha').val());
        const estimada = new Date($('#pedido_estimado').val());
        if (!estimada || !pedidoFecha) return;

        const diff = Math.round((estimada - pedidoFecha) / (1000*60*60*24));
        const rule = alertRules.find(r => diff <= r.max) || { alert: 1 };
        const alerta = new Date(estimada);
        alerta.setDate(alerta.getDate() - rule.alert);
        $('#pedido_alerta').val(alerta.toISOString().slice(0,10));
        $('#pedido_alerta').addClass('bg-warning');
        setTimeout(() => $('#pedido_alerta').removeClass('bg-warning'), 500);
    }

// === Aplicar cambios ===
$('#btn-aplicar-estado').on('click', function() {
    const id = $('#modal-id').val();
    const estadoActual = $('#estado_actual').val();
    const nuevo = $('#nuevo_estado').val();
    const prefix = `repuestos_compania[${id}]`;
    const row = $(`tr[data-index="${id}"]`);

    if (!row.length) {
        alert('No se encontró la fila del repuesto.');
        return;
    }

    if (!nuevo) {
        alert('Debes seleccionar un estado o mantener el actual.');
        return;
    }

    // === Valores del modal ===
    const valReq  = $('#pedido_fecha').val()  ?? '';
    const valExp  = $('#pedido_estimado').val() ?? '';
    const valAle  = $('#pedido_alerta').val() ?? '';
    const valRec  = $('#recepcion_fecha').val() ?? '';
    const valProv = $('#recepcion_proveedor').val() ?? '';
    const valGuia = $('#recepcion_guia').val() ?? '';
    const valEnt  = $('#entrega_fecha').val() ?? '';

    // === Función para limpiar y actualizar según estado ===
    function filtrarCamposPorEstado(estadoDestino) {
        const camposPorEstado = {
            'REGISTRADO': [],
            'PENDIENTE': ['requested_at', 'expected_at', 'alert_at'],
            'ALMACEN': ['requested_at', 'expected_at', 'alert_at', 'received_at', 'provider', 'guide_number'],
            'ENTREGADO': ['requested_at', 'expected_at', 'alert_at', 'received_at', 'provider', 'guide_number', 'delivered_at']
        };

        const camposValidos = camposPorEstado[estadoDestino] || [];
        const todos = ['requested_at', 'expected_at', 'alert_at', 'received_at', 'provider', 'guide_number', 'delivered_at'];

        // 🔹 Primero vaciamos todo
        todos.forEach(campo => row.find(`[name="${prefix}[${campo}]"]`).val(''));

        // 🔹 Luego asignamos los que correspondan al estado destino
        if (camposValidos.includes('requested_at')) row.find(`[name="${prefix}[requested_at]"]`).val(valReq);
        if (camposValidos.includes('expected_at')) row.find(`[name="${prefix}[expected_at]"]`).val(valExp);
        if (camposValidos.includes('alert_at')) row.find(`[name="${prefix}[alert_at]"]`).val(valAle);
        if (camposValidos.includes('received_at')) row.find(`[name="${prefix}[received_at]"]`).val(valRec);
        if (camposValidos.includes('provider')) row.find(`[name="${prefix}[provider]"]`).val(valProv);
        if (camposValidos.includes('guide_number')) row.find(`[name="${prefix}[guide_number]"]`).val(valGuia);
        if (camposValidos.includes('delivered_at')) row.find(`[name="${prefix}[delivered_at]"]`).val(valEnt);

        // 🔹 Actualizamos la columna visual de Guía/Proveedor
        const tdGuiaProv = row.find('td').eq(3);
        if (camposValidos.includes('provider') || camposValidos.includes('guide_number')) {
            tdGuiaProv.html(`<small>${valGuia || ''} ${valProv || ''}</small>`);
        } else {
            tdGuiaProv.html('<small></small>');
        }
    }

    // === Mantener el estado actual ===
    if (nuevo === estadoActual) {

        // ✅ Asegurar sincronización del input hidden
        row.find(`[name="${prefix}[status]"]`).val(estadoActual);
        row.removeClass('table-warning');

        // ✅ Limpiar y actualizar campos coherentes con el estado actual
        filtrarCamposPorEstado(estadoActual);

        // ✅ Releer valores reales del DOM
        const realReq  = row.find(`[name="${prefix}[requested_at]"]`).val() || '';
        const realRec  = row.find(`[name="${prefix}[received_at]"]`).val() || '';
        const realEnt  = row.find(`[name="${prefix}[delivered_at]"]`).val() || '';
        const realProv = row.find(`[name="${prefix}[provider]"]`).val() || '';
        const realGuia = row.find(`[name="${prefix}[guide_number]"]`).val() || '';

        // ✅ Actualizar columna de Guía / Proveedor
        const tdGuiaProv = row.find('td').eq(3);
        tdGuiaProv.html(
            realProv || realGuia ? `<small>${realGuia} ${realProv}</small>` : '<small>-</small>'
        );

        // ✅ Determinar fecha según el estado mantenido
        let fechaMostrar = '';
        if (estadoActual === 'ENTREGADO' && realEnt) fechaMostrar = realEnt;
        else if (estadoActual === 'ALMACEN' && realRec) fechaMostrar = realRec;
        else if (estadoActual === 'PENDIENTE' && realReq) fechaMostrar = realReq;
        else fechaMostrar = realEnt || realRec || realReq || row.data('fecha-creacion') || '';

        if (fechaMostrar && fechaMostrar.includes('T')) {
            fechaMostrar = formatDateTime(new Date(fechaMostrar));
        }
        row.find('td:last').html(`<small>${fechaMostrar || '-'}</small>`);

        // ✅ Actualizar badge visual
        const badge = row.find('.btn-estado span');
        badge
            .removeClass('badge-secondary badge-warning badge-info badge-success')
            .text(estadoActual);

        if (estadoActual === 'REGISTRADO') badge.addClass('badge-secondary');
        else if (estadoActual === 'PENDIENTE') badge.addClass('badge-warning');
        else if (estadoActual === 'ALMACEN') badge.addClass('badge-info');
        else if (estadoActual === 'ENTREGADO') badge.addClass('badge-success');

        alert('Se han actualizado los datos del repuesto (sin cambiar de estado).');
        $('#modalEstado').modal('hide');
        return;
    }

    // === Cambio de estado ===
    row.find(`[name="${prefix}[status]"]`).val(nuevo);
    row.addClass('table-warning');

    // ✅ Aplicar limpieza y actualización coherente
    filtrarCamposPorEstado(nuevo);

    // === Determinar fecha a mostrar ===
    let fechaMostrar = '';
    if (nuevo === 'ENTREGADO' && valEnt) fechaMostrar = valEnt;
    else if (nuevo === 'ALMACEN' && valRec) fechaMostrar = valRec;
    else if (nuevo === 'PENDIENTE' && valReq) fechaMostrar = valReq;
    else fechaMostrar = valEnt || valRec || valReq || row.data('fecha-creacion') || '';

    if (fechaMostrar && fechaMostrar.includes('T')) {
        fechaMostrar = formatDateTime(new Date(fechaMostrar));
    }
    row.find('td:last').html(`<small>${fechaMostrar || '-'}</small>`);

    // === Actualizar badge visual ===
    const badge = row.find('.btn-estado span');
    badge.removeClass('badge-secondary badge-warning badge-info badge-success')
        .text(`*${nuevo}`);
    if (nuevo === 'REGISTRADO') badge.addClass('badge-secondary');
    else if (nuevo === 'PENDIENTE') badge.addClass('badge-warning');
    else if (nuevo === 'ALMACEN') badge.addClass('badge-info');
    else if (nuevo === 'ENTREGADO') badge.addClass('badge-success');

    alert(`El repuesto pasará a estado ${nuevo} al guardar el formulario.`);
    $('#modalEstado').modal('hide');
});


    function formatDateTime(dateObj) {
        const d = new Date(dateObj);
        const dia = String(d.getDate()).padStart(2, '0');
        const mes = String(d.getMonth() + 1).padStart(2, '0');
        const anio = d.getFullYear();
        let horas = d.getHours();
        const minutos = String(d.getMinutes()).padStart(2, '0');
        const ampm = horas >= 12 ? 'PM' : 'AM';
        horas = horas % 12 || 12;
        const horasStr = String(horas).padStart(2, '0');
        return `${dia}/${mes}/${anio} ${horasStr}:${minutos} ${ampm}`;
    }

    function limpiarCamposNuevoEstado(){
        $('#bloque-pedido, #bloque-recepcion, #bloque-entrega').find('input').val('');
    }
    // === Función auxiliar para mostrar los bloques según el estado seleccionado ===
    function mostrarBloquePorEstado(estado) {
        const hoy = new Date();
        const hoyISO = new Date(hoy.getTime() - hoy.getTimezoneOffset() * 60000)
            .toISOString()
            .slice(0, 16);

        // Ocultar todos los bloques
        $('.estado-bloque').addClass('d-none');

        const prefix = `repuestos_compania[${currentId}]`;
        const row = $(`tr[data-index="${currentId}"]`);

        // Recuperar valores existentes del repuesto (si los hay)
        const valReq = row.find(`[name="${prefix}[requested_at]"]`).val() || '';
        const valExp = row.find(`[name="${prefix}[expected_at]"]`).val() || '';
        const valAle = row.find(`[name="${prefix}[alert_at]"]`).val() || '';
        const valRec = row.find(`[name="${prefix}[received_at]"]`).val() || '';
        const valProv = row.find(`[name="${prefix}[provider]"]`).val() || '';
        const valGuia = row.find(`[name="${prefix}[guide_number]"]`).val() || '';
        const valEnt = row.find(`[name="${prefix}[delivered_at]"]`).val() || '';

        // === Mostrar el bloque correspondiente, pero solo rellenar si el valor existe ===
        if (estado === 'PENDIENTE') {
            $('#bloque-pedido').removeClass('d-none');
            $('#pedido_fecha').val(valReq || hoyISO);
            $('#pedido_estimado').val(valExp || '');
            $('#pedido_alerta').val(valAle || '');
            if (!valAle && valExp) calcularAlerta(); // solo si falta alerta
        }
        else if (estado === 'ALMACEN') {
            $('#bloque-recepcion').removeClass('d-none');
            $('#recepcion_fecha').val(valRec || hoyISO);
            $('#recepcion_proveedor').val(valProv || '');
            $('#recepcion_guia').val(valGuia || '');
        }
        else if (estado === 'ENTREGADO') {
            $('#bloque-entrega').removeClass('d-none');
            $('#entrega_fecha').val(valEnt || hoyISO);
        }
    }

});

$(function() {
    $('#form-reparacion').on('submit', function(e) {
        e.preventDefault(); // Evita el envío normal

        let form = $(this);
        let actionUrl = form.attr('action');
        let formData = form.serialize(); // o usar FormData si hay archivos

        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                form.find('button[type="submit"]').prop('disabled', true).text('Guardando...');
            },
            success: function(response) {
                $('#respuestaMensaje').text(response.message || 'Datos guardados correctamente.');
                $('#respuestaModal').modal('show');
            },
            error: function(xhr) {
                console.error(xhr);
                let msg = 'Error al guardar los datos.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }
                $('#respuestaMensaje').text(msg);
                $('#respuestaModal .modal-header').removeClass('bg-success').addClass('bg-danger');
                $('#respuestaModal').modal('show');
            },
            complete: function() {
                form.find('button[type="submit"]').prop('disabled', false).text('Guardar');
            }
        });
    });

    // Si el modal se cierra, recarga la página
    $('#respuestaModal').on('hidden.bs.modal', function () {
        location.reload();
    });

    // Botón manual para recargar
    $('#btnRecargar').on('click', function () {
        location.reload();
    });
});

</script>
@endsection
