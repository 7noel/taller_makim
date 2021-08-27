<?php 
if (! function_exists('enviar_cpe')) {
    function enviar_cpe($model)
    {
		$ruta = "https://makim.facturandola.app/api/documents";
		$token = "ntiURHPALgsJylOLEGkEV9s3sioa0DEQpyVt7z1bQt4tmDIrLv";

		$data = preparar_cpe($model);
		$data_json = json_encode($data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $ruta);
		curl_setopt(
			$ch, CURLOPT_HTTPHEADER, array(
			'Authorization: Bearer '.$token,
			'Content-Type: application/json',
			)
		);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$respuesta  = curl_exec($ch);
		curl_close($ch);
		return $respuesta;
    }
}
if (! function_exists('status_cpe')) {
    function status_cpe($model)
    {
		$ruta = "https://makim.facturandola.app/api/documents/status";
		$token = "ntiURHPALgsJylOLEGkEV9s3sioa0DEQpyVt7z1bQt4tmDIrLv";

		$data = array(
			"operacion" => "consultar_comprobante",
			"tipo_de_comprobante" => "01",
			"serie" => $model->series,
			"numero" => $model->number
		);
		$data_json = json_encode($data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $ruta);
		curl_setopt(
			$ch, CURLOPT_HTTPHEADER, array(
			'Authorization: Bearer '.$token,
			'Content-Type: application/json',
			)
		);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$respuesta  = curl_exec($ch);
		curl_close($ch);
		return $respuesta;
    }
}
if (! function_exists('preparar_cpe')) {
    function preparar_cpe($model)
    {
    	$data = array(
			"serie_documento" => $model->series,
			"numero_documento" => $model->number,
			"fecha_de_emision" => "2021-05-18",
			"hora_de_emision" => "10:11:11",
			"codigo_tipo_operacion" => "0101",
			"codigo_tipo_documento" =>"01",
			"codigo_tipo_moneda" => "PEN",
			"fecha_de_vencimiento" =>"2018-08-30",
			"numero_orden_de_compra" => "",
			"nombre_almacen" => "Almacen 1",
			"datos_del_emisor" => array(
				"codigo_del_domicilio_fiscal" => "0000"
			),
			"datos_del_cliente_o_receptor" => array(
				"codigo_tipo_documento_identidad" => "6",
				"numero_documento" => "10414711225",
				"apellidos_y_nombres_o_razon_social" => "DEMO",
				"codigo_pais" => "PE",
				"ubigeo" => "150101",
				"direccion" => "Av.",
				"correo_electronico" => "demo@gmail.com",
				"telefono" => "427-1148"
			),
			"descuentos" => [
				array(
					"codigo" => "02",
					"descripcion" => "Descuento Global",
					"porcentaje" => 10.001,
					"monto" => 17.95,
					"base" => 179.49
				)
			],
			"totales" => array(
				"total_exportacion" => 0.00,
				"total_operaciones_gravadas" => 100.00,
				"total_operaciones_inafectas" => 0.00,
				"total_operaciones_exoneradas" => 0.00,
				"total_operaciones_gratuitas" => 0.00,
				"total_igv" => 18.00,
				"total_impuestos" => 18.00,
				"total_valor" => 100,
				"total_venta" => 118
			),
			"items" =>[
				array(
					"codigo_interno" => "P0121",
					"descripcion" =>"Inca Kola 250 ml",
					"codigo_producto_sunat" => "",
					"unidad_de_medida" => "NIU",
					"cantidad" => 1,
					"valor_unitario" => 84.75,
					"codigo_tipo_precio" => "01",
					"precio_unitario" => 100.00,
					"codigo_tipo_afectacion_igv" => "10",
					"total_base_igv" => 84.75,
					"porcentaje_igv" => 18,
					"total_igv" => 15.25,
					"total_impuestos" => 15.25,
					"total_valor_item" => 84.75,
					"total_item" => 100.00,
					"descuentos" => [
						array(
							"codigo" => "00",
							"descripcion" => "Descuento",
							"porcentaje" => 0.00,
							"monto" => 0.00,
							"base" => 0.00
						)
					]
				)
			],
			"leyendas" => [
				array(
					"codigo" => "1002",
					"valor" => "TRANSFERENCIA GRATUITA"
				)
			],
			"extras" => array(
				"forma_de_pago" => "Efectivo",
				"observaciones" => "probando",
				"vendedor" => "Juan",
				"caja" => "Caja 1"
			),
			"additional_information" => "Forma de pago:Efectivo|Caja: 1"
		);

		return $respuesta;
    }
}

