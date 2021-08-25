<?php 
if (! function_exists('enviar_cpe')) {
    function enviar_cpe($model)
    {
		$ruta = "https://makim.facturandola.app/api/documents";
		$token = "ntiURHPALgsJylOLEGkEV9s3sioa0DEQpyVt7z1bQt4tmDIrLv";

		$data = array(
			"operacion" => "consultar_comprobante",
			"tipo_de_comprobante" => "01",
			"serie" => "F001",
			"numero" => 14
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
if (! function_exists('status_cpe')) {
    function status_cpe($model)
    {
		$ruta = "https://makim.facturandola.app/api/documents/status";
		$token = "ntiURHPALgsJylOLEGkEV9s3sioa0DEQpyVt7z1bQt4tmDIrLv";

		$data = array(
			"operacion" => "consultar_comprobante",
			"tipo_de_comprobante" => "01",
			"serie" => "F001",
			"numero" => 14
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