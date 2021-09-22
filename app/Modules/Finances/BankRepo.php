<?php 

namespace App\Modules\Finances;

use App\Modules\Base\BaseRepo;
use App\Modules\Finances\Bank;

class BankRepo extends BaseRepo{

	public function getModel(){
		return new Bank;
	}

	public function findOrFail($id)
	{
		return Bank::with('payments','payments.proof.company','payments.proof.document_type')->findOrFail($id);
	}

	public function prepareData($data)
	{
		if (isset($data['show'])) {
			$data['show'] = 1;
		} else {
			$data['show'] = 0;
		}
		return $data;
	}
}