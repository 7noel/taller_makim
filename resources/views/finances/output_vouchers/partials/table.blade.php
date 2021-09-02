<table class="{{ config('options.styles.table') }}">
	<thead class="{{ config('options.styles.thead') }}">
		<tr>
			<th>Fecha</th>
			<th>Placa</th>
			<th>Documento</th>
			<th>Cliente</th>
			<th>Estado</th>
			<th>Total</th>
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
			<td>{{ config('options.table_sunat.moneda_symbol.'.$model->currency_id) .' '.$model->total }}</td>
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
				@if(isset($r->links))
				<a href="{{ route('output_vouchers.print', $model->id) }}" class="dropdown-item btn btn-outline-success btn-sm" title="Imprimir" target="popup" onClick="window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 , left=150pt, top=100pt, width=800px, height=700px'); return false;">{!! $icons['printer'] !!} IMPRIMIR</a>
				@else
				<a href="{{ route( str_replace('index', 'edit', Request::route()->getAction()['as']) , $model) }}" class="dropdown-item btn btn-outline-primary btn-sm" title="Editar">{!! $icons['edit'] !!} EDITAR</a>
				@endif
						@if(isset($r->links))
						<a href="{{ $r->links->pdf }}" class="dropdown-item btn btn-outline-info btn-sm" title="Pdf">{!! $icons['pdf'] !!} DESCARGAR PDF</a>
						<a href="{{ $r->links->xml }}" class="dropdown-item btn btn-outline-info btn-sm" title="XML">{!! $icons['xml'] !!} DESCARGAR XML</a>
						@endif
					</div>
				</div>
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
				@if($model->status_sunat!='ANUL')
						<a href="#" class="btn-anular btn btn-outline-danger btn-sm" title="ANULAR">{!! $icons['remove'] !!}</a>
				@endif

				</div>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>