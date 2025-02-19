<?php
namespace App\Modules\Operations;

use App\Modules\Base\BaseRepo;
use App\Modules\Operations\OrderChecklistDetail;

class OrderChecklistDetailRepo extends BaseRepo{

	public function getModel(){
		return new OrderChecklistDetail;
	}

	public function byOrder($order_id, $checklist=1)
	{
		return $this->model->where('order_id', $order_id)->where('checklist_id', $checklist)->get();
	}

}