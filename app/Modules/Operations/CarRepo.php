<?php namespace App\Modules\Operations;

use App\Modules\Base\BaseRepo;
use App\Modules\Operations\Car;

class CarRepo extends BaseRepo{

	public function getModel(){
		return new Car;
	}

	public function getCar($placa)
	{
		return $this->model->with('modelo.brand', 'company')->where('placa',$placa)->first();
	}
	public function index($filter = false, $search = false)
	{
		if ($filter and $search) {
			return Car::$filter($search)->orderBy("placa", 'ASC')->paginate();
		} else {
			return Car::orderBy('id', 'DESC')->paginate();
		}
	}
	public function prepareData($data)
	{
		if (!isset($data['add_contact'])) {
			$data['add_contact'] = false;
		}
		return $data;
	}
	public function filter($filter)
	{
		return Car::whereHas('company', function ($query) use($filter) {
			    $query->whereMonth('birth', $filter->f1);
			})->with('company', 'modelo.brand')->get();
	}
	public function withoutSlug()
	{
		return Car::where('slug', '')->withTrashed()->get();
	}
	public function update_contact($data)
	{
		$dataupdate = [];
		if (isset($data['contact_name'])) {
			$dataupdate['contact_name'] = $data['contact_name'];
		}
		if (isset($data['contact_mobile'])) {
			$dataupdate['contact_mobile'] = $data['contact_mobile'];
		}
		if (isset($data['contact_email'])) {
			$dataupdate['contact_email'] = $data['contact_email'];
		}
		if (isset($data['driver_name'])) {
			$dataupdate['driver_name'] = $data['driver_name'];
		}
		if (isset($data['driver_mobile'])) {
			$dataupdate['driver_mobile'] = $data['driver_mobile'];
		}
		if (isset($data['driver_email'])) {
			$dataupdate['driver_email'] = $data['driver_email'];
		}
		if (isset($data['operator_company'])) {
			$dataupdate['operator_company'] = $data['operator_company'];
		}
		if (isset($data['operator_name'])) {
			$dataupdate['operator_name'] = $data['operator_name'];
		}
		if (isset($data['operator_mobile'])) {
			$dataupdate['operator_mobile'] = $data['operator_mobile'];
		}

		if ($dataupdate === []) {
			return false;
		}
		return Car::where('placa', $data['placa'])->update($dataupdate);
	}
}