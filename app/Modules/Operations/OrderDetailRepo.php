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
			}
		}
		return true;
	}
}