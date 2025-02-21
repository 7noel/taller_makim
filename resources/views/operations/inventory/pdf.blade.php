<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>INVENTARIO: {{ $model->sn }}-{{ $model->created_at->formatLocalized('%Y') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            white-space: nowrap;
        }
        td {
/*            padding: 4px;*/
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
        .comment-col { width: 20%; text-align: left; border-left: none; }
        .desc-col, .circle-col, .comment-col{
        	padding: 2px 1px;
        }
        .legend-table {
            border: 1px solid #000;
            border-collapse: separate;
            margin-bottom: 10px;
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
        	border: none;
        	text-transform: uppercase;
        }
        .table-datos td{
        	border: none;
        	padding: 0px;
        	font-size: 10px;
        }
        .table-datos .label2 {
        	font-weight: bold;
        	width: 25%;
        	vertical-align: top;
        }
        .table-datos .label3{
        	font-weight: bold;
        	width: 15%;
        	vertical-align: top;
        }
        .table-datos td{
        	padding: 1px 0;
        	border: none;
        }
		.div_img{
			margin-top: 0;
		}
		.inventory-image{
			width: 270px;
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
					<img src="./img/speed.png" alt="" width="100px">
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
					<div>V001-{{ str_pad($model->sn, 7, '0', STR_PAD_LEFT) }}  {{-- $model->created_at->formatLocalized('%Y') --}}</div>
					
				</td>
			</tr>
		</table>
	</div>
	<br>
<table>
	<tr>
		<td style="width:59%; border: none;">
			<table class="table-datos">
				<tr>
					<td class="label2">F. Emisión:</td>
					<td>{{ $model->created_at->format('d/m/Y') }} {{ $model->created_at->format('h:i a') }}</td>
				</tr>
				<tr>
					<td class="label2">Señor(a):</td>
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
					<td class="label2">Tipo de Servicio:</td>
					<td>{{ $model->type_service }}</td>
				</tr>
				<tr>
					<td class="label2">Responsable:</td>
					<td>{{ isset($model->repairman->company_name) ? $model->repairman->company_name : '' }}</td>
				</tr>
				<tr>
					<td class="label2">Placa:</td>
					<td><strong>{{ $model->car->placa }}</strong></td>
				</tr>
				<tr>
					<td class="label2">Marca/Modelo:</td>
					<td>{{ $model->car->modelo->brand->name.' '.$model->car->modelo->name }}</td>
				</tr>
				<tr>
					<td class="label2">Año:</td>
					<td>{{ $model->car->year }}</td>
				</tr>
				<tr>
					<td class="label2">VIN:</td>
					<td>{{ $model->car->vin }}</td>
				</tr>
				<tr>
					<td class="label2">Kilometraje:</td>
					<td>{{ number_format($model->kilometraje) }} km</td>
				</tr>
				<tr>
					<td class="label2">F. Entrega:</td>
					<td>{{ date('d/m/Y', strtotime($model->inventory->entrega)) }}</td>
				</tr>
				<tr>
					<td class="label2">Cia. de seguro:</td>
					<td>PACIFICO</td>
				</tr>
				<tr>
					<td class="label2">Tj propiedad:</td>
					<td>SI</td>
				</tr>
				<tr>
					<td class="label2">soat:</td>
					<td>SI</td>
				</tr>
				<tr>
					<td class="label2">revision:</td>
					<td>04/09/2025</td>
				</tr>
				<tr>
					<td class="label2">llaves:</td>
					<td>2</td>
				</tr>
				<tr>
					<td class="label2">c. remoto:</td>
					<td>SI</td>
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
<br>
<table class="table-datos">
	<tr>
		<td class="label3">SOLICITUD DEL CLIENTE:</td>
		<td>{{ $model->inventory->solicitud }} Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quaerat ipsum voluptate aliquid nostrum amet voluptatibus, maiores quisquam, saepe laborum nisi laudantium odio, quibusdam possimus. At unde quidem quia consequuntur, totam.</td>
	</tr>
	<tr>
		<td class="label3">comentarios de asesor:</td>
		<td>{{ $model->comment }} Lorem, ipsum dolor sit amet, consectetur adipisicing elit. Minima quod quisquam a, odit magnam, repellat hic animi voluptate atque cumque sunt, ipsum et corrupti rerum magni. Qui eveniet, explicabo libero.</td>
	</tr>
</table>
	<br>
    <table class="legend-table">
        <tr>
            <th>Leyenda checklist:</th>
            <td><span class="circle green"></span> Correcto</td>
            <td><span class="circle amber"></span> Recomendable</td>
            <td><span class="circle red"></span> Urgente</td>
            <td><span class="circle black"></span> No aplica</td>
        </tr>
    </table>
    <table style="font-size: 9px;">
        <tbody>
            @php
                $numRows = ceil(count($checklist_details) / 3);
                $columns = [[], [], []];
                foreach ($checklist_details as $index => $item) {
                    $columns[$index % 3][] = $item;
                }
            @endphp
            @for ($i = 0; $i < $numRows; $i++)
                <tr>
                    @for ($j = 0; $j < 3; $j++)
                        @php
                            $item = $columns[$j][$i] ?? null;
                            $statusClass = $item ? ($item->status == 'correcto' ? 'green' : ($item->status == 'recomendable' ? 'amber' : ($item->status == 'urgente' ? 'red' : 'black'))) : '';
                        @endphp
                        <td class="desc-col">{{ $item->name ?? '' }}</td>
                        <td class="circle-col">@if($item)<span class="circle {{ $statusClass }}"></span>@endif</td>
                        <td class="comment-col">{{ $item->comment ?? '' }}</td>
                    @endfor
                </tr>
            @endfor
        </tbody>
    </table>
		
	<br><br>
	<table>
		<tr>
			<td style="width: 60%; text-align: center;">AUTORIZACIÓN CLIENTES</td>
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
			<td style="width: 60%; text-align: center;">IMPORTANTE</td>
			<td rowspan="2" style="vertical-align: bottom;">
				<div style="border-top: solid 1px; text-align: center;">RECIBI CONFORME / DNI</div>
			</td>
			<td rowspan="2" style="vertical-align: bottom;">
				<div style="border-top: solid 1px; text-align: center;">ENTREGADO POR</div>
			</td>
		</tr>
		<tr>
			<td>En caso que el cliente no abonase los trabajos realizados a la empresa y estando el automóvil a su disposición, la empresa esta facultado a: <br>a) Cobrar la suma de S/. 50 x días/mes...diarios por derechos a guardería. <br>b) Cobrar el .....% de intereses por derecho a guardería. <br>c) A cualquier otra acción permitida por la ley</td>
		</tr>
	</table>

	<footer>
	</footer>
</body>
</html>