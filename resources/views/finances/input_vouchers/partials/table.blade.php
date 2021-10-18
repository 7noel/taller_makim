<table class="{{ config('options.styles.table') }}">
	<thead class="{{ config('options.styles.thead') }}">
		<tr>
			<th>Emisión</th>
			<th>Vence</th>
			<th>Documento</th>
			<th>Cliente</th>
			<th>Estado</th>
			<th>Mnd</th>
			<th>Total</th>
			<th>Pagado</th>
			<th>Deuda</th>
			<th>OT</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach($models as $model)
		@php
		$r = json_decode($model->response_sunat);
		if ($model->status_sunat=='ERROR') {
			$clase = 'badge badge-warning';
		} elseif ($model->status_sunat=='SUNAT') {
			$clase = 'badge badge-success';
		} elseif ($model->status_sunat=='PANUL') {
			$clase = 'badge badge-secondary';
		} elseif ($model->status_sunat=='ANUL') {
			$clase = 'badge badge-danger';
		} else {
			$clase = 'badge badge-info';
		}
		@endphp
		<tr data-id="{{ $model->id }}" data-tipo="Comprobante">
			<td>{{ date('d/m/Y', strtotime($model->issued_at)) }} </td>
			<td>{{ $model->placa }}</td>
			<td>{{ $model->document_type->description." ".$model->sn }} </td>
			<td>{{ $model->company->company_name }} </td>
			<td class="status"><span class="{{ $clase }}">{{ $model->status_sunat }}</span></td>
			<td>{{ config('options.table_sunat.moneda_sunat.'.$model->currency_id) }}</td>
			<td>{{ $model->total }}</td>
			<td>{{ $model->amortization }}</td>
			<td class="{{ ($model->total>$model->amortization)? 'text-warning' : 'text-success' }}">{{ round($model->total - $model->amortization, 2) }}</td>
			<td>
				@forelse($model->orders as $order)
				<a href="{{ '/operations/output_orders?sn='.$order->sn }}" class="btn btn-link btn-sm" title="Ver OT">{{ $order->sn }}</a>
				@empty
				SIN OT
				@endforelse
			</td>
			<td>
			<div class="btn-group">
				<div class="dropdown">
					<button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{!! $icons['config'] !!}</button>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
						@if($model->total>$model->amortization)
						<a href="{{ route('payments.by_voucher', $model->id) }}" class="dropdown-item btn btn-outline-primary btn-sm pagar-venta2" title="Pagar" data-id="{{ $model->id }}">{!! $icons['credit-card'] !!} PAGAR</a>
						@endif
						<a href="{{ route('output_vouchers.show', $model->id) }}" class="dropdown-item btn btn-outline-secondary btn-sm" title="Ver Doc">{!! $icons['view'] !!} VISUALIZAR</a>
						@if(in_array($model->status_sunat,['PEND', 'ERROR']))
						<a href="{{ route( str_replace('index', 'edit', Request::route()->getAction()['as']) , $model) }}" class="dropdown-item btn btn-outline-primary btn-sm" title="Editar">{!! $icons['edit'] !!} EDITAR</a>
						@endif
						@if(isset($r->links))
						<a href="{{ route('output_vouchers.print', $model->id) }}" class="dropdown-item btn btn-outline-success btn-sm" title="Imprimir" target="popup" onClick="window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 , left=150pt, top=100pt, width=800px, height=700px'); return false;">{!! $icons['printer'] !!} IMPRIMIR</a>
						<a href="{{ $r->links->pdf }}" class="dropdown-item btn btn-outline-info btn-sm" title="Pdf">{!! $icons['pdf'] !!} DESCARGAR PDF</a>
						<a href="{{ $r->links->xml }}" class="dropdown-item btn btn-outline-info btn-sm" title="XML">{!! $icons['xml'] !!} DESCARGAR XML</a>
						@endif
					</div>
				</div>
				@if(isset($r->links))
				<div class="dropdown">
					<button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{!! $icons['email'] !!}</button>
					<div class="dropdown-menu dropdown-menu-right" style="width:210px !important;">
						<form class="px-2 py-2 form-inline send_cpe">
							<div class="form-group">
								<input type="hidden" value="{{ $model->id }}" name="cpe">
								<input type="email" class="form-control form-control-sm" placeholder="email@example.com" value="{{ $model->company->email }}" name="email">
							</div>
							<button type="submit" class="btn btn-outline-primary btn-sm">{!! $icons['send'] !!}</button>
						</form>
					</div>
				</div>
				@endif
				@if($model->status_sunat!='ANUL')
						<a href="#" class="btn-anular btn btn-outline-danger btn-sm" title="ANULAR">{!! $icons['remove'] !!}</a>
				@endif

			</div>
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