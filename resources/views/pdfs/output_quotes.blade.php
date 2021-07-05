<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cotización: {{ $model->id }}-{{ $model->created_at->formatLocalized('%Y') }}</title>
	<link rel="stylesheet" href="./css/order_pdf.css">
</head>
<body>
	<div class="header">
		<div class="item-left">
			
			<img src="./img/logo_makim_doc.jpg" alt="" width="180px">
		</div>
		<div>
			<h1 class="center">
				COTIZACION: {{ str_pad($model->id, 3, '0', STR_PAD_LEFT) }} - {{ $model->created_at->formatLocalized('%Y') }}
			</h1>
			
		</div>
	</div>
	<div>
		<div>
			<strong class="label">Señor(a):</strong>{{ $model->company->company_name }}
		</div>
		<div>
			<strong class="label">RUC:</strong>{{ $model->company->doc }}
		</div>
		<div>
			<strong class="label">Dirección:</strong>{{ $model->company->address . ' ' . $model->company->ubigeo->departamento . '-' . $model->company->ubigeo->provincia . '-' . $model->company->ubigeo->distrito }}
		</div>
		<div>
			<strong class="label">Condiciones:</strong>{{ config('options.payment_conditions.'.$model->payment_condition_id) }}
		</div>
		<div>
			<strong class="label">Asesor:</strong>{{ '('.$model->seller_id.') '.$model->seller->company_name }}
		</div>
		<div>
			<strong class="label">F. de emisión:</strong>{{ $model->created_at->format('d/m/Y') }}
		</div>
		@if(trim($model->comment)!="")
		<div>
			<strong class="label">Comentario:</strong>{{$model->comment}}
		</div>
		@endif
	</div>
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
					<td class="border">{{ $detail->product->intern_code.' '.$detail->product->name }}</td>
					<td class="border center">{{ $detail->quantity.' '.$detail->unit->symbol }}</td>
					<td class="border center">{{ $detail->value }}</td>
					<td class="border center">{{ $detail->total }}</td>
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