<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <?php
		$logoRel = data_get($model->mycompany, 'config.logo'); // p.ej. 'logos/mi_logo.png'
		$logoAbs = $logoRel ? public_path('storage/'.$logoRel) : null;

		// Si no hay logo o no existe el archivo, usa el favicon
		if (!$logoAbs || !is_file($logoAbs)) {
		    $logoAbs = public_path('img/favicon.png');
		}
     ?>
	<link rel="icon" type="image/jpeg" href="./img/logo_makim_01.jpg" />

	<title>PLANILLA: {{ $model->series }}-{{ str_pad($model->number, 7, '0', STR_PAD_LEFT) }}</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">

    <style>
		@import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&family=Roboto:wght@100&display=swap');
		@page { margin-top: 30px; }
		body{
			padding-top: 0px;
			/*font-family: 'Montserrat', sans-serif;*/
			font-family: 'Roboto Condensed', sans-serif;
/*            font-family: Arial, sans-serif;*/
			/*font-family: 'Roboto', sans-serif;*/
			font-size: 12px;
			background: white;
			/*border: solid 1px black;*/
		}

        .header{
			font-family: 'Arial', sans-serif;
        }

		footer{
			/*border: 1px solid red;*/
			/*position: fixed;*/
			/*bottom: 60px;*/
			position: fixed;
			bottom: 0cm;
			left: 0cm;
			right: 0cm;
			height: 2cm;
			/*background-color: #2a0927;*/
			/*color: white;*/
			/*text-align: center;*/
			/*line-height: 35px;*/
		}
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            white-space: nowrap;
        }
        td {
            /*padding: 4px;*/
            vertical-align: middle;
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }
        .data{
        	font-family: 'Arial', sans-serif;
        	font-size: 10px;
        }
        .col2{
        	width: 50%;
        }
        .label{
        	font-weight: bold;
        	width: 15%;
        	text-transform: uppercase;
        }
        .table-items{
            border: 1px solid #000;
        }
        .border{
            border: 1px solid #000;
        }
        .table-items .th1{
        	width: 6%;
        	text-align: center;
        }
        .table-items .th2{
/*        	width: 5%;*/
        }
        .table-items .th3{
        	width: 10%;
        	text-align: center;
        }
        .table-items .th4{
        	width: 10%;
        	text-align: center;
        }
        .table-items .th5{
        	width: 10%;
        	text-align: center;
        }
        .table-items .th6{
        	width: 10%;
        	text-align: center;
        }

        .table-items .title{
        	padding-left: 45px;
        }

        .center{
        	text-align: center;
        }
        .border{
            border: 1px solid #000;
        }

		.mt-5{
			margin-top: 5px;
		}
        .header-section {
        	background-color: lightgray;
        	text-align: center;
        	font-weight: bold;
        	text-transform: uppercase;
        }
		td.align-top {
			vertical-align: top;
		}
		
    </style>
</head>
<body>
	<script type="text/php">
	if ( isset($pdf) ) {
		$pdf->page_script('
			$font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
			$pdf->text(270, 810, "Página $PAGE_NUM de $PAGE_COUNT", $font, 8);
		');
	}
	</script>
	<div class="header">
		<table>
			<tr>
				<td width="20%" align="center" style="border: none;">
					<img src="{{ $logoAbs }}" alt="" width="100px">
				</td>
				<td width="38%" style="border: none; font-size: 10px;">
					<div class="company_name">{{ $model->mycompany->company_name }}</div>
					<div width="100%">{{ $model->mycompany->address}}</div>
					<div>{{ $model->mycompany->ubigeo->departamento.' - '.$model->mycompany->ubigeo->provincia.' - '.$model->mycompany->ubigeo->distrito }}</div>
					<div>Central Telefónica: {{ $model->mycompany->phone }}</div>
					<div>Cel: {{ $model->mycompany->mobile }}</div>
					<div>Correo: {{ $model->mycompany->email }}</div>
				</td>
				<td class="border" width="39" align="center" style="font-size: 18px; font-weight: bold;">
					<div>RUC: {{ $model->mycompany->doc }}</div>
					<div>{{ $model->series }}-{{ str_pad($model->number, 7, '0', STR_PAD_LEFT) }}</div>
					
				</td>
			</tr>
		</table>
	</div>
	<br>
	<table class="data">
		<tr>
			<td class="label">F. Emisión:</td>
			<td class="col2">{{ $model->created_at->format('d/m/Y') }} {{ $model->created_at->format('h:i a') }}</td>
			<td class="label">Local</td>
			<td class="">{{ $model->company->mycompany->brand_name }}</td>
		</tr>
		<tr>
			<td class="label">Maestro:</td>
			<td class="col2">{{ $model->company->company_name }}</td>
			<td class="label">{{ config('options.client_doc.'.$model->company->id_type) }}:</td>
			<td class="">{{ $model->company->doc }}</td>
		</tr>
	</table>
	</div>
	<br>
	<div class="container-items">

<table class="table-items">
    <thead>
        <tr>
            <th class="border center">ITEM</th>
            <th class="border center">FECHA</th>
            <th class="border center">PRESUP.</th>
            <th class="border center">INVENT.</th>
            <th class="border center">CLIENTE</th>
            <th class="border center">PLACA</th>
            <th class="border center">MARCA</th>
            <th class="border center">MODELO</th>
            <th class="border center">COLOR</th>
            <th class="border center">IMPORTE</th>
        </tr>
    </thead>
    <tbody>
        {{-- Grupo de is_downloadable = 0 --}}
        @php $item = 1; @endphp
		@foreach($model->children as $key => $vale)
		    <tr>
			    <td class="border center align-top">{{ $item++ }}</td>
			    <td class="border center align-top">{{ $vale->created_at->format('d/m/Y') }}</td>
			    <td class="border center align-top">{{ $vale->order->sn }}</td>
			    <td class="border center align-top">{{ $vale->order->inventario->sn }}</td>
			    <td class="border center align-top">
		    	@if($vale->order->type_service == 'SINIESTRO')
		    		{{ $vale->order->insurance_company->brand_name }}
		    	@elseif($vale->order->type_service == 'AMPLIACION')
		    		{{ $vale->order->mainSiniestro->insurance_company->brand_name }}
		    	@else
		    		PARTICULAR
		    	@endif
			    </td>
			    <td class="border center align-top">{{ $vale->order->car->placa }}</td>
			    <td class="border center align-top">{{ $vale->order->car->brand->name }}</td>
			    <td class="border center align-top">{{ $vale->order->car->modelo->name }}</td>
			    <td class="border center align-top">{{ $vale->order->car->color }}</td>
			    <td class="border center align-top">{{ $vale->subtotal }}</td>
		    </tr>
		@endforeach
    </tbody>
</table>


<?php 
$detraccion = ($model->total < 700) ? 0 : $model->total*0.12;
$neto = $model->total - $detraccion;
 ?>
		<br>
		<table class="table-total">
			<tbody>
				@if($model->discount > 0 or $model->discount_items > 0)
				<tr>
					<td class="left"> Planilla: {{ config('options.table_sunat.moneda_symbol.'.$model->currency_id)." ".$model->total_gravada }}</td>
					<td class="left"> Vale Desc: {{ config('options.table_sunat.moneda_symbol.'.$model->currency_id)." ".$model->discount }}</td>
					<td class="left"> SCTR: {{ config('options.table_sunat.moneda_symbol.'.$model->currency_id)." ".$model->discount_items }}</td>
				</tr>
				@endif
				<tr>
					<td class="left">SUB TOTAL {{ config('options.table_sunat.moneda_symbol.'.$model->currency_id)." ".$model->subtotal }}</td>
					<td class="left">IGV (18%) {{ config('options.table_sunat.moneda_symbol.'.$model->currency_id)." ".$model->tax }}</td>
					<td class="left">TOTAL {{ config('options.table_sunat.moneda_symbol.'.$model->currency_id)." ".$model->total }}</td>
					<td class="left">Detracción {{ config('options.table_sunat.moneda_symbol.'.$model->currency_id)." ".number_format($detraccion, 2, '.', ',') }}</td>
					<td class="left">NETO {{ config('options.table_sunat.moneda_symbol.'.$model->currency_id)." ".number_format($neto, 2, '.', ',') }}</td>
				</tr>
			</tbody>
		</table>

	</div>
</body>
</html>