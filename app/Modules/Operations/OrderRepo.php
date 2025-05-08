<?php
namespace App\Modules\Operations;

use App\Modules\Base\BaseRepo;
use App\Modules\Operations\Order;
use App\Modules\Storage\MoveRepo;
use App\Modules\Operations\OrderDetailRepo;
use App\Modules\Operations\OrderChecklistDetailRepo;
use App\Modules\Storage\Stock;
use App\Modules\Base\Table;

class OrderRepo extends BaseRepo{

	// input_quote cotización
	// input_order orden de venta
	// input_note nota de salida
	// output_quote requerimiento de areas
	// output_order orden de compra
	// output_note nota de ingreso

	public function getModel(){
		return new Order;
	}
	public function findOrFail($id)
	{
		return Order::with('details.product', 'details.product.accessories.accessory.sub_category')->findOrFail($id);
	}
	public function save($data, $id=0)
	{
		$data['order_type'] = explode('.', \Request::route()->getName())[0];
		if ($id == 0) {
			$sn = $this->getNextNumber($data['order_type'], session('my_company')->id);

			$data['series'] = $sn['series'];
			$data['number'] = $sn['number'];
			$data['sn'] = $sn['series'] . '-' . $sn['number'];

			// $data['sn'] = $this->getNextNumber($data['order_type'], session('my_company')->id);
		}
		$data = $this->prepareData($data);
		// dd($data);

		if ($id==0) {
			$last = Order::orderBy('id', 'desc')->first();
			if ($last) {
				$my_id = $last->id + 1;
			} else {
				$my_id = 1;
			}
			
		} else {
			$my_id = $id;
		}
		

		// if (isset($data['inventory']['photos'][0])) {
		// 	$i = 0;
		// 	foreach ($data['inventory']['photos'] as $key => $photo) {
		// 		if (strlen($photo) < 30) {
		// 			$name_files[$key] = $photo;
		// 		} else {
		// 			$name = 'ot_'.$my_id.'_'.str_pad($key, 3, "0", STR_PAD_LEFT);
		// 			// $name = 'ot_'.$my_id.'_'.str_pad($i, 3, "0", STR_PAD_LEFT);
		// 			$this->saveImageBase64($photo, $name);
		// 			$name_files[$key] = $name.".jpg";
		// 		}
		// 		$i = $i + 1;
		// 	}
		// 	$data['inventory']['photos'] = $name_files;
		// }
		$model = parent::save($data, $id);

		if (isset($data['items']) and $data['items']>0) {
			// Guarda los detalles
			$detailRepo = new OrderDetailRepo;
			$toDelete = $detailRepo->syncMany2($data['details'], ['key' => 'order_id', 'value' => $model->id], 'product_id');

			// Regulariza el stock y registra los movimientos
			if (1==0 and $data['order_type']=='output_orders' and $data['is_downloadable']==1) {
				$mov = new MoveRepo;
				$mov->destroy2($toDelete, $detailRepo->model->getMorphClass());
				$change_value = 0 ;
				$mov->saveAll($model, $change_value);
			}
		}
		if (isset($data['order_id']) and isset($data['quote_sn'])) {
			Order::where('id', $data['order_id'])->update(['order_id' => $model->id, 'invoiced_at' => date('Y-m-d H:i:s'), 'status' => 'CERR']);
		}
		if (isset($data['image_base64']) and $data['image_base64'] != '') {
			$this->saveImageBase64($data['image_base64'], 'ot_'.$model->id);
		}
			// dd($data['order_checklist_details']);
		if (isset($data['order_checklist_details']) and count($data['order_checklist_details'])>0) {
			// dd($data);
			// Guarda los order_checklist_details
			$orderChecklistDetailRepo = new OrderChecklistDetailRepo;
			$toDelete = $orderChecklistDetailRepo->syncMany2($data['order_checklist_details'], ['key' => 'order_id', 'value' => $model->id], 'checklist_detail_id');
		}

		return $model;
	}

	public function getNextNumber($order_type)
	{
		$my_company = session('my_company')->id;
		$doc = Table::where('my_company', $my_company)->where('value_1', $order_type)->first();
		$last = Order::where('my_company', $my_company)->where('order_type', $order_type)->where('series', $doc->name)->orderByRaw('CONVERT(number, SIGNED) desc')->first();
		// dd(session('my_company'));
		if ($last) {
			return ['id' => $doc->id, 'series' => $doc->name, 'number'=> ($last->number + 1)];
		} else {
			return ['id' => $doc->id, 'series' => $doc->name, 'number'=> 1];
		}

		// $last = Order::where('my_company', $my_company)->where('order_type', $order_type)->orderBy('id', 'desc')->first();
		// if (isset($last) && $last->sn > 0) {
		// 	return $last->number + 1;
		// } else {
		// 	return 1;
		// }
	}

	public function prepareData($data)
	{
		if ($data['my_company'] == '') {
			$data['my_company'] = session('my_company')->id;
		}
		if (isset($data['inventory'])) {
			//$data['inventory'] = json_encode($data['inventory']);
		}
		if (isset($data['items']) and !isset($data['details'])) {
			$data['details'] = [];
		}

		// if (($data['order_type'] == 1 or $data['order_type'] == 2) and $data['sn'] == '') {
		// 	$data['sn'] = $this->getNextNumber($data['order_type'], $data['my_company']);
		// }

		$data['document_type_id'] = 20;
		$data['mov'] = 0;
		$data['type_op'] = '01'; //2135
		if (!isset($data['warehouse_id']) or $data['warehouse_id'] == '' or $data['warehouse_id'] == '0') {
			$data['warehouse_id'] = 1;
		}
		
		//Calculando totales
		$gross_value = 0;
		$gross_precio = 0;
		$subtotal = 0;
		$d_items = 0;
		$total = 0;
		if (isset($data['details'])) {
			foreach ($data['details'] as $key => $detail) {
				if (!isset($detail['is_deleted'])) {
					$q = $detail['quantity'];
					$v = $detail['value'];
					$p = $detail['price'];
					if ($data['with_tax']) {
						$v = round($p*100/(100 + config('options.tax.igv')), 2);
					} else {
						$p = round($v*(100 + config('options.tax.igv'))/100, 2);
					}
					$d1 = isset($detail['d1']) ? $detail['d1'] : 0 ;
					$d2 = isset($detail['d2']) ? $detail['d2'] : 0 ;
					// $p = $detail['value'] * (100 + config('options.tax.igv')) / 100;
					$vt = round( $v * $q * (100-$d1) * (100-$d2) / 100 )/100;
					$t = round( $p * $q * (100-$d1) * (100-$d2) / 100 )/100;
					// $t = round($vt * (100 + config('options.tax.igv')) / 100, 2);
					$discount = $v*$q - $vt;
					$data['details'][$key]['value'] = round($v, 2);
					$data['details'][$key]['price'] = round($p, 2);
					$data['details'][$key]['discount'] = round($discount, 2);
					$data['details'][$key]['total'] = round($vt, 2);
					$data['details'][$key]['price_item'] = round($t, 2);
					if ($data['with_tax']) {
						$data['details'][$key]['total'] = round($t*100/(100 + config('options.tax.igv')), 2);
					} else {
						$data['details'][$key]['price_item'] = round($vt*(100 + config('options.tax.igv'))/100, 2);
					}
					$d_items += $discount;
					$gross_value += $detail['value'] * $detail['quantity'];
					$gross_precio += $detail['price'] * $detail['quantity'];
					$subtotal += round($vt, 2);
					$total += round($t, 2);
					
				}
				if (isset($data['with_tax']) and $data['with_tax'] == 1) {
					$subtotal = round($total*100/(100 + config('options.tax.igv')),2);
					$gross_value = round($gross_precio*100/(100 + config('options.tax.igv')),2);
					$d_items = $gross_value - $subtotal;
				} else {
					$total = round($subtotal*(100 + config('options.tax.igv'))/100, 2);
				}
				// dd($data['order_type']);
				// dd($data['order_type']=='output_orders');
				// Obteniendo el stock_id
				if (!isset($detail['stock_id']) and $data['order_type']=='output_orders' and $detail['category_id']!=17) {
					if (!isset($detail['warehouse_id'])) {
						$detail['warehouse_id'] = $data['warehouse_id'];
					}
					$s = Stock::firstOrCreate(['product_id' => $detail['product_id'], 'warehouse_id' => $detail['warehouse_id']]);
					$data['details'][$key]['stock_id'] = $s->id;
				}
			}
			$data['gross_value'] = round($gross_value, 2);
			// $data['discount'] = round($discount, 2);
			$data['subtotal'] = round($subtotal, 2);
			$data['discount_items'] = $d_items;
			$data['total'] = round($total, 2);
			$data['tax'] = $data['total'] - $data['subtotal'];
		}

		// Actualizando Status
		if (explode('.', \Request::route()->getName())[0] == 'output_orders') {
			$arr_status = config('options.order_status');
		} else {
			$arr_status = config('options.quote_status');
		}
		
		$data['status'] = 'PEND';
		if (isset($data['checked_at'])) {
			if ($data['checked_at'] == "on") {
				$data['checked_at'] = date('Y-m-d H:i:s');
			}
			$data['status_id'] = '1';
			// $data['status'] = config('options.order_status.1');
		} else {
			$data['checked_at'] = null;
		}
		if (isset($data['approved_at'])) {
			if ($data['approved_at'] == "on") {
				$data['approved_at'] = date('Y-m-d H:i:s');
			}
			$data['status'] = 'APROB';
			// $data['status'] = config('options.order_status.2');
		} else {
			$data['approved_at'] = null;
		}
		if (isset($data['invoiced_at'])) {
			if ($data['invoiced_at'] == "on") {
				$data['invoiced_at'] = date('Y-m-d H:i:s');
			}
			$data['status'] = 'CERR';
			// $data['status'] = config('options.order_status.3');
		} else {
			$data['invoiced_at'] = null;
		}
		if (isset($data['sent_at'])) {
			if ($data['sent_at'] == "on") {
				$data['sent_at'] = date('Y-m-d H:i:s');
			}
			$data['status_id'] = '4';
			// $data['status'] = config('options.order_status.4');
		} else {
			$data['sent_at'] = null;
		}
		if (isset($data['canceled_at'])) {
			if ($data['canceled_at'] == "on") {
				$data['canceled_at'] = date('Y-m-d H:i:s');
			}
			$data['status_id'] = '5';
			// $data['status'] = config('options.order_status.5');
		} else {
			$data['canceled_at'] = null;
		}

		return $data;
	}

	public function filter($filter)
	{
		$order_type = explode('.', \Request::route()->getName())[0];
		$q = Order::with('proof', 'company')->where('order_type', $order_type);
		if ($filter->sn > 0) {
			return $q->where('sn', $filter->sn)->orderBy('id', 'desc')->get();
		} elseif (trim($filter->placa) != '') {
			return $q->where('placa', $filter->placa)->orderBy('id', 'desc')->get();
			//return Order::where('placa', $filter->placa)->orderBy('sn', 'desc')->get();
		} else {
			$q->where('created_at', '>=', $filter->f1)->where('created_at', '<=', $filter->f2.' 23:59:59');
			if(isset($filter->mycompany_id) && $filter->mycompany_id != '') {
				$q->where('my_company', $filter->mycompany_id);
			}
			if(isset($filter->seller_id) && $filter->seller_id != '') {
				$q->where('seller_id', $filter->seller_id);
			}
			if(isset($filter->status_id) && $filter->status_id != '') {
				$q->where('status', $filter->status_id);
			}
			return $q->orderBy('id', 'desc')->get();
		}
	}

	public function cancel($id)
	{
		$model = Order::find($id);
		$model->canceled_at = date('Y-m-d H:i:s');
		$model->status = 'ANUL';
		$model->save();
		if ($model->order_type == 'output_orders') {
			Order::where('order_type', 'output_quotes')->where('order_id', $model->id)->update(['status'=>'APROB', 'order_id'=>0, 'invoiced_at'=>NULL]);
		}
		return $model;
	}
	
	public function ordersRecepcion()
	{
		return $this->model->where('order_type', 'inventory')->with('car.modelo.brand')->where('my_company', session('my_company')->id)->orderBy('created_at', 'desc')->get();
	}
	public function withoutSlug()
	{
		return Order::where('slug', '')->withTrashed()->get();
	}
	public function findBySlug($slug)
	{
		return Order::where('slug', $slug)->firstOrFail();
	}
	public function changeStatus($data, $id=0)
	{
		$order_status = ['DIAG' => 'diag_at', 'REPU' => 'repu_at', 'PREAP' => 'pre_approved_at', 'APROB' => 'approved_at', 'REPAR' => 'repar_at', 'CONTR' => 'checked_at', 'ENTR' => 'sent_at', 'ANUL' => 'canceled_at', 'CERR' => 'invoiced_at'];
		$data[$order_status[$data['status']]] = date("Y-m-d H:i:s");
		$log['created_at'] = date("Y-m-d H:i:s");
		
		if (isset($data['aprobacion']) and !$data['aprobacion']) {
			if ($data['status'] == 'DIAG') {
				$data['status'] = 'PEND';
			} elseif ($data['status'] == 'REPAR') {
				$data['status'] = 'APROB';
			}
		}
		
		$log['status'] = $data['status'];
		
		$model = $this->model->findOrFail($id);
		$log['status_old'] = $model->status;
		$log['message'] = $data['status_msj'];
		$log['aprobacion'] = $data['status_aprobacion'];

		$status_log = (array) $model->status_log;
		$status_log[] = $log;
		$model->status_log = $status_log;
		$model->status = $data['status'];
		if ( isset($data['pre_aprobacion']) ) {
			$model->pre_aprobacion = $data['pre_aprobacion'];
		}
		if ($data['status'] != 'PEND') {
			$_at = $order_status[$data['status']];
			$model->$_at = $data[$order_status[$data['status']]];
		}
		$model->save();
		return $model;
	}

}