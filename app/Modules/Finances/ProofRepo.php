<?php namespace App\Modules\Finances;

use App\Modules\Base\BaseRepo;
use App\Modules\Base\Table;
use App\Modules\Finances\Proof;
use App\Modules\Operations\Order;
use App\Modules\Finances\ProofDetailRepo;
use App\Modules\Base\ExpenseRepo;
use App\Modules\Storage\MoveRepo;
use App\Modules\Storage\Stock;

class ProofRepo extends BaseRepo{

	public function getModel(){
		return new Proof;
	}

	public function filter($filter)
	{
		$proof_type = explode('.', \Request::route()->getName())[0];
		// dd($proof_type);
		$q = Proof::where('my_company', session('my_company')->id)->where('proof_type', $proof_type);
		if (trim($filter->sn) != '') {
			return $q->where('sn', $filter->sn)->orderBy('sn', 'desc')->get();
		} elseif (trim($filter->placa) != '') {
			return $q->where('placa', $filter->placa)->orderBy('sn', 'desc')->get();
		} else {
			$q->where('created_at', '>=', $filter->f1)->where('created_at', '<=', $filter->f2.' 23:59:59');
			if(isset($filter->seller_id) && $filter->seller_id != '') {
				$q->where('seller_id', $filter->seller_id);
			}
			if(isset($filter->status_id) && $filter->status_id != '') {
				$q->where('status_sunat', $filter->status_id);
			}
			return $q->orderBy('created_at', 'desc')->get();
		}
	}

	public function findWithAmortizations($id)
	{
		return Proof::where('id', $id)->with('amortizations.payment')->first();
	}
	public function index($filter = false, $search = false, $proof_type = 0)
	{
		if ($filter and $search) {
			return Proof::$filter($search)->with('company', 'document_type', 'payment_condition', 'currency')->where('proof_type', $proof_type)->orderBy("$filter", 'ASC')->paginate();
		} else {
			return Proof::orderBy('id', 'DESC')->with('company', 'document_type', 'payment_condition', 'currency')->where('proof_type', $proof_type)->paginate();
		}
	}

	public function save($data, $id=0)
	{
		if ($id == 0) {
			$data['proof_type'] = explode('.', \Request::route()->getName())[0];
			if ($data['proof_type'] == 'output_vouchers' and (!isset($data['sn']) or $data['sn'] == '')) {
				$data['status_sunat'] = 'PEND';
				// $nextNumber = DocumentControlRepo::getNextNumber($data['document_type_id'], $data['my_company'], $data['reference_id']);
				//dd($nextNumber);
				$sn = $this->getNextNumber($data['document_type_id'], $data['my_company']);
				$data['series'] = $sn['series'];
				$data['number'] = $sn['number'];
				$data['sn'] = $sn['series'] . '-' . $sn['number'];
				$data['control_id'] = $sn['id'];
			}

		}
		// dd(explode('.', \Request::route()->getName())[0]);
		$data = $this->prepareData($data);
		$model = parent::save($data, $id);
		if (isset($data['order_id']) and isset($data['action']) and $data['action']=='generar') {
			$ot = Order::where('id', $data['order_id'])->update(['proof_id' => $model->id, 'invoiced_at' => date('Y-m-d H:i:s'), 'status' => 'CERR']);
		}
		if (isset($data['control_id'])) {
			// DocumentControlRepo::nextNumber($data['control_id']);
		}
		// Registra Movimientos
		if (isset($data['details'])) {
			$detailRepo = new ProofDetailRepo;
			$toDelete = $detailRepo->syncMany($data['details'], ['key' => 'proof_id', 'value' => $model->id], 'product_id');

			if (1==0) {
				$mov = new MoveRepo;
				$mov->destroy($toDelete);
				$mov->saveAll($model, 1);
			}
		}
		// $this->saveExpenses($data, $model);
		if (isset($data['send_sunat']) and $data['send_sunat'] == 1 and $model->proof_type == 'output_vouchers') {
			$respuesta = $this->generarComprobante($model);
			$r = json_decode($respuesta);
			if (isset($r->success) and $r->success) {
				$model->status_sunat = 'SUNAT';
			} else {
				$model->status_sunat = 'ERROR';
			}
			
			$model->response_sunat = $respuesta;
			$model->save();
		}
		return $model;
	}

	public function getNextNumber($document_type_id, $my_company = 1)
	{
		$doc = Table::where('id', $document_type_id)->where('my_company', $my_company)->first();
		$last = Proof::where('my_company', $my_company)->where('document_type_id', $document_type_id)->where('series', $doc->name)->orderBy('number', 'desc')->first();
		if ($last) {
			return ['id' => $doc->id, 'series' => $doc->name, 'number'=> ($last->number + 1)];
		} else {
			return ['id' => $doc->id, 'series' => $doc->name, 'number'=> 1];
		}
	}

	public function prepareData($data)
	{
		if ($data['my_company'] == '') {
			$data['my_company'] = session('my_company')->id;
		}
		if ($data['document_type_id'] == 3) {
			$data['mov'] = 0;
		} else {
			$data['mov'] = 1;
		}

		if ($data['is_import']) {
			$data['type_op'] = '18'; //2152
		} else {
			$data['type_op'] = '02'; //2136
		}

		// if ($data['proof_type'] == 'output_vouchers' and (!isset($data['sn']) or $data['sn'] == '')) {
		// 	$data['status_sunat'] = 'PEND';
		// 	// $nextNumber = DocumentControlRepo::getNextNumber($data['document_type_id'], $data['my_company'], $data['reference_id']);
		// 	//dd($nextNumber);
		// 	$sn = $this->getNextNumber($data['document_type_id'], $data['my_company']);
		// 	$data['series'] = $sn['series'];
		// 	$data['number'] = $sn['number'];
		// 	$data['sn'] = $sn['series'] . '-' . $sn['number'];
		// 	$data['control_id'] = $sn['id'];
		// }
		
		
		if (!isset($data['warehouse_id']) or $data['warehouse_id'] == '' or $data['warehouse_id'] == '0') {
			$data['warehouse_id'] = 1;
		}
		if (isset($data['expenses']) and $data['is_import'] != 1) {
			foreach ($data['expenses'] as $key => $exp) {
				$data['expenses'][$key]['is_deleted'] = 1;
			}
		}
		$gross_value = 0;
		$expenses = 0;
		$expenseCif = 0;
		if (isset($data['expenses'])) {
			foreach ($data['expenses'] as $key => $expense) {
				if ($key < 3) {
					$expenseCif += $expense['value'];
				}
				$expenses += $expense['value'];
				//$data['expenses'][$key]['currency_id'] = 2;
			}
		}
		//dd($data['expenses']);
		$gross_value = 0;
		$subtotal = 0;
		$d_items = 0;
		$total = 0;
		if (isset($data['details'])) {
			foreach ($data['details'] as $key => $detail) {
				if (isset($data['igv_code'])) {
					$data['details'][$key]['igv_code'] = $data['igv_code'];
				}
				if (!isset($detail['is_deleted'])) {
					$q = $detail['quantity'];
					$v = $detail['value'];
					$d1 = isset($detail['d1']) ? $detail['d1'] : 0 ;
					$d2 = isset($detail['d2']) ? $detail['d2'] : 0 ;
					$p = $v * (100 + config('options.tax.igv')) / 100;
					$vt = round( $v * $q * (100-$d1) * (100-$d2) / 100 )/100;
					$t = round( $detail['price'] * $detail['quantity'] * (100-$detail['d1']) * (100-$detail['d2']) / 100 )/100;
					// dd($t);
					$discount = $v*$q - $vt;
					$data['details'][$key]['price'] = round($p, 2);
					$data['details'][$key]['discount'] = round($discount, 2);
					$data['details'][$key]['total'] = round($vt, 2);
					$data['details'][$key]['price_item'] = round($t, 2);

					$d_items += $discount;
					$gross_value += $v * $q;
					$subtotal += round($vt, 2);
					$total += round($t, 2);

					// if (!isset($detail['discount'])) {
					// 	$detail['discount'] = 0;
					// }
					// $data['details'][$key]['total'] = round($detail['value']*$detail['quantity']*(100-$detail['discount']))/100;
					// $gross_value += $data['details'][$key]['total'];
				}
			}
		}
		$data['gross_value'] = $gross_value;
		$data['discount_items'] = $d_items;
		$data['subtotal'] = $gross_value + $expenseCif - $d_items;
		// $data['subtotal'] = $gross_value + $expenseCif;
		$data['total'] = $total;
		$data['tax'] = $data['total'] - $data['subtotal'];
		//cacular factor
		if (isset($data['proof_type']) and $data['proof_type'] == 'input_vouchers') {
			$factor = 1;
			if ($gross_value>0) {
				$factor = ($gross_value + $expenses) / $gross_value;
			}
			$data['factor'] = $factor;
			if (isset($data['details'])) {
				foreach ($data['details'] as $key => $detail) {
					if (!isset($detail['is_deleted'])) {
						$data['details'][$key]['cost'] = round(($detail['value']*$factor), 2);
					}
				}
			}
			if ($factor != 1) {
				$data['gross_value'] = $gross_value;
				$data['discount_items'] = round($d_items, 2);
				$data['subtotal'] = round($gross_value + $expenseCif, 2);
				$data['total'] = round($data['subtotal'] * (100 + config('options.tax.igv')) / 100, 2);
				$data['tax'] = round($data['total'] - $data['subtotal'], 2);
			}
		}

		// Obteniendo el stock_id
		if (isset($data['details'])) {
			foreach ($data['details'] as $key => $detail) {
				if (!isset($detail['stock_id']) and 1 == 1) {
					if (!isset($detail['warehouse_id'])) {
						$detail['warehouse_id'] = $data['warehouse_id'];
					}
					$s = Stock::firstOrCreate(['product_id' => $detail['product_id'], 'warehouse_id' => $detail['warehouse_id']]);
					$data['details'][$key]['stock_id'] = $s->id;
				}
			}
		}
		return $data;
	}

	/**
	 * guarda gastos de exportacion
	 * @param  [array] $expenses     [Data de los gastos]
	 * @param  [int] $model_id     [id de la importación]
	 * @param  [string] $expense_type [Modelo de la importación]
	 * @return [boolean]               [Retorna true al terminar de guardar]
	 */
	protected function saveExpenses($data, $model)
	{
		if (isset($data['expenses'])) {
			$expenseRepo = new ExpenseRepo;
			$expenseRepo->syncMany($data['expenses'], ['key' => 'expense_id', 'value' => $model->id], 'name', ['key'=>'expense_type', 'value' => $model->getMorphClass()]);
			return true;
		} else {
			return false;
		}
	}

	public function consultarCpe($model, $anulacion = 0)
	{
		$numero = explode('-', $model->number);
		$data = [
			"operacion" => ($anulacion == 0) ? "consultar_comprobante" : "consultar_anulacion",
			"tipo_de_comprobante" => $model->document_type->code,
			"serie" => $numero[0],
			"numero" => $numero[1]
		];
		$respuesta = $this->send($data);
		return $respuesta;

	}

	public function generarAnulacion($model)
	{
		$numero = explode('-', $model->number);
		$data = [
			"operacion" => "generar_anulacion",
			"tipo_de_comprobante" => $model->document_type->code,
			"serie" => $numero[0],
			"numero" => $numero[1],
			"motivo" => "ERROR DEL SISTEMA",
			"codigo_unico"=>""
		];
		$respuesta = $this->send($data);
		return $respuesta;
	}

	/**
	 * Genera Comprobante Electrónico
	 * @param  Proof $model Comprobante de Pago
	 * @return html        Retorna Respuesta
	 */
	public function generarComprobante($model)
	{
		$data = $this->prepareCpe($model);
		$respuesta = $this->send($data);
		return $respuesta; 
		//dd($respuesta);
		//$this->readRespuesta($respuesta);
	}

	/**
	 * Prepara el json a enviar a nubefact
	 * @param  Proof $model Comprobante de pago
	 * @return Array        array lista para ser formateada y enviada en formato json
	 */
	public function prepareCpe($model)
	{
		$data = array(
		    "serie_documento" => $model->series,
		    "numero_documento" => $model->number,
		    "fecha_de_emision" => $model->issued_at,
		    "hora_de_emision" => date('H:i:s'),
		    "codigo_tipo_operacion" => "0101",
		    "codigo_tipo_documento" => $model->document_type->code,
		    "codigo_tipo_moneda" => config('options.table_sunat.moneda_sunat.'.$model->currency_id),
		    "fecha_de_vencimiento" => $model->expired_at,
			"numero_orden_de_compra" => "",
			"nombre_almacen" => "Almacen 1",
			"datos_del_emisor" => array(
				"codigo_del_domicilio_fiscal" => "0000"
			),
			"datos_del_cliente_o_receptor" => array(
				"codigo_tipo_documento_identidad" => $model->company->id_type,
				"numero_documento" => $model->company->doc,
				"apellidos_y_nombres_o_razon_social" => $model->company->company_name,
				"codigo_pais" => $model->company->country,
				"ubigeo" => $model->company->ubigeo_code,
				"direccion" => $model->company->address,
				"correo_electronico" => $model->company->email,
				"telefono" => $model->company->mobile
			),
			"totales" => array(
				"total_exportacion" => 0.00,
				"total_operaciones_gravadas" => round($model->subtotal, 2),
				"total_operaciones_inafectas" => 0.00,
				"total_operaciones_exoneradas" => 0.00,
				"total_operaciones_gratuitas" => 0.00,
				"total_igv" => round($model->tax, 2),
				"total_impuestos" => round($model->tax, 2),
				"total_valor" => round($model->subtotal, 2),
				"total_venta" => round($model->total, 2),
			),
			"additional_information" => "Placa: $model->placa<br>Otra linea",
		);
		foreach ($model->details as $key => $detail) {
			$base = round($detail->quantity*$detail->value, 2);
			$subtotal = round($detail->quantity*$detail->value-$detail->discount, 2);
			$total = round($subtotal*1.18, 2);
			$igv = round($total - $subtotal, 2);
			$data['items'][] = array(
				// "unidad_de_medida"          => $detail->product->unit->code,
				"codigo_interno"            => $detail->product->intern_code,
				"descripcion"               => $detail->product->name,
				"codigo_producto_sunat"     => '',
				"unidad_de_medida"          => 'NIU',
				"cantidad"                  => $detail->quantity,
				"valor_unitario"            => $detail->value,
				"codigo_tipo_precio"        => '01',
				"precio_unitario"           => $detail->price,
				"codigo_tipo_afectacion_igv"=> '10',
				"total_base_igv"            => $subtotal,
				"porcentaje_igv"            => 18.00,
				"total_igv"                 => $igv,
				"total_impuestos"           => $igv,
				"total_valor_item"          => $subtotal,
				"total_item"                => $total,
				"descuentos" => array([
					"codigo" => '00',
					"descripcion" => 'Descuento',
					"porcentaje" => $detail->d1,
					"monto" => $detail->discount,
					"base" => $base,
				])
			);
		}
		if ($model->expired_at>$model->issued_at) {
			$data['venta_al_credito'][] = array(
				"cuota" => "Cuota001",
				"fecha_de_pago" => $model->expired_at,
				"importe" => $model->total,
			);
		}
		//dd($data);
		return $data;
		
	}

	/**
	 * Envía data json a nubefact
	 * @param  Array $data data lista para ser enviada
	 * @return Json            Respuesta de Nubefact
	 */
	public function send($data)
	{
		$data_json = json_encode($data);
		// dd($data_json);
		$ruta = "https://makim.facturandola.app/api/documents";
		$token = "lWWhDWAG2ngODxODuZc8lCulb73x3AfCeMww8RgxddUcjAKd8P";

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

	/**
	 * Leer Respuesta
	 * @param  Json $respuesta respuesta de nubefact
	 * @return html            Imprime en pantalla la respuesta
	 */
	public function readRespuesta($respuesta)
	{
		$leer_respuesta = json_decode($respuesta, true);
		if (isset($leer_respuesta['errors'])) {
			//Mostramos los errores si los hay
		    echo $leer_respuesta['errors'];
		} else {
			//Mostramos la respuesta
		?>
		<h2>RESPUESTA DE SUNAT</h2>
		    <table border="1" style="border-collapse: collapse">
		        <tbody>
		            <tr><th>tipo:</th><td><?php echo $leer_respuesta['tipo_de_comprobante']; ?></td></tr>
		            <tr><th>serie:</th><td><?php echo $leer_respuesta['serie']; ?></td></tr>
		            <tr><th>numero:</th><td><?php echo $leer_respuesta['numero']; ?></td></tr>
		            <tr><th>enlace:</th><td><?php echo $leer_respuesta['enlace']; ?></td></tr>
		            <tr><th>aceptada_por_sunat:</th><td><?php echo $leer_respuesta['aceptada_por_sunat']; ?></td></tr>
		            <tr><th>sunat_description:</th><td><?php echo $leer_respuesta['sunat_description']; ?></td></tr>
		            <tr><th>sunat_note:</th><td><?php echo $leer_respuesta['sunat_note']; ?></td></tr>
		            <tr><th>sunat_responsecode:</th><td><?php echo $leer_respuesta['sunat_responsecode']; ?></td></tr>
		            <tr><th>sunat_soap_error:</th><td><?php echo $leer_respuesta['sunat_soap_error']; ?></td></tr>
		            <tr><th>pdf_zip_base64:</th><td><?php echo $leer_respuesta['pdf_zip_base64']; ?></td></tr>
		            <tr><th>xml_zip_base64:</th><td><?php echo $leer_respuesta['xml_zip_base64']; ?></td></tr>
		            <tr><th>cdr_zip_base64:</th><td><?php echo $leer_respuesta['cdr_zip_base64']; ?></td></tr>
		            <tr><th>codigo_hash:</th><td><?php echo $leer_respuesta['cadena_para_codigo_qr']; ?></td></tr>
		            <tr><th>codigo_hash:</th><td><?php echo $leer_respuesta['codigo_hash']; ?></td></tr>
		        </tbody>
		    </table>
		<?php
		}
	}

	public function autocomplete1($term, $company_id)
	{
		return Proof::where('sn','like',"%$term%")->where('company_id', $company_id)->where('status_id', 0)->where('payment_condition_id', 3)->whereIn('proof_type', [1, 3])->with('document_type', 'currency')->get();
	}

	public function autocomplete2($term, $company_id)
	{
		return Proof::where('sn','like',"%$term%")->where('company_id', $company_id)->where('status', 0)->where('payment_condition_id', 3)->whereIn('proof_type', [2, 4])->with('document_type', 'currency')->get();
	}

	public function cancel($id)
	{
		$model = Proof::find($id);
		$model->canceled_at = date('Y-m-d H:i:s');
		$model->status_sunat = 'ANUL';
		$model->save();
		// Order::where('order_type', 'output_orders')->where('proof_id', $model->id)->update(['status'=>'APROB', 'proof_id'=>0, 'invoiced_at'=>NULL]);
		return $model;
	}

}