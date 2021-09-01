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
		<?php $r = json_decode($model->response_sunat) ?>
		<tr data-id="{{ $model->id }}" data-tipo="Comprobante">
			<td>{{ date('d/m/Y', strtotime($model->issued_at)) }} </td>
			<td>{{ $model->placa }}</td>
			<td>{{ $model->document_type->description." ".$model->sn }} </td>
			<td>{{ $model->company->company_name }} </td>
			<td>{{ $model->status_sunat }} </td>
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
				@if(isset($r->links))
				<a href="{{ route('output_vouchers.print', $model->id) }}" class="btn btn-outline-success btn-sm" title="Imprimir" target="popup" onClick="window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 , left=150pt, top=100pt, width=800px, height=700px'); return false;">{!! $icons['printer'] !!}</a>
				@else
				<a href="{{ route( str_replace('index', 'edit', Request::route()->getAction()['as']) , $model) }}" class="btn btn-outline-primary btn-sm" title="Editar">{!! $icons['edit'] !!}</a>
				@endif
				<div class="dropdown">
					<button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{!! $icons['config'] !!}</button>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
						@if(isset($r->links))
						<a href="{{ $r->links->pdf }}" class="dropdown-item btn btn-outline-info btn-sm" title="Pdf">{!! $icons['pdf'] !!} PDF</a>
						<a href="{{ $r->links->xml }}" class="dropdown-item btn btn-outline-info btn-sm" title="XML">{!! $icons['xml'] !!} XML</a>
						@else
						<a href="#" class="dropdown-item btn-delete btn btn-outline-danger btn-sm" title="Eliminar">{!! $icons['remove'] !!}</a>
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

				</div>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>