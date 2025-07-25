<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="icon" type="image/jpeg" href="./img/logo_makim_01.jpg" />

	<title>Presupuesto: {{ $model->series }}-{{ str_pad($model->number, 7, '0', STR_PAD_LEFT) }}</title>
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
					<img src="./{{ \Storage::url( session('my_company')->config['logo']) }}" alt="" width="100px">
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
					<div>PRESUPUESTO</div>
					<div>{{ $model->series }}-{{ str_pad($model->number, 7, '0', STR_PAD_LEFT) }}</div>
					
				</td>
			</tr>
		</table>
	</div>
	<br>
	<table class="data">
		<tr>
			<td class="label">Tipo de Servicio:</td>
			<td class="col2">{{ $model->type_service }}</td>
			<td class="label">F. Emisión:</td>
			<td class="">{{ $model->created_at->format('d/m/Y') }} {{ $model->created_at->format('h:i a') }}</td>
		</tr>
		<tr>
			<td class="label">Asesor:</td>
			<td class="col2">{{ isset($model->seller->company_name) ? $model->seller->company_name : '' }}</td>
			<td class="label">Días de trabajo:</td>
			@if(isset($model->diagnostico->tiempo))
				@if($model->diagnostico->tiempo > 0)
				<td class="">{{ $model->diagnostico->tiempo }} hábiles</td>
				@else
				<td class=""></td>
				@endif
			@endif
		</tr>
		<tr>
			<td class="label">Propietario(a):</td>
			<td class="col2">{{ $model->company->company_name }}</td>
			<td class="label">{{ config('options.client_doc.'.$model->company->id_type) }}:</td>
			<td class="">{{ $model->company->doc }}</td>
		</tr>
		<tr>
			<td class="label">Contacto:</td>
			<td class="col2">{{ isset($model->inventory->contact_name) ? $model->inventory->contact_name : '' }}</td>
			<td class="label">Cia Seguro:</td>
			<td class="">{{ isset($model->inventory->seguro) ? $model->inventory->seguro : '' }}</td>
		</tr>
		<tr>
			<td class="label">Placa:</td>
			<td class="col2">{{ $model->car->placa }}</td>
			<td class="label">Marca:</td>
			<td class="">{{ $model->car->modelo->brand->name }}</td>
		</tr>
		<tr>
			<td class="label">Modelo:</td>
			<td class="col2">{{ $model->car->modelo->name }}</td>
			<td class="label">Año:</td>
			<td class="">{{ $model->car->year }}</td>
		</tr>
		<tr>
			<td class="label">VIN:</td>
			<td class="col2">{{ $model->car->vin }}</td>
			<td class="label">Color:</td>
			<td class="">{{ $model->car->color }}</td>
		</tr>
		@if(trim($model->comment)!="")
		<tr>
			<td class="label">Comentario:</td>
			<td colspan="3">{{$model->comment}}</td>
		</tr>
		@endif
	</table>
	</div>
	<br>
	<div class="container-items">
@php
    // Separar los detalles en dos grupos
    $detalles_normales = $model->details->where('is_downloadable', 0)->sortBy('id');

	// Agrupar dinámicamente por comment según orden de ingreso
	$grupos = [];
	$comentariosVistos = [];

	foreach ($detalles_normales as $detalle) {
	    $comment = $detalle->comment;
	    if (!in_array($comment, $comentariosVistos)) {
	        $comentariosVistos[] = $comment;
	        $grupos[$comment] = [];
	    }
	    $grupos[$comment][] = $detalle;
	}
	
	$detalles_repuestos = $model->details->where('is_downloadable', 1);

    $comentario_actual = null; // Para el control de cambios en comment

    // Filtrar repuestos en dos subgrupos
    $repuestos_pagados = $detalles_repuestos->where('value', '>', 0);
    $repuestos_compania = $detalles_repuestos->where('value', '=', 0);

    // Calcular los totales con dos decimales
    $total_normales = number_format($detalles_normales->sum('total'), 2, '.', ',');
    $total_repuestos_pagados = number_format($repuestos_pagados->sum('total'), 2, '.', ',');
    $total_repuestos_compania = number_format($repuestos_compania->sum('total'), 2, '.', ',');
@endphp

<table class="table-items">
    <thead>
        <tr>
            <th class="th1 border center">ITEM</th>
            <th class="th2 border center">DESCRIPCIÓN</th>
            <th class="th3 border center">CANT.</th>
            <th class="th4 border center">TOTAL</th>
        </tr>
    </thead>
    <tbody>
        {{-- Grupo de is_downloadable = 0 --}}
        @php $item = 1; @endphp
		@foreach($grupos as $comment => $detalles)
		    <tr>
		        <td class="border title" colspan="3"><strong>{{ $comment }}</strong></td>
		        <td class="border center">
		            <strong>{{ number_format(collect($detalles)->sum('total'), 2, '.', ',') }}</strong>
		        </td>
		    </tr>
		    @foreach($detalles as $detalle)
		    <tr>
		        <td class="border center">{{ $item++ }}</td>
		        <td class="border">{{ $detalle->product->name }}</td>
		        <td class="border center">{{ $detalle->quantity.' '.$detalle->unit->symbol }}</td>
		        <td class="border center"></td>
		    </tr>
		    @endforeach
		@endforeach

        {{-- Grupo de REPUESTOS (value > 0) --}}
        @if($repuestos_pagados->isNotEmpty())
            <tr>
                <td class="border title" colspan="3"><strong>REPUESTOS</strong></td>
                <td class="border center"><strong>{{ $total_repuestos_pagados }}</strong></td>
            </tr>
            @foreach($repuestos_pagados as $key => $detail)
                <tr>
                    <td class="border center">{{ $loop->iteration + count($detalles_normales) }}</td>
                    <td class="border">{{ $detail->product->name }}</td>
                    <td class="border center">{{ $detail->quantity.' '.$detail->unit->symbol }}</td>
                    <td class="border center"></td>
                </tr>
            @endforeach
        @endif

        {{-- Grupo de REPUESTOS POR COMPAÑÍA (value = 0) --}}
        @if($repuestos_compania->isNotEmpty())
            <tr>
                <td class="border title" colspan="4"><strong>REPUESTOS POR COMPAÑÍA</strong></td>
            </tr>
            @foreach($repuestos_compania as $key => $detail)
                <tr>
                    <td class="border center">{{ $loop->iteration + count($detalles_normales) + count($repuestos_pagados) }}</td>
                    <td class="border">{{ $detail->product->name }}</td>
                    <td class="border center">{{ $detail->quantity.' '.$detail->unit->symbol }}</td>
                    <td class="border center"></td>
                </tr>
            @endforeach
        @endif
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
	<footer>
		<div><strong>Cuentas: </strong></div>
		@foreach($cuentas as $cta)
			<div>
				<strong>{{ config('options.tipo_banco.'.$cta->type) }}</strong>
				{{ $cta->name }} - N° {{ $cta->number }} - 
				<strong>CCI N°</strong>
				{{ $cta->cci }} - {{ config('options.table_sunat.moneda.'.$cta->currency_id) }}
			</div>
		@endforeach
	</footer>
</body>
</html>