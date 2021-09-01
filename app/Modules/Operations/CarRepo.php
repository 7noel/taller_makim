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
	public function index($filter = false, $search = false)
	{
		if ($filter and $search) {
			return Car::$filter($search)->orderBy("placa", 'ASC')->paginate();
		} else {
			return Car::orderBy('id', 'DESC')->paginate();
		}
	}
}