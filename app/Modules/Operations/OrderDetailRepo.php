<?php
namespace App\Modules\Operations;

use App\Modules\Base\BaseRepo;
use App\Modules\Operations\OrderDetail;

class OrderDetailRepo extends BaseRepo{

	public function getModel(){
		return new OrderDetail;
	}

	public function repair_update($details)
	{

		foreach ($details as $key => $detail) {
			if (isset($detail['cost']) and isset($detail['technician_id'])) {
				// dd($detail['cost']);
				$item = OrderDetail::find($key);
				$item->cost = $detail['cost'];
				$item->technician_id = $detail['technician_id'];
				$item->save();
			} else {
				$item = OrderDetail::find($key);
				if (!$item) continue;

				// 1. Limpiar campos de fecha (para evitar errores con vacíos)
				$this->cleanDateFields($detail, [
					'requested_at',
					'expected_at',
					'alert_at',
					'received_at',
					'delivered_at',
				]);

				// 2. Rellenar los campos (gracias al $fillable del modelo)
				$item->fill($detail);

				// 3. Guardar en base de datos
				$item->save();
			}
			// dd(OrderDetail::find($key));
		}
		return true;
	}

	private function cleanDateFields(&$data, array $fields)
	{
	    foreach ($fields as $f) {
	        if (array_key_exists($f, $data) && $data[$f] === '') {
	            $data[$f] = null;
	        }
	    }
	}
}