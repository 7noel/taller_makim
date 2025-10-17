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
	<title>Presupuesto: {{ $model->series }}-{{ str_pad($model->number, 7, '0', STR_PAD_LEFT) }}</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">

	<style>
	/* ——— Configuración de página ——— */
	@page {
	  margin-top: 30px;
	  margin-bottom: 30px;
	}

	/* ——— Cuerpo del documento ——— */
	body {
	  padding: 0;
	  margin: 0;
	  border-top: -10px;
	  font-family: 'Roboto Condensed', sans-serif;
	  font-size: 12px;
	  background: white;
	}

	/* ——— Encabezado ——— */
	.header {
	  page-break-after: avoid !important;
	  font-family: 'Arial', sans-serif;
	  margin-bottom: 10px !important;
	}

	/* ——— Pie de página ——— */
	footer {
	  position: fixed;
	  bottom: 0cm;
	  left: 0cm;
	  right: 0cm;
	  height: 2cm;
	}

	/* ——— Tablas generales ——— */
	table {
	  width: 100%;
	  border-collapse: collapse;
	  table-layout: fixed;
	  white-space: normal;
	}

	td, th {
	  /* padding: 4px; */
	  vertical-align: middle;
	  word-wrap: break-word;
	  overflow-wrap: break-word;
	  white-space: normal;
	  page-break-inside: avoid !important;
	}

	/* ——— Tabla de datos del vehículo ——— */
	.data {
	  page-break-after: avoid !important;
	  font-family: 'Arial', sans-serif;
	  font-size: 10px;
	  margin-bottom: 10px;
	}

	.col2 {
	  width: 50%;
	}

	.label {
	  font-weight: bold;
	  width: 15%;
	  text-transform: uppercase;
	}

	/* ——— Tabla de ítems ——— */
	.table-items {
	  border: 1px solid #000;
	  page-break-before: auto !important;
	  page-break-after: auto !important;
	}

	.table-items .th1 {
	  width: 6%;
	  text-align: center;
	}

	.table-items .th2 {
	  /* width: 5%; */
	}

	.table-items .th3,
	.table-items .th4,
	.table-items .th5,
	.table-items .th6 {
	  width: 10%;
	  text-align: center;
	}

	.table-items .title {
	  padding-left: 45px;
	}

	/* ——— Utilitarias ——— */
	.border {
	  border: 1px solid #000;
	}

	.center {
	  text-align: center;
	}

	.mt-5 {
	  margin-top: 5px;
	}

	td.align-top {
	  vertical-align: top;
	}

	.table-franquicia td {
	  padding-left: 10px;
	}

	.container-items {
	  margin-top: 5px !important;
	}

	/* ——— Encabezados de sección ——— */
	.header-section {
	  background-color: lightgray;
	  text-align: center;
	  font-weight: bold;
	  text-transform: uppercase;
	}

	/* ——— Control de saltos de página ——— */
	.table-category,
	.table-section {
	  page-break-after: avoid !important;
	  page-break-before: auto !important;
	}

	thead {
	  display: table-header-group;
	}

	tfoot {
	  display: table-row-group;
	}

	br + table {
	  margin-top: 5px !important;
	}
	</style>

</head>
<body>
	<script type="text/php">
	if ( isset($pdf) ) {
	    $pdf->page_script('
	        $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
	        $size = 8;
	        $pageText = "Página $PAGE_NUM de $PAGE_COUNT";
	        $width = $fontMetrics->get_text_width($pageText, $font, $size);

	        // Posición centrada en el ancho de la página
	        $x = ($pdf->get_width() - $width) / 2;
	        $y = $pdf->get_height() - 25;  // ≈30pt desde el borde inferior
	        $pdf->text($x, $y, $pageText, $font, $size);
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
					<div>PRESUPUESTO</div>
					<div>{{ $model->series }}-{{ str_pad($model->number, 7, '0', STR_PAD_LEFT) }}</div>
					
				</td>
			</tr>
		</table>
	</div>

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
			<td class="">{{ optional($model->insurance_company)->brand_name }}</td>
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
			<td class="label">Kilometraje:</td>
			<td class="col2">{{ number_format($model->kilometraje, 0, '.', ',') }} km</td>
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

	<div class="container-items">
@php
    // Separar los detalles en dos grupos
	$detalles_normales = $model->details->where('is_downloadable', 0)->sortBy('id');

	// Agrupar dinámicamente según orden de aparición
	$grupos = [];
	$categoriasVistas = [];

	foreach ($detalles_normales as $detail) {
	    $categoria = $detail->comment;
	    if (!in_array($categoria, $categoriasVistas)) {
	        $categoriasVistas[] = $categoria;
	        $grupos[$categoria] = [];
	    }
	    $grupos[$categoria][] = $detail;
	}
    $detalles_repuestos = $model->details->where('is_downloadable', 1);

    $comentario_actual = null; // Para el control de cambios en comment

    // Filtrar repuestos en dos subgrupos
    $repuestos_pagados = $detalles_repuestos->where('value', '>', 0);
    $repuestos_compania = $detalles_repuestos->where('value', '=', 0);

    // Calcular los totales con dos decimales
    $total_normales = number_format($detalles_normales->sum('total'), 2, '.', ',');
    $total_repuestos_pagados = number_format($repuestos_pagados->sum('price_item'), 2, '.', ',');
    $total_repuestos_compania = number_format($repuestos_compania->sum('price_item'), 2, '.', ',');
@endphp

<table class="table-items">
    <thead>
        <tr>
            <th class="th1 border center">ITEM</th>
            <th class="th2 border center">DESCRIPCIÓN</th>
        </tr>
    </thead>
    <tbody>
        {{-- Grupo de is_downloadable = 0 --}}
        @php $item = 1; @endphp
		@foreach($grupos as $comment => $detalles)
		    <tr>
		        <td class="border title" colspan="2"><strong>{{ $comment }}</strong></td>
		    </tr>
		    @foreach($detalles as $detail)
			<tr>
			    <td class="border center align-top">{{ $item++ }}</td>
			    <td class="border align-top">
				    @if (!empty($detail->description))
				        <strong>{{ $detail->product->name }}</strong><br>
				        {!! nl2br(e($detail->description)) !!}
				    @else
				        {{ $detail->product->name }}
				    @endif
				</td>
			</tr>
		    @endforeach
		@endforeach


        {{-- Grupo de REPUESTOS (value > 0) --}}
        @if($repuestos_pagados->isNotEmpty())
            <tr>
                <td class="border title" colspan="2"><strong>REPUESTOS</strong></td>
            </tr>
            @foreach($repuestos_pagados as $key => $detail)
                <tr>
                    <td class="border center">{{ $loop->iteration + count($detalles_normales) }}</td>
                    <td class="border">{{ $detail->product->name }}</td>
                </tr>
            @endforeach
        @endif

        {{-- Grupo de REPUESTOS POR COMPAÑÍA (value = 0) --}}
        @if($repuestos_compania->isNotEmpty())
            <tr>
                <td class="border title" colspan="2"><strong>REPUESTOS POR COMPAÑÍA</strong></td>
            </tr>
            @foreach($repuestos_compania as $key => $detail)
                <tr>
                    <td class="border center">{{ $loop->iteration + count($detalles_normales) }}</td>
                    <td class="border">{{ $detail->product->name }}</td>
                </tr>
            @endforeach
        @endif
    </tbody> 
</table>

</body>
</html>