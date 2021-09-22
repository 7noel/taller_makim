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
		return Bank::with('payments')->findOrFail($id);
	}
}