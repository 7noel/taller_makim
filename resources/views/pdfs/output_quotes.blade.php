<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="icon" type="image/jpeg" href="./img/logo_makim_01.jpg" />

	<title>Cotización: {{ $model->sn }}-{{ $model->created_at->formatLocalized('%Y') }}</title>
	<link rel="stylesheet" href="./css/order_pdf.css">
</head>
<body>
	<div class="header">
		<div class="item-left">
			
			<img src="./img/logo_makim_doc.jpg" alt="" width="180px">
		</div>
		<div>
			<h1 class="center">
				COTIZACION: {{ str_pad($model->sn, 3, '0', STR_PAD_LEFT) }} - {{ $model->created_at->formatLocalized('%Y') }}
			</h1>
			
		</div>
	</div>
	<div>
		<div>
			<strong class="label">Señor(a):</strong><span class="data-header">{{ $model->company->company_name }}</span>
		</div>
		<div>
			<strong class="label">RUC:</strong><span class="data-header">{{ $model->company->doc }}</span>
		</div>
		<div>
			<strong class="label">Dirección:</strong><span class="data-header">{{ $model->company->address . ' ' . $model->company->ubigeo->departamento . '-' . $model->company->ubigeo->provincia . '-' . $model->company->ubigeo->distrito }}</span>
		</div>
		<div>
			<strong class="label">F. Emisión:</strong><span class="data-header-1">{{ $model->created_at->format('d/m/Y') }}</span>
			<strong class="label">Condiciones:</strong><span class="data-header">{{ config('options.payment_conditions.'.$model->payment_condition_id) }}</span>
		</div>
		<div>
			<strong class="label">Servicio:</strong><span class="data-header-1">{{ $model->type_service }}</span>
			<strong class="label">Asesor:</strong><span class="data-header">{{ '('.$model->seller_id.') '.$model->seller->company_name }}</span>
		</div>
		<div>
			<strong class="label">Placa:</strong><span class="data-header-1">{{ $model->car->placa }}</span>
			<strong class="label">Marca/Modelo:</strong><span class="data-header">{{ $model->car->modelo->brand->name.' '.$model->car->modelo->name }}</span>
		</div>
		@if(trim($model->comment)!="")
		<div>
			<strong class="label">Comentario:</strong><span class="data-header">{{$model->comment}}</span>
		</div>
		@endif
	</div>
	<br>
	<div class="container-items">
		<table class="table-items">
			<thead>
				<tr>
					<th class="th1 border center">ITEM</th>
					<th class="th2 border center">DESCRIPCION DEL PRODUCTO</th>
					<th class="th3 border center">UND</th>
					<th class="th4 border center">P. UNIT.</th>
					<th class="th5 border center">TOTAL</th>
				</tr>
			</thead>
			<tbody>
				@foreach($model->details as $key => $detail)
				<tr>
					<td class="border center">{{ $key + 1 }}</td>
					<td class="border">{{ $detail->product->name }}</td>
					<td class="border center">{{ $detail->quantity.' '.$detail->unit->symbol }}</td>
					<td class="border center">{{ $detail->price }}</td>
					<td class="border center">{{ $detail->price_item }}</td>
				</tr>
				@endforeach
			</tbody> 
		</table>

		<br>
		<table class="table-total">
			<tbody>
					<td class="left">SUB TOTAL {{ config('options.table_sunat.moneda_symbol.'.$model->currency_id)." ".$model->subtotal }}</td>
					<td class="left">IGV (18%) {{ config('options.table_sunat.moneda_symbol.'.$model->currency_id)." ".$model->tax }}</td>
					<td class="left">TOTAL {{ config('options.table_sunat.moneda_symbol.'.$model->currency_id)." ".$model->total }}</td>
				</tr>
			</tbody>
		</table>

	</div>
</body>
</html>