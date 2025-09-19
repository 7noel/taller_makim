<div class="form-row mb-2 d-none">
		<div class="col-sm-2">
		    <button id="btn-enviar-seleccion" class="btn btn-outline-info btn-sm"><i class="fa-regular fa-share-from-square"></i> Generar Planilla</button>
		</div>
		<div class="col-sm-2">
			<input type="number" step="0.01" class="form-control form-control-sm" id="descuento" placeholder="Vale Descuento">
		</div>
		<div class="col-sm-2">
			<input type="number" step="0.01" class="form-control form-control-sm" id="sctr" placeholder="SCTR">
		</div>
</div>

<table id="tabla-vouchers" class="{{ config('options.styles.table') }}">
	<thead class="{{ config('options.styles.thead') }}">
		<tr>
			<th class="col-select">
      	<div class="custom-control custom-switch">
					<input type="checkbox" class="custom-control-input" id="vouchersAll">
					<label class="custom-control-label" for="vouchersAll" title="Seleccionar Todos"></label>
				</div>
			</th>
			<th>Emisión</th>
			<th>Documento</th>
			<th>Cliente</th>
			<th>Placa</th>
			<th>Marca</th>
			<th>Modelo</th>
			<th>Estado</th>
			<th>Mnd</th>
			<th>SubTotal</th>
			<th class="text-center">Presup.</th>
			<th class="text-center">Invent.</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach($models as $model)
		@php
		$r = json_decode($model->response_sunat);
		if ($model->status_sunat=='ERROR') {
			$clase = 'badge badge-warning';
		} elseif ($model->status_sunat=='CERR') {
			$clase = 'badge badge-success';
		} elseif ($model->status_sunat=='PANUL') {
			$clase = 'badge badge-secondary';
		} elseif ($model->status_sunat=='ANUL') {
			$clase = 'badge badge-danger';
		} else {
			$clase = 'badge badge-info';
		}
		@endphp
		<tr data-id="{{ $model->id }}" data-company-id="{{ $model->company_id }}" data-status="{{ $model->status_sunat }}">
			<td class="col-select">
	        @if($model->status_sunat === 'PEND')
	            <div class="custom-control custom-switch">
	                {!! Form::checkbox("voucher[$model->id]", 'on', false, [
	                    'class' => 'custom-control-input voucher-individual',
	                    'id'    => 'customSwitch'.$model->id
	                ]) !!}
	                <label class="custom-control-label" for="customSwitch{{$model->id}}"></label>
	            </div>
	        @else
	            <span class="text-muted">—</span>
	        @endif
	    </td>
			<td>{{ date('d/m/Y', strtotime($model->issued_at)) }} </td>
			<td>{{ $model->sn }} </td>
			<td>{{ $model->company->company_name }}</td>
			<td>{{ $model->car->placa }}</td>
			<td>{{ $model->car->brand->name }}</td>
			<td>{{ $model->car->modelo->name }}</td>
			<td class="status"><span class="{{ $clase }}">{{ $model->status_sunat }}</span></td>
			<td>{{ config('options.table_sunat.moneda_sunat.'.$model->currency_id) }}</td>
			<td>{{ $model->subtotal }}</td>
			<td class="text-center">
				@if($model->order)
				<a href="{{ '/operations/output_quotes?sn='.$model->order->sn }}" class="btn btn-link btn-sm" title="Ver Presupuesto">{{ $model->order->sn }}</a>
				@else
				LIBRE
				@endif
			</td>
			<td class="text-center">
				@if(optional($model->order)->inventario)
				<a href="{{ '/operations/inventario?sn='.$model->order->inventario->sn }}" class="btn btn-link btn-sm" title="Ver Inventario">{{ $model->order->inventario->sn }}</a>
				@else
				LIBRE
				@endif
			</td>
			<td>
				<a href="{{ route('vales.print', $model->id) }}" target="_blank" class="btn btn-outline-success btn-sm" title="IMPRIMIR">{!! $icons['printer'] !!}</a>
				@if($model->status_sunat!='ANUL' and $model->status_sunat!='CIERR')
						<a href="#" class="btn-anular btn btn-outline-danger btn-sm" title="ANULAR">{!! $icons['remove'] !!}</a>
				@endif
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="pagarModal" tabindex="-1" aria-labelledby="pagarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pagarModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="container-fluid">
		  <div class="row">
<form id="agregar-pago">
<div class="form-row">
  <div class="col-sm-6">
  	<div class="form-group">
  	<label for="cuenta">Cuenta</label>
  	{!! Form::select('cuenta', ['1'=>'CUENTA PRINCIPAL'], null,['class'=>'form-control form-control-sm', 'required']) !!}
  	</div>
  </div>
  <div class="col-sm-6">
    {!! Field::select('metodo', config('options.metodos_pago'), ['label'=>'Método', 'empty'=>'Seleccionar', 'class'=>'form-control-sm', 'required']) !!}
  </div>
  <div class="col-sm-6">
    {!! Field::date('issued_at', date('Y-m-d'), ['label'=>'Fecha','class'=>'form-control-sm']) !!}
  </div>
  <div class="col-sm-6">
  	<label for="currency_id">Moneda</label>
    <p class="form-control-plaintext pl-4" id="currency_id"></p>
  </div>
  <div class="col-sm-4">
  	<label for="total">Total</label>
    <p class="form-control-plaintext" id="total"></p>
  </div>
  <div class="col-sm-4">
  	<label for="deuda">Deuda</label>
    <p class="form-control-plaintext" id="deuda"></p>
  </div>
  <div class="col-sm-4">
    {!! Field::number('pagar', ['label'=>'Valor a pagar','class'=>'form-control-sm', 'required', 'step'=>'0']) !!}
  </div>
  <div class="col-sm-12">
    {!! Field::text('descripcion', ['label'=>'Descripción', 'class'=>'form-control-sm', 'required']) !!}
  </div>
  <button type="submit" class="btn btn-primary">PAGAR</button>
</div>
</form>
		  </div>
		</div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>