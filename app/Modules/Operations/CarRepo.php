<?php namespace App\Modules\Operations;

use App\Modules\Base\BaseRepo;
use App\Modules\Operations\Car;

class CarRepo extends BaseRepo{

	public function getModel(){
		return new Car;
	}

	public function getCar($placa)
	{
		return $this->model->where('placa',$placa)->first();
	}
}