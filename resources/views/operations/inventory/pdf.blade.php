<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    @php
        $logo = data_get(session('my_company'), 'config.logo');
    @endphp
	<title>INVENTARIO: {{ $model->sn }}</title>
	<!-- <title>INVENTARIO: {{ $model->sn }}-{{ $model->created_at->formatLocalized('%Y') }}</title> -->
    <style>
		@page { margin-top: 30px; }
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
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
            border: 1px solid #000;
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }
        .circle {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 3px;
            vertical-align: middle;
        }
        .circle-small {
            width: 6px;
            height: 6px;
            border-radius: 30%;
            display: inline-block;
            margin-right: 5px;
            vertical-align: middle;
        }
        .green { background-color: #008000; }
        .amber { background-color: #FFA500; }
        .red { background-color: #FF0000; }
        .black { background-color: #000000; }
        .blue { background-color: #0000FF; }
        .desc-col { width: 45%; text-align: left; border-right: none; }
        .circle-col { width: 5%; text-align: center; border-left: none; border-right: none; }
        .comment-col { width: 20%; text-align: left; border-left: none; font-style: italic; font-size:8px }
        .desc-col, .circle-col, .comment-col{
        	padding: 1px 1px;
        }
        .legend-table {
            border: 1px solid #000;
            border-collapse: separate;
            text-align: left;
        }
        .legend-table td {
            border: none;
            padding: 2px;
            white-space: nowrap;
        }
        .col_img{
        	width: 270px;
        }
        .table-datos{
        	text-transform: uppercase;
        }
        .table-datos td{
        	border: solid 1px black;
        	font-size: 9px;
        	padding: 1px 2px;
        }
        .table-datos .label2 {
        	font-weight: bold;
        	width: 25%;
        	vertical-align: top;
        }
        .table-datos th {
        	border: solid 1px black;
        	background-color: lightgray;
        	text-align: center;
        	font-weight: bold;
        	text-transform: uppercase;
        }
        .table-datos .label3{
        	font-weight: bold;
        	width: 15%;
        	vertical-align: top;
        	vertical-align: middle;
        }
		.div_img{
			margin-top: 0;
		}
		.inventory-image{
			width: 270px;
		}
		.table-ingreso{
			border: none;
			font-size: 9px;
		}
		.table-ingreso td{
			border: none;
		}
		.table-ingreso .label{
        	font-weight: bold;
        	width: 15%;
        	vertical-align: top;
		}
		.table-ingreso .col1{
			width: 45%;
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
	<div class="">
		<table>
			<tr>
				<td width="20%" align="center" style="border: none;">
                    @if($logo && \Storage::disk('public')->exists($logo))
                        <img src="{{ \Storage::url($logo) }}" alt="" width="100px">
                    @else
						<img src="./img/favicon.png" alt="" width="100px">
                    @endif
				</td>
				<td width="38%" style="border: none; font-size: 10px;">
					<div class="company_name">{{ $model->mycompany->company_name }}</div>
					<div width="100%">{{ $model->mycompany->address}}</div>
					<div>{{ $model->mycompany->ubigeo->departamento.' - '.$model->mycompany->ubigeo->provincia.' - '.$model->mycompany->ubigeo->distrito }}</div>
					<div>Central Telefónica: {{ $model->mycompany->phone }}</div>
					<div>Cel: {{ $model->mycompany->mobile }}</div>
					<div>Correo: {{ $model->mycompany->email }}</div>
				</td>
				<td width="39" align="center" style="font-size: 18px; font-weight: bold;">
					<div>RUC: {{ $model->mycompany->doc }}</div>
					<div>INVENTARIO VEHICULAR</div>
					<div>{{ $model->series }}-{{ str_pad($model->number, 7, '0', STR_PAD_LEFT) }}</div>
					
				</td>
			</tr>
		</table>
	</div>

<table class="table-ingreso">
	<tr>
		<td class="label">Asesor:</td>
		<td class="col1">{{ isset($model->seller->company_name) ? $model->seller->company_name : '' }}</td>
		<td class="label">F. Emisión:</td>
		<td>{{ $model->created_at->format('d/m/Y') }} {{ $model->created_at->format('h:i a') }}</td>
	</tr>
</table>
<table>
	<tr>
		<td style="width:59%; border: none;">
			<table class="table-datos">
				<tr>
					<th colspan="2">Datos del Cliente</th>
				</tr>
				<tr>
					<td class="label2">Propietario(a):</td>
					<td>{{ $model->company->company_name }}</td>
				</tr>
				<tr>
					<td class="label2">{{ config('options.client_doc.'.$model->company->id_type) }}:</td>
					<td>{{ $model->company->doc }}</td>
				</tr>
				<tr>
					<td class="label2">Dirección:</td>
					<td>{{ $model->company->address . ' ' . $model->company->ubigeo->departamento . '-' . $model->company->ubigeo->provincia . '-' . $model->company->ubigeo->distrito }}</td>
				</tr>
				<tr>
					<td class="label2">Cia. de seguro:</td>
					@if(isset($model->inventory->seguro))
					<td>{{ $model->inventory->seguro }}</td>
					@else
					<td></td>
					@endif
				</tr>
				<tr>
					<td class="label2">Conductor:</td>
					@if(isset($model->inventory->driver_name))
					<td>{{ $model->inventory->driver_name }} {{ $model->inventory->driver_mobile }}</td>
					@else
					<td></td>
					@endif
				</tr>
				<tr>
					<td class="label2">Contacto:</td>
					@if(isset($model->inventory->contact_name))
					<td>{{ $model->inventory->contact_name }} {{ $model->inventory->contact_mobile }}</td>
					@else
					<td></td>
					@endif
				</tr>
			</table>
			<table class="table-datos">
				<tr>
					<th colspan="4">Datos del Vehículo</th>
				</tr>
				<tr>
					<td class="label2">Placa:</td>
					<td colspan="3">{{ $model->car->placa }}</td>
				</tr>
				<tr>
					<td class="label2">Marca:</td>
					<td colspan="3">{{ $model->car->modelo->brand->name }}</td>
				</tr>
				<tr>
					<td class="label2">Modelo:</td>
					<td colspan="3">{{ $model->car->modelo->name }}</td>
				</tr>
				<tr>
					<td class="label2">VIN:</td>
					<td colspan="3">{{ $model->car->vin }}</td>
				</tr>
				<tr>
					<td class="label2">Año:</td>
					<td colspan="3">{{ $model->car->year }}</td>
				</tr>
				<tr>
					<td class="label2">Motor:</td>
					<td colspan="3">{{ $model->car->motor }}</td>
				</tr>
				<tr>
					<td class="label2">Color:</td>
					<td colspan="">{{ $model->car->color }}</td>
					<td class="label2">Combustible:</td>
					<td>{{ config('options.combustible.'.$model->inventory->combustible) }}</td>
				</tr>
				<tr>
					<td class="label2">Kilometraje:</td>
					<td>{{ number_format($model->kilometraje) }} km</td>
					<td class="label2">Tj propiedad:</td>
					<td>{{ $model->inventory->tarjeta_propiedad }}</td>
				</tr>
				<tr>
					<td class="label2">soat:</td>
					<td>{{ ($model->inventory->soat == '') ? '' : date('d/m/Y', strtotime($model->inventory->soat)) }}</td>
					<td class="label2">revision Tec:</td>
					<td>{{ ($model->inventory->revision_tecnica == '') ? '' : date('d/m/Y', strtotime($model->inventory->revision_tecnica)) }}</td>
				</tr>
				<tr>
					<td class="label2">llaves:</td>
					<td>{{ $model->inventory->llaves }}</td>
					<td class="label2">c. remoto:</td>
					<td>{{ $model->inventory->control_remoto }}</td>
				</tr>
			</table>
			
		</td>
		<td style=" border: none;">
			<div class='div_img'>
			    <table class="legend-table" style="padding: 0 0 0 25px; border: none;">
			        <tr>
			            <td><span class="circle-small green"></span>Rayón</td>
			            <td><span class="circle-small red"></span>Abolladura</td>
			            <td><span class="circle-small blue"></span>Quiñe</td>
			        </tr>
			    </table>
				<img src="{{ (\Storage::disk('public')->exists('ot_'.$model->id.'.jpg'))?asset('/storage/ot_'.$model->id.'.jpg'):asset('/img/inventory.jpeg') }}" alt="" class="inventory-image">
			</div>
			
		</td>
	</tr>
</table>
<table class="table-datos mt-5">
	<tr>
		<td class="label3">SOLICITUD DEL CLIENTE:</td>
		<td>{{ $model->inventory->solicitud }}</td>
	</tr>
</table>
    <table class="legend-table mt-5">
        <tr>
            <th>Leyenda Checklist:</th>
            <td><span class="circle green"></span> Bueno</td>
            <td><span class="circle amber"></span> Regular</td>
            <td><span class="circle red"></span> Malo</td>
            <td><span class="circle black"></span> No aplica</td>
        </tr>
    </table>
    <table class="mt-5" style="font-size: 9px;">
    	@if($checklist_details->isNotEmpty())
            @php
                $numRows = ceil(count($checklist_details) / 3);
                $numCols = 3;
                $itemsPerCol = ceil(count($checklist_details) / $numCols);
                $columns = array_chunk($checklist_details->toArray(), $itemsPerCol);
            @endphp
            @for ($i = 0; $i < $itemsPerCol; $i++)
                <tr>
                    @for ($j = 0; $j < $numCols; $j++)
                        @php
                            $item = $columns[$j][$i] ?? null;
                            $statusClass = $item ? ($item['status'] == 'correcto' ? 'green' : ($item['status'] == 'recomendable' ? 'amber' : ($item['status'] == 'urgente' ? 'red' : 'black'))) : '';
                        @endphp
                        <td class="desc-col">{{ $item['name'] ?? '' }}</td>
                        <td class="circle-col">@if($item)<span class="circle {{ $statusClass }}"></span>@endif</td>
                        <td class="comment-col">{{ $item['comment'] ?? '' }}</td>
                    @endfor
                </tr>
            @endfor
        @endif
    </table>

<table class="table-datos mt-5">
	<tr>
		<td class="label3">OBSERVACIONES:</td>
		<td>{{ $model->comment }}</td>
	</tr>
</table>

	<table class="mt-5" style="font-size: 9px;">
		<tr>
			<td class="header-section" style="width: 60%;">AUTORIZACIÓN CLIENTES</td>
			<td rowspan="2" style="vertical-align: bottom;">
				<div style="border-top: solid 1px; text-align: center;">AUTORIZADO / DNI</div>
			</td>
			<td rowspan="2" style="vertical-align: bottom;">
				<div style="border-top: solid 1px; text-align: center;">RECEPCIONISTA</div>
			</td>
		</tr>
		<tr>
			<td>Por el presente autorizo las reparaciones autorizadas conjuntamente con el material que sea necesario usar en ellas. También autorizo a ustedes y sus empleados para que operen este vehículo por la calle, carreteras y otros sitios a fin de asegurar las pruebas e inspecciones pertinentes y para asegurar el pago por concepto de reparaciones y materiales este vehículo queda sujeto a las leyes que amparan los derechos de la empresa.</td>
		</tr>
		<tr>
			<td class="header-section" style="width: 60%;">IMPORTANTE</td>
			<td rowspan="2" style="vertical-align: bottom;">
				<div style="border-top: solid 1px; text-align: center;">RECIBI CONFORME / DNI</div>
			</td>
			<td rowspan="2" style="vertical-align: bottom;">
				<div style="border-top: solid 1px; text-align: center;">ENTREGADO POR</div>
			</td>
		</tr>
		<tr>
			<td>En caso que el cliente no abonase los trabajos realizados a la empresa y estando el automóvil a su disposición, la empresa esta facultado a: <br>a) Cobrar la suma de S/ 50.00 diarios por derechos a guardería. <br>b) Cobrar el .....% de intereses por derecho a guardería. <br>c) A cualquier otra acción permitida por la ley.</td>
		</tr>
	</table>

	<footer>
	</footer>
</body>
</html>